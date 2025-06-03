@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<!-- Page Header -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">My Orders</h1>
                <p class="lead text-muted">Track and manage your order history</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                </a>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    @if($orders->isEmpty())
        <!-- Empty State -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow text-center">
                    <div class="card-body py-5">
                        <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">No Orders Yet</h3>
                        <p class="text-muted mb-4">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-shopping-bag me-2"></i>Browse Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Orders List -->
        <div class="row">
            <div class="col-12">
                <!-- Order Statistics -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-receipt fa-2x mb-2"></i>
                                <h4>{{ $orders->count() }}</h4>
                                <p class="mb-0">Total Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h4>{{ $orders->where('status', 'completed')->count() }}</h4>
                                <p class="mb-0">Completed</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h4>{{ $orders->where('status', 'processing')->count() }}</h4>
                                <p class="mb-0">Processing</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-dollar-sign fa-2x mb-2"></i>
                                <h4>Rp {{ number_format($orders->sum('total_amount'), 0, ',', '.') }}</h4>
                                <p class="mb-0">Total Spent</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Cards -->
                <div class="row">
                    @foreach($orders as $order)
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0">Order #{{ $order->id }}</h5>
                                        <small class="text-muted">{{ $order->created_at->format('F d, Y \a\t H:i') }}</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 
                                            ($order->status === 'processing' ? 'primary' : 
                                            ($order->status === 'cancelled' ? 'danger' : 'warning')) }} fs-6">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Order Items -->
                                    <div class="order-items mb-3">
                                        @foreach($order->items as $item)
                                            <div class="d-flex align-items-center mb-2">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         width="50" 
                                                         height="50" 
                                                         class="rounded me-3">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">
                                                        Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                                    </small>
                                                </div>
                                                <div class="text-end">
                                                    <strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Order Summary -->
                                    <div class="order-summary bg-light p-3 rounded mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Payment Method:</span>
                                            <span class="badge bg-secondary">{{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Payment Status:</span>
                                            <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 
                                                ($order->payment_status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between fw-bold">
                                            <span>Total Amount:</span>
                                            <span class="text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    <!-- Shipping Address -->
                                    <div class="shipping-info mb-3">
                                        <h6 class="fw-bold mb-2">
                                            <i class="fas fa-map-marker-alt me-2"></i>Shipping Address
                                        </h6>
                                        <p class="text-muted mb-0 small">{{ $order->shipping_address }}</p>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>{{ $order->created_at->diffForHumans() }}
                                        </small>
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
