@extends('components.layout')

@section('title', 'Contact - Enchères de Patrimoine Culturel')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Contactez-nous</h1>
        <p class="text-xl text-gray-600">Notre équipe est à votre disposition pour répondre à vos questions</p>
    </div>

    <!-- Contact Form Section -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-12">
        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">Sujet</label>
                <input type="text" name="subject" id="subject" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="6" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Envoyer le message
                </button>
            </div>
        </form>
    </div>

    <!-- Contact Information -->
    <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Informations de contact</h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-gray-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <div class="ml-3">
                        <p class="text-gray-900 font-medium">Adresse</p>
                        <p class="text-gray-600">123 Rue du Patrimoine<br>75001 Paris, France</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-gray-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <div class="ml-3">
                        <p class="text-gray-900 font-medium">Téléphone</p>
                        <p class="text-gray-600">+33 1 23 45 67 89</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-gray-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div class="ml-3">
                        <p class="text-gray-900 font-medium">Email</p>
                        <p class="text-gray-600">contact@nostalogia.com</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Horaires d'ouverture</h2>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Lundi - Vendredi</span>
                    <span class="text-gray-900 font-medium">9h00 - 18h00</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Samedi</span>
                    <span class="text-gray-900 font-medium">10h00 - 17h00</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Dimanche</span>
                    <span class="text-gray-900 font-medium">Fermé</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
