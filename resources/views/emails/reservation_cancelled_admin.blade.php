<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Annulation de Réservation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #10b981; color: white; padding: 10px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Annulation de Réservation - TerrainBooker</h1>
        </div>
        <div class="content">
            <p>Bonjour Admin,</p>
            <p>Un utilisateur a annulé une réservation sur TerrainBooker. Voici les détails :</p>
            <ul>
                <li><strong>Utilisateur :</strong> {{ $reservation->utilisateur->name ?? 'Utilisateur inconnu' }}</li>
                <li><strong>Terrain :</strong> {{ $reservation->terrain->name }}</li>
                <li><strong>Date de début :</strong> {{ $reservation->date_debut->format('d/m/Y H:i') }}</li>
                <li><strong>Date de fin :</strong> {{ $reservation->date_fin->format('d/m/Y H:i') }}</li>
                <li><strong>Statut de la reservation :</strong> {{ ucfirst($reservation->statut) }}</li>
                <li><strong>Statut du paiement :</strong> {{ ucfirst($reservation->payment_status) }}</li>
                @if ($refundProcessed)
                    <li><strong>Remboursement :</strong> Un remboursement de {{ $reservation->payment->amount }} DH a été effectué.</li>
                @else
                    <li><strong>Remboursement :</strong> Aucun remboursement n'a été effectué (paiement non trouvé ou non applicable).</li>
                @endif
            </ul>
            <p>Pour plus de détails, veuillez consulter le tableau de bord administrateur.</p>
        </div>
        <div class="footer">
        
        </div>
    </div>
</body>
</html>