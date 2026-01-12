<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register — Tendakian</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      min-height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    
    .register-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    
    .register-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.15);
      overflow: hidden;
      width: 100%;
      max-width: 500px;
    }
    
    .register-header {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      padding: 40px 40px 30px;
      text-align: center;
    }
    
    .register-header h1 {
      color: #2d3748;
      font-weight: 700;
      margin-bottom: 8px;
      font-size: 2rem;
    }
    
    .register-header p {
      color: #6c757d;
      margin: 0;
    }
    
    .register-body {
      padding: 40px;
    }
    
    .form-group {
      margin-bottom: 24px;
    }
    
    .form-label {
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 8px;
      font-size: 0.95rem;
    }
    
    .form-control {
      border-radius: 12px;
      border: 2px solid #e9ecef;
      padding: 14px 18px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #2d7a6e;
      box-shadow: 0 0 0 0.2rem rgba(45, 122, 110, 0.15);
    }
    
    .btn-register {
      background: linear-gradient(135deg, #2d7a6e, #3d9b8c);
      border: none;
      color: white;
      padding: 14px 32px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1.1rem;
      width: 100%;
      transition: all 0.3s ease;
    }
    
    .btn-register:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(45, 122, 110, 0.3);
    }
    
    .login-link {
      text-align: center;
      margin-top: 24px;
      padding-top: 24px;
      border-top: 1px solid #e9ecef;
    }
    
    .login-link a {
      color: #2d7a6e;
      text-decoration: none;
      font-weight: 600;
    }
    
    .login-link a:hover {
      color: #1e4d3f;
    }
    
    .password-requirements {
      font-size: 0.875rem;
      color: #6c757d;
      margin-top: 8px;
    }
    
    .password-requirements ul {
      margin: 8px 0 0 0;
      padding-left: 20px;
    }
    
    .password-requirements li {
      margin-bottom: 4px;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-card">
      <div class="register-header">
        <h1><i class="bi bi-person-plus-fill me-3"></i>Register</h1>
        <p>Create your Tendakian account</p>
      </div>
      
      <div class="register-body">
        @if($errors->any())
          <div class="alert alert-danger mb-4">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
          @csrf
          
          <div class="form-group">
            <label class="form-label">Full Name</label>
            <input 
              type="text" 
              name="name" 
              class="form-control @error('name') is-invalid @enderror"
              placeholder="Enter your full name"
              value="{{ old('name') }}"
              required
            >
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Email Address</label>
            <input 
              type="email" 
              name="email" 
              class="form-control @error('email') is-invalid @enderror"
              placeholder="Enter your email address"
              value="{{ old('email') }}"
              required
            >
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Phone Number (Optional)</label>
            <input 
              type="tel" 
              name="phone" 
              class="form-control @error('phone') is-invalid @enderror"
              placeholder="Enter your phone number"
              value="{{ old('phone') }}"
            >
            @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Address (Optional)</label>
            <textarea 
              name="address" 
              class="form-control @error('address') is-invalid @enderror"
              rows="3"
              placeholder="Enter your address"
            >{{ old('address') }}</textarea>
            @error('address')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <input 
              type="password" 
              name="password" 
              class="form-control @error('password') is-invalid @enderror"
              placeholder="Create a strong password"
              required
            >
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="password-requirements">
              Password must contain:
              <ul>
                <li>At least 8 characters</li>
                <li>Uppercase and lowercase letters</li>
                <li>At least one number</li>
                <li>At least one special character</li>
              </ul>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input 
              type="password" 
              name="password_confirmation" 
              class="form-control"
              placeholder="Confirm your password"
              required
            >
          </div>

          <button type="submit" class="btn btn-register">
            <i class="bi bi-person-check me-2"></i>
            Create Account
          </button>
        </form>

        <div class="login-link">
          Already have an account? <a href="{{ route('login') }}">Sign in here</a>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>