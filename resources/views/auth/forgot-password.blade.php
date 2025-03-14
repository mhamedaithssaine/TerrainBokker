@extends('layouts.auth')
@section('title', 'Mot de passe oublié')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-center text-3xl font-bold text-gray-900">Réinitialiser le mot de passe</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Entrez votre adresse e-mail pour recevoir un lien de réinitialisation du mot de passe.</p>
        </div>
        <form class="p-6 space-y-4" action="{{ route('') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required 
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                    placeholder="Votre adresse email">
            </div>
            <div>
                <button type="submit" 
                    class="w-full py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Envoyer le lien de réinitialisation
                </button>
            </div>
        </form>
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-500">
                    Connectez-vous
                </a>
            </p>
        </div>
    </div>
</div>
@endsection