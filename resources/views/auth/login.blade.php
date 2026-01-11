<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — tendakian</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      min-height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      position: relative;
      overflow: hidden;
    }
    
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="outdoor" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M25 10 L35 25 L25 40 L15 25 Z" fill="white" opacity="0.03"/><circle cx="10" cy="10" r="2" fill="white" opacity="0.05"/><circle cx="40" cy="40" r="1" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23outdoor)"/></svg>');
      opacity: 0.4;
    }
    
    .login-container {
      width: 100%;
      max-width: 440px;
      position: relative;
      z-index: 10;
    }
    
    .login-card {
      background: white;
      border-radius: 24px;
      box-shadow: 0 25px 80px rgba(0,0,0,0.2);
      border: none;
      overflow: hidden;
      backdrop-filter: blur(20px);
      position: relative;
    }
    
    .login-header {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      color: white;
      padding: 50px 40px 40px;
      text-align: center;
      position: relative;
    }
    
    .login-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="tent" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M20 5 L30 20 L20 35 L10 20 Z" fill="white" opacity="0.08"/><circle cx="5" cy="5" r="1" fill="white" opacity="0.1"/><circle cx="35" cy="35" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23tent)"/></svg>');
      opacity: 0.3;
    }
    
    .login-icon {
      width: 70px;
      height: 70px;
      background: rgba(255,255,255,0.15);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      font-size: 28px;
      position: relative;
      z-index: 1;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255,255,255,0.1);
    }
    
    .login-title {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
      text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .login-subtitle {
      opacity: 0.9;
      margin: 0;
      position: relative;
      z-index: 1;
      font-size: 1.1rem;
    }
    
    .login-body {
      padding: 45px 40px;
    }
    
    .form-label {
      font-weight: 600;
      color: #2d5a4f;
      margin-bottom: 10px;
      font-size: 0.95rem;
    }
    
    .form-group {
      margin-bottom: 28px;
    }
    
    .input-group {
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(45, 122, 110, 0.08);
      border: 2px solid transparent;
      transition: all 0.3s ease;
    }
    
    .input-group:focus-within {
      border-color: #3d9b8c;
      box-shadow: 0 4px 20px rgba(61, 155, 140, 0.15);
      transform: translateY(-1px);
    }
    
    .input-group-text {
      background: linear-gradient(135deg, #f0f8f6 0%, #e8f4f1 100%);
      border: none;
      color: #2d7a6e;
      padding: 16px 18px;
      font-size: 1.1rem;
    }
    
    .form-control {
      border: none;
      padding: 16px 18px;
      font-size: 1rem;
      background: #fafcfb;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      background: white;
      box-shadow: none;
    }
    
    .form-control::placeholder {
      color: #a0b5b0;
    }
    
    .btn-login {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      border: none;
      border-radius: 14px;
      padding: 16px 28px;
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(45, 122, 110, 0.3);
      position: relative;
      overflow: hidden;
    }
    
    .btn-login::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(45, 122, 110, 0.4);
      background: linear-gradient(135deg, #1a4238 0%, #266b60 50%, #358a7e 100%);
    }
    
    .btn-login:hover::before {
      left: 100%;
    }
    
    .btn-login:active {
      transform: translateY(-1px);
    }
    
    .alert {
      border-radius: 12px;
      border: none;
      margin-bottom: 28px;
      padding: 16px 20px;
    }
    
    .alert-danger {
      background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }
    
    .footer-links {
      text-align: center;
      margin-top: 32px;
      padding-top: 28px;
      border-top: 1px solid #f0f4f2;
    }
    
    .footer-links a {
      color: #2d7a6e;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .footer-links a:hover {
      color: #1e4d3f;
      text-decoration: underline;
    }
    
    .btn-outline-success {
      border: 2px solid #2d7a6e;
      color: #2d7a6e;
      background: transparent;
      border-radius: 10px;
      padding: 8px 16px;
      font-weight: 600;
      font-size: 0.875rem;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    
    .btn-outline-success:hover {
      background: #2d7a6e;
      border-color: #2d7a6e;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(45, 122, 110, 0.3);
    }
    
    .btn-outline-primary {
      border: 2px solid #1e4d3f;
      color: #1e4d3f;
      background: transparent;
      border-radius: 10px;
      padding: 8px 16px;
      font-weight: 600;
      font-size: 0.875rem;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    
    .btn-outline-primary:hover {
      background: #1e4d3f;
      border-color: #1e4d3f;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(30, 77, 63, 0.3);
    }
    
    .back-link {
      position: absolute;
      top: 25px;
      left: 25px;
      color: rgba(255,255,255,0.9);
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      background: rgba(255,255,255,0.1);
      padding: 12px 20px;
      border-radius: 25px;
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255,255,255,0.1);
      z-index: 20;
    }
    
    .back-link:hover {
      color: white;
      background: rgba(255,255,255,0.2);
      transform: translateX(-3px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .brand-text {
      color: rgba(255,255,255,0.8);
      font-size: 0.9rem;
      margin-top: 16px;
      font-weight: 500;
    }
    
    @media (max-width: 576px) {
      .login-header {
        padding: 40px 25px 30px;
      }
      
      .login-body {
        padding: 35px 25px;
      }
      
      .login-title {
        font-size: 1.75rem;
      }
      
      .back-link {
        top: 15px;
        left: 15px;
        padding: 10px 16px;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <!-- Back to Website Link -->
  <a href="/" class="back-link">
    <i class="bi bi-arrow-left me-2"></i>
    Back to Website
  </a>

  <div class="login-container">
    <div class="card login-card">
      <!-- Header -->
      <div class="login-header">
        <div class="login-icon">
          <i class="bi bi-person-circle"></i>
        </div>
        <h1 class="login-title">Welcome Back</h1>
        <p class="login-subtitle">Sign in to your outdoor adventure account</p>
        <div class="brand-text">
          <i class="bi bi-geo-alt me-1"></i>
          tendakian Outdoor Gear Rental
        </div>
      </div>

      <!-- Body -->
      <div class="login-body">
        <!-- Error Alert -->
        @if($errors->any())
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>{{ $errors->first() }}</div>
          </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.post') }}">
          @csrf
          
          <!-- Email Field -->
          <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-envelope"></i>
              </span>
              <input 
                type="email" 
                class="form-control" 
                id="email"
                name="email" 
                placeholder="Enter your email address"
                value="{{ old('email') }}"
                required 
                autofocus
              />
            </div>
          </div>

          <!-- Password Field -->
          <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-lock"></i>
              </span>
              <input 
                type="password" 
                class="form-control" 
                id="password"
                name="password" 
                placeholder="Enter your password"
                required 
              />
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary btn-login w-100">
            <i class="bi bi-box-arrow-in-right me-2"></i>
            Sign In to Your Account
          </button>
        </form>

        <!-- Footer Links -->
        <div class="footer-links">
          <p class="text-muted mb-3">
            Need help? 
            <a href="/about">Learn More</a>
          </p>
          <p class="text-muted mb-4">
            <a href="#" class="text-muted">Forgot your password?</a>
          </p>
          
          <!-- Quick Access Section -->
          <div class="mt-4 pt-4 border-top text-center">
            <p class="text-muted mb-3 small">Quick Access</p>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
              <a href="{{ route('admin.login') }}" class="btn btn-outline-success btn-sm">
                <i class="bi bi-shield-check me-2"></i>
                Admin Login
              </a>
              <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-speedometer2 me-2"></i>
                Admin Dashboard
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>