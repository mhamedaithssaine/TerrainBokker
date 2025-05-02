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
    <section id="accueil" class="hero min-h-[80vh]" style="background-image: url('{{ asset('storage/backgrounde/terrain2.jpg') }}')">
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
    <section id="terrains" class="py-16 bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-extrabold text-center mb-12 text-emerald-600 tracking-tight">Nos Terrains</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($terrains as $terrain)
                    <div class="relative group bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $terrain->photo) }}" alt="{{ $terrain->name }}" class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-105"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $terrain->name }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $terrain->description }}</p>
                            <div class="space-y-2 text-gray-700">
                                <p><strong>Type :</strong> {{ $terrain->categorie->name }}</p>
                                <p><strong>Prix :</strong> {{ $terrain->prix }} dh/heure</p>
                                <p><strong>Adresse :</strong> {{ $terrain->adresse }}</p>
                                <p>
                                   
                                    @if($terrain->tags->isNotEmpty())
                                        @foreach($terrain->tags as $tag)
                                            <span class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-sm px-4 py-2 rounded-full shadow-sm hover:shadow-md transition-shadow duration-300 mr-2">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-sm px-4 py-2 rounded-full shadow-sm hover:shadow-md transition-shadow duration-300">
                                            Aucun
                                        </span>
                                    @endif
                                </p>
                            </div>
    
                            @auth
                                @if (isset($reservations[$terrain->id]) && $reservations[$terrain->id]->isNotEmpty())
                                    <div class="mt-4">
                                        <p class="text-sm font-semibold text-red-600"><strong>Créneaux réservés :</strong></p>
                                        <ul class="list-disc pl-5 text-gray-600 text-sm mt-2 space-y-1">
                                            @foreach ($reservations[$terrain->id] as $reservation)
                                                <li>{{ $reservation->date_debut->format('d/m/Y H:i') }} - {{ $reservation->date_fin->format('H:i') }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <p class="mt-4 text-sm font-semibold"><strong class="text-emerald-600">Disponibilité :</strong> Aucun créneau réservé pour le moment.</p>
                                @endif
                            @endauth
    
                            <!-- Action Button -->
                            <div class="mt-6 flex justify-end">
                                @auth
                                    <a href="{{ route('reservations.create', $terrain->id) }}" class="inline-block px-6 py-2 bg-emerald-500 text-white font-semibold rounded-lg shadow-md hover:bg-emerald-600 transition-colors duration-300">Réserver</a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-emerald-500 text-white font-semibold rounded-lg shadow-md hover:bg-emerald-600 transition-colors duration-300">Connectez-vous pour réserver</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600 text-lg">Aucun terrain disponible pour le moment.</p>
                @endforelse
            </div>
            <div class="mt-12 flex justify-center">
                {{ $terrains->links('pagination::tailwind') }}
            </div>
        </div>
    </section>

 
<!-- Feedback Section -->
<section id="feedback" class="py-10 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-6 text-secondary">Avis de nos utilisateurs</h2>

        @auth
        <div class="bg-white p-5 rounded-lg shadow-md mb-6 max-w-lg mx-auto">
            <h3 class="text-lg font-semibold mb-3 text-gray-800">Laissez votre avis</h3>
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="note" class="block text-sm font-medium text-gray-600 mb-1">Note (1 à 5)</label>
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-star text-xl text-gray-300 hover:text-yellow-400 cursor-pointer transition-colors duration-200 transform hover:scale-110" data-value="{{ $i }}" onclick="rate(this)"></i>
                        @endfor
                    </div>
                    <input type="hidden" name="note" id="note" value="">
                    @error('note')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="commentaire" class="block text-sm font-medium text-gray-600 mb-1">Votre commentaire</label>
                    <textarea name="commentaire" id="commentaire" rows="3" class="textarea textarea-bordered w-full border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-20 transition rounded-md" placeholder="Partagez votre expérience..." required></textarea>
                  
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn bg-primary text-white border-none hover:bg-secondary rounded-full px-5 py-1.5 transition transform hover:scale-105">Envoyer</button>
                </div>
            </form>
        </div>
        @endauth

        <div class="swiper mySwiper max-w-7xl mx-auto">
            <div class="swiper-wrapper">
                @forelse ($feedbacks as $feedback)
                    <div class="swiper-slide">
                        <div class="card bg-white shadow-md p-5 rounded-lg max-w-xs mx-auto">
                            <div class="card-body">
                                <div class="flex items-center mb-3">
                                    <div class="avatar">
                                        <div class="w-10 h-10 rounded-full overflow-hidden">
                                            @if ($feedback->user->profile_photo)
                                                <img src="{{ asset('storage/'. $feedback->user->profile_photo) }}" alt="{{ $feedback->user->name }}" class="object-cover w-full h-full" />
                                            @else
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                    <i class="ri-user-fill"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $feedback->user->name }}</h4>
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $feedback->note ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm comment-text line-clamp-3">{{ $feedback->commentaire }}</p>
                                <button class="read-more-btn hidden text-primary text-sm font-medium mt-2 hover:underline focus:outline-none" onclick="toggleReadMore(this)">Lire la suite</button>
                                <p class="text-xs text-gray-400 mt-2">{{ $feedback->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <p class="text-center text-gray-600">Aucun avis publié pour le moment.</p>
                    </div>
                @endforelse
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination mt-4"></div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function() {
        const noteInput = document.getElementById('note');
        const initialValue = noteInput.value || 0; 
        const stars = document.querySelectorAll('.fa-star');

        stars.forEach((s, index) => {
            if (index < initialValue) {
                s.classList.remove('text-gray-300');
                s.classList.add('text-yellow-400', 'fas');
            }
        });
    });

    function rate(star) {
        const value = star.getAttribute('data-value');
        const stars = document.querySelectorAll('.fa-star');
        const noteInput = document.getElementById('note');

        noteInput.value = value;

        stars.forEach((s, index) => {
            if (index < value) {
                s.classList.remove('text-gray-300');
                s.classList.add('text-yellow-400', 'fas');
            } else {
                s.classList.remove('text-yellow-400', 'fas');
                s.classList.add('text-gray-300');
            }
        });
    }


    // pour le swiper
    var swiper = new Swiper('.mySwiper', {
        slidesPerView: 4,      
        spaceBetween: 15,
        autoplay: {
            delay: 2500,     
            disableOnInteraction: false, 
        },
        loop: true,           
        pagination: {
            el: '.swiper-pagination',
            clickable: true,  
        },
    });

    document.addEventListener('DOMContentLoaded', function() {
        const comments = document.querySelectorAll('.comment-text');
        comments.forEach(comment => {
            const readMoreBtn = comment.nextElementSibling;
            if (comment.scrollHeight > comment.clientHeight) {
                readMoreBtn.classList.remove('hidden');
            }
        });
    });

    function toggleReadMore(btn) {
        const comment = btn.previousElementSibling;
        if (comment.classList.contains('line-clamp-3')) {
            comment.classList.remove('line-clamp-3');
            btn.textContent = 'Réduire';
        } else {
            comment.classList.add('line-clamp-3');
            btn.textContent = 'Lire la suite';
        }
    }

</script>

@endsection