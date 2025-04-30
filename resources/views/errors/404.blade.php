<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - Nostalogia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="mb-6">
                <svg class="w-16 h-16 text-gray-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Page non trouvée</h1>
            <p class="text-gray-600 mb-8">Désolé, la page que vous recherchez n'existe pas ou a été déplacée.</p>
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="block w-full bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 transition duration-200">
                    Retour à l'accueil
                </a>
                <a href="{{ route('catalogue.index') }}" class="block w-full bg-gray-200 text-gray-800 py-2 px-4 rounded hover:bg-gray-300 transition duration-200">
                    Voir le catalogue
                </a>
            </div>
        </div>
    </div>
</body>
</html>
