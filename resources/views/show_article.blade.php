<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
      /* Custom scrollbar for professional polish */
      ::-webkit-scrollbar { width: 8px; background: #f1f1f1; }
      ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }
      ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white/90 dark:bg-gray-950/90 shadow-lg px-6 py-3 flex items-center justify-between sticky top-0 z-50 backdrop-blur-lg">
        <div class="flex items-center space-x-3">
            <img src="https://img.icons8.com/ios-filled/50/000000/retro-tv.png" alt="Logo Nostalgia" class="w-9 h-9">
            <span class="text-2xl font-bold text-gray-800 dark:text-white tracking-tight">Nostalgia</span>
        </div>
        <ul class="hidden md:flex space-x-8 text-gray-700 dark:text-gray-200 font-medium">
            <li><a href="/" class="hover:text-blue-600 focus:text-blue-700 transition-colors">Accueil</a></li>
            <li><a href="/catalogue" class="hover:text-blue-600 focus:text-blue-700 transition-colors">Catalogue</a></li>
            <li><a href="/blog" class="hover:text-blue-600 focus:text-blue-700 transition-colors">Blog</a></li>
            <li><a href="/about" class="hover:text-blue-600 focus:text-blue-700 transition-colors">About</a></li>
            <li><a href="#" class="hover:text-blue-600 focus:text-blue-700 transition-colors">Contact</a></li>
        </ul>
        <div class="hidden md:flex space-x-4">
            <a href="/login" class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-full text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition">Connexion</a>
            <a href="/register" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold shadow hover:bg-blue-700 transition">Inscription</a>
        </div>
        <!-- Mobile menu button -->
        <div class="md:hidden">
            <button aria-label="Open menu" @click="open = !open" x-data="{ open: false }" x-on:click="open = !open">
                <svg class="w-7 h-7 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <!-- Mobile menu dropdown -->
            <div x-show="open" x-transition class="absolute right-6 mt-3 w-48 bg-white dark:bg-gray-900 rounded-lg shadow-lg py-2 flex flex-col space-y-2 z-50">
                <a href="/" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">Accueil</a>
                <a href="/catalogue" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">Catalogue</a>
                <a href="/blog" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">Blog</a>
                <a href="/about" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">About</a>
                <a href="#" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">Contact</a>
                <a href="/login" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">Connexion</a>
                <a href="/register" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold shadow hover:bg-blue-700 transition mx-2">Inscription</a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <main class="flex-1 w-full bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-950 pt-8 pb-16">
        <div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row gap-10">
            <!-- Main Article Content -->
            <section class="flex-1 min-w-0">
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 mb-10">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
                        <div class="flex items-center gap-4">
                            <img src="{{ $article->user->avatar_url }}" alt="{{ $article->user->name }}" class="w-14 h-14 rounded-full border-2 border-blue-200 shadow">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">{{ $article->user->name }}</h3>
                                <p class="text-xs text-gray-400">{{ $article->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @if(!empty($article->category) && !empty($article->category->name))
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">{{ $article->category->name }}</span>
                            @endif
                            @foreach($article->tags as $tag)
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-6">{{ $article->title }}</h1>
                    @if($article->image)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-80 object-cover rounded-xl mb-8 border">
                    @endif
                    <div class="prose max-w-none text-gray-800 dark:text-gray-100 mb-10">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                    <!-- Similar Articles (Static, horizontal scroll) -->
                    <h2 class="text-2xl font-bold mb-4 text-gray-900">Articles Similaires</h2>
                    <div class="overflow-x-auto flex gap-6 pb-2 mb-8">
                        <!-- Static Example Card 1 -->
                        <a href="#" class="min-w-[260px] max-w-xs bg-white rounded-xl shadow-md hover:shadow-lg transition flex-shrink-0 border border-gray-100">
                            <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80" alt="Similar 1" class="w-full h-36 object-cover rounded-t-xl">
                            <div class="p-4">
                                <h3 class="font-semibold mb-1 text-gray-900">Découverte d'une mosaïque romaine</h3>
                                <p class="text-xs text-gray-600 mb-2">Une mosaïque rare du 3e siècle a été retrouvée lors de fouilles récentes en Algérie.</p>
                                <span class="text-blue-600 text-xs font-medium">Lire l'article</span>
                            </div>
                        </a>
                        <!-- Static Example Card 2 -->
                        <a href="#" class="min-w-[260px] max-w-xs bg-white rounded-xl shadow-md hover:shadow-lg transition flex-shrink-0 border border-gray-100">
                            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Similar 2" class="w-full h-36 object-cover rounded-t-xl">
                            <div class="p-4">
                                <h3 class="font-semibold mb-1 text-gray-900">Restaurer les manuscrits anciens</h3>
                                <p class="text-xs text-gray-600 mb-2">Les techniques modernes permettent de préserver des textes historiques pour les générations futures.</p>
                                <span class="text-blue-600 text-xs font-medium">Lire l'article</span>
                            </div>
                        </a>
                        <!-- Static Example Card 3 -->
                        <a href="#" class="min-w-[260px] max-w-xs bg-white rounded-xl shadow-md hover:shadow-lg transition flex-shrink-0 border border-gray-100">
                            <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80" alt="Similar 3" class="w-full h-36 object-cover rounded-t-xl">
                            <div class="p-4">
                                <h3 class="font-semibold mb-1 text-gray-900">Les secrets des poteries berbères</h3>
                                <p class="text-xs text-gray-600 mb-2">Un regard sur l'artisanat traditionnel et son impact sur la culture locale.</p>
                                <span class="text-blue-600 text-xs font-medium">Lire l'article</span>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Comments Sidebar (improved) -->
            <aside class="w-full lg:w-[370px] flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-lg p-6 top-10 flex flex-col">
                    <h2 class="text-xl font-bold mb-5 flex items-center gap-2 text-blue-700">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2h2m10-4h-4m0 0V4m0 0L8 8m8-4l-4 4"></path></svg>
                        Comments
                    </h2>
                    <!-- Shorter scroll area for comments -->
                    <div class="space-y-6 max-h-[220px] overflow-y-auto pr-2 border-b pb-4 mb-4">
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
        <!-- Comment Form always visible below comments -->
        <div class="pt-4">
            <div class="bg-white rounded-2xl shadow-2xl p-4 border border-blue-100">
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
                    <button id="buttonContent" type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit</button>
                </div>
            </form>
        </div>
    </div>
</aside>
            </div>


        </div>
    </div>
        <script>
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
        //  AJAX
        document.getElementById('commentForm').onsubmit = function(e) {
            e.preventDefault();
            fetch('/fake/comments', {method:'POST',body:new FormData(this)}).then(r=>r.json()).then(data=>alert('Comment sent!'));
        };
        </script>
    </div>

<script>
let editSelectedTags = new Set([
    @foreach($article->tags as $tag)
        '{{ $tag->id }}',
    @endforeach
]);

function openEditModal() {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function addEditTag() {
    const select = document.getElementById('editTagSelect');
    const tagId = select.value;
    const tagText = select.options[select.selectedIndex].text;

    if (tagId && !editSelectedTags.has(tagId)) {
        editSelectedTags.add(tagId);
        const tagElement = document.createElement('div');
        tagElement.className = 'bg-blue-100 text-blue-800 px-3 py-1 rounded flex items-center gap-2';
        tagElement.innerHTML = `
            ${tagText}
            <button type="button" onclick="removeEditTag('${tagId}', this)" class="text-blue-600 hover:text-blue-800">
                &times;
            </button>
        `;
        document.getElementById('editSelectedTags').appendChild(tagElement);
    }
    select.value = '';
}

function removeEditTag(tagId, button) {
    editSelectedTags.delete(tagId);
    button.parentElement.remove();
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('buttonContent').addEventListener('click', (e) => {
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
