@extends('layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-2">Admin Login</h2>
                        <p class="text-muted">Sign in to access admin dashboard</p>
                    </div>

                    <!-- Error Alert -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('admin.login.post') }}">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input 
                                    type="email" 
                                    class="form-control border-start-0 ps-0" 
                                    id="email"
                                    name="email" 
                                    placeholder="admin@example.com"
                                    required 
                                    autofocus
                                />
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input 
                                    type="password" 
                                    class="form-control border-start-0 ps-0" 
                                    id="password"
                                    name="password" 
                                    placeholder="Enter your password"
                                    required 
                                />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Login to Dashboard
                        </button>
                    </form>

                    <!-- Footer Note -->
                    <div class="text-center mt-4">
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>
                            Secure admin access only
                        </small>
                    </div>
                </div>
            </div>

            <!-- Back to Site Link -->
            <div class="text-center mt-3">
                <a href="/" class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left me-1"></i>
                    Back to Website
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styling */
    .card {
        border-radius: 12px;
    }
    
    .form-control:focus,
    .input-group-text {
        border-color: #dee2e6;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        color: #6c757d;
    }
    
    .btn-primary {
        background-color: #0d6efd;
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
    }
    
    /* Optional: If Bootstrap Icons not loaded */
    .bi::before {
        display: inline-block;
        vertical-align: -0.125em;
    }
</style>
@endsection