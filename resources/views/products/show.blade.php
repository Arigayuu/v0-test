@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category]) }}">{{ ucfirst($product->category) }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4">
            <div class="product-image-container">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         class="img-fluid rounded shadow" 
                         alt="{{ $product->name }}"
                         style="width: 100%; height: 500px; object-fit: cover;">
                @else
                    <div class="bg-light rounded shadow d-flex align-items-center justify-content-center" style="height: 500px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-image fa-5x mb-3"></i>
                            <p class="fs-5">No image available</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="product-details">
                <!-- Product Header -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="display-6 fw-bold">{{ $product->name }}</h1>
                        <span class="badge bg-primary fs-6">{{ ucfirst($product->category) }}</span>
                    </div>
                    
                    <div class="price-section mb-3">
                        <h2 class="text-primary fw-bold mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                    </div>

                    <!-- Product Meta -->
                    <div class="product-meta mb-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="meta-item">
                                    <i class="fas fa-box text-muted me-2"></i>
                                    <strong>Stock:</strong> 
                                    <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">
                                        {{ $product->stock }} units
                                    </span>
                                </div>
                            </div>
                            @if($product->brand)
                                <div class="col-6">
                                    <div class="meta-item">
                                        <i class="fas fa-tag text-muted me-2"></i>
                                        <strong>Brand:</strong> {{ $product->brand }}
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if($product->size)
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="meta-item">
                                        <i class="fas fa-ruler text-muted me-2"></i>
                                        <strong>Size:</strong> {{ $product->size }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Product Description -->
                    <div class="product-description mb-4">
                        <h5 class="fw-bold mb-3">Description</h5>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>
                </div>

                <!-- Order Form -->
                @auth
                    @if($product->stock > 0)
                        <div class="order-section">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Place Your Order</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('orders.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label fw-bold">Quantity</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">-</button>
                                                <input type="number" 
                                                       class="form-control text-center @error('quantity') is-invalid @enderror" 
                                                       id="quantity" 
                                                       name="quantity" 
                                                       value="{{ old('quantity', 1) }}" 
                                                       min="1" 
                                                       max="{{ $product->stock }}" 
                                                       required>
                                                <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                                            </div>
                                            @error('quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Available: {{ $product->stock }} units</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="shipping_address" class="form-label fw-bold">Shipping Address</label>
                                            <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                                      id="shipping_address" 
                                                      name="shipping_address" 
                                                      rows="3" 
                                                      required>{{ old('shipping_address', Auth::user()->address) }}</textarea>
                                            @error('shipping_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="payment_method" class="form-label fw-bold">Payment Method</label>
                                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                                    id="payment_method" 
                                                    name="payment_method" 
                                                    required>
                                                <option value="">Select Payment Method</option>
                                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>
                                                    <i class="fas fa-university me-2"></i>Bank Transfer
                                                </option>
                                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>
                                                    <i class="fas fa-mobile-alt me-2"></i>E-Wallet
                                                </option>
                                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>
                                                    <i class="fas fa-credit-card me-2"></i>Credit Card
                                                </option>
                                            </select>
                                            @error('payment_method')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Order Summary -->
                                        <div class="order-summary bg-light p-3 rounded mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Subtotal:</span>
                                                <span id="subtotal">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Shipping:</span>
                                                <span class="text-success">Free</span>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between fw-bold">
                                                <span>Total:</span>
                                                <span id="total" class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                                            <i class="fas fa-shopping-cart me-2"></i>Order Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Out of Stock</strong> - This product is currently unavailable.
                        </div>
                    @endif
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Please <a href="{{ route('login') }}" class="alert-link">login</a> to place an order.
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-star me-2"></i>Customer Reviews</h4>
                        @if($product->reviews->count() > 0)
                            <div class="rating-summary">
                                <span class="badge bg-dark fs-6">
                                    {{ number_format($product->reviews->avg('rating'), 1) }}/5 
                                    ({{ $product->reviews->count() }} reviews)
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <!-- Add Review Form -->
                    @auth
                        <div class="add-review-section mb-5">
                            <h5 class="fw-bold mb-3">Write a Review</h5>
                            <form action="{{ route('reviews.store', $product) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="rating" class="form-label fw-bold">Rating</label>
                                        <select class="form-select @error('rating') is-invalid @enderror" 
                                                id="rating" 
                                                name="rating" 
                                                required>
                                            <option value="">Select Rating</option>
                                            @for($i = 5; $i >= 1; $i--)
                                                <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }} - {{ ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'][$i] }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="comment" class="form-label fw-bold">Your Review</label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" 
                                              id="comment" 
                                              name="comment" 
                                              rows="4" 
                                              placeholder="Share your experience with this product..."
                                              required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-star me-2"></i>Submit Review
                                </button>
                            </form>
                        </div>
                        <hr>
                    @endif

                    <!-- Reviews List -->
                    <div class="reviews-list">
                        @forelse($product->reviews as $review)
                            <div class="review-item border-bottom pb-4 mb-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="reviewer-info">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $review->user->name }}</h6>
                                                <small class="text-muted">{{ $review->created_at->format('F d, Y') }}</small>
                                            </div>
                                        </div>
                                        <div class="rating mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning"></i>
                                            @endfor
                                            <span class="ms-2 text-muted">({{ $review->rating }}/5)</span>
                                        </div>
                                    </div>
                                    @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->id() === $review->user_id))
                                        <div class="review-actions">
                                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this review?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <p class="review-comment mb-0">{{ $review->comment }}</p>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">No reviews yet</h5>
                                <p class="text-muted">Be the first to review this product!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const productPrice = {{ $product->price }};
const maxStock = {{ $product->stock }};

function updateTotal() {
    const quantity = parseInt(document.getElementById('quantity').value) || 1;
    const subtotal = productPrice * quantity;
    
    document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('total').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
}

function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value) || 1;
    if (currentValue < maxStock) {
        quantityInput.value = currentValue + 1;
        updateTotal();
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value) || 1;
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        updateTotal();
    }
}

document.getElementById('quantity').addEventListener('input', updateTotal);

// Initialize total on page load
updateTotal();
</script>

<style>
.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 0.875rem;
}

.meta-item {
    margin-bottom: 0.5rem;
}

.review-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.product-image-container {
    position: sticky;
    top: 100px;
}

.order-section {
    position: sticky;
    top: 100px;
}
</style>
@endsection
