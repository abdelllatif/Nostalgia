<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Nostalogia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <img src="/api/placeholder/50/50" alt="Logo Nostalgia" class="w-8 h-8">
          <span class="text-xl font-bold text-gray-800">Nostalgia</span>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
          <li><a href="\" class="hover:text-blue-600">Accueil</a></li>
          <li><a href="catalogue" class="hover:text-blue-600">Catalogue</a></li>
          <li><a href="blog" class="hover:text-blue-600">Blog</a></li>
          <li><a href="about" class="hover:text-blue-600">À propos</a></li>
          <li><a href="#" class="hover:text-blue-600">Contact</a></li>
        </ul>

        <!-- User Profile Button -->
        <div class="hidden md:flex space-x-4">
          <div class="relative">
            <button id="profileDropdown" class="flex items-center space-x-2 px-3 py-2 border rounded-full text-sm hover:bg-gray-100">
              <img src="/api/placeholder/40/40" alt="Photo de profil" class="w-6 h-6 rounded-full">
              <span>Jean Dupont</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <!-- Dropdown (hidden by default) -->
            <div class="hidden absolute right-0 w-48 bg-white rounded-md shadow-lg py-1">
              <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</a>
              <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
              <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Déconnexion</a>
            </div>
          </div>
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

    <!-- Profile Header Section -->
    <section class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8">
                <div class="relative w-32 h-32">
                    <img src="/api/placeholder/128/128" alt="Photo de profil" class="rounded-full w-full h-full object-cover border-4 border-white">
                    <button class="absolute bottom-0 right-0 bg-gray-600 text-white p-2 rounded-full hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Jean Dupont</h1>
                    <p class="text-gray-600 dark:text-gray-300">jean.dupont@example.com</p>
                    <p class="text-gray-500 dark:text-gray-400">Membre depuis Février 2023</p>
                    <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-2">
                        <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm">Collectionneur</span>
                        <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm">Vendeur Vérifié</span>
                    </div>
                </div>
                <div class="flex flex-col space-y-2">
                    <button class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Modifier le profil</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs Navigation -->
    <div class="bg-white dark:bg-gray-900 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex overflow-x-auto py-4 space-x-8 border-b">
                <button class="text-gray-900 dark:text-white border-b-2 border-gray-600 px-1 py-2 font-medium">Aperçu</button>
                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 px-1 py-2 font-medium">Mes articles</button>
                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 px-1 py-2 font-medium">Favoris</button>
                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 px-1 py-2 font-medium">Mes enchères</button>
                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 px-1 py-2 font-medium">Mes produits</button>
                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 px-1 py-2 font-medium">Paramètres</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Overview Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- User Info Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="font-bold text-xl text-gray-900 dark:text-white mb-4">Informations personnelles</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nom complet</p>
                            <p class="text-gray-900 dark:text-white">Jean Dupont</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                            <p class="text-gray-900 dark:text-white">jean.dupont@example.com</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Téléphone</p>
                            <p class="text-gray-900 dark:text-white">+33 6 12 34 56 78</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Statut</p>
                            <p class="text-green-600 dark:text-green-400 font-medium">Approuvé</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="font-bold text-xl text-gray-900 dark:text-white mb-4">Statistiques</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">12</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Enchères remportées</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">5</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Produits publiés</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">8</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Articles écrits</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">24</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Articles favoris</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="font-bold text-xl text-gray-900 dark:text-white mb-4">Activité récente</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-4 w-4 rounded-full bg-blue-500 mt-1"></div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-900 dark:text-white">Vous avez remporté l'enchère sur <a href="#" class="font-medium hover:underline">Tableau Historique du XVIIIe siècle</a></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 2 jours</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-4 w-4 rounded-full bg-green-500 mt-1"></div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-900 dark:text-white">Votre produit <a href="#" class="font-medium hover:underline">Collection de Pièces Romaines</a> a été mis en vente</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 1 semaine</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-4 w-4 rounded-full bg-purple-500 mt-1"></div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-900 dark:text-white">Vous avez publié un article: <a href="#" class="font-medium hover:underline">Techniques modernes de conservation</a></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 2 semaines</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="block text-center mt-4 text-sm text-gray-600 dark:text-gray-400 hover:underline">Voir toute l'activité</a>
                </div>
            </div>

            <!-- My Products Section -->
            <div class="mt-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Mes produits</h2>
                    <a href="/nouveau-produit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Ajouter un produit</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Product Card 1 (Sold) -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="relative">
                            <img src="/api/placeholder/400/240" alt="Tableau Historique" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">Vendu</div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tableau Historique du XVIIIe siècle</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Vendu pour: 8,750€</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Vendu le 12 Mars 2023</span>
                                <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 2 (Active) -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="relative">
                            <img src="/api/placeholder/400/240" alt="Manuscrit Médiéval" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">En cours</div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Manuscrit Médiéval Enluminé</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Enchère actuelle: 8,200€</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Fin: 15 Avril, 18:30</span>
                                <div class="flex space-x-2">
                                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 3 (Waiting Approval) -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="relative">
                            <img src="/api/placeholder/400/240" alt="Collection de Pièces" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">En attente</div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Collection de Pièces Romaines</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Prix de départ: 3,750€</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Soumis le 2 Avril 2023</span>
                                <div class="flex space-x-2">
                                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="/mes-produits" class="text-gray-600 dark:text-gray-400 hover:underline">Voir tous mes produits</a>
                </div>
            </div>

            <!-- My Bids Section -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Mes enchères remportées</h2>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Produit</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Montant</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Statut</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded object-cover" src="/api/placeholder/40/40" alt="Tableau Historique">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">Tableau Historique du XVIIIe siècle</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">12 Mars 2023</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">8,750€</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                        Payé
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Détails</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded object-cover" src="/api/placeholder/40/40" alt="Statuette Bronze">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">Statuette Bronze Art Déco</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">28 Février 2023</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">2,450€</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                                        En transit
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Détails</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 text-center">
                    <a href="/mes-encheres" class="text-gray-600 dark:text-gray-400 hover:underline">Voir toutes mes enchères</a>
                </div>
            </div>

            <!-- My Articles Section -->
            <div class="mt-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Mes articles</h2>
                    <a href="/nouvel-article" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Écrire un article</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Article Card 1 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col md:flex-row">
                        <div class="md:w-1/3">
                            <img src="/api/placeholder/200/200" alt="Conservation" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 md:w-2/3">
                            <div class="flex justify-between">
                                <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">Conservation</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">20 Mars 2023</span>
                            </div>
                            <h3 class="mt-
