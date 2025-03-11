@extends('layouts.auth')
@section('title', 'Réinitialisation du mot de passe')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Réinitialiser votre mot de passe
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Entrez votre nouveau mot de passe pour réinitialiser votre compte.
            </p>
        </div>
        <form class="mt-8 space-y-6" action="" method="POST">
            @csrf
            <!-- Token de réinitialisation (caché) -->
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="rounded-md shadow-sm -space-y-px">
                <!-- Email -->
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                        placeholder="Adresse email" value="{{ $email ?? old('email') }}">
                </div>
                <!-- Nouveau mot de passe -->
                <div>
                    <label for="password" class="sr-only">Nouveau mot de passe</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                        placeholder="Nouveau mot de passe">
                </div>
                <!-- Confirmation du nouveau mot de passe -->
                <div>
                    <label for="password_confirmation" class="sr-only">Confirmez le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                        placeholder="Confirmez le mot de passe">
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Réinitialiser le mot de passe
                </button>
            </div>
        </form>
        <div class="text-center">
            <p class="mt-2 text-sm text-gray-600">
                Vous vous souvenez de votre mot de passe ? 
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Connectez-vous
                </a>
            </p>
        </div>
    </div>
</div>
@endsection