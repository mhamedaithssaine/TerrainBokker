<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Avis récents</h2>
    </div>
    <div class="p-4">
        <div class="space-y-4">
            @forelse ($feedbacks as $feedback)
                <div class="border-b border-gray-200 pb-4">
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                {{ strtoupper(substr($feedback->user->name ?? 'Anonyme', 0, 1).substr($feedback->user->name ?? 'Anonyme', 1, 1))  }}               
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $feedback->user->name ?? 'Utilisateur anonyme' }}</p>
                                <div class="flex text-yellow-400">
                                    @for ($i = 0; $i < $feedback->note; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for ($i = $feedback->note; $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">{{ $feedback->date }}</p>
                    </div>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ $feedback->commentaire }}
                    </p>
                </div>
            @empty
                <p class="text-sm text-gray-600">Aucun feedback publié pour le moment.</p>
            @endforelse
        </div>
    </div>
</div>

