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
                            <p><strong>Prix :</strong> {{ $terrain->prix }} €/heure</p>
                            <p><strong>Adresse :</strong> {{ $terrain->adresse }}</p>
                            <!-- Afficher les créneaux réservés -->
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