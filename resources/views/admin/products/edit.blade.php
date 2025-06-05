@extends('layouts.admin')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('styles')
{{-- Re-use the styles from the product management page --}}
<style>
/* Modern Product Management Page Styling - Re-used for consistency */

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

.modern-card-header-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    padding: 1.5rem;
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0; /* Only top corners rounded for header */
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

/* Form Styling */
.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.form-control,
.form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--gray-300);
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.15s ease-in-out;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary-color);
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
}

.form-control.is-invalid,
.form-select.is-invalid {
    border-color: var(--danger-color);
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23ef4444'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23ef4444' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: var(--danger-color);
}

.input-group-text {
    padding: 0.75rem 1rem;
    border: 2px solid var(--gray-300);
    border-right: none;
    border-radius: 8px 0 0 8px;
    background-color: var(--gray-100);
    color: var(--gray-600);
    font-weight: 600;
}

.input-group .form-control {
    border-left: none;
    border-radius: 0 8px 8px 0;
}

.form-text {
    font-size: 0.875em;
    color: var(--gray-500);
    margin-top: 0.25rem;
}

.current-image img,
.image-preview img {
    max-width: 150px; /* Adjusted size for better visual */
    height: auto;
    border: 2px solid var(--gray-100);
    border-radius: 8px;
    object-fit: cover;
    margin-bottom: 0.5rem;
}

/* Breadcrumb Styling */
.breadcrumb {
    background: none;
    padding: 0;
    margin-bottom: 0;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.breadcrumb-item {
    font-size: 0.875rem;
    color: var(--gray-500);
}

.breadcrumb-item a {
    color: var(--primary-color);
    text-decoration: none;
    transition: color 0.2s ease;
}

.breadcrumb-item a:hover {
    color: var(--primary-color);
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: var(--gray-800);
    font-weight: 600;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    color: var(--gray-300);
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

    .btn-group {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-group .btn-modern,
    .btn-group .btn-info-modern,
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

    .current-image img,
    .image-preview img {
        max-width: 100px;
    }
}

@media (max-width: 575.98px) {
    .breadcrumb-item {
        font-size: 0.75rem;
    }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header animate-fade-in">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="page-title">{{ $product->name }}</h4>
                <p class="page-subtitle">Edit product details for {{ $product->name }}</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($product->name, 20) }}</li>
                    </ol>
                </nav>
            </div>
            <div class="btn-group">
                <a href="{{ route('admin.products.show', $product) }}" class="btn-info-modern">
                    <i class="fas fa-eye"></i>
                    <span>View Product</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary-modern">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Products</span>
                </a>
            </div>
        </div>
    </div>

    <div class="modern-card animate-fade-in animation-delay-100">
        <div class="modern-card-header-warning">
            <h5 class="modern-card-title">
                <i class="fas fa-edit me-2"></i>Edit Product Information
            </h5>
        </div>
        <div class="modern-card-body">
            @if(session('success'))
                <div class="alert-modern alert-success animate-fade-in mb-3">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $product->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number"
                                           class="form-control @error('price') is-invalid @enderror"
                                           id="price"
                                           name="price"
                                           value="{{ old('price', $product->price) }}"
                                           min="0"
                                           required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       id="stock"
                                       name="stock"
                                       value="{{ old('stock', $product->stock) }}"
                                       min="0"
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror"
                                        id="category"
                                        name="category"
                                        required>
                                    <option value="">Select Category</option>
                                    <option value="uniform" {{ old('category', $product->category) == 'uniform' ? 'selected' : '' }}>Uniform</option>
                                    <option value="equipment" {{ old('category', $product->category) == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                    <option value="accessories" {{ old('category', $product->category) == 'accessories' ? 'selected' : '' }}>Accessories</option>
                                    <option value="books" {{ old('category', $product->category) == 'books' ? 'selected' : '' }}>Books</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <input type="text"
                                       class="form-control @error('brand') is-invalid @enderror"
                                       id="brand"
                                       name="brand"
                                       value="{{ old('brand', $product->brand) }}">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input type="text"
                                       class="form-control @error('size') is-invalid @enderror"
                                       id="size"
                                       name="size"
                                       value="{{ old('size', $product->size) }}"
                                       placeholder="e.g., S, M, L, XL">
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            @if($product->image)
                                <div class="current-image mb-3">
                                    <label class="form-label">Current Image:</label>
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="img-fluid rounded border d-block">
                                </div>
                            @endif
                            <input class="form-control @error('image') is-invalid @enderror"
                                   type="file"
                                   id="image"
                                   name="image"
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to keep current image. Supported formats: JPG, PNG, GIF. Max size: 2MB</div>
                        </div>

                        <div class="image-preview mt-3" id="imagePreview" style="{{ $product->image ? 'display: none;' : '' }}">
                            <label class="form-label">New Image Preview:</label>
                            <img id="preview" src="{{ $product->image ? asset('storage/' . $product->image) : '/placeholder.svg' }}" alt="Preview" class="img-fluid rounded border">
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary-modern">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>
                    <button type="submit" class="btn-warning-modern">
                        <i class="fas fa-save"></i>
                        <span>Update Product</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreviewContainer = document.getElementById('imagePreview');
    const imagePreview = document.getElementById('preview');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            // If no file is selected, hide the preview and revert to current image or placeholder
            @if($product->image)
                imagePreview.src = "{{ asset('storage/' . $product->image) }}";
                imagePreviewContainer.style.display = 'none'; // Hide if current image is there and no new file selected
            @else
                imagePreview.src = "/placeholder.svg";
                imagePreviewContainer.style.display = 'none'; // Hide if no current image and no new file selected
            @endif
        }
    });
});
</script>
@endsection