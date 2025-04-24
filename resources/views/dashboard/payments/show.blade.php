@extends('layouts.dashboard')

@section('title', 'TerrainBokker - Détails du paiement')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Détails du paiement</h1>

    <div class="bg-gray-50 rounded-lg shadow-sm p-6 border border-indigo-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informations du paiement</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Client</p>
                        <p class="text-sm text-gray-700">
                            {{ $payment->reservation && $payment->reservation->utilisateur ? $payment->reservation->utilisateur->name : 'Utilisateur inconnu' }}
                        </p>
                        <p class="text-sm text-gray-700">
                            {{ $payment->reservation && $payment->reservation->utilisateur ? $payment->reservation->utilisateur->email : 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Email</p>
                        <p class="text-sm text-gray-700">
                            {{ $payment->reservation && $payment->reservation->utilisateur ? $payment->reservation->utilisateur->email : 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Montant</p>
                        <p class="text-sm text-gray-700">{{ number_format($payment->amount, 2) }} DH</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Date</p>
                        <p class="text-sm text-gray-700">{{ $payment->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Statut</p>
                        <span class="@if($payment->status === 'success') bg-green-100 text-green-800 @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800 @elseif($payment->status === 'failed') bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                            @if ($payment->status === 'success')
                                Payé
                            @elseif ($payment->status === 'pending')
                                En attente
                            @elseif ($payment->status === 'failed')
                                Annulé
                            @else
                                {{ ucfirst($payment->status) }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Réservation associée</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Terrain</p>
                        <p class="text-sm text-gray-700">{{ $payment->reservation ? $payment->reservation->terrain->name : 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Date</p>
                        <p class="text-sm text-gray-700">{{ $payment->reservation ? $payment->reservation->date_debut->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Horaire</p>
                        <p class="text-sm text-gray-700">
                            {{ $payment->reservation ? $payment->reservation->date_debut->format('H:i') . ' - ' . $payment->reservation->date_fin->format('H:i') : 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Statut de la réservation</p>
                        <span class="@if($payment->reservation && $payment->reservation->statut === 'confirmée') bg-green-100 text-green-800 @elseif($payment->reservation && $payment->reservation->statut === 'en attente') bg-yellow-100 text-yellow-800 @elseif($payment->reservation && $payment->reservation->statut === 'annulée') bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                            {{ $payment->reservation ? ucfirst($payment->reservation->statut) : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection