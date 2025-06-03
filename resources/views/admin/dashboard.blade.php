@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Users</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($totalUsers) }}</div>
                        <small class="text-white-50">+{{ $monthlyUsers }} this month</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Products</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($totalProducts) }}</div>
                        <small class="text-white-50">{{ $lowStockProducts->count() }} low stock</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Orders</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($totalOrders) }}</div>
                        <small class="text-white-50">+{{ $monthlyOrders }} this month</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Revenue</div>
                        <div class="h5 mb-0 font-weight-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        <small class="text-white-50">+Rp {{ number_format($monthlyRevenue, 0, ',', '.') }} this month</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revenue Overview (Last 6 Months)</h6>
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Order Status Distribution</h6>
            </div>
            <div class="card-body">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Recent Orders -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Orders</h6>
            </div>
            <div class="card-body">
                @forelse($recentOrders as $order)
                    <div class="d-flex align-items-center border-bottom py-3">
                        <div class="me-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-shopping-cart text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small text-gray-500">{{ $order->created_at->format('M d, Y') }}</div>
                            <div class="font-weight-bold">Order #{{ $order->id }}</div>
                            <div class="text-muted">{{ $order->user->name }}</div>
                        </div>
                        <div class="text-end">
                            <div class="font-weight-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">No recent orders</p>
                @endforelse
                <div class="text-center mt-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">View All Orders</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">Low Stock Alert</h6>
            </div>
            <div class="card-body">
                @forelse($lowStockProducts as $product)
                    <div class="d-flex align-items-center border-bottom py-3">
                        <div class="me-3">
                            <div class="icon-circle bg-danger">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="font-weight-bold">{{ $product->name }}</div>
                            <div class="text-muted">{{ ucfirst($product->category) }}</div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-danger">{{ $product->stock }} left</span>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">All products have sufficient stock</p>
                @endforelse
                <div class="text-center mt-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-danger btn-sm">Manage Products</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Users -->
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th>Orders</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->profile_image_url }}" 
                                                 class="rounded-circle me-2" 
                                                 width="40" height="40" 
                                                 alt="{{ $user->name }}">
                                            <strong>{{ $user->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>{{ $user->orders->count() }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No recent users</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">View All Users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode(array_keys($monthlyRevenueData)) !!},
        datasets: [{
            label: 'Revenue (Rp)',
            data: {!! json_encode(array_values($monthlyRevenueData)) !!},
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
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

// Order Status Chart
const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
const statusChart = new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode(array_keys($orderStatuses)) !!},
        datasets: [{
            data: {!! json_encode(array_values($orderStatuses)) !!},
            backgroundColor: [
                '#f6c23e',
                '#1cc88a',
                '#36b9cc',
                '#e74a3b'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
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
    justify-content-center;
}
</style>
@endsection
