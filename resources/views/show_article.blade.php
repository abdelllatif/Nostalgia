<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS for alerts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between sticky top-0 z-30">
        <div class="flex items-center space-x-2">
            <img src="https://img.icons8.com/ios-filled/50/000000/retro-tv.png" alt="Logo" class="w-8 h-8">
            <span class="text-xl font-bold text-gray-800">Nostalgia</span>
        </div>
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
            <li><a href="/" class="hover:text-blue-600">Accueil</a></li>
            <li><a href="/catalogue" class="hover:text-blue-600">Catalogue</a></li>
            <li><a href="/blog" class="hover:text-blue-600">Blog</a></li>
            <li><a href="/about" class="hover:text-blue-600">About</a></li>
        </ul>
        <div class="hidden md:flex space-x-4">
            @if(!Cookie::has('jwt_token'))
                <a href="/login" class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Connexion</a>
                <a href="/register" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Inscription</a>
            @else
                <a href="/profile" class="px-4 py-2 border rounded-full text-sm hover:bg-gray-100">Profile</a>
                <a href="/logout" class="px-4 py-2 bg-red-600 text-white rounded-full text-sm hover:bg-red-700">Déconnexion</a>
            @endif
        </div>
        <div class="md:hidden" x-data="{ open: false }">
            <button @click="open = !open">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute top-16 right-0 left-0 bg-white shadow-md p-4 z-50">
                <ul class="space-y-3">
                    <li><a href="/" class="block py-2 hover:text-blue-600">Accueil</a></li>
                    <li><a href="/catalogue" class="block py-2 hover:text-blue-600">Catalogue</a></li>
                    <li><a href="/blog" class="block py-2 hover:text-blue-600">Blog</a></li>
                    <li><a href="/about" class="block py-2 hover:text-blue-600">About</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-1 w-full pt-8 pb-16">
        <div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row gap-10">
            <!-- Main Article Content -->
            <section class="flex-1 min-w-0">
                <div class="bg-white rounded-xl shadow-lg p-8 mb-10">
                    <!-- Author Info -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
                        <a href="{{route('user.show',['id'=> $article->user->id ])}}" class="flex items-center gap-4">
                            <img src="{{ $article->user->avatar_url }}" alt="{{ $article->user->name }}" class="w-14 h-14 rounded-full border-2 border-blue-200 shadow object-cover">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900">{{ $article->user->name }} {{ $article->user->first_name }}</h3>
                                <p class="text-xs text-gray-400">{{ $article->created_at->format('M d, Y') }}</p>
                            </div>
                        </a>
                        <div class="flex flex-wrap gap-2">
                            @if(!empty($article->categorie) && !empty($article->category_id))
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">{{ $article->categorie->name }}</span>
                            @endif
                            @foreach($article->tags as $tag)
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Article Title and Content -->
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">{{ $article->title }}</h1>
                    @if(auth()->check() || request()->has('owner'))
                    <p class="text-red-500 font-bold text-lg">Hey Owner</p>
                        <div class="relative inline-block text-left">
                            <button @click="open = !open" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                    <a href="{{ route('article.edit', $article->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit</a>
                                    <form method="POST" action="{{ route('article.destroy', $article->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($article->image)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-80 object-cover rounded-xl mb-8 border shadow-sm">
                    @endif
                    <div class="prose max-w-none text-gray-800 mb-10 leading-relaxed">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Social Share Buttons -->
                    <div class="flex items-center gap-4 mb-10 border-t border-b py-4">
                        <span class="text-sm font-medium text-gray-700">Share:</span>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                            <i class="fab fa-twitter text-lg"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                            <i class="fab fa-facebook text-lg"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($article->title) }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                            <i class="fab fa-linkedin text-lg"></i>
                        </a>
                        <a href="mailto:?subject={{ urlencode($article->title) }}&body={{ urlencode(url()->current()) }}" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-envelope text-lg"></i>
                        </a>
                    </div>

                    <!-- Similar Articles -->
                    <h2 class="text-2xl font-bold mb-4 text-gray-900">Articles Similaires</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($similarArticles as $similarArticle)
                            <a href="{{ route('blog.show', $similarArticle->id) }}" class="bg-white rounded-xl shadow hover:shadow-md border border-gray-100">
                                @if($similarArticle->image_url)
                                    <img src="{{ $similarArticle->image_url }}" alt="{{ $similarArticle->title }}" class="w-full h-40 object-cover rounded-t-xl">
                                @else
                                    <div class="w-full h-40 bg-gray-200 rounded-t-xl flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <div class="text-xs text-blue-600 font-semibold mb-1">{{ $similarArticle->categorie->name ?? 'Sans catégorie' }}</div>
                                    <h3 class="font-bold text-gray-900 mb-2 text-sm line-clamp-2">{{ $similarArticle->title }}</h3>
                                    <p class="text-xs text-gray-500 line-clamp-2">{{ Str::limit($similarArticle->content, 100) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Comments Sidebar -->
            <aside class="w-full lg:w-[350px] flex-shrink-0">
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6  top-24">
                    <h2 class="text-xl font-bold mb-5 flex items-center gap-2 text-blue-700">
                        <i class="far fa-comments text-blue-500"></i>
                        Comments
                    </h2>
                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2" id="commentsContainer">
                        @if($article->comments->count() > 0)
                            @foreach($article->comments as $comment)
                                <div class="rounded-lg bg-gray-50 border border-gray-200 p-4 shadow-sm">
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
                                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                @else
                                                    <i class="far fa-star text-yellow-400 text-xs"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="rounded-lg bg-gray-50 border border-gray-200 p-4 shadow-sm">
                                <p class="text-gray-500 text-center">No comments yet. Be the first to comment!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Comment Form -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900">Leave a Comment</h3>

                    <!-- Alert container -->
                    <div id="alertContainer" class="mb-4" style="display: none;"></div>

                    @if(Cookie::has('jwt_token'))
                        <form id="commentForm" action="{{ route('reaction.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="flex items-center gap-2 mb-2">
                                <span class="mr-2 font-medium text-gray-700">Rating:</span>
                                <div id="starRating" class="flex gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i data-value="{{ $i }}" class="far fa-star cursor-pointer text-gray-300 hover:text-yellow-400 text-xl"></i>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="ratingInput" value="0">
                                <input type="hidden" name="article_id" value="{{$article->id}}">
                            </div>
                            <textarea name="content" required rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400" placeholder="Write your comment..."></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                    <i class="far fa-paper-plane mr-2"></i>Submit
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 text-center">
                            <p class="text-blue-700 mb-3 font-medium">Please sign in to leave a comment</p>
                            <a href="/login" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Sign In
                            </a>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="https://img.icons8.com/ios-filled/50/ffffff/retro-tv.png" alt="Logo" class="w-8 h-8">
                        <span class="text-xl font-bold">Nostalgia</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Exploring the past, celebrating the classics, and sharing memories.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="/blog" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="/about" class="text-gray-400 hover:text-white">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-lg w-full focus:outline-none text-gray-800">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Nostalgia. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initStarRating();
            initCommentForm();
        });

        // Star rating functionality
        function initStarRating() {
            const stars = document.querySelectorAll('#starRating i');
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
                        s.classList.remove('far');
                        s.classList.add('fas');
                        s.classList.add('text-yellow-400');
                        s.classList.remove('text-gray-300');
                    } else {
                        s.classList.add('far');
                        s.classList.remove('fas');
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            }
        }

        // Comment form submission
        function initCommentForm() {
            const form = document.getElementById('commentForm');
            if (!form) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get rating value
                const rating = document.getElementById('ratingInput').value;

                // Validate rating
                if (!rating || rating === '0') {
                    showAlert('Please select a rating', 'danger');
                    return;
                }

                // Submit form with fetch
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: new FormData(this)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Show success message
                        showAlert('Comment added successfully!', 'success');

                        // Reset form
                        form.reset();
                        document.getElementById('ratingInput').value = '0';
                        resetStars();

                        // Add comment to list
                        addNewComment(data);
                    } else {
                        showAlert(data.message || 'Error adding comment', 'danger');
                    }
                })
                .catch(error => {
                    showAlert('Error submitting comment', 'danger');
                    console.error(error);
                });
            });
        }

        // Show Bootstrap alert
        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            alertContainer.innerHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            alertContainer.style.display = 'block';

            // Auto hide after 5 seconds
            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        }

        // Reset star rating
        function resetStars() {
            const stars = document.querySelectorAll('#starRating i');
            stars.forEach(star => {
                star.classList.add('far');
                star.classList.remove('fas');
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            });
        }

        // Add new comment to the list
        function addNewComment(data) {
            const commentsContainer = document.getElementById('commentsContainer');

            // Remove "no comments" message if it exists
            const noComments = commentsContainer.querySelector('p.text-gray-500.text-center');
            if (noComments) {
                noComments.closest('.rounded-lg').remove();
            }

            // Create stars HTML
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= data.rating) {
                    starsHtml += `<i class="fas fa-star text-yellow-400 text-xs"></i>`;
                } else {
                    starsHtml += `<i class="far fa-star text-yellow-400 text-xs"></i>`;
                }
            }

            // Create new comment element
            const newComment = document.createElement('div');
            newComment.className = 'rounded-lg bg-gray-50 border border-gray-200 p-4 shadow-sm';
            newComment.innerHTML = `
                <div class="flex items-center mb-2">
                    <img src="${data.user.avatar_url}" alt="${data.user.name}" class="w-9 h-9 rounded-full mr-3 border">
                    <div class="flex-1">
                        <span class="font-semibold text-sm text-gray-900">${data.user.name}</span>
                        <span class="block text-xs text-gray-400">Just now</span>
                    </div>
                </div>
                <div class="text-gray-800 text-sm mb-1">${data.comment}</div>
                <div class="flex items-center gap-1">
                    ${starsHtml}
                </div>
            `;

            // Add to the top of the comments
            commentsContainer.prepend(newComment);
        }
    </script>
</body>
</html>
