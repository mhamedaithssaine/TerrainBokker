@extends('layouts.auth')
@section('title', 'Réinitialisation du mot de passe')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Réinitialiser votre mot de passe
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Veuillez créer un nouveau mot de passe sécurisé
            </p>
        </div>

        <!-- Affichage des messages de statut -->
        @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
        @endif

        <!-- Affichage des erreurs générales -->
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulaire de réinitialisation de mot de passe -->
        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            
            <div class="rounded-md shadow-sm -space-y-px">
                <!-- Champ pour le nouveau mot de passe -->
                <div>
                    <label for="password" class="sr-only">Nouveau mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="appearance-none rounded-t-md relative block w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 
                           focus:border-indigo-500 focus:z-10 sm:text-sm" 
                           placeholder="Nouveau mot de passe">
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Champ pour la confirmation du nouveau mot de passe -->
                <div>
                    <label for="password_confirmation" class="sr-only">Confirmer le nouveau mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" 
                           autocomplete="new-password" required 
                           class="appearance-none rounded-b-md relative block w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 
                           focus:border-indigo-500 focus:z-10 sm:text-sm" 
                           placeholder="Confirmer le nouveau mot de passe">
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm 
                        font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" 
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                             aria-hidden="true">
                            <path fill-rule="evenodd" 
                                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" 
                                  clip-rule="evenodd" />
                        </svg>
                    </span>
                    Réinitialiser le mot de passe
                </button>
            </div>
            
            <!-- Lien pour retourner à la connexion -->
            <div class="text-sm text-center">
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Retour à la connexion
                </a>
            </div>
        </form>
    </div>
</div>
@endsection