@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<!-- Modern Page Header with Gradient -->
<section class="profile-header-custom" style="margin-top: 40px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="header-content-custom">
                    <h1 class="display-4 fw-bold text-black mb-3">My Profile</h1>
                    <p class="lead text-black-50 mb-0">Manage your account information and preferences</p>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="role-badge-container-custom">
                    <span class="role-badge-custom role-{{ $user->role }}">
                        <i class="fas fa-{{ $user->role === 'admin' ? 'crown' : 'user' }} me-2"></i>
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row g-4">
        <!-- Profile Information -->
        <div class="col-lg-8">
            <!-- Profile Info Card -->
            <div class="modern-card-custom mb-4">
                <div class="card-header-primary-custom">
                    <div class="header-icon-custom">
                        <i class="fas fa-user"></i>
                    </div>
                    <h5 class="mb-0 text-white fw-bold">Profile Information</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="name" class="form-label-custom">Full Name</label>
                                    <input type="text" 
                                           class="form-control modern-input-custom @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           placeholder="Enter your full name"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="email" class="form-label-custom">Email Address</label>
                                    <input type="email" 
                                           class="form-control modern-input-custom @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           placeholder="Enter your email address"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group-custom">
                                    <label for="phone" class="form-label-custom">Phone Number</label>
                                    <input type="text" 
                                           class="form-control modern-input-custom @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', $user->phone) }}"
                                           placeholder="e.g., +62 812 3456 7890">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group-custom">
                                    <label for="address" class="form-label-custom">Complete Address</label>
                                    <textarea class="form-control modern-input-custom @error('address') is-invalid @enderror" 
                                              id="address" 
                                              name="address" 
                                              rows="4"
                                              placeholder="Enter your complete address for shipping">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="modern-card-custom">
                <div class="card-header-warning-custom">
                    <div class="header-icon-custom">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="mb-0 fw-bold" style="color: #000;">Security Settings</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group-custom">
                                    <label for="current_password" class="form-label-custom">Current Password</label>
                                    <input type="password" 
                                           class="form-control modern-input-custom @error('current_password') is-invalid @enderror" 
                                           id="current_password" 
                                           name="current_password" 
                                           placeholder="Enter your current password"
                                           required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="password" class="form-label-custom">New Password</label>
                                    <input type="password" 
                                           class="form-control modern-input-custom @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Enter new password"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="password_confirmation" class="form-label-custom">Confirm New Password</label>
                                    <input type="password" 
                                           class="form-control modern-input-custom" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Confirm new password"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-warning-custom">
                                <i class="fas fa-key me-2"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Enhanced Sidebar -->
        <div class="col-lg-4">
            <!-- Profile Summary Card -->
            <div class="modern-card-custom profile-summary-custom mb-4">
                <div class="card-header-info-custom">
                    <div class="header-icon-custom">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h5 class="mb-0 text-white fw-bold">Account Summary</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="profile-avatar-container-custom mb-4">
                        <div class="profile-avatar-custom">
                            <div class="avatar-circle-custom">
                                <img src="{{ asset('tes user.jpg') }}" alt="foto profil" class="rounded-circle border border-3 border-light shadow" width="80" height="80">
                               
                            </div>
                            <div class="avatar-status-custom"></div>
                        </div>
                    </div>
                    
                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-4">{{ $user->email }}</p>
                    
                    <div class="stats-container-custom">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="stat-card-custom">
                                    <div class="stat-number-custom">{{ $user->orders->count() }}</div>
                                    <div class="stat-label-custom">Total Orders</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-card-custom">
                                    <div class="stat-number-custom">{{ $user->reviews->count() }}</div>
                                    <div class="stat-label-custom">Reviews Written</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="member-since-custom mt-4">
                        <small class="text-muted"><strong>Member Since:</strong><br>{{ $user->created_at->format('F Y') }}</small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="modern-card-custom mb-4">
                <div class="card-header-success-custom">
                    <div class="header-icon-custom">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h5 class="mb-0 text-white fw-bold">Quick Actions</h5>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary-custom">
                            <i class="fas fa-shopping-cart me-2"></i>View My Orders
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-success-custom">
                            <i class="fas fa-shopping-bag me-2"></i>Browse Products
                        </a>
                        @if($user->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger-custom">
                                <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Activity Card -->
            <div class="modern-card-custom">
                <div class="card-header-secondary-custom">
                    <div class="header-icon-custom">
                        <i class="fas fa-history"></i>
                    </div>
                    <h5 class="mb-0 text-white fw-bold">Recent Activity</h5>
                </div>
                <div class="card-body p-3">
                    @if($user->orders->count() > 0)
                        <div class="activity-timeline-custom">
                            @foreach($user->orders->take(3) as $order)
                                <div class="activity-item-custom">
                                    <div class="activity-icon-custom">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="activity-content-custom">
                                        <div class="activity-title-custom">Order #{{ $order->id }}</div>
                                        <div class="activity-time-custom">{{ $order->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="activity-status-custom">
                                        <span class="status-badge-custom status-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary">
                                View All Orders
                            </a>
                        </div>
                    @else
                        <div class="empty-state-custom">
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
/* Custom Profile Header */
.profile-header-custom {
    padding: 4rem 0 3rem !important;
    position: relative;
    overflow: hidden;
    margin-bottom: 0 !important;
}

.profile-header-custom::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%);
}

.header-content-custom {
    position: relative;
    z-index: 2;
}

.role-badge-container-custom {
    position: relative;
    z-index: 2;
}

.role-badge-custom {
    display: inline-flex !important;
    align-items: center !important;
    padding: 0.75rem 1.5rem !important;
    border-radius: 50px !important;
    font-weight: 600 !important;
    font-size: 0.875rem !important;
    backdrop-filter: blur(10px) !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
}

.role-badge-custom.role-admin {
    background: rgba(220, 53, 69, 0.9) !important;
    color: #fff !important;
    border-color: rgba(220, 53, 69, 0.5) !important;
}

.role-badge-custom.role-user {
    background: rgba(13, 110, 253, 0.9) !important;
    color: #fff !important;
    border-color: rgba(13, 110, 253, 0.5) !important;
}

/* Modern Cards */
.modern-card-custom {
    background: #fff !important;
    border-radius: 16px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
    border: 1px solid rgba(0, 0, 0, 0.05) !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
    margin-bottom: 1.5rem !important;
}

.modern-card-custom:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12) !important;
}

