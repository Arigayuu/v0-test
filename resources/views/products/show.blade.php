@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-primary">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none text-primary">Products</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('products.index', ['category' => $product->category]) }}" class="text-decoration-none text-primary">
                    {{ ucfirst($product->category) }}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row gx-5">
        <div class="col-lg-6 mb-4">
            <div id="productImageCarousel" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if($product->image)
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="d-block w-100 rounded"
                                 alt="{{ $product->name }}"
                                 style="height: 500px; object-fit: cover;">
                        </div>
                        {{--
                        <div class="carousel-item">
                            <img src="{{ asset('storage/another_image.jpg') }}"
                                 class="d-block w-100 rounded"
                                 alt="{{ $product->name }}"
                                 style="height: 500px; object-fit: cover;">
                        </div>
                        --}}
                    @else
                        <div class="carousel-item active">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 500px;">
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-5x mb-3"></i>
                                    <p class="fs-5">No image available</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if($product->image) {{-- Only show controls if there's at least one image --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <div class="product-details">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="display-5 fw-bold text-dark">{{ $product->name }}</h1>
                        <span class="badge bg-primary fs-6 py-2 px-3">{{ ucfirst($product->category) }}</span>
                    </div>

                    <div class="price-section mb-3">
                        <h2 class="text-success fw-bold mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                    </div>

                    <div class="product-meta bg-light p-3 rounded shadow-sm mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="meta-item d-flex align-items-center">
                                    <i class="fas fa-box text-muted me-2 fs-5"></i>
                                    <strong class="me-2">Stock:</strong>
                                    <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }} fs-6">
                                        {{ $product->stock }} units
                                    </span>
                                </div>
                            </div>
                            @if($product->brand)
                                <div class="col-md-6 mb-2">
                                    <div class="meta-item d-flex align-items-center">
                                        <i class="fas fa-tag text-muted me-2 fs-5"></i>
                                        <strong class="me-2">Brand:</strong> {{ $product->brand }}
                                    </div>
                                </div>
                            @endif
                            @if($product->size)
                                <div class="col-md-6 mb-2">
                                    <div class="meta-item d-flex align-items-center">
                                        <i class="fas fa-ruler text-muted me-2 fs-5"></i>
                                        <strong class="me-2">Size:</strong> {{ $product->size }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="product-description mb-4">
                        <h5 class="fw-bold mb-3 text-dark">Description</h5>
                        <p class="text-secondary lh-lg">{{ $product->description }}</p>
                    </div>
                </div>

                @auth
                    @if($product->stock > 0)
                        <div class="order-section sticky-top" style="top: 100px;">
                            <div class="card shadow-lg border-0">
                                <div class="card-header bg-primary text-white d-flex align-items-center">
                                    <i class="fas fa-shopping-cart me-2 fs-5"></i>
                                    <h5 class="mb-0">Place Your Order</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                                        @csrf
                                        <label for="cart-quantity" class="form-label fw-bold">Quantity for Cart</label>
                                        <div class="input-group mb-3">
                                            <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity('cart-quantity')">-</button>
                                            <input type="number"
                                                   class="form-control text-center"
                                                   id="cart-quantity"
                                                   name="quantity"
                                                   value="1"
                                                   min="1"
                                                   max="{{ $product->stock }}"
                                                   required>
                                            <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity('cart-quantity')">+</button>
                                            <button type="submit" class="btn btn-outline-primary ms-2">
                                                <i class="fas fa-cart-plus me-1"></i>Add to Cart
                                            </button>
                                        </div>
                                    </form>

                                    <div class="text-center mb-4">
                                        <span class="text-muted fw-bold">OR</span>
                                    </div>

                                    <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                                        @csrf
                                        <input type="hidden" name="source" value="direct">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <div class="mb-3">
                                            <label for="quantity" class="form-label fw-bold">Quantity for Direct Order</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity('quantity')">-</button>
                                                <input type="number"
                                                       class="form-control text-center @error('quantity') is-invalid @enderror"
                                                       id="quantity"
                                                       name="quantity"
                                                       value="{{ old('quantity', 1) }}"
                                                       min="1"
                                                       max="{{ $product->stock }}"
                                                       required>
                                                <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity('quantity')">+</button>
                                            </div>
                                            @error('quantity')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-success">Available: {{ $product->stock }} units</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="shipping_address" class="form-label fw-bold">Shipping Address</label>
                                            <textarea class="form-control @error('shipping_address') is-invalid @enderror"
                                                      id="shipping_address"
                                                      name="shipping_address"
                                                      rows="3"
                                                      placeholder="Enter your complete shipping address..."
                                                      required>{{ old('shipping_address', Auth::user()->address ?? '') }}</textarea>
                                            @error('shipping_address')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
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
                                                    Bank Transfer
                                                </option>
                                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>
                                                    E-Wallet (OVO, GoPay, DANA)
                                                </option>
                                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>
                                                    Credit Card
                                                </option>
                                            </select>
                                            @error('payment_method')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="order-summary bg-info bg-opacity-10 p-3 rounded mb-4 border border-info">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="text-dark">Subtotal:</span>
                                                <span id="subtotal" class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="text-dark">Shipping:</span>
                                                <span class="text-success fw-bold">Free</span>
                                            </div>
                                            <hr class="my-2">
                                            <div class="d-flex justify-content-between fw-bold fs-5">
                                                <span class="text-dark">Total:</span>
                                                <span id="total" class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-danger btn-lg w-100" id="orderButton">
                                            <i class="fas fa-money-check-alt me-2"></i>Proceed to Order
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger py-4 text-center rounded-pill shadow-sm">
                            <i class="fas fa-exclamation-circle me-2 fa-2x"></i>
                            <strong class="fs-5">Out of Stock</strong>
                            <p class="mb-0">This product is currently unavailable.</p>
                        </div>
                    @endif
                @else
                    <div class="alert alert-info py-4 text-center rounded-pill shadow-sm">
                        <i class="fas fa-sign-in-alt me-2 fa-2x"></i>
                        <strong class="fs-5">Login to Order</strong>
                        <p class="mb-0">Please <a href="{{ route('login') }}" class="alert-link text-decoration-none fw-bold">login</a> to place an order or add to cart.</p>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    ---

    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-star me-2"></i>Customer Reviews</h4>
                    @if($product->reviews->count() > 0)
                        <div class="rating-summary d-flex align-items-center">
                            <span class="badge bg-dark fs-6 py-2 px-3 me-2">
                                {{ number_format($product->reviews->avg('rating'), 1) }}/5
                            </span>
                            <span class="text-dark">({{ $product->reviews->count() }} reviews)</span>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @auth
                        <div class="add-review-section mb-5 p-4 border rounded bg-light">
                            <h5 class="fw-bold mb-3 text-dark">Write a Review</h5>
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
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
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
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Review
                                </button>
                            </form>
                        </div>
                        <hr class="my-5">
                    @endauth

                    <div class="reviews-list">
                        @forelse($product->reviews as $review)
                            <div class="review-item border-bottom pb-4 mb-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="reviewer-info d-flex align-items-center">
                                        <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0">
                                            @if($review->user->profile_image)
                                                <img src="{{ asset('storage/' . $review->user->profile_image) }}"
                                                     class="rounded-circle"
                                                     style="width: 40px; height: 40px; object-fit: cover;"
                                                     alt="{{ $review->user->name }}">
                                            @else
                                                <i class="fas fa-user"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark">{{ $review->user->name }}</h6>
                                            <small class="text-muted">{{ $review->created_at->format('F d, Y') }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <div class="rating mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning"></i>
                                            @endfor
                                            <span class="ms-2 text-muted">({{ $review->rating }}/5)</span>
                                        </div>
                                        @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->id() === $review->user_id))
                                            <div class="review-actions">
                                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this review?')">
                                                        <i class="fas fa-trash me-1"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <p class="review-comment mb-0 text-secondary">{{ $review->comment }}</p>
                            </div>
                        @empty
                            <div class="text-center py-5 bg-light rounded shadow-sm">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const productPrice = {{ $product->price }};
