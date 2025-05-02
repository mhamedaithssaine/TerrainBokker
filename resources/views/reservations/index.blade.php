@extends('layouts.appHome')

@section('title', 'Mes Réservations')

@section('content')
    <div class="py-12 mt-12	">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4 text-emerald-600">Mes Réservations</h2>

                    @if (session('success'))
                        <div class="alert alert-success mb-4 bg-emerald-100 text-emerald-800 border-emerald-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-error mb-4 bg-red-100 text-red-800 border-red-300">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="alert alert-warning mb-4 bg-yellow-100 text-yellow-800 border-yellow-300">
                        <strong>Important :</strong> En cas d'annulation, seuls 60% du montant seront remboursés.
                    </div>
                    @if ($reservations->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr>
                                        <th>Terrain</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Horaire</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->terrain->name }}</td>
                                            <td>{{ $reservation->terrain->categorie->name }}</td>
                                            <td>
                                                {{ $reservation->date_debut->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                {{ $reservation->date_debut->format('H:i')  }}  - {{ $reservation->date_fin->format('H:i') }}
                                            </td>
                                            <td>{{ ucfirst($reservation->statut) }}</td>
                                           
                                            <td class="px-4 py-2 flex space-x-2">
                                                @if($reservation->statut === 'confirmée' && $reservation->payment_status === 'payé' )
                                                    <a href="{{ route('reservations.ticket', $reservation->id) }}" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                                                        Voir le Ticket
                                                    </a>
                                                @if ($reservation->canCancel)
                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="cancel-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">Annuler</button>
                                                </form>
                                                @endif
                                                        
                                                
                                                @else
                                                    <span class="text-gray-500 italic">En attente</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-600">Vous n'avez aucune réservation pour le moment.</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('home') }}" class="btn bg-emerald-500 text-white border-none hover:bg-emerald-600">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
