@extends('components.layout')

@section('title', 'À propos - Enchères de Patrimoine Culturel')

@section('content')

    <!-- Header  -->
    <section class="relative  bg-gray-50 dark:bg-gray-900 py-16">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-white opacity-80"></div>
            <img src="https://images.unsplash.com/photo-1715844496650-9e0253756788?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8Z2xvcnklMjBjdXB8ZW58MHx8MHx8fDA%3D"
                 alt="Nostalogia About Background"
                 class="w-full h-full object-fit py-1     ">
                </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-24">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
                    À Propos de Nostalogia
                </h1>
                <p class="mt-6 text-xl text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
                    Découvrez notre histoire, notre mission et notre vision pour la préservation du patrimoine culturel.
                </p>
            </div>
        </div>
    </section>

    <!--  Histoire  de nous-->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        Notre Histoire
                    </h2>
                    <div class="mt-8 text-lg text-gray-600 dark:text-gray-400 space-y-4">
                        <p>
                            Fondée en 2020 par un groupe de passionnés d'art et de patrimoine culturel, Nostalogia est née d'une vision commune : créer un pont entre le passé et le présent, en rendant accessible à tous des trésors culturels jusqu'alors réservés à une élite.
                        </p>
                        <p>
                            Ce qui a commencé comme une petite plateforme spécialisée dans les manuscrits anciens s'est rapidement développé pour inclure une vaste gamme d'artefacts culturels, allant des œuvres d'art classiques aux objets historiques significatifs.
                        </p>
                        <p>
                            Aujourd'hui, Nostalogia est reconnue comme l'une des principales plateformes d'enchères dédiées au patrimoine culturel, avec une communauté mondiale de collectionneurs, d'institutions et de passionnés d'histoire.
                        </p>
                    </div>
                </div>
                <div class="mt-10 lg:mt-0">
                    <div class="relative aspect-w-16 aspect-h-9 rounded-lg shadow-lg overflow-hidden">
                        <img src="https://plus.unsplash.com/premium_photo-1661940814738-5a028d647d3a?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZW5jaGVyZXxlbnwwfHwwfHx8MA%3D%3D"
                             alt="Notre histoire"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notre Mission  -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                <div class="order-2 lg:order-1 mt-10 lg:mt-0">
                    <div class="relative aspect-w-16 aspect-h-9 rounded-lg shadow-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1572953109213-3be62398eb95?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
                             alt="Notre mission"
                             class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        Notre Mission
                    </h2>
                    <div class="mt-8 text-lg text-gray-600 dark:text-gray-400 space-y-4">
                        <p>
                            Chez Nostalogia, notre mission est de préserver, valoriser et partager le patrimoine culturel mondial à travers une plateforme d'enchères innovante et responsable.
                        </p>
                        <p>
                            Nous nous engageons à:
                        </p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Garantir l'authenticité et la traçabilité de chaque pièce présente sur notre plateforme</li>
                            <li>Promouvoir l'éducation et la sensibilisation à l'importance du patrimoine culturel</li>
                            <li>Faciliter l'accès à des objets culturels significatifs pour les collectionneurs privés et les institutions</li>
                            <li>Contribuer à la préservation des trésors culturels pour les générations futures</li>
                        </ul>
                        <p>
                            Nous croyons fermement que chaque artefact a une histoire à raconter, et nous nous efforçons de donner une voix à ces témoins silencieux du passé.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notre Équipe  -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    Notre Équipe
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
                    Des experts passionnés qui œuvrent chaque jour pour préserver notre patrimoine culturel.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Membre 1 -->
                <div class="text-center">
                    <div class="space-y-4">
                        <img class="mx-auto h-40 w-40 rounded-full xl:w-56 xl:h-56 object-cover"
                             src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                             alt="Pierre Martin">
                        <div class="space-y-2">
                            <div class="text-lg leading-6 font-medium space-y-1">
                                <h3 class="text-gray-900 dark:text-white">Pierre Martin</h3>
                                <p class="text-blue-600">Fondateur & Directeur</p>
                            </div>
                            <div class="text-gray-500 dark:text-gray-400">
                                <p>Historien de l'art avec plus de 20 ans d'expérience dans le domaine des enchères culturelles.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Membre 2 -->
                <div class="text-center">
                    <div class="space-y-4">
                        <img class="mx-auto h-40 w-40 rounded-full xl:w-56 xl:h-56 object-cover"
                             src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                             alt="Marie Lefèvre">
                        <div class="space-y-2">
                            <div class="text-lg leading-6 font-medium space-y-1">
                                <h3 class="text-gray-900 dark:text-white">Marie Lefèvre</h3>
                                <p class="text-blue-600">Responsable des Authentifications</p>
                            </div>
                            <div class="text-gray-500 dark:text-gray-400">
                                <p>Archéologue spécialisée dans l'authentification et la datation des artefacts historiques.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Membre 3 -->
                <div class="text-center">
                    <div class="space-y-4">
                        <img class="mx-auto h-40 w-40 rounded-full xl:w-56 xl:h-56 object-cover"
                             src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                             alt="Thomas Dubois">
                        <div class="space-y-2">
                            <div class="text-lg leading-6 font-medium space-y-1">
                                <h3 class="text-gray-900 dark:text-white">Thomas Dubois</h3>
                                <p class="text-blue-600">Directeur Technologique</p>
                            </div>
                            <div class="text-gray-500 dark:text-gray-400">
                                <p>Expert en technologies numériques appliquées à la préservation et à la diffusion du patrimoine culturel.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notre Valeurs  -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    Nos Valeurs
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
                    Les principes qui guident nos actions et nos décisions au quotidien.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!--ici Valeur 1 -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-gray-600 text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="mt-3 text-lg font-medium text-gray-900 dark:text-white">Authenticité</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">
                            Nous garantissons l'origine et l'authenticité de chaque pièce mise aux enchères sur notre plateforme, grâce à un processus rigoureux d'authentification et de vérification.
                        </p>
                    </div>
                </div>

                <!-- cest la Valeur 2 -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-gray-600 text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <h3 class="mt-3 text-lg font-medium text-gray-900 dark:text-white">Transparence</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">
                            Chaque transaction est menée avec une transparence totale, depuis l'historique de l'objet jusqu'aux détails de l'enchère, pour instaurer une relation de confiance avec notre communauté.
                        </p>
                    </div>
                </div>

                <!-- Valeur 3 -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-gray-600 text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <h3 class="mt-3 text-lg font-medium text-gray-900 dark:text-white">Accessibilité</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">
                            Nous nous efforçons de rendre le patrimoine culturel accessible à tous, en démocratisant l'accès aux enchères culturelles et en éduquant le public sur l'importance de la préservation.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages Section -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    Ce que disent nos clients
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
                    Découvrez les expériences de notre communauté de collectionneurs et d'amateurs d'art.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Témoignage 1 -->
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 italic">
                        <p>"Nostalogia a transformé ma façon de collectionner des objets historiques. La plateforme est intuitive, les authentifications sont rigoureuses, et j'ai pu acquérir des pièces que je cherchais depuis des années."</p>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Sophie Bernard">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Sophie Bernard</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Collectionneuse d'art</p>
                        </div>
                    </div>
                </div>

                <!-- Temoignage 2 -->
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 italic">
                        <p>"En tant que conservateur de musée, je suis impressionné par la qualité des artefacts proposés sur Nostalogia. Leur processus d'authentification est parmi les plus rigoureux que j'ai rencontrés dans l'industrie."</p>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Marc Lambert">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Marc Lambert</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Conservateur de musée</p>
                        </div>
                    </div>
                </div>

                <!-- Temoignage 3 -->
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 italic">
                        <p>"J'ai vendu plusieurs pièces de ma collection familiale sur Nostalogia. Le processus était simple, transparent, et j'ai été satisfaite de voir mes objets trouver un nouveau foyer où ils seront appréciés."</p>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Isabelle Moreau">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Isabelle Moreau</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Vendeuse</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact  -->
    <section class="py-12 bg-gray-600 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Vous avez des questions?
                </h2>
                <p class="mt-4 text-xl text-gray-100 max-w-2xl mx-auto">
                    Notre équipe est à votre disposition pour vous aider dans votre expérience Nostalogia.
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-md shadow">
                        <a href="/contact" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-gray-600 bg-white hover:bg-gray-50">
                            Contactez-nous
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
