@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Master Your Martial Arts Journey</h1>
                <p class="lead mb-4">Discover premium Taekwondo equipment and gear from trusted brands. Whether you're a beginner or a black belt, we have everything you need to excel in your martial arts practice.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('products.index') }}" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Shop Now
                    </a>
                    <a href="#featured" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-arrow-down me-2"></i>Explore
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image">
                    <i class="fas fa-fist-raised" style="font-size: 15rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-box p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-medal text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h5>Premium Quality</h5>
                    <p class="text-muted">Authentic equipment from renowned martial arts brands worldwide</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shipping-fast text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h5>Fast Delivery</h5>
                    <p class="text-muted">Quick and secure shipping to get your gear when you need it</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-users text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h5>Expert Support</h5>
                    <p class="text-muted">Get advice from martial arts practitioners and equipment experts</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section id="featured" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Featured Products</h2>
            <p class="lead text-muted">Handpicked equipment for serious martial artists</p>
        </div>

        <div class="row">
            @forelse($featuredProducts as $product)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-product">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="card-title mb-0">{{ $product->name }}</h6>
                                <span class="badge bg-secondary">{{ ucfirst($product->category) }}</span>
                            </div>
                            <p class="text-primary fw-bold fs-5 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="card-text text-muted small mb-3">
                                <i class="fas fa-box me-1"></i>Stock: {{ $product->stock }}
                            </p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary-custom w-100">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-box-open text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3 text-muted">No featured products available</h4>
                        <p class="text-muted">Check back soon for new arrivals!</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($featuredProducts->count() > 0)
            <div class="text-center mt-5">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-th-large me-2"></i>View All Products
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Shop by Category</h2>
            <p class="lead text-muted">Find exactly what you need for your training</p>
        </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <a href="{{ route('products.index', ['category' => 'dobok']) }}" class="text-decoration-none">
                    <div class="card text-center h-100 category-card">
                        <div class="card-body">
                            <i class="fas fa-tshirt text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5>Dobok</h5>
                            <p class="text-muted">Traditional uniforms for training and competition</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="{{ route('products.index', ['category' => 'belt']) }}" class="text-decoration-none">
                    <div class="card text-center h-100 category-card">
                        <div class="card-body">
                            <i class="fas fa-ribbon text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5>Belts</h5>
                            <p class="text-muted">Quality belts for all ranks and levels</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="{{ route('products.index', ['category' => 'protection']) }}" class="text-decoration-none">
                    <div class="card text-center h-100 category-card">
                        <div class="card-body">
                            <i class="fas fa-shield-alt text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5>Protection</h5>
                            <p class="text-muted">Safety gear for sparring and training</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="{{ route('products.index', ['category' => 'accessories']) }}" class="text-decoration-none">
                    <div class="card text-center h-100 category-card">
                        <div class="card-body">
                            <i class="fas fa-plus text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5>Accessories</h5>
                            <p class="text-muted">Essential accessories for your practice</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<style>
    .category-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .feature-box {
        transition: all 0.3s ease;
    }
    
    .feature-box:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
