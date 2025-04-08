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
          <li><a href="#" class="hover:text-blue-600">Accueil</a></li>
          <li><a href="#" class="hover:text-blue-600">Enchères</a></li>
          <li><a href="#" class="hover:text-blue-600">Collections</a></li>
          <li><a href="#" class="hover:text-blue-600">À propos</a></li>
          <li><a href="#" class="hover:text-blue-600">Contact</a></li>
        </ul>

        <!-- Boutons Connexion / Inscription -->
        <div class="hidden md:flex space-x-4">
          <button class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Connexion</button>
          <button class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Inscription</button>
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
                             src="https://images.unsplash.com/photo-1551966775-a4ddc8df052b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
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
                             src="https://images.unsplash.com/photo-1619468129361-605ebea04b44?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
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
                             src="https://images.unsplash.com/photo-1591370874773-6702e8f12fd8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
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
