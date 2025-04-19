<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Librairie en ligne</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Font Awesome pour les icônes -->
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Mur3sL4n+Hyt2z1AelMdWTfWspqISZcIFiKlWrB3l5zJ7g43e2nl8WS4HBa2tOMWwhmqvrr9rM2zIfsz04FFKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@yield('scripts')

<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen flex flex-col">
    {{-- Barre de navigation --}}
    <nav class="bg-white shadow py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Librairie" class="h-10 w-auto">
                <span class="text-lg font-bold text-gray-800">Librairie en ligne</span>
            </div>

            <div>
                @auth
                    <a href="{{ route('commande.mes') }}" class="text-gray-700 hover:text-blue-600 mr-4">
                        <i class="fas fa-book"></i> Mes commandes
                    </a>
                    <a href="{{ route('logout') }}" class="text-red-600 hover:text-red-800"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </a>
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-user-plus"></i> Inscription
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- En-tête de page --}}
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    {{-- Contenu principal --}}
    <main class="flex-grow">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 mx-5" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3 mx-5" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Pied de page --}}
    <footer class="bg-white shadow py-4 mt-10">
        <div class="text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Librairie. Tous droits réservés.
        </div>
    </footer>
</div>
</body>
</html>
