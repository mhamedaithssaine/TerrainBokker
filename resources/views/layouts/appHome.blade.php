<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerrainBooker - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981',
                        secondary: '#065f46',
                        accent: '#34d399',
                    }
                }
            },
            daisyui: {
                themes: ["light"]
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar bg-primary text-white">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 text-black">
                    <li><a href="{{ url('/') }}#accueil">Accueil</a></li>
                    <li><a href="{{ url('/') }}#terrains">Terrains</a></li>
                    <li><a href="{{ url('/') }}#reserver">Réserver</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost text-xl" href="{{ url('/') }}">
                <i class="fas fa-futbol mr-2"></i>
                TerrainBooker
            </a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ url('/') }}#accueil">Accueil</a></li>
                <li><a href="{{ url('/') }}#terrains">Terrains</a></li>
                <li><a href="{{ url('/') }}#reserver">Réserver</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
        </div>
        <div class="navbar-end flex items-center space-x-4">
            <a class="btn bg-white text-primary" href="{{ route('login') }}">Connexion</a>
            <a class="btn text-red-700 hover:text-red-700 font-semibold" href="{{ route('register') }}">Inscription</a>
        </div>
    </div>

    <!-- Contenu principal -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer p-10 bg-secondary text-white">
        <div>
            <span class="footer-title">Services</span>
            <a href="#" class="link link-hover">Réservation de terrains</a>
            <a href="#" class="link link-hover">Organisation d'événements</a>
            <a href="#" class="link link-hover">Location d'équipement</a>
        </div>
        <div>
            <span class="footer-title">Entreprise</span>
            <a href="#" class="link link-hover">À propos</a>
            <a href="#" class="link link-hover">Conditions d'utilisation</a>
            <a href="#" class="link link-hover">Politique de confidentialité</a>
        </div>
        <div>
            <span class="footer-title">Téléchargez notre application</span>
            <div class="flex gap-4">
                <a href="#" class="btn btn-outline text-white">
                    <i class="fab fa-apple mr-2"></i> App Store
                </a>
                <a href="#" class="btn btn-outline text-white">
                    <i class="fab fa-google-play mr-2"></i> Google Play
                </a>
            </div>
        </div>
    </footer>
    <div class="footer footer-center p-4 bg-primary text-white">
        <div>
            <p>© 2023 TerrainBooker - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>