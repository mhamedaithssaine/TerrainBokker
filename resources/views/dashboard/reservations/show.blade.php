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
                           <p class="text-sm font-medium text-gray-900">Client</p>
                           <p class="text-sm text-gray-600">{{ $reservation->utilisateur->name }}</p>
                           <p class="text-sm text-gray-600">{{ $reservation->utilisateur->email }}</p>
                       </div>
                       <div>
                           <p class="text-sm font-medium text-gray-900">Terrain</p>
                           <p class="text-sm text-gray-600">{{ $reservation->terrain->name }}</p>
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
                           <p class="text-sm font-medium text-gray-900">Statut</p>
                           <p class="text-sm text-gray-600">{{ ucfirst($reservation->statut) }}</p>
                       </div>
                       <div>
                           <p class="text-sm font-medium text-gray-900">Montant</p>
                           <p class="text-sm text-gray-600">{{ $reservation->payment ? number_format($reservation->payment->amount, 2) . ' DH' : 'N/A' }}</p>
                       </div>
                   </div>
               </div>
               <div>
                   <h3 class="text-lg font-semibold text-gray-800 mb-4">Image du terrain</h3>
                   @if ($reservation->terrain->photo)
                       <img src="{{ asset('storage/' . $reservation->terrain->photo) }}" alt="{{ $reservation->terrain->name }}" class="w-full h-64 object-cover rounded-lg">
                   @else
                       <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                           <p class="text-sm text-gray-600">Aucune image disponible</p>
                       </div>
                   @endif
               </div>
           </div>
       </div>
   @endsection