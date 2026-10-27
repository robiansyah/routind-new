
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <title>@yield('title') - Digi Partner</title>
    <meta charset="utf-8" />
    <meta name="description" content="Learning and Bussiness Simulator. Dapatkan pengalaman menyenangkan dan aplikatif tentang pembelajaran bisnis yang berbasis pada platform digital routind." />
    <meta name="keywords" content="learning, bussiness, simulator, tax, tax learning, learning and bussiness simulator, bisnis, aplikatif, digital, virtual, realistis" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title') - routind" />
    <meta property="og:url" content="https://routind.com" />
    <meta property="og:site_name" content="@yield('title') | Digi Partner" />
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
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
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
                <img class="theme-light-show mx-auto mw-100 w-200px w-lg-350px mb-5 mb-lg-20" src="https://digipartner.co.id/wp-content/uploads/2024/05/Logo-Digi-Partner-Baru-1536x644.png" alt="logo routind" />
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-gray-800 fs-2qx fw-bold text-center mb-7">PT Digi Partner Studio</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="d-none d-lg-block text-gray-800 fs-base text-center fw-semibold">
                    Vila Bukit Tidar Blok A1-128, Kota Malang,<br>
                    JawaTimur, Kode Pos: 65144<br>
                    NPWP: 39.011.491.6-652.000
                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
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