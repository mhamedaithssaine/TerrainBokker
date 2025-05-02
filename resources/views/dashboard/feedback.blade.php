@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Avis clients</h1>

    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Liste des avis</h2>
        </div>
        <div class="p-4">
            @if (session('success'))
                <div class="alert alert-success mb-4 bg-emerald-100 text-emerald-800 border-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            @if ($feedbacks->isNotEmpty())
                <div class="space-y-4">
                    @foreach ($feedbacks as $feedback)
                        <div class="border-b border-gray-200 pb-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-xs font-medium">{{ substr($feedback->user->name, 0, 2) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $feedback->user->name }}</p>
                                        <div class="flex text-yellow-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $feedback->note)
                                                    <i class="fas fa-star"></i>
                                                @elseif ($i - 0.5 <= $feedback->note)
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <p class="text-xs text-gray-500">{{ $feedback->created_at->format('d/m/Y') }}</p>
                                    <form action="{{ route('dashboard.feedback.update', $feedback) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="select select-bordered select-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-20">
                                            <option value="publier" {{ $feedback->status === 'publier' ? 'selected' : '' }}>Publier</option>
                                            <option value="cacher" {{ $feedback->status === 'cacher' ? 'selected' : '' }}>Cacher</option>
                                        </select>
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</button>
                                    </form>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">{{ $feedback->commentaire }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-600">Aucun avis disponible pour le moment.</p>
            @endif
        </div>
    </div>
@endsection