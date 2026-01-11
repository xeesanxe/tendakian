<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order {{ $order->order_number }} — tendakian Admin</title>
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
    
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      margin-bottom: 30px;
      overflow: hidden;
    }
    
    .card-header {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border-bottom: 1px solid #f1f3f4;
      padding: 24px;
    }
    
    .card-title {
      font-weight: 700;
      color: #495057;
      margin-bottom: 0;
      font-size: 1.25rem;
    }
    
    .info-label {
      font-weight: 600;
      color: #6c757d;
      font-size: 0.875rem;
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .info-value {
      font-size: 1.1rem;
      color: #212529;
      font-weight: 600;
      margin-bottom: 20px;
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
    }
    
    .table tfoot td {
      padding: 24px;
      border-top: 2px solid #dee2e6;
      font-weight: 700;
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
    
    .price-amount {
      font-weight: 700;
      color: #28a745;
      font-size: 1.2rem;
    }
    
    .order-id {
      background: #e9ecef;
      color: #6c757d;
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
    }
    
    .btn-action {
      padding: 12px 24px;
      font-size: 0.875rem;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
      border: none;
      margin-right: 10px;
      margin-bottom: 10px;
    }
    
    .btn-success {
      background: linear-gradient(135deg, #28a745, #20c997);
    }
    
    .btn-danger {
      background: linear-gradient(135deg, #dc3545, #c82333);
    }
    
    .btn-outline-secondary {
      border: 2px solid #6c757d;
      color: #6c757d;
      background: white;
    }
    
    .btn-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
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
    
    .summary-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 24px;
      margin-bottom: 0;
    }
    
    .summary-item {
      padding: 0;
    }
    
    .rental-period {
      background: linear-gradient(135deg, #e3f2fd, #bbdefb);
      padding: 16px;
      border-radius: 12px;
      border-left: 4px solid #2196f3;
    }
    
    .address-section {
      background: linear-gradient(135deg, #f3e5f5, #e1bee7);
      padding: 16px;
      border-radius: 12px;
      border-left: 4px solid #9c27b0;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h2 mb-2">Order Details</h1>
          <p class="mb-0">Order <span class="order-id">#{{ $order->order_number }}</span></p>
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

  <!-- Content -->
  <div class="container pb-5">
    <!-- Order Summary Card -->
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="bi bi-clipboard-data me-2"></i>
          Order Summary
        </h5>
      </div>
      <div class="card-body">
        <div class="summary-grid">
          <div class="summary-item">
            <div class="info-label">Status</div>
            <div class="info-value">
              <span class="badge status-{{ strtolower($order->status) }}">
                {{ ucfirst($order->status) }}
              </span>
            </div>
          </div>
          <div class="summary-item">
            <div class="info-label">Total Amount</div>
            <div class="info-value price-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
          </div>
          @if($order->rental_start && $order->rental_end)
          <div class="summary-item">
            <div class="info-label">Rental Period</div>
            <div class="rental-period">
              <div class="d-flex align-items-center">
                <i class="bi bi-calendar-range me-2 text-primary"></i>
                <div>
                  <div class="fw-bold">{{ \Carbon\Carbon::parse($order->rental_start)->format('M d, Y') }}</div>
                  <small class="text-muted">to</small>
                  <div class="fw-bold">{{ \Carbon\Carbon::parse($order->rental_end)->format('M d, Y') }}</div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
        
        @if($order->shipping_address)
        <div class="address-section">
          <div class="info-label mb-2">
            <i class="bi bi-geo-alt me-1"></i>
            Shipping Address
          </div>
          <div class="info-value mb-0">{{ $order->shipping_address }}</div>
        </div>
        @endif
      </div>
    </div>

    <!-- Order Items Card -->
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="bi bi-bag-check me-2"></i>
          Order Items
        </h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>Product</th>
                <th class="text-center" style="width: 15%">Quantity</th>
                <th class="text-end" style="width: 15%">Price</th>
                <th class="text-end" style="width: 15%">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->items as $item)
              <tr>
                <td class="align-middle">
                  <div class="fw-semibold">{{ $item->product ? $item->product->name : 'Product Not Found' }}</div>
                  @if(!$item->product)
                    <small class="text-muted">Product ID: {{ $item->product_id }}</small>
                  @endif
                </td>
                <td class="align-middle text-center">
                  <span class="badge bg-secondary fs-6">{{ $item->quantity }}</span>
                </td>
                <td class="align-middle text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="align-middle text-end fw-bold">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="text-end">Grand Total:</td>
                <td class="text-end price-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="bi bi-gear me-2"></i>
          Actions
        </h5>
      </div>
      <div class="card-body">
        <div class="d-flex flex-wrap gap-2">
          @if($order->status !== 'paid')
          <form method="POST" action="{{ url('/admin/orders/'.$order->id.'/mark-paid') }}" class="d-inline">
            @csrf
            <button class="btn btn-success btn-action" type="submit">
              <i class="bi bi-check-circle me-2"></i>
              Mark as Paid
            </button>
          </form>
          @endif
          
          @if($order->status !== 'cancelled')
          <form method="POST" action="{{ url('/admin/orders/'.$order->id.'/cancel') }}" class="d-inline">
            @csrf
            <button class="btn btn-danger btn-action" type="submit" onclick="return confirm('Are you sure you want to cancel this order?')">
              <i class="bi bi-x-circle me-2"></i>
              Cancel Order
            </button>
          </form>
          @endif
          
          <a href="{{ url('/admin/orders') }}" class="btn btn-outline-secondary btn-action">
            <i class="bi bi-arrow-left me-2"></i>
            Back to Orders
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>