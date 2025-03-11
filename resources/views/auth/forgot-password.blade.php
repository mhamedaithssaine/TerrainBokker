@extends('layouts.auth')
@section('title', 'Mot de passe oublié')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Mot de passe oublié ?
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Entrez votre adresse e-mail pour réinitialiser votre mot de passe.
            </p>
        </div>
        <form class="mt-8 space-y-6"  method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <!-- Email -->
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                        placeholder="Adresse email">
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Envoyer le lien de réinitialisation
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