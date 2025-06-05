@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<!-- Page Header -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center" style="padding: 50px;">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">Welcome back, {{ $user->name }}!</h1>
                <p class="lead text-muted">Here's an overview of your account activity</p>
            </div>
            <div class="col-md-4 text-end">
                <img src="{{ asset('tes user.jpg') }}" alt="foto profil" class="img-fluid rounded-circle shadow-lg">
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <!-- Statistics Cards -->
    <div class="row mb-5">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-primary mb-3">
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $stats['total_orders'] }}</h3>
                    <p class="text-muted mb-0">Total Orders</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-warning mb-3">
                        <i class="fas fa-clock fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $stats['pending_orders'] }}</h3>
                    <p class="text-muted mb-0">Pending Orders</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-success mb-3">
                        <i class="fas fa-money-bill-wave fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-success">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0">Total Spent</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-info mb-3">
                        <i class="fas fa-shopping-bag fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-info">{{ $stats['cart_items'] }}</h3>
                    <p class="text-muted mb-0">Items in Cart</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Orders -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Recent Orders</h5>
                        <a href="{{ route('orders.index') }}" class="btn btn-light btn-sm">View All</a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($recentOrders as $order)
                        <div class="d-flex align-items-center border-bottom py-3">
                            <div class="me-3">
                                <div class="icon-circle bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                    <i class="fas fa-shopping-cart text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Order #{{ $order->id }}</h6>
                                        <p class="text-muted mb-0">{{ $order->items->count() }} items</p>
                                        <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No orders yet</h5>
                            <p class="text-muted">Start shopping to see your orders here!</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Products</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions & Account Info -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Browse Products
                        </a>
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-success">
                            <i class="fas fa-shopping-cart me-2"></i>View Cart ({{ $stats['cart_items'] }})
                        </a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-info">
                            <i class="fas fa-history me-2"></i>Order History
                        </a>
                        <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-user me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Account Summary -->
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Account Summary</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="{{ asset('tes user.jpg') }}" alt="foto profil" class="rounded-circle border border-3 border-light shadow" width="80" height="80">
                        <h5 class="mt-2 mb-0">{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                    
                    <hr>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <h6 class="text-primary">{{ $stats['completed_orders'] }}</h6>
                            <small class="text-muted">Completed Orders</small>
                        </div>
                        <div class="col-6">
                            <h6 class="text-success">{{ $stats['reviews_written'] }}</h6>
                            <small class="text-muted">Reviews Written</small>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                        <p class="mb-1"><strong>Member Since:</strong></p>
                        <p class="text-muted">{{ $user->created_at->format('F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Spending Chart -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Monthly Spending Overview</h5>
                </div>
                <div class="card-body">
                    <canvas id="spendingChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Monthly Spending Chart
const spendingCtx = document.getElementById('spendingChart').getContext('2d');
const spendingChart = new Chart(spendingCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($monthlySpending)) !!},
        datasets: [{
            label: 'Spending (Rp)',
            data: {!! json_encode(array_values($monthlySpending)) !!},
            backgroundColor: 'rgba(255, 193, 7, 0.8)',
            borderColor: 'rgba(255, 193, 7, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString();
                    }
                }
            }
        }
    }
});
</script>

<style>
.icon-circle {
    height: 2.5rem;
    width: 2.5rem;
    border-radius: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection
