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
		<link href="{{ asset('assets/css/tiny-slider.css') }}" rel="stylesheet">
			<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
			<title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">Furni<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item ">
							<a class="nav-link" href="{{ url('/') }}">Home</a>
						</li>
						<li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
						<li><a class="nav-link" href="{{ url('/about') }}">About us</a></li>
						<li><a class="nav-link" href="{{ url('/services') }}">Services</a></li>
						<li><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
						<li><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						<li><a class="nav-link" href="#"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
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
													// Map product ids to images; add entries as needed
													$productImages = [
														'nordic-chair-1' => 'assets/images/product-1.png',
														'nordic-chair-2' => 'assets/images/product-1.png',
														'nordic-chair-3' => 'assets/images/product-3.png',
														'nordic-chair-4' => 'assets/images/product-1.png',
														'nordic-chair-5' => 'assets/images/product-3.png',
														'nordic-chair-6' => 'assets/images/product-1.png',
														'kruzo-aero-1'   => 'assets/images/product-2.png',
														'kruzo-aero-2'   => 'assets/images/product-2.png',
														'kruzo-aero-3'   => 'assets/images/product-2.png',
														'ergonomic-chair-1' => 'assets/images/product-3.png',
														'ergonomic-chair-2' => 'assets/images/product-3.png',
														'ergonomic-chair-3' => 'assets/images/product-3.png',
													];
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
															$img = isset($productImages[$item['id']]) ? $productImages[$item['id']] : 'assets/images/product-1.png';
														@endphp
														<tr data-item-id="{{ $item['id'] }}">
															<td class="product-thumbnail">
																<img src="{{ asset($img) }}" alt="{{ $item['name'] }}" class="img-fluid">
															</td>
															<td class="product-name text-start">
																<h2 class="h5 text-black">{{ $item['name'] }}</h2>
															</td>
															<td class="product-price text-right">${{ number_format($item['price'], 2) }}</td>
															<td class="product-quantity text-center">
																<form action="{{ route('cart.update') }}" method="POST" class="d-inline-block qty-form">
																	@csrf
																	<input type="hidden" name="id" value="{{ $item['id'] }}">
																	<input type="number" name="qty" class="form-control text-center quantity-amount" value="{{ $item['qty'] }}" min="0" data-item-id="{{ $item['id'] }}">
																</form>
															</td>
															<td class="product-total text-right">$<span class="line-total" data-item-id="{{ $item['id'] }}">{{ number_format($lineTotal, 2) }}</span></td>
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
													<strong class="text-black">$<span id="cart-subtotal">{{ number_format($subtotal ?? 0, 2) }}</span></strong>
												</div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
												<div class="col-md-6 text-right">
													<strong class="text-black">$<span id="cart-total">{{ number_format($subtotal ?? 0, 2) }}</span></strong>
												</div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.html'">Proceed To Checkout</button>
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

				<div class="sofa-img">
					<img src="{{ asset('assets/images/sofa.png') }}" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="{{ asset('assets/images/envelope-outline.svg') }}" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
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

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
						<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">About us</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#">Blog</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Nordic Chair</a></li>
									<li><a href="#">Kruzo Aero</a></li>
									<li><a href="#">Ergonomic Chair</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="{{ asset('https://untree.co') }}">Untree.co</a> Distributed By <a hreff="{{ asset('https://themewagon.com') }}">ThemeWagon</a>  <!-- License information: https://untree.co/license/ -->
            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
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
