@extends('layouts.admin')

@section('title', 'Statistics')
@section('page-title', 'Detailed Statistics')

@section('styles')
<style>
/* Modern Statistics Page Styling */

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

.animation-delay-100 {
  animation-delay: 100ms;
}

.animation-delay-200 {
  animation-delay: 200ms;
}

.animation-delay-300 {
  animation-delay: 300ms;
}

.animation-delay-400 {
  animation-delay: 400ms;
}

/* Modern Card Styling */
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
  padding: 1.5rem;
  border-bottom: 1px solid var(--gray-100);
  color: white;
}

.modern-card-title {
  margin: 0;
  font-size: 1.125rem;
  font-weight: 700;
}

.modern-card-body {
  padding: 1.5rem;
}

/* Gradient Backgrounds */
.bg-primary-gradient {
  background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
}

.bg-success-gradient {
  background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
}

.bg-info-gradient {
  background: linear-gradient(135deg, var(--info-color) 0%, #0284c7 100%);
}

.bg-warning-gradient {
  background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
}

.bg-danger-gradient {
  background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
}

/* Statistics Cards */
.stat-card {
  border-radius: 12px;
  padding: 1.25rem;
  color: white;
  transition: all 0.3s ease;
  border: none;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-card-primary {
  background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
}

.stat-card-success {
  background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
}

.stat-card-warning {
  background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
}

.stat-card-danger {
  background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
}

.stat-card-info {
  background: linear-gradient(135deg, var(--info-color) 0%, #0284c7 100%);
}

.stat-card-body {
  padding: 0;
}

.stat-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.stat-info {
  flex: 1;
}

.stat-label {
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  opacity: 0.8;
  margin-bottom: 0.25rem;
}

.stat-value {
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.2;
}

.stat-icon {
  width: 3rem;
  height: 3rem;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
}

/* Chart Containers */
.chart-container {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  overflow: hidden;
  transition: all 0.3s ease;
}

.chart-container:hover {
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.chart-header {
  padding: 1rem 1.5rem;
  border-bottom: 1px solid var(--gray-100);
}

.chart-title-wrapper {
  display: flex;
  align-items: center;
}

.chart-icon {
  width: 2.5rem;
  height: 2.5rem;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  margin-right: 0.75rem;
}

.chart-title {
  margin: 0;
  font-size: 1rem;
  font-weight: 700;
}

.chart-body {
  padding: 1.5rem;
}

.chart-canvas {
  width: 100% !important;
  height: 320px !important;
}

/* Modern Table Styling */
.modern-table-responsive {
  overflow-x: auto;
}

.modern-table {
  width: 100%;
  border-collapse: collapse;
  margin: 0;
}

.modern-table thead tr {
  background-color: var(--gray-100);
}

.modern-table th {
  padding: 0.75rem 1rem;
  text-align: left;
  font-size: 0.75rem;
  font-weight: 700;
  color: var(--primary-color);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  border: none;
}

.modern-table td {
  padding: 0.75rem 1rem;
  border-bottom: 1px solid var(--gray-100);
  vertical-align: middle;
}

.modern-table tbody tr {
  transition: all 0.2s ease;
}

.modern-table tbody tr:hover {
  background-color: var(--gray-100);
}

/* Status Badges */
.status-badge {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
  font-weight: 700;
  border-radius: 6px;
  text-transform: capitalize;
}

.status-success {
  background-color: rgba(16, 185, 129, 0.1);
  color: #059669;
}

.status-primary {
  background-color: rgba(79, 70, 229, 0.1);
  color: var(--primary-color);
}

.status-warning {
  background-color: rgba(245, 158, 11, 0.1);
  color: #d97706;
}

.status-danger {
  background-color: rgba(239, 68, 68, 0.1);
  color: #dc2626;
}

/* Order Link */
.order-link {
  color: var(--primary-color);
  font-weight: 700;
  text-decoration: none;
  transition: all 0.2s ease;
}

.order-link:hover {
  color: #6366f1;
  text-decoration: underline;
}

/* Rating Display */
.rating-display {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.rating-value {
  font-weight: 700;
  color: var(--warning-color);
}

.rating-max {
  color: var(--gray-500);
}

.stars {
  display: flex;
  gap: 0.125rem;
}

.star-filled {
  color: var(--warning-color);
  font-size: 0.75rem;
}

.star-empty {
  color: var(--gray-300);
  font-size: 0.75rem;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 2rem 1rem;
}

.empty-icon {
  font-size: 3rem;
  color: var(--gray-300);
  margin-bottom: 0.75rem;
  display: block;
}

.empty-text {
  color: var(--gray-500);
  margin: 0;
}

/* Text Colors */
.text-primary {
  color: var(--primary-color) !important;
}

.text-success {
  color: var(--success-color) !important;
}

.text-warning {
  color: var(--warning-color) !important;
}

.text-info {
  color: var(--info-color) !important;
}

.text-muted {
  color: var(--gray-500) !important;
}

/* Responsive Design */
@media (max-width: 767.98px) {
  .modern-card-header,
  .modern-card-body {
    padding: 1rem;
  }

  .stat-card {
    padding: 1rem;
  }

  .stat-value {
    font-size: 1.25rem;
  }

  .stat-icon {
    width: 2.5rem;
    height: 2.5rem;
    font-size: 1rem;
  }

  .chart-canvas {
    height: 250px !important;
  }

  .modern-table th,
  .modern-table td {
    padding: 0.5rem;
    font-size: 0.875rem;
  }
}

@media (max-width: 575.98px) {
  .chart-title-wrapper {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }

  .chart-icon {
    margin-right: 0;
  }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- User Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-card animate-fade-in">
                <div class="modern-card-header bg-primary-gradient">
                    <h6 class="modern-card-title">User Statistics</h6>
                </div>
                <div class="modern-card-body">
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-primary">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Total Users</div>
                                            <div class="stat-value">{{ number_format($totalUsers) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-danger">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Admin Users</div>
                                            <div class="stat-value">{{ number_format($totalAdmins) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-user-shield"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-success">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Regular Users</div>
                                            <div class="stat-value">{{ number_format($totalRegularUsers) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-info">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">New Users This Month</div>
                                            <div class="stat-value">{{ number_format($newUsersThisMonth) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-card animate-fade-in animation-delay-100">
                <div class="modern-card-header bg-success-gradient">
                    <h6 class="modern-card-title">Product Statistics</h6>
                </div>
                <div class="modern-card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-success">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Total Products</div>
                                            <div class="stat-value">{{ number_format($totalProducts) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-box"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-warning">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Low Stock Products</div>
                                            <div class="stat-value">{{ number_format($lowStockCount) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-danger">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Out of Stock</div>
                                            <div class="stat-value">{{ number_format($outOfStockCount) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-info">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Categories</div>
                                            <div class="stat-value">{{ count($productsByCategory) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Categories Chart -->
                    <div class="chart-container">
                        <div class="chart-header">
                            <div class="chart-title-wrapper">
                                <div class="chart-icon bg-success-gradient">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <h6 class="chart-title text-success">Products by Category</h6>
                            </div>
                        </div>
                        <div class="chart-body">
                            <canvas id="productCategoriesChart" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-card animate-fade-in animation-delay-200">
                <div class="modern-card-header bg-info-gradient">
                    <h6 class="modern-card-title">Order Statistics</h6>
                </div>
                <div class="modern-card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-info">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Total Orders</div>
                                            <div class="stat-value">{{ number_format($totalOrders) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-warning">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Pending Orders</div>
                                            <div class="stat-value">{{ number_format($pendingOrders) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-success">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Completed Orders</div>
                                            <div class="stat-value">{{ number_format($completedOrders) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-card stat-card-danger">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Cancelled Orders</div>
                                            <div class="stat-value">{{ number_format($cancelledOrders) }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Orders Chart -->
                    <div class="chart-container">
                        <div class="chart-header">
                            <div class="chart-title-wrapper">
                                <div class="chart-icon bg-info-gradient">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h6 class="chart-title text-info">Monthly Orders (Last 6 Months)</h6>
                            </div>
                        </div>
                        <div class="chart-body">
                            <canvas id="monthlyOrdersChart" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-card animate-fade-in animation-delay-300">
                <div class="modern-card-header bg-warning-gradient">
                    <h6 class="modern-card-title">Revenue Statistics</h6>
                </div>
                <div class="modern-card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 mb-4">
                            <div class="stat-card stat-card-warning">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Total Revenue</div>
                                            <div class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="stat-card stat-card-info">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Revenue This Month</div>
                                            <div class="stat-value">Rp {{ number_format($revenueThisMonth, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="stat-card stat-card-success">
                                <div class="stat-card-body">
                                    <div class="stat-content">
                                        <div class="stat-info">
                                            <div class="stat-label">Average Order Value</div>
                                            <div class="stat-value">Rp {{ number_format($averageOrderValue, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Revenue Chart -->
                    <div class="chart-container">
                        <div class="chart-header">
                            <div class="chart-title-wrapper">
                                <div class="chart-icon bg-warning-gradient">
                                    <i class="fas fa-chart-area"></i>
                                </div>
                                <h6 class="chart-title text-warning">Monthly Revenue (Last 6 Months)</h6>
                            </div>
                        </div>
                        <div class="chart-body">
                            <canvas id="monthlyRevenueChart" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-xl-6 col-lg-6">
            <div class="modern-card animate-fade-in animation-delay-400">
                <div class="modern-card-header">
                    <div class="chart-title-wrapper">
                        <div class="chart-icon bg-primary-gradient">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h6 class="modern-card-title text-primary">Recent Orders</h6>
                    </div>
                </div>
                <div class="modern-card-body">
                    <div class="modern-table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="order-link">#{{ $order->id }}</a>
                                    </td>
                                    <td class="text-muted">{{ $order->user->name }}</td>
                                    <td class="font-weight-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $order->status === 'completed' ? 'success' : 
                                            ($order->status === 'processing' ? 'primary' : 
                                            ($order->status === 'cancelled' ? 'danger' : 'warning')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="text-muted">{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fas fa-shopping-cart empty-icon"></i>
                                        <p class="empty-text">No recent orders</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="col-xl-6 col-lg-6">
            <div class="modern-card animate-fade-in animation-delay-400">
                <div class="modern-card-header">
                    <div class="chart-title-wrapper">
                        <div class="chart-icon bg-primary-gradient">
                            <i class="fas fa-star"></i>
                        </div>
                        <h6 class="modern-card-title text-primary">Recent Reviews</h6>
                    </div>
                </div>
                <div class="modern-card-body">
                    <div class="modern-table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>User</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentReviews as $review)
                                <tr>
                                    <td class="font-weight-bold">{{ $review->product->name }}</td>
                                    <td class="text-muted">{{ $review->user->name }}</td>
                                    <td>
                                        <div class="rating-display">
                                            <span class="rating-value">{{ $review->rating }}</span>
                                            <span class="rating-max">/5</span>
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'star-filled' : 'star-empty' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ Str::limit($review->comment, 30) }}</td>
                                    <td class="text-muted">{{ $review->created_at->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fas fa-star empty-icon"></i>
                                        <p class="empty-text">No recent reviews</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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

// Product Categories Chart
const productCategoriesCtx = document.getElementById('productCategoriesChart').getContext('2d');
const productCategoriesChart = new Chart(productCategoriesCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($productsByCategory)) !!},
        datasets: [{
            label: 'Products',
            data: {!! json_encode(array_values($productsByCategory)) !!},
            backgroundColor: [
                colors.primary + '80',
                colors.success + '80',
                colors.info + '80',
                colors.warning + '80',
                colors.danger + '80',
                colors.secondary + '80'
            ],
            borderColor: [
                colors.primary,
                colors.success,
                colors.info,
                colors.warning,
                colors.danger,
                colors.secondary
            ],
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
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
                    color: '#6b7280'
                }
            }
        }
    }
});

// Monthly Orders Chart
const monthlyOrdersCtx = document.getElementById('monthlyOrdersChart').getContext('2d');
const monthlyOrdersChart = new Chart(monthlyOrdersCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode(array_keys($monthlyCounts)) !!},
        datasets: [{
            label: 'Orders',
            data: {!! json_encode(array_values($monthlyCounts)) !!},
            backgroundColor: colors.info + '20',
            borderColor: colors.info,
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: colors.info,
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
                    color: '#6b7280'
                }
            }
        }
    }
});

// Monthly Revenue Chart
const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
const monthlyRevenueChart = new Chart(monthlyRevenueCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode(array_keys($monthlyRevenues)) !!},
        datasets: [{
            label: 'Revenue (Rp)',
            data: {!! json_encode(array_values($monthlyRevenues)) !!},
            backgroundColor: colors.warning + '20',
            borderColor: colors.warning,
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: colors.warning,
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
        }
    }
});
</script>
@endsection
