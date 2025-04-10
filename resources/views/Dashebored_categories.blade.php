<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Nostalogia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900 flex min-h-screen">
    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 flex-shrink-0 hidden md:block">
        <div class="p-6 flex items-center space-x-2">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/retro-tv.png" alt="Logo Nostalgia" class="w-8 h-8">
            <span class="text-xl font-bold">Nostalogia Admin</span>
        </div>
        <div class="mt-6">
            <nav>
                <a href="admin-dashboard" class="block py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Tableau de bord
                </a>
                <a href="admin-users" class="block py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Utilisateurs
                </a>
                <a href="admin-products" class="block py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Produits
                </a>
                <a href="admin-categories" class="block py-3 px-6 bg-gray-700 text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Catégories
                </a>
                <a href="admin-tags" class="block py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Tags
                </a>
                <a href="admin-blog" class="block py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Articles Blog
                </a>
                <a href="admin-stats" class="block py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Statistiques
                </a>
            </nav>
        </div>
        <div class="absolute bottom-0 w-64 p-6">
            <a href="/" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                Retour au site
            </a>
            <a href="/logout" class="mt-2 block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Déconnexion
            </a>
        </div>
    </aside>

    <!-- Mobile menu button -->
    <div class="md:hidden absolute top-4 left-4 z-50">
        <button class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-white hover:border-white">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestion des Catégories</h1>
                <div class="flex items-center">
                    <div class="mr-4 text-right">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Admin: Jean Dupont</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Administrateur</p>
                    </div>
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Profile picture">
                </div>
            </div>
        </header>

        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <!-- Replace with your content -->
                <div class="px-4 py-6 sm:px-0">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gray-600 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                                Total des catégories
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-bold text-gray-900 dark:text-white">28</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gray-600 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                                Catégories actives
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-bold text-gray-900 dark:text-white">24</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gray-600 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                                Produits classés
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-bold text-gray-900 dark:text-white">184</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Erreur!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Succès!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif
                    <!-- Categories Actions -->
                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-8">
                        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                    Gestion des catégories
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                                    Créez et gérez les catégories de produits
                                </p>
                            </div>
                            <div class="flex space-x-3">
                                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    Import en masse
                                </button>
                                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Nouvelle catégorie
                                </button>
                            </div>
                        </div>

                        <!-- Search and Filter -->
                        <div class="px-4 py-5 bg-gray-50 dark:bg-gray-700 sm:px-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="w-full md:w-1/3 mb-4 md:mb-0">
                                    <label for="search" class="sr-only">Rechercher</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                        <input id="search" name="search" type="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-gray-500 focus:border-gray-500 sm:text-sm" placeholder="Rechercher une catégorie...">
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
                                    <select class="block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                                        <option value="">Tous les statuts</option>
                                        <option value="active">Actif</option>
                                        <option value="inactive">Inactif</option>
                                    </select>
                                    <select class="block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                                        <option value="10">10 par page</option>
                                        <option value="25">25 par page</option>
                                        <option value="50">50 par page</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{" "}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            categorie
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Produits
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Date de création
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($categories as $categorie)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0  rounded-full flex items-center justify-center">
                                                    <img src="{{ asset('storage/' . $categorie->image) }}" class="h-6 w-6 text-gray-600 dark:text-gray-300">                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{$categorie->name}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            42
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $categorie->created_at}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button onclick="openEditForm({{ $categorie->id}})" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" data-id="{{ $categorie->id}}" data-name="{{ $categorie->name}}" data-img="{{ $categorie->image}}">Modifier</button>
                                            <span class="text-gray-500 dark:text-gray-400 px-2">|</span>
                                            {{--<form action="{{ route('categorie.destroy', ['id' => $categorie->id]) }}"  method="POST">
                                                @csrf
                                                @method('DELETE')

                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Supprimer</button>
                                        </form>--}}
                                    </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                    </div>
        <!-- edit Category Form Modal -->
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="EditcategoryFormModal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
                </div>
                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                    changer une catégorie
                                </h3>
                                <div class="mt-4">
                                    <!-- Form starts here -->
                                    <form action="{{ route('categorie.edit',['id'=>$categorie->id] )}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('update')
                                        <div class="mb-4">
                                            <label for="categoryName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de la catégorie</label>
                                            <input type="text" name="name" id="EditcategoryName" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full py-2 shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white" placeholder="Ex:ancien Art">
                                        </div>
                                        <div class="mb-4">
                                            <label for="categoryImage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                                            <div class="mt-1 flex items-center">
                                                <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                                                    <img id="imagePreview" class="h-full w-full object-cover" alt="Preview" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" />
                                                </span>
                                                <input type="file" name="categoryImage" id="EditcategoryImage" accept="image/*" class="hidden" onchange="previewImage(event)">
                                                <button type="button" onclick="document.getElementById('categoryImage').click()" class="ml-5 bg-white dark:bg-gray-700 py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    Changer
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="flex justify-end space-x-4">
                                            <button type="button" class="inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" onclick="document.getElementById('categoryFormModal').classList.add('hidden')">
                                                Annuler
                                            </button>
                                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Créer
                                            </button>
                                            </div>
                                            </form>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Pagination -->
                                    <div class="bg-white dark:bg-gray-800 px-4 py-3 flex items-center justify-between border-t border-gray-200 dark:border-gray-700 sm:px-6">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            Précédent
                                        </a>
                                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            Suivant
                                        </a>
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                                Affichage de <span class="font-medium">1</span> à <span class="font-medium">5</span> sur <span class="font-medium">28</span> résultats
                                            </p>
                                        </div>
                                        <div>
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <span class="sr-only">Précédent</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                                <a href="#" aria-current="page" class="z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 dark:border-blue-500 text-blue-600 dark:text-blue-200 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    1
                                                </a>
                                                <a href="#" class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    2
                                                </a>
                                                <a href="#" class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    3
                                                </a>
                                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    ...
                                                </span>
                                                <a href="#" class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    6
                                                </a>
                                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <span class="sr-only">Suivant</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </nav>
                                        </div>
                                    </div>
                                    </div>
                                    </div>

                                    <!-- Create Category Form Modal -->
                                    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="categoryFormModal">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <!-- Background overlay -->
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
                                            </div>

                                            <!-- Modal panel -->
                                            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <div class="sm:flex sm:items-start">
                                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900 sm:mx-0 sm:h-10 sm:w-10">
                                                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                            </svg>
                                                        </div>
                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                                                Créer une nouvelle catégorie
                                                            </h3>
                                                            <div class="mt-4">
                                                                <!-- Form starts here -->
                                                                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-4">
                                                                        <label for="categoryName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de la catégorie</label>
                                                                        <input type="text" name="name" id="categoryName" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full py-2 shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white" placeholder="Ex:ancien Art">
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <label for="categoryImage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                                                                        <div class="mt-1 flex items-center">
                                                                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                                                                                <img id="imagePreview" class="h-full w-full object-cover" alt="Preview" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" />
                                                                            </span>
                                                                            <input type="file" name="categoryImage" id="categoryImage" accept="image/*" class="hidden" onchange="previewImage(event)">
                                                                            <button type="button" onclick="document.getElementById('categoryImage').click()" class="ml-5 bg-white dark:bg-gray-700 py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                                Changer
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Buttons -->
                                                                    <div class="flex justify-end space-x-4">
                                                                        <button type="button" class="inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" onclick="document.getElementById('categoryFormModal').classList.add('hidden')">
                                                                            Annuler
                                                                        </button>
                                                                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                            Créer
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End of your content -->
                                    </div>
                                    </div>
                                    </main>
                                    </div>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                    const newCategoryButton = document.querySelector('button:nth-of-type(2)');
                                    if (newCategoryButton) {
                                        newCategoryButton.addEventListener('click', function() {
                                            document.getElementById('categoryFormModal').classList.remove('hidden');
                                        });
                                    }
                                    const mobileMenuButton = document.querySelector('.md\\:hidden button');
                                    const sidebar = document.querySelector('aside');
                                    if (mobileMenuButton && sidebar) {
                                        mobileMenuButton.addEventListener('click', function() {
                                            sidebar.classList.toggle('hidden');
                                            sidebar.classList.toggle('fixed');
                                            sidebar.classList.toggle('inset-0');
                                            sidebar.classList.toggle('z-40');
                                        });
                                    }
                                    });
                                        function previewImage(event) {
                                        const input = event.target;
                                        const reader = new FileReader();
                                        reader.onload = function () {
                                            const preview = document.getElementById('imagePreview');
                                            preview.src = reader.result;
                                        };
                                        if (input.files && input.files[0]) {
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }

                                    function openEditForm($data){
                                    $modalEdit=document.getElementById('EditcategoryFormModal');
                                    $modalEdit.classList.remove('hidden');
                                    $name=document.getElementById('EditcategoryName');
                                    $img=document.getElementById('EditcategoryImage');
                                    $name=
                                    }
                                    </script>

                                    </body>
                                    </html>
