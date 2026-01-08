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

		<!-- Bootstrap CSS -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset('assets/css/tiny-slider.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
			<title>tendakian — Shop</title>
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
						<li class="active"><a class="nav-link" href="{{ asset('shop') }}">Shop</a></li>
						<li><a class="nav-link" href="{{ asset('about') }}">About us</a></li>
						<li><a class="nav-link" href="{{ asset('services') }}">Services</a></li>
						<li><a class="nav-link" href="{{ asset('blog') }}">Blog</a></li>
						<li><a class="nav-link" href="{{ asset('contact') }}">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
<li><a class="nav-link" href="{{ route('profile') }}"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
						<li><a class="nav-link" href="{{ asset('cart') }}"><img src="{{ asset('assets/images/cart.svg') }}"></a></li>
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
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

			<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">
				@foreach($products as $product)
				<div class="col-12 col-md-4 col-lg-3 mb-5">
					<div class="product-item">
						<a href="{{ route('product.show', ['id' => $product->id]) }}">
						@if(!empty($product->image) && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
							<img src="{{ asset('storage/'.$product->image) }}" class="img-fluid product-thumbnail">
						@else
							<img src="https://source.unsplash.com/600x400/?camping,backpack,tent,gear" class="img-fluid product-thumbnail" alt="{{ $product->name }}">
						@endif
						<h3 class="product-title">{{ $product->name }}</h3>
<strong class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</strong>						<div class="mt-3 d-flex justify-content-center">
							<a class="btn btn-sm btn-primary" href="{{ route('cart.add.get', ['id' => $product->id, 'name' => $product->name, 'price' => number_format($product->price,2,'.','')]) }}">Add to cart</a>
						</div>
					</div>
				</div>
				@endforeach

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
	</body>

</html>
