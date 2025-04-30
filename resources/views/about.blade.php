@extends('components.layout')

@section('title', 'À propos - Enchères de Patrimoine Culturel')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">À propos de Nostalogia</h1>
        <p class="text-xl text-gray-600">Découvrez notre mission de préservation du patrimoine culturel</p>
        </div>

    <!-- Mission Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Notre Mission</h2>
        <p class="text-gray-700 leading-relaxed">
            Nostalogia est née d'une passion pour le patrimoine culturel et d'un désir de le rendre accessible à tous.
            Notre plateforme d'enchères en ligne permet aux collectionneurs, passionnés et amateurs d'art d'acquérir
            des pièces uniques tout en contribuant à la préservation de notre héritage culturel.
        </p>
        </div>

    <!-- Values Section -->
    <div class="grid md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-900 mb-3">Authenticité</h3>
            <p class="text-gray-700">
                Chaque pièce est rigoureusement vérifiée et authentifiée par nos experts pour garantir sa valeur
                historique et culturelle.
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-900 mb-3">Transparence</h3>
            <p class="text-gray-700">
                Nous assurons une totale transparence dans nos transactions et notre processus d'enchères pour
                bâtir la confiance avec notre communauté.
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-900 mb-3">Accessibilité</h3>
            <p class="text-gray-700">
                Notre plateforme rend le patrimoine culturel accessible à tous, des collectionneurs expérimentés
                aux nouveaux passionnés.
                </p>
            </div>
        </div>

    <!-- Team Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Notre Équipe</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="flex items-start space-x-4">
                <img src="{{ asset('images/team/expert1.jpg') }}"
                     alt="Expert en art"
                     class="w-24 h-24 rounded-full object-cover">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Dr. Sarah Martin</h3>
                    <p class="text-gray-600">Expert en art et patrimoine culturel</p>
                    <p class="text-gray-700 mt-2">
                        Plus de 15 ans d'expérience dans l'authentification et l'évaluation d'œuvres d'art.
                    </p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <img src="{{ asset('images/team/expert2.jpg') }}"
                     alt="Expert en histoire"
                     class="w-24 h-24 rounded-full object-cover">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Prof. Jean Dupont</h3>
                    <p class="text-gray-600">Historien et conservateur</p>
                    <p class="text-gray-700 mt-2">
                        Spécialiste en histoire de l'art et conservation du patrimoine culturel.
                    </p>
                </div>
            </div>
        </div>
            </div>

    <!-- Contact Section -->
    <div class="bg-gray-50 rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Contactez-nous</h2>
        <p class="text-gray-700 mb-6">
            Vous avez des questions sur notre plateforme ou souhaitez en savoir plus sur nos services ?
            N'hésitez pas à nous contacter.
        </p>
        <a href="{{ route('contact') }}"
           class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Nous contacter
                        </a>
                    </div>
                </div>
@endsection
