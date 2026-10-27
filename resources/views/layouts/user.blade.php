
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <!-- begin::Head -->
    <head>
        <title>@yield('title') | Simulator Lapor Pajak Online </title>
        <!--begin::Base Path (base relative path for assets of this page) -->
        <!--end::Base Path -->
        <meta charset="utf-8" />
        <meta name="description" content="Latest updates and statistic charts" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        @yield('css_start')
        @include('layouts.css2')
        @yield('css')
        <meta name="apple-mobile-web-app-status-bar" content="#212c5f"/>
        <meta name="theme-color" content="#212c5f"/>
        <style>
            .nav-djp.active, .nav-djp:active, .nav-djp:hover{
                color: #fff !important;
                background-color: #212c5f !important;
            }
            .nav-tabs.nav-tabs-line.nav-tabs-line-djp.nav-tabs-line-2x, .nav-tabs.nav-tabs-line.nav-tabs-line-djp.nav-tabs-line-3x{
                border-bottom-color: rgba(33, 44, 95, 0.1)
            }
            .nav-tabs.nav-tabs-line.nav-tabs-line-djp.nav.nav-tabs .nav-link:hover, .nav-tabs.nav-tabs-line.nav-tabs-line-djp.nav.nav-tabs .nav-link.active, .nav-tabs.nav-tabs-line.nav-tabs-line-djp a.nav-link:hover, .nav-tabs.nav-tabs-line.nav-tabs-line-djp a.nav-link.active{
                color: #212c5f;
                border-bottom: 1px solid #212c5f;
            }
            .nav-tabs.nav-tabs-line.nav-tabs-line-djp.nav.nav-tabs .nav-link:hover > i, .nav-tabs.nav-tabs-line.nav-tabs-line-djp.nav.nav-tabs .nav-link.active > i, .nav-tabs.nav-tabs-line.nav-tabs-line-djp a.nav-link:hover > i, .nav-tabs.nav-tabs-line.nav-tabs-line-djp a.nav-link.active > i{
                color: #212c5f;
            }
        </style>
        <script>
            var ctx = "/";
            var fgH = "1";
            var fgE = "1";
            var fgP = "1";
            var lastUpdate = "";
            var notShow = "false";
            var cdn = "https://static.pajak.go.id";
        </script>
    </head>
    <!-- end::Head -->
    <!-- begin::Body -->
    <body class="kt-page--loading-enabled kt-page--loading kt-page--fixed kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading kt-header__topbar--mobile-on">
        <!-- begin::Page loader -->
        <!-- end::Page Loader -->
        <!-- begin:: Page -->
        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="{{ url('') }}"> 
                    <img alt="Logo" src="{{ url('assets/media/logos/logo_tlms_mobile.png') }}"/>
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                
                <button class="btn btn-djp-mobile btn-icon" id="kt_header_mobile_toggler">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
        <!-- end:: Header Mobile -->
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">
                    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
                        <div class="kt-header__top">
                            <div class="kt-container">
                                <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                                    <div class="kt-header__brand-logo">
                                        <a href="{{ url('') }}">
                                            <img alt="Logo" src="{{ url('assets/media/logos/logo_tlms.png') }}" class="kt-header__brand-logo-default" />
                                            <img alt="Logo" src="{{ url('assets/media/logos/logo_tlms.png') }}" class="kt-header__brand-logo-sticky" />
                                        </a>
                                    </div>
                                </div>
                                <div class="kt-header__topbar">
                                    <div class="kt-header__topbar kt-grid__item kt-grid__item--fluid user-djp">

                                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                                <span class="kt-hidden- kt-header__topbar-welcome" style="color: #287784; font-size: 1rem;"><strong>Halo,</strong></span>
                                                <span class="kt-hidden- kt-header__topbar-username" style="color: #212c5f; font-size: 1rem;"><strong>{{ auth()->user()->name }}</strong></span>
                                                <span class="kt-header__topbar-icon kt-header__topbar-icon--warning"><i class="flaticon2-user kt-font-warning"></i></span>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                                    <div class="kt-user-card__avatar">
                                                        <span class="kt-badge kt-badge--username kt-badge--unified-primary kt-badge--lg kt-badge--rounded kt-badge--bold"><i class="flaticon2-user"></i></span>
                                                    </div>
                                                    <div class="kt-user-card__name">
                                                        <span>{{ auth()->user()->name }}</span>
                                                    </div>
                                                </div>

                                                <div class="kt-notification">
                                                    <a href="{{ route('pelajar.profil') }}" class="kt-notification__item">
                                                        <div class="kt-notification__item-icon">
                                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                                        </div>
                                                        <div class="kt-notification__item-details">
                                                            <div class="kt-notification__item-title kt-font-bold">
                                                                Profil Saya
                                                            </div>
                                                            <div class="kt-notification__item-time">
                                                                Pengaturan akun dan lainnya
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="kt-notification__custom kt-space-between">
                                                        <a href="{{ route('logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold" 
                                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                            Keluar
                                                        </a>
                                                        
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="body-konten" class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
                        {{-- <style>
                            #body-konten {
                                background: url({{ url('assets/media/bg/background.jpg') }});
                                background-size: cover;
                                background-position: center center;
                            }
                        </style> --}}
                        <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
                            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                                <!-- begin:: Content Head -->
                                @if(Request::segment(1)=='billing')
                                <div class="kt-subheader   kt-grid__item" id="kt_subheader" style="padding-bottom: 0px !important;">
                                    <div class="kt-subheader__main base-menu">
                                        <div class="kt-header-menu-wrapper pajak menu-wrapper-djp" id="kt_header_menu_wrapper" style="opacity: 1;">
                                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile menu-dashboard main-menu-djp">
                                                <ul class="kt-menu__nav ">
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='') ? 'kt-menu__item--active' : '' }}">
                                                        <a href="{{ route('pelajar.billing') }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Surat Setoran Elektronik</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='payment' || Request::segment(2)=='inquiry' || Request::segment(2)=='verify') ? 'kt-menu__item--active' : '' }}">
                                                        <a href="{{ route('pelajar.billing.payment') }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Pembayaran</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-subheader__toolbar">
                                        <div class="kt-subheader__wrapper">
                                            <a href="{{ route('pelajar.bayar') }}">
                                                <img class="img-responsive logo-aplikasi" src="/assets/media/logos/logo_ebilling.png" height="80px">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @elseif(Request::segment(1)=='spt' || Request::segment(1)=='efile')
                                <div class="kt-subheader   kt-grid__item" id="kt_subheader" style="padding-bottom: 0px !important;">
                                    <div class="kt-subheader__main base-menu">
                                        <div class="kt-header-menu-wrapper pajak menu-wrapper-djp" id="kt_header_menu_wrapper">
                                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile menu-dashboard main-menu-djp">
                                                <ul class="kt-menu__nav ">
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='arsip') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="/spt/arsip" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Arsip SPT</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='buat' || Request::segment(1)=='efile') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="/spt/buat" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Buat SPT</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='draf') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="/spt/draf" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Draft SPT</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='bantuan') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="/spt/bantuan" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Bantuan</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-subheader__toolbar">
                                        <div class="kt-subheader__wrapper">
                                            <a href="#">
                                                <img class="img-responsive logo-aplikasi" src="/assets/media/logos/logo_efiling.png" height="80px"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @elseif(Request::segment(1)=='email')
                                <div class="kt-subheader   kt-grid__item" id="kt_subheader" style="padding-bottom: 0px !important;">
                                    <div class="kt-subheader__main base-menu">
                                        <div class="kt-header-menu-wrapper pajak menu-wrapper-djp" id="kt_header_menu_wrapper" style="opacity: 1;">
                                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile menu-dashboard main-menu-djp">
                                                <ul class="kt-menu__nav ">
                                                    <li class="kt-menu__item kt-menu__item--active">
                                                        <a href="/" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Verifikasi Alamat Email Anda</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-subheader__toolbar">
                                        <div class="kt-subheader__wrapper">
                                            <a href="{{ route('pelajar.billing') }}">
                                                <img class="img-responsive logo-aplikasi" src="https://bebassampah.id/landing/img/icon/emailverif.png" height="80px">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @elseif(Request::segment(1)=='ebupot')
                                <div class="kt-subheader kt-grid__item" id="kt_subheader"
                                     style="padding-bottom: 0px !important;">
                                    <div class="kt-subheader__main base-menu">
                                        <div class="kt-header-menu-wrapper pajak menu-wrapper-djp"
                                             id="kt_header_menu_wrapper">
                                            <div id="kt_header_menu"
                                                 class="kt-header-menu kt-header-menu-mobile menu-dashboard main-menu-djp">
                                                <ul class="kt-menu__nav ">
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='dashboard') ? 'kt-menu__item--active' : '' }}">
                                                        <a href="{{ route('ebupot.index') }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Dashboard</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='pph') ? 'kt-menu__item--active' : '' }}">
                                                        <a href="{{ route('ebupot.pph', ['type'=>'dftr-disetor-sendiri']) }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Pajak&nbsp;Penghasilan</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='sptmasa') ? 'kt-menu__item--active' : '' }}">
                                                        <a href="{{ route('ebupot.spt', ['type'=>'rekam-bukti-setor']) }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">SPT&nbsp;Masa</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(2)=='pengaturan') ? 'kt-menu__item--active' : '' }}">
                                                        <a href="{{ route('ebupot.setting', ['type'=>'penandatangan']) }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Pengaturan</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-subheader__toolbar">
                                        <div class="kt-subheader__wrapper">
                                            <a href="/">
                                                <img class="img-responsive logo-aplikasi" src="https://static.pajak.go.id/assets/media/logos/logo_ebupot.png" height="80px"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="kt-subheader   kt-grid__item" id="kt_subheader" style="padding-bottom: 0px !important;">
                                    <div class="kt-subheader__main" style="padding: 0px !important; border-radius: 4px 4px 0 0">
                                        <div class="kt-header-menu-wrapper pajak menu-wrapper-djp" id="kt_header_menu_wrapper">
                                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile menu-dashboard main-menu-djp">
                                                <ul class="kt-menu__nav ">
                                                    <li class="kt-menu__item {{ (Request::segment(1)=='informasi') ? 'kt-menu__item--active' : '' }}">
                                                        <a href="{{ route('pelajar.index') }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Informasi</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(1)=='profil') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="{{ route('pelajar.profil') }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Profil</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(1)=='bayar') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="{{ route('pelajar.bayar') }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Bayar</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-menu__item {{ (Request::segment(1)=='lapor' || Request::segment(1)=='pralapor') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="{{ route('pelajar.lapor') }}" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Lapor</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-subheader__toolbar">
                                        <div class="kt-subheader__wrapper"></div>
                                    </div>
                                </div>
                                @endif
                                <!-- end:: Content Head -->
                                <!-- begin:: Content -->
                                <div class="kt-content kt-grid__item kt-grid__item--fluid" style="padding: 20px; background: #EBECF1; margin-bottom: 40px; border-radius: 0 8px 8px 8px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .2), 0 3px 10px 0 rgba(0, 0, 0, .19);">
                                    <!--Begin::Isi Konten-->
                                    @yield('content')
                                    <!--End::Isi Konten-->
                                </div>
                                <!-- end:: Content -->
                            </div>
                        </div>
                    </div>
                    @yield('modal')
                    <div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer"
                        style="background-color: #287784; color: #FFFFFF">

                        <div class="kt-footer__bottom" style="background-color: #ffc714; color: #1B1B1B;padding: 18px 0; height: 70px">
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
                                                <img src="{{ url('assets/media/logos/logo_dps.png') }}" width="250px">
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
{{--                                            <h5 class="caption-sosmed">@TaxCenterUINMaliki</h5>--}}
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
                                        Tax Learning Management System.
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
        @include('layouts.js')
        @yield('js')
        <!--end::Page Scripts -->
    </body>
    <!-- end::Body -->
</html>