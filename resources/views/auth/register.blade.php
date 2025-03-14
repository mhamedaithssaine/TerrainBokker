@extends('layouts.auth')
@section('title', 'Inscription')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 bg-white rounded-xl shadow-2xl p-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Créer votre compte</h2>
            <p class="text-sm text-gray-500">Rejoignez notre communauté sportive</p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            
            <!-- Nom et Prénom -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input id="name" name="name" type="text" required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        placeholder="Votre nom">
                </div>
                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input id="prenom" name="prenom" type="text" required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        placeholder="Votre prénom">
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="vous@exemple.com">
            </div>

            <!-- Téléphone -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input id="telephone" name="telephone" type="tel" required 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="06 XX XX XX XX">
            </div>

            <!-- Adresse -->
            <div>
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="adresse" id="adresse" name="adresse" rows="2" required 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="Votre adresse complète">
            </div>

            <!-- Type de Rôle -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type de compte</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 shadow-sm focus:outline-none">
                        <input type="radio" name="role" value="sportif" class="sr-only" aria-labelledby="role-sportif">
                        <span class="flex flex-1">
                            <span class="flex flex-col">
                                <span id="role-sportif" class="block text-sm font-medium text-gray-900">Sportif</span>
                                <span class="mt-1 flex items-center text-sm text-gray-500">Participez aux événements</span>
                            </span>
                        </span>
                        <span class="pointer-events-none absolute -inset-px rounded-lg border-2 border-transparent peer-checked:border-green-500" aria-hidden="true"></span>
                    </label>
                    <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 shadow-sm focus:outline-none">
                        <input type="radio" name="role" value="organisateur" class="sr-only" aria-labelledby="role-organisateur">
                        <span class="flex flex-1">
                            <span class="flex flex-col">
                                <span id="role-organisateur" class="block text-sm font-medium text-gray-900">Organisateur</span>
                                <span class="mt-1 flex items-center text-sm text-gray-500">Créez des événements</span>
                            </span>
                        </span>
                        <span class="pointer-events-none absolute -inset-px rounded-lg border-2 border-transparent peer-checked:border-green-500" aria-hidden="true"></span>
                    </label>
                </div>
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input id="password" name="password" type="password" required 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="••••••••">
            </div>

            <!-- Confirmation mot de passe -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="••••••••">
            </div>

            <!-- Bouton de soumission -->
            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-green-500 group-hover:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Créer mon compte
                </button>
            </div>
        </form>

        <!-- Lien de connexion -->
        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-500 transition-colors duration-200">
                    Connectez-vous
                </a>
            </p>
        </div>
    </div>
</div>
@endsection