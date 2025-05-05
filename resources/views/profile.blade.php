@extends('components.layout')

@section('title', $user->first_name . "'s Profile")

@section('content')
<!-- Profile Header -->
    <section class="relative bg-gradient-to-r from-gray-900 via-gray-800 to-indigo-900 py-16">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/3 text-center md:text-left mb-8 md:mb-0">
                    <div class="relative inline-block">
                        <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : Storage::url('anonymes_users/anonyme_user.jpg') }}"
                             alt="Profile"
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg"
                             id="profileImage">
                        <label for="profileImageInput" class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-lg cursor-pointer">
                            <i class="fas fa-camera text-gray-600"></i>
                        </label>
                        <input type="file" id="profileImageInput" class="hidden" accept="image/*" name="profile_image">
                    </div>
                </div>
                <div class="md:w-2/3 text-white">
                    <h1 class="text-4xl font-bold mb-4">{{ $user->first_name }} {{ $user->name }}</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-briefcase"></i>
                            <span>{{ $user->work ?? 'No work information' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-graduation-cap"></i>
                            <span>{{ $user->education ?? 'No education information' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Member since {{ $user->created_at->format('F Y') }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-200">{{ $user->bio ?? 'No bio available' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    </div>
    @endif

 <!-- Modal Preview -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-5 rounded-lg shadow-lg text-center max-w-md w-full">
      <h2 class="text-xl font-semibold mb-4">Preview Selected Image</h2>
      <img id="imagePreview" src="#" alt="Preview" class="mx-auto rounded mb-4 max-h-64">
      <div class="flex justify-around">
        <button id="confirmImageBtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Choose this image</button>
        <button id="cancelImageBtn" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Annuler</button>
      </div>
    </div>
  </div>


    <!-- Statistics Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-300 hover:-translate-y-1">
                <div class="text-center">
                    <i class="fas fa-newspaper text-4xl text-gray-600 mb-4"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $statistics['articles_count'] ?? 0 }}</h3>
                    <p class="text-gray-600">Articles</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-300 hover:-translate-y-1">
                <div class="text-center">
                    <i class="fas fa-box text-4xl text-gray-600 mb-4"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $statistics['products_count'] ?? 0 }}</h3>
                    <p class="text-gray-600">Products</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-300 hover:-translate-y-1">
                <div class="text-center">
                    <i class="fas fa-gavel text-4xl text-gray-600 mb-4"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $statistics['bids_count'] ?? 0 }}</h3>
                    <p class="text-gray-600">Bids</p>
                </div>
            </div>
        </div>

        <!-- Unpaid Winners Button -->
        @if($unpaidWinners->isNotEmpty())
            <div class="mt-6 text-center">
                <button onclick="showUnpaidWinnersModal()" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Voir les gagnants non payés ({{ $unpaidWinners->count() }})
                </button>
            </div>
        @endif

        <!-- Unpaid Winners Modal -->
        <div id="unpaidWinnersModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-6 max-w-2xl w-full">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Gagnants Non Payés</h3>
                    <button onclick="closeUnpaidWinnersModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gagnant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de Fin</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($unpaidWinners as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('product.details', ['product' => $product->id]) }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $product->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('user.show', ['id' => $product->winner->id]) }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $product->winner->name }} {{ $product->winner->first_name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($product->winning_amount, 2) }} €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->auction_end_date->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Aucun gagnant non payé
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Advanced Statistics with Charts -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Auction Statistics -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Performance des Enchères</h3>
                <canvas id="auctionChart" class="w-full h-64"></canvas>
                <div class="mt-4 grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-2xl font-bold text-green-600">{{ $statistics['auctions_won'] }}</p>
                        <p class="text-sm text-gray-600">Enchères Gagnées</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-red-600">{{ $statistics['auctions_lost'] }}</p>
                        <p class="text-sm text-gray-600">Enchères Perdues</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-600">{{ $statistics['auctions_active'] }}</p>
                        <p class="text-sm text-gray-600">Enchères Actives</p>
                    </div>
                </div>
            </div>

            <!-- Product Statistics -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Performance des Produits</h3>
                <canvas id="productChart" class="w-full h-64"></canvas>
                <div class="mt-4 grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-2xl font-bold text-blue-600">{{ $statistics['products_listed'] }}</p>
                        <p class="text-sm text-gray-600">Produits Listés</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-green-600">{{ $statistics['products_sold'] }}</p>
                        <p class="text-sm text-gray-600">Produits Vendus</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-red-600">{{ $statistics['products_unsold'] }}</p>
                        <p class="text-sm text-gray-600">Produits Non Vendus</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Won Products Section -->
        <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Enchères Gagnées</h3>
                @if($unpaidWinners->isNotEmpty())
                    <button onclick="showUnpaidWinnersModal()" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                        Voir les gagnants non payés ({{ $unpaidWinners->count() }})
                    </button>
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($wonProducts as $product)
                    <div class="bg-white border rounded-lg overflow-hidden shadow-sm">
                        <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'https://via.placeholder.com/400x200' }}"
                             class="w-full h-48 object-cover" alt="{{ $product->title }}">
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2">{{ $product->title }}</h4>
                            <p class="text-gray-600 text-sm mb-4">Gagné le {{ $product->auction_end_date->format('d/m/Y') }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">€{{ number_format($product->bids->max('amount'), 2) }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('product.details', ['product' => $product->id]) }}"
                                       class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        <i class="fas fa-eye mr-2"></i>Voir
                                    </a>
                                    @if($product->payment_status === 'paid')
                                        <a href="{{ route('payment.download-ticket', ['product' => $product->id]) }}"
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                            <i class="fas fa-ticket-alt mr-2"></i>Ticket
                                        </a>
                                    @else
                                        <a href="{{ route('payment.checkout', ['product' => $product->id]) }}"
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            <i class="fas fa-credit-card mr-2"></i>Payer
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <i class="fas fa-trophy text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900">Aucune enchère gagnée</h3>
                        <p class="text-gray-500">Continuez à enchérir pour gagner des objets incroyables!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="mt-8">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button class="border-gray-500 text-gray-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm active" data-section="about">
                        About
                    </button>
                    <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-section="articles">
                        Articles
                    </button>
                    <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-section="products">
                        Products
                    </button>
                    <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-section="reactions">
                        My Reactions
                    </button>
                    <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-section="activity">
                        Recent Activity
                    </button>
                </nav>
            </div>

            <!-- Content Sections -->
            <div class="mt-8">
                <!-- About Section -->
                <div class="section-content active" id="about">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">About Me</h2>
                        <form id="profileForm" action="{{ route('profile.update') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                            @csrf
                            <!-- Name Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" name="first_name" value="{{ $user->first_name }}"
                                        placeholder="Enter your first name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-md focus:border-gray-500 focus:ring-gray-500 h-10 px-3 bg-white">
                                    @error('first_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        placeholder="Enter your last name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-md focus:border-gray-500 focus:ring-gray-500 h-10 px-3 bg-white">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" disabled
                                    class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-md focus:border-gray-500 focus:ring-gray-500 h-10 px-3">
                                <p class="mt-1 text-sm text-gray-500">Email cannot be changed</p>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Contact Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input type="text" name="phone" value="{{ $user->phone }}"
                                        placeholder="Enter your phone number"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-md focus:border-gray-500 focus:ring-gray-500 h-10 px-3 bg-white">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input type="text" name="address" value="{{ $user->address }}"
                                        placeholder="Enter your address"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-md focus:border-gray-500 focus:ring-gray-500 h-10 px-3 bg-white">
                                    @error('address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Professional Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Work</label>
                                    <input type="text" name="work" value="{{ $user->work }}"
                                        placeholder="Enter your work information"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-md focus:border-gray-500 focus:ring-gray-500 h-10 px-3 bg-white">
                                    @error('work')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Education</label>
                                    <input type="text" name="education" value="{{ $user->education }}"
                                        placeholder="Enter your education"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-md focus:border-gray-500 focus:ring-gray-500 h-10 px-3 bg-white">
                                    @error('education')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Bio -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                <textarea name="bio" rows="4"
                                    placeholder="Tell us about yourself..."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-md focus:border-gray-500 focus:ring-gray-500 px-3 py-2 bg-white">{{ $user->bio }}</textarea>
                                @error('bio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                    class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Articles Section -->
                <div class="section-content hidden" id="articles">
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
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($article->content, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">{{ $article->created_at->format('M d, Y') }}</span>
                                        <a href="{{ route('blog.show', $article->id) }}" class="text-gray-600 hover:text-gray-700 font-medium">
                                            Read More
                                            <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900">No Articles Yet</h3>
                                <p class="text-gray-500">Start writing your first article!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Products Section -->
                <div class="section-content hidden" id="products">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                        <div class="relative flex flex-col bg-gray-50 dark:bg-gray-900 rounded-2xl shadow-lg overflow-hidden h-[500px] transition hover:scale-105">
                            <!-- Product Image -->
                            <div class="h-60 w-full overflow-hidden">
                                <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'https://images.unsplash.com/photo-1741805190625-7386d2180e57?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1M3x8fGVufDB8fHx8fA%3D%3D' }}"
                                    alt="{{ $product->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>

                            <!-- Product Content -->
                            <div class="flex flex-col flex-1 p-4">

                                <!-- User Info moved here -->
                                <div class="flex items-center mb-4">
                                    <img src="{{ $product->user->profile_image ? asset('storage/' . $product->user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($product->user->first_name . ' ' . $product->user->last_name) }}"
                                        alt="{{ $product->user->first_name }} {{ $product->user->name }}"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md">
                                    <div class="ml-3">
                                        <h5 class="text-gray-800 dark:text-white font-semibold text-sm">
                                            {{ $product->user->first_name }} {{ $product->user->name }}
                                        </h5>
                                    </div>
                                </div>

                                <!-- Product Title -->
                                <h4 class="text-gray-700 dark:text-gray-400 text-md font-medium mb-4 line-clamp-2">
                                    {{ $product->title }}
                                </h4>
                                <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>

                                <!-- Info -->
                                <div class="mt-auto">
                                    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mb-2">
                                        <span class="font-semibold">Prix: {{ number_format($product->starting_price, 2) }}€</span>
                                        <span>{{ $product->bids_count }} enchères</span>
                                    </div>

                                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 border-t pt-2">
                                        <span>Fin:</span>
                                        <span class="text-gray-900 dark:text-white font-medium">
                                            {{ \Carbon\Carbon::parse($product->auction_end_date)->format('d F, H:i') }}
                                        </span>
                                    </div>

                                    <a href="{{ route('product.details', ['product' => $product->id]) }}"
                                       class="block w-full mt-4 text-center bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white text-sm py-2 rounded-lg transition">
                                        Voir les détails
                                    </a>
                                </div>

                            </div>
                        </div>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <i class="fas fa-box text-4xl text-gray-400 mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900">No Products Yet</h3>
                                <p class="text-gray-500">Start adding your first product!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reactions Section -->
<div class="section-content hidden" id="reactions">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">My Reactions</h2>
        <div class="space-y-6">
            @forelse($reactions as $reaction)
                <div class="border-b border-gray-200 pb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $reaction->article_title }}</h3>
                            <div class="mt-2 text-gray-600">
                                @if($reaction->comment)
                                    <p class="mb-2">{{ $reaction->comment }}</p>
                                @endif
                                @if($reaction->rating)
                                    <div class="flex items-center">
                                        <span class="mr-2">Rating:</span>
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $reaction->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-2 text-sm text-gray-500">
                                {{ $reaction->created_at->format('M d, Y H:i') }}
                            </div>
                        </div>

                        <!-- Actions (Show and Delete) -->
                        <div class="flex space-x-2 mt-2">
                            <!-- Show Button -->
                            <a href="{{ route('blog.show', $reaction->article_id) }}" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye text-xl"></i>
                            </a>
                            <form action="{{ route('reaction.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reaction?');">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="rating" value="{{ $reaction->rating }}">
                                <input type="hidden" name="comment" value="{{ $reaction->comment}}">
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash text-xl"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-comment text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900">No Reactions Yet</h3>
                    <p class="text-gray-500">Start commenting on articles!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


    <!-- Recent Activity Section -->
    <div class="section-content hidden" id="activity">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Recent Activity</h2>
            <div class="space-y-6">
                @forelse($recentActivity as $activity)
                    <div class="border-b border-gray-200 pb-4">
                        @if($activity['type'] == 'article')
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-newspaper text-gray-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Published an article</h3>
                                    <p class="text-gray-600">{{ $activity['item']->title }}</p>
                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $activity['date']->format('M d, Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @elseif($activity['type'] == 'product')
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-box text-gray-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Added a product</h3>
                                    <p class="text-gray-600">{{ $activity['item']->title }}</p>
                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $activity['date']->format('M d, Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @elseif($activity['type'] == 'bid')
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-gavel text-gray-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Placed a bid</h3>
                                    <p class="text-gray-600">€{{ number_format($activity['item']->amount, 2) }} on {{ $activity['item']->product->title }}</p>
                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $activity['date']->format('M d, Y H:i') }}
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('product.details', ['product' => $activity['item']->product->id]) }}" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye mr-1"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @elseif($activity['type'] == 'won_auction')
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-trophy text-yellow-500 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Won an Auction!</h3>
                                    <p class="text-gray-600">{{ $activity['item']->title }}</p>
                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $activity['date']->format('M d, Y H:i') }}
                                    </div>
                                    <div class="mt-2 flex items-center space-x-4">
                                        <a href="{{ route('product.details', ['product' => $activity['item']->id]) }}" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye mr-1"></i>View Details
                                        </a>
                                        @if(!$activity['item']->payment_completed)
                                            <a href="{{ route('payment.checkout', ['product' => $activity['item']->id]) }}" class="text-green-600 hover:text-green-800">
                                                <i class="fas fa-credit-card mr-1"></i>Pay Now
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($activity['type'] == 'reaction')
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-comment text-gray-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Reacted to an article</h3>
                                    <p class="text-gray-600">{{ $activity['item']->article_title }}</p>
                                    @if($activity['item']->comment)
                                        <p class="text-gray-600 mt-1">{{ $activity['item']->comment }}</p>
                                    @endif
                                    @if($activity['item']->rating)
                                        <div class="flex items-center mt-1">
                                            <span class="mr-2">Rating:</span>
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $activity['item']->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    @endif
                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $activity['date']->format('M d, Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-history text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900">No Recent Activity</h3>
                        <p class="text-gray-500">Your activity will appear here</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.querySelectorAll('[data-section]').forEach(button => {
            button.addEventListener('click', () => {
                // Update active tab
                document.querySelectorAll('[data-section]').forEach(btn => {
                    btn.classList.remove('border-gray-500', 'text-gray-600');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });
                button.classList.remove('border-transparent', 'text-gray-500');
                button.classList.add('border-gray-500', 'text-gray-600');

                // Show active content
                const sectionId = button.getAttribute('data-section');
                document.querySelectorAll('.section-content').forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(sectionId).classList.remove('hidden');
            });
        });

        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });

        // Image upload preview functionality
        const profileImageInput = document.getElementById('profileImageInput');
        const imagePreviewModal = document.getElementById('imagePreviewModal');
        const imagePreview = document.getElementById('imagePreview');
        const cancelImageBtn = document.getElementById('cancelImageBtn');
        const confirmImageBtn = document.getElementById('confirmImageBtn');
        const profileImage = document.getElementById('profileImage');
        let selectedFile = null;

        profileImageInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                selectedFile = this.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewModal.classList.remove('hidden');
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        cancelImageBtn.addEventListener('click', function() {
            imagePreviewModal.classList.add('hidden');
            profileImageInput.value = '';
            selectedFile = null;
        });

        confirmImageBtn.addEventListener('click', function() {
            if (selectedFile) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                }

                reader.readAsDataURL(selectedFile);
                imagePreviewModal.classList.add('hidden');
            }
        });

        // Chart.js Initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Load Chart.js from CDN
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
            script.onload = initializeCharts;
            document.head.appendChild(script);
        });

        function initializeCharts() {
            // Auction Performance Chart
            const auctionCtx = document.getElementById('auctionChart').getContext('2d');
            new Chart(auctionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Gagnées', 'Perdues', 'Actives'],
                    datasets: [{
                        data: [
                            {{ $statistics['auctions_won'] }},
                            {{ $statistics['auctions_lost'] }},
                            {{ $statistics['auctions_active'] }}
                        ],
                        backgroundColor: [
                            'rgba(72, 187, 120, 0.8)',  // green for won
                            'rgba(237, 100, 100, 0.8)', // red for lost
                            'rgba(66, 153, 225, 0.8)'   // blue for active
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Participation aux Enchères'
                        }
                    }
                }
            });

            // Product Performance Chart
            const productCtx = document.getElementById('productChart').getContext('2d');
            new Chart(productCtx, {
                type: 'bar',
                data: {
                    labels: ['Listés', 'Vendus', 'Non Vendus'],
                    datasets: [{
                        label: 'Produits',
                        data: [
                            {{ $statistics['products_listed'] }},
                            {{ $statistics['products_sold'] }},
                            {{ $statistics['products_unsold'] }}
                        ],
                        backgroundColor: [
                            'rgba(66, 153, 225, 0.8)',  // blue for listed
                            'rgba(72, 187, 120, 0.8)',  // green for sold
                            'rgba(237, 100, 100, 0.8)'  // red for unsold
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Statut des Produits'
                        }
                    }
                }
            });
        }

        // Unpaid Winners Modal Functions
        function showUnpaidWinnersModal() {
            document.getElementById('unpaidWinnersModal').classList.remove('hidden');
        }

        function closeUnpaidWinnersModal() {
            document.getElementById('unpaidWinnersModal').classList.add('hidden');
        }
    </script>
    @endsection
