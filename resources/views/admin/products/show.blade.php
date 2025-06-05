@extends('layouts.admin')

@section('title', 'Product Details')
@section('page-title', 'Product Details')

@section('styles')
{{-- Re-use the styles from the product management page for consistency --}}
<style>
/* Modern Product Management Page Styling - Re-used for consistency */

/* Color Variables */
:root {
    --primary-color: #4f46e5;
    --secondary-color: #818cf8;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
    --light-color: #f8fafc;
    --dark-color: #1e293b;
    --gray-100: #f3f4f6;
    --gray-300: #d1d5db;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-800: #1f2937;
    --blue-600: #2563eb;
    --orange-600: #ea580c;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeInUp 0.6s ease-out forwards;
}

.animation-delay-100 {
    animation-delay: 100ms;
}

.animation-delay-200 {
    animation-delay: 200ms;
}

.animation-delay-300 {
    animation-delay: 300ms;
}

.animation-delay-400 {
    animation-delay: 400ms;
}

/* Page Header */
.page-header {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 1.5rem;
    border: none;
}

.page-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-color);
}

.page-subtitle {
    margin: 0;
    color: var(--gray-500);
    font-size: 0.875rem;
}

/* Modern Button */
.btn-modern {
    background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-modern:hover {
    background: linear-gradient(135deg, #6366f1 0%, var(--primary-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
}

.btn-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
}

.btn-success:hover {
    background: linear-gradient(135deg, #059669 0%, var(--success-color) 100%);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

.btn-info-modern {
    background: linear-gradient(135deg, var(--info-color) 0%, #0284c7 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-info-modern:hover {
    background: linear-gradient(135deg, #0284c7 0%, var(--info-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
}

.btn-secondary-modern {
    background: var(--gray-500);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-secondary-modern:hover {
    background: var(--gray-600);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(107, 114, 128, 0.3);
}

.btn-warning-modern {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-warning-modern:hover {
    background: linear-gradient(135deg, #d97706 0%, var(--warning-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
}

.btn-danger-modern {
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-danger-modern:hover {
    background: linear-gradient(135deg, #dc2626 0%, var(--danger-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
}

/* Modern Card */
.modern-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: none;
    overflow: hidden;
    transition: all 0.3s ease;
}

.modern-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.modern-card-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
    padding: 1.5rem;
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
}

.modern-card-header-info {
    background: linear-gradient(135deg, var(--info-color) 0%, #0284c7 100%);
    padding: 1.5rem;
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
}

.modern-card-header-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    padding: 1.5rem;
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
}

.modern-card-title {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modern-card-body {
    padding: 1.5rem;
}

/* Breadcrumb Styling */
.breadcrumb {
    background: none;
    padding: 0;
    margin-bottom: 0;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.breadcrumb-item {
    font-size: 0.875rem;
    color: var(--gray-500);
}

.breadcrumb-item a {
    color: var(--primary-color);
    text-decoration: none;
    transition: color 0.2s ease;
}

.breadcrumb-item a:hover {
    color: var(--primary-color);
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: var(--gray-800);
    font-weight: 600;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    color: var(--gray-300);
}

/* Specific styles for Product Details */
.product-image-container {
    padding: 1rem; /* Padding around the image */
    background: var(--gray-100);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%; /* Ensure it takes full height of column */
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.06); /* subtle inner shadow */
}

.product-image-container img {
    max-width: 100%;
    max-height: 400px; /* Limit image height */
    object-fit: contain; /* Ensure image fits within container */
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.product-image-placeholder {
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--gray-500);
    text-align: center;
    font-size: 1rem;
}

.product-image-placeholder i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--gray-400);
}

.product-detail-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 1.5rem;
}

.info-item {
    margin-bottom: 1rem;
    padding-bottom: 0.5rem; /* Add padding for visual separation */
    border-bottom: 1px dashed var(--gray-100); /* subtle separator */
    display: flex;
    align-items: baseline;
    gap: 0.5rem;
}

.info-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.info-item strong {
    color: var(--gray-800);
    font-weight: 600;
    min-width: 80px; /* Align labels */
}

.info-item span {
    color: var(--gray-600);
    font-size: 0.95rem;
}

.info-item .badge {
    font-size: 0.85rem;
    padding: 0.4em 0.7em;
    border-radius: 5px;
}

.product-price {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--success-color);
    margin-bottom: 1.5rem;
    display: block; /* Ensure it takes full width */
}

.product-description p {
    color: var(--gray-700);
    line-height: 1.6;
    margin-top: 0.75rem;
}

.review-item {
    padding-bottom: 1.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid var(--gray-100); /* Lighter separator */
}

.review-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.review-header {
    display: flex;
    flex-direction: column;
}

.review-header h6 {
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 0.25rem;
    font-size: 1rem;
}

.review-header h6 i {
    color: var(--primary-color);
}

.rating .fa-star, .rating .fa-star-o {
    color: var(--warning-color); /* Consistent star color */
    font-size: 0.9rem;
}

.rating span {
    font-size: 0.85rem;
    color: var(--gray-500);
}

.review-comment {
    color: var(--gray-700);
    line-height: 1.5;
    font-size: 0.95rem;
    padding-left: 1.5rem; /* Indent comment slightly */
    border-left: 3px solid var(--primary-color);
    padding-left: 10px;
    margin-left: 5px;
}

.review-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.review-actions small {
    white-space: nowrap; /* Prevent wrapping for date */
}

.rating-summary .badge {
    background-color: var(--dark-color);
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 0.5em 0.8em;
    border-radius: 6px;
}

/* Responsive Design */
@media (max-width: 767.98px) {
    .page-header {
        padding: 1rem;
    }

    .page-header .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }

    .btn-group {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-group .btn-warning-modern,
    .btn-group .btn-secondary-modern {
        width: 100%;
        justify-content: center;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
    }

    .modern-card-header,
    .modern-card-body {
        padding: 1rem;
    }

    .product-image-container {
        height: 250px;
        margin-bottom: 1.5rem;
    }

    .product-detail-title {
        font-size: 1.8rem;
    }

    .product-price {
        font-size: 2rem;
    }

    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }

    .info-item strong {
        min-width: unset;
        margin-bottom: 0.25rem;
    }

    .review-item .d-flex {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .review-actions {
        width: 100%;
        justify-content: flex-end;
    }

    .review-comment {
        padding-left: 0;
        border-left: none;
        margin-left: 0;
        margin-top: 0.5rem;
    }
}

@media (max-width: 575.98px) {
    .breadcrumb-item {
        font-size: 0.75rem;
    }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header animate-fade-in">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="page-title">{{ $product->name }}</h4>
                <p class="page-subtitle">Detailed view of product information and reviews.</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($product->name, 20) }}</li>
                    </ol>
                </nav>
            </div>
            <div class="btn-group">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn-warning-modern">
                    <i class="fas fa-edit"></i>
                    <span>Edit Product</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary-modern">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Products</span>
                </a>
            </div>
        </div>
    </div>

    <div class="modern-card mb-4 animate-fade-in animation-delay-100">
        <div class="modern-card-header-info">
            <h5 class="modern-card-title">
                <i class="fas fa-info-circle me-2"></i>Product Information
            </h5>
        </div>
        <div class="modern-card-body">
            <div class="row">
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="product-image-container w-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="img-fluid rounded"
                                 alt="{{ $product->name }}">
                        @else
                            <div class="product-image-placeholder">
                                <i class="fas fa-box-open"></i>
                                <p>No image available</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <h2 class="product-detail-title">{{ $product->name }}</h2>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong>Category:</strong>
                                <span class="badge bg-primary-modern ms-2">{{ ucfirst($product->category) }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong>Price:</strong>
                                <span class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong>Stock:</strong>
                                <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning-modern' : 'danger-modern') }} ms-2">
                                    {{ $product->stock }} units
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong>Brand:</strong>
                                <span>{{ $product->brand ?? 'Not specified' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong>Size:</strong>
                                <span>{{ $product->size ?? 'Not specified' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong>Created:</strong>
                                <span>{{ $product->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="product-description">
                        <strong>Description:</strong>
                        <p class="mt-2">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modern-card animate-fade-in animation-delay-200">
        <div class="modern-card-header-warning">
            <h5 class="modern-card-title">
                <i class="fas fa-star me-2"></i>Product Reviews ({{ $product->reviews->count() }})
                @if($product->reviews->count() > 0)
                    <div class="rating-summary">
                        <span class="badge">
                            Average: {{ number_format($product->reviews->avg('rating'), 1) }}/5
                        </span>
                    </div>
                @endif
            </h5>
        </div>
        <div class="modern-card-body">
            @forelse($product->reviews as $review)
                <div class="review-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="review-header">
                            <h6 class="mb-1">
                                <i class="fas fa-user-circle me-2"></i>{{ $review->user->name }}
                            </h6>
                            <div class="rating mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                @endfor
                                <span class="ms-2">({{ $review->rating }}/5)</span>
                            </div>
                        </div>
                        <div class="review-actions">
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            <form action="{{ route('admin.reviews.destroy', $review) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this review?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger-modern">
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
@endsection