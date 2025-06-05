@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-4">
    <!-- Order Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Order #{{ $order->id }}</h1>
            <p class="text-muted">Placed on {{ $order->created_at->format('F d, Y \a\t H:i') }}</p>
        </div>
        <div class="col-md-4 text-end">
            <span class="badge bg-{{ 
                $order->status === 'completed' ? 'success' : 
                ($order->status === 'processing' ? 'primary' : 
                ($order->status === 'cancelled' ? 'danger' : 'warning')) 
            }} fs-5 p-2">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">My Orders</a></li>
            <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Order Summary -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Order Date:</div>
                        <div class="col-md-8">{{ $order->created_at->format('F d, Y \a\t H:i') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Payment Method:</div>
                        <div class="col-md-8">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Payment Status:</div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ 
                                $order->payment_status === 'paid' ? 'success' : 
                                ($order->payment_status === 'failed' ? 'danger' : 'warning') 
                            }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 fw-bold">Total Amount:</div>
                        <div class="col-md-8">
                            <span class="fs-4 fw-bold text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-box me-2"></i>Order Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
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
                                                         width="60" 
                                                         height="60" 
                                                         class="rounded me-3">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">
                                                        @if($item->product)
                                                            <a href="{{ route('products.show', $item->product) }}" 
                                                               class="text-decoration-none">
                                                                {{ $item->product->name }}
                                                            </a>
                                                        @else
                                                            Product Unavailable
                                                        @endif
                                                    </h6>
                                                    @if($item->product)
                                                        <small class="text-muted">{{ ucfirst($item->product->category) }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="fw-bold text-primary">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total Amount:</td>
                                    <td class="fw-bold text-success fs-5">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Order Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item {{ $order->status === 'pending' ? 'active' : 'completed' }}">
                            <div class="timeline-marker">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="fw-bold">Order Placed</h6>
                                <p class="text-muted mb-0">{{ $order->created_at->format('F d, Y \a\t H:i') }}</p>
                            </div>
                        </div>

                        <div class="timeline-item {{ in_array($order->status, ['processing', 'completed']) ? 'completed' : '' }}">
                            <div class="timeline-marker">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="fw-bold">Processing</h6>
                                <p class="text-muted mb-0">
                                    @if(in_array($order->status, ['processing', 'completed']))
                                        Your order is being prepared
                                    @else
                                        Waiting for processing
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item {{ $order->status === 'completed' ? 'completed' : '' }}">
                            <div class="timeline-marker">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="fw-bold">Completed</h6>
                                <p class="text-muted mb-0">
                                    @if($order->status === 'completed')
                                        Order delivered successfully
                                    @else
                                        Pending completion
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Order Status -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Order Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Order Status:</span>
                            <span class="badge bg-{{ 
                                $order->status === 'completed' ? 'success' : 
                                ($order->status === 'processing' ? 'primary' : 
                                ($order->status === 'cancelled' ? 'danger' : 'warning')) 
                            }} fs-6">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Payment Status:</span>
                            <span class="badge bg-{{ 
                                $order->payment_status === 'paid' ? 'success' : 
                                ($order->payment_status === 'pending' ? 'warning' : 'danger') 
                            }} fs-6">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Payment Method:</span>
                            <span class="badge bg-secondary">{{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>Shipping Information</h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Delivery Address:</h6>
                    <p class="text-muted p-3 bg-light rounded mb-4">{{ $order->shipping_address }}</p>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-bold">Shipping Cost:</span>
                        <span class="text-success fw-bold">Free</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Estimated Delivery:</span>
                        <span>3-5 business days</span>
                    </div>
                </div>
            </div>

            <!-- Order Actions -->
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Orders
                        </a>
                        
                        @if($order->status === 'completed')
                            <button class="btn btn-success" disabled>
                                <i class="fas fa-check me-2"></i>Order Completed
                            </button>
                        @elseif($order->status === 'cancelled')
                            <button class="btn btn-danger" disabled>
                                <i class="fas fa-times me-2"></i>Order Cancelled
                            </button>
                        @else
                            <a href="{{ route('products.index') }}" class="btn btn-primary">
                                <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
                <!-- Admin Actions -->
                <div class="card shadow mt-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="fas fa-user-shield me-2"></i>Admin Actions</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="mb-3">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Update Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Update Status</button>
                        </form>

                        <form action="{{ route('admin.orders.payment', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-select" id="payment_status" name="payment_status" required>
                                    <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Update Payment</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Timeline Styles */
.timeline {
    position: relative;
    padding-left: 30px;
    margin-top: 1rem;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    border: 3px solid white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
    color: white;
}

.timeline-item.active .timeline-marker {
    background: #ffc107;
    color: #212529;
}

.timeline-content {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    border-left: 3px solid #dee2e6;
}

.timeline-item.completed .timeline-content {
    border-left-color: #28a745;
}

.timeline-item.active .timeline-content {
    border-left-color: #ffc107;
}

/* Card Enhancements */
.card {
    border: none;
    border-radius: 0.5rem;
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.card-header {
    padding: 1rem 1.5rem;
    font-weight: bold;
}

.card-body {
    padding: 1.5rem;
}

/* Shadow Effects */
.shadow {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
}

/* Badge Styles */
.badge {
    padding: 0.5rem 0.75rem;
    font-weight: 600;
}
</style>
@endsection