@extends('layouts.admin')

@section('title', 'User Details')
@section('page-title', 'User Details: ' . $user->name)

@section('styles')
<style>
/* Modern User Details Page Styling */

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

/* Breadcrumb */
.modern-breadcrumb {
  background: white;
  border-radius: 12px;
  padding: 1rem 1.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  margin-bottom: 1.5rem;
}

.modern-breadcrumb ol {
  display: flex;
  flex-wrap: wrap;
  padding: 0;
  margin: 0;
  list-style: none;
}

.modern-breadcrumb-item {
  display: flex;
  align-items: center;
}

.modern-breadcrumb-item:not(:first-child)::before {
  content: "/";
  padding: 0 0.5rem;
  color: var(--gray-500);
}

.modern-breadcrumb-link {
  color: var(--primary-color);
  text-decoration: none;
  transition: all 0.2s ease;
}

.modern-breadcrumb-link:hover {
  color: var(--secondary-color);
  text-decoration: underline;
}

.modern-breadcrumb-active {
  color: var(--gray-600);
  font-weight: 600;
}

/* Back Button */
.btn-back {
  background: white;
  color: var(--gray-600);
  border: 2px solid var(--gray-300);
  border-radius: 8px;
  padding: 0.5rem 1rem;
  font-weight: 600;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-back:hover {
  background: var(--gray-100);
  color: var(--gray-800);
  border-color: var(--gray-500);
}

/* Modern Card */
.modern-card {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  border: none;
  overflow: hidden;
  transition: all 0.3s ease;
  margin-bottom: 1.5rem;
}

.modern-card:hover {
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.modern-card-header {
  padding: 1.5rem;
  border-bottom: 1px solid var(--gray-100);
}

.modern-card-header-primary {
  background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
  color: white;
  border-bottom: none;
}

.modern-card-header-success {
  background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
  color: white;
  border-bottom: none;
}

.modern-card-header-warning {
  background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
  color: white;
  border-bottom: none;
}

.modern-card-title {
  margin: 0;
  font-size: 1.125rem;
  font-weight: 700;
  display: flex;
  align-items: center;
}

.modern-card-body {
  padding: 1.5rem;
}

/* User Profile */
.user-profile {
  text-align: center;
  margin-bottom: 2rem;
}

.user-avatar {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 2.5rem;
  margin: 0 auto 1rem;
}

.user-name {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0 0 0.5rem;
  color: var(--dark-color);
}

/* Badge */
.badge-modern {
  padding: 0.375rem 0.75rem;
  font-size: 0.875rem;
  font-weight: 600;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
}

.badge-primary {
  background-color: rgba(79, 70, 229, 0.1);
  color: var(--primary-color);
}

.badge-danger {
  background-color: rgba(239, 68, 68, 0.1);
  color: var(--danger-color);
}

.badge-success {
  background-color: rgba(16, 185, 129, 0.1);
  color: var(--success-color);
}

.badge-warning {
  background-color: rgba(245, 158, 11, 0.1);
  color: var(--warning-color);
}

.badge-info {
  background-color: rgba(6, 182, 212, 0.1);
  color: var(--info-color);
}

.badge-dark {
  background-color: rgba(30, 41, 59, 0.1);
  color: var(--dark-color);
}

/* Form Controls */
.form-group {
  margin-bottom: 1.5rem;
}

.form-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: var(--gray-600);
}

.form-control {
  display: block;
  width: 100%;
  padding: 0.75rem 1rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: var(--gray-800);
  background-color: white;
  background-clip: padding-box;
  border: 2px solid var(--gray-300);
  border-radius: 8px;
  transition: all 0.15s ease-in-out;
}

.form-control:focus {
  border-color: var(--primary-color);
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
}

.form-control.is-invalid {
  border-color: var(--danger-color);
}

.invalid-feedback {
  display: block;
  width: 100%;
  margin-top: 0.25rem;
  font-size: 0.875rem;
  color: var(--danger-color);
}

.form-select {
  display: block;
  width: 100%;
  padding: 0.75rem 2.5rem 0.75rem 1rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: var(--gray-800);
  background-color: white;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 16px 12px;
  border: 2px solid var(--gray-300);
  border-radius: 8px;
  appearance: none;
  transition: all 0.15s ease-in-out;
}

.form-select:focus {
  border-color: var(--primary-color);
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
}

/* Button */
.btn-modern {
  display: inline-block;
  font-weight: 600;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  user-select: none;
  border: none;
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 8px;
  transition: all 0.3s ease;
  cursor: pointer;
}

.btn-primary {
  background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
  color: white;
  box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
}

.btn-primary:hover {
  background: linear-gradient(135deg, #6366f1 0%, var(--primary-color) 100%);
  transform: translateY(-1px);
  box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
}

.btn-block {
  display: block;
  width: 100%;
}

/* User Stats */
.user-stats {
  padding: 1rem 0;
}

.stat-item {
  text-align: center;
  padding: 1rem;
}

.stat-value {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0;
}

.stat-primary {
  color: var(--primary-color);
}

.stat-success {
  color: var(--success-color);
}

.stat-label {
  font-size: 0.875rem;
  color: var(--gray-500);
  margin: 0;
}

/* User Meta */
.user-meta {
  color: var(--gray-600);
  font-size: 0.875rem;
}

.user-meta p {
  margin-bottom: 0.5rem;
}

.user-meta strong {
  color: var(--gray-800);
}

/* Modern Table */
.modern-table-responsive {
  overflow-x: auto;
  border-radius: 8px;
}

.modern-table {
  width: 100%;
  border-collapse: collapse;
  margin: 0;
  background: white;
}

.modern-table thead tr {
  background: var(--gray-100);
}

.modern-table th {
  padding: 1rem;
  text-align: left;
  font-size: 0.75rem;
  font-weight: 700;
  color: var(--primary-color);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  border: none;
}

.modern-table td {
  padding: 1rem;
  border-bottom: 1px solid var(--gray-100);
  vertical-align: middle;
}

.modern-table tbody tr {
  transition: all 0.2s ease;
}

.modern-table tbody tr:hover {
  background-color: rgba(79, 70, 229, 0.05);
}

/* Action Buttons */
.btn-action {
  width: 32px;
  height: 32px;
  border-radius: 6px;
  border: 2px solid;
  background: transparent;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  font-size: 0.875rem;
  margin-right: 0.25rem;
}

.btn-action:last-child {
  margin-right: 0;
}

.btn-action-info {
  border-color: var(--info-color);
  color: var(--info-color);
}

.btn-action-info:hover {
  background: var(--info-color);
  color: white;
}

.btn-action-danger {
  border-color: var(--danger-color);
  color: var(--danger-color);
}

.btn-action-danger:hover {
  background: var(--danger-color);
  color: white;
}

/* Reviews */
.review-item {
  padding-bottom: 1.5rem;
  margin-bottom: 1.5rem;
  border-bottom: 1px solid var(--gray-100);
}

.review-item:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

.review-product {
  font-weight: 700;
  color: var(--dark-color);
  text-decoration: none;
  transition: all 0.2s ease;
}

.review-product:hover {
  color: var(--primary-color);
  text-decoration: underline;
}

.review-rating {
  display: flex;
  align-items: center;
  margin-bottom: 0.5rem;
}

.star-filled {
  color: var(--warning-color);
}

.star-empty {
  color: var(--gray-300);
}

.review-text {
  margin-bottom: 0.5rem;
  color: var(--gray-600);
}

.review-date {
  font-size: 0.75rem;
  color: var(--gray-500);
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 3rem 1rem;
}

.empty-icon {
  font-size: 4rem;
  color: var(--gray-300);
  margin-bottom: 1rem;
}

.empty-text {
  color: var(--gray-500);
  font-size: 1.125rem;
  margin: 0;
}

/* Pagination */
.pagination {
  justify-content: center;
  margin-top: 1.5rem;
}

.page-link {
  border: none;
  color: var(--primary-color);
  padding: 0.5rem 0.75rem;
  margin: 0 0.125rem;
  border-radius: 6px;
  transition: all 0.2s ease;
}

.page-link:hover {
  background: var(--primary-color);
  color: white;
}

.page-item.active .page-link {
  background: var(--primary-color);
  border-color: var(--primary-color);
}

/* Responsive Design */
@media (max-width: 767.98px) {
  .modern-card-header,
  .modern-card-body {
    padding: 1rem;
  }

  .user-avatar {
    width: 80px;
    height: 80px;
    font-size: 2rem;
  }

  .user-name {
    font-size: 1.25rem;
  }

  .modern-table th,
  .modern-table td {
    padding: 0.75rem 0.5rem;
    font-size: 0.875rem;
  }

  .btn-action {
    width: 28px;
    height: 28px;
    font-size: 0.75rem;
  }
}

@media (max-width: 575.98px) {
  .modern-breadcrumb {
    padding: 0.75rem 1rem;
  }

  .page-header .d-flex {
    flex-direction: column;
    align-items: flex-start !important;
    gap: 1rem;
  }

  .modern-table-responsive {
    font-size: 0.75rem;
  }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb & Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <nav class="modern-breadcrumb animate-fade-in">
            <ol>
                <li class="modern-breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="modern-breadcrumb-link">Dashboard</a>
                </li>
                <li class="modern-breadcrumb-item">
                    <a href="{{ route('admin.users.index') }}" class="modern-breadcrumb-link">Users</a>
                </li>
                <li class="modern-breadcrumb-item">
                    <span class="modern-breadcrumb-active">{{ $user->name }}</span>
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.users.index') }}" class="btn-back animate-fade-in">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Users</span>
        </a>
    </div>

    <div class="row">
        <!-- User Information -->
        <div class="col-lg-4">
            <div class="modern-card animate-fade-in">
                <div class="modern-card-header modern-card-header-primary">
                    <h5 class="modern-card-title">
                        <i class="fas fa-user me-2"></i>User Information
                    </h5>
                </div>
                <div class="modern-card-body">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="user-name">{{ $user->name }}</h4>
                        <span class="badge-modern {{ $user->role === 'admin' ? 'badge-danger' : 'badge-primary' }}">
                            <i class="fas fa-{{ $user->role === 'admin' ? 'shield-alt' : 'user' }}"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" 
                                    id="role" 
                                    name="role" 
                                    required>
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-modern btn-primary btn-block">
                            <i class="fas fa-save me-2"></i>Update User
                        </button>
                    </form>

                    <hr>
                    <div class="user-stats">
                        <div class="row">
                            <div class="col-6">
                                <div class="stat-item">
                                    <h5 class="stat-value stat-primary">{{ $orders->count() }}</h5>
                                    <p class="stat-label">Orders</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item">
                                    <h5 class="stat-value stat-success">{{ $reviews->count() }}</h5>
                                    <p class="stat-label">Reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="user-meta">
                        <p><strong>Member Since:</strong> {{ $user->created_at->format('F d, Y') }}</p>
                        <p><strong>Last Updated:</strong> {{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Activity -->
        <div class="col-lg-8">
            <!-- Recent Orders -->
            <div class="modern-card animate-fade-in animation-delay-100">
                <div class="modern-card-header modern-card-header-success d-flex justify-content-between align-items-center">
                    <h5 class="modern-card-title">
                        <i class="fas fa-shopping-cart me-2"></i>Recent Orders
                    </h5>
                    <span class="badge-modern badge-dark">{{ $orders->count() }} total</span>
                </div>
                <div class="modern-card-body">
                    @if($orders->count() > 0)
                        <div class="modern-table-responsive">
                            <table class="modern-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td><strong>#{{ $order->id }}</strong></td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td><strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                                            <td>
                                                <span class="badge-modern {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'processing' ? 'badge-warning' : 'badge-danger') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge-modern {{ $order->payment_status === 'paid' ? 'badge-success' : 'badge-danger' }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order) }}" 
                                                   class="btn-action btn-action-info"
                                                   title="View Order">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-shopping-cart empty-icon"></i>
                            <p class="empty-text">No orders found</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Reviews -->
            <div class="modern-card animate-fade-in animation-delay-200">
                <div class="modern-card-header modern-card-header-warning d-flex justify-content-between align-items-center">
                    <h5 class="modern-card-title">
                        <i class="fas fa-star me-2"></i>Recent Reviews
                    </h5>
                    <span class="badge-modern badge-dark">{{ $reviews->count() }} total</span>
                </div>
                <div class="modern-card-body">
                    @if($reviews->count() > 0)
                        @foreach($reviews as $review)
                            <div class="review-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">
                                            <a href="{{ route('admin.products.show', $review->product) }}" class="review-product">
                                                {{ $review->product->name }}
                                            </a>
                                        </h6>
                                        <div class="review-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review->rating ? 'star-filled' : 'star-empty' }}"></i>
                                            @endfor
                                            <span class="ms-2 text-muted">({{ $review->rating }}/5)</span>
                                        </div>
                                        <p class="review-text">{{ $review->comment }}</p>
                                        <small class="review-date">{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                    <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-action-danger" title="Delete Review">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center mt-3">
                            {{ $reviews->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-star empty-icon"></i>
                            <p class="empty-text">No reviews found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
