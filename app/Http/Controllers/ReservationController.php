<?php 
namespace App\Http\Controllers;

use App\Models\Terrain;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function __construct()
    {
       
    }

    public function index(){
        $reservations = Reservation::where('sportive_id', Auth::id())
            ->with('terrain.categorie')->where('date_fin','>=',now())
            ->orderBy('date_debut', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create($terrain_id)
    {
        $terrain = Terrain::with('categorie')->findOrFail($terrain_id);
        $reservations = Reservation::where('terrain_id', $terrain_id)
            ->where('date_debut', '>=', Carbon::now())
            ->get(['id', 'sportive_id', 'date_debut', 'date_fin']);             
        return view('reservations.create', compact('terrain', 'reservations'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'terrain_id' => 'required|exists:terrains,id',
        'date_debut' => 'required|date|after_or_equal:now',
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

    if ($startHour < 8 || ($endHour > 24 || ($endHour === 24 && $endMinute > 0))) {
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
        ->where(function ($query) use ($date_debut, $date_fin) {
            $query->whereBetween('date_debut', [$date_debut, $date_fin])
                  ->orWhereBetween('date_fin', [$date_debut, $date_fin])
                  ->orWhere(function ($q) use ($date_debut, $date_fin) {
                      $q->where('date_debut', '<=', $date_debut)
                        ->where('date_fin', '>=', $date_fin);
                  });
        })
        ->first();

    if ($conflit) {
        $message = 'Ce creneau est deja reserve de ' .
                    (new \DateTime($conflit->date_debut))->format('d/m/Y H:i') . ' à ' .
                    (new \DateTime($conflit->date_fin))->format('d/m/Y H:i') . '.';

        return redirect()->route('reservations.create', $terrain_id)
                         ->with('error', $message);
    }

    $terrain = Terrain::find($terrain_id);
    if (!$terrain || $terrain->statut !== 'disponible') {
        return redirect()->route('reservations.create', $terrain_id)
                         ->with('error', 'Ce terrain n\'est pas disponible pour le moment.');
    }

   

        Reservation::create([
            'terrain_id' => $terrain_id,
            'sportive_id' => Auth::id(),
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'statut' => 'en attente',
        ]);

        return redirect()->route('home')->with('success', 'Reservation effectue avec succes ');
    }
    

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->sportive_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Vous n\'etes pas autorise a annuler cette reservation.');
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation annulee avec succes !');
    }
}