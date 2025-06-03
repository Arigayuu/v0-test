@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Product Details: {{ $product->name }}</h1>
        <div>
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning me-2">Edit Product</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Products</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/400x300" class="img-fluid rounded" alt="No image available">
                    @endif
                </div>
                <div class="col-md-8">
                    <h2>{{ $product->name }}</h2>
                    <p class="text-muted">{{ $product->category }}</p>
                    <h3 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p><strong>Brand:</strong> {{ $product->brand ?? '-' }}</p>
                    <p><strong>Size:</strong> {{ $product->size ?? '-' }}</p>
                    <hr>
                    <h4>Description</h4>
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section (Optional for Admin View, but good for completeness) -->
    <div class="card">
        <div class="card-header">
            <h5>Product Reviews ({{ $product->reviews->count() }})</h5>
        </div>
        <div class="card-body">
            @forelse($product->reviews as $review)
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between">
                        <h6>{{ $review->user->name }}</h6>
                        <small>{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                    <div>
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning"></i>
                        @endfor
                        ({{ $review->rating }}/5)
                    </div>
                    <p class="mb-1">{{ $review->comment }}</p>
                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this review?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete Review</button>
                    </form>
                </div>
            @empty
                <p class="text-muted">No reviews yet.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
