<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - Enchères de Patrimoine Culturel</title>
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

    <!-- Header Section with Video Background -->
    <section class="relative bg-gray-50 dark:bg-gray-900 py-12 overflow-hidden">
        <div class="absolute inset-0 h-94 bg-white opacity-60 dark:bg-gray-900 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-600/50 to-gray-900/70 dark:from-gray-900/70 dark:to-gray-950/80 z-10"></div>

            <!-- Video Background -->
            <video class="w-full h-full object-cover" autoplay loop muted playsinline>
                <source src="https://videocdn.cdnpk.net/videos/b99ede9f-e6d3-4931-beba-30cccad6de47/horizontal/previews/clear/small.mp4?token=exp=1745328254~acl=/*~hmac=192af8cbe622e8ef0d53fa231df2afcc6c7e73e0faae33bba995d818bc2ecca1" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-12 pb-6 z-20">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl drop-shadow-lg">
                    Catalogue des Enchères
                </h1>
                <p class="mt-4 text-xl text-white max-w-2xl mx-auto drop-shadow-md">
                    Découvrez notre collection exceptionnelle d'objets patrimoniaux et culturels disponibles aux enchères.
                </p>
            </div>
        </div>
    </section>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

    <!-- Add Product Button - Only show if user is authenticated -->
    @if(auth()->check() || request()->has('auth_user'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . (auth()->user()->image ?? request()->auth_user->image ?? 'anonymes_users/anonyme_user.jpg')) }}"
                     class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700"
                     alt="Profile">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name ?? request()->auth_user->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Ajoutez un nouveau produit à votre collection</p>
                </div>
            </div>
            <button id="openCreateModal"
                    class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Ajouter un produit</span>
            </button>
        </div>
    </div>
    @else
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200 p-6 rounded-xl shadow-sm flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Vous n'êtes pas connecté</h3>
                <p class="text-sm mt-1">Connectez-vous pour ajouter des produits à votre collection</p>
            </div>
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span>Se connecter</span>
            </a>
        </div>
    </div>
    @endif

    <!-- Filter Section -->
    <section class="bg-white dark:bg-gray-800 shadow-md py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <form action="{{ route('catalogue.show') }}" method="GET" class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="category" class="text-gray-700 dark:text-gray-300 font-medium">Catégorie:</label>
                    <select id="category" name="category" class="form-select rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">Toutes les catégories</option>
                        @foreach ($categories as $categorie)
                            <option value="{{$categorie->id}}" {{ request('category') == $categorie->id ? 'selected' : '' }}>{{$categorie->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="sort" class="text-gray-700 dark:text-gray-300 font-medium">Trier par:</label>
                    <select id="sort" name="sort" class="form-select rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récents</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                        <option value="ending_soon" {{ request('sort') == 'ending_soon' ? 'selected' : '' }}>Fin proche</option>
                    </select>
                </div>

                <div class="relative">
                    <input type="text" id="search" name="search"
                           placeholder="Rechercher dans le catalogue..."
                           value="{{ request('search') }}"
                           class="w-full py-2 pl-10 pr-4 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Appliquer les filtres
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Catalogue Items -->
    <section class="py-12 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($products->isEmpty())
                    <div class="col-span-3 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 17.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Aucun résultat trouvé</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Essayez de modifier vos critères de recherche.</p>
                    </div>
                @else
                    @foreach ($products as $product)
                        <div class="rounded-lg shadow-lg overflow-hidden bg-gray-50 dark:bg-gray-900 transition-transform duration-300 hover:scale-105">
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{ $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->image_path) : 'https://via.placeholder.com/400x300' }}"
                                     alt="{{ $product->title }}"
                                     class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $product->title }}</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-gray-600 dark:text-gray-500 font-semibold">Prix de départ: {{ number_format($product->starting_price, 2) }}€</span>
                                    <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">{{ $product->bids_count ?? 0 }} enchères</span>
                                </div>
                                <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                        <span class="text-gray-900 dark:text-white font-medium countdown" data-end="{{ $product->auction_end_date }}"></span>
                                    </div>
                                </div>
                                <a href="{{ route('product.details', $product->id) }}"
                                   class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                                    Voir les détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            @if(method_exists($products, 'hasPages') && $products->hasPages())
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; 2025 Nostalogia. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Modal for adding products -->
    @if(request()->has('auth_user'))
    <div id="createProductModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-2xl w-full relative max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 px-4 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ajouter un nouvel article</h3>
                <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500 focus:outline-none" aria-label="Fermer">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="px-4 py-4 overflow-y-auto" style="max-height: calc(90vh - 120px);">
                <form id="createProductForm" action="{{route('catalogue.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Titre</label>
                            <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div class="col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea id="description" name="description" rows="3" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>

                        <div class="col-span-2">
                            <label for="historical_context" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contexte Historique</label>
                            <textarea id="historical_context" name="historical_context" rows="3" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>

                        <div>
                            <label for="starting_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix de départ (€)</label>
                            <input type="number" id="starting_price" name="starting_price" min="0" step="0.01" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label for="auction_end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de fin</label>
                            <input type="datetime-local" id="auction_end_date" name="auction_end_date" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div class="col-span-2">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catégorie</label>
                            <select id="category_id" name="category_id" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                @foreach ($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Images</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-6 w-6 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m0-8z"></path>
                                    </svg>
                                    <div class="flex text-xs text-gray-600 dark:text-gray-400 justify-center">
                                        <label for="images" class="cursor-pointer bg-white dark:bg-gray-800 font-medium text-blue-600 hover:text-blue-500">
                                            <span>Télécharger des images</span>
                                            <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF jusqu'à 10MB</p>
                                </div>
                            </div>
                            <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                        </div>

                        <div class="col-span-2">
                            <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tags</label>
                            <div class="mt-1">
                                <div id="selectedTags" class="flex flex-wrap gap-2 mb-2"></div>
                                <select id="tagSelect" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Sélectionner un tag...</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 flex justify-end rounded-b-lg sticky bottom-0">
                <button type="button" id="cancelButton" class="bg-white dark:bg-gray-800 py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 mr-2">
                    Annuler
                </button>
                <button type="submit" form="createProductForm" class="bg-blue-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700">
                    Créer
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Add SweetAlert2 for better notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize countdown timers
            const countdowns = document.querySelectorAll('.countdown');
            countdowns.forEach(countdown => {
                const endDate = new Date(countdown.dataset.end);
                const updateCountdown = () => {
                    const now = new Date();
                    const diff = endDate - now;

                    if (diff <= 0) {
                        countdown.textContent = 'Terminé';
                        return;
                    }

                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

                    countdown.textContent = `${days}j ${hours}h ${minutes}m`;
                };

                updateCountdown();
                setInterval(updateCountdown, 60000); // Update every minute
            });

            // Modal functionality
            const modal = document.getElementById('createProductModal');
            const openModalBtn = document.getElementById('openCreateModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelButton = document.getElementById('cancelButton');
            const form = document.getElementById('createProductForm');
            const imageInput = document.getElementById('images');
            const imagePreview = document.getElementById('imagePreview');
            const tagSelect = document.getElementById('tagSelect');
            const selectedTags = document.getElementById('selectedTags');
            let selectedTagsSet = new Set();
            let selectedImages = [];

            if (openModalBtn) {
                openModalBtn.addEventListener('click', function() {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    closeModal();
                });
            }

            if (cancelButton) {
                cancelButton.addEventListener('click', function() {
                    closeModal();
                });
            }

            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                form.reset();
                imagePreview.innerHTML = '';
                selectedTags.innerHTML = '';
                selectedTagsSet.clear();
            }

            // Image preview functionality
            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const files = Array.from(e.target.files);

                    files.forEach(file => {
                        if (file.size > 10 * 1024 * 1024) { // 10MB limit
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: `L'image ${file.name} dépasse la taille maximale de 10MB`,
                                confirmButtonText: 'OK'
                            });
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imageId = Date.now() + Math.random().toString(36).substr(2, 9);
                            selectedImages.push({
                                id: imageId,
                                file: file,
                                preview: e.target.result
                            });
                            updateImagePreview();
                        };
                        reader.readAsDataURL(file);
                    });
                });
            }

            function updateImagePreview() {
                imagePreview.innerHTML = '';
                selectedImages.forEach((image, index) => {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700">
                            <img src="${image.preview}" class="w-full h-32 object-cover rounded-lg">
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                <button type="button" onclick="removeImage('${image.id}')" class="bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `;
                    imagePreview.appendChild(div);
                });
            }

            // Form validation
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const title = document.getElementById('title').value;
                    const description = document.getElementById('description').value;
                    const historicalContext = document.getElementById('historical_context').value;
                    const startingPrice = document.getElementById('starting_price').value;
                    const auctionEndDate = document.getElementById('auction_end_date').value;
                    const categoryId = document.getElementById('category_id').value;

                    let isValid = true;
                    let errorMessage = '';

                    if (title.length < 3) {
                        errorMessage += 'Le titre doit contenir au moins 3 caractères.\n';
                        isValid = false;
                    }

                    if (description.length < 10) {
                        errorMessage += 'La description doit contenir au moins 10 caractères.\n';
                        isValid = false;
                    }

                    if (historicalContext.length < 10) {
                        errorMessage += 'Le contexte historique doit contenir au moins 10 caractères.\n';
                        isValid = false;
                    }

                    if (startingPrice <= 0) {
                        errorMessage += 'Le prix de départ doit être supérieur à 0.\n';
                        isValid = false;
                    }

                    if (!auctionEndDate) {
                        errorMessage += 'La date de fin d\'enchère est requise.\n';
                        isValid = false;
                    }

                    if (!categoryId) {
                        errorMessage += 'La catégorie est requise.\n';
                        isValid = false;
                    }

                    if (selectedImages.length === 0) {
                        errorMessage += 'Au moins une image est requise.\n';
                        isValid = false;
                    }

                    if (!isValid) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur de validation',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Create FormData and append all images
                    const formData = new FormData(form);
                    selectedImages.forEach((image, index) => {
                        formData.append(`images[${index}]`, image.file);
                    });

                    // Submit the form with all images
                    fetch(form.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                            return;
                        }

                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/json')) {
                            return response.json();
                        }

                        // If not JSON, reload the page to show the response
                        window.location.reload();
                    })
                    .then(data => {
                        if (data && data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Succès!',
                                text: 'Le produit a été créé avec succès.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur!',
                            text: 'Une erreur est survenue lors de la soumission du formulaire.',
                            confirmButtonText: 'OK'
                        });
                    });
                });
            }

            // Tag selection functionality
            if (tagSelect) {
                tagSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const tagId = this.value;
                    const tagName = selectedOption.text;

                    if (tagId && !selectedTagsSet.has(tagId)) {
                        selectedTagsSet.add(tagId);
                        const tagElement = document.createElement('div');
                        tagElement.className = 'inline-flex items-center bg-blue-100 dark:bg-blue-900 px-3 py-1 rounded-full text-sm font-medium text-blue-800 dark:text-blue-200';
                        tagElement.innerHTML = `
                            ${tagName}
                            <input type="hidden" name="tags[]" value="${tagId}">
                            <button type="button" class="ml-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300" onclick="removeTag('${tagId}')">&times;</button>
                        `;
                        selectedTags.appendChild(tagElement);
                    }
                    this.value = '';
                });
            }
        });

        // Global function for removing images
        function removeImage(imageId) {
            selectedImages = selectedImages.filter(img => img.id !== imageId);
            updateImagePreview();
        }

        // Global function for removing tags
        function removeTag(tagId) {
            const tagElement = document.querySelector(`input[value="${tagId}"]`).parentElement;
            tagElement.remove();
            selectedTagsSet.delete(tagId);
        }
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Succès!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erreur!',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
</body>
</html>
