<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name }}'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .profile-header {
            background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
            padding: 3rem 0;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .profile-image {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        .profile-image:hover {
            transform: scale(1.05);
        }
        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }
        .profile-info-item {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.8rem 1.2rem;
            border-radius: 0.8rem;
            backdrop-filter: blur(5px);
            transition: transform 0.2s ease;
        }
        .profile-info-item:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.15);
        }
        .profile-info-item i {
            margin-right: 0.8rem;
            width: 24px;
            text-align: center;
            font-size: 1.2rem;
        }
        .profile-name {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.2rem;
        }
        .badge {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        .article-card {
            height: 100%;
        }
        .article-card img {
            height: 200px;
            object-fit: cover;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .article-card .card-body {
            padding: 1.5rem;
        }
        .article-card .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
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
        .btn-outline-primary {
            color: #1a237e;
            border-color: #1a237e;
        }
        .btn-outline-primary:hover {
            background: #1a237e;
            color: white;
        }
        @media (max-width: 768px) {
            .profile-info {
                grid-template-columns: 1fr;
            }
            .profile-name {
                font-size: 2rem;
            }
            .profile-image {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : Storage::url('anonymes_users/anonyme_user.jpg') }}"
                         alt="{{ $user->name }}"
                         class="profile-image rounded-circle">
                </div>
                <div class="col-md-9">
                    <h2 class="profile-name">{{ $user->first_name }} {{ $user->name }}</h2>
                    <div class="profile-info">
                        <div class="profile-info-item">
                            <i class="fas fa-briefcase"></i>
                            <span>{{ $user->work ?? 'No work information' }}</span>
                        </div>
                        <div class="profile-info-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>{{ $user->education ?? 'No education information' }}</span>
                        </div>
                        <div class="profile-info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Member since {{ $user->created_at->format('F Y') }}</span>
                        </div>
                    </div>
                    <div class="profile-info-item mt-3">
                        <i class="fas fa-user"></i>
                        <span>{{ $user->bio ?? 'No bio available' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Statistics</h5>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="h6 mb-0">Articles</span>
                            <span class="badge bg-primary rounded-pill">{{ $statistics['articles_count'] }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h6 mb-0">Active Products</span>
                            <span class="badge bg-primary rounded-pill">{{ $statistics['products_count'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Articles</h5>
                        <a href="{{ route('users.articles', $user->id) }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        @if($articles->count() > 0)
                            <div class="row">
                                @foreach($articles as $article)
                                    <div class="col-md-6 mb-4">
                                        <div class="card article-card">
                                            <img src="{{ $article->image_url }}"
                                                 class="card-img-top"
                                                 alt="{{ $article->title }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $article->title }}</h5>
                                                <p class="card-text text-muted">{{ Str::limit($article->content, 100) }}</p>
                                                <a href="{{ route('Article.show', $article->id) }}" class="btn btn-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">No articles yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
