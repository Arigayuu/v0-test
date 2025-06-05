@extends('layouts.admin')

@section('title', 'Order Details')
@section('page-title', 'Order Details')

@section('styles')
<style>
/* Modern Order Management Page Styling */

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

.animation-delay-100 { animation-delay: 100ms; }
.animation-delay-200 { animation-delay: 200ms; }
.animation-delay-300 { animation-delay: 300ms; }
.animation-delay-400 { animation-delay: 400ms; }

/* Modern Card Styles */
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
}

.modern-card-header-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
}

.modern-card-header-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
}

.modern-card-title {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 700;
}

.modern-card-body {
    padding: 1.5rem;
}

/* Button Styles */
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

.btn-success-modern {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
}

.btn-success-modern:hover {
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

/* Order Details Specific Styles */
.order-info-item {
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px dashed var(--gray-100);
    display: flex;
    align-items: baseline;
    gap: 0.5rem;
}

.order-info-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.order-info-item strong {
    color: var(--gray-800);
    font-weight: 600;
    min-width: 120px;
}

.order-info-item span {
    color: var(--gray-600);
    font-size: 0.95rem;
}

.order-total {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--success-color);
    margin-bottom: 1.5rem;
    display: block;
}

.order-items-table {
    width: 100%;
    margin-bottom: 1.5rem;
}

.order-items-table th {
    background-color: var(--gray-100);
    color: var(--gray-800);
    font-weight: 600;
    padding: 1rem;
    text-align: left;
}

.order-items-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--gray-100);
}

.order-items-table tr:last-child td {
    border-bottom: none;
}

.product-image-small {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
}

/* Filter Bar Style */
.filter-bar {
    background: white;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.filter-bar .btn-filter {
    background-color: var(--gray-100);
    color: var(--gray-600);
    border: 1px solid var(--gray-300);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
}

.filter-bar .btn-filter:hover {
    background-color: var(--gray-200);
    color: var(--gray-800);
    border-color: var(--gray-400);
}
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
            <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
        </ol>
    </nav>

    <!-- Filter Bar with Back Button -->
    <div class="filter-bar">
        <div></div>
        <a href="{{ route('admin.orders.index') }}" class="btn-filter">
            <i class="fas fa-arrow-left me-2"></i>Back to Orders
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate-fade-in" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show animate-fade-in" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Order Summary Card -->
        <div class="col-lg-8 mb-4">
            <div class="modern-card animate-fade-in">
                <div class="modern-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="modern-card-title">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Order Summary
                        </h5>
                        <span class="badge bg-{{ 
                            $order->status === 'completed' ? 'success' : 
                            ($order->status === 'processing' ? 'warning' : 
                            ($order->status === 'cancelled' ? 'danger' : 'secondary')) 
                        }} fs-6">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                <div class="modern-card-body">
                    <div class="order-info-item">
                        <strong>Order Date:</strong>
                        <span>{{ $order->created_at->format('F d, Y \a\t H:i') }}</span>
                    </div>
                    <div class="order-info-item">
                        <strong>Payment Method:</strong>
                        <span>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                    </div>
                    <div class="order-info-item">
                        <strong>Payment Status:</strong>
                        <span class="badge bg-{{ 
                            $order->payment_status === 'paid' ? 'success' : 
                            ($order->payment_status === 'failed' ? 'danger' : 
                            ($order->payment_status === 'refunded' ? 'info' : 'warning')) 
                        }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    <div class="order-info-item">
                        <strong>Total Amount:</strong>
                        <span class="order-total">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Order Items Card -->
            <div class="modern-card mt-4 animate-fade-in animation-delay-100">
                <div class="modern-card-header modern-card-header-info">
                    <h5 class="modern-card-title">
                        <i class="fas fa-box me-2"></i>
                        Order Items
                    </h5>
                </div>
                <div class="modern-card-body">
                    <div class="table-responsive">
                        <table class="order-items-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product && $item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="product-image-small me-3">
                                                @else
                                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $item->product->name ?? 'Product Deleted' }}</h6>
                                                    @if($item->product)
                                                        <small class="text-muted">{{ $item->product->category ?? 'No Category' }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Shipping Information Card -->
            <div class="modern-card mt-4 animate-fade-in animation-delay-200">
                <div class="modern-card-header modern-card-header-warning">
                    <h5 class="modern-card-title">
                        <i class="fas fa-shipping-fast me-2"></i>
                        Shipping Information
                    </h5>
                </div>
                <div class="modern-card-body">
                    <div class="order-info-item">
                        <strong>Shipping Address:</strong>
                        <span>{{ $order->shipping_address ?: 'No address provided' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="modern-card mb-4 animate-fade-in animation-delay-300">
                <div class="modern-card-header">
                    <h5 class="modern-card-title">
                        <i class="fas fa-user me-2"></i>
                        Customer Information
                    </h5>
                </div>
                <div class="modern-card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($order->user->profile_image)
                            <img src="{{ asset('storage/' . $order->user->profile_image) }}" 
                                 alt="{{ $order->user->name }}" 
                                 class="rounded-circle me-3" 
                                 style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center text-white" 
                                 style="width: 50px; height: 50px;">
                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h6 class="mb-0">{{ $order->user->name }}</h6>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $order->user) }}" class="btn-modern w-100">
                        <i class="fas fa-user me-2"></i>View Customer Profile
                    </a>
                </div>
            </div>

            <!-- Order Status -->
            <div class="modern-card mb-4 animate-fade-in animation-delay-400">
                <div class="modern-card-header modern-card-header-success">
                    <h5 class="modern-card-title">
                        <i class="fas fa-tasks me-2"></i>
                        Update Status
                    </h5>
                </div>
                <div class="modern-card-body">
                    <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label">Order Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-modern w-100">
                            <i class="fas fa-sync-alt me-2"></i>Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="modern-card animate-fade-in animation-delay-400">
                <div class="modern-card-header">
                    <h5 class="modern-card-title">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Payment Status
                    </h5>
                </div>
                <div class="modern-card-body">
                    <form action="{{ route('admin.orders.payment', $order) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select name="payment_status" id="payment_status" class="form-select" required>
                                <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-success-modern w-100">
                            <i class="fas fa-check me-2"></i>Update Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
