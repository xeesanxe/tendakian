<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products Management — tendakian Admin</title>
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
    
    .stat-icon.total { background: rgba(13, 110, 253, 0.1); color: #0d6efd; }
    .stat-icon.low-stock { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
    .stat-icon.out-stock { background: rgba(108, 117, 125, 0.1); color: #6c757d; }
    .stat-icon.value { background: rgba(40, 167, 69, 0.1); color: #28a745; }
    
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      overflow: hidden;
    }
    
    .search-card {
      background: white;
      border-radius: 16px;
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      margin-bottom: 30px;
    }
    
    .search-input {
      border-radius: 12px;
      border: 2px solid #e9ecef;
      padding: 12px 20px;
      transition: all 0.3s ease;
    }
    
    .search-input:focus {
      border-color: #2d7a6e;
      box-shadow: 0 0 0 0.2rem rgba(45, 122, 110, 0.15);
    }
    
    .btn-search {
      background: linear-gradient(135deg, #2d7a6e, #3d9b8c);
      border: none;
      border-radius: 12px;
      padding: 12px 24px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-search:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
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
    
    .product-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 12px;
      border: 2px solid #e9ecef;
      transition: all 0.3s ease;
    }
    
    .product-image:hover {
      transform: scale(1.1);
      border-color: #2d7a6e;
    }
    
    .product-name {
      font-weight: 600;
      color: #495057;
      font-size: 1rem;
      margin-bottom: 4px;
    }
    
    .product-sku {
      color: #6c757d;
      font-size: 0.875rem;
      background: #f8f9fa;
      padding: 2px 8px;
      border-radius: 6px;
      display: inline-block;
    }
    
    .product-id {
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
    
    .stock-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.75rem;
    }
    
    .stock-high { background: #d1fae5; color: #065f46; }
    .stock-medium { background: #fef3c7; color: #92400e; }
    .stock-low { background: #fee2e2; color: #991b1b; }
    .stock-out { background: #f3f4f6; color: #6b7280; }
    
    .btn-edit {
      background: linear-gradient(135deg, #0d6efd, #0b5ed7);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      margin-right: 8px;
    }
    
    .btn-edit:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
    }
    
    .btn-delete {
      background: linear-gradient(135deg, #dc3545, #c82333);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-delete:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
    }
    
    .btn-add-product {
      background: linear-gradient(135deg, #28a745, #20c997);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
    }
    
    .btn-add-product:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
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
    
    .alert {
      border-radius: 12px;
      border: none;
      padding: 16px 20px;
      margin-bottom: 24px;
    }
    
    .alert-success {
      background: linear-gradient(135deg, #d1fae5, #a7f3d0);
      color: #065f46;
      border-left: 4px solid #10b981;
    }
    
    .alert-danger {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: #991b1b;
      border-left: 4px solid #ef4444;
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
      background: linear-gradient(135deg, #2d7a6e, #3d9b8c);
      border-color: #2d7a6e;
      color: white;
      box-shadow: 0 2px 8px rgba(45, 122, 110, 0.3);
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h2 mb-2">Products Management</h1>
          <p class="mb-0">Manage outdoor gear inventory and pricing</p>
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
              <i class="bi bi-box"></i>
            </div>
            <h3 class="h4 mb-1">{{ $products->total() }}</h3>
            <p class="text-muted mb-0 small">Total Products</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon low-stock">
              <i class="bi bi-exclamation-triangle"></i>
            </div>
            <h3 class="h4 mb-1">{{ $products->where('stock', '<=', 5)->where('stock', '>', 0)->count() }}</h3>
            <p class="text-muted mb-0 small">Low Stock</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon out-stock">
              <i class="bi bi-x-circle"></i>
            </div>
            <h3 class="h4 mb-1">{{ $products->where('stock', 0)->count() }}</h3>
            <p class="text-muted mb-0 small">Out of Stock</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card">
            <div class="stat-icon value">
              <i class="bi bi-currency-dollar"></i>
            </div>
            <h3 class="h4 mb-1">Rp {{ number_format($products->sum('price'), 0, ',', '.') }}</h3>
            <p class="text-muted mb-0 small">Total Value</p>
          </div>
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

    <!-- Search & Add Product -->
    <div class="search-card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">
          <i class="bi bi-search me-2"></i>
          Search Products
        </h3>
        <a class="btn btn-add-product" href="{{ route('admin.products.create') }}">
          <i class="bi bi-plus-circle me-2"></i>
          Add New Product
        </a>
      </div>
      
      <form method="GET">
        <div class="input-group">
          <input
            type="text"
            name="q"
            class="form-control search-input"
            placeholder="Search by product name or SKU..."
            value="{{ request('q') }}"
          >
          <button class="btn btn-search" type="submit">
            <i class="bi bi-search me-2"></i>
            Search
          </button>
        </div>
      </form>
    </div>

    <!-- Products Table -->
    <div class="card">
      <div class="card-body p-0">
        @if($products->count() > 0)
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th style="width: 8%">ID</th>
                <th style="width: 25%">Product Details</th>
                <th style="width: 15%">Image</th>
                <th style="width: 15%">Price</th>
                <th style="width: 12%">Stock</th>
                <th style="width: 25%" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $p)
              <tr>
                <td>
                  <span class="product-id">#{{ $p->id }}</span>
                </td>
                <td>
                  <div class="product-name">{{ $p->name }}</div>
                  <span class="product-sku">{{ $p->sku }}</span>
                </td>
                <td>
                  @if($p->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($p->image))
                    <img src="{{ asset('storage/'.$p->image) }}" class="product-image" alt="{{ $p->name }}">
                  @else
                    <img src="https://source.unsplash.com/80x80/?camping,gear" class="product-image" alt="{{ $p->name }}">
                  @endif
                </td>
                <td>
                  <div class="price-amount">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                </td>
                <td>
                  @if($p->stock == 0)
                    <span class="stock-badge stock-out">Out of Stock</span>
                  @elseif($p->stock <= 5)
                    <span class="stock-badge stock-low">{{ $p->stock }} left</span>
                  @elseif($p->stock <= 20)
                    <span class="stock-badge stock-medium">{{ $p->stock }} units</span>
                  @else
                    <span class="stock-badge stock-high">{{ $p->stock }} units</span>
                  @endif
                </td>
                <td class="text-end">
                  <a
                    class="btn btn-edit"
                    href="{{ route('admin.products.edit', ['id' => $p->id]) }}"
                  >
                    <i class="bi bi-pencil me-1"></i>
                    Edit
                  </a>

                  <form
                    method="POST"
                    action="{{ route('admin.products.destroy', ['id' => $p->id]) }}"
                    style="display:inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this product?')"
                  >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete">
                      <i class="bi bi-trash me-1"></i>
                      Delete
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
            <i class="bi bi-inbox"></i>
            <h4>No Products Found</h4>
            <p class="text-muted">
              @if(request('q'))
                No products match your search criteria.
              @else
                Start by adding your first product to the inventory.
              @endif
            </p>
            <a href="{{ route('admin.products.create') }}" class="btn btn-add-product">
              <i class="bi bi-plus-circle me-2"></i>
              Add First Product
            </a>
          </div>
        @endif
      </div>
      
      <!-- Pagination -->
      @if($products->hasPages())
      <div class="card-footer bg-white border-top-0 py-4">
        <div class="d-flex justify-content-center">
          {{ $products->appends(request()->query())->links('custom-pagination') }}
        </div>
      </div>
      @endif
    </div>
  </div>

</body>
</html>
