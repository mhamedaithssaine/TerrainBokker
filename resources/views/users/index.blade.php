@extends('layouts.dashboard')
@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">Liste des Utilisateur</h1>

<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Users</h2>
        <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
            <i class="fas fa-plus mr-2"></i> 
            Créer un Organisatuer
        </a>
    </div>
@endsection