@extends('layouts.app')

@section('title', 'TerrainBokker - Tableau de bord gestionnaire')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Tableau de bord gestionnaire</h1>
    @include('components.stats-card')
    @include('components.recent-bookings-table')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @include('components.calendar')
        @include('components.reviews')
    </div>
@endsection