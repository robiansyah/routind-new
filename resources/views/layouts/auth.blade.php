
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<title>@yield('title') - routind</title>
		<meta charset="utf-8" />
		<meta name="description" content="Learning and Bussiness Simulator. Dapatkan pengalaman menyenangkan dan aplikatif tentang pembelajaran bisnis yang berbasis pada platform digital routind." />
		<meta name="keywords" content="learning, bussiness, simulator, tax, tax learning, learning and bussiness simulator, bisnis, aplikatif, digital, virtual, realistis" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="id_ID" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="@yield('title') - routind" />
		<meta property="og:url" content="https://routind.com" />
		<meta property="og:site_name" content="@yield('title') | routind" />
		<link rel="canonical" href="https://routind.com" />
		<link rel="shortcut icon" href="{{ url('disc/assets/media/logos/favicon.ico') }}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ url('disc/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('disc/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
        @yield('css')
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-FD3VBNPKCW"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-FD3VBNPKCW');
		</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
		<!--begin::Theme mode setup on page load-->
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('/disc/assets/media/auth/bg6.jpg'); } [data-bs-theme="dark"] body { background-image: url('/disc/assets/media/auth/bg6-dark.jpg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
						<!--begin::Image-->
						<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-5 mb-lg-20" src="{{ url('disc/assets/media/logos/Logo Routind warna.png') }}" alt="logo routind" />
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="d-none d-lg-block text-gray-800 fs-2qx fw-bold text-center mb-7">Learning and Bussiness Simulator</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="d-none d-lg-block text-gray-800 fs-base text-center fw-semibold">
							Dapatkan pengalaman menyenangkan dan aplikatif tentang pembelajaran bisnis yang berbasis pada platform digital <b>routind</b>.
							Kami memberikan pengalaman realistis secara virtual dalam pembelajaran kepada pelajar dan profesional untuk menguasai metode penyelesaian kasus bisnis dengan berbagai macam solusi.
							<b>routind</b> dapat diakses lebih dari 1000 user dalam satu waktu untuk menciptakan pengalaman simulasi bisnis yang lebih realistis.
						</div>
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<!--begin::Wrapper-->
					<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-550px p-10">
						<!--begin::Content-->
						@yield('content')
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "disc/assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ url('disc/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ url('disc/assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		@yield('js')
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>