<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librairie - Accueil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 font-sans antialiased">

<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="text-xl font-semibold text-gray-800">Librairie en ligne</span>
        </div>
        <div>
            @auth
                <a href="{{ route('commande.mes') }}" class="text-gray-700 hover:text-blue-600 mr-4">
                    <i class="fas fa-book-open mr-1"></i>Mes commandes
                </a>
                <a href="{{ route('logout') }}" class="text-red-600 hover:text-red-800"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-1"></i>Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                    <i class="fas fa-sign-in-alt mr-1"></i>Connexion
                </a>
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-user-plus mr-1"></i>Inscription
                </a>
            @endauth
        </div>
    </div>
</nav>

<main class="flex-grow py-16"> <!-- <-- AJOUT de flex-grow -->
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenue sur la Librairie en ligne</h1>
        <p class="text-lg text-gray-600 mb-6">Trouvez et commandez vos livres préférés en quelques clics.</p>
        <img src="{{ asset('images/livres2.jpg') }}" alt="Illustration librairie" class="mx-auto mb-8 rounded-lg shadow-lg max-w-md">
    </div>
</main>


<main class="flex-grow py-16"> <!-- <-- AJOUT de flex-grow -->
    <div class="container mx-auto px-4 text-center">
        <h1> en toute simplicites </h1>
        <img src="{{ asset('images/livres1.png') }}" alt="Illustration librairie" class="mx-auto mb-8 rounded-lg shadow-lg max-w-md">
    </div>
</main>

<footer class="mt-auto bg-white shadow py-6">
    <div class="container mx-auto px-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Librairie. Tous droits réservés.
    </div>
</footer>
</body>
</html>
