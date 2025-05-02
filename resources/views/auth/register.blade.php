@extends('layouts.auth')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Créez un nouveau compte</h2>
            <p class="mt-2 text-sm text-gray-600">
                Déjà un compte ? 
                <a href="{{ route('login') }}" class="font-medium text-emerald-600 hover:text-emerald-700 transition duration-200">
                    Connectez-vous
                </a>
            </p>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Inscription</h3>
            </div>
            
            <div class="p-6">
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                @if (session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif
                
                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input id="name" name="name" type="text" autocomplete="name"  
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                               placeholder="Nom complet" value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                        <input id="email" name="email" type="email" autocomplete="email"  
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                               placeholder="Adresse e-mail" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" autocomplete="new-password"  
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                   focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                                   placeholder="Mot de passe">
                           
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                   autocomplete="new-password"  
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                   focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                                   placeholder="Confirmer le mot de passe">
                           
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                                class="w-full flex justify-center py-2 px-4 bg-emerald-600 border border-transparent 
                                rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none 
                                focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-200">
                            <i class="fas fa-user-plus mr-2 mt-1"></i> S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
