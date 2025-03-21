@extends('layouts.auth')
@section('title', 'Inscription')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Créez un nouveau compte
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Ou
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    connectez-vous à votre compte existant
                </a>
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="name" class="sr-only">Nom complet</label>
                    <input id="name" name="name" type="text" autocomplete="name" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 
                           focus:border-indigo-500 focus:z-10 sm:text-sm" 
                           placeholder="Nom complet" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="email" class="sr-only">Adresse e-mail</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 
                           focus:border-indigo-500 focus:z-10 sm:text-sm" 
                           placeholder="Adresse e-mail" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">Mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 
                           focus:border-indigo-500 focus:z-10 sm:text-sm" 
                           placeholder="Mot de passe">
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="sr-only">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" 
                           autocomplete="new-password" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 
                           focus:border-indigo-500 focus:z-10 sm:text-sm" 
                           placeholder="Confirmer le mot de passe">
                </div>
            </div>

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
                                  d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" 
                                  clip-rule="evenodd" />
                        </svg>
                    </span>
                    S'inscrire
                </button>
            </div>
        </form>
    </div>
</div>
@endsection