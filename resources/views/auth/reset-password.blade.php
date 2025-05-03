@extends('layouts.auth')

@section('title', 'Réinitialisation du mot de passe')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Réinitialiser votre mot de passe</h2>
            <p class="mt-2 text-sm text-gray-600">
                Veuillez créer un nouveau mot de passe sécurisé
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
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                           focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                           placeholder="Nouveau mot de passe">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" 
                           autocomplete="new-password" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                           focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                           placeholder="Confirmer le nouveau mot de passe">
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 bg-emerald-600 border border-transparent 
                            rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-200">
                        <i class="fas fa-lock mr-2 mt-1"></i> Réinitialiser le mot de passe
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