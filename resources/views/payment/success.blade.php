<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Réussi - Nostalgia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <img src="https://img.icons8.com/ios-filled/50/000000/retro-tv.png" alt="Logo Nostalgia" class="w-8 h-8">
          <span class="text-xl font-bold text-gray-800">Nostalgia</span>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
          <li><a href="/" class="hover:text-blue-600">Accueil</a></li>
          <li><a href="/catalogue" class="hover:text-blue-600">Catalogue</a></li>
          <li><a href="/blog" class="hover:text-blue-600">Blog</a></li>
          <li><a href="/about" class="hover:text-blue-600">À propos</a></li>
          <li><a href="#" class="hover:text-blue-600">Contact</a></li>
        </ul>
    </nav>

    <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-8 text-center">
                <div class="mb-6">
                    <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Paiement réussi !</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Merci pour votre achat de "{{ $product->title }}"</p>
                <p class="text-gray-600 dark:text-gray-400 mb-8">Un email de confirmation vous sera envoyé prochainement.</p>
                <a href="{{ route('product.details', ['product' => $product->id]) }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</body>
</html>
