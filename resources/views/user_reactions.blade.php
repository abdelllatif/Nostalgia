<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name }}'s Reactions</title>
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
        .reaction-card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .reaction-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .reaction-card .card-body {
            padding: 1.5rem;
        }
        .reaction-card .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .reaction-meta {
            font-size: 0.9rem;
            color: #666;
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
        .star-rating {
            color: #ffc107;
        }
        .article-link {
            color: #1a237e;
            text-decoration: none;
            font-weight: 600;
        }
        .article-link:hover {
            text-decoration: underline;
        }
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            font-size: 1.5rem;
            color: #ddd;
            padding: 0 0.1em;
        }

        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #ffc107;
        }

        .dropdown-menu {
            min-width: 200px;
            padding: 0.5rem 0;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item.text-danger:hover {
            background-color: #dc3545;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">{{ $user->first_name }}'s Reactions</h1>
                    <p class="mb-0">All comments and ratings by {{ $user->first_name }}</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($reactions->count() > 0)
            <div class="list-group">
                @foreach($reactions as $reaction)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <a href="{{ route('Article.show', $reaction->article_id) }}" class="text-decoration-none">
                                    {{ $reaction->article_title }}
                                </a>
                            </h5>
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-3">{{ $reaction->created_at->format('M d, Y') }}</small>
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#editReactionModal{{ $reaction->id }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteReactionModal{{ $reaction->id }}">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            @if($reaction->comment)
                                <p class="mb-2">{{ $reaction->comment }}</p>
                            @endif
                            @if($reaction->rating)
                                <div class="d-flex align-items-center">
                                    <span class="text-warning me-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $reaction->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="text-muted">({{ $reaction->rating }} stars)</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Edit Reaction Modal -->
                    <div class="modal fade" id="editReactionModal{{ $reaction->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Reaction</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('reactions.update', $reaction->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Comment</label>
                                            <textarea class="form-control" name="comment" rows="3">{{ $reaction->comment }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Rating</label>
                                            <div class="rating">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}{{ $reaction->id }}" {{ $reaction->rating == $i ? 'checked' : '' }}>
                                                    <label for="star{{ $i }}{{ $reaction->id }}"><i class="fas fa-star"></i></label>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Reaction Modal -->
                    <div class="modal fade" id="deleteReactionModal{{ $reaction->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Reaction</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete your reaction to "{{ $reaction->article_title }}"?</p>
                                    <p class="text-danger mb-0">This action cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('reactions.destroy', $reaction->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $reactions->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-comments"></i>
                <h3 class="mb-3">No Reactions Yet</h3>
                <p class="text-muted mb-0">{{ $user->first_name }} hasn't commented on or rated any articles yet.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle edit reaction
        function editReaction(reactionId, comment, rating) {
            const editModal = new bootstrap.Modal(document.getElementById('editReactionModal'));
            const form = document.getElementById('editReactionForm');
            form.action = `/reactions/${reactionId}`;
            form.querySelector('#editComment').value = comment;
            form.querySelector(`#editRating input[value="${rating}"]`).checked = true;
            editModal.show();
        }

        // Handle delete reaction
        function deleteReaction(reactionId) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteReactionModal'));
            const form = document.getElementById('deleteReactionForm');
            form.action = `/reactions/${reactionId}`;
            deleteModal.show();
        }

        // Handle form submission
        document.getElementById('editReactionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error updating reaction');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating reaction');
            });
        });

        document.getElementById('deleteReactionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch(this.action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error deleting reaction');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting reaction');
            });
        });
    </script>
</body>
</html>
