@extends('layouts.auth')
@section('title', 'Connexion')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="bg-green-600 p-6">
            <h2 class="text-center text-3xl font-bold text-white">
                TerrainBooker
            </h2>
            <p class="mt-2 text-center text-sm text-white opacity-90">
                Réservez votre terrain en quelques clics
            </p>
        </div>
        
        <div class="p-8 space-y-6">
            <div>
                <h3 class="text-center text-xl font-semibold text-gray-800">
                    Connectez-vous à votre compte
                </h3>
            </div>
            
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required 
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                            placeholder="Votre adresse email">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input id="password" name="password" type="password" required 
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                            placeholder="Votre mot de passe">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" 
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-green-600 hover:text-green-500">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-green-500 group-hover:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Se connecter
                    </button>
                </div>
            </form>
            
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-500">
                        Créer un compte
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection