@extends('layouts.admin')

@section('title', 'Product Details')
@section('page-title', 'Product Details: ' . $product->name)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
            <div class="btn-group">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Products
                </a>
            </div>
        </div>

        <!-- Product Information -->
        <div class="card shadow mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Product Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 class="img-fluid rounded shadow" 
                                 alt="{{ $product->name }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-3x mb-3"></i>
                                    <p>No image available</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-3">{{ $product->name }}</h2>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>Category:</strong>
                                    <span class="badge bg-primary ms-2">{{ ucfirst($product->category) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>Price:</strong>
                                    <span class="text-success fs-4 ms-2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>Stock:</strong>
                                    <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }} ms-2">
                                        {{ $product->stock }} units
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>Brand:</strong>
                                    <span class="ms-2">{{ $product->brand ?? 'Not specified' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>Size:</strong>
                                    <span class="ms-2">{{ $product->size ?? 'Not specified' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>Created:</strong>
                                    <span class="ms-2">{{ $product->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="mb-3">
                            <strong>Description:</strong>
                            <p class="mt-2 text-muted">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Reviews -->
        <div class="card shadow">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-star me-2"></i>Product Reviews ({{ $product->reviews->count() }})</h5>
                @if($product->reviews->count() > 0)
                    <div class="rating-summary">
                        <span class="badge bg-dark">
                            Average: {{ number_format($product->reviews->avg('rating'), 1) }}/5
                        </span>
                    </div>
                @endif
            </div>
            <div class="card-body">
                @forelse($product->reviews as $review)
                    <div class="review-item border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="review-header">
                                <h6 class="mb-1">
                                    <i class="fas fa-user-circle me-2"></i>{{ $review->user->name }}
                                </h6>
                                <div class="rating mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning"></i>
                                    @endfor
                                    <span class="ms-2 text-muted">({{ $review->rating }}/5)</span>
                                </div>
                            </div>
                            <div class="review-actions">
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                      method="POST" 
                                      class="d-inline ms-2" 
                                      onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="review-comment mb-0">{{ $review->comment }}</p>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No reviews yet for this product.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.info-item {
    margin-bottom: 1rem;
    padding: 0.5rem 0;
}

.review-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.rating-summary {
    font-size: 0.9rem;
}
</style>
@endsection
