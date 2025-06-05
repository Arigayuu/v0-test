@extends('layouts.admin')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('styles')
<style>
/* Modern User Management Page Styling */

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

/* Page Header */
.page-header {
  background: white;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  margin-bottom: 1.5rem;
  border: none;
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
}

.btn-modern:hover {
  background: linear-gradient(135deg, #6366f1 0%, var(--primary-color) 100%);
  color: white;
  transform: translateY(-1px);
  box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
}

/* Statistics Cards */
.stat-card {
  border-radius: 12px;
  padding: 1.5rem;
  color: white;
  transition: all 0.3s ease;
  border: none;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  text-align: center;
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

.stat-card-info {
  background: linear-gradient(135deg, var(--info-color) 0%, #0284c7 100%);
}

.stat-icon {
  font-size: 2rem;
  margin-bottom: 0.75rem;
  opacity: 0.9;
}

.stat-value {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.25rem;
}

.stat-label {
  font-size: 0.875rem;
  opacity: 0.9;
  margin: 0;
}

/* Modern Card */
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
  background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
  padding: 1.5rem;
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

/* User Avatar */
.user-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 0.875rem;
  margin-right: 0.75rem;
  flex-shrink: 0;
}

.user-info {
  display: flex;
  align-items: center;
}

.user-name {
  font-weight: 700;
  color: var(--dark-color);
  margin: 0;
}

/* Badges */
.badge-modern {
  padding: 0.375rem 0.75rem;
  font-size: 0.75rem;
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

.badge-info {
  background-color: rgba(6, 182, 212, 0.1);
  color: var(--info-color);
}

/* Contact Info */
.contact-info {
  font-size: 0.875rem;
  color: var(--gray-500);
  margin: 0;
}

.contact-info i {
  width: 12px;
  margin-right: 0.25rem;
}

/* Date Info */
.date-info {
  font-weight: 600;
  color: var(--dark-color);
  margin: 0;
}

.date-relative {
  font-size: 0.75rem;
  color: var(--gray-500);
  margin: 0;
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

/* Modal Styling */
.modal-content {
  border-radius: 12px;
  border: none;
  box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1);
}

.modal-header {
  background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
  color: white;
  border-bottom: none;
  border-radius: 12px 12px 0 0;
}

.modal-title {
  font-weight: 700;
}

.btn-close {
  filter: brightness(0) invert(1);
}

.modal-body {
  padding: 1.5rem;
}

.modal-footer {
  border-top: 1px solid var(--gray-100);
  padding: 1rem 1.5rem;
}

.btn-secondary {
  background: var(--gray-500);
  border: none;
  border-radius: 6px;
  padding: 0.5rem 1rem;
  font-weight: 600;
}

.btn-danger {
  background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
  border: none;
  border-radius: 6px;
  padding: 0.5rem 1rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-danger:hover {
  background: linear-gradient(135deg, #dc2626 0%, var(--danger-color) 100%);
  transform: translateY(-1px);
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
  .page-header {
    padding: 1rem;
  }

  .stat-card {
    padding: 1rem;
    margin-bottom: 1rem;
  }

  .stat-value {
    font-size: 1.5rem;
  }

  .modern-card-header,
  .modern-card-body {
    padding: 1rem;
  }

  .modern-table th,
  .modern-table td {
    padding: 0.75rem 0.5rem;
    font-size: 0.875rem;
  }

  .user-avatar {
    width: 32px;
    height: 32px;
    font-size: 0.75rem;
  }

  .btn-action {
    width: 28px;
    height: 28px;
    font-size: 0.75rem;
  }
}

@media (max-width: 575.98px) {
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
    <!-- Page Header -->
    <div class="page-header animate-fade-in">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="page-title">Manage Users</h4>
                <p class="page-subtitle">View and manage all registered users</p>
            </div>
            <div>
                <button class="btn-modern" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter me-2"></i>Filter Users
                </button>
            </div>
        </div>
    </div>

    <!-- User Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card stat-card-primary animate-fade-in">
                <i class="fas fa-users stat-icon"></i>
                <div class="stat-value">{{ $users->total() }}</div>
                <p class="stat-label">Total Users</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card stat-card-success animate-fade-in animation-delay-100">
                <i class="fas fa-user-check stat-icon"></i>
                <div class="stat-value">{{ $users->where('role', 'user')->count() }}</div>
                <p class="stat-label">Regular Users</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card stat-card-warning animate-fade-in animation-delay-200">
                <i class="fas fa-user-shield stat-icon"></i>
                <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
                <p class="stat-label">Administrators</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card stat-card-info animate-fade-in animation-delay-300">
                <i class="fas fa-user-plus stat-icon"></i>
                <div class="stat-value">{{ $users->where('created_at', '>=', now()->subDays(30))->count() }}</div>
                <p class="stat-label">New This Month</p>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="modern-card animate-fade-in animation-delay-300">
        <div class="modern-card-header">
            <h5 class="modern-card-title">
                <i class="fas fa-users me-2"></i>All Users
            </h5>
        </div>
        <div class="modern-card-body">
            <div class="modern-table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Contact</th>
                            <th>Joined</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td><strong>#{{ $user->id }}</strong></td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $user->name }}</div>
                                            @if($user->id === auth()->id())
                                                <span class="badge-modern badge-info">You</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge-modern {{ $user->role === 'admin' ? 'badge-danger' : 'badge-primary' }}">
                                        <i class="fas fa-{{ $user->role === 'admin' ? 'shield-alt' : 'user' }}"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="contact-info">
                                        <i class="fas fa-phone"></i>{{ $user->phone ?? 'Not provided' }}
                                    </div>
                                    <div class="contact-info">
                                        <i class="fas fa-map-marker-alt"></i>{{ $user->address ? Str::limit($user->address, 30) : 'Not provided' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="date-info">{{ $user->created_at->format('M d, Y') }}</div>
                                    <div class="date-relative">{{ $user->created_at->diffForHumans() }}</div>
                                </td>
                                <td>
                                    <span class="badge-modern badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.users.show', $user) }}" 
                                           class="btn-action btn-action-info"
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <button class="btn-action btn-action-danger" 
                                                    onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')"
                                                    title="Delete User">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-state">
                                    <i class="fas fa-users empty-icon"></i>
                                    <p class="empty-text">No users found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete user <strong id="userName"></strong>?</p>
                <div class="alert alert-danger d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span>This action cannot be undone.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmDelete(userId, userName) {
    document.getElementById('userName').textContent = userName;
    document.getElementById('deleteForm').action = `/admin/users/${userId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection
