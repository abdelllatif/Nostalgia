<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Réussi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <h2 class="mt-4 text-2xl font-bold text-gray-900">Paiement Réussi!</h2>
                <p class="mt-2 text-gray-600">Votre paiement a été traité avec succès.</p>
            </div>

            @if(isset($error))
                <div class="mt-8">
                    <div class="bg-red-50 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Erreur</h3>
                                <p class="mt-1 text-sm text-red-700">{{ $error }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-8">
                    <div class="bg-green-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-green-800">Télécharger votre ticket</h3>
                        <p class="mt-1 text-sm text-green-700">
                            Votre ticket de paiement est prêt. Vous pouvez le télécharger en cliquant sur le bouton ci-dessous.
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('payment.download-ticket', ['product' => $product->id]) }}"
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Télécharger le ticket
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-8 text-center">
                <a href="{{ route('catalogue') }}" class="text-blue-600 hover:text-blue-800">
                    Retourner au catalogue
                </a>
            </div>
        </div>
    </div>
</body>
</html>
