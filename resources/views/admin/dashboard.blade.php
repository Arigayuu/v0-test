@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-card-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Users</div>
                        <div class="stats-value">{{ number_format($totalUsers) }}</div>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up me-1"></i>
                            +{{ $monthlyUsers }} this month
                        </div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-card-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Products</div>
                        <div class="stats-value">{{ number_format($totalProducts) }}</div>
                        <div class="stats-change">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            {{ $lowStockProducts->count() }} low stock
                        </div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-card-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Orders</div>
                        <div class="stats-value">{{ number_format($totalOrders) }}</div>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up me-1"></i>
                            +{{ $monthlyOrders }} this month
                        </div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-card-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Revenue</div>
                        <div class="stats-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up me-1"></i>
                            +Rp {{ number_format($monthlyRevenue, 0, ',', '.') }} this month
                        </div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card modern-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h6 class="mb-0 fw-bold text-primary-custom">Revenue Overview (Last 6 Months)</h6>
                </div>
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card modern-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h6 class="mb-0 fw-bold text-primary-custom">Order Status Distribution</h6>
                </div>
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
        <div class="card modern-card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="card-icon me-3">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-primary-custom">Recent Orders</h6>
                    </div>
                    <span class="badge bg-primary-custom">{{ $recentOrders->count() }}</span>
                </div>
            </div>
            <div class="card-body">
                @forelse($recentOrders as $order)
                    <div class="order-item">
                        <div class="d-flex align-items-center">
                            <div class="order-icon me-3">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                <div class="order-id">Order #{{ $order->id }}</div>
                                <div class="order-customer">{{ $order->user->name }}</div>
                            </div>
                            <div class="text-end">
                                <div class="order-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                <span class="badge order-status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No recent orders</p>
                    </div>
                @endforelse
                <div class="text-center mt-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary-custom btn-sm">
                        <i class="fas fa-eye me-1"></i>View All Orders
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="col-lg-6 mb-4">
        <div class="card modern-card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="card-icon me-3 bg-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-danger">Low Stock Alert</h6>
                    </div>
                    <span class="badge bg-danger">{{ $lowStockProducts->count() }}</span>
                </div>
            </div>
            <div class="card-body">
                @forelse($lowStockProducts as $product)
                    <div class="stock-item">
                        <div class="d-flex align-items-center">
                            <div class="stock-icon me-3">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="stock-name">{{ $product->name }}</div>
                                <div class="stock-category">{{ ucfirst($product->category) }}</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-danger">{{ $product->stock }} left</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <p class="text-muted">All products have sufficient stock</p>
                    </div>
                @endforelse
                <div class="text-center mt-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-cog me-1"></i>Manage Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Users -->
<div class="row">
    <div class="col-12">
        <div class="card modern-card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="card-icon me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-primary-custom">Recent Users</h6>
                    </div>
                    <span class="badge bg-primary-custom">{{ $recentUsers->count() }}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table modern-table">
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
                                            <div class="user-avatar me-3">
                                                <img src="{{ $user->profile_image_url }}" 
                                                     alt="{{ $user->name }}">
                                            </div>
                                            <strong>{{ $user->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge role-{{ $user->role }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <span class="order-count">{{ $user->orders->count() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-primary-custom">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No recent users</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary-custom btn-sm">
                        <i class="fas fa-users me-1"></i>View All Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Modern color palette
const colors = {
    primary: '#4f46e5',
    secondary: '#818cf8',
    success: '#10b981',
    warning: '#f59e0b',
    danger: '#ef4444',
    info: '#06b6d4'
};

// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode(array_keys($monthlyRevenueData)) !!},
        datasets: [{
            label: 'Revenue (Rp)',
            data: {!! json_encode(array_values($monthlyRevenueData)) !!},
            borderColor: colors.primary,
            backgroundColor: colors.primary + '20',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: colors.primary,
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#6b7280'
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: '#f3f4f6'
                },
                ticks: {
                    color: '#6b7280',
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString();
                    }
                }
            }
        },
        elements: {
            point: {
                hoverBackgroundColor: colors.primary
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
                colors.warning,
                colors.success,
                colors.info,
                colors.danger
            ],
            borderWidth: 0,
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    color: '#6b7280'
                }
            }
        }
    }
});

