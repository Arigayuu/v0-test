@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-4" >
    <!-- Header -->
    <div class="row mb-4" style="padding: 50px;">
        <div class="col-md-8" >
            <h1 class="display-5 fw-bold">My Orders</h1>
            <p class="text-muted">Track and manage your order history</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
            </a>
        </div>
    </div>

    <!-- Order Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-light">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-receipt fs-3 text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">{{ $orders->count() }}</h5>
                        <div class="text-muted small">Total Orders</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-light">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-check-circle fs-3 text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">{{ $orders->where('status', 'completed')->count() }}</h5>
                        <div class="text-muted small">Completed</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-light">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-clock fs-3 text-warning"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">{{ $orders->where('status', 'processing')->count() }}</h5>
                        <div class="text-muted small">Processing</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-light">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-dollar-sign fs-3 text-info"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Rp {{ number_format($orders->sum('total_amount'), 0, ',', '.') }}</h5>
                        <div class="text-muted small">Total Spent</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($orders->isEmpty())
        <!-- Empty State -->
        <div class="card text-center p-5">
            <div class="py-5">
                <i class="fas fa-shopping-cart fs-1 text-muted mb-4"></i>
                <h3>No Orders Yet</h3>
                <p class="text-muted mb-4">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i>Browse Products
                </a>
            </div>
        </div>
    @else
        <!-- Orders List -->
        @foreach($orders as $order)
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Order #{{ $order->id }}</h5>
                            <small class="text-muted">{{ $order->created_at->format('F d, Y \a\t H:i') }}</small>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="badge bg-{{ 
                                $order->status === 'completed' ? 'success' : 
                                ($order->status === 'processing' ? 'primary' : 
                                ($order->status === 'cancelled' ? 'danger' : 'warning')) 
                            }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Order Items -->
                            @foreach($order->orderItems as $item)
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 width="60" 
                                                 height="60" 
                                                 class="rounded">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $item->product ? $item->product->name : 'Product Unavailable' }}</h6>
                                        <div class="text-muted small">
                                            Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </div>
                                        <div class="fw-bold text-primary">
                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- Payment Info -->
                            <div class="mt-3 pt-3 border-top">
                                <div class="row mb-2">
                                    <div class="col-md-4 text-muted">Payment Method:</div>
                                    <div class="col-md-8">
                                        <span class="badge bg-secondary">{{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 text-muted">Payment Status:</div>
                                    <div class="col-md-8">
                                        <span class="badge bg-{{ 
                                            $order->payment_status === 'paid' ? 'success' : 
                                            ($order->payment_status === 'pending' ? 'warning' : 'danger') 
                                        }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Order Summary -->
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Order Summary</h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Total Amount:</span>
                                        <span class="fw-bold text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                    
                                    <h6 class="mt-3 mb-2">Shipping Address:</h6>
                                    <p class="mb-0 small">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>{{ $order->created_at->diffForHumans() }}
                                </small>
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        @endif
    @endif
</div>
@endsection