<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Bootstrap CSS -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset('assets/css/tiny-slider.css') }}" rel="stylesheet">
			<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
			<title>tendakian — Cart</title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
			<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="tendakian navigation bar">

			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">tendakian<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsTendakian" aria-controls="navbarsTendakian" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsTendakian">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item ">
							<a class="nav-link" href="{{ url('/') }}">Home</a>
						</li>
						<li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
						<li><a class="nav-link" href="{{ url('/about') }}">About us</a></li>
						<li><a class="nav-link" href="{{ url('/services') }}">Services</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
<li><a class="nav-link" href="{{ route('profile') }}"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
						<li><a class="nav-link" href="{{ url('/cart') }}"><img src="{{ asset('assets/images/cart.svg') }}"></a></li>
					</ul>
				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->

			@if(session('success'))
				<div class="container page-alert mt-3">
					<div class="alert alert-success">{{ session('success') }}</div>
				</div>
			@endif
			@if(session('error'))
				<div class="container page-alert mt-3">
					<div class="alert alert-danger">{{ session('error') }}</div>
				</div>
			@endif

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Cart</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section before-footer-section">
            <div class="container">
              <div class="row mb-5">
                <form class="col-md-12" method="post">
                  <div class="site-blocks-table">
										<table class="table">
											<thead>
												<tr>
													<th class="product-thumbnail">Image</th>
													<th class="product-name text-start">Product</th>
													<th class="product-price text-right">Price</th>
													<th class="product-quantity text-center">Quantity</th>
													<th class="product-total text-right">Total</th>
													<th class="product-remove text-center">Remove</th>
												</tr>
											</thead>
											<tbody>
												@php
													$subtotal = 0;
												@endphp

												@if(empty($cart) || count($cart) === 0)
													<tr>
														<td colspan="6" class="text-center">Keranjang kosong.</td>
													</tr>
												@else
													@foreach($cart as $item)
															@php
															$lineTotal = $item['qty'] * $item['price'];
															$subtotal += $lineTotal;
															
															// Tentukan gambar berdasarkan nama produk dengan URL yang beragam dan spesifik
															$img = 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=240&h=160&fit=crop&auto=format'; // default tent
															
															// Tenda & Shelter
															if (stripos($item['name'], 'tenda') !== false || stripos($item['name'], 'tent') !== false) {
																$img = 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=240&h=160&fit=crop&auto=format'; // tent
															} elseif (stripos($item['name'], 'tarp') !== false) {
																$img = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=240&h=160&fit=crop&auto=format'; // tarp/shelter
															} elseif (stripos($item['name'], 'hammock') !== false) {
																$img = 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=240&h=160&fit=crop&auto=format'; // hammock
																
															// Tas & Carrier
															} elseif (stripos($item['name'], 'carrier') !== false) {
																$img = 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=240&h=160&fit=crop&auto=format'; // large backpack
															} elseif (stripos($item['name'], 'backpack') !== false) {
																$img = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=240&h=160&fit=crop&auto=format'; // hiking backpack
															} elseif (stripos($item['name'], 'daypack') !== false) {
																$img = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=240&h=160&fit=crop&auto=format'; // daypack
																
															// Kompor & Alat Masak
															} elseif (stripos($item['name'], 'kompor') !== false || stripos($item['name'], 'stove') !== false) {
																$img = 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=240&h=160&fit=crop&auto=format'; // camping stove
															} elseif (stripos($item['name'], 'cookset') !== false || stripos($item['name'], 'mess kit') !== false) {
																$img = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=240&h=160&fit=crop&auto=format'; // cookset
																
															// Sleeping System
															} elseif (stripos($item['name'], 'sleeping bag') !== false) {
																$img = 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=240&h=160&fit=crop&auto=format'; // sleeping bag
															} elseif (stripos($item['name'], 'matras') !== false || stripos($item['name'], 'sleeping pad') !== false) {
																$img = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=240&h=160&fit=crop&auto=format'; // sleeping pad
																
															// Sepatu & Footwear
															} elseif (stripos($item['name'], 'sepatu') !== false || stripos($item['name'], 'boots') !== false) {
																$img = 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=240&h=160&fit=crop&auto=format'; // hiking boots
																
															// Lighting
															} elseif (stripos($item['name'], 'headlamp') !== false) {
																$img = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=240&h=160&fit=crop&auto=format'; // headlamp
															} elseif (stripos($item['name'], 'lantern') !== false) {
																$img = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=240&h=160&fit=crop&auto=format'; // camping lantern
															} elseif (stripos($item['name'], 'flashlight') !== false) {
																$img = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=240&h=160&fit=crop&auto=format'; // flashlight
																
															// Pakaian & Clothing
															} elseif (stripos($item['name'], 'jaket') !== false) {
																$img = 'https://images.unsplash.com/photo-1551524164-6cf2ac531fb4?w=240&h=160&fit=crop&auto=format'; // outdoor jacket
															} elseif (stripos($item['name'], 'poncho') !== false) {
																$img = 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=240&h=160&fit=crop&auto=format'; // rain gear
																
															// Navigation & Tools
															} elseif (stripos($item['name'], 'kompas') !== false) {
																$img = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=240&h=160&fit=crop&auto=format'; // compass
															} elseif (stripos($item['name'], 'gps') !== false) {
																$img = 'https://images.unsplash.com/photo-1622260614153-03223fb72052?w=240&h=160&fit=crop&auto=format'; // gps device
															} elseif (stripos($item['name'], 'multi-tool') !== false) {
																$img = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=240&h=160&fit=crop&auto=format'; // multi-tool
															} elseif (stripos($item['name'], 'parang') !== false) {
																$img = 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=240&h=160&fit=crop&auto=format'; // survival knife
																
															// Water & Hydration
															} elseif (stripos($item['name'], 'water filter') !== false || stripos($item['name'], 'hydration') !== false) {
																$img = 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=240&h=160&fit=crop&auto=format'; // water gear
																
															// Safety & Emergency
															} elseif (stripos($item['name'], 'first aid') !== false) {
																$img = 'https://images.unsplash.com/photo-1551524164-6cf2ac531fb4?w=240&h=160&fit=crop&auto=format'; // first aid
															} elseif (stripos($item['name'], 'whistle') !== false) {
																$img = 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=240&h=160&fit=crop&auto=format'; // emergency whistle
															} elseif (stripos($item['name'], 'paracord') !== false || stripos($item['name'], 'rope') !== false) {
																$img = 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=240&h=160&fit=crop&auto=format'; // rope/paracord
															}
															
															// If the id is numeric and a Product exists, prefer its image
															if (is_numeric($item['id'])) {
																$p = \App\Models\Product::find($item['id']);
																if ($p && !empty($p->image) && \Illuminate\Support\Facades\Storage::disk('public')->exists($p->image)) {
																	$img = asset('storage/'.$p->image);
																}
															}
														@endphp
														<tr data-item-id="{{ $item['id'] }}">
															<td class="product-thumbnail">
																<img src="{{ $img }}" alt="{{ $item['name'] }}" class="img-fluid">
															</td>
															<td class="product-name text-start">
																<h2 class="h5 text-black">{{ $item['name'] }}</h2>
															</td>
<td class="product-price text-right">
    Rp {{ number_format($item['price'], 0, ',', '.') }}/hari
</td>
															<td class="product-quantity text-center">
																<form action="{{ route('cart.update') }}" method="POST" class="d-inline-block qty-form">
																	@csrf
																	<input type="hidden" name="id" value="{{ $item['id'] }}">
																	<input type="number" name="qty" class="form-control text-center quantity-amount" value="{{ $item['qty'] }}" min="0" data-item-id="{{ $item['id'] }}">
																</form>
															</td>
<td class="product-total text-right">
    Rp <span class="line-total" data-item-id="{{ $item['id'] }}">
        {{ number_format($lineTotal, 0, ',', '.') }}
    </span>
</td>
															<td class="product-remove text-center">
																<form action="{{ route('cart.remove') }}" method="POST">
																	@csrf
																	<input type="hidden" name="id" value="{{ $item['id'] }}">
																	<button type="submit" class="btn btn-black btn-sm">Remove</button>
																</form>
															</td>
														</tr>
													@endforeach
												@endif
											</tbody>
                    </table>
                  </div>
                </form>
              </div>
        
              <div class="row">
                <div class="col-md-6">
									<!-- Continue shopping and coupon inputs removed per request -->
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-black">Subtotal</span>
                        </div>
												<div class="col-md-6 text-right">
<strong class="text-black">
    Rp <span id="cart-subtotal">
        {{ number_format($subtotal ?? 0, 0, ',', '.') }}
    </span>
</strong>
												</div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
												<div class="col-md-6 text-right">
<strong class="text-black">
    Rp <span id="cart-total">
        {{ number_format($subtotal ?? 0, 0, ',', '.') }}
    </span>
</strong>
												</div>
                      </div>
        
											<div class="row">
												<div class="col-md-12">
													<a href="{{ url('/checkout') }}" class="btn btn-black btn-lg py-3 btn-block">Proceed To Checkout</a>
												</div>
											</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		

		<!-- Start Footer Section -->
