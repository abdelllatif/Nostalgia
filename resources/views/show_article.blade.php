<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <img src="https://img.icons8.com/ios-filled/50/000000/retro-tv.png" alt="Logo Nostalgia" class="w-8 h-8">
            <span class="text-xl font-bold text-gray-800">Nostalgia</span>
        </div>
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
            <li><a href="/" class="hover:text-blue-600">Accueil</a></li>
            <li><a href="/catalogue" class="hover:text-blue-600">Catalogue</a></li>
            <li><a href="/blog" class="hover:text-blue-600">Blog</a></li>
            <li><a href="/about" class="hover:text-blue-600">About</a></li>
            <li><a href="#" class="hover:text-blue-600">Contact</a></li>
        </ul>
        <div class="hidden md:flex space-x-4">
            <a href="/login" class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Connexion</a>
            <a href="/register" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Inscription</a>
        </div>
        <div class="md:hidden">
            <button>
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </nav>
    <!-- End Navbar -->

    <main class="flex-1 w-full bg-gradient-to-br from-gray-50 to-white pt-8 pb-16">
        <div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row gap-10">
            <!-- Main Article Content -->
            <section class="flex-1 min-w-0">
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-10">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
                        <div class="flex items-center gap-4">
                            <img src="{{ $article->user->avatar_url }}" alt="{{ $article->user->name }}" class="w-14 h-14 rounded-full border-2 border-blue-200 shadow">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900">{{ $article->user->name }}</h3>
                                <p class="text-xs text-gray-400">{{ $article->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex flex-wrap gap-2">
                                @if(!empty($article->categorie) && !empty($article->category_id))
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">{{ $article->categorie->name }}</span>
                                @endif
                                @foreach($article->tags as $tag)
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">{{ $tag->name }}</span>
                                @endforeach
                            </div>

                            <!-- Three-dot menu -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100 focus:outline-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                    <div class="py-1">
                                        <button id="editArticleBtn" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button id="deleteArticleBtn" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6">{{ $article->title }}</h1>
                    @if($article->image)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-80 object-cover rounded-xl mb-8 border">
                    @endif
                    <div class="prose max-w-none text-gray-800 mb-10">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                    <!-- Similar Articles -->
                    <h2 class="text-2xl font-bold mb-4 text-gray-900">Articles Similaires</h2>
                    <div class="overflow-x-auto flex gap-6 pb-2 mb-8">
                        @foreach ($similarArticles as $article)
                            <a href="{{ $article['link'] }}" class="min-w-[260px] max-w-xs bg-white rounded-xl shadow-md hover:shadow-lg transition flex-shrink-0 border border-gray-100">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-36 object-cover rounded-t-xl">
                                <div class="p-4">
                                    <h3 class="font-semibold mb-1 text-gray-900">{{ $article['title'] }}</h3>
                                    <p class="text-xs text-gray-600 mb-2">{{ $article['description'] }}</p>
                                    <span class="text-blue-600 text-xs font-medium">Lire l'article</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Comments Sidebar -->
            <aside class="w-full lg:w-[370px] flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-lg p-7 mb-6">
                    <h2 class="text-xl font-bold mb-5 flex items-center gap-2 text-blue-700">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2h2m10-4h-4m0 0V4m0 0L8 8m8-4l-4 4"></path></svg>
                        Comments
                    </h2>
                    <div class="space-y-6 max-h-[430px] overflow-y-auto pr-2" id="commentsContainer">
                        @if($article->comments->count() > 0)
                            @foreach($article->comments as $comment)
                                <div class="rounded-xl bg-gray-50 border border-gray-200 p-4 shadow-sm">
                                    <div class="flex items-center mb-2">
                                        <img src="{{ $comment->user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name) }}"
                                            alt="{{ $comment->user->name }}"
                                            class="w-9 h-9 rounded-full mr-3 border">
                                        <div class="flex-1">
                                            <span class="font-semibold text-sm text-gray-900">{{ $comment->user->name }}</span>
                                            <span class="block text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="text-gray-800 text-sm mb-1">{{ $comment->content }}</div>

                                    @php
                                        $rating = $article->ratings->where('user_id', $comment->user_id)->first();
                                    @endphp

                                    @if($rating)
                                        <div class="flex items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating->rating)
                                                    <svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24">
                                                        <polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="#fbbf24" viewBox="0 0 24 24">
                                                        <polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="rounded-xl bg-gray-50 border border-gray-200 p-4 shadow-sm">
                                <p class="text-gray-500 text-center">No comments yet. Be the first to comment!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Comment Form -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-blue-100">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900">Leave a Comment</h3>
                    <form id="commentForm" class="space-y-4" autocomplete="off">
                        @csrf
                        <div class="flex items-center gap-2 mb-2">
                            <span class="mr-2 font-medium text-gray-700">Your Rating:</span>
                            <div id="starRating" class="flex gap-1">
                                <svg data-value="1" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                <svg data-value="2" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                <svg data-value="3" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                <svg data-value="4" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                <svg data-value="5" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                            </div>
                            <input type="hidden" name="rating" id="ratingInput" value="0">
                            <input type="hidden" name="article_id" id="article_id" value="{{$article->id}}">
                        </div>
                        <textarea id="content" name="content" required rows="3" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-200" placeholder="Write your comment..."></textarea>
                        <div class="flex justify-end">
                            <button id="buttonContent" type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-colors">Submit</button>
                        </div>
                    </form>
                </div>
            </aside>
        </div>
    </main>

    <!-- Edit Article Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full relative max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b sticky top-0 bg-white z-10">
                <h2 class="text-xl font-semibold text-gray-900">Modifier l'Article</h2>
                <button id="cancelEdit" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5 overflow-y-auto" style="max-height: calc(90vh - 120px);">
                <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-5">
                        <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                        <input type="text" id="edit_title" name="title" value="{{ $article->title }}" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Content -->
                    <div class="mb-5">
                        <label for="edit_content" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                        <textarea id="edit_content" name="content" rows="6" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">{{ $article->content }}</textarea>
                    </div>

                    <!-- Category -->
                    <div class="mb-5">
                        <label for="edit_category_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select id="edit_category_id" name="category_id" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tags -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <div class="flex flex-wrap gap-2 mb-2" id="selectedTags">
                            @foreach($article->tags as $tag)
                                <div class="inline-flex items-center bg-purple-100 px-3 py-1 rounded-full text-sm font-medium text-purple-800 m-1">
                                    {{ $tag->name }}
                                    <input type="hidden" name="tags[]" value="{{ $tag->id }}">
                                    <span class="ml-2 cursor-pointer text-purple-600 hover:text-purple-800" onclick="removeTag('{{ $tag->id }}', this)">&times;</span>
                                </div>
                            @endforeach
                        </div>
                        <select id="tagSelect" onchange="addTag()"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Sélectionner un tag...</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ $article->tags->contains($tag->id) ? 'disabled' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="mb-5">
                        <label for="edit_image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <div class="mt-3 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-purple-500 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m0-8z"></path>
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="edit_image" class="cursor-pointer bg-white font-medium text-purple-600 hover:text-purple-500">
                                        <span>Télécharger une image</span>
                                        <input type="file" name="image" id="edit_image" accept="image/*" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 10MB</p>
                            </div>
                        </div>

                        <!-- Current Image Display -->
                        <div id="currentImageContainer" class="mt-4">
                            @if($article->image)
                                <div class="relative inline-block">
                                    <img src="{{ $article->image_url }}" alt="Current image" id="currentArticleImage" class="h-32 w-32 object-cover rounded">
                                    <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer" onclick="removeEditImage()">&times;</span>
                                </div>
                            @endif
                        </div>

                        <!-- Image Preview -->
                        <div id="editImagePreview" class="mt-3 flex flex-wrap gap-2"></div>
                    </div>
                </form>
            </div>

            <!-- Buttons -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end rounded-b-lg sticky bottom-0">
                <button type="button" id="cancelEditBtn"
                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mr-2">
                    Annuler
                </button>
                <button type="submit" form="editForm"
                    class="bg-purple-600 py-2 px-5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-700 transition-colors">
                    Mettre à jour
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Delete Article</h3>
            <p class="text-gray-700 mb-6">Are you sure you want to delete this article? This action cannot be undone.</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDelete" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100">Cancel</button>
                <form id="deleteForm" action="" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initStarRating();
            initModals();
            initCommentForm();
            initImagePreview();
        });

        // Star rating functionality
        function initStarRating() {
            const stars = document.querySelectorAll('#starRating svg');
            let selectedRating = 0;

            stars.forEach(star => {
                star.addEventListener('mouseenter', function() {
                    const val = parseInt(this.getAttribute('data-value'));
                    updateStarsDisplay(val);
                });

                star.addEventListener('mouseleave', function() {
                    updateStarsDisplay(selectedRating);
                });

                star.addEventListener('click', function() {
                    selectedRating = parseInt(this.getAttribute('data-value'));
                    document.getElementById('ratingInput').value = selectedRating;
                    updateStarsDisplay(selectedRating);
                });
            });

            function updateStarsDisplay(rating) {
                stars.forEach((s, idx) => {
                    if (idx < rating) {
                        s.classList.add('text-yellow-400');
                        s.classList.remove('text-gray-300');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            }
        }

        // Modal functionality
        function initModals() {
            // Edit modal
            const editModal = document.getElementById('editModal');
            const editBtn = document.getElementById('editArticleBtn');
            const cancelEditBtn = document.getElementById('cancelEdit');
            const cancelEditBtn2 = document.getElementById('cancelEditBtn');

            editBtn.addEventListener('click', () => {
                editModal.classList.remove('hidden');
                editModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            });

            cancelEditBtn.addEventListener('click', () => {
                editModal.classList.add('hidden');
                editModal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            });

            cancelEditBtn2.addEventListener('click', () => {
                editModal.classList.add('hidden');
                editModal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            });

            // Close edit modal when clicking outside
            editModal.addEventListener('click', (e) => {
                if (e.target === editModal) {
                    editModal.classList.add('hidden');
                    editModal.classList.remove('flex');
                    document.body.style.overflow = 'auto';
                }
            });

            // Delete modal
            const deleteModal = document.getElementById('deleteModal');
            const deleteBtn = document.getElementById('deleteArticleBtn');
            const cancelBtn = document.getElementById('cancelDelete');

            deleteBtn.addEventListener('click', () => {
                deleteModal.classList.remove('hidden');
            });

            cancelBtn.addEventListener('click', () => {
                deleteModal.classList.add('hidden');
            });

            // Close delete modal when clicking outside
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                }
            });
        }

        // Comment form submission
        function initCommentForm() {
            document.getElementById('commentForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form values
                const articleId = document.getElementById('article_id').value;
                const rating = document.getElementById('ratingInput').value;
                const content = document.getElementById('content').value;

                // Validate input
                if (!rating || rating === '0') {
                    alert('Please select a rating');
                    return;
                }

                if (!content.trim()) {
                    alert('Please enter a comment');
                    return;
                }

                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Show loading state
                const submitButton = document.getElementById('buttonContent');
                const originalButtonText = submitButton.innerText;
                submitButton.innerText = 'Submitting...';
                submitButton.disabled = true;

                // Create form data
                const formData = new FormData();
                formData.append('article_id', articleId);
                formData.append('rating', rating);
                formData.append('content', content);
                formData.append('_token', csrfToken);

                // Send AJAX request
                fetch('{{ route("reaction.add") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Server error: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Clear form
                        document.getElementById('content').value = '';

                        // Reset stars
                        const stars = document.querySelectorAll('#starRating svg');
                        stars.forEach(star => {
                            star.classList.remove('text-yellow-400');
                            star.classList.add('text-gray-300');
                        });
                        document.getElementById('ratingInput').value = 0;

                        // Create stars HTML
                        let starsHtml = '';
                        for (let i = 1; i <= 5; i++) {
                            if (i <= data.rating) {
                                starsHtml += `<svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24">
                                    <polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon>
                                </svg>`;
                            } else {
                                starsHtml += `<svg class="w-4 h-4 text-gray-300" fill="none" stroke="#fbbf24" viewBox="0 0 24 24">
                                    <polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon>
                                </svg>`;
                            }
                        }

                        // Create new comment element
                        const commentSection = document.getElementById('commentsContainer');
                        const newComment = document.createElement('div');
                        newComment.classList.add('rounded-xl', 'bg-gray-50', 'border', 'border-gray-200', 'p-4', 'shadow-sm');

                        // Add user info, comment, and rating
                        newComment.innerHTML = `
                            <div class="flex items-center mb-2">
                                <img src="${data.user.avatar_url}"
                                    alt="${data.user.name}" class="w-9 h-9 rounded-full mr-3 border">
                                <div class="flex-1">
                                    <span class="font-semibold text-sm text-gray-900">${data.user.name}</span>
                                    <span class="block text-xs text-gray-400">${data.comment_time}</span>
                                </div>
                            </div>
                            <div class="text-gray-800 text-sm mb-1">${data.comment}</div>
                            <div class="flex items-center gap-1">
                                ${starsHtml}
                            </div>
                        `;

                        // Remove "No comments" message if it exists
                        const noCommentsMsg = commentSection.querySelector('p.text-gray-500.text-center');
                        if (noCommentsMsg && noCommentsMsg.textContent.includes('No comments yet')) {
                            noCommentsMsg.parentElement.remove();
                        }

                        // Add new comment at the top
                        commentSection.prepend(newComment);

                        // Show success message
                        alert('Comment and rating added successfully!');
                    } else {
                        alert('Error: ' + (data.message || 'Unknown error occurred'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error submitting comment: ' + error.message);
                })
                .finally(() => {
                    // Reset button state
                    submitButton.innerText = originalButtonText;
                    submitButton.disabled = false;
                });
            });
        }

        // Image preview functionality
        function initImagePreview() {
            document.getElementById('edit_image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Update the current image
                        const currentImage = document.getElementById('currentArticleImage');
                        if (currentImage) {
                            currentImage.src = e.target.result;
                        } else {
                            // If no current image exists, create one
                            const currentImageContainer = document.getElementById('currentImageContainer');
                            currentImageContainer.innerHTML = `
                                <div class="relative inline-block">
                                    <img src="${e.target.result}" alt="Current image" id="currentArticleImage" class="h-32 w-32 object-cover rounded">
                                    <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer" onclick="removeEditImage()">&times;</span>
                                </div>
                            `;
                        }

                        // Clear the preview area
                        document.getElementById('editImagePreview').innerHTML = '';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // Function to remove the current image in edit form
        function removeEditImage() {
            document.getElementById('edit_image').value = '';
            document.getElementById('editImagePreview').innerHTML = '';

            // Hide the current image
            const currentImageContainer = document.getElementById('currentImageContainer');
            currentImageContainer.innerHTML = '';

            // Add a hidden input to indicate image should be removed
            const form = document.getElementById('editForm');
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'remove_image';
            hiddenInput.value = '1';
            form.appendChild(hiddenInput);
        }

        // Tags functionality
        let selectedTags = new Set(@json($article->tags->pluck('id')));

        function addTag() {
            const select = document.getElementById('tagSelect');
            const tagId = select.value;
            const tagText = select.options[select.selectedIndex].text;

            if (tagId && !selectedTags.has(tagId)) {
                selectedTags.add(tagId);
                const tagElement = document.createElement('div');
                tagElement.className = 'inline-flex items-center bg-purple-100 px-3 py-1 rounded-full text-sm font-medium text-purple-800 m-1';
                tagElement.innerHTML = `
                    ${tagText}
                    <input type="hidden" name="tags[]" value="${tagId}">
                    <span class="ml-2 cursor-pointer text-purple-600 hover:text-purple-800" onclick="removeTag('${tagId}', this)">&times;</span>
                `;
                document.getElementById('selectedTags').appendChild(tagElement);

                // Disable the selected option
                select.options[select.selectedIndex].disabled = true;
            }
            select.value = '';
        }

        function removeTag(tagId, button) {
            selectedTags.delete(tagId);
            button.parentElement.remove();

            // Re-enable the option in the dropdown
            const select = document.getElementById('tagSelect');
            for (let option of select.options) {
                if (option.value === tagId) {
                    option.disabled = false;
                    break;
                }
            }
        }
    </script>
</body>
</html>
