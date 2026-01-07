<!doctype html>
<html>
<head>
  <title>Admin - New Product</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h1>New Product</h1>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Price</label>
        <input name="price" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stock</label>
        <input name="stock" class="form-cont
