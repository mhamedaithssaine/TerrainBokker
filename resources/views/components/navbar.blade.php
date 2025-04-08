<nav class="bg-white shadow-lg">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-evenly h-16 items-center">
            <!-- Logo et nom de l'application -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <i class="fas fa-futbol text-2xl text-emerald-600 mr-2"></i>
                    <span class="font-bold text-xl text-gray-800">TerrainBokker</span>
                </div>
            </div>

            <!-- Champ de recherche -->
            <div class="flex-1 mx-14">
                <form action="" method="GET" class="w-full max-w-md">
                    <div class="relative">
                        <input type="text" name="query" placeholder="Rechercher..." 
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
            </div>

            <!-- Notifications et profil -->
            <div class="flex items-center space-x-6">
                <!-- Bouton de notifications -->
                <div class="relative">
                    <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </button>
                </div>

                <!-- Menu déroulant du profil -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center focus:outline-none">
                        <img class="h-8 w-8 rounded-full object-cover" src="/api/placeholder/150/150" alt="Photo de profil">
                        @if (session('name'))
                        <span class="ml-2 text-gray-700">{{ session('name') }}</span>
                    @else
                        <span class="ml-2 text-gray-500 italic">Invité</span>
                    @endif
                        <i class="fas fa-chevron-down ml-2 text-xs text-gray-600"></i>
                    </button>

                    <!-- Menu déroulant -->
                    <div x-show="open" @click.away="open = false" 
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-100">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-user-circle mr-2 text-gray-500"></i> Profil
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-edit mr-2 text-gray-500"></i> Modifier le profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            @csrf
                            <button type="submit" class="flex items-center w-full text-left">
                                <i class="fas fa-sign-out-alt mr-2 text-red-500"></i>
                                <span class="text-red-500">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>