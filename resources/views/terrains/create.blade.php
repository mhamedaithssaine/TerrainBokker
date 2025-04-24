@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Ajouter un terrain</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('terrains.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Champ Nom -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du terrain</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Catégorie -->
            <div class="mb-4">
                <label for="categorie_id" class="block text-sm font-medium text-gray-700">type</label>
                <select name="categorie_id" id="categorie_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                    <option value="{{ old('categorie') }}">Sélectionnez une type </option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Prix -->
            <div class="mb-4">
                <label for="prix" class="block text-sm font-medium text-gray-700">Prix (DH)</label>
                <input type="number" step="0.01" name="prix" id="prix" value="{{ old('prix') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                @error('prix')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

           <!-- Champ Tags -->
            <div class="mb-4">
                <label for="tag_ids" class="block text-sm font-medium text-gray-700">Tags (optionnel)</label>
                <select name="tag_ids[]" id="tag_ids" multiple
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tag_ids', [])) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                </select>
                @error('tag_ids')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
                <small class="text-gray-500">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs tags.</small>
            </div>

            <!-- Champ Statut -->
            <div class="mb-4">
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="statut" id="statut"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                    <option value="disponible">Disponible</option>
                    <option value="indisponible">Indisponible</option>
                </select>
                @error('statut')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Photo -->
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo (optionnel)</label>
                <input type="file" name="photo" id="photo"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                @error('photo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Adresse -->
            <div class="mb-4">
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                @error('adresse')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description (optionnel)</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('terrains.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-save mr-2"></i>
                    Crée
                </button>
            </div>
        </form>
    </div>
@endsection