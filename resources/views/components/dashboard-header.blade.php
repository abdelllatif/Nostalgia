<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $title }}</h1>
        <div class="flex items-center">
            <div class="mr-4 text-right">
                <p class="text-sm font-medium text-gray-900 dark:text-white">Admin: {{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Administrateur</p>
            </div>
            <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->user_image ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}" alt="Profile picture">
        </div>
    </div>
</header>
