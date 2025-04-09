<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - Enchères de Patrimoine Culturel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <img src="https://img.icons8.com/ios-filled/50/000000/retro-tv.png" alt="Logo Nostalgia" class="w-8 h-8">
          <span class="text-xl font-bold text-gray-800">Nostalgia</span>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
          <li><a href="\" class="hover:text-blue-600">Accueil</a></li>
          <li><a href="catalogue" class="text-blue-600 font-bold">Catalogue</a></li>
          <li><a href="blog" class="hover:text-blue-600">Blog</a></li>
          <li><a href="about" class="hover:text-blue-600">À propos</a></li>
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

    <!-- Header Section -->
    <section class="relative bg-gray-50 py-12">
        <div class="absolute inset-0 h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-600/30 to-gray-900/30 dark:from-gray-900/60 dark:to-gray-950/60"></div>
            <img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2674&q=80"
                 alt="Nostalogia Catalogue Background"
                 class="w-full h-full object-cover mix-blend-overlay dark:mix-blend-soft-light">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-12 pb-6">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
                    Catalogue des Enchères
                </h1>
                <p class="mt-4 text-xl text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
                    Découvrez notre collection exceptionnelle d'objets patrimoniaux et culturels disponibles aux enchères.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white max-w-7xl">
   <!-- Trigger Button for Popup -->
