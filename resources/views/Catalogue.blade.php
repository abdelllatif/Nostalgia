@extends('components.layout')

@section('title', 'Catalogue - Enchères de Patrimoine Culturel')

@section('content')
    <!-- Header Section with Background -->
    <section class="relative overflow-hidden py-20">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://robbreport.com/wp-content/uploads/2023/05/Sothebys_EveningSale.jpg?w=1000"
                class="w-full h-full object-cover" alt="Vintage Background">
            <div class="absolute bottom-0 left-0 w-full h-96 bg-gradient-to-t from-gray-600 via-gray-900 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-8 tracking-tight">
                    <span class="inline-block drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">Catalogue des Enchères</span>
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                    Découvrez notre collection exceptionnelle d'objets patrimoniaux et culturels disponibles aux enchères.
                </p>

                <!-- Stats Section -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-12">
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-lg">
                        <div class="text-3xl font-bold text-white mb-1">{{ $products->count() }}</div>
                        <div class="text-sm text-gray-300">Objets disponibles</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-lg">
                        <div class="text-3xl font-bold text-white mb-1">{{ isset($categories) ? $categories->count() : 0 }}</div>
                        <div class="text-sm text-gray-300">Catégories</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-lg">
                        <div class="text-3xl font-bold text-white mb-1">24h</div>
                        <div class="text-sm text-gray-300">Enchères actives</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-lg">
                        <div class="text-3xl font-bold text-white mb-1">100%</div>
                        <div class="text-sm text-gray-300">Satisfaction client</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 max-w-7xl mx-auto">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 max-w-7xl mx-auto">
        {{ session('error') }}
    </div>
    @endif

    @if(auth()->check() || request()->has('auth_user'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between bg-gradient-to-r from-gray-100 to-gray-200 p-6 rounded-xl shadow-lg border border-gray-200">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/anonymes_users/anonyme_user.jpg') }}"
                    class="w-12 h-12 rounded-full object-cover border-4 border-gray-300 shadow-md"
                    alt="Profile">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">{{ auth()->user()->name ?? request()->auth_user->name }}</h3>
                    <p class="text-sm text-gray-700">Ajoutez un nouveau produit à votre collection</p>
                </div>
            </div>
            <button id="openCreateModal"
                    class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-8 py-3 rounded-full hover:from-gray-700 hover:to-gray-800 flex items-center space-x-2 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Ajouter un produit</span>
            </button>
        </div>
    </div>
    @else
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-blue-50 border border-blue-200 text-blue-800 p-6 rounded-xl shadow-sm flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Vous n'êtes pas connecté</h3>
                <p class="text-sm mt-1">Connectez-vous pour ajouter des produits à votre collection</p>
            </div>
            <a href="{{ route('login') }}" class="bg-gray-600 text-white px-6 py-2 rounded-full hover:bg-gray-700 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span>Se connecter</span>
            </a>
        </div>
    </div>
    @endif

   <!-- Filter Section -->
   <section class="bg-gradient-to-b from-gray-50 to-white shadow-lg py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <form action="{{ route('catalogue') }}" method="GET" class="bg-white rounded-2xl shadow-xl p-6 space-y-6">
            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <input type="text"
                           name="search"
                           placeholder="Rechercher un objet historique..."
                           value="{{ request('search') }}"
                           class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gray-500 focus:ring-gray-500"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Category Filter -->
                <div class="space-y-2">
                    <label for="category" class="block text-sm font-semibold text-gray-700">Catégorie</label>
                    <div class="relative">
                        <select name="category" id="category"
                                class="w-full rounded-xl border-gray-300 pl-3 pr-10 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Sort Filter -->
                <div class="space-y-2">
                    <label for="sort" class="block text-sm font-semibold text-gray-700">Trier par</label>
                    <div class="relative">
                        <select name="sort" id="sort"
                                class="w-full rounded-xl border-gray-300 pl-3 pr-10 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récents</option>
                            <option value="ending_soon" {{ request('sort') == 'ending_soon' ? 'selected' : '' }}>Fin bientôt</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix (élevé à bas)</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix (bas à élevé)</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-end space-x-4">
                    <button type="submit"
                    class="flex-1 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white px-6 py-2.5 rounded-xl font-medium shadow-lg">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtrer
                        </span>
                    </button>
                    <a href="{{ route('catalogue') }}"
                       class="flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Réinitialiser
                    </a>
                </div>
            </div>
        </form>
    </div>
</section>

    <!-- Catalogue Items -->
    <section class="py-12 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($products))
                @if(isset($products) && $products->isEmpty())
                    <div class="col-span-3 text-center py-12">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden h-[400px] flex flex-col border border-gray-200">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <p class="text-gray-500 text-lg font-medium">Aucun produit trouvé</p>
                            <p class="mt-2 text-gray-400">Essayez de modifier vos critères de recherche</p>
                        </div>
                    </div>
                @else
                @foreach($products as $product)
                <div class="relative flex flex-col bg-gray-50 dark:bg-gray-900 rounded-2xl shadow-lg overflow-hidden h-[500px] transition hover:scale-105">
                    <!-- Product Image -->
                    <div class="h-60 w-full overflow-hidden">
                        <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'https://images.unsplash.com/photo-1741805190625-7386d2180e57?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1M3x8fGVufDB8fHx8fA%3D%3D' }}"
                            alt="{{ $product->title }}"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>

                    <!-- Product Content -->
                    <div class="flex flex-col flex-1 p-4">

                        <!-- User Info moved here -->
                        <div class="flex items-center mb-4">
                            <img src="{{ $product->user->profile_image ? asset('storage/' . $product->user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($product->user->first_name . ' ' . $product->user->last_name) }}"
                                alt="{{ $product->user->first_name }} {{ $product->user->name }}"
                                class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md">
                            <div class="ml-3">
                                <h5 class="text-gray-800 dark:text-white font-semibold text-sm">
                                    {{ $product->user->first_name }} {{ $product->user->name }}
                                </h5>
                            </div>
                        </div>

                        <!-- Product Title -->
                        <h4 class="text-gray-700 dark:text-gray-400 text-md font-medium mb-4 line-clamp-2">
                            {{ $product->title }}
                        </h4>

                        <!-- Info -->
                        <div class="mt-auto">
                            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mb-2">
                                <span class="font-semibold">Prix: {{ number_format($product->starting_price, 2) }}€</span>
                                <span>{{ $product->bids_count }} enchères</span>
                            </div>

                            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 border-t pt-2">
                                <span>Fin:</span>
                                <span class="text-gray-900 dark:text-white font-medium">
                                    {{ \Carbon\Carbon::parse($product->auction_end_date)->format('d F, H:i') }}
                                </span>
                            </div>

                            <a href="{{ route('product.details', ['product' => $product->id]) }}"
                               class="block w-full mt-4 text-center bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white text-sm py-2 rounded-lg transition">
                                Voir les détails
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
            @endif
            </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="mt-8 max-w-7xl mx-auto px-4 flex justify-center">
            <div class="inline-flex space-x-2">
                {{ $products->links() }}
            </div>
        </div>


    </section>

            @endif
        </div>
    </section>


    <!-- Modal for adding products -->
    @if(request()->has('auth_user'))
    <div id="createProductModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full relative max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between border-b border-gray-200 px-4 py-3 sticky top-0 bg-white z-10">
                <h3 class="text-lg font-semibold text-gray-900">Ajouter un nouvel article</h3>
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
                            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                            <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>

                        <div class="col-span-2">
                            <label for="historical_context" class="block text-sm font-medium text-gray-700">Contexte Historique</label>
                            <textarea id="historical_context" name="historical_context" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>

                        <div>
                            <label for="starting_price" class="block text-sm font-medium text-gray-700">Prix de départ (€)</label>
                            <input type="number" id="starting_price" name="starting_price" min="0" step="0.01" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="auction_end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                            <input type="datetime-local" id="auction_end_date" name="auction_end_date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="col-span-2">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select id="category_id" name="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @foreach ($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Images</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <label for="images" class="cursor-pointer bg-white font-medium text-blue-600 hover:text-blue-500">
                                        <span>Upload Images</span>
                                        <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                    </label>
                                    <p class="text-xs text-gray-500">Max 4 images</p>
                                </div>
                            </div>
                            <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                        </div>



                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Tags</label>
                            <div class="mt-1">
                                <!-- Selected Tags Display -->
                                <div id="selectedTags" class="flex flex-wrap gap-2 mb-4"></div>

                                <!-- Simple Tag Dropdown -->
                                <select id="tagSelect" class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Sélectionner un tag</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}" data-name="{{$tag->name}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" id="cancelButton" class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white border border-transparent rounded-lg hover:bg-blue-700">
                            Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Simple JavaScript for functionality -->
    <script>
       // DOM Elements
const modal = document.getElementById('createProductModal');
const openModalBtn = document.getElementById('openCreateModal');
const closeModalBtn = document.getElementById('closeModalBtn');
const cancelButton = document.getElementById('cancelButton');
const imageInput = document.getElementById('images');
const imagePreview = document.getElementById('imagePreview');
const tagSelect = document.getElementById('tagSelect');
const selectedTagsContainer = document.getElementById('selectedTags');

// Selected tags storage
let selectedTags = new Set();
let selectedFiles = new DataTransfer();

// Modal functions
if (openModalBtn) {
    openModalBtn.addEventListener('click', function() {
        modal.classList.remove('hidden');
    });
}

if (closeModalBtn) {
    closeModalBtn.addEventListener('click', closeModal);
}

if (cancelButton) {
    cancelButton.addEventListener('click', closeModal);
}

// Close modal when clicking outside
if (modal) {
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
}

function closeModal() {
    if (modal) {
        modal.classList.add('hidden');

        // Reset form if it exists
        const form = document.getElementById('createProductForm');
        if (form) form.reset();

        // Clear image preview
        if (imagePreview) imagePreview.innerHTML = '';
        selectedFiles = new DataTransfer();

        // Clear selected tags
        selectedTags = new Set();
        if (selectedTagsContainer) selectedTagsContainer.innerHTML = '';
    }
}

// Image upload handling
if (imageInput) {
    imageInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);

        // Check total number of files (existing + new)
        if (selectedFiles.files.length + files.length > 4) {
            alert('Maximum 4 images allowed');
            return;
        }

        // Add new files to our collection
        files.forEach(file => {
            if (file.type.startsWith('image/')) {
                selectedFiles.items.add(file);
            }
        });

        // Update input with all files
        imageInput.files = selectedFiles.files;

        // Update preview
        updateImagePreview();
    });
}

