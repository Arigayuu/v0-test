@extends('layouts.app')

@section('title', 'Our Products') {{-- Judul halaman lebih deskriptif --}}

@section('content')
<section class="bg-light py-5" style="margin-top: 40px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold mb-3 text-dark">Discover Our Premium Products</h1> {{-- Heading lebih menarik --}}
                <p class="lead text-muted">Explore a wide range of high-quality Taekwondo equipment for all skill levels and needs.</p> {{-- Deskripsi lebih lengkap --}}
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <span class="badge bg-primary fs-6 py-2 px-3 rounded-pill shadow-sm">
                        <i class="fas fa-boxes me-2"></i>{{ $products->total() }} Products
                    </span> {{-- Badge lebih gaya --}}
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm border-0 rounded-lg"> {{-- Card lebih rapi --}}
                <div class="card-header bg-primary text-white fw-bold py-3 rounded-top-lg d-flex align-items-center"> {{-- Header lebih stylish --}}
                    <i class="fas fa-filter me-2 fs-5"></i>
                    <h5 class="mb-0">Product Filters</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="mb-4 pb-2 border-bottom"> {{-- Border dan padding untuk pemisah filter --}}
                            <label for="category" class="form-label fw-bold text-dark mb-2">Category</label>
                            <select class="form-select form-select-sm" id="category" name="category"> {{-- Ukuran select lebih kecil --}}
                                <option value="">All Categories</option>
                                <option value="dobok" {{ request('category') == 'dobok' ? 'selected' : '' }}>
                                    <i class="fas fa-tshirt me-2 text-info"></i>Dobok
                                </option>
                                <option value="belt" {{ request('category') == 'belt' ? 'selected' : '' }}>
                                    <i class="fas fa-ribbon me-2 text-warning"></i>Belt
                                </option>
                                <option value="protection" {{ request('category') == 'protection' ? 'selected' : '' }}>
                                    <i class="fas fa-shield-alt me-2 text-success"></i>Protection
                                </option>
                                <option value="accessories" {{ request('category') == 'accessories' ? 'selected' : '' }}>
                                    <i class="fas fa-plus me-2 text-danger"></i>Accessories
                                </option>
                            </select>
                        </div>

                        <div class="mb-4 pb-2 border-bottom">
                            <label class="form-label fw-bold text-dark mb-2">Price Range</label>
                            <div class="row g-2"> {{-- Gap antar kolom lebih rapi --}}
                                <div class="col-6">
                                    <label for="min_price" class="form-label small text-muted">Min Price</label>
                                    <div class="input-group input-group-sm"> {{-- Ukuran input lebih kecil --}}
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="min_price" name="min_price" 
                                            value="{{ request('min_price') }}" min="0" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="max_price" class="form-label small text-muted">Max Price</label>
                                    <div class="input-group input-group-sm"> {{-- Ukuran input lebih kecil --}}
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="max_price" name="max_price" 
                                            value="{{ request('max_price') }}" min="0" placeholder="1.000.000">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4"> {{-- Tidak ada border bottom pada filter terakhir --}}
                            <label for="sort" class="form-label fw-bold text-dark mb-2">Sort By</label>
                            <select class="form-select form-select-sm" id="sort" name="sort"> {{-- Ukuran select lebih kecil --}}
                                <option value="">Default (Newest)</option> {{-- Teks default lebih jelas --}}
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2 mt-4"> {{-- Margin top lebih besar --}}
                            <button type="submit" class="btn btn-primary btn-block py-2"> {{-- Tombol lebih lebar --}}
                                <i class="fas fa-filter me-2"></i>Apply Filters
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-block py-2">
                                <i class="fas fa-sync-alt me-2"></i>Clear Filters
                            </a> {{-- Ikon refresh --}}
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4 border-0 rounded-lg">
                <div class="card-header bg-secondary text-white fw-bold py-3 rounded-top-lg d-flex align-items-center">
                    <i class="fas fa-th-large me-2 fs-5"></i>
                    <h6 class="mb-0">Quick Categories</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush rounded-bottom-lg"> {{-- Rounded bottom --}}
                        <a href="{{ route('products.index', ['category' => 'dobok']) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3"> {{-- Padding lebih besar --}}
                            <span><i class="fas fa-tshirt me-2 text-primary"></i>Dobok</span>
                            <span class="badge bg-primary rounded-pill">{{ $products->where('category', 'dobok')->count() }}</span>
                        </a>
                        <a href="{{ route('products.index', ['category' => 'belt']) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                            <span><i class="fas fa-ribbon me-2 text-warning"></i>Belts</span>
                            <span class="badge bg-warning rounded-pill">{{ $products->where('category', 'belt')->count() }}</span>
                        </a>
                        <a href="{{ route('products.index', ['category' => 'protection']) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                            <span><i class="fas fa-shield-alt me-2 text-success"></i>Protection</span>
                            <span class="badge bg-success rounded-pill">{{ $products->where('category', 'protection')->count() }}</span>
                        </a>
                        <a href="{{ route('products.index', ['category' => 'accessories']) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                            <span><i class="fas fa-plus me-2 text-info"></i>Accessories</span>
                            <span class="badge bg-info rounded-pill">{{ $products->where('category', 'accessories')->count() }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            @if(request()->hasAny(['category', 'min_price', 'max_price', 'sort']))
                <div class="mb-4 p-3 bg-light border rounded-lg shadow-sm"> {{-- Box untuk filter aktif --}}
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="fw-bold text-dark me-2"><i class="fas fa-tags me-1"></i>Active Filters:</span>
                        @if(request('category'))
                            <span class="badge bg-primary py-2 px-3 rounded-pill">
                                Category: **{{ ucfirst(request('category')) }}**
                                <a href="{{ route('products.index', request()->except('category')) }}" class="text-white ms-1 text-decoration-none fw-bold" style="font-size: 0.9em;">&times;</a>
                            </span>
                        @endif
                        @if(request('min_price'))
                            <span class="badge bg-success py-2 px-3 rounded-pill">
                                Min Price: **Rp {{ number_format(request('min_price'), 0, ',', '.') }}**
                                <a href="{{ route('products.index', request()->except('min_price')) }}" class="text-white ms-1 text-decoration-none fw-bold" style="font-size: 0.9em;">&times;</a>
                            </span>
                        @endif
                        @if(request('max_price'))
                            <span class="badge bg-success py-2 px-3 rounded-pill">
                                Max Price: **Rp {{ number_format(request('max_price'), 0, ',', '.') }}**
                                <a href="{{ route('products.index', request()->except('max_price')) }}" class="text-white ms-1 text-decoration-none fw-bold" style="font-size: 0.9em;">&times;</a>
                            </span>
                        @endif
                        @if(request('sort'))
                            <span class="badge bg-info py-2 px-3 rounded-pill">
                                Sort By: **{{ str_replace('_', ' ', ucfirst(request('sort'))) }}**
                                <a href="{{ route('products.index', request()->except('sort')) }}" class="text-white ms-1 text-decoration-none fw-bold" style="font-size: 0.9em;">&times;</a>
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4"> {{-- Penyesuaian kolom untuk responsivitas lebih baik --}}
                        <div class="card card-product h-100 shadow-sm border-0 rounded-lg overflow-hidden"> {{-- Card lebih halus dan overflow hidden untuk gambar --}}
                            @if($product->image)
                                <div class="product-img-wrapper" style="height: 220px; overflow: hidden;"> {{-- Wrapper gambar --}}
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         class="card-img-top img-fluid" {{-- img-fluid untuk responsivitas --}}
                                         alt="{{ $product->name }}"
                                         style="object-fit: cover; width: 100%; height: 100%;">
                                </div>
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                    <i class="fas fa-box-open text-muted" style="font-size: 4rem;"></i> {{-- Ikon lebih relevan --}}
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column p-3"> {{-- Padding card body --}}
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="card-title fw-bold text-dark mb-0">{{ Str::limit($product->name, 40) }}</h6> {{-- Batasi panjang nama --}}
                                    <span class="badge bg-secondary text-white py-1 px-2 rounded-pill">{{ ucfirst($product->category) }}</span> {{-- Badge kategori --}}
                                </div>
                                
                                <p class="text-primary fw-bolder fs-4 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p> {{-- Harga lebih besar --}}
                                
                                <div class="mb-3 small">
                                    <div class="d-flex justify-content-between align-items-center text-muted">
                                        <span><i class="fas fa-cubes me-1"></i>Stock: **{{ $product->stock }}**</span> {{-- Bold stock --}}
                                        @if($product->brand)
                                            <span class="text-info"><i class="fas fa-tag me-1"></i>{{ $product->brand }}</span> {{-- Brand dengan ikon --}}
                                        @endif
                                    </div>
                                    @if($product->size)
                                        <div class="mt-1 text-muted">
                                            <span><i class="fas fa-ruler-combined me-1"></i>Size: **{{ $product->size }}**</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <p class="card-text text-muted small mb-3 flex-grow-1">
                                    {{ Str::limit($product->description, 80) }}
                                </p>
                                
                                <div class="mt-auto">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary-custom w-100 py-2">
                                        <i class="fas fa-info-circle me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                            
                            {{-- Badge status stok --}}
                            @if($product->stock <= 5 && $product->stock > 0)
                                <div class="position-absolute top-0 start-0 m-2"> {{-- Pindah ke kiri atas --}}
                                    <span class="badge bg-warning text-dark py-2 px-3 rounded-pill shadow-sm">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Low Stock!
                                    </span>
                                </div>
                            @elseif($product->stock == 0)
                                <div class="position-absolute top-0 start-0 m-2"> {{-- Pindah ke kiri atas --}}
                                    <span class="badge bg-danger text-white py-2 px-3 rounded-pill shadow-sm">
                                        <i class="fas fa-times-circle me-1"></i>Out of Stock
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 border rounded-lg bg-light shadow-sm">
                            <i class="fas fa-box-open fa-5x text-muted mb-4"></i> {{-- Ikon lebih besar dan relevan --}}
                            <h4 class="text-dark mb-3">No products found matching your criteria.</h4>
                            <p class="text-muted mb-4">It seems we couldn't find any items that fit your current selection. Please try adjusting your filters or clear them to see all available products.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-4"> {{-- Tombol lebih besar --}}
                                <i class="fas fa-redo me-2"></i>Show All Products
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }} {{-- Gunakan tema paginasi Bootstrap 5 --}}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
/* CSS Kustom untuk tampilan produk */
.card-product {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-product:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

/* Image wrapper to ensure consistent height and object-fit */
.product-img-wrapper {
    width: 100%;
    height: 220px; /* Consistent height for product images */
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa; /* Light background for placeholder */
}

.product-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures image covers the area without distortion */
}

