<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Nostalgia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Header Section -->
    <section class="relative bg-gradient-to-r from-purple-900 via-purple-800 to-indigo-900 py-16">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl md:text-6xl mb-4">
                Explorez Notre Blog
            </h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto mb-8">
                Découvrez des histoires fascinantes et des perspectives uniques
            </p>
            @auth
                <button onclick="openModal()" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-purple-600 hover:bg-purple-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Créer un Article
                </button>
            @endauth
        </div>
    </section>

    <!-- Filters Section -->
    <section class="bg-white shadow-md py-6 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <form id="filterForm" action="{{ route('blog.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="relative flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/user.jpg') }}" alt="User" class="w-10 h-10 rounded-xl">
                    </div>
                    <div class="flex-grow relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Rechercher des articles..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            onkeyup="if(event.key === 'Enter') document.getElementById('filterForm').submit();">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <select name="category" onchange="document.getElementById('filterForm').submit()" class="w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Toutes les Catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="paginate" onchange="document.getElementById('filterForm').submit()" class="w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="10" {{ request('paginate') == '10' || !request('paginate') ? 'selected' : '' }}>10 articles par page</option>
                        <option value="20" {{ request('paginate') == '20' ? 'selected' : '' }}>20 articles par page</option>
                        <option value="50" {{ request('paginate') == '50' ? 'selected' : '' }}>50 articles par page</option>
                    </select>
                </div>
            </form>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Blog</h1>
            @auth
                <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Article
                </button>
            @endauth
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    @if($article->image)
                        <div class="relative h-48">
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-24"></div>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <img src="{{ $article->user->avatar_url }}" alt="{{ $article->user->name }}" class="w-10 h-10 rounded-full object-cover">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">{{ $article->user->name }}</h3>
                                <p class="text-xs text-gray-500">{{ $article->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($article->content, 150) }}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                {{ $article->category->name }}
                            </span>
                            @foreach($article->tags as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                        <a href="{{ route('blog.show', $article) }}" class="inline-flex items-center text-purple-600 hover:text-purple-700">
                            Lire la suite
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun article</h3>
                    <p class="mt-1 text-sm text-gray-500">Commencez par créer votre premier article.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->appends(request()->except('page'))->links() }}
        </div>

        <!-- Add Article Modal -->
        @auth
        <div id="addArticleModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full mx-4 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-900">Créer un Nouvel Article</h2>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="px-6 py-4 max-h-[calc(100vh-200px)] overflow-y-auto">
                    <div class="w-screen h-screen bg-gray-100 flex items-center justify-center p-4 overflow-hidden">
                        <div class="w-full max-w-4xl h-full bg-white rounded-lg shadow-lg overflow-y-auto p-6">
                            <form id="articleForm" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf

                                <h2 class="text-2xl font-bold text-gray-800">Créer un nouvel article</h2>

                                <!-- Titre -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                                    <input type="text" name="title" id="title" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                </div>

                                <!-- Contenu -->
                                <div>
                                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                                    <textarea name="content" id="content" rows="6" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none"></textarea>
                                </div>

                                <!-- Catégorie -->
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                                    <select name="category_id" id="category_id" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tags -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                                    <div class="flex flex-wrap gap-2 mb-2" id="selectedTags"></div>
                                    <select id="tagSelect" onchange="addTag()"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        <option value="">Sélectionner un tag...</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Image -->
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                    <input type="file" name="image" id="image" accept="image/*"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md">
                                    <div id="imagePreview" class="mt-2 flex flex-wrap gap-2"></div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                                    <button type="button" onclick="closeModal()"
                                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                                        Annuler
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                        Publier
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endauth
    </div>

    <script>
    function openModal() {
        document.getElementById('addArticleModal').classList.remove('hidden');
        document.getElementById('addArticleModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('addArticleModal').classList.add('hidden');
        document.getElementById('addArticleModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
        // Reset form
        document.getElementById('imagePreview').innerHTML = '';
        document.getElementById('selectedTags').innerHTML = '';
        document.getElementById('articleForm').reset();
    }

    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = `
                    <div class="relative inline-block m-2">
                        <img src="${e.target.result}" alt="Preview" class="w-24 h-24 object-cover rounded-lg">
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer" onclick="removeImage()">&times;</span>
                    </div>
                `;
            }
            reader.readAsDataURL(file);
        }
    });

    function removeImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').innerHTML = '';
    }

    // Tags functionality
    let selectedTags = new Set();

    function addTag() {
        const select = document.getElementById('tagSelect');
        const tagId = select.value;
        const tagText = select.options[select.selectedIndex].text;

        if (tagId && !selectedTags.has(tagId)) {
            selectedTags.add(tagId);
            const tagElement = document.createElement('div');
            tagElement.className = 'inline-flex items-center bg-gray-100 px-3 py-1 rounded-full text-sm font-medium text-gray-800 m-1';
            tagElement.innerHTML = `
                ${tagText}
                <input type="hidden" name="tags[]" value="${tagId}">
                <span class="ml-2 cursor-pointer text-red-500" onclick="removeTag('${tagId}', this)">&times;</span>
            `;
            document.getElementById('selectedTags').appendChild(tagElement);
        }
        select.value = '';
    }

    function removeTag(tagId, button) {
        selectedTags.delete(tagId);
        button.parentElement.remove();
    }

    // Close modal when clicking outside
    document.getElementById('addArticleModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    </script>
</body>
</html>
