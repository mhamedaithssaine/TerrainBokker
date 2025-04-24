<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerrainBooker - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
      <!-- FullCalendar CDN -->
      <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">


      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

       <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Include Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981',
                        secondary: '#065f46',
                        accent: '#34d399',
                    },
                    borderRadius: {
                        button: '8px',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            },
            daisyui: {
                themes: ["light"]
            }
        }
    </script>

<style>
    .leaflet-popup-content-wrapper {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .leaflet-popup-content {
        margin: 10px;
    }
    .custom-popup h3 {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .custom-popup p {
        margin: 0.2rem 0;
        color: #666;
    }
    .custom-popup button {
        background-color: #38a169;
        color: white;
        padding: 0.3rem 0.6rem;
        margin-top: 0.5rem;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }
    .custom-popup button:hover {
        background-color: #2f855a; 
    }
</style>
</head>
<body class="bg-white min-h-screen">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-primary">TerrainBooker</a>
                    <nav class="hidden md:flex ml-10 space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-900 hover:text-primary">Accueil</a>
                        @auth
                        <a href="{{ url('/reservations') }}" class="text-gray-900 hover:text-primary">Mes Réservations</a>
                        @endauth
                       
                        <a href="{{ url('/contact') }}" class="text-gray-900 hover:text-primary">Contact</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="hidden md:flex space-x-2">
                        <a href="#" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary">
                            <i class="ri-facebook-fill ri-lg"></i>
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary">
                            <i class="ri-twitter-fill ri-lg"></i>
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary">
                            <i class="ri-instagram-fill ri-lg"></i>
                        </a>
                    </div>
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn bg-primary text-white border-none hover:bg-secondary">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn bg-primary text-white border-none hover:bg-secondary">Se connecter</a>
                        <a href="{{ route('register') }}" class="btn bg-white text-primary border border-primary hover:bg-primary hover:text-white">S'inscrire</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-secondary text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-white mb-4 block">TerrainBooker</a>
                    <p class="text-gray-300">Réservez facilement votre terrain et profitez d’un match inoubliable entre collègues .</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Accueil</a></li>
                        <li>@auth
                            <a href="{{ url('/reservations') }}" class="text-gray-300 hover:text-white">Mes Réservations</a>
                            @endauth</li>
                        <li><a href="{{ url('/contact') }}" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-300">
                            <i class="ri-map-pin-line mr-2"></i> Hay Annahda Kelâat M'Gouna
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="ri-phone-line mr-2"></i>  +212-662 799 725
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="ri-mail-line mr-2"></i> manaradades@gmail.com
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Newsletter</h4>
                    <form class="space-y-4">
                        <input type="email" placeholder="Votre email" class="w-full px-4 py-2 rounded-button bg-gray-800 border border-gray-700 text-white placeholder-gray-400">
                        <button type="submit" class="w-full bg-primary text-white py-2 rounded-button hover:bg-secondary">S'abonner</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 text-sm">© {{ date('Y') }} TerrainBooker. Tous droits réservés.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-300 hover:text-white"><i class="ri-facebook-fill ri-lg"></i></a>
                    <a href="#" class="text-gray-300 hover:text-white"><i class="ri-twitter-fill ri-lg"></i></a>
                    <a href="#" class="text-gray-300 hover:text-white"><i class="ri-instagram-fill ri-lg"></i></a>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>