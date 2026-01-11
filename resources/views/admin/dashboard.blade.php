<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard — tendakian</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    
    .admin-header {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      padding: 40px 0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      margin-bottom: 40px;
      color: white;
      position: relative;
      overflow: hidden;
    }
    
    .admin-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="outdoor" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M20 5 L30 20 L20 35 L10 20 Z" fill="white" opacity="0.05"/><circle cx="5" cy="5" r="1" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23outdoor)"/></svg>');
      opacity: 0.3;
    }
    
    .admin-header h1 {
      color: white;
      font-weight: 700;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
    }
    
    .admin-header .subtitle {
      color: rgba(255,255,255,0.9);
      position: relative;
      z-index: 1;
    }
    
    .admin-avatar {
      width: 60px;
      height: 60px;
      background: rgba(255,255,255,0.15);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 700;
      margin-right: 20px;
      border: 3px solid rgba(255,255,255,0.2);
      position: relative;
      z-index: 1;
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
    
    .stat-icon.orders { background: linear-gradient(135deg, #2d7a6e, #3d9b8c); color: white; }
    .stat-icon.revenue { background: linear-gradient(135deg, #1e4d3f, #2d7a6e); color: white; }
    .stat-icon.products { background: linear-gradient(135deg, #ffc107, #ffb300); color: white; }
    .stat-icon.customers { background: linear-gradient(135deg, #17a2b8, #138496); color: white; }
    
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
  <!-- Admin Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <div class="admin-avatar">
            <i class="bi bi-shield-check"></i>
          </div>
          <div>
            <h1 class="h2 mb-2">Admin Dashboard</h1>
            <p class="subtitle mb-0">Manage tendakian outdoor gear rental system</p>
          </div>
        </div>
        <div class="d-flex gap-3 align-items-center">
          <span class="small opacity-75">Administrator</span>
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-logout">
              <i class="bi bi-box-arrow-right me-2"></i>
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="container">
    <div class="stats-cards">
      <div class="row g-4">
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon orders">
              <i class="bi bi-receipt"></i>
            </div>
            <div class="stat-number">{{ $totalOrders }}</div>
            <div class="stat-label">Total Orders</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon revenue">
              <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-label">Total Revenue</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon products">
              <i class="bi bi-box"></i>
            </div>
            <div class="stat-number">{{ $totalProducts }}</div>
            <div class="stat-label">Products</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon customers">
              <i class="bi bi-people"></i>
            </div>
            <div class="stat-number">{{ $totalCustomers }}</div>
            <div class="stat-label">Customers</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container pb-5">
    <div class="row">
      <!-- Recent Orders -->
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="bi bi-clock-history"></i>
              Recent Orders
            </h3>
          </div>
          <div class="card-body p-0">
            @if($recentOrders->count() > 0)
              @foreach($recentOrders as $order)
              <div class="order-item">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="order-number">{{ $order->order_number }}</div>
                    <div class="order-date">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                  </div>
                  <div class="text-end">
                    <div class="order-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                    <span class="status-badge status-{{ strtolower($order->status) }}">
                      {{ ucfirst($order->status) }}
                    </span>
                  </div>
                </div>
              </div>
              @endforeach
              
              <div class="order-item text-center">
                <a href="/admin/orders" class="quick-action-btn">
                  <i class="bi bi-eye"></i>
                  View All Orders
                </a>
              </div>
            @else
              <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h4>No Orders Yet</h4>
                <p class="text-muted">Orders will appear here when customers start placing them.</p>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Quick Actions & System Info -->
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
              <a href="/admin/orders" class="quick-action-btn">
                <i class="bi bi-receipt"></i>
                Manage Orders
              </a>
              <a href="/admin/products" class="quick-action-btn">
                <i class="bi bi-box"></i>
                Manage Products
              </a>
              <a href="/admin/products/create" class="quick-action-btn">
                <i class="bi bi-plus-circle"></i>
                Add Product
              </a>
            </div>
          </div>
        </div>

        <!-- System Status -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="bi bi-speedometer2"></i>
              System Status
            </h3>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span>Pending Orders</span>
              <span class="badge bg-warning">{{ $pendingOrders }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span>Paid Orders</span>
              <span class="badge bg-success">{{ $paidOrders }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span>Low Stock Products</span>
              <span class="badge bg-danger">{{ $lowStockProducts }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span>System Status</span>
              <span class="badge bg-success">Online</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>