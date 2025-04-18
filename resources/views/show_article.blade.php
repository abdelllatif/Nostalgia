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
                                <div x-show="open"
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                    <div class="py-1">
                                        <!-- Edit button that opens a popup instead of linking directly -->
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
                    <!-- Similar Articles (Static, horizontal scroll) -->
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
                    <div class="space-y-6 max-h-[430px] overflow-y-auto pr-2">
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
                                        // Find the matching rating by the same user for this article
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
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Edit Article</h3>
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <!-- Title field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title" value="{{ $article->title }}" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-200">
                    </div>

                    <!-- Category field -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select id="category_id" name="category_id" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-200">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Content field -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea id="content" name="content" rows="6" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-200">{{ $article->content }}</textarea>
                    </div>

                    <!-- Image field -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" id="image" name="image" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-200">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep the current image</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <button type="button" id="cancelEdit" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save Changes</button>
                </div>
            </form>
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

    <script>
        // Star rating functionality
        // This code handles the interactive star rating system
        // It allows users to hover over stars to preview ratings
        // and click to select a rating value
        const stars = document.querySelectorAll('#starRating svg');
        let selectedRating = 0;
        stars.forEach(star => {
            star.addEventListener('mouseenter', function() {
                const val = parseInt(this.getAttribute('data-value'));
                stars.forEach((s, idx) => {
                    if (idx < val) s.classList.add('text-yellow-400'); else s.classList.remove('text-yellow-400');
                });
            });
            star.addEventListener('mouseleave', function() {
                stars.forEach((s, idx) => {
                    if (idx < selectedRating) s.classList.add('text-yellow-400'); else s.classList.remove('text-yellow-400');
                });
            });
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.getAttribute('data-value'));
                document.getElementById('ratingInput').value = selectedRating;
                stars.forEach((s, idx) => {
                    if (idx < selectedRating) s.classList.add('text-yellow-400'); else s.classList.remove('text-yellow-400');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            // Edit modal functionality
            // This code handles showing and hiding the edit article modal
            // It also manages the form submission process
            const editModal = document.getElementById('editModal');
            const editBtn = document.getElementById('editArticleBtn');
            const cancelEditBtn = document.getElementById('cancelEdit');

            editBtn.addEventListener('click', () => {
                editModal.classList.remove('hidden');
            });

            cancelEditBtn.addEventListener('click', () => {
                editModal.classList.add('hidden');
            });

            // Close edit modal when clicking outside
            editModal.addEventListener('click', (e) => {
                if (e.target === editModal) {
                    editModal.classList.add('hidden');
                }
            });

            // Delete modal functionality
            // This code handles showing and hiding the delete confirmation modal
            // It provides a safety check before permanently deleting an article
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

            // Comment form submission
            // This code handles the submission of new comments
            // It includes validation, AJAX submission, and UI updates
            document.getElementById('commentForm').addEventListener('submit', (e) => {
                e.preventDefault();

                // Get form values
                const articleId = document.getElementById('article_id').value;
                const rating = document.getElementById('ratingInput').value;
                const content = document.getElementById('content').value;

                // Validate input before sending
                if (!rating || rating === '0') {
                    alert('Please select a rating');
                    return;
                }

                if (!content.trim()) {
                    alert('Please enter a comment');
                    return;
                }

                // Get the CSRF token from the meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Create form data
                const formData = new FormData();
                formData.append('article_id', articleId);
                formData.append('rating', rating);
                formData.append('content', content);
                formData.append('_token', csrfToken);

                // Show loading state
                const submitButton = document.getElementById('buttonContent');
                const originalButtonText = submitButton.innerText;
                submitButton.innerText = 'Submitting...';
                submitButton.disabled = true;

                fetch('{{ route("reaction.add") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Clear the input fields
                        document.getElementById('content').value = '';

                        // Reset stars display
                        selectedRating = 0;
                        document.getElementById('ratingInput').value = 0;
                        stars.forEach(star => {
                            star.classList.remove('text-yellow-400');
                            star.classList.add('text-gray-300');
                        });

                        // Create HTML for rating stars
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

                        // Create the new comment element
                        const commentSection = document.querySelector('.space-y-6');
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

                        // If "No comments yet" message exists, remove it
                        const noCommentsMsg = commentSection.querySelector('p.text-gray-500.text-center');
                        if (noCommentsMsg && noCommentsMsg.textContent.includes('No comments yet')) {
                            noCommentsMsg.parentElement.remove();
                        }

                        // Add the new comment at the top of the comments section
                        commentSection.prepend(newComment);

                        // Notify user of success
                        alert('Comment and rating added successfully!');
                    } else {
                        alert('There was an error while submitting the comment.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error while submitting the comment.');
                })
                .finally(() => {
                    // Reset button state
                    submitButton.innerText = originalButtonText;
                    submitButton.disabled = false;
                });
            });
        });
    </script>
</body>
</html>
