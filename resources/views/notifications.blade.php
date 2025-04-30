@extends('components.layout')

@section('title', 'Notifications - Enchères de Patrimoine Culturel')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900">Notifications</h2>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse($notifications as $notification)
                <div class="p-6 {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            @if($notification->type === 'App\Notifications\NewBidNotification')
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @elseif($notification->type === 'App\Notifications\AuctionEndedNotification')
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @else
                                <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $notification->data['title'] }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $notification->data['message'] }}
                            </p>
                            @if(isset($notification->data['action_url']))
                                <div class="mt-2">
                                    <a href="{{ $notification->data['action_url'] }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                        {{ $notification->data['action_text'] ?? 'Voir plus' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <p class="text-sm text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                            @if(!$notification->read_at)
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                                        Marquer comme lu
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    Aucune notification pour le moment.
                </div>
            @endforelse
        </div>

        @if($notifications->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