/* Card Headers with Colors */
.card-header-primary-custom {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
    color: white !important;
    border-bottom: none !important;
    padding: 1.25rem 1.5rem !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
}

.card-header-warning-custom {
    background: linear-gradient(135deg, #ffc107 0%, #ffca2c 100%) !important;
    color: #000 !important;
    border-bottom: none !important;
    padding: 1.25rem 1.5rem !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
}

.card-header-success-custom {
    background: linear-gradient(135deg, #198754 0%, #20c997 100%) !important;
    color: white !important;
    border-bottom: none !important;
    padding: 1.25rem 1.5rem !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
}

.card-header-info-custom {
    background: linear-gradient(135deg, #0dcaf0 0%, #31d2f2 100%) !important;
    color: white !important;
    border-bottom: none !important;
    padding: 1.25rem 1.5rem !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
}

.card-header-secondary-custom {
    background: linear-gradient(135deg, #6c757d 0%, #5c636a 100%) !important;
    color: white !important;
    border-bottom: none !important;
    padding: 1.25rem 1.5rem !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
}

.header-icon-custom {
    width: 40px !important;
    height: 40px !important;
    background: rgba(255, 255, 255, 0.2) !important;
    border-radius: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: inherit !important;
    font-size: 1rem !important;
}

/* Custom Form Groups */
.form-group-custom {
    margin-bottom: 1.5rem !important;
}

.form-label-custom {
    display: block !important;
    margin-bottom: 0.5rem !important;
    font-weight: 600 !important;
    color: #495057 !important;
    font-size: 0.875rem !important;
}

/* Modern Form Inputs */
.modern-input-custom {
    display: block !important;
    width: 100% !important;
    padding: 0.75rem 1rem !important;
    font-size: 1rem !important;
    font-weight: 400 !important;
    line-height: 1.5 !important;
    color: #212529 !important;
    background-color: #fff !important;
    background-image: none !important;
    border: 2px solid #e9ecef !important;
    border-radius: 12px !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}

.modern-input-custom:focus {
    color: #212529 !important;
    background-color: #fff !important;
    border-color: #0d6efd !important;
    outline: 0 !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important;
}

.modern-input-custom::placeholder {
    color: #6c757d !important;
    opacity: 1 !important;
}

/* Custom Buttons */
.btn-primary-custom {
    display: inline-block !important;
    font-weight: 600 !important;
    line-height: 1.5 !important;
    color: #fff !important;
    text-align: center !important;
    text-decoration: none !important;
    vertical-align: middle !important;
    cursor: pointer !important;
    user-select: none !important;
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
    border: 2px solid #0d6efd !important;
    padding: 0.75rem 2rem !important;
    font-size: 1rem !important;
    border-radius: 12px !important;
    transition: all 0.3s ease !important;
}

.btn-primary-custom:hover {
    color: #fff !important;
    background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%) !important;
    border-color: #0b5ed7 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4) !important;
    text-decoration: none !important;
}

.btn-warning-custom {
    display: inline-block !important;
    font-weight: 600 !important;
    line-height: 1.5 !important;
    color: #000 !important;
    text-align: center !important;
    text-decoration: none !important;
    vertical-align: middle !important;
    cursor: pointer !important;
    user-select: none !important;
    background: linear-gradient(135deg, #ffc107 0%, #ffca2c 100%) !important;
    border: 2px solid #ffc107 !important;
    padding: 0.75rem 2rem !important;
    font-size: 1rem !important;
    border-radius: 12px !important;
    transition: all 0.3s ease !important;
}

.btn-warning-custom:hover {
    color: #000 !important;
    background: linear-gradient(135deg, #ffca2c 0%, #ffd60a 100%) !important;
    border-color: #ffca2c !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4) !important;
    text-decoration: none !important;
}

/* Outline Buttons */
.btn-outline-primary-custom {
    display: inline-block !important;
    font-weight: 500 !important;
    line-height: 1.5 !important;
    color: #0d6efd !important;
    text-align: center !important;
    text-decoration: none !important;
    vertical-align: middle !important;
    cursor: pointer !important;
    user-select: none !important;
    background-color: transparent !important;
    border: 2px solid #0d6efd !important;
    padding: 0.75rem 1rem !important;
    font-size: 1rem !important;
    border-radius: 12px !important;
    transition: all 0.3s ease !important;
}

.btn-outline-primary-custom:hover {
    color: #fff !important;
    background-color: #0d6efd !important;
    border-color: #0d6efd !important;
    transform: translateY(-1px) !important;
    text-decoration: none !important;
}

.btn-outline-success-custom {
    display: inline-block !important;
    font-weight: 500 !important;
    line-height: 1.5 !important;
    color: #198754 !important;
    text-align: center !important;
    text-decoration: none !important;
    vertical-align: middle !important;
    cursor: pointer !important;
    user-select: none !important;
    background-color: transparent !important;
    border: 2px solid #198754 !important;
    padding: 0.75rem 1rem !important;
    font-size: 1rem !important;
    border-radius: 12px !important;
    transition: all 0.3s ease !important;
}

.btn-outline-success-custom:hover {
    color: #fff !important;
    background-color: #198754 !important;
    border-color: #198754 !important;
    transform: translateY(-1px) !important;
    text-decoration: none !important;
}

.btn-outline-danger-custom {
    display: inline-block !important;
    font-weight: 500 !important;
    line-height: 1.5 !important;
    color: #dc3545 !important;
    text-align: center !important;
    text-decoration: none !important;
    vertical-align: middle !important;
    cursor: pointer !important;
    user-select: none !important;
    background-color: transparent !important;
    border: 2px solid #dc3545 !important;
    padding: 0.75rem 1rem !important;
    font-size: 1rem !important;
    border-radius: 12px !important;
    transition: all 0.3s ease !important;
}

.btn-outline-danger-custom:hover {
    color: #fff !important;
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
    transform: translateY(-1px) !important;
    text-decoration: none !important;
}

/* Profile Summary */
.profile-summary-custom {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%) !important;
    border: 2px solid #e9ecef !important;
}

.profile-avatar-container-custom {
    position: relative;
    display: inline-block;
}

.profile-avatar-custom {
    position: relative;
}

.avatar-circle-custom {
    width: 100px !important;
    height: 100px !important;
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-size: 2.5rem !important;
    box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3) !important;
    border: 4px solid #fff !important;
}

.avatar-status-custom {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 20px !important;
    height: 20px !important;
    background: #198754 !important;
    border-radius: 50% !important;
    border: 3px solid white !important;
}

.stats-container-custom {
    margin: 2rem 0 !important;
}

.stat-card-custom {
    background: #fff !important;
    border-radius: 12px !important;
    padding: 1.5rem 1rem !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
    border: 2px solid #e9ecef !important;
    transition: all 0.3s ease !important;
}

.stat-card-custom:hover {
    border-color: #0d6efd !important;
    transform: translateY(-2px) !important;
}

.stat-number-custom {
    font-size: 2rem !important;
    font-weight: 700 !important;
    color: #0d6efd !important;
    line-height: 1 !important;
}

.stat-label-custom {
    font-size: 0.875rem !important;
    color: #6c757d !important;
    margin-top: 0.25rem !important;
    font-weight: 500 !important;
}

/* Activity Timeline */
.activity-timeline-custom {
    position: relative;
}

.activity-item-custom {
    display: flex !important;
    align-items: center !important;
    padding: 1rem 0 !important;
    border-bottom: 1px solid #e9ecef !important;
    gap: 1rem !important;
}

.activity-item-custom:last-child {
    border-bottom: none !important;
}

.activity-icon-custom {
    width: 40px !important;
    height: 40px !important;
    background: #0d6efd !important;
    border-radius: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-size: 0.875rem !important;
    flex-shrink: 0 !important;
}

.activity-content-custom {
    flex: 1 !important;
}

.activity-title-custom {
    font-weight: 600 !important;
    color: #212529 !important;
    font-size: 0.875rem !important;
}

.activity-time-custom {
    font-size: 0.75rem !important;
    color: #6c757d !important;
    margin-top: 0.25rem !important;
}

.status-badge-custom {
    padding: 0.25rem 0.75rem !important;
    border-radius: 20px !important;
    font-size: 0.75rem !important;
    font-weight: 500 !important;
}

.status-badge-custom.status-completed {
    background: #198754 !important;
    color: #fff !important;
}

.status-badge-custom.status-pending {
    background: #ffc107 !important;
    color: #000 !important;
}

.status-badge-custom.status-processing {
    background: #0dcaf0 !important;
    color: #000 !important;
}

/* Empty State */
.empty-state-custom {
    text-align: center !important;
    padding: 2rem 1rem !important;
    color: #6c757d !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-header-custom {
        padding: 2rem 0 1.5rem !important;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
    
    .role-badge-container-custom {
        text-align: center !important;
        margin-top: 1rem !important;
    }
    
    .avatar-circle-custom {
        width: 80px !important;
        height: 80px !important;
        font-size: 2rem !important;
    }
    
    .stat-number-custom {
        font-size: 1.5rem !important;
    }
}
</style>
@endsection