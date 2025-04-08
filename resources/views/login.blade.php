<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Nostalogia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-400 dark:bg-gray-900">
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <img src="https://img.icons8.com/ios-filled/50/000000/retro-tv.png" alt="Logo Nostalgia" class="w-8 h-8">
          <span class="text-xl font-bold text-gray-800">Nostalgia</span>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
          <li><a href="\" class="hover:text-blue-600">Accueil</a></li>
          <li><a href="catalogue" class="hover:text-blue-600">catalogue</a></li>
          <li><a href="blog" class="hover:text-blue-600">blog</a></li>
          <li><a href="about" class="hover:text-blue-600">À propos</a></li>
          <li><a href="#" class="hover:text-blue-600">Contact</a></li>
        </ul>
        <div class="hidden md:flex space-x-4">
          <button class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Connexion</button>
          <button class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Inscription</button>
        </div>

        <!--  burger mobile -->
        <div class="md:hidden">
          <button>
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </nav>
<!--********************************************************-->


    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-900">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-600/10 to-gray-900/30 dark:from-gray-900/60 dark:to-gray-950/60"></div>
        </div>

        <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg relative z-10">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                    Connexion à votre compte
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                    Accédez à votre espace Nostalogia
                </p>
            </div>
            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-base shadow-md" role="alert">
                <strong class="font-semibold">Error:</strong> {{ session('error') }}
            </div>
            @endif

            <form class="mt-8 space-y-6" action="/login" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Adresse email
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Mot de passe
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                               class="h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded dark:border-gray-700">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Se souvenir de moi
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-gray-600 dark:text-gray-400 hover:underline">
                            Mot de passe oublié?
                        </a>
                    </div>
                </div>
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Se connecter
                    </button>
                </div>
            </form>
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Vous n'avez pas de compte? <a href="/register" class="font-medium text-gray-600 dark:text-gray-400 hover:underline">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
    <footer class="bg-gray-900 text-white py-6">
        <div class="max-w-7xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <p>&copy; 2025 Nostalogia. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
