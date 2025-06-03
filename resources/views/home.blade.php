@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1 class="display-4">Welcome to Taekwondo Shop</h1>
            <p class="lead">Your one-stop shop for all Taekwondo equipment needs</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Featured Products</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        @foreach($featuredProducts as $product)
            <div class="col-md-3 mb-4">
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
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg">View All Products</a>
        </div>
    </div>
</div>
@endsection 