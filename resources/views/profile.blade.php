<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name }}'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-purple-600">Nostalgia</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Home
                        </a>
                        <a href="{{ route('blog.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Blog
                        </a>
                        <a href="{{ route('products.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Catalogue
                        </a>
                        <a href="/about" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            About
                        </a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="ml-3 relative">
                        <div class="flex items-center">
                            <a href="{{ route('profile', auth()->id()) }}" class="flex items-center">
                                <img src="{{ auth()->user()->profile_image ? Storage::url(auth()->user()->profile_image) : Storage::url('anonymes_users/anonyme_user.jpg') }}"
                                     alt="{{ auth()->user()->first_name }}"
                                     class="h-8 w-8 rounded-full object-cover">
                                <span class="ml-2 text-sm font-medium text-gray-700">{{ auth()->user()->first_name }}</span>
                            </a>
                            <form method="POST" action="" class="ml-4">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="sm:hidden mobile-menu hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="bg-purple-50 border-purple-500 text-purple-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Home
                </a>
                <a href="{{ route('blog.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Blog
                </a>
                <a href="" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Catalogue
                </a>
                <a href="/about" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    About
                </a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img src="{{ auth()->user()->profile_image ? Storage::url(auth()->user()->profile_image) : Storage::url('anonymes_users/anonyme_user.jpg') }}"
                             alt="{{ auth()->user()->first_name }}"
                             class="h-10 w-10 rounded-full object-cover">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->first_name }} {{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile', auth()->id()) }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Your Profile
                    </a>
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Profile Header -->
    <section class="relative bg-gradient-to-r from-purple-900 via-purple-800 to-indigo-900 py-16">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/3 text-center md:text-left mb-8 md:mb-0">
                    <div class="relative inline-block">
                        <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : Storage::url('anonymes_users/anonyme_user.jpg') }}"
                             alt="Profile"
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg"
                             id="profileImage">
                        <label for="profileImageInput" class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-lg cursor-pointer">
                            <i class="fas fa-camera text-purple-600"></i>
                        </label>
                        <input type="file" id="profileImageInput" class="hidden" accept="image/*">
                    </div>
                </div>
                <div class="md:w-2/3 text-white">
                    <h1 class="text-4xl font-bold mb-4">{{ $user->first_name }} {{ $user->name }}</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-briefcase"></i>
                            <span>{{ $user->work ?? 'No work information' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-graduation-cap"></i>
                            <span>{{ $user->education ?? 'No education information' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Member since {{ $user->created_at->format('F Y') }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-200">{{ $user->bio ?? 'No bio available' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-300 hover:-translate-y-1">
                <div class="text-center">
                    <i class="fas fa-newspaper text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $statistics['articles_count'] ?? 0 }}</h3>
                    <p class="text-gray-600">Articles</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-300 hover:-translate-y-1">
                <div class="text-center">
                    <i class="fas fa-box text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $statistics['products_count'] ?? 0 }}</h3>
                    <p class="text-gray-600">Products</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-300 hover:-translate-y-1">
                <div class="text-center">
                    <i class="fas fa-gavel text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $statistics['bids_count'] ?? 0 }}</h3>
                    <p class="text-gray-600">Bids</p>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="mt-8">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button class="border-purple-500 text-purple-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm active" data-section="about">
                        About
                    </button>
                    <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-section="articles">
                        Articles
                    </button>
                    <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-section="products">
                        Products
                    </button>
                    <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-section="reactions">
                        My Reactions
                    </button>
                    <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-section="activity">
                        Recent Activity
                    </button>
                </nav>
            </div>

            <!-- Content Sections -->
            <div class="mt-8">
                <!-- About Section -->
                <div class="section-content active" id="about">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">About Me</h2>
                        <form id="profileForm" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" name="first_name" value="{{ $user->first_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" value="{{ $user->email }}" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm">
                                <p class="mt-1 text-sm text-gray-500">Email cannot be changed</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Work</label>
                                <input type="text" name="work" value="{{ $user->work }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Education</label>
                                <input type="text" name="education" value="{{ $user->education }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bio</label>
                                <textarea name="bio" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ $user->bio }}</textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Articles Section -->
                <div class="section-content hidden" id="articles">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($articles as $article)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1">
                                <div class="relative h-48">
                                    <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/placeholder.jpg') }}"
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover">
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-24"></div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($article->content, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">{{ $article->created_at->format('M d, Y') }}</span>
                                        <a href="{{ route('Article.show', $article->id) }}" class="text-purple-600 hover:text-purple-700 font-medium">
                                            Read More
                                            <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900">No Articles Yet</h3>
                                <p class="text-gray-500">Start writing your first article!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Products Section -->
                <div class="section-content hidden" id="products">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1">
                                <div class="relative h-48">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                                         alt="{{ $product->title }}"
                                         class="w-full h-full object-cover">
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-24"></div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $product->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-purple-600">€{{ number_format($product->starting_price, 2) }}</span>
                                        <a href="{{ route('catalogue.show', $product->id) }}" class="text-purple-600 hover:text-purple-700 font-medium">
                                            View Details
                                            <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <i class="fas fa-box text-4xl text-gray-400 mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900">No Products Yet</h3>
                                <p class="text-gray-500">Start adding your first product!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.querySelectorAll('[data-section]').forEach(button => {
            button.addEventListener('click', () => {
                // Update active tab
                document.querySelectorAll('[data-section]').forEach(btn => {
                    btn.classList.remove('border-purple-500', 'text-purple-600');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });
                button.classList.remove('border-transparent', 'text-gray-500');
                button.classList.add('border-purple-500', 'text-purple-600');

                // Show active content
                const sectionId = button.getAttribute('data-section');
                document.querySelectorAll('.section-content').forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(sectionId).classList.remove('hidden');
            });
        });

        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
