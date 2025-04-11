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
        <div class="absolute inset-0 h-94 bg-white opacity-60">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-600 to-gray-900 opacity-60"></div>
            <img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2674&q=80"
                 alt="Nostalogia Catalogue Background"
                 class="w-full h-full object-cover ">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-12 pb-6">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                    Catalogue des Enchères
                </h1>
                <p class="mt-4 text-xl text-gray-700 max-w-2xl mx-auto">
                    Découvrez notre collection exceptionnelle d'objets patrimoniaux et culturels disponibles aux enchères.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white w-full">
<div class="flex items-center bg-white p-4 rounded-xl shadow-sm space-x-4 w-full max-w-2xl mx-auto">
    <img
      src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2674&q=80"
      class="w-10 h-10 rounded-full object-cover"
      alt="Profile"
    >
    <input
      id="openCreateModal"
      type="text"
      placeholder="Ajouter nouveu produit?"
      class="flex-1 bg-gray-200 hover:bg-gray-300 transition px-4 py-2 rounded-full focus:outline-none cursor-pointer text-sm text-gray-700"
      readonly>
    </div>
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
<div id="createProductModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full relative max-h-[500px] overflow-hidden">
      <div class="flex items-center justify-between border-b px-4 py-3 sticky top-0 bg-white z-10">
        <h3 class="text-lg font-semibold text-gray-900">Ajouter un nouvel article</h3>
        <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500 focus:outline-none" aria-label="Fermer">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="px-4 py-4 overflow-y-auto" style="max-height: calc(500px - 120px);">
        <form id="createProductForm" action="{{route('catalogue.store')}}" method="POST">
            @csrf
          <div class="mb-3">
            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="mb-3">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="2" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
          <div class="mb-3">
            <label for="historical_context" class="block text-sm font-medium text-gray-700">Contexte Historique</label>
            <textarea id="historical_context" name="historical_context" rows="2" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
          <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
              <label for="starting_price" class="block text-sm font-medium text-gray-700">Prix de départ (€)</label>
              <input type="number" id="starting_price" name="starting_price" min="0" step="0.01" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="auction_end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
              <input type="date" id="auction_end_date" name="auction_end_date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>
          <div class="mb-3">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select id="category_id" name="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              @foreach ($categories as $categorie)
                <option value="{{$categorie->id}}"><img src="{{asset('storage/'.$categorie->image)}}" alt="categorie image"> {{$categorie->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700">Images</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-6 w-6 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m0-8z"></path>
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
          <div class="mb-3">
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
            <select id="tags" name="tags[]" multiple class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
             @foreach ( $tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
             @endforeach
            </select>
            <p class="mt-1 text-xs text-gray-500">Ctrl+clic pour sélections multiples</p>
          </div>
      </div>

      <!-- Modal Footer -->
      <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-end rounded-b-lg sticky bottom-0">
        <button type="button" id="cancelButton" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mr-2">
          Annuler
        </button>
        <button type="submit" id="submitButton" class="bg-blue-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700">
          Créer
        </button>
    </form>

      </div>
    </div>
  </div>
    </section>

    <!-- Filter Section -->
    <section class="bg-white shadow-md py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="category" class="text-gray-700 font-medium">Catégorie:</label>
                    <select id="category" class="form-select rounded-md border-gray-300 shadow-sm">
                        <option value="">Toutes les catégories</option>
                        @foreach ($categories as $categorie)
                <option value="{{$categorie->id}}"><img src="{{asset('storage/'.$categorie->image)}}" alt="categorie image"> {{$categorie->name}}</option>
              @endforeach
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="period" class="text-gray-700 font-medium">Époque:</label>
                    <select id="period" class="form-select rounded-md border-gray-300 shadow-sm">
                        <option value="">Toutes les époques</option>
                        <option value="antiquite">Antiquité</option>
                        <option value="medieval">Médiéval</option>
                        <option value="renaissance">Renaissance</option>
                        <option value="moderne">Époque Moderne</option>
                        <option value="contemporain">Art Contemporain</option>
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="sort" class="text-gray-700 font-medium">Trier par:</label>
                    <select id="sort" class="form-select rounded-md border-gray-300 shadow-sm">
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
                    <input type="text" placeholder="Rechercher dans le catalogue..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
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
                @foreach ($products as $product )
        <!-- Example Item -->
                        <div class="rounded-lg shadow-lg overflow-hidden bg-white transition-transform duration-300 hover:scale-105">
                            <div class="h-64 w-full overflow-hidden">
                                <img src="https://plus.unsplash.com/premium_photo-1743096946788-b8d8304542d1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwzfHx" alt="Tableau historique" class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-6">
                                <span class="inline-block bg-green-300 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mb-2">{{$product->category->name}}</span>
                                <h3 class="text-xl font-bold text-gray-900">{{$product->title}}</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-gray-600 font-semibold">Prix actuel: {{$product->starting_price}}€</span>
                                    <span class="ml-auto text-gray-500 text-sm">12 enchères</span>
                                </div>
                                <div class="mt-4 border-t border-gray-200 pt-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Fin de l'enchère:</span>
                                        <span class="countdown text-gray-900 font-medium" data-end="{{ $product->auction_end_date }}"></span>
                                    </div>
                                </div>
                                <a href="{{route('product.details',['id'=>$product->id])}}" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700">
                                    Voir les détails
                                </a>
                            </div>
                        </div>
                @endforeach

                <!-- Repeat similar cards -->
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Restez informé
                </h2>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Abonnez-vous à notre newsletter pour recevoir des mises à jour sur les nouvelles enchères, événements et articles de blog.
                </p>
                <div class="mt-8 max-w-xl mx-auto">
                    <form class="sm:flex">
                        <label for="email-address" class="sr-only">Adresse email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required class="w-full px-5 py-3 border border-gray-300 shadow-sm placeholder-gray-400 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                            <button type="submit" class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                                S'abonner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 bg-gray-600">
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
                        <a href="/expertise" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700">
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
    <script src="{{ asset('storage/js/blog.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const countdowns = document.querySelectorAll('.countdown');

            countdowns.forEach(el => {
                const end = new Date(el.dataset.end);

                const update = () => {
                    const now = new Date();
                    let diff = Math.floor((end - now) / 1000);

                    if (diff <= 0) {
                        el.textContent = "Auction ended";
                        clearInterval(timer);
                        return;
                    }

                    const d = Math.floor(diff / 86400);
                    diff %= 86400;
                    const h = Math.floor(diff / 3600);
                    diff %= 3600;
                    const m = Math.floor(diff / 60);
                    const s = diff % 60;

                    el.textContent = `${d}d ${h}h:${m}m:${s}s`;
                };

                update();
                const timer = setInterval(update, 1000);
            });
        });
        </script>

</body>
</html>
