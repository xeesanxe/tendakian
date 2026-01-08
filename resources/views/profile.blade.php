<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <title>tendakian — Profile</title>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .profile-header {
      background: linear-gradient(135deg, #2d5f5d 0%, #1a3a38 100%);
      color: white;
      padding: 40px 0;
      margin-bottom: 30px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .profile-avatar {
      width: 80px;
      height: 80px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: bold;
      color: #2d5f5d;
      margin-bottom: 15px;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      margin-bottom: 25px;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .card-title {
      font-weight: 700;
      color: #2d3748;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .card-title svg {
      width: 24px;
      height: 24px;
    }
    .empty-state {
      text-align: center;
      padding: 40px 20px;
      color: #718096;
    }
    .empty-state svg {
      width: 64px;
      height: 64px;
      margin-bottom: 16px;
      opacity: 0.5;
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
      border-left: 4px solid #2d5f5d;
      transition: border-color 0.2s;
    }
    .order-card:hover {
      border-left-color: #1a3a38;
    }
    .status-badge {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
    }
    .status-pending { background-color: #fef3c7; color: #92400e; }
    .status-paid { background-color: #d1fae5; color: #065f46; }
    .status-cancelled { background-color: #fee2e2; color: #991b1b; }
    .btn-checkout {
      background: linear-gradient(135deg, #2d5f5d 0%, #1a3a38 100%);
      border: none;
      padding: 12px 30px;
      font-weight: 600;
      border-radius: 8px;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-checkout:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(45, 95, 93, 0.4);
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
  </style>
</head>
<body>
  <!-- Profile Header -->
  <div class="profile-header">
    <div class="container">
      <div class="d-flex align-items-center">
        <div class="profile-avatar">
          @if(auth()->check())
            {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->email, 0, 1)) }}
          @else
            <svg fill="currentColor" viewBox="0 0 16 16" width="40" height="40">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
          @endif
        </div>
        <div class="ms-3">
          <h1 class="h2 mb-1">
            @if(auth()->check())
              {{ auth()->user()->name ?? auth()->user()->email }}
            @else
              Guest User
            @endif
          </h1>
          <div class="d-flex align-items-center gap-3">
            <p class="mb-0 opacity-75">Welcome to your profile</p>
            @if(auth()->check())
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">
                  Logout
                </button>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container pb-5">
    @if(!auth()->check())
      <div class="alert alert-info d-flex align-items-center" role="alert">
        <svg width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </svg>
        <div>
          Anda belum login. <a href="/login" class="alert-link fw-semibold">Login</a> atau <a href="/register" class="alert-link fw-semibold">Daftar</a> untuk pengalaman lebih baik.
        </div>
      </div>
    @endif

    <div class="row">
      <!-- Cart Section -->
      <div class="col-lg-7 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">
              <svg fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
              Your Cart
            </h3>

            @php $cart = session('cart', []); $subtotal = 0; @endphp
            
            @if(empty($cart))
              <div class="empty-state">
                <svg fill="currentColor" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <p class="mb-0">Keranjang Anda kosong</p>
                <small>Mulai berbelanja sekarang!</small>
              </div>
            @else
              <div class="cart-items">
                @foreach($cart as $ci)
                  @php $line = $ci['price'] * $ci['qty']; $subtotal += $line; @endphp
                  <div class="cart-item d-flex align-items-center">
                    <div class="me-3">
                      @if(is_numeric($ci['id']))
                        @php $p = \App\Models\Product::find($ci['id']); @endphp
                        @if($p && $p->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($p->image))
                          <img src="{{ asset('storage/'.$p->image) }}" class="cart-item-image" alt="{{ $ci['name'] }}">
                        @else
                          <img src="https://source.unsplash.com/80x80/?camping,gear" class="cart-item-image" alt="{{ $ci['name'] }}">
                        @endif
                      @else
                        <img src="https://source.unsplash.com/80x80/?camping,gear" class="cart-item-image" alt="{{ $ci['name'] }}">
                      @endif
                    </div>
                    <div class="flex-grow-1">
                      <div class="product-name">{{ $ci['name'] }}</div>
                      <div class="product-details">
                        Qty: <span class="fw-semibold">{{ $ci['qty'] }}</span> × 
                        ${{ number_format($ci['price'], 2) }}
                      </div>
                    </div>
                    <div class="price-amount">
                      ${{ number_format($line, 2) }}
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="cart-summary">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="fs-5 fw-semibold">Subtotal</span>
                  <span class="fs-4 fw-bold text-success">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <a href="/checkout" class="btn btn-checkout btn-primary w-100">
                  <svg width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                  Proceed to Checkout
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Order History Section -->
      <div class="col-lg-5">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">
              <svg fill="currentColor" viewBox="0 0 16 16">
                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
              </svg>
              Order History
            </h3>

            @if(auth()->check())
              @if(isset($orders) && $orders->count())
                @foreach($orders as $order)
                  <div class="card order-card mb-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="mb-0">Order #{{ $order->id }}</h5>
                        <span class="status-badge status-{{ strtolower($order->status ?? 'pending') }}">
                          {{ $order->status ?? 'Pending' }}
                        </span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-success fw-bold fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        <small class="text-muted">{{ $order->created_at->format('M d, Y H:i') }}</small>
                      </div>
                      <ul class="list-unstyled mb-2">
                        @foreach($order->items as $it)
                          <li class="small text-muted mb-1">
                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                              <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>
                            {{ $it->product->name ?? 'Item #' . $it->product_id }} × {{ $it->qty }} — Rp {{ number_format($it->price, 0, ',', '.') }}
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="empty-state">
                  <svg fill="currentColor" viewBox="0 0 16 16">
                    <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13zM1.5 1a.5.5 0 0 0-.5.5V5h4V1H1.5zM5 6H1v4h4V6zm1 4h4V6H6v4zm-1 1H1v3.5a.5.5 0 0 0 .5.5H5v-4zm1 0v4h4v-4H6zm5 0v4h3.5a.5.5 0 0 0 .5-.5V11h-4zm0-1h4V6h-4v4zm0-5h4V1.5a.5.5 0 0 0-.5-.5H11v4zm-1 0V1H6v4h4z"/>
                  </svg>
                  <p class="mb-0">Tidak ada pesanan</p>
                  <small>Riwayat pesanan Anda akan muncul di sini</small>
                </div>
              @endif
            @else
              <div class="alert alert-warning" role="alert">
                <svg width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                Please <a href="/login" class="alert-link fw-semibold">login</a> to see your order history.
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