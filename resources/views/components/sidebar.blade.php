<aside class="bg-white w-64 min-h-screen shadow-md">
    <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-700">Tableau de bord</h2>
    </div>
    <nav class="mt-4">
        <!-- Vue d'ensemble -->
        <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.index') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span>Vue d'ensemble</span>
            </div>
        </a>

        <!-- Disponibilités -->
        <a href="{{ route('dashboard.availabilities') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.availabilities') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-3"></i>
                <span>Disponibilités</span>
            </div>
        </a>

        <!-- Réservations -->
        <a href="{{ route('dashboard.bookings') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.bookings') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-clipboard-list mr-3"></i>
                <span>Réservations</span>
            </div>
        </a>

        <!-- Mes terrains -->
        <a href="{{ route('dashboard.terrains') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.terrains') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-futbol mr-3"></i>
                <span>Mes terrains</span>
            </div>
        </a>

        <!-- Paiements -->
        <a href="{{ route('dashboard.payments') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.payments') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-euro-sign mr-3"></i>
                <span>Paiements</span>
            </div>
        </a>

        <!-- Avis clients -->
        <a href="{{ route('dashboard.reviews') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.reviews') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-comment mr-3"></i>
                <span>Avis clients</span>
            </div>
        </a>

        <!-- Paramètres -->
        <a href="{{ route('dashboard.settings') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.settings') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-cog mr-3"></i>
                <span>Paramètres</span>
            </div>
        </a>
    </nav>
</aside>