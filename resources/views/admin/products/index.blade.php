@extends('layouts.admin')

@section('title', 'Product Management')
@section('page-title', 'Product Management')

@section('styles')
<style>
/* Modern Product Management Page Styling */

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

.btn-success {
  background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
}

.btn-success:hover {
  background: linear-gradient(135deg, #059669 0%, var(--success-color) 100%);
  box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

/* Alert */
.alert-modern {
  border: none;
  border-radius: 12px;
  padding: 1rem 1.5rem;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.alert-success {
  background: rgba(16, 185, 129, 0.1);
  color: #059669;
  border-left: 4px solid var(--success-color);
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

.stat-card-danger {
  background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
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
  justify-content: space-between;
}

.modern-card-body {
  padding: 1.5rem;
}

/* Filter Section */
.filter-section {
  background: white;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  margin-bottom: 1.5rem;
}

.filter-row {
  display: flex;
  gap: 1rem;
  align-items: end;
  flex-wrap: wrap;
}

.filter-group {
  flex: 1;
  min-width: 200px;
}

.filter-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: var(--gray-600);
  font-size: 0.875rem;
}

.filter-input {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 2px solid var(--gray-300);
  border-radius: 8px;
  font-size: 0.875rem;
  transition: all 0.15s ease-in-out;
}

.filter-input:focus {
  border-color: var(--primary-color);
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
}

.btn-filter {
  background: white;
  color: var(--primary-color);
  border: 2px solid var(--primary-color);
  border-radius: 8px;
  padding: 0.75rem 1rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-filter:hover {
  background: var(--primary-color);
  color: white;
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

/* Product Image */
.product-image {
  width: 60px;
  height: 60px;
  border-radius: 8px;
  object-fit: cover;
  border: 2px solid var(--gray-100);
  transition: all 0.3s ease;
}

.product-image:hover {
  transform: scale(1.1);
  border-color: var(--primary-color);
}

.product-name {
  font-weight: 700;
  color: var(--dark-color);
  margin: 0;
}

.product-description {
  font-size: 0.875rem;
  color: var(--gray-500);
  margin: 0;
}

/* Category Badge */
.category-badge {
  padding: 0.25rem 0.75rem;
  font-size: 0.75rem;
  font-weight: 600;
  border-radius: 6px;
  text-transform: capitalize;
}

.category-uniform {
  background-color: rgba(79, 70, 229, 0.1);
  color: var(--primary-color);
}

.category-equipment {
  background-color: rgba(16, 185, 129, 0.1);
  color: var(--success-color);
}

.category-accessories {
  background-color: rgba(245, 158, 11, 0.1);
  color: var(--warning-color);
}

.category-books {
  background-color: rgba(6, 182, 212, 0.1);
  color: var(--info-color);
}

/* Price Display */
.price-display {
  font-weight: 700;
  color: var(--success-color);
  font-size: 1rem;
}

/* Stock Badge */
.stock-badge {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
  font-weight: 600;
  border-radius: 6px;
}

.stock-high {
  background-color: rgba(16, 185, 129, 0.1);
  color: var(--success-color);
}

.stock-medium {
  background-color: rgba(245, 158, 11, 0.1);
  color: var(--warning-color);
}

.stock-low {
  background-color: rgba(239, 68, 68, 0.1);
  color: var(--danger-color);
}

.stock-out {
  background-color: rgba(107, 114, 128, 0.1);
  color: var(--gray-500);
}

/* Action Buttons */
.action-buttons {
  display: flex;
  gap: 0.25rem;
}

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
}

.btn-action-info {
  border-color: var(--info-color);
  color: var(--info-color);
}

.btn-action-info:hover {
  background: var(--info-color);
  color: white;
}

.btn-action-warning {
  border-color: var(--warning-color);
  color: var(--warning-color);
}

.btn-action-warning:hover {
  background: var(--warning-color);
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
  padding: 4rem 1rem;
}

.empty-icon {
  font-size: 4rem;
  color: var(--gray-300);
  margin-bottom: 1rem;
}

.empty-text {
  color: var(--gray-500);
  font-size: 1.125rem;
  margin: 0 0 1rem;
}

.empty-subtext {
  color: var(--gray-400);
  font-size: 0.875rem;
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

/* Responsive Design */
@media (max-width: 767.98px) {
  .page-header {
    padding: 1rem;
  }

  .page-header .d-flex {
    flex-direction: column;
    align-items: flex-start !important;
    gap: 1rem;
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

  .filter-section {
    padding: 1rem;
  }

  .filter-row {
    flex-direction: column;
    align-items: stretch;
  }

  .filter-group {
    min-width: auto;
  }

  .modern-table th,
  .modern-table td {
    padding: 0.75rem 0.5rem;
    font-size: 0.875rem;
  }

  .product-image {
    width: 40px;
    height: 40px;
  }

  .btn-action {
    width: 28px;
    height: 28px;
    font-size: 0.75rem;
  }

  .action-buttons {
    flex-direction: column;
    gap: 0.125rem;
  }
}

@media (max-width: 575.98px) {
  .modern-table-responsive {
    font-size: 0.75rem;
  }

  .stat-card {
    text-align: left;
  }

  .stat-icon {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
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
                <h4 class="page-title">Product Management</h4>
                <p class="page-subtitle">Manage your product inventory and details</p>
            </div>
            <div>
                <a href="{{ route('admin.products.create') }}" class="btn-modern btn-success">
                    <i class="fas fa-plus"></i>
                    <span>Add New Product</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert-modern alert-success animate-fade-in">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Product Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card stat-card-primary animate-fade-in">
                <i class="fas fa-box stat-icon"></i>
                <div class="stat-value">{{ $products->total() }}</div>
                <p class="stat-label">Total Products</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card stat-card-success animate-fade-in animation-delay-100">
                <i class="fas fa-check-circle stat-icon"></i>
                <div class="stat-value">{{ $products->where('stock', '>', 10)->count() }}</div>
                <p class="stat-label">In Stock</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card stat-card-warning animate-fade-in animation-delay-200">
                <i class="fas fa-exclamation-triangle stat-icon"></i>
                <div class="stat-value">{{ $products->where('stock', '<=', 10)->where('stock', '>', 0)->count() }}</div>
                <p class="stat-label">Low Stock</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card stat-card-danger animate-fade-in animation-delay-300">
                <i class="fas fa-times-circle stat-icon"></i>
                <div class="stat-value">{{ $products->where('stock', 0)->count() }}</div>
                <p class="stat-label">Out of Stock</p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section animate-fade-in animation-delay-200">
        <form method="GET" action="{{ route('admin.products.index') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label class="filter-label">Search Products</label>
                    <input type="text" 
                           name="search" 
                           class="filter-input" 
                           placeholder="Search by name or description..."
                           value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Category</label>
                    <select name="category" class="filter-input">
                        <option value="">All Categories</option>
                        <option value="uniform" {{ request('category') === 'uniform' ? 'selected' : '' }}>Uniform</option>
                        <option value="equipment" {{ request('category') === 'equipment' ? 'selected' : '' }}>Equipment</option>
                        <option value="accessories" {{ request('category') === 'accessories' ? 'selected' : '' }}>Accessories</option>
                        <option value="books" {{ request('category') === 'books' ? 'selected' : '' }}>Books</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Stock Status</label>
                    <select name="stock_status" class="filter-input">
                        <option value="">All Stock</option>
                        <option value="in_stock" {{ request('stock_status') === 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="low_stock" {{ request('stock_status') === 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                        <option value="out_of_stock" {{ request('stock_status') === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="modern-card animate-fade-in animation-delay-300">
        <div class="modern-card-header">
            <h5 class="modern-card-title">
                <span>
                    <i class="fas fa-boxes me-2"></i>All Products
                </span>
                <span class="badge-modern badge-dark">{{ $products->total() }} items</span>
            </h5>
        </div>
        <div class="modern-card-body">
            <div class="modern-table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td><strong>#{{ $product->id }}</strong></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="product-image me-3">
                                        @else
                                            <div class="product-image me-3 d-flex align-items-center justify-content-center bg-light">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="product-name">{{ $product->name }}</div>
                                            @if($product->description)
                                                <div class="product-description">{{ Str::limit($product->description, 50) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="category-badge category-{{ $product->category }}">
                                        {{ ucfirst($product->category) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="price-display">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                </td>
                                <td>
                                    <span class="stock-badge {{ $product->stock > 10 ? 'stock-high' : ($product->stock > 0 ? ($product->stock <= 5 ? 'stock-low' : 'stock-medium') : 'stock-out') }}">
                                        {{ $product->stock }} units
                                    </span>
                                </td>
                                <td>
                                    @if($product->stock > 0)
                                        <span class="badge-modern badge-success">
                                            <i class="fas fa-check-circle"></i>
                                            Available
                                        </span>
                                    @else
                                        <span class="badge-modern badge-danger">
                                            <i class="fas fa-times-circle"></i>
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.products.show', $product) }}" 
                                           class="btn-action btn-action-info"
                                           title="View Product">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="btn-action btn-action-warning"
                                           title="Edit Product">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn-action btn-action-danger" 
                                                onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')"
                                                title="Delete Product">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-box-open empty-icon"></i>
                                    <p class="empty-text">No products found</p>
                                    <p class="empty-subtext">Start by adding your first product to the inventory</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
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
                <p>Are you sure you want to delete product <strong id="productName"></strong>?</p>
                <div class="alert alert-danger d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span>This action cannot be undone and will remove all associated data.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmDelete(productId, productName) {
    document.getElementById('productName').textContent = productName;
    document.getElementById('deleteForm').action = `/admin/products/${productId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// Auto-submit filter form on select change
document.addEventListener('DOMContentLoaded', function() {
    const filterSelects = document.querySelectorAll('select[name="category"], select[name="stock_status"]');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
});
</script>
@endsection
