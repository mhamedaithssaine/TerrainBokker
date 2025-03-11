@extends('layouts.app')

@section('title', 'Modifier le profil')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Modifier votre profil
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="" method="POST">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div>
                <label for="name" class="sr-only">Nom</label>
                <input id="name" name="name" type="text" required 
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                    placeholder="Nom complet" value="">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="sr-only">Email</label>
                <input id="email" name="email" type="email" required 
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                    placeholder="Adresse email" value="">
            </div>

            <!-- Mot de passe actuel (pour confirmation) -->
            <div>
                <label for="current_password" class="sr-only">Mot de passe actuel</label>
                <input id="current_password" name="current_password" type="password" required 
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                    placeholder="Mot de passe actuel">
            </div>

            <!-- Nouveau mot de passe -->
            <div>
                <label for="password" class="sr-only">Nouveau mot de passe</label>
                <input id="password" name="password" type="password" 
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                    placeholder="Nouveau mot de passe">
            </div>

            <!-- Confirmation du nouveau mot de passe -->
            <div>
                <label for="password_confirmation" class="sr-only">Confirmez le mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" 
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                    placeholder="Confirmez le mot de passe">
            </div>

            <!-- Bouton de soumission -->
            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection