@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Créer un Sponsor</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('sponsors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Champ Nom -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du Sponsor</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Logo -->
            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium text-gray-700">Logo du Sponsor</label>
                <input type="file" name="logo" id="logo"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                @error('logo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
@endsection