const maxStock = {{ $product->stock }};

function updateTotal() {
    const quantity = parseInt(document.getElementById('quantity').value) || 1;
    const subtotal = productPrice * quantity;

    document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('total').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
}

function increaseQuantity(inputId) {
    const quantityInput = document.getElementById(inputId);
    let currentValue = parseInt(quantityInput.value) || 0; // Initialize to 0 if null/empty
    if (currentValue < maxStock) {
        quantityInput.value = currentValue + 1;
        if (inputId === 'quantity') {
            updateTotal();
        }
    }
}

function decreaseQuantity(inputId) {
    const quantityInput = document.getElementById(inputId);
    let currentValue = parseInt(quantityInput.value) || 0; // Initialize to 0 if null/empty
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        if (inputId === 'quantity') {
            updateTotal();
        }
    }
}

// Form validation for direct order
document.getElementById('orderForm').addEventListener('submit', function(e) {
    const quantityInput = document.getElementById('quantity');
    const shippingAddress = document.getElementById('shipping_address').value.trim();
    const paymentMethod = document.getElementById('payment_method').value;

    if (parseInt(quantityInput.value) <= 0) {
        e.preventDefault();
        alert('Please enter a valid quantity.');
        quantityInput.focus();
        return false;
    }

    if (!shippingAddress) {
        e.preventDefault();
        alert('Please enter your shipping address.');
        document.getElementById('shipping_address').focus();
        return false;
    }

    if (!paymentMethod) {
        e.preventDefault();
        alert('Please select a payment method.');
        document.getElementById('payment_method').focus();
        return false;
    }

    // Disable button to prevent double submission
    const orderButton = document.getElementById('orderButton');
    orderButton.disabled = true;
    orderButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
});

