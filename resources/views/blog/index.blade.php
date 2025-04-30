@extends('components.layout')

@section('title', 'Blog - Enchères de Patrimoine Culturel')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Featured Article -->
    @if($featuredArticle)
    <div class="mb-12">
        <div class="relative rounded-lg overflow-hidden shadow-lg">
            <img src="{{ $featuredArticle->image ? asset('storage/' . $featuredArticle->image) : asset('images/placeholder.jpg') }}"
                 alt="{{ $featuredArticle->title }}"
                 class="w-full h-96 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="flex items-center text-white mb-4">
                    <img src="{{ $featuredArticle->user->profile_image ? asset('storage/' . $featuredArticle->user->profile_image) : asset('images/default-avatar.png') }}"
                         alt="{{ $featuredArticle->user->name }}"
                         class="w-10 h-10 rounded-full mr-4">
                    <div>
                        <p class="font-medium">{{ $featuredArticle->user->name }}</p>
                        <p class="text-sm text-gray-300">{{ $featuredArticle->created_at->format('d F Y') }}</p>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-white mb-4">{{ $featuredArticle->title }}</h2>
                <p class="text-gray-200 mb-6">{{ Str::limit($featuredArticle->content, 200) }}</p>
                <a href="{{ route('blog.show', $featuredArticle->id) }}"
                   class="inline-block bg-white text-gray-900 px-6 py-2 rounded-md hover:bg-gray-100 transition">
                    Lire la suite
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $article)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/placeholder.jpg') }}"
                 alt="{{ $article->title }}"
                 class="w-full h-48 object-cover">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <img src="{{ $article->user->profile_image ? asset('storage/' . $article->user->profile_image) : asset('images/default-avatar.png') }}"
                         alt="{{ $article->user->name }}"
                         class="w-8 h-8 rounded-full mr-3">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $article->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $article->created_at->format('d F Y') }}</p>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($article->content, 150) }}</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-comment mr-2"></i>
                        <span>{{ $article->comments_count }} commentaires</span>
                    </div>
                    <a href="{{ route('blog.show', $article->id) }}"
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        Lire la suite
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900">Aucun article disponible</h3>
            <p class="text-gray-500">Revenez plus tard pour découvrir de nouveaux articles.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="mt-8">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endsection
