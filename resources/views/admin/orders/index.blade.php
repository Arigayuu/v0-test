@extends('layouts.admin')

@section('title', 'Order Management')

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

.animation-delay-100 {
    animation-delay: 100ms;
}

.animation-delay-200 {
    animation-delay: 200ms;
}

.animation-delay-300 {
    animation-delay: 300ms;
}

/* Page Header */
.page-header {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 1.5rem;
    border: none;
    /* Added position relative to ensure z-index works for child dropdown */
    position: relative;
    z-index: 10; /* Ensure header is above main content but below modal/alerts */
}

.page-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-color);
}

.page-subtitle {
    margin: 0;
    color: var(--gray-500);
    font-size: 0.875rem;
}

/* Modern Button */
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
    background: linear-gradient(135deg, #6366f1 0%, var(--primary-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
}

.btn-success-modern {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-success-modern:hover {
    background: linear-gradient(135deg, #059669 0%, var(--success-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

.btn-info-modern {
    background: linear-gradient(135deg, var(--info-color) 0%, #0284c7 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-info-modern:hover {
    background: linear-gradient(135deg, #0284c7 0%, var(--info-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
}

.btn-secondary-modern {
    background: var(--gray-500);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-secondary-modern:hover {
    background: var(--gray-600);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(107, 114, 128, 0.3);
}

.btn-warning-modern {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-warning-modern:hover {
    background: linear-gradient(135deg, #d97706 0%, var(--warning-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
}

.btn-danger-modern {
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-danger-modern:hover {
    background: linear-gradient(135deg, #dc2626 0%, var(--danger-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
}

/* Dropdown specific styles to match modern look */
.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    border: 1px solid var(--gray-300);
    padding: 0.5rem 0;
    animation: fadeInUp 0.2s ease-out forwards;
    z-index: 1050; /* Higher z-index to ensure it appears above other content */
}

.dropdown-item {
    padding: 0.75rem 1.25rem;
    color: var(--gray-800);
    font-weight: 500;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.dropdown-item:hover, .dropdown-item:active {
    background-color: var(--gray-100);
    color: var(--primary-color);
}

.dropdown-toggle::after {
    margin-left: 0.75em; /* Adjust space between text and caret */
}


/* Modern Card */
.modern-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: none;
    overflow: hidden; /* Ensures the border-radius applies to inner content */
    transition: all 0.3s ease;
    z-index: 1; /* Ensure card is below dropdown */
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
    padding: 1.5rem;
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
}

.modern-card-header-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    padding: 1.5rem;
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
}

.modern-card-body {
    padding: 1.5rem;
}

/* Alert Styling */
.alert-modern {
    border-radius: 8px;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    animation: fadeInUp 0.5s ease-out forwards;
    z-index: 10; /* Ensure alerts are above main content */
}

.alert-success-modern {
    background-color: #d1fae5; /* green-100 */
    color: #065f46; /* green-900 */
    border: 1px solid #34d399; /* green-400 */
}

.alert-success-modern .btn-close {
    color: #065f46;
}

.alert-danger-modern {
    background-color: #fee2e2; /* red-100 */
    color: #991b1b; /* red-900 */
    border: 1px solid #f87171; /* red-400 */
}

.alert-danger-modern .btn-close {
    color: #991b1b;
}

/* Table Styling */
.table-hover tbody tr:hover {
    background-color: var(--gray-100);
}

.table-modern {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px; /* Outer border radius */
    overflow: hidden; /* Ensures the border-radius applies */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.table-modern thead {
    background-color: var(--gray-100);
    border-bottom: 1px solid var(--gray-300);
}

.table-modern th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-weight: 700;
    color: var(--gray-800);
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.table-modern td {
    padding: 1rem 1.5rem;
    vertical-align: middle;
    color: var(--gray-600);
    border-bottom: 1px solid var(--gray-100);
}

.table-modern tbody tr:last-child td {
    border-bottom: none;
}

.table-modern .badge {
    padding: 0.4em 0.7em;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 0.75em;
    text-transform: capitalize;
}

.badge-status-pending {
    background-color: #fef3c7; /* yellow-100 */
    color: #b45309; /* yellow-800 */
}

.badge-status-processing {
    background-color: #bfdbfe; /* blue-200 */
    color: #1e40af; /* blue-800 */
}

.badge-status-completed {
    background-color: #d1fae5; /* green-100 */
    color: #065f46; /* green-900 */
}

.badge-status-cancelled {
    background-color: #fee2e2; /* red-100 */
    color: #991b1b; /* red-900 */
}

.badge-status-shipped {
    background-color: #dbeafe; /* blue-100 */
    color: #1e40af; /* blue-800 */
}

/* Payment Status Badges */
.badge-payment-paid {
    background-color: #d1fae5; /* green-100 */
    color: #065f46; /* green-900 */
}

.badge-payment-pending {
    background-color: #fef3c7; /* yellow-100 */
    color: #b45309; /* yellow-800 */
}

.badge-payment-failed {
    background-color: #fee2e2; /* red-100 */
    color: #991b1b; /* red-900 */
}

.table-modern .btn-group-sm .btn {
    padding: 0.4rem 0.6rem;
    font-size: 0.75rem;
    border-radius: 6px;
}

.table-modern .btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}
.table-modern .btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: white;
}

.table-modern .btn-outline-success {
    color: var(--success-color);
    border-color: var(--success-color);
}
.table-modern .btn-outline-success:hover {
    background-color: var(--success-color);
    color: white;
}

.table-modern .btn-outline-info {
    color: var(--info-color);
    border-color: var(--info-color);
}
.table-modern .btn-outline-info:hover {
    background-color: var(--info-color);
    color: white;
}

.table-modern .btn-outline-danger {
    color: var(--danger-color);
    border-color: var(--danger-color);
}
.table-modern .btn-outline-danger:hover {
    background-color: var(--danger-color);
    color: white;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    padding-left: 0;
    list-style: none;
    border-radius: 0.5rem;
}

.page-item .page-link {
    display: block;
    padding: 0.75rem 1rem;
    margin: 0 0.25rem;
    color: var(--primary-color);
    background-color: white;
    border: 1px solid var(--gray-300);
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
}

.page-item .page-link:hover {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
}

.page-item.disabled .page-link {
    color: var(--gray-500);
    pointer-events: none;
    background-color: var(--gray-100);
    border-color: var(--gray-300);
    box-shadow: none;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 0;
    color: var(--gray-500);
}
.empty-state .fas {
    color: var(--gray-300);
}
.empty-state p {
    margin-top: 1rem;
    font-size: 1.125rem;
}


/* Responsive Design */
@media (max-width: 767.98px) {
    .page-header {
        padding: 1rem;
        /* Add more bottom padding for mobile when dropdown might open */
        padding-bottom: 5rem; /* Give space for dropdown when it opens */
    }

    .page-header .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }

    .btn-group {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-group .btn-secondary-modern {
        width: 100%;
        justify-content: center;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
    }

    .modern-card-header,
    .modern-card-body {
        padding: 1rem;
    }

    .table-responsive {
        border: 1px solid var(--gray-300); /* Add border for mobile tables */
        border-radius: 12px;
    }

    .table-modern th,
    .table-modern td {
        padding: 0.8rem 1rem;
        font-size: 0.875rem;
    }
}

@media (max-width: 575.98px) {
    .page-title {
        font-size: 1.25rem;
    }

    .page-subtitle {
        font-size: 0.75rem;
    }

    .alert-modern {
        font-size: 0.875rem;
        padding: 0.75rem 1rem;
    }

    .table-modern .badge {
        font-size: 0.65em;
    }

    .table-modern .btn-group-sm .btn {
        padding: 0.3rem 0.5rem;
        font-size: 0.7rem;
    }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header animate-fade-in">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="page-title">Order Management</h4>
                <p class="page-subtitle">View and manage all customer orders.</p>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary-modern dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter me-2"></i>Filter Orders
                </button>
                <ul class="dropdown-menu animate-fade-in animation-delay-100">
                    <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">All Orders</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">Pending</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.orders.index', ['status' => 'processing']) }}">Processing</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.orders.index', ['status' => 'shipped']) }}">Shipped</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.orders.index', ['status' => 'completed']) }}">Completed</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}">Cancelled</a></li>
                </ul>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success-modern alert-dismissible fade show animate-fade-in animation-delay-200" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger-modern alert-dismissible fade show animate-fade-in animation-delay-200" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="modern-card animate-fade-in animation-delay-300">
        <div class="modern-card-body p-0"> {{-- p-0 to remove default padding, allowing table to fill --}}
            <div class="table-responsive">
                <table class="table table-hover table-modern">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <strong>#{{ $order->id }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($order->user->profile_image)
                                            <img src="{{ asset('storage/' . $order->user->profile_image) }}"
                                                 alt="{{ $order->user->name }}"
                                                 class="rounded-circle me-2"
                                                 style="width: 32px; height: 32px; object-fit: cover;">
                                        @else
                                            <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center text-white"
                                                 style="width: 32px; height: 32px; font-size: 12px; background-color: var(--primary-color) !important;">
                                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-medium text-dark">{{ $order->user->name }}</div>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $order->created_at->format('M d, Y') }}</div>
                                    <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $order->orderItems->count() }} items</span>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <span class="badge badge-status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-payment-{{ str_replace('_', '-', $order->payment_status) }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                           class="btn btn-outline-primary btn-sm"
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($order->status !== 'completed' && $order->status !== 'cancelled')
                                            <form action="{{ route('admin.orders.status', $order) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to mark this order as completed? This action cannot be undone.')">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit"
                                                        class="btn btn-outline-success btn-sm"
                                                        title="Mark as Completed">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if($order->status === 'processing')
                                            <form action="{{ route('admin.orders.status', $order) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to mark this order as shipped?')">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="shipped">
                                                <button type="submit"
                                                        class="btn btn-outline-info btn-sm"
                                                        title="Mark as Shipped">
                                                    <i class="fas fa-truck"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if($order->status !== 'completed' && $order->status !== 'cancelled')
                                            <form action="{{ route('admin.orders.status', $order) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to cancel this order? This action cannot be undone.')">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit"
                                                        class="btn btn-outline-danger btn-sm"
                                                        title="Cancel Order">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="fas fa-box-open fa-4x mb-3"></i>
                                        <p>No orders found for the current filter.</p>
                                        <p class="text-muted">Try adjusting your filters or check back later.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="d-flex justify-content-center mt-4 pb-3">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection