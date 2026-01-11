<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders — tendakian Admin</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    
    .admin-header {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      padding: 30px 0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      margin-bottom: 40px;
      color: white;
    }
    
    .admin-header h1 {
      color: white;
      font-weight: 700;
      margin-bottom: 8px;
    }
    
    .admin-header .text-muted {
      color: rgba(255,255,255,0.8) !important;
    }
    
    .stats-cards {
      margin-top: -60px;
      margin-bottom: 30px;
      position: relative;
      z-index: 10;
    }
    
    .stat-card {
      background: white;
      border-radius: 16px;
      padding: 24px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      border: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .stat-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      margin-bottom: 16px;
    }
    
    .stat-icon.pending { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
    .stat-icon.paid { background: rgba(40, 167, 69, 0.1); color: #28a745; }
    .stat-icon.cancelled { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
    .stat-icon.total { background: rgba(13, 110, 253, 0.1); color: #0d6efd; }
    
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      overflow: hidden;
    }
    
    .table {
      margin-bottom: 0;
    }
    
    .table thead {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .table thead th {
      border: none;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.8px;
      padding: 20px 24px;
      color: #495057;
    }
    
    .table tbody td {
      padding: 20px 24px;
      border-top: 1px solid #f1f3f4;
      vertical-align: middle;
    }
    
    .table tbody tr {
      transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
      background-color: #f8f9fa;
      transform: scale(1.01);
    }
    
    .order-number {
      font-weight: 600;
      color: #495057;
      font-size: 0.95rem;
    }
    
    .order-id {
      background: #e9ecef;
      color: #6c757d;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 0.8rem;
      font-weight: 600;
    }
    
    .price-amount {
      font-weight: 700;
      color: #28a745;
      font-size: 1.1rem;
    }
    
    .badge {
      padding: 8px 16px;
      font-weight: 600;
      font-size: 0.75rem;
      border-radius: 20px;
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
    
    .btn-view {
      padding: 8px 20px;
      font-size: 0.875rem;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #0d6efd, #0b5ed7);
      border: none;
    }
    
    .btn-view:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
    }
    
    .btn-logout {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      color: white;
      padding: 8px 16px;
      border-radius: 10px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-logout:hover {
      background: rgba(255,255,255,0.2);
      color: white;
      transform: translateY(-1px);
    }
    
    .pagination {
      margin: 0;
      gap: 4px;
    }
    
    .page-item {
      margin: 0;
    }
    
    .page-link {
      border-radius: 8px;
      border: 1px solid #dee2e6;
      color: #6c757d;
      font-weight: 500;
      padding: 8px 12px;
      margin: 0;
      transition: all 0.3s ease;
      min-width: 40px;
      text-align: center;
    }
    
    .page-link:hover {
      background-color: #f8f9fa;
      color: #495057;
      border-color: #adb5bd;
      transform: translateY(-1px);
    }
    
    .page-item.active .page-link {
      background: linear-gradient(135deg, #0d6efd, #0b5ed7);
      border-color: #0d6efd;
      color: white;
      box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
    }
    
    .page-item.disabled .page-link {
      color: #adb5bd;
      background-color: #fff;
      border-color: #dee2e6;
    }
    
    .page-link:focus {
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #6c757d;
    }
    
    .empty-state i {
      font-size: 4rem;
      margin-bottom: 20px;
      opacity: 0.5;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h2 mb-2">Order Management</h1>
          <p class="mb-0">Manage and track all customer orders</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
          <a href="{{ route('admin.dashboard') }}" class="btn btn-logout me-2">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
          </a>
          <span class="small opacity-75">Admin Panel</span>
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
            <div class="stat-icon total">
              <i class="bi bi-receipt"></i>
            </div>
            <h3 class="h4 mb-1">{{ $orders->total() }}</h3>
            <p class="text-muted mb-0 small">Total Orders</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon pending">
              <i class="bi bi-clock"></i>
            </div>
            <h3 class="h4 mb-1">{{ $orders->where('status', 'pending')->count() }}</h3>
            <p class="text-muted mb-0 small">Pending Orders</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon paid">
              <i class="bi bi-check-circle"></i>
            </div>
            <h3 class="h4 mb-1">{{ $orders->where('status', 'paid')->count() }}</h3>
            <p class="text-muted mb-0 small">Paid Orders</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon cancelled">
              <i class="bi bi-x-circle"></i>
            </div>
            <h3 class="h4 mb-1">{{ $orders->where('status', 'cancelled')->count() }}</h3>
            <p class="text-muted mb-0 small">Cancelled Orders</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container pb-5">
    <div class="card">
      <div class="card-body p-0">
        @if($orders->count() > 0)
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th style="width: 8%">ID</th>
                <th style="width: 25%">Order Details</th>
                <th style="width: 18%">Amount</th>
                <th style="width: 15%">Status</th>
                <th style="width: 20%">Date</th>
                <th style="width: 14%" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $o)
              <tr>
                <td>
                  <span class="order-id">#{{ $o->id }}</span>
                </td>
                <td>
                  <div class="order-number">{{ $o->order_number }}</div>
                  <small class="text-muted">Order Number</small>
                </td>
                <td>
                  <div class="price-amount">Rp {{ number_format($o->total, 0, ',', '.') }}</div>
                </td>
                <td>
                  <span class="badge status-{{ strtolower($o->status) }}">
                    {{ ucfirst($o->status) }}
                  </span>
                </td>
                <td>
                  <div class="fw-semibold">{{ $o->created_at->format('M d, Y') }}</div>
                  <small class="text-muted">{{ $o->created_at->format('h:i A') }}</small>
                </td>
                <td class="text-end">
                  <a href="{{ url('/admin/orders/'.$o->id) }}" class="btn btn-primary btn-view">
                    <i class="bi bi-eye me-1"></i>
                    View
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="empty-state">
          <i class="bi bi-inbox"></i>
          <h4>No Orders Found</h4>
          <p class="text-muted">There are no orders to display at the moment.</p>
        </div>
        @endif
      </div>
      
      <!-- Pagination -->
      @if($orders->hasPages())
      <div class="card-footer bg-white border-top-0 py-4">
        <div class="d-flex justify-content-center">
          {{ $orders->links('custom-pagination') }}
        </div>
      </div>
      @endif
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>