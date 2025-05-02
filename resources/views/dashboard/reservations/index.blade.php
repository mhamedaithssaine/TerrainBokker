@extends('layouts.dashboard')

   @section('title', 'TerrainBokker - Toutes les réservations')

   @section('content')
       <h1 class="text-2xl font-semibold text-gray-800 mb-6">Toutes les réservations</h1>
       <div class="bg-white rounded-lg shadow mb-6">
           <div class="p-4 border-b border-gray-200">
               <h2 class="text-lg font-semibold text-gray-800">Réservations</h2>
           </div>
           <div class="p-4 overflow-x-auto">
               @if ($reservations->count())
                   <table class="min-w-full divide-y divide-gray-200">
                       <thead class="bg-gray-50">
                           <tr>
                               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terrain</th>
                               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horaire</th>
                               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                           </tr>
                       </thead>
                       <tbody class="bg-white divide-y divide-gray-200">
                           @foreach ($reservations as $reservation)
                               <tr>
                                   <td class="px-6 py-4 whitespace-nowrap">
                                       <div class="flex items-center">
                                           <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                               <span class="text-xs font-medium">{{ strtoupper(substr($reservation->utilisateur->name, 0, 2)) }}</span>
                                           </div>
                                           <div class="ml-4">
                                               <div class="text-sm font-medium text-gray-900">{{ $reservation->utilisateur->name }}</div>
                                               <div class="text-sm text-gray-500">{{ $reservation->utilisateur->email }}</div>
                                           </div>
                                       </div>
                                   </td>
                                   <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->terrain->name }}</td>
                                   <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->date_debut->format('d/m/Y') }}</td>
                                   <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->date_debut->format('H:i') }} - {{ $reservation->date_fin->format('H:i') }}</td>
                                   <td class="px-6 py-4 whitespace-nowrap">
                                       @if ( $reservation->statut == 'confirmée' && $reservation->payment_status === 'payé')
                                           <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmée</span>
                                       @elseif ( $reservation->statut === 'annulée' && $reservation->payment_status === 'remboursé' )
                                           <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"> Remboursé </span>
                                       @elseif ( $reservation->statut === 'en attente' && $reservation->payment_status === 'pending' )
                                           <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"> En attente </span>
                                       @elseif ($reservation->statut === 'annulée' && $reservation->payment_status === 'échoué')
                                           <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">  Annulée </span>
                                       @endif
                                   </td>
                                   <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->payment ? number_format($reservation->payment->amount, 2) . ' DH' : 'N/A' }}</td>
                                   <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                       <a href="{{ route('dashboard.reservations.show', $reservation->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Détails</a>
                                   </td>
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <div class="mt-4 px-4">
                       {{ $reservations->links() }}
                   </div>
               @else
                   <p class="text-sm text-gray-600">Aucune réservation trouvée.</p>
               @endif
           </div>
       </div>
   @endsection