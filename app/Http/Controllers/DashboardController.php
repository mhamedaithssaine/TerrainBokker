<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Feedback;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     /**
     * Affiche le tableau de bord principal.
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Affiche la liste des réservations.
     */
   public function indexReservation()
    {
      
        $reservations = Reservation::with(['terrain', 'utilisateur', 'payment'])->latest()->paginate(10);
        return view('dashboard.reservations.index', compact('reservations'));
    }

    public function showReservation(Reservation $reservation)
    {
        $reservation->load(['terrain', 'utilisateur', 'payment']);
        return view('dashboard.reservations.show', compact('reservation'));
    }
 

    /**
     * Affiche les paiements.
     */
    public function indexPayment()
    {
        $payments = Payment::with(['reservation.utilisateur'])
        ->whereHas('reservation', function ($query) {
            $query->whereNull('deleted_at'); 
        })
        ->latest()
        ->paginate(10);

        return view('dashboard.payments.index', compact('payments'));
    }

    public function showPayment(Payment $payment)
    {
        $payment->load(['reservation.utilisateur', 'reservation.terrain']);
        return view('dashboard.payments.show', compact('payment'));
    }

  

}

