@extends('layouts.admin')

@section('title', 'User Details')
@section('page-title', 'User Details: ' . $user->name)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">{{ $user->name }}</li>
                </ol>
            </nav>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Users
            </a>
        </div>

        <div class="row">
            <!-- User Information -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>User Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="avatar-lg bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-user fa-3x text-white"></i>
                            </div>
                            <h4>{{ $user->name }}</h4>
                            <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }} fs-6">
                                <i class="fas fa-{{ $user->role === 'admin' ? 'shield-alt' : 'user' }} me-1"></i>
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
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

                            <div class="mb-3">
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

                            <div class="mb-3">
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

                            <div class="mb-3">
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

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" 
                                          name="address" 
                                          rows="3">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i>Update User
                            </button>
                        </form>

                        <hr>
                        <div class="user-stats">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="stat-item">
                                        <h5 class="text-primary">{{ $orders->count() }}</h5>
                                        <small class="text-muted">Orders</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-item">
                                        <h5 class="text-success">{{ $reviews->count() }}</h5>
                                        <small class="text-muted">Reviews</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="user-meta">
                            <p class="mb-1"><strong>Member Since:</strong> {{ $user->created_at->format('F d, Y') }}</p>
                            <p class="mb-0"><strong>Last Updated:</strong> {{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Activity -->
            <div class="col-lg-8">
                <!-- Recent Orders -->
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Recent Orders</h5>
                        <span class="badge bg-light text-dark">{{ $orders->count() }} total</span>
                    </div>
                    <div class="card-body">
                        @if($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
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
                                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'processing' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($order->payment_status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order) }}" 
                                                       class="btn btn-sm btn-outline-info">
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
                            <div class="text-center py-4">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No orders found</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Reviews -->
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Recent Reviews</h5>
                        <span class="badge bg-dark">{{ $reviews->count() }} total</span>
                    </div>
                    <div class="card-body">
                        @if($reviews->count() > 0)
                            @foreach($reviews as $review)
                                <div class="review-item border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">
                                                <a href="{{ route('admin.products.show', $review->product) }}" class="text-decoration-none">
                                                    {{ $review->product->name }}
                                                </a>
                                            </h6>
                                            <div class="rating mb-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning"></i>
                                                @endfor
                                                <span class="ms-2 text-muted">({{ $review->rating }}/5)</span>
                                            </div>
                                            <p class="mb-1">{{ $review->comment }}</p>
                                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                        </div>
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
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
                            <div class="text-center py-4">
                                <i class="fas fa-star fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No reviews found</p>
                            </div>
                        @endif
                    </div>
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

.review-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}
</style>
@endsection
