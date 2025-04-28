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
      
        $reservations = Reservation::withTrashed(['payment','utilisateur' ,'terrain'])
        
        ->orderBy('created_at', 'desc')
        ->paginate(4);
        return view('dashboard.reservations.index', compact('reservations'));
    }

    public function showReservation($id)
    {
        $reservation = Reservation::withTrashed()
            ->with(['terrain',
                    'utilisateur',
                    'payment' => function ($query) {
                        $query->withTrashed();
                    }])
            ->findOrFail($id);
    
        return view('dashboard.reservations.show', compact('reservation'));
    }
 

    /**
     * Affiche les paiements.
     */
    public function indexPayment()
    {
        
        $payments = Payment::with(['reservation' => function ($query) {
            $query->withTrashed()->with(['utilisateur']);
           
        }])
        ->orderBy('created_at', 'desc')->paginate(4);

        return view('dashboard.payments.index', compact('payments'));
    }

    public function showPayment(Payment $payment)
    {
        $payment->load(['reservation' => function ($query) {
        $query->withTrashed()->with(['utilisateur', 'terrain']);
        }]);
        return view('dashboard.payments.show', compact('payment'));
    }

  

}

