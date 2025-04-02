@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Détails de l'utilisateur</h1>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center space-x-6 mb-6">
            @if ($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Photo de profil" class="w-24 h-24 rounded-full object-cover">
            @else
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                    <i class="fas fa-user text-3xl"></i>
                </div>
            @endif
            <div>
                <h2 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
                <p>{{ ucfirst(optional($user->roles->first())->name) ?? 'Aucun role' }}</p>       
                 </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('users.index') }}" 
            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            <i class="fas fa-arrow-left mr-2"></i>
            </a>
          
        </div>
    </div>
@endsection
