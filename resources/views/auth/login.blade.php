@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Connectez-vous à votre compte</h2>
            <p class="mt-2 text-sm text-gray-600">
                Pas de compte ? 
                <a href="{{ route('register') }}" class="font-medium text-emerald-600 hover:text-emerald-700 transition duration-200">
                    Créez un nouveau compte
                </a>
            </p>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Connexion</h3>
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
                
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
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
                            <input id="password" name="password" type="password" autocomplete="current-password"  
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                   focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                                   placeholder="Mot de passe">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox" 
                                   class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                Se souvenir de moi
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" 
                               class="font-medium text-emerald-600 hover:text-emerald-700 transition duration-200">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                                class="w-full flex justify-center py-2 px-4 bg-emerald-600 border border-transparent 
                                rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none 
                                focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-200">
                            <i class="fas fa-sign-in-alt mr-2 mt-1"></i> Se connecter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

