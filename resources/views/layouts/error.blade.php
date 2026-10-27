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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ url('disc/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('disc/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
        <!--begin::Theme mode setup on page load-->
        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
        <!--end::Theme mode setup on page load-->
        @yield('content')
        <!--begin::Javascript-->
        <script>var hostUrl = "disc/assets/";</script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ url('disc/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ url('disc/assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>