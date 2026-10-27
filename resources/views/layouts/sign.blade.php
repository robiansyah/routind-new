
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <!-- begin::Head -->
    <head>
        <!--begin::Base Path (base relative path for assets of this page) -->
        <!--end::Base Path -->
        <meta charset="utf-8" />
        <title>Simulator Pajak</title>
        <meta name="description" content="Latest updates and statistic charts"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        @include('layouts.css')
        @yield('css')
        
        <meta name="apple-mobile-web-app-status-bar" content="#212c5f"/>
        <meta name="theme-color" content="#212c5f"/>
        <script>var ctx = "/account/"; var cdn = "https://static.pajak.go.id";</script>
    </head>
    <!-- end::Head -->
    <!-- begin::Body -->
    <body class="kt-page--loading-enabled kt-page--loading kt-page--fixed kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading kt-header__topbar--mobile-on" style="width: 100%">
        <!-- begin::Page loader -->
        <!-- end::Page Loader -->
        <!-- begin:: Page -->
        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
            <h3 style="color:black;">Simulator Lapor Pajak Online</h3>
                <a href="{{ url('login') }}">
                    <!-- <img alt="Logo" src="https://static.pajak.go.id/assets/media/logos/Logo DJP.png" /> -->
                </a>
            </div>
        </div>
        <!-- end:: Header Mobile -->
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">
                    <div> 
                        <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed "
                            data-ktheader-minimize="on">
                            <div class="kt-header__top">
                                <div class="kt-container">
                                    <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                                        <div class="kt-header__brand-logo">
                                        <h2 style="color:black;">Simulator Lapor Pajak Online</h2>
                                            <a href="{{ url('') }}"> 
                                                <!-- <img alt="Logo" src="https://static.pajak.go.id/assets/media/logos/Logo DJP.png" class="kt-header__brand-logo-default" /> <img alt="Logo" src="https://static.pajak.go.id/assets/media/logos/Logo DJP.png" class="kt-header__brand-logo-sticky" /> -->
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="body-konten" class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
                        <style>
                            #body-konten{background: url({{ url('assets/media/bg/background.jpg') }});
                                background-size: cover; background-position: center center;
                            }
                        </style>
                        <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
                            <div class="grid-djp kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                                <!-- begin:: Content -->
                                <div class="kt-content kt-grid__item kt-grid__item--fluid">
                                    @yield('content')
                                </div>
                                <!-- end:: Content -->
                            </div>
                        </div>
                    </div>
                        
                    <div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer"
                        style="background-color: #21006F; color: #FFFFFF">

                        <div class="kt-footer__bottom" style="background-color: #F9F871; color: #1B1B1B;padding: 18px 0; height: 70px">
                            <div class="kt-container">
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h2 style="margin-bottom: 0; letter-spacing: -1px;">
                                            <strong>
                                                Pajak Kita, Untuk Kita
                                            </strong>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-footer__top" style="padding:3px 0 10px 0;">
                            <div class="kt-container">
                                <div class="row">
                                    <div class="col-md-4" style="margin-bottom: 15px">
                                        <div class="kt-footer__section">
                                            <h3 class="kt-footer__title" style="margin-bottom: 0px;">
                                                <img src="https://access.fe.uin-malang.ac.id/assets/images/Logo%20UIN%20Putih.png" width="100px">
                                            </h3>
                                            <div class="kt-footer__content">
                                                <p style="font-size:14px;color:white;margin-bottom: 0px;font-weight: 500;line-height: 24px;">
                                                   Jalan Gajayana no 50, Malang Jawa Timur 65144<br>
                                                   Telp: (+62) 341 - 558881</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="margin-bottom: 15px">
                                        <div style="width: 50%;float: left; padding-left: 10px;">
                                            <br><h4 style="margin-bottom: 14px; font-weight: 300; font-size: 24px;">Ikuti Kami</h4>
                                            <ul class="social-icons">
                                                <li class="social-icons-facebook">
                                                    <a href="#" target="_blank"
                                                    rel="noopener noreferrer" title="Facebook"><i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li class="social-icons-twitter">
                                                    <a href="#" target="_blank"
                                                    rel="noopener noreferrer" title="Twitter"><i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="social-icons-youtube">
                                                    <a href="#" target="_blank"
                                                    rel="noopener noreferrer" title="Youtube"><i class="fab fa-youtube"></i>
                                                    </a>
                                                </li>
                                                <li class="social-icons-google">
                                                    <a href="#" target="_blank"
                                                    rel="noopener noreferrer" title="Instagram"><i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            <h5 class="caption-sosmed">@TaxCenterUINMaliki</h5>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="kt-footer__wrapper">
                                    <div class="kt-footer__copyright"
                                        style="color: #ccc; margin-bottom: 16px; font-size: .9em; font-weight: 500;">
                                        Copyright&nbsp;
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script>
                                        Tax Center UIN Maliki.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>
        @yield('modal')
        @include('layouts.js')
        @yield('js')
        <!--end::Page Scripts -->
    </body>
    <!-- end::Body -->
</html>