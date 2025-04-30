<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès non autorisé - Nostalogia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="mb-6">
                <svg class="w-16 h-16 text-yellow-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Accès non autorisé</h1>
            <p class="text-gray-600 mb-8">Désolé, vous n'avez pas les permissions nécessaires pour accéder à cette page.</p>
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="block w-full bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 transition duration-200">
                    Retour à l'accueil
                </a>
                <a href="{{ route('login') }}" class="block w-full bg-gray-200 text-gray-800 py-2 px-4 rounded hover:bg-gray-300 transition duration-200">
                    Se connecter
                </a>
            </div>
        </div>
    </div>
</body>
</html>
