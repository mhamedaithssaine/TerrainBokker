<?php 
namespace App\Http\Controllers;

use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Ticket;
use App\Models\Payment;
use App\Models\Terrain;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReservationCancelledAdminNotification;

class ReservationController extends Controller
{

    public function __construct()
    {
       
    }

    public function index(){
        $reservations = Reservation::where('sportive_id', Auth::id())
        ->with('terrain.categorie')
        ->where('date_fin', '>=', now())
        ->where('statut', 'confirmée') 
        ->where('payment_status', 'payé') 
        ->orderBy('date_debut', 'desc')
        ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create($terrain_id)
    {
        $terrain = Terrain::with('categorie')->findOrFail($terrain_id);
        $reservations = Reservation::where('terrain_id', $terrain_id)
        ->where('date_debut', '>', Carbon::now())
        ->where('statut', 'confirmée') 
        ->where('payment_status', 'payé') 
        ->get(['id', 'sportive_id', 'date_debut', 'date_fin']);         
        return view('reservations.create', compact('terrain', 'reservations'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'terrain_id' => 'required|exists:terrains,id',
        'date_debut' => 'required|date|after:now',
        'duration' => 'required|integer|min:1|max:8',
    ]);

    $terrain_id = $request->input('terrain_id');
    $date_debut = new \DateTime($request->input('date_debut'));
    $duration = (int) $request->input('duration');

    $date_fin = clone $date_debut;
    $date_fin->modify("+$duration hour");

    $startHour = (int) $date_debut->format('H');
    $endHour = (int) $date_fin->format('H');
    $endMinute = (int) $date_fin->format('i');

    if ($startHour < 8 || ($endHour > 22 || ($endHour === 22 && $endMinute > 0))) {
        return redirect()->route('reservations.create', $terrain_id)
                         ->with('error', 'Les reservations doivent etre entre 08:00 et 22:00.');
    }

    $reservationsDuJour = Reservation::where('terrain_id', $terrain_id)
        ->whereDate('date_debut', $date_debut->format('Y-m-d'))
        ->get();

    $heuresTotales = 0;
    foreach ($reservationsDuJour as $reservation) {
        $debut = new \DateTime($reservation->date_debut);
        $fin = new \DateTime($reservation->date_fin);
        $diff = $fin->diff($debut);
        $heuresTotales += (int) $diff->h;
    }

    if ($heuresTotales + $duration > 8) {
        return redirect()->route('reservations.create', $terrain_id)
                         ->with('error', 'La durée totale pour ce jour ne peut pas dépasser 8 heures.');
    }

    //verifie les conflis 
    $conflit = Reservation::where('terrain_id', $terrain_id)
    ->where('statut', 'confirmée')
    ->where('payment_status', 'payé') 
    ->where(function ($query) use ($date_debut, $date_fin) {
        $query->whereBetween('date_debut', [$date_debut, $date_fin])
              ->orWhereBetween('date_fin', [$date_debut, $date_fin])
              ->orWhere(function ($q) use ($date_debut, $date_fin) {
                  $q->where('date_debut', '<', $date_debut)
                    ->where('date_fin', '>', $date_fin);
              });
    })
    ->first();

    if ($conflit) {
        $message = 'Ce creneau est deja reserve de ' .
                    (new \DateTime($conflit->date_debut))->format(' H:i') . ' à ' .
                    (new \DateTime($conflit->date_fin))->format(' H:i') . '.';

        return redirect()->route('reservations.create', $terrain_id)
                         ->with('error', $message);
    }

    $terrain = Terrain::find($terrain_id);
    if (!$terrain || $terrain->statut !== 'disponible') {
        return redirect()->route('reservations.create', $terrain_id)
                         ->with('error', 'Ce terrain n\'est pas disponible pour le moment.');
    }
 
   

    $amount = $terrain->prix * $duration;

    $reservation =  Reservation::create([
            'terrain_id' => $terrain_id,
            'sportive_id' => Auth::id(),
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'statut' => 'en attente',
            'payment_status' => 'pending',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Réservation de terrain #' . $reservation->id,
                    ],
                    'unit_amount' => $amount * 100, 
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('reservations.payment.success', $reservation->id),
            'cancel_url' => route('reservations.payment.cancel', $reservation->id),
            'metadata' => [
                'reservation_id' => $reservation->id,
            ],
        ]);

        Payment::create([
            'reservation_id' => $reservation->id,
            'amount' => $amount,
            'status' => 'pending',
            'stripe_session_id' => $session->id,
        ]);

        return redirect($session->url);
    }


