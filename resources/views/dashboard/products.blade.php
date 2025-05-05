@extends('components.dashboard-layout')

@section('title', 'Produits')

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h2 class="text-2xl font-semibold mb-4">Liste des Produits</h2>

        <!-- Add your products content here -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Example product card -->
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                <h3 class="text-lg font-medium mb-2">Nom du Produit</h3>
                <p class="text-gray-600 dark:text-gray-300">Description du produit</p>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-sm text-gray-500">Prix: 100€</span>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
