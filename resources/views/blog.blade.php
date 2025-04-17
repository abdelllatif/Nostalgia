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
                <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Article
                </button>
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
                                @empty($record->categorie)
                                <span class="text-gray-500">Aucune categoie</span>

                                @endempty
                                @if($article->categorie)
                                {{ $article->categorie->name }}
                                @endif
                            </span>
                            @foreach($article->tags as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                        <a href="{{ route('Article.show', ['id'=> $article->id]) }}" class="inline-flex items-center text-purple-600 hover:text-purple-700">
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
<div id="addArticleModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full relative max-h-[500px] overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-10">
            <h2 class="text-lg font-semibold text-gray-900">Créer un Nouvel Article</h2>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="px-4 py-4 overflow-y-auto" style="max-height: calc(500px - 120px);">
            <form id="articleForm" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Titre -->
                <div class="mb-3">
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                    <input type="text" name="title" id="title" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <!-- Contenu -->
                <div class="mb-3">
                    <label for="content" class="block text-sm font-medium text-gray-700">Contenu</label>
                    <textarea name="content" id="content" rows="3" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none"></textarea>
                </div>

                <!-- Catégorie -->
                <div class="mb-3">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <select name="category_id" id="category_id" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Tags</label>
                    <div class="flex flex-wrap gap-2 mb-2" id="selectedTags"></div>
                    <select id="tagSelect" onchange="addTag()"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Sélectionner un tag...</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <div class="mt-1 flex justify-center px-6 pt-3 pb-4 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-6 w-6 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m0-8z"></path>
                            </svg>
                            <div class="flex text-xs text-gray-600 justify-center">
                                <label for="image" class="cursor-pointer bg-white font-medium text-purple-600 hover:text-purple-500">
                                    <span>Télécharger</span>
                                    <input type="file" name="image" id="image" accept="image/*" class="sr-only">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="imagePreview" class="mt-2 flex flex-wrap gap-2"></div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="bg-gray-50 px-4 py-3 flex justify-end rounded-b-lg sticky bottom-0">
                <button type="button" onclick="closeModal()"
                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mr-2">
                    Annuler
                </button>
                <button type="submit"
                    class="bg-purple-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-700">
                    Publier
                </button>
            </form>
        </div>
    </div>
</div>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Succès!',
                        text: '{{ session("success") }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Erreur!',
                        text: '{{ session("error") }}',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        window.openModal = function() {
            const modal = document.getElementById('addArticleModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        window.closeModal = function() {
            const modal = document.getElementById('addArticleModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
                // Reset form
                document.getElementById('imagePreview').innerHTML = '';
                document.getElementById('selectedTags').innerHTML = '';
                document.getElementById('articleForm').reset();
                selectedTags.clear();
            }
        }

        // Initialize the modal button
        const addButton = document.querySelector('button[onclick="openModal()"]');
        if (addButton) {
            addButton.addEventListener('click', openModal);
        }
    });

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

    <!-- Add SweetAlert2 for better notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
