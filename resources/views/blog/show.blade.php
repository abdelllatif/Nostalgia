@extends('components.layout')

@section('title', $article->title . ' - Enchères de Patrimoine Culturel')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Article Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
        <div class="flex items-center text-gray-600">
            <img src="{{ $article->user->profile_image ? asset('storage/' . $article->user->profile_image) : asset('images/default-avatar.png') }}"
                 alt="{{ $article->user->name }}"
                 class="w-10 h-10 rounded-full mr-4">
            <div>
                <p class="font-medium text-gray-900">{{ $article->user->name }}</p>
                <p class="text-sm">{{ $article->created_at->format('d F Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Article Image -->
    @if($article->image)
    <div class="mb-8">
        <img src="{{ asset('storage/' . $article->image) }}"
             alt="{{ $article->title }}"
             class="w-full h-96 object-cover rounded-lg shadow-lg">
    </div>
    @endif

    <!-- Article Content -->
    <div class="prose prose-lg max-w-none mb-12">
        {!! $article->content !!}
    </div>

    <!-- Comments Section -->
    <div class="border-t pt-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Commentaires ({{ $article->comments->count() }})</h2>

        @auth
        <!-- Comment Form -->
        <form action="{{ route('blog.comments.store', $article->id) }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                <textarea name="content" rows="4"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Écrivez votre commentaire...">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Publier le commentaire
            </button>
        </form>
        @endauth

        <!-- Comments List -->
        <div class="space-y-6">
            @forelse($article->comments as $comment)
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <img src="{{ $comment->user->profile_image ? asset('storage/' . $comment->user->profile_image) : asset('images/default-avatar.png') }}"
                         alt="{{ $comment->user->name }}"
                         class="w-8 h-8 rounded-full mr-3">
                    <div>
                        <p class="font-medium text-gray-900">{{ $comment->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->format('d F Y à H:i') }}</p>
                    </div>
                </div>
                <p class="text-gray-700">{{ $comment->content }}</p>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Aucun commentaire pour le moment.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
