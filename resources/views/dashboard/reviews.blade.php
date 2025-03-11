@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Avis clients</h1>

    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Liste des avis</h2>
        </div>
        <div class="p-4">
            @if (count($reviews) > 0)
                <div class="space-y-4">
                    @foreach ($reviews as $review)
                        <div class="border-b border-gray-200 pb-4">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-xs font-medium">{{ substr($review['user'], 0, 2) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $review['user'] }}</p>
                                        <div class="flex text-yellow-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review['rating'])
                                                    <i class="fas fa-star"></i>
                                                @elseif ($i - 0.5 <= $review['rating'])
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500">{{ $review['date'] }}</p>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">{{ $review['comment'] }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-600">Aucun avis disponible pour le moment.</p>
            @endif
        </div>
    </div>
@endsection