.list-group-item:hover {
    background-color: #e9ecef; /* Warna latar belakang saat hover pada item kategori cepat */
    color: #495057; /* Ubah warna teks saat hover */
}

.badge a {
    text-decoration: none;
    color: inherit; /* Inherit color from parent for consistency */
}

.badge a:hover {
    text-decoration: underline;
}

/* Custom button style for primary-custom, if not defined in app.css */
.btn-primary-custom {
    background-color: #007bff; /* Bootstrap primary blue */
    border-color: #007bff;
    color: #fff;
    font-weight: 600;
}

.btn-primary-custom:hover {
    background-color: #0056b3; /* Darker blue on hover */
    border-color: #0056b3;
    transform: translateY(-1px); /* Slight lift on hover */
}

/* Rounded corners for cards */
.rounded-lg {
    border-radius: 0.5rem !important; /* Larger border-radius */
}
.rounded-top-lg {
    border-top-left-radius: 0.5rem !important;
    border-top-right-radius: 0.5rem !important;
}
.rounded-bottom-lg {
    border-bottom-left-radius: 0.5rem !important;
    border-bottom-right-radius: 0.5rem !important;
}

/* Custom style for filter section borders */
.border-bottom {
    border-bottom: 1px solid #e0e0e0 !important;
}

/* Custom background color for active filters box */
.bg-light.border.rounded-lg {
    background-color: #f8f9fa !important;
    border-color: #e9ecef !important;
}
</style>
@endsection