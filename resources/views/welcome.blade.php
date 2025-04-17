<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enchères de Patrimoine Culturel</title>
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
          <li><a href="\" class="hover:text-blue-600">Accueil</a></li>
          <li><a href="catalogue" class="hover:text-blue-600">catalogue</a></li>
          <li><a href="blog" class="hover:text-blue-600">blog</a></li>
          <li><a href="about" class="hover:text-blue-600">about</a></li>
          <li><a href="#" class="hover:text-blue-600">Contact</a></li>
        </ul>

        <!-- Boutons Connexion / Inscription -->
        <div class="hidden md:flex space-x-4">
          <a href="login" class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Connexion</a>
          <a href="register" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Inscription</a>
        </div>

        <!-- Menu burger mobile -->
        <div class="md:hidden">
          <button>
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </nav>

    <!-- Hero Section -->
    <section class="relative bg-gray-50 dark:bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-600/30 to-gray-900/30 dark:from-gray-900/60 dark:to-gray-950/60"></div>
            <img src="https://images.unsplash.com/photo-1461360228754-6e81c478b882?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2674&q=80"
                 alt="Nostalogia Hero Background"
                 class="w-full h-full object-cover mix-blend-overlay dark:mix-blend-soft-light">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-24 lg:py-32">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                    <span class="block">Nostalogia</span>
                    <span class="block text-gray-600 dark:text-gray-500">Enchères de Patrimoine Culturel</span>
                </h1>
                <p class="mt-6 text-xl text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
                    Découvrez et préservez des pièces culturelles rares et uniques. Une plateforme d'enchères interactive dédiée au patrimoine culturel.
                </p>
                <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                    <div class="flex space-x-4">
                        <a href="/catalogue" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500 md:py-4 md:text-lg md:px-10">
                            Explorer le Catalogue
                        </a>
                        <a href="/apropos" class="w-full flex items-center justify-center px-8 py-3 border border-gray-300 dark:border-gray-700 text-base font-medium rounded-md text-gray-900 dark:text-white bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 md:py-4 md:text-lg md:px-10">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Items Section -->
    <section class="py-12 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    Enchères en Vedette
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
                    Découvrez nos pièces culturelles les plus exceptionnelles disponibles aux enchères.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Featured Item 1 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-gray-50 dark:bg-gray-900 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://plus.unsplash.com/premium_photo-1743096946788-b8d8304542d1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwzfHx8ZW58MHx8fHx8"
                            alt="Tableau historique"
                            class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Tableau Historique du XVIIIe siècle</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-500 font-semibold">Prix de départ: 5,000€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">12 enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">23 Avril, 20:00</span>
                            </div>
                        </div>
                        <a href="/produit/1" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>

                <!-- Featured Item 2 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-gray-50 dark:bg-gray-900 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1741805190625-7386d2180e57?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1M3x8fGVufDB8fHx8fA%3D%3D"
                             alt="Manuscrit ancien"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Manuscrit Médiéval Enluminé</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-500 font-semibold">Prix de départ: 8,200€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">19 enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">15 Avril, 18:30</span>
                            </div>
                        </div>
                        <a href="/produit/2" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>

                <!-- Featured Item 3 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-gray-50 dark:bg-gray-900 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1701960126065-7a3f6cd98168?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHZhbiUyMGdvZ2h8ZW58MHx8MHx8fDA%3D"
                             alt="Collection de pièces anciennes"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Collection de Pièces Romaines</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-500 font-semibold">Prix de départ: 3,750€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">24 enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">18 Avril, 14:00</span>
                            </div>
                        </div>
                        <a href="/produit/3" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="/catalogue" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                    Voir toutes les enchères
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        À Propos de Nostalogia
                    </h2>
                    <div class="mt-8 text-lg text-gray-600 dark:text-gray-400 space-y-4">
                        <p>
                            Nostalogia est une plateforme innovante dédiée à la préservation et à la diffusion du patrimoine culturel. Notre mission est de rendre la culture accessible à tous tout en garantissant un environnement sécurisé pour la vente et l'achat de pièces culturelles uniques.
                        </p>
                        <p>
                            Nous mettons en relation passionnés, collectionneurs et institutions culturelles dans un écosystème qui valorise l'authenticité et la transparence.
                        </p>
                        <p>
                            Chaque transaction sur notre plateforme contribue à la préservation de notre héritage culturel commun, permettant à ces trésors d'être appréciés par les générations futures.
                        </p>
                    </div>
                    <div class="mt-8 flex">
                        <div class="inline-flex rounded-md shadow">
                            <a href="/apropos" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-10 lg:mt-0">
                    <div class="relative aspect-w-16 aspect-h-9 rounded-lg shadow-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1566054757965-8c4085344c96?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
                             alt="Galerie d'art"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Blog Posts -->
    <section class="py-12 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    Derniers Articles du Blog
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
                    Découvrez des histoires fascinantes à propos du patrimoine culturel et de l'art.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Blog Post 1 -->
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover"
                             src=data:image/jpeg;base64,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"
                             alt="Art Renaissance">
                    </div>
                    <div class="flex-1 bg-gray-50 dark:bg-gray-900 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-500">Art</p>
                            <a href="/blog/art-renaissance" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">L'influence de la Renaissance sur l'art moderne</p>
                                <p class="mt-3 text-base text-gray-500 dark:text-gray-400">Comment les techniques et thèmes de la Renaissance continuent d'influencer l'art contemporain.</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="sr-only">Jean Dupont</span>
                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Author">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Jean Dupont</p>
                                <div class="flex space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                    <time datetime="2023-04-01">1 Avril 2023</time>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>6 min de lecture</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover"
                             src="data:image/jpeg;base64,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"
                             alt="Archéologie">
                    </div>
                    <div class="flex-1 bg-gray-50 dark:bg-gray-900 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-500">Archéologie</p>
                            <a href="/blog/decouvertes-archeologiques" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">Les découvertes archéologiques qui ont changé notre compréhension de l'histoire</p>
                                <p class="mt-3 text-base text-gray-500 dark:text-gray-400">Un regard sur les découvertes qui ont révolutionné notre perception du passé.</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="sr-only">Marie Lefèvre</span>
                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Author">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Marie Lefèvre</p>
                                <div class="flex space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                    <time datetime="2023-03-28">28 Mars 2023</time>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>8 min de lecture</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover"
                             src="data:image/jpeg;base64,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"
                             alt="Conservation">
                    </div>
                    <div class="flex-1 bg-gray-50 dark:bg-gray-900 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-500">Conservation</p>
                            <a href="/blog/techniques-conservation" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">Techniques modernes de conservation des œuvres d'art</p>
                                <p class="mt-3 text-base text-gray-500 dark:text-gray-400">Comment la science aide à préserver notre patrimoine culturel pour les générations futures.</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="sr-only">Pierre Martin</span>
                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Author">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Pierre Martin</p>
                                <div class="flex space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                    <time datetime="2023-03-20">20 Mars 2023</time>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>5 min de lecture</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="/blog" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                    Explorer le blog
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 bg-gray-600 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-black sm:text-4xl">
                    Prêt à rejoindre l'aventure Nostalogia?
                </h2>
                <p class="mt-4 text-xl text-gray-100 max-w-2xl mx-auto">
                    Créez un compte dès maintenant pour commencer à enchérir ou vendre des pièces culturelles uniques.
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-md shadow">
                        <a href="/register" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-gray-600 bg-white hover:bg-gray-50">
                            S'inscrire
                        </a>
                    </div>
                    <div class="ml-3 inline-flex">
                        <a href="/login" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-800 dark:bg-gray-900 hover:bg-gray-700 dark:hover:bg-gray-700">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!-- Footer Section -->
   <footer class="bg-gray-900 text-white py-6">
    <div class="max-w-7xl mx-auto text-center">
        <p>&copy; 2025 Nostalogia. Tous droits réservés.</p>
    </div>
</footer>

</body>
</html>
