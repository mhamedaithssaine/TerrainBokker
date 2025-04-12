@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Votre profil</h1>
        
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Informations personnelles</h2>
            </div>
            
            <div class="p-6">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                <div class="flex items-center space-x-6 mb-6">
                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Photo de profil" class="w-24 h-24 rounded-full object-cover border-2 border-emerald-500">
                    @else
                        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 border-2 border-gray-300">
                            <i class="fas fa-user text-3xl"></i>
                        </div>
                    @endif
                    
                    <div class="bg-gray-50 p-4 rounded-lg flex-grow">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ Auth::user()->name }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="text-gray-700">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Date d'inscription</p>
                                <p class="text-gray-700">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                            </div>
                            @if (Auth::user()->roles->isNotEmpty())
                            <div>
                                <p class="text-sm text-gray-500">Rôle</p>
                                <p class="text-gray-700 inline-flex items-center">
                                    <span class="inline-block w-3 h-3 rounded-full bg-emerald-500 mr-2"></span>
                                    {{ ucfirst(Auth::user()->roles->first()->name) ?? 'Aucun rôle' }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <a href="{{ route('profile.edit') }}" 
                       class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <i class="fas fa-edit mr-2"></i> Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection