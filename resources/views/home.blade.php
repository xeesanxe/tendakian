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
			<title>tendakian — Home</title>
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
						<li class="nav-item active">
							<a class="nav-link" href="{{ url('/') }}">Home</a>
						</li>
						<li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
						<li><a class="nav-link" href="{{ url('/about') }}">About us</a></li>
						<li><a class="nav-link" href="{{ url('/services') }}">Services</a></li>
						<li><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
						<li><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
<li><a class="nav-link" href="{{ route('profile') }}"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
						<li><a class="nav-link" href="{{ url('/cart') }}"><img src="{{ asset('assets/images/cart.svg') }}" ></a></li>
					</ul>
				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Tendakian — Outdoor Gear Rental</h1>
								<p class="mb-4">Sewa perlengkapan outdoor: tenda, ransel, kompor, sleeping bag, dan lainnya. Praktis untuk petualangan Anda.</p>
								<p><a href="{{ url('/shop') }}" class="btn btn-secondary me-2">Shop Now</a><a href="{{ url('/services') }}" class="btn btn-white-outline">Explore</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
<img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=1200&h=700&fit=crop" class="img-fluid" alt="Camping Tent Outdoor">							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<!-- Start Product Section -->
		<div class="product-section">
			<div class="container">
				<div class="row">

					<!-- Start Column 1 -->
					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">Go outside and explore.</h2>
						<p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
						<p><a href="{{ asset('shop') }}" class="btn">Explore</a></p>
					</div> 
					<!-- End Column 1 -->

					<!-- Start Column 2 -->
<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
    <a class="product-item" href="{{ asset('cart') }}">
        <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=600&h=400&fit=crop" class="img-fluid product-thumbnail" alt="Camp Tent">
        <h3 class="product-title">Nordic Chair</h3>
        <strong class="product-price">Rp 50.000</strong>
        <span class="icon-cross">
            <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid">
        </span>
    </a>
</div> 
<!-- End Column 2 -->

<!-- Start Column 3 -->
<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
    <a class="product-item" href="{{ asset('cart') }}">
        <img src="https://images.unsplash.com/photo-1622260614153-03223fb72052?w=600&h=400&fit=crop" class="img-fluid product-thumbnail" alt="Backpack">
        <h3 class="product-title">Kruzo Aero Chair</h3>
        <strong class="product-price">Rp 78.000</strong>
        <span class="icon-cross">
            <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid">
        </span>
    </a>
</div>
<!-- End Column 3 -->

<!-- Start Column 4 -->
<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
    <a class="product-item" href="{{ asset('cart') }}">
        <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=600&h=400&fit=crop" class="img-fluid product-thumbnail" alt="Camping Gear">
        <h3 class="product-title">Ergonomic Chair</h3>
        <strong class="product-price">Rp 43.000</strong>
        <span class="icon-cross">
            <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid">
        </span>
    </a>
</div>
<!-- End Column 4 -->

				</div>
			</div>
		</div>
		<!-- End Product Section -->

		<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h2 class="section-title">Why Choose Tendakian</h2>
                <p>Kami menyediakan perlengkapan outdoor berkualitas tinggi untuk petualangan Anda. Percayakan kebutuhan camping dan hiking Anda kepada kami.</p>

                <div class="row my-5">
                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('assets/images/truck.svg') }}" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Pengiriman Cepat</h3>
                            <p>Layanan antar-jemput perlengkapan outdoor langsung ke lokasi Anda. Praktis dan hemat waktu untuk persiapan petualangan.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('assets/images/bag.svg') }}" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Perlengkapan Lengkap</h3>
                            <p>Tersedia berbagai gear outdoor: tenda, sleeping bag, carrier, kompor, dan perlengkapan camping lainnya dalam kondisi prima.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('assets/images/support.svg') }}" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Konsultasi Gratis</h3>
                            <p>Tim kami siap membantu memilih gear yang sesuai dengan kebutuhan petualangan Anda, baik untuk pemula maupun profesional.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('assets/images/return.svg') }}" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Harga Terjangkau</h3>
                            <p>Sistem sewa yang fleksibel dengan harga kompetitif. Nikmati petualangan outdoor tanpa harus membeli peralatan mahal.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?w=800&h=1000&fit=crop" alt="Outdoor Camping" class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Why Choose Us Section -->

		<!-- Start We Help Section -->
<div class="we-help-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="imgs-grid">
                    <div class="grid grid-1"><img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=600&h=500&fit=crop" alt="Camping Tent"></div>
                    <div class="grid grid-2"><img src="https://images.unsplash.com/photo-1551632811-561732d1e306?w=600&h=600&fit=crop" alt="Hiking Backpack"></div>
                    <div class="grid grid-3"><img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?w=600&h=400&fit=crop" alt="Mountain Camping"></div>
                </div>
            </div>
            <div class="col-lg-5 ps-lg-5">
                <h2 class="section-title mb-4">Kami Membantu Petualangan Outdoor Anda</h2>
                <p>Tendakian menyediakan solusi lengkap untuk kebutuhan camping, hiking, dan petualangan outdoor Anda. Dengan perlengkapan berkualitas dan layanan terpercaya, kami siap mendukung setiap momen berharga di alam terbuka.</p>

                <ul class="list-unstyled custom-list my-4">
                    <li>Perlengkapan outdoor berkualitas tinggi dan terawat</li>
                    <li>Proses sewa mudah dan cepat, cocok untuk pemula hingga profesional</li>
                    <li>Harga sewa terjangkau dengan paket fleksibel</li>
                    <li>Layanan konsultasi gratis untuk memilih gear yang tepat</li>
                </ul>
                <p><a href="{{ url('/shop') }}" class="btn">Explore</a></p>
            </div>
        </div>
    </div>
</div>
<!-- End We Help Section -->

		<!-- Start Popular Product -->
<div class="popular-product">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="product-item-sm d-flex">
                    <div class="thumbnail">
                        <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=300&h=300&fit=crop" alt="Camping Tent" class="img-fluid">
                    </div>
                    <div class="pt-3">
                        <h3>Tenda Camping</h3>
                        <p>Tenda berkualitas untuk 2-4 orang, tahan air dan mudah dipasang. Cocok untuk camping di gunung atau pantai.</p>
                        <p><a href="{{ url('/shop') }}">Lihat Produk</a></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="product-item-sm d-flex">
                    <div class="thumbnail">
                        <img src="https://images.unsplash.com/photo-1622260614153-03223fb72052?w=300&h=300&fit=crop" alt="Carrier Backpack" class="img-fluid">
                    </div>
                    <div class="pt-3">
                        <h3>Carrier & Backpack</h3>
                        <p>Ransel carrier kapasitas besar dengan sistem penopang punggung yang nyaman untuk perjalanan jauh.</p>
                        <p><a href="{{ url('/shop') }}">Lihat Produk</a></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="product-item-sm d-flex">
                    <div class="thumbnail">
                        <img src="https://images.unsplash.com/photo-1537225228614-56cc3556d7ed?w=300&h=300&fit=crop" alt="Sleeping Bag" class="img-fluid">
                    </div>
                    <div class="pt-3">
                        <h3>Sleeping Bag</h3>
                        <p>Sleeping bag hangat dan nyaman untuk suhu dingin. Material berkualitas tinggi dan mudah dibawa.</p>
                        <p><a href="{{ url('/shop') }}">Lihat Produk</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Popular Product -->


	<!-- Start Blog Section -->
<div class="blog-section">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md-6">
				<h2 class="section-title">Artikel Outdoor Terbaru</h2>
			</div>
			<div class="col-md-6 text-start text-md-end">
				<a href="#" class="more">Lihat Semua Artikel</a>
			</div>
		</div>

		<div class="row">

			<!-- Blog 1 -->
			<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
				<div class="post-entry">
					<a href="#" class="post-thumbnail">
						<img 
							src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=600&h=400&fit=crop"
							alt="Tips Memilih Tenda"
							class="img-fluid"
							loading="lazy"
						>
					</a>
					<div class="post-content-entry">
						<h3><a href="#">Tips Memilih Tenda untuk Pendakian</a></h3>
						<div class="meta">
							<span>oleh <a href="#">Admin Tendakian</a></span>
							<span>pada <a href="#">Jan 5, 2026</a></span>
						</div>
					</div>
				</div>
			</div>

			<!-- Blog 2 -->
			<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
				<div class="post-entry">
					<a href="#" class="post-thumbnail">
						<img 
							src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=600&h=400&fit=crop"
							alt="Cara Memilih Carrier"
							class="img-fluid"
							loading="lazy"
						>
					</a>
					<div class="post-content-entry">
						<h3><a href="#">Cara Memilih Carrier yang Nyaman</a></h3>
						<div class="meta">
							<span>oleh <a href="#">Tim Outdoor</a></span>
							<span>pada <a href="#">Jan 2, 2026</a></span>
						</div>
					</div>
				</div>
			</div>

			<!-- Blog 3 -->
			<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
				<div class="post-entry">
					<a href="#" class="post-thumbnail">
						<img 
							src="https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=600&h=400&fit=crop"
							alt="Perawatan Sleeping Bag"
							class="img-fluid"
							loading="lazy"
						>
					</a>
					<div class="post-content-entry">
						<h3><a href="#">Cara Merawat Sleeping Bag Agar Awet</a></h3>
						<div class="meta">
							<span>oleh <a href="#">Admin Tendakian</a></span>
							<span>pada <a href="#">Dec 28, 2025</a></span>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- End Blog Section -->

	

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



		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('js/tiny-slider.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
	</body>

</html>
