<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Terrain;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationAdminController extends Controller
{
    public function __construct()
    {
      
    }

    public function createreservation()
    {
        $clients = User::whereHas('roles', function($query) {
            $query->where('name', 'sportive');
        })->get(['id', 'name']);
        $terrains = Terrain::where('statut', 'disponible')->get(['id', 'name']);

        return view('dashboard.createreservation', compact('clients', 'terrains'));
    }

    public function getTerrainReservations($terrain_id)
    {
        $reservations = Reservation::where('terrain_id', $terrain_id)
            ->where('date_debut', '>', Carbon::now())
            ->get(['id', 'date_debut', 'date_fin']);

        $events = $reservations->map(function ($reservation) {
            return [
                'title' => 'Réservé',
                'start' => $reservation->date_debut->format('Y-m-d\TH:i:s'),
                'end' => $reservation->date_fin->format('Y-m-d\TH:i:s'),
                'backgroundColor' => '#ef4444',
                'borderColor' => '#ef4444',
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'terrain_id' => 'required|exists:terrains,id',
            'date_debut' => 'required|date|after:now',
            'duration' => 'required|integer|min:1|max:8',
            'payment_advance' => 'required|numeric|min:0',
        ]);
    
        $client_id = $request->input('client_id');
        $terrain_id = $request->input('terrain_id');
        $date_debut = new \DateTime($request->input('date_debut'));
        $duration = (int) $request->input('duration');
        $payment_advance = $request->input('payment_advance');
    
        $date_fin = clone $date_debut;
        $date_fin->modify("+$duration hour");
    
        $startHour = (int) $date_debut->format('H');
        $endHour = (int) $date_fin->format('H');
        $endMinute = (int) $date_fin->format('i');
    
        if ($startHour < 8 || ($endHour > 24 || ($endHour === 22 && $endMinute > 0))) {
            return redirect()->route('dashboard.createreservation')
                ->with('error', 'Les réservations doivent être entre 08:00 et 22:00.');
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
            return redirect()->route('dashboard.createreservation')
                ->with('error', 'La durée totale pour ce jour ne peut pas dépasser 8 heures.');
        }
    
        $date_debut_str = $date_debut->format('Y-m-d H:i:s');
        $date_fin_str = $date_fin->format('Y-m-d H:i:s');
    
        $conflit = Reservation::where('terrain_id', $terrain_id)
            ->where(function ($query) use ($date_debut_str, $date_fin_str) {
                $query->whereBetween('date_debut', [$date_debut_str, $date_fin_str])
                    ->orWhereBetween('date_fin', [$date_debut_str, $date_fin_str])
                    ->orWhere(function ($q) use ($date_debut_str, $date_fin_str) {
                        $q->where('date_debut', '<=', $date_debut_str)
                            ->where('date_fin', '>=', $date_fin_str);
                    });
            })
            ->first();
    
        if ($conflit) {
            $message = 'Ce créneau est déjà réservé de ' .
                (new \DateTime($conflit->date_debut))->format('d/m/Y H:i') . ' à ' .
                (new \DateTime($conflit->date_fin))->format('d/m/Y H:i') . '.';
    
            return redirect()->route('dashboard.createreservation')
                ->with('error', $message);
        }
    
        $terrain = Terrain::find($terrain_id);
        if (!$terrain || $terrain->statut !== 'disponible') {
            return redirect()->route('dashboard.createreservation')
                ->with('error', 'Ce terrain n\'est pas disponible pour le moment.');
        }
    
        // $client = User::find($client_id);
        $amount = $payment_advance * $duration;
    
        Reservation::create([
            'terrain_id' => $terrain_id,
            'sportive_id' => $client_id,
            'date_debut' => $date_debut->format('Y-m-d H:i:s'),
            'date_fin' => $date_fin->format('Y-m-d H:i:s'),
            'payment_advance' => $amount,
            'statut' => 'confirmée',
            'payment_status' => 'payé',

        ]);
    
        return redirect()->route('dashboard.index')->with('success', 'Réservation effectuée avec succès.');
    }
}