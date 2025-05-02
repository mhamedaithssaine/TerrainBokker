<?php

namespace App\Http\Controllers;

use Carbon\Carbon\now;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vtiful\Kernel\Format;

class TicketController extends Controller
{
     // methode pour telecharge ticket  en pdf 

     public function downloadTicket($id)
     {
         $reservation = Reservation::with(['payment.ticket', 'terrain', 'utilisateur'])->findOrFail($id);
     
         if ($reservation->sportive_id !== Auth::id()) {
             return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette réservation.');
         }
     
         if ($reservation->statut !== 'confirmée' || $reservation->payment_status !== 'payé') {
             return redirect()->route('reservations.index')->with('error', 'Le ticket n\'est disponible que pour les réservations confirmées et payées.');
         }
     
         if (!$reservation->payment || !$reservation->payment->ticket) {
             return redirect()->route('reservations.index')->with('error', 'Aucun ticket trouvé pour cette réservation.');
         }
     
         $ticket = $reservation->payment->ticket;
         $user = $ticket->payment->reservation->utilisateur;
     
         require_once app_path('Libraries/fpdf/fpdf186/fpdf.php');
     
         $pdf = new \FPDF();
         $pdf->AddPage();
         $pdf->SetMargins(15, 15, 15);
     
         $pdf->SetFillColor(46, 204, 113);
         $pdf->SetTextColor(255, 255, 255);
         $pdf->SetFont('Arial', 'B', 18);
         $pdf->Cell(0, 15, 'Ticket de Reservation #' . $reservation->id, 0, 1, 'C', true);
         
         $pdf->SetFont('Arial', 'I', 10);
         $pdf->SetTextColor(255, 255, 255);
         $pdf->Cell(0, 8, 'Emis le: ' . $ticket->created_at->format('d/m/Y H:i'), 0, 1, 'C', true);
         $pdf->Cell(0, 8, 'le: ' . now()->format('d/m/Y H:i'), 0, 1, 'C', true);

         $pdf->Ln(10);
     
         $pdf->SetTextColor(0, 0, 0);
     
         $pdf->SetFont('Arial', 'B', 14);
         $pdf->SetFillColor(240, 240, 240);
         $pdf->Cell(0, 10, 'Informations de la Reservation', 0, 1, 'L', true);
         
         $pdf->SetFont('Arial', '', 12);
         $pdf->SetFillColor(255, 255, 255);
         $pdf->SetDrawColor(46, 204, 113);
         $pdf->Cell(0, 1, '', 'T', 1);
         
         $pdf->Ln(5);
         $pdf->Cell(50, 8, 'Client:', 0, 0, 'L');
         $pdf->Cell(0, 8, $user->name . ' (' . $user->email . ')', 0, 1);
         
         $pdf->Cell(50, 8, 'Terrain:', 0, 0, 'L');
         $pdf->Cell(0, 8, $reservation->terrain->name, 0, 1);
         
         $pdf->Cell(50, 8, 'Date:', 0, 0, 'L');
         $pdf->Cell(0, 8, $reservation->date_debut->format('d/m/Y'), 0, 1);
         
         $pdf->Cell(50, 8, 'Horaire:', 0, 0, 'L');
         $pdf->Cell(0, 8, $reservation->date_debut->format('H:i') . ' - ' . $reservation->date_fin->format('H:i'), 0, 1);
         
         $pdf->Cell(50, 8, 'Montant:', 0, 0, 'L');
         $pdf->Cell(0, 8, number_format($reservation->payment->amount, 2) . ' DH', 0, 1);
         
         $pdf->Cell(50, 8, 'Statut:', 0, 0, 'L');
         $pdf->SetTextColor(46, 204, 113);
         $pdf->Cell(0, 8, ucfirst($reservation->statut), 0, 1);
         $pdf->SetTextColor(0, 0, 0);
         
         $pdf->Ln(10);
     
         $pdf->SetFont('Arial', 'B', 14);
         $pdf->SetFillColor(240, 240, 240);
         $pdf->Cell(0, 10, 'Informations du Ticket', 0, 1, 'L', true);
         
         $pdf->SetFont('Arial', '', 12);
         $pdf->SetFillColor(255, 255, 255);
         $pdf->SetDrawColor(46, 204, 113);
         $pdf->Cell(0, 1, '', 'T', 1);
         
         $pdf->Ln(5);
         $pdf->Cell(50, 8, 'ID du Ticket:', 0, 0, 'L');
         $pdf->Cell(0, 8, $ticket->id, 0, 1);
         
         $pdf->Cell(50, 8, 'Prix:', 0, 0, 'L');
         $pdf->Cell(0, 8, number_format($ticket->price, 2) . ' DH', 0, 1);
         
         $pdf->Cell(50, 8, 'Statut:', 0, 0, 'L');
         // Définir les couleurs RVB dans des variables
         $statusColorR = $ticket->status === 'ouvert' ? 255 : 46;
         $statusColorG = $ticket->status === 'ouvert' ? 165 : 204;
         $statusColorB = $ticket->status === 'ouvert' ? 0 : 113;
         $pdf->SetTextColor($statusColorR, $statusColorG, $statusColorB);
         $pdf->Cell(0, 8, ucfirst($ticket->status), 0, 1);
         $pdf->SetTextColor(0, 0, 0);
     
         $fileName = 'ticket-reservation-' . $reservation->id . '.pdf';
         $filePath = storage_path('app/public/' . $fileName);
     
         if (!file_exists(storage_path('app/public'))) {
             mkdir(storage_path('app/public'), 0755, true);
         }
     
         $pdf->Output('F', $filePath);
     
         return response()->download($filePath, $fileName, [
             'Content-Type' => 'application/pdf',
         ])->deleteFileAfterSend(true);
     }
}
