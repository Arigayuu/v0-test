@extends('layouts.admin')

@section('title', 'Review Management')
@section('page-title', 'Review Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0">Manage Reviews</h4>
                <p class="text-muted">Monitor and moderate product reviews</p>
            </div>
        </div>

        <!-- Review Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-star fa-2x mb-2"></i>
                        <h4>{{ $reviews->total() }}</h4>
                        <p class="mb-0">Total Reviews</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-thumbs-up fa-2x mb-2"></i>
                        <h4>{{ $reviews->where('rating', '>=', 4)->count() }}</h4>
                        <p class="mb-0">Positive Reviews</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-meh fa-2x mb-2"></i>
                        <h4>{{ $reviews->where('rating', 3)->count() }}</h4>
                        <p class="mb-0">Neutral Reviews</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-thumbs-down fa-2x mb-2"></i>
                        <h4>{{ $reviews->where('rating', '<=', 2)->count() }}</h4>
                        <p class="mb-0">Negative Reviews</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-comments me-2"></i>All Reviews</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>User</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td><strong>#{{ $review->id }}</strong></td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $review->product) }}" 
                                           class="text-decoration-none">
                                            <div class="d-flex align-items-center">
                                                @if($review->product->image)
                                                    <img src="{{ asset('storage/' . $review->product->image) }}" 
                                                         alt="{{ $review->product->name }}" 
                                                         width="40" 
                                                         height="40" 
                                                         class="rounded me-2">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-2" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $review->product->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ ucfirst($review->product->category) }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $review->user) }}" 
                                           class="text-decoration-none">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                                {{ $review->user->name }}
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rating me-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning"></i>
                                                @endfor
                                            </div>
                                            <span class="badge bg-{{ $review->rating >= 4 ? 'success' : ($review->rating == 3 ? 'warning' : 'danger') }}">
                                                {{ $review->rating }}/5
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="comment-preview">
                                            {{ Str::limit($review->comment, 100) }}
                                            @if(strlen($review->comment) > 100)
                                                <button class="btn btn-sm btn-link p-0" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#commentModal{{ $review->id }}">
                                                    Read more
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ $review->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#commentModal{{ $review->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" 
                                                    onclick="confirmDelete({{ $review->id }}, '{{ $review->user->name }}', '{{ $review->product->name }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Comment Modal -->
                                <div class="modal fade" id="commentModal{{ $review->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Review Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <strong>Product:</strong> {{ $review->product->name }}
                                                </div>
                                                <div class="mb-3">
                                                    <strong>User:</strong> {{ $review->user->name }}
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Rating:</strong>
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning"></i>
                                                    @endfor
                                                    ({{ $review->rating }}/5)
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Comment:</strong>
                                                    <p class="mt-2">{{ $review->comment }}</p>
                                                </div>
                                                <div>
                                                    <strong>Date:</strong> {{ $review->created_at->format('F d, Y \a\t H:i') }}
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-danger" 
                                                        onclick="confirmDelete({{ $review->id }}, '{{ $review->user->name }}', '{{ $review->product->name }}')"
                                                        data-bs-dismiss="modal">
                                                    Delete Review
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No reviews found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this review?</p>
                <div class="alert alert-info">
                    <strong>User:</strong> <span id="reviewUser"></span><br>
                    <strong>Product:</strong> <span id="reviewProduct"></span>
                </div>
                <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Review</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmDelete(reviewId, userName, productName) {
    document.getElementById('reviewUser').textContent = userName;
    document.getElementById('reviewProduct').textContent = productName;
    document.getElementById('deleteForm').action = `/admin/reviews/${reviewId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 0.75rem;
}

.comment-preview {
    max-width: 300px;
}

.rating {
    font-size: 0.875rem;
}
</style>
@endsection
