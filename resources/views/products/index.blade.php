@extends('layouts.app')

@section('title', 'Products')

@section('content')
<!-- Page Header -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">Our Products</h1>
                <p class="lead text-muted">Discover premium Taekwondo equipment for all skill levels</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <span class="badge bg-primary fs-6">{{ $products->total() }} Products</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        <!-- Category Filter -->
                        <div class="mb-4">
                            <label for="category" class="form-label fw-bold">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">All Categories</option>
                                <option value="dobok" {{ request('category') == 'dobok' ? 'selected' : '' }}>
                                    <i class="fas fa-tshirt me-2"></i>Dobok
                                </option>
                                <option value="belt" {{ request('category') == 'belt' ? 'selected' : '' }}>
                                    <i class="fas fa-ribbon me-2"></i>Belt
                                </option>
                                <option value="protection" {{ request('category') == 'protection' ? 'selected' : '' }}>
                                    <i class="fas fa-shield-alt me-2"></i>Protection
                                </option>
                                <option value="accessories" {{ request('category') == 'accessories' ? 'selected' : '' }}>
                                    <i class="fas fa-plus me-2"></i>Accessories
                                </option>
                            </select>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Price Range</label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="min_price" class="form-label small">Min Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="min_price" name="min_price" 
                                            value="{{ request('min_price') }}" min="0" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="max_price" class="form-label small">Max Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="max_price" name="max_price" 
                                            value="{{ request('max_price') }}" min="0" placeholder="1000000">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sort Filter -->
                        <div class="mb-4">
                            <label for="sort" class="form-label fw-bold">Sort By</label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="">Default</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Apply Filters
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-2"></i>Clear Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Categories -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0"><i class="fas fa-th-large me-2"></i>Quick Categories</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('products.index', ['category' => 'dobok']) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-tshirt me-2 text-primary"></i>Dobok</span>
                            <span class="badge bg-primary rounded-pill">{{ $products->where('category', 'dobok')->count() }}</span>
                        </a>
                        <a href="{{ route('products.index', ['category' => 'belt']) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-ribbon me-2 text-warning"></i>Belts</span>
                            <span class="badge bg-warning rounded-pill">{{ $products->where('category', 'belt')->count() }}</span>
                        </a>
                        <a href="{{ route('products.index', ['category' => 'protection']) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-shield-alt me-2 text-success"></i>Protection</span>
                            <span class="badge bg-success rounded-pill">{{ $products->where('category', 'protection')->count() }}</span>
                        </a>
                        <a href="{{ route('products.index', ['category' => 'accessories']) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-plus me-2 text-info"></i>Accessories</span>
                            <span class="badge bg-info rounded-pill">{{ $products->where('category', 'accessories')->count() }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <!-- Active Filters Display -->
            @if(request()->hasAny(['category', 'min_price', 'max_price', 'sort']))
                <div class="mb-4">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="fw-bold">Active Filters:</span>
                        @if(request('category'))
                            <span class="badge bg-primary">
                                Category: {{ ucfirst(request('category')) }}
                                <a href="{{ route('products.index', request()->except('category')) }}" class="text-white ms-1">×</a>
                            </span>
                        @endif
                        @if(request('min_price'))
                            <span class="badge bg-success">
                                Min: Rp {{ number_format(request('min_price'), 0, ',', '.') }}
                                <a href="{{ route('products.index', request()->except('min_price')) }}" class="text-white ms-1">×</a>
                            </span>
                        @endif
                        @if(request('max_price'))
                            <span class="badge bg-success">
                                Max: Rp {{ number_format(request('max_price'), 0, ',', '.') }}
                                <a href="{{ route('products.index', request()->except('max_price')) }}" class="text-white ms-1">×</a>
                            </span>
                        @endif
                        @if(request('sort'))
                            <span class="badge bg-info">
                                Sort: {{ str_replace('_', ' ', ucfirst(request('sort'))) }}
                                <a href="{{ route('products.index', request()->except('sort')) }}" class="text-white ms-1">×</a>
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Products Grid -->
            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card card-product h-100">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $product->name }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="card-title mb-0">{{ $product->name }}</h6>
                                    <span class="badge bg-secondary">{{ ucfirst($product->category) }}</span>
                                </div>
                                
                                <p class="text-primary fw-bold fs-5 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-box me-1"></i>Stock: {{ $product->stock }}
                                        </small>
                                        @if($product->brand)
                                            <small class="text-muted">{{ $product->brand }}</small>
                                        @endif
                                    </div>
                                    @if($product->size)
                                        <small class="text-muted">
                                            <i class="fas fa-ruler me-1"></i>Size: {{ $product->size }}
                                        </small>
                                    @endif
                                </div>
                                
                                <p class="card-text text-muted small mb-3 flex-grow-1">
                                    {{ Str::limit($product->description, 80) }}
                                </p>
                                
                                <div class="mt-auto">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary-custom w-100">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                            
                            @if($product->stock <= 5 && $product->stock > 0)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-warning">Low Stock</span>
                                </div>
                            @elseif($product->stock == 0)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-danger">Out of Stock</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">No products found</h4>
                            <p class="text-muted">Try adjusting your filters or browse all categories</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">
                                <i class="fas fa-th-large me-2"></i>View All Products
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.card-product {
    position: relative;
    overflow: hidden;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.badge a {
    text-decoration: none;
}

.badge a:hover {
    text-decoration: underline;
}
</style>
@endsection
