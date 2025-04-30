@extends('components.layout')

@section('title', $product->title . ' - Enchères de Patrimoine Culturel')

@section('content')
    <!-- Product Details Header -->
    <div class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-gray-900">{{ $product->title }}</h1>
            <p class="mt-2 text-lg text-gray-600">{{ $product->description }}</p>
        </div>
    </div>

    <!-- Product Details Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="relative h-96">
                    <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                         alt="{{ $product->title }}"
                         class="w-full h-full object-cover">
                </div>
                @if($product->images->count() > 1)
                <div class="grid grid-cols-4 gap-2 p-4">
                    @foreach($product->images->skip(1) as $image)
                    <div class="h-24 overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                             alt="{{ $product->title }}"
                             class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
                @endif
                            </div>

            <!-- Product Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Informations sur l'enchère</h2>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-gray-900">{{ number_format($product->current_price, 2) }}€</span>
                        <span class="text-sm text-gray-500">{{ $product->bids_count }} enchères</span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6 mb-6">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">Prix de départ:</span>
                        <span class="font-medium">{{ number_format($product->starting_price, 2) }}€</span>
                    </div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">Fin de l'enchère:</span>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($product->auction_end_date)->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Catégorie:</span>
                        <span class="font-medium">{{ $product->category->name }}</span>
                            </div>
                        </div>

                @if(auth()->check() && !$product->hasEnded())
                <form action="{{ route('bids.store') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Votre enchère (€)</label>
                        <input type="number" id="amount" name="amount" min="{{ $product->current_price + 1 }}" step="0.01" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Placer une enchère
                    </button>
                </form>
                @elseif(!auth()->check())
                <div class="mb-6">
                    <a href="{{ route('login') }}" class="block w-full text-center bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Connectez-vous pour enchérir
                    </a>
                                        </div>
                                    @endif

                <!-- Seller Info -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Vendeur</h3>
                    <div class="flex items-center">
                        <img src="{{ $product->user->profile_image ? asset('storage/' . $product->user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($product->user->name) }}"
                             alt="{{ $product->user->name }}"
                             class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-900">{{ $product->user->name }}</h4>
                            <a href="{{ route('users.show', $product->user->id) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                Voir le profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
            <div class="prose max-w-none">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>

        <!-- Bids History -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Historique des enchères</h2>
            @if($product->bids->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enchérisseur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($product->bids->sortByDesc('created_at') as $bid)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                    <img src="{{ $bid->user->profile_image ? asset('storage/' . $bid->user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($bid->user->name) }}"
                                         alt="{{ $bid->user->name }}"
                                         class="w-8 h-8 rounded-full object-cover">
                                    <span class="ml-2 text-sm text-gray-900">{{ $bid->user->name }}</span>
                                    </div>
                                </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($bid->amount, 2) }}€
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $bid->created_at->format('d/m/Y H:i') }}
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-gray-500">Aucune enchère pour le moment.</p>
            @endif
        </div>
    </div>
@endsection
