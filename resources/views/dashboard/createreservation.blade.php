@extends('layouts.app')
@section('title', 'Créer une Réservation')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Créer une Réservation</h1>

    <div class="bg-white rounded-lg shadow p-6">
        @if (session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Calendar Section -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Calendrier des disponibilités</h2>
            </div>
            <div class="p-4">
                <div id="calendar"></div>
                <div class="mt-4 flex items-center text-sm">
                    <div class="flex items-center mr-4">
                        <div class="h-3 w-3 bg-red-500 rounded-sm mr-1"></div>
                        <span>Réservé</span>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('dashboard.createreservation.store') }}" id="reservation-form">
            @csrf

            <!-- Client Selection -->
            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                <select name="client_id" id="client_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                    <option value="">Sélectionner un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Terrain Selection -->
            <div class="mb-4">
                <label for="terrain_id" class="block text-sm font-medium text-gray-700">Terrain</label>
                <select name="terrain_id" id="terrain_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                    <option value="">Sélectionner un stade</option>
                    @foreach ($terrains as $terrain)
                        <option value="{{ $terrain->id }}" {{ old('terrain_id') == $terrain->id ? 'selected' : '' }}>
                            {{ $terrain->name }}
                        </option>
                    @endforeach
                </select>
                @error('terrain_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Date and Time -->
            <div class="mb-4">
                <label for="date_debut" class="block text-sm font-medium text-gray-700">Date et heure de début</label>
                <input type="datetime-local" name="date_debut" id="date_debut"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    value="{{ old('date_debut') }}" required min="{{now()->format('Y-m-d\TH:i')}}">
                @error('date_debut')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Duration -->
            <div class="mb-4">
                <label for="duration" class="block text-sm font-medium text-gray-700">Durée</label>
                <select name="duration" id="duration"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    required>
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ old('duration') == $i ? 'selected' : '' }}>
                            {{ $i }} heure{{ $i > 1 ? 's' : '' }}
                        </option>
                    @endfor
                </select>
                @error('duration')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Payment Advance -->
            <div class="mb-4">
                <label for="payment_advance" class="block text-sm font-medium text-gray-700">Avance de paiement (DH)</label>
                <input type="number" name="payment_advance" id="payment_advance"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    step="0.01" min="0" value="{{ old('payment_advance') }}" required>
                @error('payment_advance')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('dashboard.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-save mr-2"></i>
                    Créer
                </button>
            </div>
        </form>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '08:00:00',
                    slotMaxTime: '22:00:00',
                    allDaySlot: false,
                    height: 'auto',
                    events: [],
                    selectable: true,
                    select: function(info) {
                        var date = new Date(info.startStr);
                        var formattedDate = date.toISOString().slice(0, 16);
                        document.getElementById('date_debut').value = formattedDate;
                    },
                    locale: 'fr',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'today'
                    },
                    buttonText: {
                        today: 'Aujourd\'hui',
                        month: 'Mois',
                        week: 'Semaine',
                        day: 'Jour'
                    }
                });
                calendar.render();

                document.getElementById('terrain_id').addEventListener('change', function() {
                    var terrainId = this.value;
                    if (terrainId) {
                        fetch(`/dashboard/createreservation/terrain/${terrainId}/reservations`)
                            .then(response => response.json())
                            .then(data => {
                                calendar.removeAllEvents();
                                calendar.addEventSource(data);
                            })
                            .catch(error => console.error('Error fetching reservations:', error));
                    } else {
                        calendar.removeAllEvents();
                    }
                });
            });
        </script>
    @endsection
@endsection