// Add animation to stats cards
document.addEventListener('DOMContentLoaded', function() {
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in');
    });
});
</script>

<style>
/* Modern Blue Color Scheme */
:root {
    --primary-color: #4f46e5;
    --secondary-color: #818cf8;
    --dark-color: #312e81;
    --light-color: #f8fafc;
    --accent-color: #6366f1;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
}

body {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.02) 0%, rgba(99, 102, 241, 0.02) 100%);
    font-family: "Inter", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

/* Modern Cards */
.modern-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.08);
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

.modern-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(79, 70, 229, 0.12);
}

.modern-card .card-header {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
    border-bottom: 1px solid rgba(79, 70, 229, 0.1);
    border-radius: 16px 16px 0 0;
    padding: 1.25rem;
}

.card-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.card-icon.bg-danger {
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
}

/* Statistics Cards */
.stats-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.stats-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
}

.stats-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(79, 70, 229, 0.15);
}

.stats-card-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    color: white;
}

.stats-card-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    color: white;
}

.stats-card-info {
    background: linear-gradient(135deg, var(--info-color) 0%, #0891b2 100%);
    color: white;
}

.stats-card-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    color: white;
}

.stats-label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    opacity: 0.9;
    margin-bottom: 0.5rem;
}

.stats-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.stats-change {
    font-size: 0.875rem;
    opacity: 0.8;
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

/* Order Items */
.order-item {
    padding: 1rem;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.02) 0%, rgba(99, 102, 241, 0.02) 100%);
    border: 1px solid rgba(79, 70, 229, 0.08);
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
}

.order-item:hover {
    transform: translateX(4px);
    border-color: rgba(79, 70, 229, 0.15);
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.1);
}

.order-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.order-date {
    font-size: 0.75rem;
    color: #6b7280;
    margin-bottom: 0.25rem;
}

.order-id {
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

.order-customer {
    font-size: 0.875rem;
    color: #6b7280;
}

.order-amount {
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 0.25rem;
}

.order-status-completed {
    background: var(--success-color);
    color: white;
}

.order-status-pending {
    background: var(--warning-color);
    color: white;
}

.order-status-processing {
    background: var(--info-color);
    color: white;
}

/* Stock Items */
.stock-item {
    padding: 1rem;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.02) 0%, rgba(220, 38, 38, 0.02) 100%);
    border: 1px solid rgba(239, 68, 68, 0.08);
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
}

.stock-item:hover {
    transform: translateX(4px);
    border-color: rgba(239, 68, 68, 0.15);
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.1);
}

.stock-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.stock-name {
    font-weight: 600;
    color: var(--danger-color);
    margin-bottom: 0.25rem;
}

.stock-category {
    font-size: 0.875rem;
    color: #6b7280;
}

/* Modern Table */
.modern-table {
    border-collapse: separate;
    border-spacing: 0;
}

.modern-table thead th {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
    border: none;
    color: var(--primary-color);
    font-weight: 600;
    padding: 1rem;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.modern-table tbody tr {
    transition: all 0.3s ease;
}

.modern-table tbody tr:hover {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.02) 0%, rgba(99, 102, 241, 0.02) 100%);
    transform: scale(1.01);
}

.modern-table tbody td {
    padding: 1rem;
    border: none;
    border-bottom: 1px solid rgba(79, 70, 229, 0.08);
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid var(--primary-color);
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.role-admin {
    background: var(--danger-color);
    color: white;
}

.role-user {
    background: var(--primary-color);
    color: white;
}

.order-count {
    display: inline-block;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

/* Buttons */
.btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    border: none;
    color: white;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.2);
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.btn-outline-primary-custom {
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    background: transparent;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-outline-primary-custom:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-1px);
}

.text-primary-custom {
    color: var(--primary-color) !important;
}

.bg-primary-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%) !important;
    color: white;
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 2rem;
}

/* Badges */
.badge {
    font-weight: 600;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
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
    opacity: 0;
}

/* Responsive */
@media (max-width: 767.98px) {
    .stats-value {
        font-size: 1.5rem;
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }
    
    .modern-table {
        font-size: 0.875rem;
    }
    
    .order-item, .stock-item {
        padding: 0.75rem;
    }
}
</style>
@endsection
