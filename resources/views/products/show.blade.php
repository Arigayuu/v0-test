@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/600x400" class="img-fluid rounded" alt="No image available">
            @endif
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">Category: {{ $product->category }}</p>
            <p class="h3 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p>{{ $product->description }}</p>
            
            <div class="mb-3">
                <strong>Brand:</strong> {{ $product->brand }}
            </div>
            <div class="mb-3">
                <strong>Size:</strong> {{ $product->size }}
            </div>
            <div class="mb-3">
                <strong>Stock:</strong> {{ $product->stock }}
            </div>

            @auth
                <form action="{{ route('orders.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                            id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="{{ $product->stock }}" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="shipping_address" class="form-label">Shipping Address</label>
                        <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                            id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address', Auth::user()->address) }}</textarea>
                        @error('shipping_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select @error('payment_method') is-invalid @enderror" 
                            id="payment_method" name="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Order Now</button>
                </form>
            @else
                <div class="alert alert-info mt-4">
                    Please <a href="{{ route('login') }}">login</a> to place an order.
                </div>
            @endauth
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Reviews</h3>
            <hr>

            @auth
                <form action="{{ route('reviews.store', $product) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-select @error('rating') is-invalid @enderror" 
                            id="rating" name="rating" required>
                            <option value="">Select Rating</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" 
                            id="comment" name="comment" rows="3" required>{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            @endif

            @forelse($product->reviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">{{ $review->user->name }}</h5>
                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="card-text">{{ $review->comment }}</p>
                        <p class="card-text">
                            <small class="text-muted">{{ $review->created_at->format('F d, Y') }}</small>
                        </p>
                        @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->id() === $review->user_id))
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure you want to delete this review?')">
                                    Delete Review
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    No reviews yet. Be the first to review this product!
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
