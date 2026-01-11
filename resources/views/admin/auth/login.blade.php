<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — tendakian</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      min-height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    
    .login-container {
      width: 100%;
      max-width: 420px;
    }
    
    .login-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.15);
      border: none;
      overflow: hidden;
      backdrop-filter: blur(10px);
    }
    
    .login-header {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      color: white;
      padding: 40px 40px 30px;
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
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="outdoor" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M20 5 L30 20 L20 35 L10 20 Z" fill="white" opacity="0.05"/><circle cx="5" cy="5" r="1" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23outdoor)"/></svg>');
      opacity: 0.3;
    }
    
    .login-icon {
      width: 60px;
      height: 60px;
      background: rgba(255,255,255,0.2);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 24px;
      position: relative;
      z-index: 1;
    }
    
    .login-title {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
    }
    
    .login-subtitle {
      opacity: 0.9;
      margin: 0;
      position: relative;
      z-index: 1;
    }
    
    .login-body {
      padding: 40px;
    }
    
    .form-label {
      font-weight: 600;
      color: #495057;
      margin-bottom: 8px;
    }
    
    .form-group {
      margin-bottom: 24px;
    }
    
    .input-group {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .input-group-text {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border: 1px solid #e9ecef;
      border-right: none;
      color: #6c757d;
      padding: 12px 16px;
    }
    
    .form-control {
      border: 1px solid #e9ecef;
      border-left: none;
      padding: 12px 16px;
      font-size: 0.95rem;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #2d7a6e;
      box-shadow: 0 0 0 0.2rem rgba(45, 122, 110, 0.15);
    }
    
    .btn-login {
      background: linear-gradient(135deg, #2d7a6e 0%, #1e4d3f 100%);
      border: none;
      border-radius: 12px;
      padding: 14px 24px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(45, 122, 110, 0.3);
    }
    
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(45, 122, 110, 0.4);
      background: linear-gradient(135deg, #3d9b8c 0%, #2d7a6e 100%);
    }
    
    .btn-login:active {
      transform: translateY(0);
    }
    
    .alert {
      border-radius: 12px;
      border: none;
      margin-bottom: 24px;
    }
    
    .alert-danger {
      background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
      color: white;
    }
    
    .footer-note {
      text-align: center;
      margin-top: 24px;
      padding-top: 24px;
      border-top: 1px solid #f1f3f4;
      color: #6c757d;
      font-size: 0.875rem;
    }
    
    .back-link {
      position: absolute;
      top: 20px;
      left: 20px;
      color: rgba(255,255,255,0.8);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      background: rgba(255,255,255,0.1);
      padding: 8px 16px;
      border-radius: 20px;
      backdrop-filter: blur(10px);
    }
    
    .back-link:hover {
      color: white;
      background: rgba(255,255,255,0.2);
      transform: translateX(-2px);
    }
    
    @media (max-width: 576px) {
      .login-header {
        padding: 30px 20px 20px;
      }
      
      .login-body {
        padding: 30px 20px;
      }
      
      .login-title {
        font-size: 1.5rem;
      }
      
      .footer-contact .contact-item {
        display: block;
        margin: 4px 0;
      }
    }
    
    .admin-footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0,0,0,0.2);
      backdrop-filter: blur(10px);
      padding: 16px 0;
      border-top: 1px solid rgba(255,255,255,0.1);
    }
    
    .footer-contact .contact-item {
      color: rgba(255,255,255,0.9);
      font-size: 0.875rem;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    
    .footer-contact .contact-item:hover {
      color: white;
    }
    
    .footer-contact .contact-item i {
      opacity: 0.8;
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
          <i class="bi bi-shield-lock"></i>
        </div>
        <h1 class="login-title">Admin Login</h1>
        <p class="login-subtitle">Sign in to access admin dashboard</p>
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
        <form method="POST" action="{{ route('admin.login.post') }}">
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
                placeholder="admin@example.com"
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
            Login to Dashboard
          </button>
        </form>

        <!-- Footer Note -->
        <div class="footer-note">
          <i class="bi bi-shield-check me-2"></i>
          Secure admin access only
        </div>
      </div>
    </div>
  </div>

  <!-- Footer with Contact Information -->
  <footer class="admin-footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
          <p class="mb-0 text-white-50">
            © 2024 Tendakian Outdoor Rental. All rights reserved.
          </p>
        </div>
        <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
          <div class="footer-contact">
            <span class="contact-item me-3">
              <i class="bi bi-telephone-fill me-1"></i>
              +62 812-3456-7890
            </span>
            <span class="contact-item">
              <i class="bi bi-envelope-fill me-1"></i>
              admin@tendakian.com
            </span>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>