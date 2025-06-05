@extends('layouts.app')

@section('title', 'Checkout')

@section('styles')
<style>
/* Modern Checkout Page Styling */

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
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-800: #1f2937;
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

.animation-delay-100 { animation-delay: 100ms; }
.animation-delay-200 { animation-delay: 200ms; }
.animation-delay-300 { animation-delay: 300ms; }

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

.modern-card-header-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
}

.modern-card-header-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
}

.modern-card-header-info {
    background: linear-gradient(135deg, var(--info-color) 0%, #0284c7 100%);
}

.modern-card-body {
    padding: 1.5rem;
}

/* Payment Options */
.payment-option .form-check-input {
    display: none;
}

.payment-option .form-check-label {
    cursor: pointer;
    width: 100%;
}

.payment-option-card {
    background: white;
    border-radius: 12px;
    border: 2px solid var(--gray-200);
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.payment-option-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
}

.payment-option .form-check-input:checked + .form-check-label .payment-option-card {
    border-color: var(--primary-color);
    background-color: var(--gray-100);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
}

.payment-icon {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: var(--gray-600);
    transition: color 0.3s ease;
}

.payment-option .form-check-input:checked + .form-check-label .payment-icon {
    color: var(--primary-color);
}

/* Buttons */
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
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
    color: white;
}

.btn-modern-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

.btn-outline-modern {
    background: transparent;
    border: 2px solid var(--gray-300);
    color: var(--gray-600);
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-outline-modern:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
    transform: translateY(-1px);
}

/* Order Summary Styles */
.order-item {
    padding: 1rem 0;
    border-bottom: 1px solid var(--gray-100);
}

.order-item:last-child {
    border-bottom: none;
}

.order-item-title {
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.25rem;
}

.order-item-price {
    font-weight: 700;
    color: var(--primary-color);
}

.total-amount {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

/* Page Header */
.page-header {
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 0.5rem;
}

.breadcrumb-item a {
    color: var(--primary-color);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--gray-600);
}
</style>
@endsection

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="page-header animate-fade-in">
        <h1 class="page-title">Checkout</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="source" value="cart">
        
        <div class="row">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <!-- Shipping Information -->
                <div class="modern-card mb-4 animate-fade-in">
                    <div class="modern-card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-shipping-fast me-2"></i>
                            Shipping Information
                        </h5>
                    </div>
                    <div class="modern-card-body">
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
                <div class="modern-card animate-fade-in animation-delay-100">
                    <div class="modern-card-header modern-card-header-warning">
                        <h5 class="mb-0">
                            <i class="fas fa-credit-card me-2"></i>
                            Payment Method
                        </h5>
                    </div>
                    <div class="modern-card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="credit_card">
                                        <div class="payment-option-card">
                                            <i class="fas fa-credit-card payment-icon"></i>
                                            <h6 class="mb-1">Credit Card</h6>
                                            <small class="text-muted">Visa, Mastercard</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="bank_transfer">
                                        <div class="payment-option-card">
                                            <i class="fas fa-university payment-icon"></i>
                                            <h6 class="mb-1">Bank Transfer</h6>
                                            <small class="text-muted">BCA, Mandiri, BNI</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="e_wallet" value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="e_wallet">
                                        <div class="payment-option-card">
                                            <i class="fas fa-mobile-alt payment-icon"></i>
                                            <h6 class="mb-1">E-Wallet</h6>
                                            <small class="text-muted">GoPay, OVO, DANA</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('payment_method')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="modern-card animate-fade-in animation-delay-200">
                    <div class="modern-card-header modern-card-header-success">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>
                            Order Summary
                        </h5>
                    </div>
                    <div class="modern-card-body">
                        <!-- Cart Items -->
                        <div class="order-items">
                            @foreach($cartItems as $item)
                                <div class="order-item">
                                    <h6 class="order-item-title">{{ $item->product->name }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Qty: {{ $item->quantity }} × Rp {{ number_format($item->product->price, 0, ',', '.') }}</small>
                                        <span class="order-item-price">Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-4">

                        <!-- Pricing -->
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal ({{ $cartItems->count() }} items)</span>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span class="text-success fw-bold">Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tax</span>
                            <span class="fw-bold">Rp 0</span>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="h6 mb-0">Total</span>
                            <span class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <!-- Place Order Button -->
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn-modern btn-modern-lg">
                                <i class="fas fa-check me-2"></i>Place Order
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn-outline-modern">
                                <i class="fas fa-arrow-left me-2"></i>Back to Cart
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="modern-card mt-4 animate-fade-in animation-delay-300">
                    <div class="modern-card-body text-center">
                        <i class="fas fa-shield-alt fa-2x text-success mb-3"></i>
                        <h6 class="mb-2">Secure Checkout</h6>
                        <p class="text-muted mb-0 small">Your payment information is encrypted and secure</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
