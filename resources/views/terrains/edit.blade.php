@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Modifier le terrain</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('terrains.update', $terrain->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du terrain</label>
                <input type="text" name="name" id="name" value="{{ old('name', $terrain->name) }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                       >
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="categorie_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select name="categorie_id" id="categorie_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                        >
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}"
                                {{ old('categorie_id', $terrain->categorie_id) == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->name }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="prix" class="block text-sm font-medium text-gray-700">Prix (€)</label>
                <input type="number" name="prix" id="prix" value="{{ old('prix', $terrain->prix) }}"
                       step="0.01" min="0"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                       >
                @error('prix')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sponsor_id" class="block text-sm font-medium text-gray-700">Sponsor (optionnel)</label>
                <select name="sponsor_id" id="sponsor_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value="">Aucun</option>
                    @foreach ($sponsors as $sponsor)
                        <option value="{{ $sponsor->id }}"
                                {{ old('sponsor_id', $terrain->sponsor_id) == $sponsor->id ? 'selected' : '' }}>
                            {{ $sponsor->name }}
                        </option>
                    @endforeach
                </select>
                @error('sponsor_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="statut" id="statut"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                        >
                    <option value="disponible" {{ old('statut', $terrain->statut) == 'disponible' ? 'selected' : '' }}>
                        Disponible
                    </option>
                    <option value="indisponible" {{ old('statut', $terrain->statut) == 'indisponible' ? 'selected' : '' }}>
                        Indisponible
                    </option>
                </select>
                @error('statut')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $terrain->adresse) }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                       >
                @error('adresse')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description (optionnel)</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">{{ old('description', $terrain->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo du terrain (optionnel)</label>
                <input type="file" name="photo" id="photo"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                @error('photo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

                @if ($terrain->photo)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Photo actuelle :</p>
                        <img src="{{ Storage::url($terrain->photo) }}" alt="{{ $terrain->name }}"
                             class="h-20 w-auto rounded-md">
                    </div>
                @endif
            </div>

            <div class="flex justify-between">
                <a href="{{ route('terrains.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-save mr-2"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
@endsection