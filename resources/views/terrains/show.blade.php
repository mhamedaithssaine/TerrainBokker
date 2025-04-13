@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Détails du terrain</h1>

    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Informations du terrain</h2>
            <a href="{{ route('terrains.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="fas fa-arrow-left mr-2"></i> Retour
            </a>
        </div>

        <div class="p-6">
            <div class="mb-6">
                @if ($terrain->photo)
                    <img src="{{ Storage::url($terrain->photo) }}" alt="{{ $terrain->name }}"
                         class="w-full max-w-md mx-auto h-64 object-cover rounded-lg border border-gray-200 shadow-sm">
                @else
                    <div class="w-full max-w-md mx-auto h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 border border-gray-200 shadow-sm">
                        <i class="fas fa-image text-4xl"></i>
                    </div>
                @endif
            </div>

            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <p class="text-sm text-gray-500 font-medium ">Nom du terrain</p>
                <h2 class="text-lg font-medium text-gray-800 mb-4">{{ $terrain->name }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Type</p>
                        <p class="text-lg font-medium text-gray-800 mb-4">{{ $terrain->categorie->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Prix</p>
                        <p class="text-lg font-medium text-gray-800 mb-4">{{ number_format($terrain->prix, 2) }} DH</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Sponsor</p>
                        <p class="text-lg font-medium text-gray-800 mb-4">{{ $terrain->sponsor->name ?? 'Aucun' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Statut</p>
                        <p class="text-lg font-medium text-gray-800 mb-4 inline-flex items-center">
                            <span class="inline-block w-3 h-3 rounded-full {{ $terrain->statut === 'disponible' ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                            {{ ucfirst($terrain->statut) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Détails supplémentaires</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Adresse</p>
                            <p class="text-lg font-medium text-gray-800 mb-4">{{ $terrain->adresse }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Description</p>
                            <p class="text-lg font-medium text-gray-800 mb-4">{{ $terrain->description ?? 'Aucune description' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection