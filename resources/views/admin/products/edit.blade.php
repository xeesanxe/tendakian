<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">

  <h1>Edit Product</h1>

  <form
    method="POST"
    action="{{ route('admin.products.update', ['id' => $product->id]) }}"
    enctype="multipart/form-data"
  >
    @csrf

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input
        type="text"
        name="name"
        value="{{ $product->name }}"
        class="form-control"
        required
      >
    </div>

    <div class="mb-3">
      <label class="form-label">Price</label>
      <input
        type="number"
        name="price"
        value="{{ $product->price }}"
        class="form-control"
        required
      >
    </div>

    <div class="mb-3">
      <label class="form-label">Stock</label>
      <input
        type="number"
        name="stock"
        value="{{ $product->stock }}"
        class="form-control"
        required
      >
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea
        name="description"
        class="form-control"
      >{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Current Image</label><br>

      @if($product->image)
        <img
          src="{{ asset('storage/'.$product->image) }}"
          style="height:120px;display:block;margin-bottom:8px"
        >
      @else
        <img
          src="https://source.unsplash.com/240x160/?camping,gear"
          style="height:120px;display:block;margin-bottom:8px"
        >
      @endif

      <label class="form-label">Replace Image</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-primary">Save</button>

  </form>

</div>

</body>
</html>