    public function paymentSuccess($id)
{
    $reservation = Reservation::findOrFail($id);

    if ($reservation->sportive_id !== Auth::id()) {
        return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette réservation.');
    }

    $reservation->update([
        'statut' => 'confirmée',
        'payment_status' => 'payé',
    ]);

    $payment = Payment::where('reservation_id', $reservation->id)->first();
    if ($payment) {
        $payment->update([
            'status' => 'success',
        ]);

         // Creer ticket auto lorsque payment reussi
         $existingTicket = Ticket::where('payment_id', $payment->id)->first();
         if (!$existingTicket) {
             Ticket::create([
                 'payment_id' => $payment->id,
                 'price' => $payment->amount,
                 'status' => 'ouvert',
             ]);
         }
    }



    return redirect()->route('reservations.index')->with('success', 'Paiement réussi ! Réservation confirmée.');
}




public function paymentCancel($id)
{
    $reservation = Reservation::findOrFail($id);

    if ($reservation->sportive_id !== Auth::id()) {
        return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette réservation.');
    }

    $reservation->update([
        'statut' => 'annulée',
        'payment_status' => 'échoué',
    ]);

    
    $payment = Payment::where('reservation_id', $reservation->id)->first();
    if ($payment) {
        $payment->update([
            'status' => 'failed',
        ]);
    }

    return redirect()->route('reservations.create', $reservation->terrain_id)
        ->with('error', 'Paiement annulé. Réservation non confirmée.');
}




    

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->sportive_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Vous n\'etes pas autorise a annuler cette reservation.');
        }

        $refundProcessed = false;
       
        if ($reservation->statut === 'confirmée' && $reservation->payment_status === 'payé') {
         
            $payment = $reservation->payment;
           
            if ($payment && $payment->stripe_session_id) {
                try {
                    Stripe::setApiKey(env('STRIPE_SECRET'));
    
                    $session = Session::retrieve($payment->stripe_session_id);
                    $paymentIntentId = $session->payment_intent;
    
                    $refund = \Stripe\Refund::create([
                        'payment_intent' => $paymentIntentId,
                        'amount' => $payment->amount * 100, 
                    ]);
    
                    $payment->update([
                        'status' => 'refunded',
                    ]);
    
                    $reservation->update([
                        'statut' => 'annulée',
                        'payment_status' => 'remboursé',
                    ]);

                    $refundProcessed = true;

                $ticket = Ticket::where('payment_id', $payment->id)->first();
                if ($ticket) {
                    $ticket->update([
                        'status' => 'résolu',
                    ]);
                }
    
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    return redirect()->route('reservations.index')
                        ->with('error', 'Erreur lors du remboursement : ' . $e->getMessage());
                }
            } else {
                $reservation->update([
                    'statut' => 'annulée',
                    'payment_status' => 'échoué',
                ]);
            }
        }
    
        $reservation->delete();
    
        try {
            \Mail::to(env('ADMIN_EMAIL'))->queue(new ReservationCancelledAdminNotification($reservation, $refundProcessed));
        } catch (\Exception $e) {
            \Log::error('Failed to queue admin notification email for reservation cancellation #' . $reservation->id . ': ' . $e->getMessage());
        }
        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée avec succès et montant remboursé (si applicable) !');
      

    }
}