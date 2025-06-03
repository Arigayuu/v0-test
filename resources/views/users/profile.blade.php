@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<!-- Page Header -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">My Profile</h1>
                <p class="lead text-muted">Manage your account information and preferences</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }} fs-6">
                        <i class="fas fa-{{ $user->role === 'admin' ? 'shield-alt' : 'user' }} me-1"></i>
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <!-- Profile Information -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Profile Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">Full Name</label>
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

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-bold">Email Address</label>
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
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Phone Number</label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="e.g., +62 812 3456 7890">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label fw-bold">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="4"
                                      placeholder="Enter your complete address for shipping">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Change Password</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-bold">Current Password</label>
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-bold">New Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-bold">Confirm New Password</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-key me-2"></i>Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Profile Sidebar -->
        <div class="col-lg-4">
            <!-- Account Summary -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Account Summary</h5>
                </div>
                <div class="card-body text-center">
                    <div class="profile-avatar mb-3">
                        <div class="avatar-lg bg-primary rounded-circle d-inline-flex align-items-center justify-content-center">
                            <i class="fas fa-user fa-3x text-white"></i>
                        </div>
                    </div>
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    
                    <hr>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="stat-item">
                                <h5 class="text-primary">{{ $user->orders->count() }}</h5>
                                <small class="text-muted">Total Orders</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item">
                                <h5 class="text-success">{{ $user->reviews->count() }}</h5>
                                <small class="text-muted">Reviews Written</small>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="account-meta">
                        <p class="mb-1"><strong>Member Since:</strong></p>
                        <p class="text-muted">{{ $user->created_at->format('F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-cart me-2"></i>View My Orders
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-success">
                            <i class="fas fa-shopping-bag me-2"></i>Browse Products
                        </a>
                        @if($user->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger">
                                <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Recent Activity</h5>
                </div>
                <div class="card-body">
                    @if($user->orders->count() > 0)
                        <div class="activity-list">
                            @foreach($user->orders->take(3) as $order)
                                <div class="activity-item d-flex align-items-center mb-3">
                                    <div class="activity-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="fas fa-shopping-cart text-white"></i>
                                    </div>
                                    <div class="activity-content flex-grow-1">
                                        <h6 class="mb-0">Order #{{ $order->id }}</h6>
                                        <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="activity-status">
                                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary">
                                View All Orders
                            </a>
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-history fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No recent activity</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.avatar-lg {
    width: 80px;
    height: 80px;
}

.stat-item {
    padding: 1rem 0;
}

.activity-icon {
    width: 40px;
    height: 40px;
    font-size: 0.875rem;
}

.activity-item:last-child {
    margin-bottom: 0 !important;
}
</style>
@endsection
