@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Products</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Filters</div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">All Categories</option>
                                <option value="dobok" {{ request('category') == 'dobok' ? 'selected' : '' }}>Dobok</option>
                                <option value="belt" {{ request('category') == 'belt' ? 'selected' : '' }}>Belt</option>
                                <option value="protection" {{ request('category') == 'protection' ? 'selected' : '' }}>Protection</option>
                                <option value="accessories" {{ request('category') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="min_price" class="form-label">Min Price</label>
                            <input type="number" class="form-control" id="min_price" name="min_price" 
                                value="{{ request('min_price') }}" min="0">
                        </div>

                        <div class="mb-3">
                            <label for="max_price" class="form-label">Max Price</label>
                            <input type="number" class="form-control" id="max_price" name="max_price" 
                                value="{{ request('max_price') }}" min="0">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No image available">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted">{{ $product->category }}</p>
                                <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="card-text">
                                    <small class="text-muted">Stock: {{ $product->stock }}</small>
                                </p>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No products found matching your criteria.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 