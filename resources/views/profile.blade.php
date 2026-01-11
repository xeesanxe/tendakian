<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <title>tendakian — Profile</title>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    
    .profile-header {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      padding: 40px 0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      margin-bottom: 40px;
      color: white;
      position: relative;
      overflow: hidden;
    }
    
    .profile-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="outdoor" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M20 5 L30 20 L20 35 L10 20 Z" fill="white" opacity="0.05"/><circle cx="5" cy="5" r="1" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23outdoor)"/></svg>');
      opacity: 0.3;
    }
    
    .profile-header h1 {
      color: white;
      font-weight: 700;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
    }
    
    .profile-header .subtitle {
      color: rgba(255,255,255,0.9);
      position: relative;
      z-index: 1;
    }
    
    .user-avatar {
      width: 80px;
      height: 80px;
      background: rgba(255,255,255,0.15);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: 700;
      margin-right: 20px;
      border: 3px solid rgba(255,255,255,0.2);
      position: relative;
      z-index: 1;
      color: white;
    }
    
    .stats-cards {
      margin-top: -60px;
      margin-bottom: 40px;
      position: relative;
      z-index: 10;
    }
    
    .stat-card {
      background: white;
      border-radius: 20px;
      padding: 30px 25px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.08);
      border: none;
      transition: all 0.3s ease;
      height: 100%;
    }
    
    .stat-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }
    
    .stat-icon {
      width: 60px;
      height: 60px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin-bottom: 20px;
    }
    
    .stat-icon.orders { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }
    .stat-icon.spent { background: linear-gradient(135deg, #2d7a6e, #3d9b8c); color: white; }
    .stat-icon.pending { background: linear-gradient(135deg, #ffc107, #ffb300); color: white; }
    .stat-icon.completed { background: linear-gradient(135deg, #28a745, #20c997); color: white; }
    
    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: #2d3748;
      margin-bottom: 8px;
      line-height: 1;
    }
    
    .stat-label {
      color: #718096;
      font-weight: 500;
      font-size: 0.95rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      overflow: hidden;
      margin-bottom: 30px;
    }
    
    .card-header {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border: none;
      padding: 25px 30px;
    }
    
    .card-title {
      font-weight: 700;
      color: #2d3748;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .card-title i {
      font-size: 1.2rem;
      color: #2d7a6e;
    }
    
    .order-item {
      padding: 20px 30px;
      border-bottom: 1px solid #f1f3f4;
      transition: all 0.3s ease;
    }
    
    .order-item:last-child {
      border-bottom: none;
    }
    
    .order-item:hover {
      background-color: #f8f9fa;
    }
    
    .order-number {
      font-weight: 600;
      color: #2d3748;
      font-size: 1rem;
    }
    
    .order-date {
      color: #718096;
      font-size: 0.875rem;
    }
    
    .order-amount {
      font-weight: 700;
      color: #2d7a6e;
      font-size: 1.1rem;
    }
    
    .status-badge {
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .status-pending { 
      background: linear-gradient(135deg, #ffc107, #ffb300);
      color: white;
    }
    .status-paid { 
      background: linear-gradient(135deg, #28a745, #20c997);
      color: white;
    }
    .status-cancelled { 
      background: linear-gradient(135deg, #dc3545, #c82333);
      color: white;
    }
    
    .btn-logout {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      color: white;
      padding: 10px 20px;
      border-radius: 12px;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
    }
    
    .btn-logout:hover {
      background: rgba(255,255,255,0.2);
      color: white;
      transform: translateY(-1px);
    }
    
    .quick-actions {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }
    
    .quick-action-btn {
      background: linear-gradient(135deg, #2d7a6e, #3d9b8c);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 12px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .quick-action-btn:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(45, 122, 110, 0.3);
    }
    
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #718096;
    }
    
    .empty-state i {
      font-size: 4rem;
      margin-bottom: 20px;
      opacity: 0.5;
      color: #2d7a6e;
    }
    
    .cart-item {
      padding: 15px;
      border-bottom: 1px solid #e2e8f0;
      transition: background-color 0.2s;
    }
    
    .cart-item:last-child {
      border-bottom: none;
    }
    
    .cart-item:hover {
      background-color: #f7fafc;
    }
    
    .cart-item-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
      border: 2px solid #e2e8f0;
    }
    
    .cart-summary {
      background-color: #f7fafc;
      padding: 20px;
      border-radius: 8px;
      margin-top: 15px;
    }
    
    .order-card {
      border-left: 4px solid #2d7a6e;
      transition: border-color 0.2s;
    }
    
    .order-card:hover {
      border-left-color: #1e4d3f;
    }
    
    .btn-checkout {
      background: linear-gradient(135deg, #2d7a6e 0%, #1e4d3f 100%);
      border: none;
      padding: 12px 30px;
      font-weight: 600;
      border-radius: 8px;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .btn-checkout:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(45, 122, 110, 0.4);
    }
    
    .product-name {
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 4px;
    }
    
    .product-details {
      font-size: 0.875rem;
      color: #718096;
    }
    
    .price-amount {
      font-weight: 700;
      color: #2d3748;
      font-size: 1.1rem;
    }
    
    @media (max-width: 768px) {
      .stats-cards {
        margin-top: -40px;
      }
      
      .stat-card {
        padding: 20px;
        margin-bottom: 20px;
      }
      
      .stat-number {
        font-size: 2rem;
      }
      
      .quick-actions {
        justify-content: center;
      }
    }
  </style>
</head>
<body>
  <!-- Profile Header -->
  <div class="profile-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <div class="user-avatar">
            @if(auth()->check())
              {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->email, 0, 1)) }}
            @else
              <i class="bi bi-person"></i>
            @endif
          </div>
          <div>
            <h1 class="h2 mb-2">
              @if(auth()->check())
                Welcome back, {{ auth()->user()->name ?? 'User' }}!
              @else
                Welcome to Tendakian
              @endif
            </h1>
            <p class="subtitle mb-0">Manage your outdoor gear rentals and orders</p>
          </div>
        </div>
        <div class="d-flex gap-3 align-items-center">
          @if(auth()->check())
            <span class="small opacity-75">User Profile</span>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-logout">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
              </button>
            </form>
          @else
            <a href="/login" class="btn btn-logout">
              <i class="bi bi-box-arrow-in-right me-2"></i>
              Login
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  @if(auth()->check())
    <!-- Stats Cards -->
    <div class="container">
      <div class="stats-cards">
        <div class="row g-4">
          <div class="col-md-3">
            <div class="card stat-card">
              <div class="stat-icon orders">
                <i class="bi bi-receipt"></i>
              </div>
              <div class="stat-number">{{ $orders->count() }}</div>
              <div class="stat-label">Total Orders</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card stat-card">
              <div class="stat-icon spent">
                <i class="bi bi-currency-dollar"></i>
              </div>
              <div class="stat-number">Rp {{ number_format($orders->sum('total'), 0, ',', '.') }}</div>
              <div class="stat-label">Total Spent</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card stat-card">
              <div class="stat-icon pending">
                <i class="bi bi-clock"></i>
              </div>
              <div class="stat-number">{{ $orders->where('status', 'pending')->count() }}</div>
              <div class="stat-label">Pending Orders</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card stat-card">
              <div class="stat-icon completed">
                <i class="bi bi-check-circle"></i>
              </div>
              <div class="stat-number">{{ $orders->where('status', 'paid')->count() }}</div>
              <div class="stat-label">Completed Orders</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

  <div class="container pb-5">
    @if(!auth()->check())
      <div class="alert alert-info d-flex align-items-center" role="alert">
        <i class="bi bi-info-circle me-2"></i>
        <div>
          Anda belum login. <a href="/login" class="alert-link fw-semibold">Login</a> untuk pengalaman lebih baik.
        </div>
      </div>
    @endif

    <div class="row">
      <!-- Cart Section -->
      <div class="col-lg-8 mb-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="bi bi-cart"></i>
              Your Cart
            </h3>
          </div>
          <div class="card-body p-0">
            @php $cart = session('cart', []); $subtotal = 0; @endphp
            
            @if(empty($cart))
              <div class="empty-state">
                <i class="bi bi-cart"></i>
                <h4>Keranjang Anda kosong</h4>
                <p class="text-muted">Mulai berbelanja sekarang!</p>
                <a href="/shop" class="quick-action-btn">
                  <i class="bi bi-shop"></i>
                  Browse Gear
                </a>
              </div>
            @else
              <div class="cart-items">
                @foreach($cart as $ci)
                  @php $line = $ci['price'] * $ci['qty']; $subtotal += $line; @endphp
                  <div class="cart-item d-flex align-items-center">
                    <div class="me-3">
                      @php
                        // Tentukan gambar berdasarkan nama produk dengan URL yang beragam dan spesifik
                        $imageUrl = 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=80&h=80&fit=crop&auto=format'; // default tent
                        
                        // Tenda & Shelter
                        if (stripos($ci['name'], 'tenda') !== false || stripos($ci['name'], 'tent') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=80&h=80&fit=crop&auto=format'; // tent
                        } elseif (stripos($ci['name'], 'tarp') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=80&h=80&fit=crop&auto=format'; // tarp/shelter
                        } elseif (stripos($ci['name'], 'hammock') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=80&h=80&fit=crop&auto=format'; // hammock
                          
                        // Tas & Carrier
                        } elseif (stripos($ci['name'], 'carrier') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=80&h=80&fit=crop&auto=format'; // large backpack
                        } elseif (stripos($ci['name'], 'backpack') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=80&h=80&fit=crop&auto=format'; // hiking backpack
                        } elseif (stripos($ci['name'], 'daypack') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=80&h=80&fit=crop&auto=format'; // daypack
                          
                        // Kompor & Alat Masak
                        } elseif (stripos($ci['name'], 'kompor') !== false || stripos($ci['name'], 'stove') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=80&h=80&fit=crop&auto=format'; // camping stove
                        } elseif (stripos($ci['name'], 'cookset') !== false || stripos($ci['name'], 'mess kit') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=80&h=80&fit=crop&auto=format'; // cookset
                          
                        // Sleeping System
                        } elseif (stripos($ci['name'], 'sleeping bag') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=80&h=80&fit=crop&auto=format'; // sleeping bag
                        } elseif (stripos($ci['name'], 'matras') !== false || stripos($ci['name'], 'sleeping pad') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=80&h=80&fit=crop&auto=format'; // sleeping pad
                          
                        // Sepatu & Footwear
                        } elseif (stripos($ci['name'], 'sepatu') !== false || stripos($ci['name'], 'boots') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=80&h=80&fit=crop&auto=format'; // hiking boots
                          
                        // Lighting
                        } elseif (stripos($ci['name'], 'headlamp') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=80&h=80&fit=crop&auto=format'; // headlamp
                        } elseif (stripos($ci['name'], 'lantern') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=80&h=80&fit=crop&auto=format'; // camping lantern
                        } elseif (stripos($ci['name'], 'flashlight') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=80&h=80&fit=crop&auto=format'; // flashlight
                          
                        // Pakaian & Clothing
                        } elseif (stripos($ci['name'], 'jaket') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1551524164-6cf2ac531fb4?w=80&h=80&fit=crop&auto=format'; // outdoor jacket
                        } elseif (stripos($ci['name'], 'poncho') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=80&h=80&fit=crop&auto=format'; // rain gear
                          
                        // Navigation & Tools
                        } elseif (stripos($ci['name'], 'kompas') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=80&h=80&fit=crop&auto=format'; // compass
                        } elseif (stripos($ci['name'], 'gps') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=80&h=80&fit=crop&auto=format'; // gps device
                        } elseif (stripos($ci['name'], 'multi-tool') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=80&h=80&fit=crop&auto=format'; // multi-tool
                        } elseif (stripos($ci['name'], 'parang') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=80&h=80&fit=crop&auto=format'; // survival knife
                          
                        // Water & Hydration
                        } elseif (stripos($ci['name'], 'water filter') !== false || stripos($ci['name'], 'hydration') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=80&h=80&fit=crop&auto=format'; // water gear
                          
                        // Safety & Emergency
                        } elseif (stripos($ci['name'], 'first aid') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1551524164-6cf2ac531fb4?w=80&h=80&fit=crop&auto=format'; // first aid
                        } elseif (stripos($ci['name'], 'whistle') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=80&h=80&fit=crop&auto=format'; // emergency whistle
                        } elseif (stripos($ci['name'], 'paracord') !== false || stripos($ci['name'], 'rope') !== false) {
                          $imageUrl = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=80&h=80&fit=crop&auto=format'; // rope/paracord
                        }
                      @endphp
                      
                      @if(is_numeric($ci['id']))
                        @php $p = \App\Models\Product::find($ci['id']); @endphp
                        @if($p && $p->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($p->image))
                          <img src="{{ asset('storage/'.$p->image) }}" class="cart-item-image" alt="{{ $ci['name'] }}">
                        @else
                          <img src="{{ $imageUrl }}" class="cart-item-image" alt="{{ $ci['name'] }}">
                        @endif
                      @else
                        <img src="{{ $imageUrl }}" class="cart-item-image" alt="{{ $ci['name'] }}">
                      @endif
                    </div>
                    <div class="flex-grow-1">
                      <div class="product-name">{{ $ci['name'] }}</div>
                      <div class="product-details">
                        Qty: <span class="fw-semibold">{{ $ci['qty'] }}</span> × 
                        Rp {{ number_format($ci['price'], 0, ',', '.') }}/hari
                      </div>
                    </div>
                    <div class="price-amount">
                      Rp {{ number_format($line, 0, ',', '.') }}
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="order-item">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="fs-5 fw-semibold">Subtotal</span>
                  <span class="fs-4 fw-bold text-success">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <a href="/checkout" class="quick-action-btn w-100 text-center">
                  <i class="bi bi-credit-card"></i>
                  Proceed to Checkout
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Quick Actions & Order History -->
      <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="bi bi-lightning"></i>
              Quick Actions
            </h3>
          </div>
          <div class="card-body">
            <div class="quick-actions">
              <a href="/shop" class="quick-action-btn">
                <i class="bi bi-shop"></i>
                Browse Gear
              </a>
              <a href="/cart" class="quick-action-btn">
                <i class="bi bi-cart"></i>
                View Cart ({{ count($cart) }})
              </a>
              @if(auth()->check())
                <a href="/about" class="quick-action-btn">
                  <i class="bi bi-info-circle"></i>
                  About Us
                </a>
              @else
                <a href="/login" class="quick-action-btn">
                  <i class="bi bi-box-arrow-in-right"></i>
                  Login
                </a>
              @endif
            </div>
          </div>
        </div>

        <!-- Order History Section -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="bi bi-clock-history"></i>
              Order History
            </h3>
          </div>
          <div class="card-body p-0">
            @if(auth()->check())
              @if(isset($orders) && $orders->count())
                @foreach($orders->take(5) as $order)
                  <div class="order-item">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <div class="order-number">Order #{{ $order->id }}</div>
                        <div class="order-date">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                      </div>
                      <div class="text-end">
                        <div class="order-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                        <span class="status-badge status-{{ strtolower($order->status ?? 'pending') }}">
                          {{ ucfirst($order->status ?? 'Pending') }}
                        </span>
                      </div>
                    </div>
                  </div>
                @endforeach
                
                @if($orders->count() > 5)
                  <div class="order-item text-center">
                    <small class="text-muted">Showing 5 of {{ $orders->count() }} orders</small>
                  </div>
                @endif
              @else
                <div class="empty-state">
                  <i class="bi bi-inbox"></i>
                  <h4>No Orders Yet</h4>
                  <p class="text-muted">Start exploring our outdoor gear collection!</p>
                </div>
              @endif
            @else
              <div class="empty-state">
                <i class="bi bi-exclamation-triangle"></i>
                <h4>Login Required</h4>
                <p class="text-muted">Please login to see your order history.</p>
                <a href="/login" class="quick-action-btn">
                  <i class="bi bi-box-arrow-in-right"></i>
                  Login Now
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>