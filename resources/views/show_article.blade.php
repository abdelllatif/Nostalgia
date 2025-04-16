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
    <div class="max-w-4xl mx-auto">
        <!-- Article Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <img src="{{ $article->user->avatar_url }}" alt="{{ $article->user->name }}" 
                        class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h3 class="font-medium">{{ $article->user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $article->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                @if(auth()->id() === $article->user_id)
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-2 hover:bg-gray-100 rounded">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" 
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            <button onclick="openEditModal()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                Edit Article
                            </button>
                            <button onclick="deleteArticle()" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left">
                                Delete Article
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            <h1 class="text-4xl font-bold mb-4">{{ $article->title }}</h1>
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded">
                    {{ $article->category->name }}
                </span>
                @foreach($article->tags as $tag)
                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
            @if($article->image)
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" 
                    class="w-full h-[400px] object-cover rounded-lg mb-8">
            @endif
        </div>

        <!-- Article Content -->
        <div class="prose max-w-none mb-12">
            {!! nl2br(e($article->content)) !!}
        </div>

        <!-- Similar Articles -->
        @if($similarArticles->count() > 0)
            <div class="border-t pt-8">
                <h2 class="text-2xl font-bold mb-6">Similar Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($similarArticles as $similar)
                        <a href="{{ route('blog.show', $similar) }}" class="block">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if($similar->image)
                                    <img src="{{ $similar->image_url }}" alt="{{ $similar->title }}" 
                                        class="w-full h-40 object-cover">
                                @endif
                                <div class="p-4">
                                    <h3 class="font-semibold mb-2">{{ $similar->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ Str::limit($similar->content, 100) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Edit Modal -->
    @if(auth()->id() === $article->user_id)
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="bg-white rounded-lg p-8 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <h2 class="text-2xl font-bold mb-6">Edit Article</h2>
                <form id="editForm" onsubmit="updateArticle(event)" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input type="text" id="editTitle" required class="w-full px-4 py-2 border rounded" 
                            value="{{ $article->title }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Content</label>
                        <textarea id="editContent" required rows="6" class="w-full px-4 py-2 border rounded">{{ $article->content }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Category</label>
                        <select id="editCategory" required class="w-full px-4 py-2 border rounded">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tags</label>
                        <div class="flex flex-wrap gap-2 mb-2" id="editSelectedTags">
                            @foreach($article->tags as $tag)
                                <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded flex items-center gap-2">
                                    {{ $tag->name }}
                                    <button type="button" onclick="removeEditTag('{{ $tag->id }}', this)" 
                                        class="text-blue-600 hover:text-blue-800">&times;</button>
                                </div>
                            @endforeach
                        </div>
                        <select id="editTagSelect" onchange="addEditTag()" class="w-full px-4 py-2 border rounded">
                            <option value="">Select tags...</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">New Image</label>
                        <input type="file" id="editImage" accept="image/*" class="w-full">
                    </div>
                    <div class="flex justify-end gap-4">
                        <button type="button" onclick="closeEditModal()" 
                            class="px-4 py-2 border rounded hover:bg-gray-100">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
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

async function updateArticle(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('title', document.getElementById('editTitle').value);
    formData.append('content', document.getElementById('editContent').value);
    formData.append('category_id', document.getElementById('editCategory').value);
    editSelectedTags.forEach(tagId => formData.append('tags[]', tagId));
    
    const imageFile = document.getElementById('editImage').files[0];
    if (imageFile) {
        formData.append('image', imageFile);
    }

    try {
        const response = await fetch('{{ route("blog.update", $article) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        });

        if (response.ok) {
            window.location.reload();
        } else {
            const data = await response.json();
            alert(data.message || 'Error updating article');
        }
    } catch (error) {
        alert('Error updating article');
    }
}

async function deleteArticle() {
    if (!confirm('Are you sure you want to delete this article?')) {
        return;
    }

    try {
        const response = await fetch('{{ route("blog.destroy", $article) }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });

        if (response.ok) {
            window.location.href = '{{ route("blog.index") }}';
        } else {
            const data = await response.json();
            alert(data.message || 'Error deleting article');
        }
    } catch (error) {
        alert('Error deleting article');
    }
}
</script>
</body>
</html>
