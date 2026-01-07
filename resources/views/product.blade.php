@extends('')
<!doctype html>
<html>
<head>
  <title>{{ $product->name }} — tendakian</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
 </head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        @if(!empty($product->image) && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
          <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid">
        @else
          <img src="https://source.unsplash.com/900x600/?camping,tent,backpack,gear" class="img-fluid" alt="{{ $product->name }}">
        @endif
      </div>
      <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <p><strong>Price per rental:</strong> ${{ number_format($product->price,2) }}</p>
        <p><strong>Available:</strong> {{ $product->stock }}</p>
        <a class="btn btn-primary" href="{{ url('/cart/add') }}?id={{ $product->id }}&name={{ urlencode($product->name) }}&price={{ number_format($product->price,2,'.','') }}">Add to cart</a>
        <a class="btn btn-outline-secondary" href="{{ url('/shop') }}">Back to shop</a>
      </div>
    </div>
  </div>
</body>
</html>
