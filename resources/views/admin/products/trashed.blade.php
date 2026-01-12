<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trashed Products — tendakian Admin</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    
    .admin-header {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 50%, #bd2130 100%);
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
    
    .search-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.08);
      padding: 30px;
      margin-bottom: 30px;
    }
    
    .products-table {
      background: white;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.08);
      overflow: hidden;
    }
    
    .table {
      margin: 0;
    }
    
    .table th {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border: none;
      font-weight: 600;
      color: #495057;
      padding: 20px 24px;
      font-size: 0.9rem;
    }
    
    .table td {
      padding: 20px 24px;
      border-color: #f1f3f4;
      vertical-align: middle;
    }
    
    .product-image {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 12px;
      border: 2px solid #e9ecef;
      transition: all 0.3s ease;
      opacity: 0.6;
    }
    
    .product-name {
      font-weight: 600;
      color: #6c757d;
      font-size: 1rem;
      margin-bottom: 4px;
    }
    
    .product-sku {
      color: #adb5bd;
      font-size: 0.875rem;
      background: #f8f9fa;
      padding: 2px 8px;
      border-radius: 6px;
      display: inline-block;
    }
    
    .deleted-badge {
      background: #f8d7da;
      color: #721c24;
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.75rem;
    }
    
    .btn-restore {
      background: linear-gradient(135deg, #28a745, #20c997);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.875rem;
      transition: all 0.3s ease;
      margin-right: 8px;
    }
    
    .btn-restore:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
    }
    
    .btn-delete-permanent {
      background: linear-gradient(135deg, #dc3545, #c82333);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.875rem;
      transition: all 0.3s ease;
    }
    
    .btn-delete-permanent:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
    }
    
    .empty-state {
      text-align: center;
      padding: 80px 40px;
      color: #6c757d;
    }
    
    .empty-state i {
      font-size: 4rem;
      margin-bottom: 24px;
      color: #dee2e6;
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
  </style>
</head>
<body>
  <!-- Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h2 mb-2">Trashed Products</h1>
          <p class="mb-0">Manage deleted products - restore or permanently delete</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
          <a href="{{ route('admin.products.index') }}" class="btn btn-logout me-2">
            <i class="bi bi-arrow-left me-2"></i>
            Back to Products
          </a>
          <a href="{{ route('admin.dashboard') }}" class="btn btn-logout me-2">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
          </a>
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
    <!-- Success Alert -->
    @if(session('success'))
      <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>{{ session('success') }}</div>
      </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>{{ session('error') }}</div>
      </div>
    @endif

    <!-- Search -->
    <div class="search-card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">
          <i class="bi bi-search me-2"></i>
          Search Trashed Products
        </h3>
        <div class="text-muted">
          <i class="bi bi-info-circle me-1"></i>
          {{ $products->total() }} trashed product(s)
        </div>
      </div>
      
      <form method="GET">
        <div class="input-group">
          <input
            type="text"
            name="q"
            class="form-control"
            placeholder="Search by product name or SKU..."
            value="{{ request('q') }}"
          >
          <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search me-2"></i>
            Search
          </button>
        </div>
      </form>
    </div>

    <!-- Products Table -->
    <div class="products-table">
      @if($products->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="width: 8%">ID</th>
                <th style="width: 30%">Product Details</th>
                <th style="width: 15%">Image</th>
                <th style="width: 15%">Price</th>
                <th style="width: 12%">Deleted At</th>
                <th style="width: 20%" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $p)
              <tr>
                <td>
                  <span class="badge bg-secondary">#{{ $p->id }}</span>
                </td>
                <td>
                  <div class="product-name">{{ $p->name }}</div>
                  <span class="product-sku">{{ $p->sku }}</span>
                  <div class="mt-1">
                    <span class="deleted-badge">
                      <i class="bi bi-trash me-1"></i>
                      Deleted
                    </span>
                  </div>
                </td>
                <td>
                  @if($p->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($p->image))
                    <img src="{{ asset('storage/'.$p->image) }}" class="product-image" alt="{{ $p->name }}">
                  @else
                    <img src="https://source.unsplash.com/80x80/?camping,gear" class="product-image" alt="{{ $p->name }}">
                  @endif
                </td>
                <td>
                  <div class="text-muted">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                </td>
                <td>
                  <div class="text-muted small">
                    {{ $p->deleted_at->format('M d, Y') }}<br>
                    {{ $p->deleted_at->format('H:i') }}
                  </div>
                </td>
                <td class="text-end">
                  <form
                    method="POST"
                    action="{{ route('admin.products.restore', ['id' => $p->id]) }}"
                    style="display:inline-block"
                    onsubmit="return confirm('Restore this product?')"
                  >
                    @csrf
                    <button class="btn btn-restore" title="Restore Product">
                      <i class="bi bi-arrow-clockwise me-1"></i>
                      Restore
                    </button>
                  </form>

                  <form
                    method="POST"
                    action="{{ route('admin.products.destroy', ['id' => $p->id]) }}"
                    style="display:inline-block"
                    onsubmit="return confirm('⚠️ PERMANENT DELETE: This action cannot be undone! Are you absolutely sure?')"
                  >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete-permanent" title="Delete Permanently">
                      <i class="bi bi-trash-fill me-1"></i>
                      Delete Forever
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state">
          <i class="bi bi-trash"></i>
          <h4>No Trashed Products</h4>
          <p class="text-muted">
            @if(request('q'))
              No trashed products match your search criteria.
            @else
              All products are active. Deleted products will appear here.
            @endif
          </p>
          <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-2"></i>
            Back to Products
          </a>
        </div>
      @endif
    </div>
    
    <!-- Pagination -->
    @if($products->hasPages())
    <div class="d-flex justify-content-center mt-4">
      {{ $products->appends(request()->query())->links() }}
    </div>
    @endif
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>