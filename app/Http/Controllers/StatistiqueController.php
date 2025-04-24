<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use App\Models\Feedback;
use App\Models\Reservation;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
    {

        $reservations = Reservation::with(['terrain', 'utilisateur', 'payment'])
            ->latest()
            ->take(10)
            ->get();


        $feedbacks = Feedback::with('user')
                             ->where('status', 'cacher')
                             ->orderBy('created_at', 'desc')
                             ->take(3)
                             ->get()
                             ->map(function ($feedback) {
                                 $feedback->date = Carbon::parse($feedback->created_at)->diffForHumans();
                                 return $feedback;
                             });

        return view('components.feedbackrecents', compact('feedbacks','reservations'));
}

public function recentReservations()
    {
        $reservations = Reservation::with(['terrain', 'utilisateur', 'payment'])
            ->latest()
            ->take(10)
            ->get();

        return view('components.recent-reservations-table', compact('reservations'));
    }

    public function StatistiqueCard(){
                
        $reservationsToday = Reservation::whereDate('date_debut', Carbon::today())
                ->count();
                
            $noteMoyenne = Feedback::avg('note') ?? 0;

            $nouveauxClients = User::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
            
                $revenusMois = Payment::whereHas('reservation', function ($query) {
                    $query->whereMonth('date_debut', Carbon::now()->month)
                          ->whereYear('date_debut', Carbon::now()->year);
                })
                ->where('status', 'success') 
                ->sum('amount');

            return view('components.stats-card', compact( 'reservationsToday', 'noteMoyenne','nouveauxClients','revenusMois'
            ));
    }

}