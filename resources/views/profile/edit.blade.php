@extends('layouts.app')

@section('title', 'Modifier le profil')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Modifier votre profil</h1>
        
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Mettre à jour les informations</h2>
            </div>
            
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo -->
                    <div class="mb-6">
                        <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-2">Photo de profil</label>
                        <div class="flex items-center space-x-4">
                            @if (Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Photo de profil" class="w-16 h-16 rounded-full object-cover border-2 border-emerald-500">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 border-2 border-gray-300">
                                    <i class="fas fa-user text-xl"></i>
                                </div>
                            @endif
                            <input id="profile_photo" name="profile_photo" type="file" 
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        </div>
                        @error('profile_photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input id="name" name="name" type="text" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                               value="{{ Auth::user()->name ?? '' }}" placeholder="Nom complet">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                               value="{{ Auth::user()->email ?? '' }}" placeholder="Adresse email">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Password -->
                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        
                        <input id="" name="current_password" type="password" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                               placeholder="Mot de passe actuel">
                               
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe (facultatif)</label>
                        <input id="password" name="password" type="password" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                               placeholder="Nouveau mot de passe">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmez le nouveau mot de passe</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                               placeholder="Confirmez le mot de passe">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            <i class="fas fa-save mr-2"></i>  Mettre à joure
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection