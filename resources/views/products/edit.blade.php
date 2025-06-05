@extends('layouts.app')

@section('title', 'Edit Product') {{-- Judul halaman lebih spesifik --}}

@section('content')
<section class="bg-light py-4 border-bottom"> {{-- Section header lebih ringkas --}}
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-0 text-primary fw-bold">
                    <i class="fas fa-edit me-2"></i>Edit Product
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.show', $product) }}" class="text-decoration-none">{{ Str::limit($product->name, 20) }}</a></li> {{-- Tampilkan nama produk yang diedit --}}
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-2"></i>Back to Product Details
            </a> {{-- Tombol kembali ke detail produk --}}
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row justify-content-center"> {{-- Pusatkan kolom form --}}
        <div class="col-lg-8 col-md-10"> {{-- Lebar kolom disesuaikan --}}
            <div class="card shadow-lg border-0 rounded-lg"> {{-- Card dengan shadow dan border-radius lebih besar --}}
                <div class="card-header bg-primary text-white py-3 px-4 rounded-top-lg"> {{-- Header card lebih menonjol --}}
                    <h4 class="mb-0"><i class="fas fa-box-open me-2"></i>Update Product Information</h4>
                </div>
                <div class="card-body p-4"> {{-- Padding card body lebih besar --}}
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold text-dark">
                                <i class="fas fa-tag me-2 text-muted"></i>Product Name
                            </label>
                            <input type="text" class="form-control form-control-lg rounded-pill @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name', $product->name) }}" required 
                                placeholder="Enter product name"> {{-- Placeholder ditambahkan --}}
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold text-dark">
                                <i class="fas fa-align-left me-2 text-muted"></i>Description
                            </label>
                            <textarea class="form-control rounded-lg @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="5" required 
                                placeholder="Provide a detailed description of the product.">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3"> {{-- Menggunakan grid untuk layout 2 kolom --}}
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold text-dark">
                                    <i class="fas fa-dollar-sign me-2 text-muted"></i>Price
                                </label>
                                <div class="input-group input-group-lg rounded-pill overflow-hidden"> {{-- Input group lebih besar dan rounded --}}
                                    <span class="input-group-text bg-light border-end-0">Rp</span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                        id="price" name="price" value="{{ old('price', $product->price) }}" min="0" required 
                                        placeholder="e.g., 150000">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-bold text-dark">
                                    <i class="fas fa-box-open me-2 text-muted"></i>Stock
                                </label>
                                <input type="number" class="form-control form-control-lg rounded-pill @error('stock') is-invalid @enderror" 
                                    id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required 
                                    placeholder="e.g., 100">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="category" class="form-label fw-bold text-dark">
                                    <i class="fas fa-list-alt me-2 text-muted"></i>Category
                                </label>
                                <select class="form-select form-select-lg rounded-pill @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="dobok" {{ old('category', $product->category) == 'dobok' ? 'selected' : '' }}>Dobok</option>
                                    <option value="belt" {{ old('category', $product->category) == 'belt' ? 'selected' : '' }}>Belt</option>
                                    <option value="protection" {{ old('category', $product->category) == 'protection' ? 'selected' : '' }}>Protection</option>
                                    <option value="accessories" {{ old('category', $product->category) == 'accessories' ? 'selected' : '' }}>Accessories</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="brand" class="form-label fw-bold text-dark">
                                    <i class="fas fa-copyright me-2 text-muted"></i>Brand (Optional)
                                </label>
                                <input type="text" class="form-control form-control-lg rounded-pill @error('brand') is-invalid @enderror" 
                                    id="brand" name="brand" value="{{ old('brand', $product->brand) }}" 
                                    placeholder="e.g., Adidas, Nike">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="size" class="form-label fw-bold text-dark">
                                <i class="fas fa-ruler-combined me-2 text-muted"></i>Size (Optional)
                            </label>
                            <input type="text" class="form-control form-control-lg rounded-pill @error('size') is-invalid @enderror" 
                                id="size" name="size" value="{{ old('size', $product->size) }}" 
                                placeholder="e.g., S, M, L, XL or 120, 130">
                            @error('size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold text-dark">
                                <i class="fas fa-image me-2 text-muted"></i>Product Image
                            </label>
                            @if($product->image)
                                <div class="mb-3 d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image" class="img-thumbnail rounded shadow-sm" style="max-height: 150px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0">Current Image</p>
                                        <small class="text-secondary">Leave empty to keep the current image.</small>
                                    </div>
                                </div>
                            @else
                                <div class="mb-3">
                                    <div class="alert alert-info py-2 px-3 d-inline-flex align-items-center rounded-pill">
                                        <i class="fas fa-info-circle me-2"></i>No image uploaded yet.
                                    </div>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4"> {{-- Tombol full width --}}
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                <i class="fas fa-save me-2"></i>Update Product
                            </button>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary btn-lg rounded-pill">
                                <i class="fas fa-times-circle me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
/* CSS kustom untuk halaman edit produk */
.rounded-lg {
    border-radius: 0.5rem !important;
}
.rounded-top-lg {
    border-top-left-radius: 0.5rem !important;
    border-top-right-radius: 0.5rem !important;
}

.form-control.rounded-pill,
.form-select.rounded-pill {
    border-radius: 50rem !important; /* Membuat input dan select pill-shaped */
    padding-left: 1.25rem; /* Menambahkan padding agar tidak terlalu dekat dengan border */
    padding-right: 1.25rem;
}

.input-group.rounded-pill .input-group-text {
    border-top-left-radius: 50rem !important;
    border-bottom-left-radius: 50rem !important;
}

.input-group.rounded-pill .form-control {
    border-top-right-radius: 50rem !important;
    border-bottom-right-radius: 50rem !important;
}

/* Custom styles for button hovers */
.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 123, 255, 0.25) !important;
}

.btn-outline-secondary:hover {
    transform: translateY(-1px);
    box-shadow: 0 0.25rem 0.5rem rgba(108, 117, 125, 0.15) !important;
}

.img-thumbnail {
    border: 1px solid #dee2e6;
    padding: 0.25rem;
    background-color: #fff;
}
</style>
@endsection