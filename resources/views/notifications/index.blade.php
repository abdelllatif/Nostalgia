<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Nostalgia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="https://img.icons8.com/ios-filled/50/000000/retro-tv.png" alt="Logo Nostalgia" class="w-8 h-8">
            <span class="text-xl font-bold text-gray-800">Nostalgia</span>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
            <li><a href="/" class="hover:text-blue-600">Accueil</a></li>
            <li><a href="/catalogue" class="hover:text-blue-600">Catalogue</a></li>
            <li><a href="/blog" class="hover:text-blue-600">Blog</a></li>
            <li><a href="/about" class="hover:text-blue-600">À propos</a></li>
            <li><a href="#" class="hover:text-blue-600">Contact</a></li>
        </ul>

        <!-- User Menu -->
        <div class="hidden md:flex space-x-4 items-center">
            <a href="{{ route('profile') }}" class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Mon Profil</a>
            <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Retour à l'accueil</a>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold mb-8">Notifications</h1>

            <div id="notifications-container">
                <div class="text-center py-4">
                    <p class="text-gray-500">Chargement des notifications...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function markAsRead(id) {
            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                const notification = document.querySelector(`[data-id="${id}"]`);
                if (notification) {
                    notification.classList.add('opacity-75');
                    notification.classList.remove('border-l-4', 'border-blue-500');
                    const button = notification.querySelector('button');
                    if (button) {
                        button.remove();
                    }
                }
                console.log('Notification marked as read:', id);
            })
            .catch(error => {
                console.error('Error marking notification as read:', error);
            });
        }

        function updateNotifications() {
            fetch('{{ route("notifications.recent") }}')
                .then(response => response.json())
                .then(data => {
                    console.log('Recent notifications:', data);
                    const container = document.getElementById('notifications-container');

                    if (data.notifications && data.notifications.length > 0) {
                        // Clear existing notifications
                        container.innerHTML = '';

                        // Add new notifications
                        const notificationsHtml = data.notifications.map(notification => `
                            <div class="notification-item bg-white rounded-lg shadow p-4 ${notification.read ? 'opacity-75' : 'border-l-4 border-blue-500'}"
                                 data-id="${notification.id}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="text-gray-800">${notification.message}</p>
                                        <p class="text-sm text-gray-500 mt-1">${notification.created_at.diffForHumans()}</p>
                                    </div>
                                    ${!notification.read ? `
                                        <button onclick="markAsRead(${notification.id})"
                                                class="text-sm text-blue-600 hover:text-blue-800">
                                            Marquer comme lu
                                        </button>
                                    ` : ''}
                                </div>
                            </div>
                        `).join('');

                        container.innerHTML = `
                            <div class="space-y-4">
                                ${notificationsHtml}
                            </div>
                        `;
                    } else {
                        container.innerHTML = '<p class="text-gray-500 text-center py-4">Aucune notification récente</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching notifications:', error);
                    const container = document.getElementById('notifications-container');
                    container.innerHTML = '<p class="text-red-500 text-center py-4">Erreur lors du chargement des notifications</p>';
                });
        }

        // Load recent notifications every 10 seconds
        setInterval(updateNotifications, 10000);

        // Initial load
        document.addEventListener('DOMContentLoaded', function() {
            updateNotifications();
        });
    </script>
</body>
</html>
