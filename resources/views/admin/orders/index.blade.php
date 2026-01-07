<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders — tendakian Admin</title>
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
      padding: 15px;
    }
    .table tbody tr {
      transition: background-color 0.2s;
    }
    .table tbody tr:hover {
      background-color: #f8f9fa;
    }
    .badge {
      padding: 6px 12px;
      font-weight: 500;
      font-size: 0.75rem;
    }
    .status-pending { background-color: #ffc107; }
    .status-paid { background-color: #28a745; }
    .status-cancelled { background-color: #dc3545; }
    .btn-view {
      padding: 4px 16px;
      font-size: 0.875rem;
      border-radius: 6px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h3 mb-1 fw-bold">Order Management</h1>
          <p class="text-muted mb-0 small">Manage and track all customer orders</p>
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
    <div class="card">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th style="width: 5%">#</th>
                <th style="width: 20%">Order Number</th>
                <th style="width: 15%">Total</th>
                <th style="width: 15%">Status</th>
                <th style="width: 25%">Created</th>
                <th style="width: 20%" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $o)
              <tr>
                <td class="align-middle">
                  <span class="text-muted fw-semibold">{{ $o->id }}</span>
                </td>
                <td class="align-middle">
                  <span class="fw-semibold">{{ $o->order_number }}</span>
                </td>
                <td class="align-middle">
                  <span class="fw-bold text-success">${{ number_format($o->total, 2) }}</span>
                </td>
                <td class="align-middle">
                  <span class="badge status-{{ strtolower($o->status) }}">
                    {{ ucfirst($o->status) }}
                  </span>
                </td>
                <td class="align-middle text-muted">
                  {{ $o->created_at->format('M d, Y h:i A') }}
                </td>
                <td class="align-middle text-end">
                  <a href="{{ url('/admin/orders/'.$o->id) }}" class="btn btn-primary btn-sm btn-view">
                    View Details
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- Pagination -->
      @if($orders->hasPages())
      <div class="card-footer bg-white border-top">
        <div class="d-flex justify-content-center">
          {{ $orders->links() }}
        </div>
      </div>
      @endif
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>