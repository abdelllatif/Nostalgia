@extends('components.layout')

@section('title', 'Accueil - Enchères de Patrimoine Culturel')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gray-50 dark:bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-600/30 to-gray-900/30 dark:from-gray-900/60 dark:to-gray-950/60"></div>
            <img src="https://images.unsplash.com/photo-1461360228754-6e81c478b882?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2674&q=80"
                 alt="Nostalogia Hero Background"
                 class="w-full h-full object-cover mix-blend-overlay dark:mix-blend-soft-light">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-24 lg:py-32">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                    <span class="block">Nostalogia</span>
                    <span class="block text-gray-600 dark:text-gray-500">Enchères de Patrimoine Culturel</span>
                </h1>
                <p class="mt-6 text-xl text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
                    Découvrez et préservez des pièces culturelles rares et uniques. Une plateforme d'enchères interactive dédiée au patrimoine culturel.
                </p>
                <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                    <div class="flex space-x-4">
                        <a href="/catalogue" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500 md:py-4 md:text-lg md:px-10">
                            Explorer le Catalogue
                        </a>
                        <a href="/apropos" class="w-full flex items-center justify-center px-8 py-3 border border-gray-300 dark:border-gray-700 text-base font-medium rounded-md text-gray-900 dark:text-white bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 md:py-4 md:text-lg md:px-10">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Top Categories Section -->
    <section class="py-12 bg-white ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    Catégories Populaires
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
                    Explorez nos catégories les plus actives.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                @foreach($topCategories as $category)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                    <div class="mt-4 space-y-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $category->article_count }} articles
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $category->product_count }} produits
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Featured Products Section -->
    <div class="py-12 bg-gray-50 ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    Produits Populaires
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 dark:text-gray-400 sm:mt-4">
                    Découvrez nos articles les plus convoités
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($products as $product)
                <div class="rounded-lg shadow-lg overflow-hidden bg-gray-50 dark:bg-gray-900 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'https://images.unsplash.com/photo-1741805190625-7386d2180e57?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1M3x8fGVufDB8fHx8fA%3D%3D' }}"
                            alt="{{ $product->title }}"
                            class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $product->title }}</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-500 font-semibold">Prix de départ: {{ number_format($product->starting_price, 2) }}€</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">{{ $product->bids_count }} enchères</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Fin de l'enchère:</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ \Carbon\Carbon::parse($product->auction_end_date)->format('d F, H:i') }}</span>
                            </div>
                        </div>
                        <a href="/produit/{{ $product->id }}" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Voir les détails
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Articles Section -->
    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    Articles Populaires
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 dark:text-gray-400 sm:mt-4">
                    Les articles les plus discutés de notre communauté
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($articles as $article)
                <div class="rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transition-transform duration-300 hover:scale-105">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="{{ $article->image_url }}"
                            alt="{{ $article->title }}"
                            class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $article->title }}</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-600 dark:text-gray-500">Par {{ $article->user->name }}</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400 text-sm">{{ $article->comments_count }} commentaires</span>
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Catégorie:</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ $article->categorie->name }}</span>
                            </div>
                        </div>
                        <a href="/article/{{ $article->id }}" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                            Lire l'article
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        À Propos de Nostalogia
                    </h2>
                    <div class="mt-8 text-lg text-gray-600 dark:text-gray-400 space-y-4">
                        <p>
                            Nostalogia est une plateforme innovante dédiée à la préservation et à la diffusion du patrimoine culturel. Notre mission est de rendre la culture accessible à tous tout en garantissant un environnement sécurisé pour la vente et l'achat de pièces culturelles uniques.
                        </p>
                        <p>
                            Nous mettons en relation passionnés, collectionneurs et institutions culturelles dans un écosystème qui valorise l'authenticité et la transparence.
                        </p>
                        <p>
                            Chaque transaction sur notre plateforme contribue à la préservation de notre héritage culturel commun, permettant à ces trésors d'être appréciés par les générations futures.
                        </p>
                    </div>
                    <div class="mt-8 flex">
                        <div class="inline-flex rounded-md shadow">
                            <a href="/apropos" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-10 lg:mt-0">
                    <div class="relative aspect-w-16 aspect-h-9 rounded-lg shadow-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1566054757965-8c4085344c96?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
                             alt="Galerie d'art"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 bg-gray-600 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-black sm:text-4xl">
                    Prêt à rejoindre l'aventure Nostalogia?
                </h2>
                <p class="mt-4 text-xl text-gray-100 max-w-2xl mx-auto">
                    Créez un compte dès maintenant pour commencer à enchérir ou vendre des pièces culturelles uniques.
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-md shadow">
                        <a href="/register" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-gray-600 bg-white hover:bg-gray-50">
                            S'inscrire
                        </a>
                    </div>
                    <div class="ml-3 inline-flex">
                        <a href="/login" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-800 dark:bg-gray-900 hover:bg-gray-700 dark:hover:bg-gray-700">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
