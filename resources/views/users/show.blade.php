@extends('layouts.dashboard')
@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Détails de l'utilisateur</h1>
    
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Informations personnelles</h2>
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="fas fa-arrow-left mr-2"></i>
                
            </a>
        </div>
        
        <div class="p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="flex items-center space-x-6 mb-6">
                @if ($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Photo de profil" class="w-24 h-24 rounded-full object-cover border-2 border-emerald-500">
                @else
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 border-2 border-gray-300">
                        <i class="fas fa-user text-3xl"></i>
                    </div>
                @endif
                
                <div class="bg-gray-50 p-4 rounded-lg flex-grow">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $user->name }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-gray-700">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Rôle</p>
                            <p class="text-gray-700 inline-flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-emerald-500 mr-2"></span>
                                {{ ucfirst(optional($user->roles->first())->name) ?? 'Aucun rôle' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Modifier le rôle</h3>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                <form action="{{ route('users.update-role', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <div class="relative">
                        <select 
                            name="role" 
                            onchange="this.form.submit()" 
                            class="appearance-none block w-full pl-3 pr-10 py-2.5 text-base border-2 border-emerald-500 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md font-medium shadow-sm text-gray-800"
                        >
                            @foreach(App\Models\Role::all() as $role)
                                <option 
                                    value="{{ $role->name }}" 
                                    {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}
                                    class="py-2 font-medium"
                                >
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection