@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-sign-in-alt me-2"></i>Welcome Back
                    </h3>
                    <p class="mb-0 mt-2">Sign in to your account</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
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
                            <label for="password" class="form-label fw-bold">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <input type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required
                                       placeholder="Enter your password">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
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
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold">
                                Create one here
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Demo Accounts -->
            <div class="card shadow mt-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Demo Accounts</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="demo-account">
                                <h6 class="fw-bold text-primary">Admin Account</h6>
                                <p class="mb-1"><strong>Email:</strong> admin@taekwondo.com</p>
                                <p class="mb-2"><strong>Password:</strong> password</p>
                                <button class="btn btn-sm btn-outline-primary w-100" onclick="fillDemo('admin@taekwondo.com', 'password')">
                                    Use Admin Demo
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="demo-account">
                                <h6 class="fw-bold text-success">User Account</h6>
                                <p class="mb-1"><strong>Email:</strong> user@taekwondo.com</p>
                                <p class="mb-2"><strong>Password:</strong> password</p>
                                <button class="btn btn-sm btn-outline-success w-100" onclick="fillDemo('user@taekwondo.com', 'password')">
                                    Use User Demo
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
}
</script>

<style>
.demo-account {
    padding: 1rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    background-color: #f8f9fa;
}
</style>
@endsection
