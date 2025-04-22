<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name }}'s Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .page-header {
            background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
            padding: 2rem 0;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .product-card .card-body {
            padding: 1.5rem;
        }
        .product-card .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .product-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a237e;
        }
        .product-meta {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }
        .product-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .status-active {
            background: rgba(40, 167, 69, 0.9);
            color: white;
        }
        .status-sold {
            background: rgba(220, 53, 69, 0.9);
            color: white;
        }
        .btn-primary {
            background: #1a237e;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
        }
        .btn-primary:hover {
            background: #0d47a1;
        }
        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .empty-state i {
            font-size: 3rem;
            color: #1a237e;
            margin-bottom: 1rem;
        }
        .pagination {
            margin-top: 2rem;
        }
        .page-link {
            color: #1a237e;
            border: none;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 0.5rem;
        }
        .page-link:hover {
            background: #1a237e;
            color: white;
        }
        .page-item.active .page-link {
            background: #1a237e;
            border: none;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">{{ $user->first_name }}'s Products</h1>
                    <p class="mb-0">Browse all products listed by {{ $user->first_name }}</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('users.profile', $user->id) }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if($products->count() > 0)
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-card">
                            <div class="position-relative">
                                <img src="{{ $product->image ? Storage::url($product->image) : asset('images/placeholder.jpg') }}"
                                     class="card-img-top"
                                     alt="{{ $product->name }}">
                                <span class="product-status {{ $product->status === 'active' ? 'status-active' : 'status-sold' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <div class="product-meta">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    Listed {{ $product->created_at->format('M d, Y') }}
                                </div>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="product-price">${{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('product.details', $product->id) }}" class="btn btn-primary">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-box"></i>
                <h3 class="mb-3">No Products Yet</h3>
                <p class="text-muted mb-0">{{ $user->first_name }} hasn't listed any products yet.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

