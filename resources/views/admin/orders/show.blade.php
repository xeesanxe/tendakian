<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order {{ $order->order_number }} — tendakian Admin</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .admin-header {
      background: white;
      padding: 20px 0;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      margin-bottom: 20px;
    }
    .info-label {
      font-weight: 600;
      color: #6c757d;
      font-size: 0.875rem;
      margin-bottom: 4px;
    }
    .info-value {
      font-size: 1rem;
      color: #212529;
      font-weight: 500;
    }
    .table thead {
      background-color: #f8f9fa;
    }
    .table thead th {
      border-bottom: 2px solid #dee2e6;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
    }
    .badge {
      padding: 6px 12px;
      font-weight: 500;
      font-size: 0.875rem;
    }
    .status-pending { background-color: #ffc107; }
    .status-paid { background-color: #28a745; }
    .status-cancelled { background-color: #dc3545; }
    .action-buttons .btn {
      padding: 8px 20px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h3 mb-1 fw-bold">Order Details</h1>
          <p class="text-muted mb-0 small">Order #{{ $order->order_number }}</p>
        </div>
        <div class="d-flex gap-2 align-items-center">
          <span class="text-muted small me-2">Admin Panel</span>
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-outline-danger btn-sm">
              <svg width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                <path d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
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
      <div class="card-body">
        <h5 class="card-title mb-4 fw-bold">Order Summary</h5>
        <div class="row">
          <div class="col-md-3">
            <div class="info-label">Status</div>
            <div class="info-value">
              <span class="badge status-{{ strtolower($order->status) }}">
                {{ ucfirst($order->status) }}
              </span>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-label">Total Amount</div>
            <div class="info-value text-success fw-bold">${{ number_format($order->total, 2) }}</div>
          </div>
          <div class="col-md-6">
            <div class="info-label">Rental Period</div>
            <div class="info-value">{{ $order->rental_start }} to {{ $order->rental_end }}</div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="info-label">Shipping Address</div>
            <div class="info-value">{{ $order->shipping_address }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Order Items Card -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 fw-bold">Order Items</h5>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>Product</th>
                <th class="text-center" style="width: 15%">Quantity</th>
                <th class="text-end" style="width: 15%">Price</th>
                <th class="text-end" style="width: 15%">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->items as $it)
              <tr>
                <td class="align-middle">
                  <span class="fw-semibold">{{ $it->product ? $it->product->name : 'N/A' }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="badge bg-secondary">{{ $it->quantity }}</span>
                </td>
                <td class="align-middle text-end">${{ number_format($it->price, 2) }}</td>
                <td class="align-middle text-end fw-bold">${{ number_format($it->total, 2) }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                <td class="text-end fw-bold text-success fs-5">${{ number_format($order->total, 2) }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="card">
      <div class="card-body">
        <div class="action-buttons d-flex gap-2 flex-wrap">
          <form method="POST" action="{{ url('/admin/orders/'.$order->id.'/mark-paid') }}" class="d-inline">
            @csrf
            <button class="btn btn-success" type="submit">
              <svg width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
              </svg>
              Mark as Paid
            </button>
          </form>
          
          <form method="POST" action="{{ url('/admin/orders/'.$order->id.'/cancel') }}" class="d-inline">
            @csrf
            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to cancel this order?')">
              <svg width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
              Cancel Order
            </button>
          </form>
          
          <a href="{{ url('/admin/orders') }}" class="btn btn-outline-secondary">
            <svg width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back to Orders
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>