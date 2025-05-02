@extends('layouts.appHome')

@section('title', 'Contact')

@section('content')
    <section id="contact" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            @if (session('success'))
                <div class="alert alert-success mb-6">
                    {{ session('success') }}
                </div>
            @endif
            <h2 class="text-3xl font-bold text-center mb-8 text-secondary">Contactez-nous</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <form method="POST" action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nom</span>
                                </label>
                                <input type="text" name="name" placeholder="Votre nom" class="input input-bordered border-primary" value="{{ old('name') }}" />
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-control mt-4">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" name="email" placeholder="votre.email@exemple.com" class="input input-bordered border-primary" value="{{ old('email') }}" />
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-control mt-4">
                                <label class="label">
                                    <span class="label-text">Message</span>
                                </label>
                                <textarea name="message" class="textarea textarea-bordered border-primary h-24" placeholder="Votre message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-control mt-6">
                                <button type="submit" class="btn bg-primary text-white border-none hover:bg-secondary">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-xl p-6">
                    <h3 class="card-title text-2xl text-primary mb-6">Informations de contact</h3>
                    <div class="grid gap-6">
                        <div class="flex items-start gap-4">
                            <div class="text-primary text-2xl">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Adresse</h4>
                                <p>Hay Annahda, Kelâat M'Gouna, Maroc</p>
                            </div>
                        </div>
                
                        <div class="flex items-start gap-4">
                            <div class="text-primary text-2xl">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Téléphone</h4>
                                <p>0673 434 670</p>
                                <p>0662 799 725</p>
                            </div>
                        </div>
                
                        <div class="flex items-start gap-4">
                            <div class="text-primary text-2xl">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Email</h4>
                                <p>manaradades@gmail.com</p>
                            </div>
                        </div>
                
                        <div class="flex items-start gap-4">
                            <div class="text-primary text-2xl">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Horaires</h4>
                                <p>Lun-Ven : 9h - 22h</p>
                                <p>Sam-Dim : 10h - 22h</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-2xl font-bold mb-4">Géolocalisation</h3>
            <div id="map" style="height: 400px; width: 100%;"></div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function initializeMap() {
            var latitude = @json($ecoleLatitude);
            var longitude = @json($ecoleLongitude);

            if (latitude && longitude) {
                var map = L.map('map', {
                    zoomControl: true,
                    attributionControl: true 
                }).setView([latitude, longitude], 14);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var marker = L.marker([latitude, longitude]).addTo(map);

                marker.bindPopup(`
                    <div class="custom-popup">
                        <h3>مؤسسة منارة دادس الخاصةInstitution manara dades privée</h3>
                        <p>Hay Annahda Kelâat M'Gouna, Maroc</p>
                        <p>4.8 ★★★★★ (4 avis)</p>
                        <button onclick="window.open('https://www.openstreetmap.org/directions?to=${latitude},${longitude}', '_blank')">Agrandir</button>
                    </div>
                `).openPopup();

                marker.on('click', function() {
                    marker.openPopup();
                });
            }
        }

        window.onload = initializeMap;
    </script>
@endsection