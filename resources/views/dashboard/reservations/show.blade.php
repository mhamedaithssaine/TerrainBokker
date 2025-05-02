@extends('layouts.dashboard')

@section('title', 'TerrainBokker - Détails de la réservation')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Détails de la réservation</h1>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informations de la réservation</h3>
                <div class="space-y-4">
                    <div>
                        @if ($reservation->trashed())
                            <p class="text-sm text-red-600">
                                Cette réservation a été supprimée le {{ $reservation->deleted_at->format('d/m/Y H:i') }}.
                            </p>
                        @endif
                        <p class="text-sm font-medium text-gray-900">Client</p>
                        @if($reservation->utilisateur)
                            <p class="text-sm text-gray-600">{{ $reservation->utilisateur->name }}</p>
                            <p class="text-sm text-gray-600">{{ $reservation->utilisateur->email }}</p>
                        @else
                            <p class="text-sm text-gray-600 italic">Utilisateur inconnu</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Terrain</p>
                        <p class="text-sm text-gray-600">{{ $reservation->terrain ? $reservation->terrain->name : 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Date</p>
                        <p class="text-sm text-gray-600">{{ $reservation->date_debut->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Horaire</p>
                        <p class="text-sm text-gray-600">{{ $reservation->date_debut->format('H:i') }} - {{ $reservation->date_fin->format('H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Statut de la réservation</p>
                        @if ($reservation->trashed())
                            <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-full">
                                Supprimée
                            </span>
                        @elseif ($reservation->statut === 'confirmée' && $reservation->payment_status === 'payé')
                            <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full">
                                Confirmée
                            </span>
                        @elseif ($reservation->statut === 'annulée' && $reservation->payment_status === 'remboursé')
                            <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">
                                Remboursée
                            </span>
                        @elseif ($reservation->statut === 'en attente' && $reservation->payment_status === 'pending')
                            <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">
                                En attente
                            </span>
                        @elseif ($reservation->statut === 'annulée' && $reservation->payment_status === 'échoué')
                            <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-full">
                                Annulée
                            </span>
                        @else
                            <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-gray-100 text-gray-800 rounded-full">
                                {{ ucfirst($reservation->statut) }}
                            </span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Montant</p>
                        <p class="text-sm text-gray-600">{{ $reservation->payment ? number_format($reservation->payment->amount, 2) . ' DH' : 'N/A' }}</p>
                    </div>
                    @if($reservation->payment)
                        <div>
                            <p class="text-sm font-medium text-gray-900">Statut du paiement</p>
                            @if($reservation->payment->trashed())
                                <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-full">
                                    Supprimé ({{ $reservation->payment->deleted_at->format('d/m/Y H:i') }})
                                </span>
                            @elseif($reservation->payment->status === 'success')
                                <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full">
                                    Payé
                                </span>
                            @elseif($reservation->payment->status === 'pending')
                                <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">
                                    En attente
                                </span>
                            @elseif($reservation->payment->status === 'failed')
                                <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-full">
                                    Échoué
                                </span>
                            @elseif($reservation->payment->status === 'refunded')
                                <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">
                                    Remboursé
                                </span>
                            @else
                                <span class="text-sm text-gray-600 inline-flex items-center px-2 py-1 bg-gray-100 text-gray-800 rounded-full">
                                    Inconnu
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Image du terrain</h3>
                @if ($reservation->terrain && $reservation->terrain->photo)
                    <img src="{{ asset('storage/' . $reservation->terrain->photo) }}" alt="{{ $reservation->terrain->name }}" class="w-full h-64 object-cover rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                        <p class="text-sm text-gray-600">Aucune image disponible</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-6">
            <a href="{{ route('dashboard.reservations.index') }}"    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="fas fa-arrow-left mr-2"></i>
            </a>
        </div>
    </div>
@endsection