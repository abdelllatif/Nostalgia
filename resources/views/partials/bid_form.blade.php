@if(!$auth_user)
    <div class="text-center py-6 bg-blue-50 rounded-lg">
        <p class="text-blue-700 font-medium mb-4">Connectez-vous pour placer une enchère</p>
        <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Se connecter maintenant
        </a>
    </div>
@elseif($auth_user->id === $product->user_id)
    <div class="text-center py-6 bg-gray-50 rounded-lg">
        <p class="text-gray-700 font-medium">Vous ne pouvez pas enchérir sur votre propre produit</p>
    </div>
@else
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
                <button type="button" onclick="setBidAmount({{ $bid }})"
                        class="flex-1 py-2 px-3 border rounded text-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600">
                    {{ number_format($bid, 2) }} €
                </button>
            @endforeach
        </div>

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

        <form action="{{ route('bids.store', ['product' => $product->id]) }}" method="post" class="flex items-center space-x-4">
            @csrf
            <input name="amount"
                   id="bidAmount"
                   type="number"
                   min="{{ $currentPrice + 1 }}"
                   step="0.01"
                   placeholder="Autre montant (€)"
                   class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                Enchérir
            </button>
        </form>
    </div>
@endif
