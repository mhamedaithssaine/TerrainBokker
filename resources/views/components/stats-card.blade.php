<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Réservations aujourd'hui -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-calendar-check text-blue-600"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm font-medium text-gray-600">Réservations aujourd'hui</h2>
                <p class="text-2xl font-bold text-gray-900">{{ $reservationsToday }}</p>
            </div>
        </div>
    </div>

    <!-- Revenus du mois -->
    {{-- <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center">
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-euro-sign text-green-600"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm font-medium text-gray-600">Revenus du mois</h2>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($revenusMois, 2, ',', ' ') }} €</p>
            </div>
        </div>
    </div> --}}

    <!-- Note moyenne -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center">
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-star text-yellow-600"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm font-medium text-gray-600">Note moyenne</h2>
                <p class="text-2xl font-bold text-gray-900">
                    @if ($noteMoyenne > 0)
                        {{ number_format($noteMoyenne, 1) }}/5
                    @else
                        Aucune note
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Nouveaux clients -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center">
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-users text-purple-600"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm font-medium text-gray-600">Nouveaux clients</h2>
                <p class="text-2xl font-bold text-gray-900">{{ $nouveauxClients }}</p>
            </div>
        </div>
    </div>
</div>