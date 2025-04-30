@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Paiement pour {{ $product->title }}</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Summary -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Récapitulatif de l'enchère</h2>

                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Produit:</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $product->title }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Montant de l'enchère gagnante:</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ number_format($highestBid->amount, 2) }} €</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Date de l'enchère:</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $highestBid->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Méthode de paiement</h2>

                        <form action="{{ route('payments.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="amount" value="{{ $highestBid->amount }}">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Choisissez votre méthode de paiement
                                </label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" id="paypal" value="paypal" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" checked>
                                        <label for="paypal" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            PayPal
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" id="credit_card" value="credit_card" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="credit_card" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Carte de crédit
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Payer {{ number_format($highestBid->amount, 2) }} €
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
