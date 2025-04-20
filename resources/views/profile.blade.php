<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name }}'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem 0;
            color: white;
            margin-bottom: 2rem;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .nav-pills .nav-link {
            color: #495057;
            background-color: #e9ecef;
            margin-right: 0.5rem;
            border-radius: 0.5rem;
        }
        .nav-pills .nav-link.active {
            background-color: #667eea;
            color: white;
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        .stats-card {
            background-color: white;
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .section-content {
            display: none;
        }
        .section-content.active {
            display: block;
        }
        .article-card, .product-card {
            transition: transform 0.2s;
        }
        .article-card:hover, .product-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div class="position-relative d-inline-block">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('storage/anonymes_users/anonyme_user.jpg') }}"
                             alt="Profile"
                             class="profile-image rounded-circle"
                             id="profileImage">
                        <label for="profileImageInput" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 shadow-sm" style="cursor: pointer;">
                            <i class="fas fa-camera text-primary"></i>
                        </label>
                        <input type="file" id="profileImageInput" class="d-none" accept="image/*">
                    </div>
                </div>
                <div class="col-md-9">
                    <h2>{{ $user->first_name }} {{ $user->name }}</h2>
                    <p class="mb-2"><i class="fas fa-briefcase me-2"></i>{{ $user->work ?? 'No work information' }}</p>
                    <p class="mb-0"><i class="fas fa-graduation-cap me-2"></i>{{ $user->education ?? 'No education information' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="fas fa-newspaper fa-2x text-primary mb-2"></i>
                        <h3 class="mb-2">{{ $statistics['articles_count'] ?? 0 }}</h3>
                        <p class="text-muted mb-0">Articles</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="fas fa-box fa-2x text-success mb-2"></i>
                        <h3 class="mb-2">{{ $statistics['products_count'] ?? 0 }}</h3>
                        <p class="text-muted mb-0">Products</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="fas fa-gavel fa-2x text-warning mb-2"></i>
                        <h3 class="mb-2">{{ $statistics['bids_count'] ?? 0 }}</h3>
                        <p class="text-muted mb-0">Bids</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Pills -->
        <ul class="nav nav-pills mb-4" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-section="about">About</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-section="articles">Articles</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-section="products">Products</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-section="statistics">Statistics</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-section="activity">Recent Activity</button>
            </li>
        </ul>

        <!-- About Section -->
        <div class="section-content active" id="about">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">About Me</h5>
                    <form id="profileForm">
                        <div class="mb-3">
                            <label class="form-label">Work</label>
                            <input type="text" class="form-control bg-gray-100" name="work" value="{{ $user->work }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Education</label>
                            <input type="text" class="form-control bg-gray-100" name="education" value="{{ $user->education }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control bg-gray-100" name="bio" rows="4">{{ $user->bio }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Articles Section -->
        <div class="section-content" id="articles">
            <div class="row">
                @if($articles->count() > 0)
                    @foreach($articles as $article)
                        <div class="col-md-4 mb-4">
                            <div class="card article-card h-100">
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/placeholder.jpg') }}"
                                     class="card-img-top"
                                     alt="{{ $article->title }}"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                    <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">{{ $article->created_at->format('M d, Y') }}</small>
                                        <a href="{{ route('Article.show', $article->id) }}" class="btn btn-sm btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info">
                            You haven't written any articles yet.
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Products Section -->
        <div class="section-content" id="products">
            <div class="row">
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card product-card h-100">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                                     class="card-img-top"
                                     alt="{{ $product->name }}"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'warning' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                        <span class="text-primary fw-bold">${{ number_format($product->price, 2) }}</span>
                                    </div>
                                    <a href="{{ route('product.details', $product->id) }}" class="btn btn-primary w-100 mt-3">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info">
                            You haven't listed any products yet.
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="section-content" id="statistics">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Product Status</h5>
                            <canvas id="productStatusChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Monthly Activity</h5>
                            <canvas id="monthlyActivityChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Section -->
        <div class="section-content" id="activity">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Recent Activity</h5>
                    @if(count($recentActivity) > 0)
                        <div class="timeline">
                            @foreach($recentActivity as $activity)
                                <div class="d-flex mb-4">
                                    <div class="flex-shrink-0">
                                        @if($activity['type'] === 'article')
                                            <i class="fas fa-newspaper text-primary"></i>
                                        @elseif($activity['type'] === 'product')
                                            <i class="fas fa-box text-success"></i>
                                        @else
                                            <i class="fas fa-gavel text-warning"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">
                                            @if($activity['type'] === 'article')
                                                Published article "{{ $activity['item']->title }}"
                                            @elseif($activity['type'] === 'product')
                                                Listed product "{{ $activity['item']->name }}"
                                            @else
                                                Placed bid on "{{ $activity['item']->product->name }}"
                                            @endif
                                        </h6>
                                        <small class="text-muted">{{ $activity['date']->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No recent activity.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Image Modal -->
    <div class="modal fade" id="confirmImageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Profile Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img id="previewImage" src="" alt="Preview" class="img-fluid rounded">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmImage">Save Image</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Section switching
            const tabs = document.querySelectorAll('#profileTabs button');
            const sections = document.querySelectorAll('.section-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const section = this.dataset.section;

                    // Update active states
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // Show selected section
                    sections.forEach(s => s.classList.remove('active'));
                    document.getElementById(section).classList.add('active');

                    // Save last active section
                    fetch('/profile/last-active-section', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ section })
                    });
                });
            });

            // Profile form submission
            const profileForm = document.getElementById('profileForm');
            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'Saving...';

                const formData = new FormData(this);

                fetch('/profile/update', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', 'Profile updated successfully!');
                        // Update the displayed values
                        document.querySelector('input[name="work"]').value = formData.get('work');
                        document.querySelector('input[name="education"]').value = formData.get('education');
                        document.querySelector('textarea[name="bio"]').value = formData.get('bio');
                    } else {
                        showAlert('danger', 'Error updating profile. Please try again.');
                    }
                })
                .catch(error => {
                    showAlert('danger', 'Error updating profile. Please try again.');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
            });

            // Profile image handling
            const profileImageInput = document.getElementById('profileImageInput');
            const profileImage = document.getElementById('profileImage');
            const previewImage = document.getElementById('previewImage');
            const confirmImageModal = new bootstrap.Modal(document.getElementById('confirmImageModal'));

            profileImageInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        confirmImageModal.show();
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            document.getElementById('confirmImage').addEventListener('click', function() {
                const file = profileImageInput.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('profile_image', file);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('/profile/update', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        profileImage.src = URL.createObjectURL(file);
                        confirmImageModal.hide();
                        showAlert('success', 'Profile image updated successfully!');
                    } else {
                        showAlert('danger', 'Error updating profile image. Please try again.');
                    }
                })
                .catch(error => {
                    showAlert('danger', 'Error updating profile image. Please try again.');
                });
            });

            // Alert helper function
            function showAlert(type, message) {
                const alert = document.createElement('div');
                alert.className = `alert alert-${type} alert-dismissible fade show`;
                alert.role = 'alert';
                alert.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;

                document.querySelector('.container').prepend(alert);
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            }

            // Initialize with last active section if available
            const lastSection = '{{ $user->last_active_section }}';
            if (lastSection) {
                document.querySelector(`#profileTabs button[data-section="${lastSection}"]`).click();
            }

            // Initialize charts
            // Product Status Chart
            const productStatusCtx = document.getElementById('productStatusChart').getContext('2d');
            new Chart(productStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Sold', 'Pending'],
                    datasets: [{
                        data: [65, 25, 10],
                        backgroundColor: ['#28a745', '#dc3545', '#ffc107']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Monthly Activity Chart
            const monthlyActivityCtx = document.getElementById('monthlyActivityChart').getContext('2d');
            new Chart(monthlyActivityCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Products Listed',
                        data: [12, 19, 15, 25, 22, 30],
                        borderColor: '#667eea',
                        tension: 0.4
                    }, {
                        label: 'Products Sold',
                        data: [5, 8, 12, 15, 18, 20],
                        borderColor: '#28a745',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
