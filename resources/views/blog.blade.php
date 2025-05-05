@extends('components.layout')

@section('title', "blog of articles")

@section('content')
     <!-- Hero Section -->
     <section class="bg-gradient-to-b from-gray-900 to-gray-800 py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl font-bold text-white mb-6">Explorez Notre Blog</h1>
                <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                    Plongez dans l'univers fascinant de l'art et du patrimoine culturel. Découvrez des histoires uniques, des analyses approfondies et des perspectives enrichissantes sur notre collection d'antiquités.
                </p>
                @if(auth()->check())
                <div class="flex justify-center space-x-4">
                    <button class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transform transition-all duration-200 hover:scale-105 shadow-lg" onclick="openNewArticleModal()">
                        <i class="fas fa-plus mr-2"></i>Créer un article
                    </button>
                    <a href="#articles" class="bg-white/10 backdrop-blur-sm text-white px-8 py-3 rounded-xl font-semibold hover:bg-white/20 transition-all duration-200">
                        <i class="fas fa-book-reader mr-2"></i>Parcourir les articles
                    </a>
                </div>
                @else
                <a href="#articles" class="bg-white text-gray-900 px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transform transition-all duration-200 hover:scale-105 shadow-lg inline-block">
                    <i class="fas fa-book-reader mr-2"></i>Découvrir nos articles
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Success Message Alert -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Succès!</strong>
            <span class="block sm:inline"> {{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Error Message Alert -->
    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Erreur!</strong>
            <span class="block sm:inline"> {{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Add Article Button Section - Only show if user is authenticated -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
        @if(Cookie::has('jwt_token') || request()->has('auth_user'))
        <div class="flex items-center space-x-4">
                <img src="{{ session('user_data.profile_image') ? Storage::url(session('user_data.profile_image')) : asset('storage/anonymes_users/anonyme_user.jpg') }}"
                     class="w-12 h-12 rounded-full object-cover border-4 border-gray-300 dark:border-gray-600 shadow-md"
                     alt="Profile">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ session('user_data.first_name') }} {{ session('user_data.name') }}</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300">Partagez votre expertise avec la communauté</p>
                </div>
            </div>
            <button onclick="displayForm()" type="button" class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-8 py-3 rounded-full hover:from-gray-700 hover:to-gray-800 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg flex items-center space-x-2 font-medium">
                <i class="fas fa-plus mr-2"></i>
                <span>Rédiger un article</span>
            </button>
        </div>
        @endif

    </div>

    <!-- Filters Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Articles</h2>
            </div>
            <form action="{{ route('blog.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Rechercher des articles..."
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-200 focus:border-gray-300">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div>
                    <select name="category" class="w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-200 focus:border-gray-300">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="sort" class="w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-200 focus:border-gray-300">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Plus récents</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Plus populaires</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-gray-900 text-white px-6 py-2 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2">
                        Appliquer les filtres
                    </button>
                </div>
            </form>
        </div>

        <!-- Articles Grid -->
        <div id="articles" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full">
                    <div class="relative h-56">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/placeholder.jpg') }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center mb-4">
                            <img src="/placeholder.svg"
                            alt="{{ $article->user->name }}"
                                     class="w-10 h-10 rounded-full border-2 border-white mr-3">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-gray-100"> {{ $article->user->first_name }} {{ $article->user->name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $article->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 line-clamp-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3 flex-grow">{{ Str::limit($article->content, 150) }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700 mt-auto">
                            <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                {{ $article->created_at->diffForHumans() }}
                            </div>
                            <a href="{{ route('blog.show', $article->id) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 font-medium hover:text-blue-700 dark:hover:text-blue-300 transition-colors duration-200">
                                Lire l'article
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900">Aucun article trouvé</h3>
                    <p class="text-gray-500">Essayez de modifier vos critères de recherche.</p>
                </div>
            @endforelse
        </div>

                <!-- Pagination -->
                <div class="mt-8 max-w-7xl mx-auto px-4 flex justify-center">
                    <div class="inline-flex space-x-2">
                        {{ $articles->links() }}
                    </div>
                </div>
    </div>

    <!-- New Article Modal -->
    <div id="newArticleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full relative max-h-[90vh] overflow-hidden">
                <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 px-6 py-4 sticky top-0 bg-white dark:bg-gray-800 z-10">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Créer un nouvel article</h3>
                    <button id="closeModalBtn" onclick="closeNewArticleModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="px-6 py-4 overflow-y-auto" style="max-height: calc(90vh - 120px);">
                    <form id="newArticleForm" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <!-- Always include the JWT token if it exists -->
                        @if(Cookie::has('jwt_token'))
                            <input type="hidden" name="jwt_token" value="{{ Cookie::get('jwt_token') }}">
                        @endif

                        <!-- Display validation errors -->
                        @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Erreur!</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Titre de l'article</label>
                                <input type="text" name="title" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm py-2 px-3
                                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                        dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('title') border-red-500 @enderror"
                                    placeholder="Entrez le titre de votre article"
                                    value="{{ old('title') }}">
                                @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contenu de l'article</label>
                                <textarea name="content" rows="5" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm py-2 px-3
                                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                        dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('content') border-red-500 @enderror"
                                    placeholder="Rédigez votre article ici...">{{ old('content') }}</textarea>
                                @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catégorie</label>
                                    <select name="category_id" required
                                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm py-2 px-3
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                            dark:bg-gray-700 dark:text-white @error('category_id') border-red-500 @enderror">
                                        <option value="">Sélectionner une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tags</label>
                                    <select name="tags[]" id="tags" multiple="multiple" class="select2 w-full @error('tags') border-red-500 @enderror">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image de couverture</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-blue-500 dark:hover:border-blue-400 transition-colors duration-200">
                                    <div class="space-y-2 text-center">
                                        <div class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500">
                                            <i class="fas fa-image text-4xl mb-2"></i>
                                        </div>
                                        <div class="flex flex-col items-center text-sm text-gray-600 dark:text-gray-400">
                                            <label for="article-image" class="relative cursor-pointer bg-white dark:bg-gray-700 px-4 py-2 rounded-lg font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 transition-colors duration-200">
                                                <span>Télécharger une image</span>
                                                <input id="article-image" name="image" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="mt-2">ou glisser-déposer</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF jusqu'à 10MB</p>
                                        <div id="image-preview" class="hidden mt-4 relative rounded-lg overflow-hidden">
                                            <img src="#" alt="Preview" class="w-full h-48 object-cover">
                                            <button type="button" onclick="removeImage()" class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 focus:outline-none">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Show user ID for debugging -->
                        <div class="mt-4">
                            <p class="text-xs text-gray-500">User ID: {{ session('user_data.id') ?? 'Non défini' }}</p>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <button type="button" onclick="closeNewArticleModal()"
                                class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600
                                    rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                                Annuler
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white border border-transparent rounded-lg hover:bg-blue-700
                                    transition-colors duration-200 flex items-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Publier l'article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tags').select2({
                placeholder: 'Sélectionnez des tags',
                allowClear: true,
                theme: 'classic',
                width: '100%',
                language: 'fr',
                closeOnSelect: false
            });

            // Add image preview functionality
            $('#article-image').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').removeClass('hidden');
                        $('#image-preview img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });

        function displayForm() {
            document.getElementById('newArticleModal').classList.remove('hidden');
            console.log('Modal opened');
        }

        function closeNewArticleModal() {
            const modal = document.getElementById('newArticleModal');
            modal.classList.add('hidden');
            document.getElementById('newArticleForm').reset();
            document.getElementById('image-preview').classList.add('hidden');
            document.querySelector('#image-preview img').src = '#';
            $('#tags').val(null).trigger('change');
        }

        function removeImage() {
            document.getElementById('article-image').value = '';
            document.getElementById('image-preview').classList.add('hidden');
        }
    </script>
    @endsection