// Update total on quantity change for direct order form
document.getElementById('quantity').addEventListener('input', updateTotal);

// Initialize total on page load
updateTotal();
</script>

<style>
/* General Enhancements */
body {
    background-color: #f8f9fa; /* Light gray background */
}

.container {
    max-width: 1200px; /* Max width for a better layout */
}

/* Breadcrumb */
.breadcrumb-item a {
    font-weight: 500;
}

/* Product Image */
.carousel-item img {
    border-radius: 0.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Product Details */
.product-details {
    padding-left: 20px; /* Add some padding to the left of details */
}

h1.display-5 {
    color: #212529; /* Darker heading for contrast */
    font-size: 2.5rem;
}

.price-section h2 {
    font-size: 2.2rem;
    color: #198754; /* Green for price */
}

.product-meta .meta-item {
    padding: 0.5rem 0;
    border-bottom: 1px dashed #e9ecef; /* Subtle separator */
}

.product-meta .meta-item:last-child {
    border-bottom: none;
}

.product-description p {
    line-height: 1.8; /* Improved readability */
    color: #495057;
}

/* Order Section */
.order-section .card-header {
    background-color: #0d6efd !important; /* Bootstrap primary color */
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.order-section .card-body {
    padding: 1.5rem;
}

.input-group .form-control {
    border-color: #ced4da;
}

.order-summary {
    background-color: #e0f2f7 !important; /* Lighter blue for summary */
    border-color: #0dcaf0 !important;
}

.order-summary span {
    font-size: 1.1rem;
}

.order-summary .fw-bold {
    font-size: 1.3rem;
}

.btn-danger {
    background-color: #dc3545; /* Red for order button */
    border-color: #dc3545;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
}

/* Reviews Section */
.reviews-list .review-item {
    padding-top: 1rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #dee2e6;
}

.reviews-list .review-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.avatar-sm {
    width: 48px; /* Slightly larger avatar */
    height: 48px;
    font-size: 1.2rem; /* Icon size */
    background-color: #0d6efd; /* Consistent primary color */
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0; /* Prevent shrinking when text is long */
}

.rating .fa-star {
    font-size: 1.1rem;
}

.review-comment {
    font-size: 0.95rem;
    color: #6c757d;
}

/* Sticky elements adjustments for better mobile viewing */
@media (max-width: 991.98px) {
    .product-image-container, .order-section {
        position: static;
        top: auto;
    }
}
</style>
@endsection