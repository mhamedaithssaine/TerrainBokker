@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Créer un Permission</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du Permission</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" >
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>

           
            <div class="flex justify-between">
                <a href="{{ route('permissions.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="fas fa-arrow-left mr-2"></i>
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