function updateImagePreview() {
    if (!imagePreview) return;

    imagePreview.innerHTML = '';

    Array.from(selectedFiles.files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg">
                <button type="button"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6
                               flex items-center justify-center hidden group-hover:flex"
                        data-index="${index}">
                    &times;
                </button>
            `;

            div.querySelector('button').addEventListener('click', function() {
                removeImageFile(index);
            });

            imagePreview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

function removeImageFile(index) {
    const newFiles = new DataTransfer();

    Array.from(selectedFiles.files).forEach((file, i) => {
        if (i !== index) {
            newFiles.items.add(file);
        }
    });

    selectedFiles = newFiles;
    imageInput.files = selectedFiles.files;
    updateImagePreview();
}

// Tag selection functionality with simple select dropdown
if (tagSelect) {
    tagSelect.addEventListener('change', function() {
        if (!selectedTagsContainer) return;

        const tagId = this.value;
        const tagName = this.options[this.selectedIndex].dataset.name;

        if (tagId && !selectedTags.has(tagId)) {
            // Add tag
            selectedTags.add(tagId);

            const tagElement = document.createElement('div');
            tagElement.className = 'inline-flex items-center bg-blue-100 px-3 py-1 rounded-full text-sm font-medium text-blue-800';
            tagElement.innerHTML = `
                ${tagName}
                <input type="hidden" name="tags[]" value="${tagId}">
                <button type="button" class="ml-2 text-blue-600 hover:text-blue-800" onclick="removeTag('${tagId}')">&times;</button>
            `;
            selectedTagsContainer.appendChild(tagElement);

            // Reset select to default option
            this.selectedIndex = 0;
        }
    });
}

// Function to remove a tag
function removeTag(tagId) {
    const tagElement = document.querySelector(`input[value="${tagId}"]`).parentElement;
    if (tagElement) {
        tagElement.remove();
        selectedTags.delete(tagId);
    }
}
    </script>

@endsection
