@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center" style="padding: 50px;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary-custom text-white text-center border-0">
                    <h3 class="mb-0">
                        <i class="fas fa-sign-in-alt me-2"></i>Welcome Back
                    </h3>
                    <p class="mb-0 mt-2 opacity-90">Sign in to your account</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-primary-custom">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input type="email" 
                                   class="form-control form-control-lg custom-input @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus
                                   placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-primary-custom">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <input type="password" 
                                       class="form-control form-control-lg custom-input @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required
                                       placeholder="Enter your password">
                                <button type="button" class="btn btn-outline-primary-custom" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input custom-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0">Don't have an account? 
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary-custom">
                                Create one here
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Demo Accounts -->
            <div class="card shadow-lg border-0 mt-4">
                <div class="card-header bg-secondary-custom text-white border-0">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Demo Accounts</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="demo-account">
                                <div class="demo-badge admin-badge">
                                    <i class="fas fa-crown me-1"></i>Admin
                                </div>
                                <h6 class="fw-bold text-primary-custom mb-2">Admin Account</h6>
                                <p class="mb-1 small"><strong>Email:</strong> admin@gmail.com</p>
                                <p class="mb-3 small"><strong>Password:</strong> password</p>
                                <button class="btn btn-sm btn-primary-custom w-100" onclick="fillDemo('admin@gmail.com', 'password')">
                                    <i class="fas fa-user-shield me-1"></i>Use Admin Demo
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="demo-account">
                                <div class="demo-badge user-badge">
                                    <i class="fas fa-user me-1"></i>User
                                </div>
                                <h6 class="fw-bold text-success mb-2">User Account</h6>
                                <p class="mb-1 small"><strong>Email:</strong> testing@gmail.com</p>
                                <p class="mb-3 small"><strong>Password:</strong> password</p>
                                <button class="btn btn-sm btn-success w-100" onclick="fillDemo('testing@gmail.com', 'password')">
                                    <i class="fas fa-user me-1"></i>Use User Demo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

function fillDemo(email, password) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = password;
    
    // Add smooth animation
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    emailInput.style.transform = 'scale(1.02)';
    passwordInput.style.transform = 'scale(1.02)';
    
    setTimeout(() => {
        emailInput.style.transform = 'scale(1)';
        passwordInput.style.transform = 'scale(1)';
    }, 200);
}
</script>

<style>
/* Modern Blue Color Scheme */
:root {
    --primary-color: #4f46e5; /* Indigo yang lembut */
    --secondary-color: #818cf8; /* Lavender */
    --dark-color: #312e81; /* Indigo gelap */
    --light-color: #f8fafc; /* Abu-abu sangat terang */
    --accent-color: #6366f1; /* Indigo menengah */
    --success-color: #10b981; /* Hijau mint */
}

body {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
    font-family: "Inter", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
}

/* Custom Primary Button */
.btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 12px 24px;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
}

/* Outline Primary Button */
.btn-outline-primary-custom {
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    background: transparent;
    transition: all 0.3s ease;
}

.btn-outline-primary-custom:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-1px);
}

/* Background Colors */
.bg-primary-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%) !important;
}

.bg-secondary-custom {
    background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%) !important;
}

/* Text Colors */
.text-primary-custom {
    color: var(--primary-color) !important;
}

/* Custom Input Styling */
.custom-input {
    border: 2px solid rgba(79, 70, 229, 0.1);
    border-radius: 8px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
}

.custom-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
    background: white;
}

/* Custom Checkbox */
.custom-checkbox:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.custom-checkbox:focus {
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
}

/* Card Styling */
.card {
    border-radius: 16px;
    overflow: hidden;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

.card-header {
    border-radius: 16px 16px 0 0 !important;
}

/* Demo Account Styling */
.demo-account {
    padding: 1.5rem;
    border: 1px solid rgba(79, 70, 229, 0.15);
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.03) 0%, rgba(99, 102, 241, 0.03) 100%);
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.demo-account:hover {
    border-color: rgba(79, 70, 229, 0.25);
    box-shadow: 0 4px 16px rgba(79, 70, 229, 0.15);
    transform: translateY(-2px);
}

.demo-account::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    border-radius: 12px 12px 0 0;
}

/* Demo Badges */
.demo-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
}

.admin-badge {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.user-badge {
    background: linear-gradient(135deg, var(--success-color), #059669);
    color: white;
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

.card {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive */
@media (max-width: 767.98px) {
    .container {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1.5rem !important;
    }
    
    .demo-account {
        padding: 1rem;
    }
}

/* Smooth transitions for inputs */
input, button {
    transition: all 0.3s ease;
}

/* Link hover effects */
a {
    transition: all 0.3s ease;
}

a:hover {
    transform: translateY(-1px);
}
</style>
@endsection
