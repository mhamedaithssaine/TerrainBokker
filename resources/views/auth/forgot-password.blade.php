@extends('layouts.auth')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Réinitialisation du mot de passe</h2>
            <p class="mt-2 text-sm text-gray-600">
                Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow p-6">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('password.email') }}" method="POST">
                @csrf

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

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 bg-emerald-600 border border-transparent 
                            rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-200">
                        <i class="fas fa-envelope mr-2 mt-1"></i> Envoyer le lien de réinitialisation
                    </button>
                </div>

                <div class="text-sm text-center">
                    <a href="{{ route('login') }}" class="font-medium text-emerald-600 hover:text-emerald-700 transition duration-200">
                        Retour à la connexion
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection