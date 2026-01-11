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
        @php
          // Tentukan gambar berdasarkan nama produk dengan URL yang beragam dan spesifik
          $imageUrl = 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=900&h=600&fit=crop&auto=format'; // default tent
          
          // Tenda & Shelter
          if (stripos($product->name, 'tenda') !== false || stripos($product->name, 'tent') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=900&h=600&fit=crop&auto=format'; // tent
          } elseif (stripos($product->name, 'tarp') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=900&h=600&fit=crop&auto=format'; // tarp/shelter
          } elseif (stripos($product->name, 'hammock') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=900&h=600&fit=crop&auto=format'; // hammock
            
          // Tas & Carrier
          } elseif (stripos($product->name, 'carrier') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=900&h=600&fit=crop&auto=format'; // large backpack
          } elseif (stripos($product->name, 'backpack') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=900&h=600&fit=crop&auto=format'; // hiking backpack
          } elseif (stripos($product->name, 'daypack') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=900&h=600&fit=crop&auto=format'; // daypack
            
          // Kompor & Alat Masak
          } elseif (stripos($product->name, 'kompor') !== false || stripos($product->name, 'stove') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=900&h=600&fit=crop&auto=format'; // camping stove
          } elseif (stripos($product->name, 'cookset') !== false || stripos($product->name, 'mess kit') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=900&h=600&fit=crop&auto=format'; // cookset
            
          // Sleeping System
          } elseif (stripos($product->name, 'sleeping bag') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=900&h=600&fit=crop&auto=format'; // sleeping bag
          } elseif (stripos($product->name, 'matras') !== false || stripos($product->name, 'sleeping pad') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=900&h=600&fit=crop&auto=format'; // sleeping pad
            
          // Sepatu & Footwear
          } elseif (stripos($product->name, 'sepatu') !== false || stripos($product->name, 'boots') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=900&h=600&fit=crop&auto=format'; // hiking boots
            
          // Lighting
          } elseif (stripos($product->name, 'headlamp') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=900&h=600&fit=crop&auto=format'; // headlamp
          } elseif (stripos($product->name, 'lantern') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=900&h=600&fit=crop&auto=format'; // camping lantern
          } elseif (stripos($product->name, 'flashlight') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=900&h=600&fit=crop&auto=format'; // flashlight
            
          // Pakaian & Clothing
          } elseif (stripos($product->name, 'jaket') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1551524164-6cf2ac531fb4?w=900&h=600&fit=crop&auto=format'; // outdoor jacket
          } elseif (stripos($product->name, 'poncho') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=900&h=600&fit=crop&auto=format'; // rain gear
            
          // Navigation & Tools
          } elseif (stripos($product->name, 'kompas') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=900&h=600&fit=crop&auto=format'; // compass
          } elseif (stripos($product->name, 'gps') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=900&h=600&fit=crop&auto=format'; // gps device
          } elseif (stripos($product->name, 'multi-tool') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=900&h=600&fit=crop&auto=format'; // multi-tool
          } elseif (stripos($product->name, 'parang') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=900&h=600&fit=crop&auto=format'; // survival knife
            
          // Water & Hydration
          } elseif (stripos($product->name, 'water filter') !== false || stripos($product->name, 'hydration') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=900&h=600&fit=crop&auto=format'; // water gear
            
          // Safety & Emergency
          } elseif (stripos($product->name, 'first aid') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1551524164-6cf2ac531fb4?w=900&h=600&fit=crop&auto=format'; // first aid
          } elseif (stripos($product->name, 'whistle') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=900&h=600&fit=crop&auto=format'; // emergency whistle
          } elseif (stripos($product->name, 'paracord') !== false || stripos($product->name, 'rope') !== false) {
            $imageUrl = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=900&h=600&fit=crop&auto=format'; // rope/paracord
          }
        @endphp
        
        @if(!empty($product->image) && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
          <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid">
        @else
          <img src="{{ $imageUrl }}" class="img-fluid" alt="{{ $product->name }}">
        @endif
      </div>
      <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <p><strong>Price per rental:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}/hari</p>
        <p><strong>Available:</strong> {{ $product->stock }}</p>
        <a class="btn btn-primary" href="{{ url('/cart/add') }}?id={{ $product->id }}&name={{ urlencode($product->name) }}&price={{ number_format($product->price,2,'.','') }}">Add to cart</a>
        <a class="btn btn-outline-secondary" href="{{ url('/shop') }}">Back to shop</a>
      </div>
    </div>
  </div>
</body>
</html>
