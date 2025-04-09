@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Ajouter un nouveau terrain</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="" method="POST">
            
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom du terrain</label>
                <input type="text" name="nom" id="nom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
            </div>
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type de terrain</label>
                <input type="text" name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
            </div>
            <div class="mb-4">
                <label for="capacite" class="block text-sm font-medium text-gray-700">Capacité</label>
                <input type="text" name="capacite" id="capacite" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
            </div>
            <div class="mb-4">
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="statut" id="statut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                    <option value="disponible">Disponible</option>
                    <option value="en maintenance">En maintenance</option>
                    <option value="réservé">Réservé</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-save mr-2"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
@endsection