<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Enchères de Patrimoine Culturel')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <img src="https://img.icons8.com/ios-filled/50/000000/retro-tv.png" alt="Logo Nostalgia" class="w-8 h-8">
          <span class="text-xl font-bold text-gray-800">Nostalgia</span>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
          <li><a href="\" class="hover:text-blue-600">Accueil</a></li>
          <li><a href="catalogue" class="hover:text-blue-600">catalogue</a></li>
          <li><a href="blog" class="hover:text-blue-600">blog</a></li>
          <li><a href="about" class="hover:text-blue-600">about</a></li>
          <li><a href="#" class="hover:text-blue-600">Contact</a></li>
        </ul>

        <!-- Boutons Connexion / Inscription -->
        <div class="hidden md:flex space-x-4 items-center">
          @if(auth()->check() || request()->has('auth_user') || isset($_COOKIE['jwt_token']))
            <div class="relative">
                <a href="{{ route('notifications') }}" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span id="notification-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center" style="display: none;">0</span>
                </a>
            </div>
            <a href="{{ route('profile') }}" class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Mon Profil</a>
            <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Retour à l'accueil</a>
          @else
            <a href="{{ route('login') }}" class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Connexion</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Inscription</a>
          @endif
        </div>

        <!-- Menu burger mobile -->
        <div class="md:hidden">
          <button>
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 mt-auto">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; 2025 Nostalogia. Tous droits réservés.</p>
        </div>
    </footer>

    @stack('scripts')
    <script>
        function updateNotificationCount() {
            fetch('{{ route("notifications.unread-count") }}')
                .then(response => response.json())
                .then(data => {
                    const countElement = document.getElementById('notification-count');
                    if (data.count > 0) {
                        countElement.textContent = data.count;
                        countElement.style.display = 'flex';
                    } else {
                        countElement.style.display = 'none';
                    }
                    console.log('Notification count updated:', data.count);
                })
                .catch(error => {
                    console.error('Error fetching notification count:', error);
                });
        }

        // Update count every 10 seconds
        setInterval(updateNotificationCount, 10000);

        // Initial count update
        document.addEventListener('DOMContentLoaded', function() {
            updateNotificationCount();
        });
    </script>
</body>
</html>
