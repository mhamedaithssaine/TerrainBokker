@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Votre profil
            </h2>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                    <p class="mt-1 text-sm text-gray-900">Mhamed </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-sm text-gray-900">mhamedaithssaine1@gmail</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Date d'inscription</label>
                    <p class="mt-1 text-sm text-gray-900">10/10/2000</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('profile.edit') }}" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Modifier le profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection