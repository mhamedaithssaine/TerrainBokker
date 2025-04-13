@extends('layouts.appHome')

@section('title', 'Accueil')

@section('content')
    <!-- Hero Section -->
    <section id="accueil" class="hero min-h-[70vh]" style="background-image: url('https://picsum.photos/id/1058/1920/1080');">
        <div class="hero-overlay bg-black bg-opacity-60"></div>
        <div class="hero-content text-center text-white">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">TerrainBooker</h1>
                <p class="mb-5">Réservez facilement votre terrain de sport en quelques clics.</p>
                <button class="btn bg-primary text-white border-none hover:bg-secondary">Réserver maintenant</button>
            </div>
        </div>
    </section>

    <!-- Terrains Section -->
    <section id="terrains" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-secondary">Nos Terrains</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Terrain Card 1 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1071/600/400" alt="Terrain de football" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">Terrain de Football</h3>
                        <p>Terrain synthétique de dernière génération.</p>
                        <div class="card-actions justify-end">
                            <button class="btn bg-primary text-white border-none hover:bg-secondary">Réserver</button>
                        </div>
                    </div>
                </div>

                <!-- Terrain Card 2 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1072/600/400" alt="Terrain de tennis" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">Court de Tennis</h3>
                        <p>Court en terre battue entretenu quotidiennement.</p>
                        <div class="card-actions justify-end">
                            <button class="btn bg-primary text-white border-none hover:bg-secondary">Réserver</button>
                        </div>
                    </div>
                </div>

                <!-- Terrain Card 3 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1057/600/400" alt="Terrain de basketball" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">Terrain de Basketball</h3>
                        <p>Terrain couvert avec sol en parquet professionnel.</p>
                        <div class="card-actions justify-end">
                            <button class="btn bg-primary text-white border-none hover:bg-secondary">Réserver</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section id="reserver" class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-secondary">Réservez Maintenant</h2>
            <div class="card bg-base-100 shadow-xl max-w-2xl mx-auto border border-primary">
                <div class="card-body">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Type de terrain</span>
                                </label>
                                <select class="select select-bordered border-primary">
                                    <option disabled selected>Choisissez un type</option>
                                    <option>Football</option>
                                    <option>Tennis</option>
                                    <option>Basketball</option>
                                </select>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Date</span>
                                </label>
                                <input type="date" class="input input-bordered border-primary" />
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Heure</span>
                                </label>
                                <select class="select select-bordered border-primary">
                                    <option disabled selected>Choisissez une heure</option>
                                    <option>09:00</option>
                                    <option>10:00</option>
                                    <option>11:00</option>
                                    <option>12:00</option>
                                    <option>13:00</option>
                                    <option>14:00</option>
                                    <option>15:00</option>
                                    <option>16:00</option>
                                    <option>17:00</option>
                                    <option>18:00</option>
                                    <option>19:00</option>
                                    <option>20:00</option>
                                </select>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Durée</span>
                                </label>
                                <select class="select select-bordered border-primary">
                                    <option disabled selected>Choisissez une durée</option>
                                    <option>1 heure</option>
                                    <option>2 heures</option>
                                    <option>3 heures</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-actions justify-center mt-6">
                            <button type="submit" class="btn bg-primary text-white border-none hover:bg-secondary">Vérifier la disponibilité</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection