@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center" style="padding: 50px;">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary-custom text-white text-center border-0">
                    <h3 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </h3>
                    <p class="mb-0 mt-2 opacity-90">Join our Taekwondo community</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold text-primary-custom">
                                <i class="fas fa-user me-2"></i>Full Name
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg custom-input @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus
                                   placeholder="Enter your full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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
                                   placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-bold text-primary-custom">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control form-control-lg custom-input @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required
                                           placeholder="Create password">
                                    <button type="button" class="btn btn-outline-primary-custom" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="toggleIcon1"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-bold text-primary-custom">
                                    <i class="fas fa-lock me-2"></i>Confirm Password
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control form-control-lg custom-input" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required
                                           placeholder="Confirm password">
                                    <button type="button" class="btn btn-outline-primary-custom" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="toggleIcon2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold text-primary-custom">
                                <i class="fas fa-phone me-2"></i>Phone Number <span class="text-muted">(Optional)</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg custom-input @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   placeholder="e.g., +62 812 3456 7890">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label fw-bold text-primary-custom">
                                <i class="fas fa-map-marker-alt me-2"></i>Address <span class="text-muted">(Optional)</span>
                            </label>
                            <textarea class="form-control custom-input @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3"
                                      placeholder="Enter your complete address for shipping">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input custom-checkbox @error('terms') is-invalid @enderror" 
                                       type="checkbox" 
                                       name="terms" 
                                       id="terms" 
                                       required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-decoration-none text-primary-custom fw-bold">Terms of Service</a> 
                                    and <a href="#" class="text-decoration-none text-primary-custom fw-bold">Privacy Policy</a>
                                </label>
                                @error('terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0">Already have an account? 
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary-custom">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Registration Benefits -->
            <div class="card shadow-lg border-0 mt-4">
                <div class="card-header bg-secondary-custom text-white border-0">
                    <h6 class="mb-0"><i class="fas fa-star me-2"></i>Why Join Us?</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="benefit-content">
                                    <h6 class="fw-bold mb-1 text-primary-custom">Free Shipping</h6>
                                    <p class="mb-0 text-muted small">On orders over Rp 500,000</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-medal"></i>
                                </div>
                                <div class="benefit-content">
                                    <h6 class="fw-bold mb-1 text-warning">Quality Products</h6>
                                    <p class="mb-0 text-muted small">Authentic Taekwondo equipment</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="benefit-content">
                                    <h6 class="fw-bold mb-1 text-success">Expert Support</h6>
                                    <p class="mb-0 text-muted small">Professional customer service</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="benefit-content">
                                    <h6 class="fw-bold mb-1 text-info">Community</h6>
                                    <p class="mb-0 text-muted small">Join our Taekwondo community</p>
                                </div>
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
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(fieldId === 'password' ? 'toggleIcon1' : 'toggleIcon2');
    
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

// Add form validation feedback
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    
    // Real-time password confirmation validation
    confirmPasswordInput.addEventListener('input', function() {
        if (passwordInput.value !== confirmPasswordInput.value) {
            confirmPasswordInput.setCustomValidity('Passwords do not match');
        } else {
            confirmPasswordInput.setCustomValidity('');
        }
    });
    
    // Add smooth animation for form submission
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Account...';
        submitBtn.disabled = true;
    });
});
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

/* Benefit Items Styling */
.benefit-item {
    display: flex;
    align-items: flex-start;
    padding: 1rem;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.03) 0%, rgba(99, 102, 241, 0.03) 100%);
    border: 1px solid rgba(79, 70, 229, 0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.benefit-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
    border-color: rgba(79, 70, 229, 0.15);
}

.benefit-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.benefit-icon i {
    color: white;
    font-size: 1.1rem;
}

.benefit-content {
    flex: 1;
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

.benefit-item {
    animation: fadeInUp 0.6s ease-out;
}

.benefit-item:nth-child(1) { animation-delay: 0.1s; }
.benefit-item:nth-child(2) { animation-delay: 0.2s; }
.benefit-item:nth-child(3) { animation-delay: 0.3s; }
.benefit-item:nth-child(4) { animation-delay: 0.4s; }

/* Responsive */
@media (max-width: 767.98px) {
    .container {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1.5rem !important;
    }
    
    .benefit-item {
        padding: 0.75rem;
        margin-bottom: 0.75rem;
    }
    
    .benefit-icon {
        width: 35px;
        height: 35px;
        margin-right: 0.5rem;
    }
    
    .benefit-icon i {
        font-size: 1rem;
    }
}

/* Smooth transitions for inputs */
input, button, textarea {
    transition: all 0.3s ease;
}

/* Link hover effects */
a {
    transition: all 0.3s ease;
}

a:hover {
    transform: translateY(-1px);
}

/* Form validation styling */
.is-invalid {
    border-color: #dc3545 !important;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

/* Loading state for submit button */
.btn-primary-custom:disabled {
    opacity: 0.8;
    cursor: not-allowed;
    transform: none !important;
}
</style>
@endsection
