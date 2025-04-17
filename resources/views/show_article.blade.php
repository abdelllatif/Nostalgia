<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <!-- Main Content and Sidebar Layout -->
    <div class="relative bg-gradient-to-br from-gray-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Main Article Content -->
                <main class="flex-1 min-w-0">
                    <article class="bg-white rounded-2xl shadow-lg p-8 mb-10">
                        <!-- Article Header -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
                            <div class="flex items-center gap-4">
                                <img src="{{ $article->user->avatar_url }}" alt="{{ $article->user->name }}" class="w-14 h-14 rounded-full border-2 border-blue-200 shadow">
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-900">{{ $article->user->name }}</h3>
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
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">{{ $article->title }}</h1>
                        @if($article->image)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-80 object-cover rounded-xl mb-8 border">
                        @endif
                        <div class="prose max-w-none text-gray-800 mb-10">
                            {!! nl2br(e($article->content)) !!}
                        </div>
                        <!-- Similar Articles -->
                        @if($similarArticles->count() > 0)
                        <div class="border-t pt-8 mt-8">
                            <h2 class="text-2xl font-bold mb-6 text-gray-900">Similar Articles</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($similarArticles as $similar)
                                    <a href="{{ route('blog.show', $similar) }}" class="block group">
                                        <div class="bg-gray-50 rounded-xl shadow-sm overflow-hidden group-hover:shadow-md transition">
                                            @if($similar->image)
                                                <img src="{{ $similar->image_url }}" alt="{{ $similar->title }}" class="w-full h-40 object-cover">
                                            @endif
                                            <div class="p-4">
                                                <h3 class="font-semibold mb-2 text-gray-900">{{ $similar->title }}</h3>
                                                <p class="text-sm text-gray-600">{{ Str::limit($similar->content, 100) }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </article>
                </main>
                <!-- Comments Sidebar (Static Example Data) -->
                <aside class="w-full lg:w-[370px] flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg p-7  top-10">
                        <h2 class="text-xl font-bold mb-5 flex items-center gap-2 text-blue-700">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2h2m10-4h-4m0 0V4m0 0L8 8m8-4l-4 4"></path></svg>
                            Comments
                        </h2>
                        <div class="space-y-6 max-h-[430px] overflow-y-auto pr-2">
                            <!-- Static Example Comments -->
                            <div class="rounded-xl bg-gray-50 border border-gray-200 p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Doe" class="w-9 h-9 rounded-full mr-3 border">
                                    <div class="flex-1">
                                        <span class="font-semibold text-sm text-gray-900">John Doe</span>
                                        <span class="block text-xs text-gray-400">2 hours ago</span>
                                    </div>
                                </div>
                                <div class="text-gray-800 text-sm mb-1">Great article! Very informative.</div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                </div>
                            </div>
                            <div class="rounded-xl bg-gray-50 border border-gray-200 p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Jane Smith" class="w-9 h-9 rounded-full mr-3 border">
                                    <div class="flex-1">
                                        <span class="font-semibold text-sm text-gray-900">Jane Smith</span>
                                        <span class="block text-xs text-gray-400">1 day ago</span>
                                    </div>
                                </div>
                                <div class="text-gray-800 text-sm mb-1">Loved the insights. Keep it up!</div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="#fbbf24" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="#fbbf24" viewBox="0 0 24 24"><polygon stroke-width="2" points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27"></polygon></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <!-- Comment Input Section (Full Width Floating Card) -->
            <div class=" max-w-2xl w-full mx-auto ">
                <div class="bg-white rounded-2xl shadow-2xl p-8 border border-blue-100">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900">Leave a Comment</h3>
                    <form id="commentForm" class="space-y-4" autocomplete="off">
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-2 mb-2">
                            <span class="mr-2 font-medium text-gray-700">Your Rating:</span>
                            <div id="starRating" class="flex gap-1">
                                <!-- 5 stars -->
                                <svg data-value="1" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                <svg data-value="2" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                <svg data-value="3" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                <svg data-value="4" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                <svg data-value="5" class="w-7 h-7 cursor-pointer text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.386-2.46a1 1 0 00-1.175 0l-3.386 2.46c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                            </div>
                            <input type="hidden" name="rating" id="ratingInput" value="0">
                        </div>
                        <textarea name="content" required rows="3" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-200" placeholder="Write your comment..."></textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            <script>
        // Interactive star rating logic
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
        // Simple AJAX (6 lines) for comment submission
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
</script>
</body>
</html>
