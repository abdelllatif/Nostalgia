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




    @if (@session('success'))
    <div>
    <p class="bg-green-300 text-green-800 border-[20px] text-center text-2xl py-8 border-green-800">{{session('success')}}</p>
    </div>
    @endif
    <!-- Profile Header Section -->
    <section class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8">
                <div class="relative w-32 h-32">
                    <img src="{{asset('storage/anonymes_users/anonyme_user.jpg')}}" alt="Photo de profil" class="rounded-full w-full h-full object-cover border-4 border-white">
                    <button class="absolute bottom-0 right-0 bg-gray-600 text-white p-2 rounded-full hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{$user->first_name." ".$user->name}}</h1>
                    <p class="text-gray-600 dark:text-gray-300">{{$user->email}}</p>
                    <p class="text-gray-500 dark:text-gray-400">Membre depuis {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('F Y') }}</p>
                    <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-2">
                        <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm">Collectionneur</span>
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
                            <p class="text-gray-900 dark:text-white">{{$user->name}}</p>
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
                 <!-- Article Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col md:flex-row">
                    <div class="md:w-1/3">
                        <img src="/api/placeholder/200/200" alt="Histoire" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 md:w-2/3">
                        <div class="flex justify-between">
                            <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">Histoire</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">5 Février 2023</span>
                        </div>
                        <h3 class="mt-2 text-lg font-bold text-gray-900 dark:text-white">L'influence de l'art romain sur l'Europe médiévale</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                            Comment les techniques artistiques et architecturales romaines ont traversé les siècles pour façonner l'art européen...
                        </p>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">328 vues</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">•</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">24 commentaires</span>
                            </div>
                            <a href="/article/influence-art-romain" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Lire la suite</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="/mes-articles" class="text-gray-600 dark:text-gray-400 hover:underline">Voir tous mes articles</a>
            </div>
        </div>

        <!-- My Favorites Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Mes favoris</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Favorite Article Card 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <img src="/api/placeholder/400/240" alt="Article Art Nouveau" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">Art Nouveau</span>
                            <button class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Les maîtres de l'Art Nouveau à Paris</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                            Découvrez les œuvres emblématiques qui ont défini le mouvement Art Nouveau dans la capitale française...
                        </p>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="/api/placeholder/24/24" alt="Auteur" class="w-6 h-6 rounded-full">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Marie Durand</span>
                            </div>
                            <a href="/article/art-nouveau-paris" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Lire la suite</a>
                        </div>
                    </div>
                </div>

                <!-- Favorite Article Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <img src="/api/placeholder/400/240" alt="Article Numismatique" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">Numismatique</span>
                            <button class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Guide d'identification des pièces romaines rares</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                            Comment reconnaître les pièces les plus précieuses de l'époque romaine et éviter les contrefaçons...
                        </p>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="/api/placeholder/24/24" alt="Auteur" class="w-6 h-6 rounded-full">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Philippe Martin</span>
                            </div>
                            <a href="/article/pieces-romaines-identification" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Lire la suite</a>
                        </div>
                    </div>
                </div>

                <!-- Favorite Article Card 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <img src="/api/placeholder/400/240" alt="Article Restauration" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">Restauration</span>
                            <button class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Principes éthiques de la restauration d'œuvres anciennes</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                            Les dilemmes et considérations morales lors de la restauration de pièces historiques de grande valeur...
                        </p>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="/api/placeholder/24/24" alt="Auteur" class="w-6 h-6 rounded-full">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Sophie Lambert</span>
                            </div>
                            <a href="/article/ethique-restauration" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Lire la suite</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="/mes-favoris" class="text-gray-600 dark:text-gray-400 hover:underline">Voir tous mes favoris</a>
            </div>
        </div>

        <!-- Active Bids Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Mes enchères en cours</h2>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Produit</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Fin de l'enchère</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Votre enchère</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Enchère actuelle</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded object-cover" src="/api/placeholder/40/40" alt="Vase Céramique">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Vase Céramique Antique</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">12 Avril 2023, 15:30</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">1,250€</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">1,380€</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                    Dépassé
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200 mr-3">Enchérir</a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Détails</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded object-cover" src="/api/placeholder/40/40" alt="Livre Ancien">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Livre Ancien XVIIe - Édition Rare</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">20 Avril 2023, 18:00</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">3,800€</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">3,800€</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                    En tête
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200 mr-3">Enchérir</a>
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

        <!-- Settings Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Paramètres du compte</h2>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informations personnelles</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="fullname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom complet</label>
                                <input type="text" id="fullname" value="Jean Dupont" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                <input type="email" id="email" value="jean.dupont@example.com" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                                <input type="tel" id="phone" value="+33 6 12 34 56 78" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Biographie</label>
                                <textarea id="bio" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white">Passionné de collection d'objets historiques et d'art ancien. Spécialisé dans les manuscrits et peintures du XVIIe siècle.</textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Sécurité</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mot de passe actuel</label>
                                <input type="password" id="current_password" placeholder="••••••••" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nouveau mot de passe</label>
                                <input type="password" id="new_password" placeholder="••••••••" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirmer le mot de passe</label>
                                <input type="password" id="confirm_password" placeholder="••••••••" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div class="pt-4">
                                <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Options de notification</h4>

                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="notify_bids" checked class="h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                                        <label for="notify_bids" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">M'avertir des enchères</label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" id="notify_comments" checked class="h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                                        <label for="notify_comments" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">M'avertir des commentaires sur mes articles</label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" id="notify_newsletter" class="h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                                        <label for="notify_newsletter" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Recevoir la newsletter mensuelle</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700">
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white mt-16 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">Nostalgia</h3>
                <p class="text-sm text-gray-300">Votre plateforme dédiée aux objets historiques, antiquités et œuvres d'art de collection.</p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-gray-300 hover:text-white">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058
