<!DOCTYPE html>
<html lang="en">
<
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - Taekwondo Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
    /* Palette warna biru yang lebih harmonis */
    --primary-color: #2563eb; /* Biru yang lebih dalam dan elegan */
    --secondary-color: #60a5fa; /* Biru muda untuk aksen */
    --dark-color: #1e3a8a; /* Biru sangat gelap untuk footer/header */
    --light-color: #eff6ff; /* Biru sangat terang untuk background */
    --accent-color: #3b82f6; /* Biru menengah untuk hover states */
    }

    body {
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Custom Primary Button */
    .btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(30, 58, 138, 0.15);
    }

    .btn-primary-custom:hover {
    background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
    }

    /* Navigation */
    .navbar-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
    font-weight: bold;
    font-size: 1.5rem;
    }

    .navbar-nav .nav-link {
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    }

    .navbar-nav .nav-link:hover {
    transform: translateY(-2px);
    }

    .navbar-nav .nav-link.active::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 3px;
    background: var(--secondary-color); /* Warna biru muda untuk indikator */
    border-radius: 2px;
    }

    /* Hero Section */
    .hero-section {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.9) 0%, rgba(30, 58, 138, 0.9) 100%),
        url("/placeholder.svg?height=600&width=1200") center / cover;
    color: white;
    padding: 100px 0;
    }

    /* Cards */
    .card-product {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 10px rgba(37, 99, 235, 0.1);
    }

    .card-product:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.15);
    }

    /* Category Cards */
    .category-card {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
    color: white;
    border-radius: 15px;
    transition: all 0.3s ease;
    text-decoration: none;
    }

    .category-card:hover {
    color: white;
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
    }

    /* Footer */
    .footer-custom {
    background: linear-gradient(135deg, var(--dark-color) 0%, #0f172a 100%);
    color: white;
    }

    .footer-custom a {
    color: var(--secondary-color);
    text-decoration: none;
    transition: color 0.3s ease;
    }

    .footer-custom a:hover {
    color: white;
    }

    /* Utilities */
    .text-primary-custom {
    color: var(--primary-color) !important;
    }

    .bg-primary-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%) !important;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
    .hero-section {
        padding: 60px 0;
    }

    .hero-section h1 {
        font-size: 2rem;
    }
    }

</style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-fist-raised me-2"></i>Taekwondo Shop
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="fas fa-shopping-bag me-1"></i>Produk
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-th-large me-1"></i>Kategori
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('products.index', ['category' => 'dobok']) }}">
                                <i class="fas fa-tshirt me-2"></i>Dobok
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('products.index', ['category' => 'belt']) }}">
                                <i class="fas fa-ribbon me-2"></i>Sabuk
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('products.index', ['category' => 'protection']) }}">
                                <i class="fas fa-shield-alt me-2"></i>Protektor
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('products.index', ['category' => 'accessories']) }}">
                                <i class="fas fa-plus me-2"></i>Aksesoris
                            </a></li>
                        </ul>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i>Cart
                                @if(auth()->user()->cart_count > 0)
                                    <span class="badge bg-warning text-dark ms-1">{{ auth()->user()->cart_count }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i>My Orders
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>My Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user me-2"></i>My Profile
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="fas fa-shopping-cart me-2"></i>My Orders
                                </a></li>
                                @if(auth()->user()->role === 'admin')
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                                    </a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main >
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
                <div class="container">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
                <div class="container">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                <div class="container">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show m-0" role="alert">
                <div class="container">
                    <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom py-5 mt-5" >
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-fist-raised me-2"></i>Taekwondo Shop
                    </h5>
                    <p class="text-white">Mitra terpercaya Anda untuk perlengkapan Taekwondo asli. Kami menyediakan perlengkapan berkualitas tinggi untuk praktisi di semua tingkatan.</p>
                    <div class="social-links">
                        <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}">Home</a></li>
                        <li class="mb-2"><a href="{{ route('products.index') }}">Produk</a></li>
                        <li class="mb-2"><a href="#">About Us</a></li>
                        <li class="mb-2"><a href="#">Kontak</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Kategori</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('products.index', ['category' => 'dobok']) }}">Dobok</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['category' => 'belt']) }}">Sabuk</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['category' => 'protection']) }}">Protektor</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['category' => 'accessories']) }}">Aksesoris</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Pusat Bantuan</a></li>
                        <li class="mb-2"><a href="#">Informasi Pengiriman</a></li>
                        <li class="mb-2"><a href="#">Pengembalian</a></li>
                        <li class="mb-2"><a href="#">Panduan Ukuran</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Akun</h6>
                    <ul class="list-unstyled">
                        @auth
                            <li class="mb-2"><a href="{{ route('profile') }}">My Profile</a></li>
                            <li class="mb-2"><a href="{{ route('orders.index') }}">My Orders</a></li>
                        @else
                            <li class="mb-2"><a href="{{ route('login') }}">Login</a></li>
                            <li class="mb-2"><a href="{{ route('register') }}">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-white">&copy; {{ date('Y') }} Taekwondo Shop. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="payment-methods">
                        <i class="fab fa-cc-visa fa-2x me-2 text-muted"></i>
                        <i class="fab fa-cc-mastercard fa-2x me-2 text-muted"></i>
                        <i class="fab fa-cc-paypal fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
