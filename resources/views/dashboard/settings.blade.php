@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Paramètres</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('dashboard.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Notifications -->
            <div class="mb-4">
                <label for="notifications" class="flex items-center space-x-2">
                    <input type="checkbox" name="notifications" id="notifications" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" {{ session('notifications', $settings['notifications']) ? 'checked' : '' }}>
                    <span class="text-sm font-medium text-gray-700">Activer les notifications</span>
                </label>
            </div>


            <!-- Langue -->
            <div class="mb-4">
                <label for="language" class="block text-sm font-medium text-gray-700">Langue</label>
                <select name="language" id="language" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="fr" {{ session('language', $settings['language']) === 'fr' ? 'selected' : '' }}>Français</option>
                    <option value="en" {{ session('language', $settings['language']) === 'en' ? 'selected' : '' }}>Anglais</option>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
@endsection