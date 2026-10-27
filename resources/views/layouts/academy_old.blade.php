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
    <link href="{{ url('demo37/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('demo37/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate-="true" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
            <!--begin::Header container-->
            <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                <!--begin::Header wrapper-->
                <div class="app-header-wrapper d-flex flex-grow-1 align-items-stretch justify-content-between" id="kt_app_header_wrapper">
                    <!--begin::Logo wrapper-->
                    <div class="app-header-logo d-flex flex-shrink-0 align-items-center justify-content-between justify-content-lg-center">
                        <!--begin::Logo wrapper-->
                        <button class="btn btn-icon btn-color-gray-600 btn-active-color-primary ms-n3 me-2 d-flex d-lg-none" id="kt_app_header_menu_toggle">
                            <i class="ki-outline ki-abstract-14 fs-2"></i>
                        </button>

                        <!--end::Logo wrapper-->
                        <!--begin::Logo image-->
                        <a href="{{ route('academy') }}">
                            <img alt="Logo" src="{{ url('disc/assets/media/logos/Routind Colour.png') }}" class="h-30px h-lg-40px theme-light-show" />
                            <img alt="Logo" src="{{ url('disc/assets/media/logos/Routind with name.png') }}" class="h-30px h-lg-40px theme-dark-show" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Logo wrapper-->
                    <!--begin::Menu wrapper-->
                    <div id="kt_app_header_menu_wrapper" class="d-flex align-items-center w-100">
                        <!--begin::Header menu-->
                        <div class="app-header-menu app-header-mobile-drawer align-items-start align-items-lg-center w-100" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}">
                            <!--begin::Menu-->
                            <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-state-primary menu-title-gray-700 menu-arrow-gray-400 menu-bullet-gray-400 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="#kt_header_menu" data-kt-menu="true">
                                <!--begin:Menu item-->
                                <div class="menu-item {!! (Request::segment(1) == 'academy') ? 'here' : '' !!} me-0 me-lg-2">
                                    <!--begin:Menu link-->
                                    <a href="{{ route('academy') }}" class="menu-link">
                                        <span class="menu-title">Home</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->

                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item {!! (Request::segment(1) == 'events') ? 'here' : '' !!} me-0 me-lg-2">
                                    <!--begin:Menu link-->
                                    <a href="{{ route('event') }}" class="menu-link">
                                        <span class="menu-title">Courses</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->

                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item {!! (Request::segment(1) == 'partnership') ? 'here' : '' !!} me-0 me-lg-2">
                                    <!--begin:Menu link-->
                                    <a href="{{ route('partnership') }}" class="menu-link">
                                        <span class="menu-title">Partnership</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->

                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Header menu-->
                    </div>
                    <!--end::Menu wrapper-->
                    <!--begin::Navbar-->
                    <div class="app-navbar flex-shrink-0">
                        <div class="app-navbar-item ms-1 ms-lg-5">
                            <!--begin::Menu- wrapper-->
                            <a href="{{ route('login') }}" class="btn btn-icon btn-custom btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px show menu-dropdown" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
                                Login <i class="ki-outline ki-entrance-left fs-1"></i>
                            </a>
                        </div>
                    </div>
                    <!--end::Navbar-->
                </div>
                <!--end::Header wrapper-->
            </div>
            <!--end::Header container-->
        </div>
        <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Wrapper container-->
            <div class="app-container container-xxl d-flex flex-row-fluid">
                <div class="flex-column flex-row-fluid">
                    @yield('content')
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer d-flex flex-column flex-md-row align-items-center flex-center flex-md-stack py-2 py-lg-4">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2023 - {{ date('Y') }} &copy;</span>
                            <a href="https://routind.com" class="text-gray-800 text-hover-primary">routind</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item">
                                <a href="javascript:void(0)" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0)" target="_blank" class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0)" target="_blank" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Footer-->
                </div>
            </div>
            <!--end::Wrapper container-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<!--begin::Engage-->
<div class="app-engage" id="kt_app_engage">
    <!--begin::Prebuilts toggle-->
    <a href="https://wa.me/6285947517463" target="_blank" class="app-engage-btn hover-success">
        <i class="ki-duotone ki-whatsapp text-white fs-3x pt-1 mb-2">
            <span class="path1"></span><span class="path2"></span></i>
    </a>
    <!--end::Prebuilts toggle-->
</div>
<!--end::Engage-->
<!--begin::Modals-->
@yield('modal')
<!--end::Modals-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ url('demo37/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ url('demo37/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
@yield('js')
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>