<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name }}'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Profile Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-12 shadow-md mb-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/4 flex justify-center mb-6 md:mb-0">
                    <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : Storage::url('anonymes_users/anonyme_user.jpg') }}"
                         alt="{{ $user->name }}"
                         class="w-44 h-44 object-cover rounded-full border-4 border-white shadow-lg transition-transform duration-300 hover:scale-105">
                </div>
                <div class="md:w-3/4 md:pl-8">
                    <h2 class="text-4xl font-bold mb-6 text-center md:text-left shadow-text">{{ $user->first_name }} {{ $user->name }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-3 flex items-center transition hover:-translate-y-1 hover:bg-opacity-15">
                            <i class="fas fa-briefcase w-6 text-center mr-3 text-xl"></i>
                            <span>{{ $user->work ?? 'No work information' }}</span>
                        </div>
                        <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-3 flex items-center transition hover:-translate-y-1 hover:bg-opacity-15">
                            <i class="fas fa-graduation-cap w-6 text-center mr-3 text-xl"></i>
                            <span>{{ $user->education ?? 'No education information' }}</span>
                        </div>
                        <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-3 flex items-center transition hover:-translate-y-1 hover:bg-opacity-15">
                            <i class="fas fa-calendar-alt w-6 text-center mr-3 text-xl"></i>
                            <span>Member since {{ $user->created_at->format('F Y') }}</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-3 flex items-center mt-4">
                        <i class="fas fa-user w-6 text-center mr-3 text-xl"></i>
                        <span>{{ $user->bio ?? 'No bio available' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-12">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Stats Card -->
            <div class="md:w-1/4">
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6 transition duration-300 hover:shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistics</h3>
                    <div class="flex justify-between items-center mb-3 pb-3 border-b border-gray-100">
                        <span class="font-medium text-gray-700">Articles</span>
                        <span class="bg-blue-600 text-white py-1 px-3 rounded-full text-sm font-medium">{{ $statistics['articles_count'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Active Products</span>
                        <span class="bg-blue-600 text-white py-1 px-3 rounded-full text-sm font-medium">{{ $statistics['products_count'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Content Card -->
            <div class="md:w-3/4">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden transition duration-300 hover:shadow-md">
                    <!-- Tab Header -->
                    <div class="flex justify-between items-center border-b border-gray-100 px-6 py-4">
                        <div class="flex space-x-4">
                            <button id="articles-tab"
                                    onclick="showContent('articles')"
                                    class="py-2 px-1 border-b-2 border-blue-600 font-medium text-blue-600 focus:outline-none">
                                Recent Articles
                            </button>
                            <button id="products-tab"
                                    onclick="showContent('products')"
                                    class="py-2 px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                Active Products
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('users.articles', $user->id) }}"
                               id="view-all-articles"
                               class="py-1.5 px-4 border border-blue-600 text-blue-600 rounded-lg text-sm hover:bg-blue-50 transition">
                                View All
                            </a>
                            <a href="{{ route('users.products', $user->id) }}"
                               id="view-all-products"
                               class="hidden py-1.5 px-4 border border-blue-600 text-blue-600 rounded-lg text-sm hover:bg-blue-50 transition">
                                View All
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Articles Content -->
                        <div id="articles-content" class="block">
                            @if($articles->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($articles as $article)
                                        <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md h-full flex flex-col">
                                            <img src="{{ $article->image_url }}"
                                                 class="h-48 w-full object-cover"
                                                 alt="{{ $article->title }}">
                                            <div class="p-5 flex flex-col flex-grow">
                                                <h4 class="text-lg font-semibold text-gray-800 mb-3">{{ $article->title }}</h4>
                                                <p class="text-gray-600 mb-4 flex-grow">{{ Str::limit($article->content, 100) }}</p>
                                                <a href="{{ route('Article.show', $article->id) }}"
                                                   class="bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                                    Read More
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <i class="fas fa-newspaper text-gray-300 text-5xl mb-4"></i>
                                    <p class="text-gray-500">No articles yet.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Products Content -->
                        <div id="products-content" class="hidden">
                            @if($products->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($products as $product)
                                        <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md h-full flex flex-col">
                                            <img src="{{ $product->images->first() ? Storage::url($product->images->first()->image_path) : 'https://via.placeholder.com/400x200' }}"
                                                 class="h-48 w-full object-cover"
                                                 alt="{{ $product->title }}">
                                            <div class="p-5 flex flex-col flex-grow">
                                                <h4 class="text-lg font-semibold text-gray-800 mb-3">{{ $product->title }}</h4>
                                                <p class="text-gray-600 mb-4 flex-grow">{{ Str::limit($product->description, 100) }}</p>
                                                <div class="flex justify-between items-center mb-4">
                                                    <span class="bg-gray-200 text-gray-800 py-1 px-3 rounded-full text-sm font-medium">{{ number_format($product->starting_price, 2) }}€</span>
                                                    <span class="text-sm text-gray-500">Ends: {{ \Carbon\Carbon::parse($product->auction_end_date)->format('d M, Y') }}</span>
                                                </div>
                                                <a href="{{ route('product.details', $product->id) }}"
                                                   class="bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <i class="fas fa-box text-gray-300 text-5xl mb-4"></i>
                                    <p class="text-gray-500">No active products yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showContent(contentType) {
            // Content elements
            const articlesContent = document.getElementById('articles-content');
            const productsContent = document.getElementById('products-content');

            // Tab elements
            const articlesTab = document.getElementById('articles-tab');
            const productsTab = document.getElementById('products-tab');

            // View all links
            const viewAllArticles = document.getElementById('view-all-articles');
            const viewAllProducts = document.getElementById('view-all-products');

            // Reset all styles
            articlesTab.classList.remove('border-blue-600', 'text-blue-600');
            articlesTab.classList.add('border-transparent', 'text-gray-500');
            productsTab.classList.remove('border-blue-600', 'text-blue-600');
            productsTab.classList.add('border-transparent', 'text-gray-500');

            articlesContent.classList.add('hidden');
            articlesContent.classList.remove('block');
            productsContent.classList.add('hidden');
            productsContent.classList.remove('block');

            viewAllArticles.classList.add('hidden');
            viewAllProducts.classList.add('hidden');

            // Apply active styles based on selected content
            if (contentType === 'articles') {
                articlesTab.classList.remove('border-transparent', 'text-gray-500');
                articlesTab.classList.add('border-blue-600', 'text-blue-600');
                articlesContent.classList.remove('hidden');
                articlesContent.classList.add('block');
                viewAllArticles.classList.remove('hidden');
            } else if (contentType === 'products') {
                productsTab.classList.remove('border-transparent', 'text-gray-500');
                productsTab.classList.add('border-blue-600', 'text-blue-600');
                productsContent.classList.remove('hidden');
                productsContent.classList.add('block');
                viewAllProducts.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
