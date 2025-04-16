@extends('layouts.appHome')

@section('title', 'Accueil')

@section('content')
@if (session('success'))
<div class="alert alert-success mb-4 bg-emerald-100 text-emerald-800 border-emerald-300">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-error mb-4 bg-red-100 text-red-800 border-red-300">
    {{ session('error') }}
</div>
@endif

    <!-- Hero Section -->
    <section id="accueil" class="hero min-h-[70vh]" style="background-image: url('https://picsum.photos/id/1058/1920/1080');">
        <div class="hero-overlay bg-black bg-opacity-60"></div>
        <div class="hero-content text-center text-white">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">TerrainBooker</h1>
                <p class="mb-5">Réservez facilement votre terrain de sport en quelques clics.</p>
                @auth
                    <a href="#terrains" class="btn bg-primary text-white border-none hover:bg-secondary">Réserver maintenant</a>
                @else
                    <a href="{{ route('login') }}" class="btn bg-primary text-white border-none hover:bg-secondary">Connectez-vous pour réserver</a>
                @endauth
            </div>
        </div>
    </section>
            <!--Filtrage and search  -->
            <section class="py-8 bg-gray-50">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold mb-6 text-center text-secondary">Trouvez votre terrain idéal</h2>
                    <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-center bg-white p-6 rounded-lg shadow-md">
                        <div class="relative w-full md:w-1/4">
                            <label for="search" class="block text-sm font-medium text-gray-600 mb-1">Nom ou Adresse</label>
                            <div class="flex items-center">
                                <span class="absolute left-3 top-9 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </span>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Rechercher un terrain..." class="input input-bordered w-full pl-10 rounded-full border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-20 transition">
                            </div>
                        </div>
            
                        <div class="relative w-full md:w-1/4">
                            <label for="categorie" class="block text-sm font-medium text-gray-600 mb-1">Type de terrain</label>
                            <div class="flex items-center">
                                <span class="absolute left-3 top-9 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    </svg>
                                </span>
                                <select name="categorie" id="categorie" class="select select-bordered w-full pl-10 rounded-full border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-20 transition">
                                    <option value="">Tous les types</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
            
                        <div class="relative w-full md:w-1/4">
                            <label for="prix_max" class="block text-sm font-medium text-gray-600 mb-1">Prix max (DH/h)</label>
                            <div class="flex items-center">
                                <span class="absolute left-3 top-9 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </span>
                                <input type="number" name="prix_max" id="prix_max" value="{{ request('prix_max') }}" placeholder="Prix max" min="0" step="1" class="input input-bordered w-full pl-10 rounded-full border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-20 transition">
                            </div>
                        </div>
            
                        <div class="w-full md:w-auto flex items-center space-x-3">
                            <button type="submit" class="btn bg-primary text-white border-none hover:bg-secondary rounded-full px-6 py-2 transition transform hover:scale-105">Filtrer</button>
                            <a href="{{ route('home') }}" class="btn bg-gray-200 text-gray-700 border-none hover:bg-gray-300 rounded-full px-6 py-2 transition transform hover:scale-105">Réinitialiser</a>
                        </div>
                    </form>
                </div>
            </section>
    <!-- Terrains Section -->
    <section id="terrains" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-secondary">Nos Terrains</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($terrains as $terrain)
                    <div class="card bg-base-100 shadow-xl">
                        <figure>
                            <img src="{{ asset('storage/' . $terrain->photo) }}" width="100%" alt="{{ $terrain->name }}" />
                        </figure>
                        <div class="card-body">
                            <h3 class="card-title">{{ $terrain->name }}</h3>
                            <p>{{ $terrain->description }}</p>
                            <p><strong>Type :</strong> {{ $terrain->categorie->name }}</p>
                            <p><strong>Prix :</strong> {{ $terrain->prix }} dh/heure</p>
                            <p><strong>Adresse :</strong> {{ $terrain->adresse }}</p>

                            @auth
                            @if (isset($reservations[$terrain->id]) && $reservations[$terrain->id]->isNotEmpty())
                            <p><strong>Créneaux réservés :</strong></p>
                            <ul class="list-disc pl-5">
                                @foreach ($reservations[$terrain->id] as $reservation)
                                    <li>{{ $reservation->date_debut->format('d/m/Y H:i') }} - {{ $reservation->date_fin->format('d/m/Y H:i') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p><strong>Disponibilité :</strong> Aucun créneau réservé pour le moment.</p>
                        @endif
                            @endauth
                           
                            <div class="card-actions justify-end">
                                @auth
                                    <a href="{{ route('reservations.create', $terrain->id) }}" class="btn bg-primary text-white border-none hover:bg-secondary">Réserver</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn bg-primary text-white border-none hover:bg-secondary">Connectez-vous pour réserver</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Aucun terrain disponible pour le moment.</p>
                @endforelse
            </div>
            <div class="mt-8 flex justify-center">
                {{ $terrains->links() }}
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section>
        <!-- À remplir plus tard -->
    </section>
@endsection