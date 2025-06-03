@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-6 fw-bold">Checkout</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="source" value="cart">
        
        <div class="row">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <!-- Shipping Information -->
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>Shipping Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label fw-bold">Shipping Address</label>
                            <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                      id="shipping_address" 
                                      name="shipping_address" 
                                      rows="4" 
                                      required 
                                      placeholder="Enter your complete shipping address">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                                    <label class="form-check-label w-100" for="credit_card">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="fas fa-credit-card fa-2x text-primary mb-2"></i>
                                                <h6>Credit Card</h6>
                                                <small class="text-muted">Visa, Mastercard</small>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                                    <label class="form-check-label w-100" for="bank_transfer">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="fas fa-university fa-2x text-success mb-2"></i>
                                                <h6>Bank Transfer</h6>
                                                <small class="text-muted">BCA, Mandiri, BNI</small>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="e_wallet" value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'checked' : '' }}>
                                    <label class="form-check-label w-100" for="e_wallet">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="fas fa-mobile-alt fa-2x text-info mb-2"></i>
                                                <h6>E-Wallet</h6>
                                                <small class="text-muted">GoPay, OVO, DANA</small>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('payment_method')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <!-- Cart Items -->
                        <div class="order-items mb-3">
                            @foreach($cartItems as $item)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $item->product->name }}</h6>
                                        <small class="text-muted">Qty: {{ $item->quantity }} × Rp {{ number_format($item->product->price, 0, ',', '.') }}</small>
                                    </div>
                                    <div class="fw-bold">
                                        Rp {{ number_format($item->total, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <!-- Pricing -->
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal ({{ $cartItems->count() }} items):</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span class="text-success">Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <span>Rp 0</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 fw-bold">Total:</span>
                            <span class="h5 fw-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <!-- Place Order Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check me-2"></i>Place Order
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Cart
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="card shadow mt-4">
                    <div class="card-body text-center">
                        <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                        <h6>Secure Checkout</h6>
                        <small class="text-muted">Your payment information is encrypted and secure</small>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<style>
.payment-option .form-check-input {
    display: none;
}

.payment-option .form-check-input:checked + .form-check-label .card {
    border-color: #0d6efd;
    background-color: #f8f9ff;
}

.payment-option .card {
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-option .card:hover {
    border-color: #0d6efd;
    transform: translateY(-2px);
}
</style>
@endsection