<div class="flex justify-center my-4">
    <button id="openCreateModal" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
      </svg>
      Créer un produit
    </button>
  </div>

  <!-- Popup Modal -->
  <div id="createProductModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
      <!-- Modal Header -->
      <div class="flex items-center justify-between border-b px-4 py-3">
        <h3 class="text-lg font-semibold text-gray-900">Ajouter un nouvel article</h3>
        <button id="closeModal" class="text-gray-400 hover:text-gray-500">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="px-4 py-4 max-h-[70vh] overflow-y-auto">
        <form id="createProductForm">
          <!-- Title -->
          <div class="mb-3">
            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
          </div>

          <!-- Description (concise) -->
          <div class="mb-3">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="2" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
          </div>

          <!-- Historical Context (concise) -->
          <div class="mb-3">
            <label for="historical_context" class="block text-sm font-medium text-gray-700">Contexte Historique</label>
            <textarea id="historical_context" name="historical_context" rows="2" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
          </div>

          <!-- Two columns for price and date -->
          <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
              <label for="starting_price" class="block text-sm font-medium text-gray-700">Prix de départ (€)</label>
              <input type="number" id="starting_price" name="starting_price" min="0" step="0.01" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div>
              <label for="auction_end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
              <input type="date" id="auction_end_date" name="auction_end_date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
          </div>

          <!-- Category -->
          <div class="mb-3">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select id="category_id" name="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              <option value="">Sélectionner</option>
              <option value="1">Tableaux</option>
              <option value="2">Sculptures</option>
              <option value="3">Manuscrits</option>
              <option value="4">Monnaies</option>
              <option value="5">Mobilier</option>
              <option value="6">Bijoux</option>
              <option value="7">Cartes</option>
              <option value="8">Horlogerie</option>
            </select>
          </div>

          <!-- Hidden user_id field -->
          <input type="hidden" name="user_id" value="1">

          <!-- Images Upload -->
          <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700">Images</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-6 w-6 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-xs text-gray-600 justify-center">
                  <label for="images" class="cursor-pointer bg-white font-medium text-blue-600 hover:text-blue-500">
                    <span>Télécharger</span>
                    <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Tags Selection (simplified) -->
          <div class="mb-3">
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
            <select id="tags" name="tags[]" multiple class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" size="3">
              <option value="1">Antique</option>
              <option value="2">Renaissance</option>
              <option value="3">Baroque</option>
              <option value="4">Empire</option>
              <option value="5">Art Déco</option>
            </select>
            <p class="mt-1 text-xs text-gray-500">Ctrl+clic pour sélections multiples</p>
          </div>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-end rounded-b-lg">
        <button type="button" id="cancelButton" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mr-2">
          Annuler
        </button>
        <button type="button" id="submitButton" class="bg-blue-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700">
          Créer
        </button>
      </div>
    </div>
  </div>
    </section>



    <!-- Filter Section -->
    <section class="bg-white dark:bg-gray-800 shadow-md py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="category" class="text-gray-700 dark:text-gray-300 font-medium">Catégorie:</label>
                    <select id="category" class="form-select rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Toutes les catégories</option>
                        <option value="tableaux">Tableaux</option>
                        <option value="sculptures">Sculptures</option>
                        <option value="manuscrits">Manuscrits</option>
                        <option value="monnaies">Monnaies et Médailles</option>
                        <option value="mobilier">Mobilier Ancien</option>
                        <option value="bijoux">Bijoux Historiques</option>
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="period" class="text-gray-700 dark:text-gray-300 font-medium">Époque:</label>
                    <select id="period" class="form-select rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Toutes les époques</option>
                        <option value="antiquite">Antiquité</option>
                        <option value="medieval">Médiéval</option>
                        <option value="renaissance">Renaissance</option>
                        <option value="moderne">Époque Moderne</option>
                        <option value="contemporain">Art Contemporain</option>
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="sort" class="text-gray-700 dark:text-gray-300 font-medium">Trier par:</label>
                    <select id="sort" class="form-select rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="newest">Plus récents</option>
                        <option value="ending">Fin imminente</option>
                        <option value="price_asc">Prix: croissant</option>
                        <option value="price_desc">Prix: décroissant</option>
                        <option value="popularity">Popularité</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <div class="relative">
                    <input type="text" placeholder="Rechercher dans le catalogue..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Catalogue Items -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid Display -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Item 1 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://plus.unsplash.com/premium_photo-1743096946788-b8d8304542d1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwzfHx8ZW58MHx8fHx8"
                            alt="Tableau historique"
                            class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Tableaux</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Tableau Historique du XVIIIe siècle</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">Prix actuel: 5,250€</span>
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

                <!-- Item 2 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1741805190625-7386d2180e57?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1M3x8fGVufDB8fHx8fA%3D%3D"
                             alt="Manuscrit ancien"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Manuscrits</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Manuscrit Médiéval Enluminé</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">Prix actuel: 8,900€</span>
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

                <!-- Item 3 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1701960126065-7a3f6cd98168?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHZhbiUyMGdvZ2h8ZW58MHx8MHx8fDA%3D"
                             alt="Collection de pièces anciennes"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Monnaies</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Collection de Pièces Romaines</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">Prix actuel: 4,600€</span>
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

                <!-- Item 4 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1653201975293-4dd4bf6a9358?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDB8fHN0YXR1ZXxlbnwwfHwwfHx8MA%3D%3D"
                             alt="Sculpture ancienne"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Sculptures</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Sculpture Baroque en Marbre</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">Prix actuel: 12,500€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">8 enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">25 Avril, 16:00</span>
                            </div>
                        </div>
                        <a href="/produit/4" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1696925022753-99f166a13855?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGFudGlxdWUlMjBqZXdlbHJ5fGVufDB8fDB8fHww"
                             alt="Bijou ancien"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Bijoux</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Collier Art Déco en Or et Diamants</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">Prix actuel: 18,700€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">15 enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">20 Avril, 19:45</span>
                            </div>
                        </div>
                        <a href="/produit/5" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551117151-59ee90639de7?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHZpbnRhZ2UlMjBmdXJuaXR1cmV8ZW58MHx8MHx8fDA%3D"
                             alt="Mobilier ancien"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Mobilier</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Bureau Louis XV en Bois Précieux</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">Prix actuel: 9,800€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">7 enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">27 Avril, 12:00</span>
                            </div>
                        </div>
                        <a href="/produit/6" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>
                <!-- Item 7 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1597677158445-0165c1032331?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGFudGlxdWUlMjBtYXB8ZW58MHx8MHx8fDA%3D"
                             alt="Carte ancienne"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Cartes</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Carte Maritime du XVIe siècle</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">Prix actuel: 3,200€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">11 enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">19 Avril, 10:30</span>
                            </div>
                        </div>
                        <a href="/produit/7" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>

                <!-- Item 8 -->
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1594970484114-34b17117bd78?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8YW50aXF1ZSUyMHdhdGNofGVufDB8fDB8fHww"
                             alt="Montre ancienne"
                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Horlogerie</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Montre de Poche en Or Gravée</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">Prix actuel: 6,750€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">14 enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">21 Avril, 15:15</span>
                            </div>
                        </div>
                        <a href="/produit/8" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <span class="sr-only">Précédent</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" aria-current="page" class="z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 text-blue-600 dark:text-blue-200 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                        1
                    </a>
                    <a href="#" class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                        2
                    </a>
                    <a href="#" class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                        3
                    </a>
                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-400">
                        ...
                    </span>
                    <a href="#" class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                        8
                    </a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <span class="sr-only">Suivant</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </section>




    <!-- Newsletter Section -->
    <section class="py-12 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    Restez informé
                </h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Abonnez-vous à notre newsletter pour recevoir des mises à jour sur les nouvelles enchères, événements et articles de blog.
                </p>
                <div class="mt-8 max-w-xl mx-auto">
                    <form class="sm:flex">
                        <label for="email-address" class="sr-only">Adresse email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required class="w-full px-5 py-3 border border-gray-300 dark:border-gray-700 shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white rounded-md" placeholder="Votre adresse email">
                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                            <button type="submit" class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                S'abonner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 bg-gray-600 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-black sm:text-4xl">
                    Vous possédez une pièce de collection?
                </h2>
                <p class="mt-4 text-xl text-gray-100 max-w-2xl mx-auto">
                    Mettez vos objets patrimoniaux aux enchères sur notre plateforme et touchez des passionnés du monde entier.
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-md shadow">
                        <a href="/vendre" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-gray-600 bg-white hover:bg-gray-50">
                            Vendre un article
                        </a>
                    </div>
                    <div class="ml-3 inline-flex">
                        <a href="/expertise" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-800
                 hover:bg-gray-700 dark:hover:bg-gray-700">
                            Demander une expertise
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
