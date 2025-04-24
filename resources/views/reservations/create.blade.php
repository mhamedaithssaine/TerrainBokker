@extends('layouts.appHome')

@section('title', 'Réserver un terrain')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4 text-emerald-600">Réserver {{ $terrain->name }} ({{ $terrain->categorie->name }})</h2>

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

                    <form method="POST" action="{{ route('reservations.store') }}" id="reservation-form">
                        @csrf
                        <input type="hidden" name="terrain_id" value="{{ $terrain->id }}">

                        <div class="mb-4">
                            <label for="date_debut" class="block text-sm font-medium text-gray-700">Date et heure de début</label>
                            <input type="datetime-local" name="date_debut" id="date_debut" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="{{ now()->format('Y-m-d\TH:i') }}">
                            @error('date_debut')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="duration" class="block text-sm font-medium text-gray-700">Durée</label>
                            <select name="duration" id="duration" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">{{ $i }} heure{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                            @error('duration')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-between">
                            <a href="/" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Retour
                            </a>
                            <button type="submit" class="btn bg-emerald-500 text-white border-none hover:bg-emerald-600">Confirmer la réservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  
@endsection
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
                events: [
                    @foreach ($reservations as $reservation)
                        {
                            title: 'Réservé par {{ $reservation->utilisateur->name ?? "Utilisateur" }}',
                            start: '{{ $reservation->date_debut }}',
                            end: '{{ $reservation->date_fin }}',
                            backgroundColor: '#ef4444',
                            borderColor: '#ef4444'
                        }@if (!$loop->last),@endif
                    @endforeach
                    
                ],
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
        });
    </script>
    @endsection