<footer class="footer-section">
	<div class="container relative">

		<!-- Decorative Outdoor Image (Unsplash) -->
		<div class="sofa-img">
			<img 
				src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=900&h=600&fit=crop"
				alt="Outdoor Adventure"
				class="img-fluid"
				loading="lazy"
			>
		</div>

		<!-- Newsletter -->
		<div class="row">
			<div class="col-lg-8">
				<div class="subscription-form">
					<h3 class="d-flex align-items-center">
						<span class="me-2">
							<img src="{{ asset('assets/images/envelope-outline.svg') }}" alt="Newsletter" class="img-fluid">
						</span>
						<span>Dapatkan Tips & Promo Outdoor</span>
					</h3>

					<form action="#" class="row g-3">
						<div class="col-auto">
							<input type="text" class="form-control" placeholder="Nama lengkap">
						</div>
						<div class="col-auto">
							<input type="email" class="form-control" placeholder="Email aktif">
						</div>
						<div class="col-auto">
							<button class="btn btn-primary">
								<span class="fa fa-paper-plane"></span>
							</button>
						</div>
					</form>

				</div>
			</div>
		</div>

		<!-- Footer Content -->
		<div class="row g-5 mb-5">
			<!-- Brand -->
			<div class="col-lg-4">
				<div class="mb-4 footer-logo-wrap">
					<a href="/" class="footer-logo">tendakian<span>.</span></a>
				</div>

				<p class="mb-4">
					Tendakian adalah platform penyewaan alat outdoor terpercaya untuk pendakian,
					camping, dan petualangan alam. Praktis, aman, dan siap menemani perjalananmu.
				</p>

				<ul class="list-unstyled custom-social">
					<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
					<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
					<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
					<li><a href="#"><span class="fa fa-brands fa-whatsapp"></span></a></li>
				</ul>
			</div>

			<!-- Links -->
			<div class="col-lg-8">
				<div class="row links-wrap">

					<div class="col-6 col-sm-6 col-md-3">
						<ul class="list-unstyled">
							<li><a href="#">Tentang Kami</a></li>
							<li><a href="#">Cara Sewa</a></li>
							<li><a href="#">Artikel Outdoor</a></li>
							<li><a href="#">Kontak</a></li>
						</ul>
					</div>

					<div class="col-6 col-sm-6 col-md-3">
						<ul class="list-unstyled">
							<li><a href="#">Bantuan</a></li>
							<li><a href="#">Syarat & Ketentuan</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</div>

					<div class="col-6 col-sm-6 col-md-3">
						<ul class="list-unstyled">
							<li><a href="#">Tenda</a></li>
							<li><a href="#">Carrier</a></li>
							<li><a href="#">Sleeping Bag</a></li>
							<li><a href="#">Kompor & Alat Masak</a></li>
						</ul>
					</div>

					<div class="col-6 col-sm-6 col-md-3">
						<ul class="list-unstyled">
							<li><a href="#">Paket Pendakian</a></li>
							<li><a href="#">Paket Camping</a></li>
							<li><a href="#">Perlengkapan Safety</a></li>
						</ul>
					</div>

				</div>
			</div>
		</div>

		<!-- Copyright -->
		<div class="border-top copyright">
			<div class="row pt-4">
				<div class="col-lg-6">
					<p class="mb-2 text-center text-lg-start">
						&copy; <script>document.write(new Date().getFullYear());</script> Tendakian.
						All Rights Reserved.
					</p>
				</div>

				<div class="col-lg-6 text-center text-lg-end">
					<ul class="list-unstyled d-inline-flex ms-auto">
						<li class="me-4"><a href="#">Syarat & Ketentuan</a></li>
						<li><a href="#">Kebijakan Privasi</a></li>
					</ul>
				</div>

			</div>
		</div>

	</div>
</footer>
		<!-- End Footer Section -->	


		<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
		<script src="{{ asset('assets/js/custom.js') }}"></script>

		<script>
		// Auto-update cart quantities via AJAX (fetch)
		(function(){
			const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			const qtyInputs = document.querySelectorAll('.quantity-amount');
			let timeout = null;
			function postUpdate(id, qty){
				fetch('{{ route('cart.update') }}', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': csrf,
						'X-Requested-With': 'XMLHttpRequest'
					},
					body: JSON.stringify({ id: id, qty: parseInt(qty, 10) })
				})
				.then(r => r.json())
				.then(data => {
					if(!data || !data.success){ return; }
					if(data.removed){
						// remove row
						const row = document.querySelector(`tr[data-item-id="${data.id}"]`);
						if(row) row.remove();
					}
					if(data.lineTotal !== undefined){
						const el = document.querySelector(`.line-total[data-item-id="${data.id}"]`);
						if(el) el.textContent = Number(data.lineTotal).toFixed(2);
					}
					if(data.subtotal !== undefined){
						const sub = document.getElementById('cart-subtotal');
						const tot = document.getElementById('cart-total');
						if(sub) sub.textContent = Number(data.subtotal).toFixed(2);
						if(tot) tot.textContent = Number(data.subtotal).toFixed(2);
					}
				})
				.catch(err => { console.error('Cart update failed', err); });
			}

			qtyInputs.forEach(input => {
				input.addEventListener('input', (e)=>{
					const id = e.target.dataset.itemId;
					const val = e.target.value;
					// debounce to avoid many requests
					clearTimeout(timeout);
					timeout = setTimeout(()=>{
						postUpdate(id, val);
					}, 400);
				});
			});
		})();
		</script>
	</body>

</html>
