<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manuscrit Médiéval Enluminé - Détail du produit</title>
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

    <!-- Fil d'Ariane -->
    <div class="bg-gray-100 dark:bg-gray-800 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                <a href="/" class="hover:text-gray-900 dark:hover:text-white">Accueil</a>
                <svg class="mx-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="/catalogue" class="hover:text-gray-900 dark:hover:text-white">Catalogue</a>
                <svg class="mx-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="/catalogue?category=manuscrits" class="hover:text-gray-900 dark:hover:text-white">Manuscrits</a>
                <svg class="mx-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-800 dark:text-gray-200">Manuscrit Médiéval Enluminé</span>
            </div>
        </div>
    </div>

    <!-- Contenu Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:grid lg:grid-cols-2 lg:gap-12">
            <!-- Galerie d'Images -->
            <div class="mb-8 lg:mb-0">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="relative h-96">
                        <img id="mainImage" src="{{ $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->image_path) : 'https://via.placeholder.com/400x300' }}"
                             alt="{{ $product->title }}"
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-4 gap-2 p-4">
                        @foreach($product->images as $index => $image)
                            <div class="cursor-pointer border-2 {{ $index === 0 ? 'border-blue-500' : 'border-gray-200 dark:border-gray-700' }} rounded-md overflow-hidden hover:border-blue-500"
                                 onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this)">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     alt="Image {{ $index + 1 }}"
                                     class="w-full h-20 object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Authentification et Provenance -->
                <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Information sur le vendeur</h3>
                    <div class="space-y-4 text-gray-700 dark:text-gray-300">
                        <div class="flex items-center">
                            <img src="{{ asset('storage/' . ($product->user->profile_image ?? 'anonymes_users/anonyme_user.jpg')) }}"
                                 alt="Profile"
                                 class="w-10 h-10 rounded-full object-cover">
                            <div class="ml-4">
                                <h4 class="font-medium">{{ $product->user->name }} {{ $product->user->first_name }}</h4>
                                <p class="text-sm text-gray-500">Membre depuis {{ $product->user->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations Produit et Enchères -->
            <div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <span class="inline-block bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ $product->category->name }}</span>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $product->title }}</h1>
                    <p class="text-gray-500 dark:text-gray-400">Listé le {{ $product->created_at->format('d/m/Y') }}</p>

                    <!-- État de l'enchère -->
                    <div class="mt-6 bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700 dark:text-gray-300">Prix actuel:</span>
                            <span class="text-2xl font-bold text-gray-900 dark:text-white">
                                @php
                                    $currentPrice = $product->bids->isNotEmpty() ? $product->bids->max('amount') : $product->starting_price;
                                @endphp
                                {{ number_format($currentPrice, 2) }} €
                            </span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 mb-4">
                            <span>Prix de départ: {{ number_format($product->starting_price, 2) }} €</span>
                            <span>{{ $product->bids->count() }} enchères</span>
                        </div>

                        <div class="mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ \Carbon\Carbon::parse($product->auction_end_date)->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm mt-1">
                                <span class="text-gray-600 dark:text-gray-400">Temps restant:</span>
                                <span class="text-red-600 dark:text-red-400 font-medium auction-timer" data-end-date="{{ $product->auction_end_date }}"></span>
                            </div>
                        </div>

                        <!-- Status Messages -->
                        @if($product->status === 'sold' && $product->user_id === ($auth_user->id ?? null))
                            <!-- Owner View -->
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                <strong class="font-bold">Félicitations!</strong>
                                <span class="block sm:inline"> Votre enchère a trouvé un acheteur!</span>
                                @php
                                    $winner = $product->bids()->orderBy('amount', 'desc')->first()->user;
                                @endphp
                                <div class="mt-2">
                                    <span class="block sm:inline">Gagnant: <a href="{{ route('user.show', $winner->id) }}" class="font-semibold hover:underline">{{ $winner->name }} {{ $winner->first_name }}</a></span>
                                </div>
                            </div>
                        @elseif($product->status === 'expired' && $product->user_id === ($auth_user->id ?? null))
                            <!-- Owner View - No Bids -->
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">
                                <strong class="font-bold">Malheureusement!</strong>
                                <span class="block sm:inline"> Votre enchère n'a pas trouvé d'acheteur.</span>
                                <div class="mt-4">
                                    <a href="{{ route('catalogue') }}" class="inline-block bg-yellow-700 text-white px-6 py-2 rounded-md hover:bg-yellow-800 font-medium">
                                        ajuouter d'autres enchères
                                    </a>
                                </div>
                            </div>
                        @elseif($product->status === 'sold' && $isWinner)
                            <!-- Winner View -->
                            @if($hasPaid)
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                    <strong class="font-bold">Félicitations!</strong>
                                    <span class="block sm:inline"> Vous avez gagné cette enchère et votre paiement a été effectué.</span>
                                </div>
                                <a href="{{ route('payment.download-ticket', ['product' => $product->id]) }}"
                                   class="block w-full text-center bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-medium mb-4">
                                    Télécharger votre ticket
                                </a>
                            @else
                                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4">
                                    <strong class="font-bold">Félicitations!</strong>
                                    <span class="block sm:inline"> Vous avez gagné cette enchère! Veuillez procéder au paiement.</span>
                                </div>
                                <a href="{{ route('payment.checkout', ['product' => $product->id]) }}"
                                   class="block w-full text-center bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-medium mb-4">
                                    Payer maintenant
                                </a>
                            @endif
                        @endif

                        <!-- Enchérir -->
                        @if($product->status === 'active' && $product->auction_end_date->isFuture())
                            @if($auth_user && $auth_user->id != $product->user_id)
                                <div>
                                    <div class="flex space-x-4 mb-4">
                                        @php
                                            $currentPrice = $product->bids->isNotEmpty() ? $product->bids->max('amount') : $product->starting_price;
                                            $suggestedBids = [
                                                $currentPrice + 100,
                                                $currentPrice + 200,
                                                $currentPrice + 500
                                            ];
                                        @endphp
                                        @foreach($suggestedBids as $bid)
                                            <button onclick="setBidAmount({{ $bid }})" class="flex-1 py-2 px-3 border rounded text-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600">
                                                {{ number_format($bid, 2) }} €
                                            </button>
                                        @endforeach
                                    </div>
                                    <div>
                                        @if (session('success'))
                                            <div class="alert alert-success bg-green-200 text-green-700 border py-2 border-green-700 rounded-xl text-center mb-4">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger bg-red-200 text-red-700 border border-red-700 rounded-xl text-center mb-4">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <form action="{{ route('bids.store', $product->id) }}" method="post" class="flex items-center space-x-4">
                                            @csrf
                                            <input name="amount" id="bidAmount" type="number" min="{{ $currentPrice + 1 }}" step="0.01" placeholder="Autre montant (€)"
                                                   class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                            <input name="product_id" type="hidden" value="{{ $product->id }}">
                                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Enchérir</button>
                                        </form>
                                    </div>
                                </div>
                            @elseif($auth_user && $auth_user->id === $product->user_id)
                                <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                                    <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-2">Statut de votre enchère</h3>
                                    <div class="space-y-2">
                                        @if($product->bids->isNotEmpty())
                                            <p class="text-blue-700 dark:text-blue-300">
                                                Vous avez actuellement {{ $product->bids->count() }} enchère(s).
                                                Les détails des enchères sont affichés ci-dessous.
                                            </p>
                                        @else
                                            <p class="text-blue-700 dark:text-blue-300">
                                                Aucune enchère n'a été placée pour le moment.
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mt-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Description</h2>
                        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                            {{ $product->description }}
                        </div>
                    </div>

                    <!-- Contexte Historique -->
                    <div class="mt-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Contexte Historique</h2>
                        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                            {{ $product->historical_context }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historique des enchères -->
        <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Historique des enchères</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Enchérisseur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($product->bids->sortByDesc('amount')->take(5) as $bid)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 flex-shrink-0 rounded-full bg-gray-200 overflow-hidden">
                                            <img src="{{ asset('storage/' . ($bid->user->profile_image ?? 'anonymes_users/anonyme_user.jpg')) }}"
                                                 alt="Avatar"
                                                 class="h-full w-full object-cover">
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $bid->user->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-medium">{{ number_format($bid->amount, 2) }} €</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $bid->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($product->bids->count() > 5)
                <div class="mt-4 text-center">
                    <button id="see-more" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                        Voir toutes les enchères ({{ $product->bids->count() }})
                    </button>
                </div>

                <div id="extra-bids" class="hidden mt-4">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($product->bids->sortByDesc('amount')->slice(5) as $bid)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 flex-shrink-0 rounded-full bg-gray-200 overflow-hidden">
                                                <img src="{{ asset('storage/' . ($bid->user->profile_image ?? 'anonymes_users/anonyme_user.jpg')) }}"
                                                     alt="Avatar"
                                                     class="h-full w-full object-cover">
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $bid->user->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-medium">{{ number_format($bid->amount, 2) }} €</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $bid->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Objets similaires -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Objets similaires</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ( $product->simmilar_product as $simmillar)
                        <a href="{{route('product.details',['product'=>$simmillar->id])}}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="relative h-48">
                                <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fG9sZCUyMGJvb2t8ZW58MHx8MHx8fDA%3D"
                                    alt="Psautier médiéval"
                                    class="w-full h-full object-cover">
                                <div class="absolute top-2 right-2 bg-blue-600 text-white px-2 py-1 text-xs rounded-full">
                                    Enchère
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">{{ $simmillar->title}}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $simmillar->category->name}}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $simmillar->starting_price}} €</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">5 enchères</span>
                                </div>
                                <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                                    <span class="font-medium auction-timer" data-end-date="{{ $simmillar->auction_end_date }}"></span>
                                </div>
                            </div>
                        </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 mt-16 border-t border-gray-200 dark:border-gray-800">

    </footer>
    <script>
    function changeMainImage(src, element) {
        document.getElementById('mainImage').src = src;
        // Update border of selected thumbnail
        document.querySelectorAll('.grid > div').forEach(div => {
            div.classList.remove('border-blue-500');
            div.classList.add('border-gray-200', 'dark:border-gray-700');
        });
        element.classList.remove('border-gray-200', 'dark:border-gray-700');
        element.classList.add('border-blue-500');
    }

    function setBidAmount(amount) {
        document.getElementById('bidAmount').value = amount;
    }

    function updateAuctionTimers() {
        document.querySelectorAll('.auction-timer').forEach(timer => {
            const endDate = new Date(timer.getAttribute('data-end-date'));
            const now = new Date();

            if (now >= endDate) {
                timer.textContent = 'Terminé';
                return;
            }

            const diff = endDate - now;
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            timer.textContent = `${days}j ${hours}h ${minutes}m ${seconds}s`;
        });
    }

    // Update timers every second
    setInterval(updateAuctionTimers, 1000);
    updateAuctionTimers();

    // See more/less functionality for bids
    const seeMoreBtn = document.getElementById('see-more');
    const extraBids = document.getElementById('extra-bids');

    if (seeMoreBtn && extraBids) {
        seeMoreBtn.addEventListener('click', () => {
            if (extraBids.classList.contains('hidden')) {
                extraBids.classList.remove('hidden');
                seeMoreBtn.innerText = 'Voir moins';
            } else {
                extraBids.classList.add('hidden');
                seeMoreBtn.innerText = 'Voir toutes les enchères';
            }
        });
    }
    </script>
</body>
</html>
