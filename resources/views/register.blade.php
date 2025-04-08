<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Nostalogia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Header Banner with Logo -->
    <div class="bg-gray-700 dark:bg-gray-800 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <a href="/" class="text-white text-2xl font-bold">Nostalogia</a>
                <nav class="space-x-4">
                    <a href="/login" class="text-gray-300 hover:text-white">Se connecter</a>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                    Créer un compte
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                    Rejoignez Nostalogia pour participer aux enchères de patrimoine culturel
                </p>
            </div>
            <form class="mt-8 space-y-6" action="/register" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nom d'utilisateur
                    </label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                </div>

                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Prénom
                    </label>
                    <div class="mt-1">
                        <input id="first_name" name="first_name" type="text" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Adresse email
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Numéro de téléphone (optionnel)
                    </label>
                    <div class="mt-1">
                        <input id="phone_number" name="phone_number" type="text"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Mot de passe
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Confirmer le mot de passe
                    </label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                </div>

                <!-- Identity Image Upload -->
                <div>
                    <label for="identity_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pièce d'identité (obligatoire)
                    </label>
                    <div class="mt-1">
                        <input id="identity_image" name="identity_image" type="file" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400
                               focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Cette pièce sera utilisée pour vérifier votre identité</p>
                </div>
                <div>
                    <a href="terms" class="text-green-400">
                        voir les terms et polysies?
                    </a>
                </div>
                <!-- Terms and Conditions -->
                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                           class="h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded dark:border-gray-700">
                    <label for="terms" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        J'accepte les <a href="#" class="text-gray-600 dark:text-gray-400 hover:underline">conditions d'utilisation</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Créer mon compte
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Vous avez déjà un compte? <a href="/login" class="font-medium text-gray-600 dark:text-gray-400 hover:underline">Se connecter</a>
                </p>
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
