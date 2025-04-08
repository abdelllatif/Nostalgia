<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En attente d'approbation - Nostalogia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Header Banner with Logo -->
    <div class="bg-gray-700 dark:bg-gray-800 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <a href="/" class="text-white text-2xl font-bold">Nostalogia</a>
                <nav class="space-x-4">
                    <a href="/" class="text-gray-300 hover:text-white">Accueil</a>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg w-full space-y-8 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg text-center">
            <div>
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 dark:bg-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600 dark:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                    Inscription réussie !
                </h2>
                <p class="mt-4 text-center text-lg text-gray-600 dark:text-gray-400">
                    Votre compte est en attente d'approbation
                </p>
            </div>

            <div class="border-t border-b border-gray-200 dark:border-gray-700 py-6">
                <div class="prose prose-sm mx-auto text-gray-700 dark:text-gray-300">
                    <p class="mb-4">
                        Merci d'avoir rejoint Nostalogia, plateforme d'enchères de patrimoine culturel.
                    </p>
                    <p class="mb-4">
                        Notre équipe va examiner votre demande d'inscription et vérifier les documents fournis dans les plus brefs délais, généralement sous 24 à 48 heures ouvrables.
                    </p>
                    <p class="mb-4">
                        Vous recevrez un e-mail à l'adresse <span class="font-medium text-gray-900 dark:text-white">{{-- $user->email --}}</span> dès que votre compte sera approuvé.
                    </p>
                    <p class="mb-4">
                        Cette vérification est nécessaire pour garantir la sécurité et l'intégrité de notre plateforme d'enchères.
                    </p>
                </div>
            </div>

            <div class="py-4">
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <a href="/" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500">
                        Retour à l'accueil
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="mt-6">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Questions fréquentes
                </p>
                <div class="mt-4 space-y-4 text-left">
                    <details class="border border-gray-200 dark:border-gray-700 rounded-md p-4">
                        <summary class="font-medium text-gray-900 dark:text-white cursor-pointer">
                            Combien de temps dure le processus d'approbation ?
                        </summary>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            Le processus d'approbation prend généralement entre 24 et 48 heures ouvrables. Dans certains cas, nous pouvons vous demander des informations complémentaires.
                        </p>
                    </details>
                    <details class="border border-gray-200 dark:border-gray-700 rounded-md p-4">
                        <summary class="font-medium text-gray-900 dark:text-white cursor-pointer">
                            Pourquoi ma pièce d'identité est-elle nécessaire ?
                        </summary>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            La vérification d'identité est essentielle pour garantir la sécurité des transactions sur Nostalogia et pour respecter les réglementations concernant la vente d'objets de patrimoine culturel.
                        </p>
                    </details>
                    <details class="border border-gray-200 dark:border-gray-700 rounded-md p-4">
                        <summary class="font-medium text-gray-900 dark:text-white cursor-pointer">
                            Que faire si mon compte n'est pas approuvé ?
                        </summary>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            Si votre compte n'est pas approuvé, vous recevrez un e-mail expliquant les raisons. Vous pourrez alors soumettre une nouvelle demande avec les informations corrigées ou complémentaires.
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="max-w-7xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <p>&copy; 2025 Nostalogia. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
