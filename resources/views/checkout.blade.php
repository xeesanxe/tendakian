<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <title>tendakian — Checkout</title>
</head>
<body>

  <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">tendakian<span>.</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsTendakian">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsTendakian">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
          <li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
          <li><a class="nav-link" href="{{ url('/about') }}">About us</a></li>
        </ul>
        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
		<li><a class="nav-link" href="{{ route('profile') }}"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
		<li><a class="nav-link" href="{{ url('/cart') }}"><img src="{{ asset('assets/images/cart.svg') }}"></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="intro-excerpt"><h1>Checkout</h1></div>
        </div>
      </div>
    </div>
  </div>

  <div class="untree_co-section">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <div class="border p-3 rounded">Returning customer? <a href="/login">Click here</a> to login</div>
        </div>
      </div>

      <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Billing Details</h2>
            <div class="p-3 p-lg-5 border bg-white">
              <div class="form-group mb-3">
                <label class="text-black">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
              </div>

              <div class="form-group mb-3">
                <label class="text-black">Email Address <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
              </div>

              <div class="form-group mb-3">
                <label class="text-black">Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
              </div>

              <div class="form-group row mb-3">
                <div class="col-md-6">
                  <label class="text-black">Rental Start</label>
                  <input type="date" class="form-control" name="rental_start" value="{{ old('rental_start') }}">
                </div>
                <div class="col-md-6">
                  <label class="text-black">Rental End</label>
                  <input type="date" class="form-control" name="rental_end" value="{{ old('rental_end') }}">
                </div>
              </div>

              <div class="form-group mb-3">
                <label class="text-black">Order Notes</label>
                <textarea name="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <h2 class="h3 mb-3 text-black">Your Order</h2>
            <div class="p-3 p-lg-5 border bg-white">
              @php $cart = session('cart', []); $cartSubtotal = 0; @endphp
              <table class="table site-block-order-table mb-4">
                <thead>
                  <tr><th>Product</th><th class="text-end">Total</th></tr>
                </thead>
                <tbody>
                  @if(empty($cart) || count($cart)===0)
                    <tr><td colspan="2">Keranjang kosong.</td></tr>
                  @else
                    @foreach($cart as $ci)
                      @php $line = ($ci['price'] * $ci['qty']); $cartSubtotal += $line; @endphp
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            @if(!empty($ci['image']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($ci['image']))
                              <img src="{{ asset('storage/'.$ci['image']) }}" style="width:64px;height:48px;object-fit:cover;margin-right:10px;" />
                            @endif
                            <div>
                              <div>{{ $ci['name'] }}</div>
<div class="small">
  Qty: {{ $ci['qty'] }} &middot; Rp {{ number_format($ci['price'], 0, ',', '.') }}
</div>
                            </div>
                          </div>
                        </td>
<td class="text-end">Rp {{ number_format($line, 0, ',', '.') }}</td>
                      </tr>
                    @endforeach
                    <tr>
                      <td class="text-black"><strong>Cart Subtotal</strong></td>
<td class="text-end text-black">
  Rp {{ number_format($cartSubtotal, 0, ',', '.') }}
</td>
                    </tr>
                    <tr>
                      <td class="text-black"><strong>Order Total</strong></td>
<td class="text-end text-black">
  <strong>Rp {{ number_format($cartSubtotal, 0, ',', '.') }}</strong>
</td>
                    </tr>
                  @endif
                </tbody>
              </table>

              <div class="mb-3">
                <label class="d-block mb-2">Payment Method</label>
                <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" value="manual" id="pm_bank" checked><label class="form-check-label" for="pm_bank">Direct Bank Transfer</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" value="mock" id="pm_mock"><label class="form-check-label" for="pm_mock">Pay (mock)</label></div>
              </div>

              <div class="form-group"><button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Place Order</button></div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer (simple include of existing footer markup) -->
  <footer class="footer-section">
    <div class="container relative">
      <div class="sofa-img"><img src="{{ asset('assets/images/sofa.png') }}" alt="Image" class="img-fluid"></div>
      <div class="row g-5 mb-5">
        <div class="col-lg-4">
          <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">tendakian<span>.</span></a></div>
          <p class="mb-4">Donec facilisis quam ut purus rutrum lobortis.</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
