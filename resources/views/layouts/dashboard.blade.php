
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
    @yield('css')

    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-sidebar-stacked="true" data-kt-app-sidebar-secondary-enabled="true" data-kt-app-toolbar-enabled="true" class="app-default" data-kt-app-sidebar-secondary-collapse="{!! (Request::segment(1) == 'ruang' && Request::segment(2) == 'kelas') ? 'on' : 'off' !!}">
<!--begin::Theme mode setup on page load-->
{{-- <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script> --}}
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        <div id="kt_app_header" class="app-header d-flex d-lg-none" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
            <!--begin::Header container-->
            <div class="app-container container-xxl d-flex align-items-center justify-content-between" id="kt_app_header_container">
                <!--begin::Logo-->
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
                    <a href="{{ route('pelajar.index') }}">
                        <img alt="Logo" src="{{ url('disc/assets/media/logos/Routind with name.png') }}" class="h-30px" />
                    </a>
                </div>
                <!--end::Logo-->
                <!--begin::Header mobile toggle-->
                <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show sidebar menu">
                    <div class="btn btn-icon btn-color-white bg-white bg-opacity-0 bg-hover-opacity-10 w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                        <i class="ki-outline ki-abstract-14 fs-1"></i>
                    </div>
                </div>
                <!--end::Header mobile toggle-->
            </div>
            <!--end::Header container-->
        </div>
        <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="" id="kt_app_wrapper">
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <!--begin::Toolbar-->
                    <div id="kt_app_toolbar" class="app-toolbar py-4 py-lg-6 mb-8 mb-lg-10" data-kt-sticky="true" data-kt-sticky-name="app-toolbar-sticky" data-kt-sticky-offset="{default: 'false', lg: '300px'}">
                        <!--begin::Toolbar container-->
                        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack flex-wrap flex-lg-nowrap gap-4">
                            <!--begin::Toolbar wrapper-->
                            <div class="d-flex align-items-center">
                                <!--begin::Logo-->
                                <img src="{{ url('disc/assets/media/svg/brand-logos/layer.svg') }}" class="w-40px me-5" alt="" />
                                <!--end::Logo-->
                                <!--begin::Page title-->
                                <div class="page-title py-2 py-sm-0 d-flex flex-column justify-content-center me-3">
                                    <!--begin::Title-->
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">@yield('title')</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Page title-->
                            </div>
                            <!--end::Toolbar wrapper=-->
                            <!--begin::Toolbar wrapper=-->
                            <div class="d-flex align-items-center flex-wrap flex-lg-nowrap gap-4 gap-lg-10">
                                <!--begin::Actions-->
                                <div class="d-none d-lg-block d-flex align-items-center gap-2 gapl-lg-4">
                                    <a href="{{ route('logout') }}" class="btn btn-flex btn-sm h-40px fw-bold btn-dark"
                                       onclick="event.preventDefault();var check = confirm('Apakah Anda yakin akan keluar?');if(check){document.getElementById('logout-form').submit();}">
                                        <i class="fas fa-sign-out-alt"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <!--end::Primary button-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Toolbar wrapper=-->
                        </div>
                        <!--end::Toolbar container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Content-->
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <!--begin::Content container-->
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            @yield('content')
                        </div>
                        <!--end::Content container-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Content wrapper-->
                <!--begin::Footer-->
                <div id="kt_app_footer" class="app-footer">
                    <!--begin::Footer container-->
                    <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2023 - {{ date('Y') }} &copy;</span>
                            <a href="#" class="text-gray-800 text-hover-primary">routind</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item">
                                <a href="{{ route('academy') }}" target="_blank" class="menu-link px-2">Academy</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('event') }}" target="_blank" class="menu-link px-2">Events</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Footer container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-outline ki-arrow-up"></i>
</div>
<!--end::Scrolltop-->
<!--begin::Modals-->
@yield('modal')

<!--end::Modals-->
<!--begin::Javascript-->
<script>var hostUrl = "disc/assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ url('disc/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ url('disc/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<script src="{{ url('disc/assets/js/custom/confirmation.js?v=2') }}"></script>
@yield('js')

<!--end::Javascript-->
</body>
<!--end::Body-->
</html>