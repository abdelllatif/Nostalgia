@extends('components.layout')

@section('title', $user->first_name . "'s Profile")

@section('content')
  <!-- Profile Header -->
  <div class="bg-gray-100 py-8 mb-6 shadow-sm">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row items-center">
        <div class="md:w-1/4 flex justify-center mb-4 md:mb-0">
          <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : Storage::url('anonymes_users/anonyme_user.jpg') }}"
               alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow">
        </div>
        <div class="md:w-3/4 md:pl-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->first_name }} {{ $user->name }}</h2>
          <div class="space-y-2 text-gray-600">
            <div class="flex items-center">
              <i class="fas fa-briefcase mr-2 w-5 text-gray-500"></i>
              <span>{{ $user->work ?? 'No work information' }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-graduation-cap mr-2 w-5 text-gray-500"></i>
              <span>{{ $user->education ?? 'No education information' }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-calendar-alt mr-2 w-5 text-gray-500"></i>
              <span>Member since {{ $user->created_at->format('F Y') }}</span>
            </div>
            <div class="flex items-start mt-3">
              <i class="fas fa-user mr-2 w-5 text-gray-500 mt-1"></i>
              <span>{{ $user->bio ?? 'No bio available' }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row gap-6">

      <!-- Statistics Card -->
      <div class="md:w-1/3">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
          <h5 class="font-bold text-lg mb-4 text-gray-800">Statistics</h5>
          <div class="flex justify-between items-center mb-3">
            <span class="text-gray-600">Articles</span>
            <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">{{ $statistics['articles_count'] }}</span>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-gray-600">Active Products</span>
            <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">{{ $statistics['products_count'] }}</span>
          </div>
        </div>
      </div>

      <!-- Articles and Products Tabs -->
      <div class="md:w-2/3">

        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-4">
          <ul class="flex flex-wrap -mb-px" id="profileTabs" role="tablist">
            <li class="mr-2" role="presentation">
              <button class="inline-block py-2 px-4 text-gray-700 border-b-2 border-gray-700 rounded-t-lg active"
                      id="articles-tab"
                      onclick="switchTab('articles')"
                      type="button"
                      role="tab">
                Recent Articles
              </button>
            </li>
            <li class="mr-2" role="presentation">
              <button class="inline-block py-2 px-4 text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg"
                      id="products-tab"
                      onclick="switchTab('products')"
                      type="button"
                      role="tab">
                Active Products
              </button>
            </li>
          </ul>
        </div>

        <!-- Tabs Content -->
        <div id="profileTabsContent">
          <!-- Articles -->
          <div class="block" id="articles" role="tabpanel">
            <div class="bg-white rounded-lg shadow-md mb-6">
              <div class="flex justify-between items-center p-4 border-b">
                <h5 class="font-bold text-lg text-gray-800">Recent Articles</h5>
                <a href="{{ route('user.articles', $user->id) }}" class="px-3 py-1 text-sm border border-gray-600 text-gray-600 rounded hover:bg-gray-100">View All</a>
              </div>
              <div class="p-4">
                @if($articles->count() > 0)
                  <div class="grid md:grid-cols-2 gap-4">
                    @foreach($articles as $article)
                      <div class="bg-white border rounded-lg overflow-hidden shadow-sm">
                        <img src="{{ $article->image_url }}" class="w-full h-48 object-cover" alt="{{ $article->title }}">
                        <div class="p-4">
                          <h5 class="font-bold text-lg mb-2">{{ $article->title }}</h5>
                          <p class="text-gray-600 text-sm mb-4">{{ Str::limit($article->content, 100) }}</p>
                          <a href="{{ route('blog.show', $article->id) }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Read More</a>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @else
                  <div class="text-center py-8">
                    <i class="fas fa-newspaper text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500">No articles yet.</p>
                  </div>
                @endif
              </div>
            </div>
          </div>

          <!-- Products -->
          <div class="hidden" id="products" role="tabpanel">
            <div class="bg-white rounded-lg shadow-md mb-6">
              <div class="flex justify-between items-center p-4 border-b">
                <h5 class="font-bold text-lg text-gray-800">Active Products</h5>
                <a href="{{ route('user.products', $user->id) }}" class="px-3 py-1 text-sm border border-gray-600 text-gray-600 rounded hover:bg-gray-100">View All</a>
              </div>
              <div class="p-4">
                @if($products->count() > 0)
                  <div class="grid md:grid-cols-2 gap-4">
                    @foreach($products as $product)
                      <div class="bg-white border rounded-lg overflow-hidden shadow-sm">
                        <img src="{{ $product->images->first() ? Storage::url($product->images->first()->image_path) : 'https://via.placeholder.com/400x200' }}"
                             class="w-full h-48 object-cover" alt="{{ $product->title }}">
                        <div class="p-4">
                          <h5 class="font-bold text-lg mb-2">{{ $product->title }}</h5>
                          <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                          <a href="{{ route('product.details', ['product' => $product->id]) }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">View Product</a>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @else
                  <div class="text-center py-8">
                    <i class="fas fa-box-open text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500">No active products yet.</p>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div> <!-- End Tabs Content -->

      </div>
    </div>
  </div>

  <script>
    function switchTab(tabId) {
      // Hide all tab contents
      document.querySelectorAll('#profileTabsContent > div').forEach(tab => {
        tab.classList.add('hidden');
        tab.classList.remove('block');
      });

      // Show the selected tab content
      document.getElementById(tabId).classList.remove('hidden');
      document.getElementById(tabId).classList.add('block');

      // Update tab button styles
      document.querySelectorAll('#profileTabs button').forEach(button => {
        button.classList.remove('text-gray-700', 'border-b-2', 'border-gray-700');
        button.classList.add('text-gray-500', 'hover:text-gray-600', 'hover:border-gray-300');
      });

      // Set active tab button style
      document.getElementById(tabId + '-tab').classList.remove('text-gray-500', 'hover:text-gray-600', 'hover:border-gray-300');
      document.getElementById(tabId + '-tab').classList.add('text-gray-700', 'border-b-2', 'border-gray-700');
    }
  </script>
@endsection
