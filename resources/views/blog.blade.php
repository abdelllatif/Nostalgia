<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header Section -->
    <section class="relative bg-gradient-to-r from-purple-900 via-purple-800 to-indigo-900 py-16">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-4">Blog</h1>
                <p class="text-xl text-gray-200">Discover and share knowledge about art and antiques</p>
                <button class="mt-8 bg-white text-purple-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300" onclick="openNewArticleModal()">
                    <i class="fas fa-plus mr-2"></i>Create New Article
                </button>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input type="text" placeholder="Search articles..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div>
                    <select class="w-full border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                        <option value="">All Categories</option>
                        <option value="painting">Paintings</option>
                        <option value="sculpture">Sculptures</option>
                        <option value="furniture">Furniture</option>
                        <option value="jewelry">Jewelry</option>
                    </select>
                </div>
                <div>
                    <select class="w-full border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($articles as $article)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1">
                    <div class="relative h-48">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/placeholder.jpg') }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-24"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <img src="{{ $article->user->profile_image ? Storage::url($article->user->profile_image) : Storage::url('anonymes_users/anonyme_user.jpg') }}"
                                 alt="{{ $article->user->name }}"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $article->user->first_name }} {{ $article->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $article->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($article->content, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                @foreach($article->tags as $tag)
                                    <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <a href="{{ route('Article.show', $article->id) }}" class="text-purple-600 hover:text-purple-700 font-medium">
                                Read More
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900">No Articles Found</h3>
                    <p class="text-gray-500">Be the first to write an article!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>

    <!-- New Article Modal -->
    <div id="newArticleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Create New Article</h3>
                        <button onclick="closeNewArticleModal()" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="p-4 overflow-y-auto" style="max-height: calc(90vh - 140px);">
                    <form id="newArticleForm" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Content</label>
                                <textarea name="content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                    <option value="">Select a category</option>
                                    <option value="painting">Paintings</option>
                                    <option value="sculpture">Sculptures</option>
                                    <option value="furniture">Furniture</option>
                                    <option value="jewelry">Jewelry</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tags</label>
                                <div class="mt-1">
                                    <!-- Selected Tags Display -->
                                    <div id="selectedTags" class="flex flex-wrap gap-2 mb-2"></div>

                                    <!-- Tag Library Container -->
                                    <div class="border-2 border-gray-300 rounded-lg overflow-hidden">
                                        <!-- Search Bar -->
                                        <div class="p-2 border-b border-gray-200">
                                            <div class="relative">
                                                <input type="text"
                                                       id="tagSearch"
                                                       placeholder="Search tags..."
                                                       class="w-full pl-8 pr-4 py-1 text-sm border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                                                <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                                    <i class="fas fa-search text-gray-400 text-sm"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tags Grid -->
                                        <div class="p-2 max-h-40 overflow-y-auto">
                                            <div class="grid grid-cols-2 gap-2" id="tagsGrid">
                                                @foreach ($tags as $tag)
                                                    <div class="tag-item">
                                                        <button type="button"
                                                                onclick="toggleTag('{{$tag->id}}', '{{$tag->name}}')"
                                                                class="w-full p-2 text-left bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200 group">
                                                            <div class="flex items-center justify-between">
                                                                <span class="text-sm font-medium text-gray-900">{{$tag->name}}</span>
                                                                <i class="fas fa-check text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
                                                            </div>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Image</label>
                                <div class="mt-1 flex justify-center px-4 pt-4 pb-4 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="article-image" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                                <span>Upload a file</span>
                                                <input id="article-image" name="image" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 flex justify-end rounded-b-lg">
                    <button type="button" onclick="closeNewArticleModal()" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mr-2">
                        Cancel
                    </button>
                    <button type="submit" form="newArticleForm" class="bg-purple-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-700">
                        Publish Article
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openNewArticleModal() {
            document.getElementById('newArticleModal').classList.remove('hidden');
        }

        function closeNewArticleModal() {
            document.getElementById('newArticleModal').classList.add('hidden');
        }

        // Handle form submission
        document.getElementById('newArticleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
        });

        // Handle image preview
        document.getElementById('article-image').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Add image preview logic here
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Tag library functionality
        const tagSearch = document.getElementById('tagSearch');
        const tagsGrid = document.getElementById('tagsGrid');
        const tagItems = document.querySelectorAll('.tag-item');
        let selectedTagsSet = new Set();

        // Search functionality
        if (tagSearch) {
            tagSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                tagItems.forEach(item => {
                    const tagName = item.querySelector('span').textContent.toLowerCase();
                    const shouldShow = tagName.includes(searchTerm);
                    item.style.display = shouldShow ? 'block' : 'none';
                });
            });
        }

        function toggleTag(tagId, tagName) {
            if (selectedTagsSet.has(tagId)) {
                removeTag(tagId);
            } else {
                selectedTagsSet.add(tagId);
                const tagElement = document.createElement('div');
                tagElement.className = 'inline-flex items-center bg-purple-100 px-3 py-1 rounded-full text-sm font-medium text-purple-600';
                tagElement.innerHTML = `
                    ${tagName}
                    <input type="hidden" name="tags[]" value="${tagId}">
                    <button type="button" class="ml-2 text-purple-600 hover:text-purple-800" onclick="removeTag('${tagId}')">&times;</button>
                `;
                document.getElementById('selectedTags').appendChild(tagElement);
            }
        }

        function removeTag(tagId) {
            const tagElement = document.querySelector(`input[value="${tagId}"]`).parentElement;
            tagElement.remove();
            selectedTagsSet.delete(tagId);
        }
    </script>
</body>
</html>
