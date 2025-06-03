@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Master Your Taekwondo Journey</h1>
                <p class="lead mb-4">Discover premium quality Taekwondo equipment designed for champions. From traditional doboks to modern protective gear, we have everything you need to excel in your martial arts journey.</p>
                <div class="hero-buttons">
                    <a href="{{ route('products.index') }}" class="btn btn-primary-custom btn-lg me-3">
                        <i class="fas fa-shopping-bag me-2"></i>Shop Now
                    </a>
                    <a href="#categories" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-arrow-down me-2"></i>Explore Categories
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image">
                    <img src="/placeholder.svg?height=400&width=400" alt="Taekwondo Equipment" class="img-fluid rounded-circle shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon bg-primary-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-medal fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Premium Quality</h5>
                    <p class="text-muted">Authentic equipment from trusted brands, ensuring durability and performance.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon bg-primary-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shipping-fast fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Fast Shipping</h5>
                    <p class="text-muted">Quick and reliable delivery to get your gear when you need it most.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon bg-primary-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Expert Support</h5>
                    <p class="text-muted">Professional guidance from experienced Taekwondo practitioners.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon bg-primary-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Secure Shopping</h5>
                    <p class="text-muted">Safe and secure transactions with multiple payment options.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary-custom">Shop by Category</h2>
            <p class="lead text-muted">Find the perfect equipment for your training needs</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('products.index', ['category' => 'dobok']) }}" class="category-card d-block p-4 text-center h-100">
                    <div class="category-icon mb-3">
                        <i class="fas fa-tshirt fa-4x"></i>
                    </div>
                    <h4 class="fw-bold">Dobok</h4>
                    <p class="mb-0">Traditional uniforms for training and competition</p>
                    <div class="mt-3">
                        <span class="badge bg-light text-dark">{{ $categories['dobok'] ?? 0 }} Products</span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('products.index', ['category' => 'belt']) }}" class="category-card d-block p-4 text-center h-100">
                    <div class="category-icon mb-3">
                        <i class="fas fa-ribbon fa-4x"></i>
                    </div>
                    <h4 class="fw-bold">Belts</h4>
                    <p class="mb-0">Quality belts for all ranks and skill levels</p>
                    <div class="mt-3">
                        <span class="badge bg-light text-dark">{{ $categories['belt'] ?? 0 }} Products</span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('products.index', ['category' => 'protection']) }}" class="category-card d-block p-4 text-center h-100">
                    <div class="category-icon mb-3">
                        <i class="fas fa-shield-alt fa-4x"></i>
                    </div>
                    <h4 class="fw-bold">Protection</h4>
                    <p class="mb-0">Safety gear for sparring and competition</p>
                    <div class="mt-3">
                        <span class="badge bg-light text-dark">{{ $categories['protection'] ?? 0 }} Products</span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('products.index', ['category' => 'accessories']) }}" class="category-card d-block p-4 text-center h-100">
                    <div class="category-icon mb-3">
                        <i class="fas fa-plus fa-4x"></i>
                    </div>
                    <h4 class="fw-bold">Accessories</h4>
                    <p class="mb-0">Essential accessories for training and competition</p>
                    <div class="mt-3">
                        <span class="badge bg-light text-dark">{{ $categories['accessories'] ?? 0 }} Products</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary-custom">Featured Products</h2>
            <p class="lead text-muted">Discover our most popular and highly-rated equipment</p>
        </div>
        
        <div class="row">
            @forelse($featuredProducts as $product)
                <div class="col-lg-3 col-md-6 mb-4">
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
                <div class="col-12 text-center">
                    <p class="text-muted">No featured products available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-th-large me-2"></i>View All Products
            </a>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold text-primary-custom">{{ $stats['products'] ?? 0 }}+</h2>
                    <p class="lead text-muted">Quality Products</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold text-primary-custom">{{ $stats['customers'] ?? 0 }}+</h2>
                    <p class="lead text-muted">Happy Customers</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold text-primary-custom">{{ $stats['orders'] ?? 0 }}+</h2>
                    <p class="lead text-muted">Orders Completed</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold text-primary-custom">5</h2>
                    <p class="lead text-muted">Years Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-5 bg-primary-custom text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold mb-4">Ready to Start Your Journey?</h2>
                <p class="lead mb-4">Join thousands of martial artists who trust us for their Taekwondo equipment needs. Get started today and take your training to the next level.</p>
                <div class="cta-buttons">
                    @auth
                        <a href="{{ route('products.index') }}" class="btn btn-light btn-lg me-3">
                            <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                        </a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-history me-2"></i>View My Orders
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-eye me-2"></i>Browse Products
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>
@endsection
