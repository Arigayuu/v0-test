@extends('layouts.admin')

@section('title', 'Add New Product')
@section('page-title', 'Add New Product')

@section('styles')
{{-- Re-use the styles from previous product pages for consistency --}}
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
    --blue-600: #2563eb;
    --orange-600: #ea580c;
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

.btn-danger-modern {
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-danger-modern:hover {
    background: linear-gradient(135deg, #dc2626 0%, var(--danger-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
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
    border-radius: 12px 12px 0 0;
}

.modern-card-header-info {
    background: linear-gradient(135deg, var(--info-color) 0%, #0284c7 100%);
    padding: 1.5rem;
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
}

.modern-card-header-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    padding: 1.5rem;
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
}

.modern-card-body {
    padding: 1.5rem;
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

/* Form Group Styling */
.form-label {
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.5rem;
    display: block;
}

.form-control,
.form-select {
    border-radius: 8px;
    border: 1px solid var(--gray-300);
    padding: 0.75rem 1rem;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.03);
    transition: all 0.2s ease-in-out;
    color: var(--gray-800);
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    outline: none;
}

.form-control.is-invalid,
.form-select.is-invalid {
    border-color: var(--danger-color);
}

.invalid-feedback {
    color: var(--danger-color);
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.input-group-text {
    background-color: var(--gray-100);
    border: 1px solid var(--gray-300);
    border-right: none;
    border-radius: 8px 0 0 8px;
    color: var(--gray-600);
    padding: 0.75rem 1rem;
}

.input-group .form-control {
    border-radius: 0 8px 8px 0;
}

.input-group .form-control:focus {
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2), inset 0 1px 2px rgba(0, 0, 0, 0.03);
}

/* Image Preview */
.image-preview {
    border: 2px dashed var(--gray-300);
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    background-color: var(--gray-50);
    height: 200px; /* Fixed height for consistency */
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden; /* Ensure image doesn't overflow */
}

.image-preview img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* Ensures the image is scaled correctly */
    border-radius: 4px;
}

.form-text {
    font-size: 0.85rem;
    color: var(--gray-500);
    margin-top: 0.25rem;
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

    .image-preview {
        height: 150px;
    }
}

@media (max-width: 575.98px) {
    .breadcrumb-item {
        font-size: 0.75rem;
    }

    .input-group .form-control,
    .input-group-text {
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
    }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header animate-fade-in">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="page-title">Add New Product</h4>
                <p class="page-subtitle">Fill in the details to add a new product to your inventory.</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Add New Product</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn-secondary-modern">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Products</span>
            </a>
        </div>
    </div>

    <div class="modern-card animate-fade-in animation-delay-100">
        <div class="modern-card-header">
            <h5 class="modern-card-title">
                <i class="fas fa-plus-circle me-2"></i>Product Information
            </h5>
        </div>
        <div class="modern-card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
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
                                      required>{{ old('description') }}</textarea>
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
                                           value="{{ old('price') }}"
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
                                       value="{{ old('stock') }}"
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
                                    <option value="dobok" {{ old('category') == 'dobok' ? 'selected' : '' }}>Dobok</option>
                                    <option value="belt" {{ old('category') == 'belt' ? 'selected' : '' }}>Belt</option>
                                    <option value="protection" {{ old('category') == 'protection' ? 'selected' : '' }}>Protection</option>
                                    <option value="accessories" {{ old('category') == 'accessories' ? 'selected' : '' }}>Accessories</option>
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
                                       value="{{ old('brand') }}">
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
                                       value="{{ old('size') }}"
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
                            <input class="form-control @error('image') is-invalid @enderror"
                                   type="file"
                                   id="image"
                                   name="image"
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Supported formats: JPG, PNG, GIF. Max size: 2MB</div>
                        </div>

                        <div class="image-preview mt-3" id="imagePreview">
                            <img id="preview" src="{{ asset('img/placeholder.svg') }}" alt="Preview" class="img-fluid rounded">
                            <p class="text-muted mt-2 mb-0" id="imagePlaceholderText">Image Preview</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary-modern">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>
                    <button type="submit" class="btn-modern">
                        <i class="fas fa-save"></i>
                        <span>Add Product</span>
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
    const imagePlaceholderText = document.getElementById('imagePlaceholderText');

    // Set initial state for the preview
    if (!imagePreview.src || imagePreview.src.includes('placeholder.svg')) {
        imagePreview.style.display = 'none'; // Hide the image itself if no real image
        imagePlaceholderText.style.display = 'block'; // Show the placeholder text
    } else {
        imagePreview.style.display = 'block'; // Show the image if there is one
        imagePlaceholderText.style.display = 'none'; // Hide the placeholder text
    }

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show image
                imagePlaceholderText.style.display = 'none'; // Hide text
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '{{ asset('img/placeholder.svg') }}'; // Reset to placeholder
            imagePreview.style.display = 'none'; // Hide image
            imagePlaceholderText.style.display = 'block'; // Show text
        }
    });
});
</script>
@endsection