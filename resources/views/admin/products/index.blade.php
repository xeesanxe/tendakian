<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Products</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Products</h1>
    <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
      New Product
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <form method="GET" class="mb-3">
    <div class="input-group">
      <input
        type="text"
        name="q"
        class="form-control"
        placeholder="Search by name or SKU"
        value="{{ request('q') }}"
      >
      <button class="btn btn-outline-secondary">Search</button>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Image</th>
          <th>Price</th>
          <th>Stock</th>
          <th style="width:140px">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $p)
          <tr>
            <td>{{ $p->id }}</td>
            <td>
              {{ $p->name }}
              <div class="text-muted small">{{ $p->sku }}</div>
            </td>
            <td style="width:120px">
              @if($p->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($p->image))
                <img src="{{ asset('storage/'.$p->image) }}" style="height:60px">
              @else
                <img src="https://source.unsplash.com/120x80/?camping,gear" style="height:60px">
              @endif
            </td>
            <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
            <td>{{ $p->stock }}</td>
            <td>
              <a
                class="btn btn-sm btn-outline-primary"
                href="{{ route('admin.products.edit', ['id' => $p->id]) }}"
              >
                Edit
              </a>

              <form
                method="POST"
                action="{{ route('admin.products.destroy', ['id' => $p->id]) }}"
                style="display:inline-block"
                onsubmit="return confirm('Delete product?')"
              >
                @csrf
                <button class="btn btn-sm btn-danger">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted">
              No products found
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center">
    {{ $products->appends(request()->query())->links() }}
  </div>

</div>

</body>
</html>
