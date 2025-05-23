<aside class="bg-white w-64 min-h-screen shadow-md">
    <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-700">Tableau de bord</h2>
    </div>
    <nav class="mt-4">
        <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.index') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span>Vue d'ensemble</span>
            </div>
        </a>

        <div class="mt-4 mb-2">
            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Management</p>
        </div>

        <a href="{{ route('users.index') }}" class="block px-4 py-2 {{ request()->routeIs('users.index','users.create','users.edit') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fa-solid fa-user-cog mr-3"></i>
                <span>Utilisateurs</span>
            </div>
        </a>
        
        <a href="{{ route('roles.index') }}" class="block px-4 py-2 {{ request()->routeIs('roles.index','roles.create','roles.edit','roles.show') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fa-solid fa-balance-scale mr-3"></i>
                <span>Rôles</span>
            </div>
        </a> 
        
        <a href="{{ route('permissions.index') }}" class="block px-4 py-2 {{ request()->routeIs('permissions.index','permissions.create','permissions.edit') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fa-solid fa-mask mr-3"></i>
                <span>Permissions</span>
            </div>
        </a>
        
        <div class="mt-4 mb-2">
            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Contenu</p>
        </div>

        <a href="{{ route('categories.index') }}" class="block px-4 py-2 {{ request()->routeIs('categories.index','categories.create','categories.edit') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fa-duotone fa-solid fa-layer-group mr-3"></i>
                <span>Catégories</span>
            </div>
        </a>
        
        <a href="{{ route('tags.index') }}" class="block px-4 py-2 {{ request()->routeIs('tags.index','tags.create','tags.edit') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fa-solid fa-list mr-3"></i>
                <span>Tags</span>
            </div>
        </a>

        <a href="{{ route('terrains.index') }}" class="block px-4 py-2 {{ request()->routeIs('terrains.index','terrains.create','terrains.show','terrains.edit') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-futbol mr-3"></i>
                <span>Terrains</span>
            </div>
        </a>
        
        <div class="mt-4 mb-2">
            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Opérations</p>
        </div>

        <a href="{{ route('dashboard.createreservation') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.createreservation') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-3"></i>
                <span>Créer une Réservation </span>
            </div>
        </a>

        <a href="{{ route('dashboard.reservations.index') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.reservations.index','dashboard.reservations.show') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-clipboard-list mr-3"></i>
                <span>Réservations</span>
            </div>
        </a>

        <a href="{{ route('dashboard.payments.index') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.payments.index','dashboard.payments.show') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-euro-sign mr-3"></i>
                <span>Paiements</span>
            </div>
        </a>

        <div class="mt-4 mb-2">
            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Feedback</p>
        </div>

        <a href="{{ route('dashboard.feedback.index') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard.feedback.index','dashboard.feedback.update') ? 'bg-emerald-100 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center">
                <i class="fas fa-comment mr-3"></i>
                <span>Avis clients</span>
            </div>
        </a>
    </nav>
</aside>