<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Sidebar primary-->
    <div class="app-sidebar-primary">
        <!--begin::Logo-->
        <div class="app-sidebar-logo d-none d-md-flex flex-center pt-5 mb-5" id="kt_app_sidebar_logo">
            <!--begin::Logo image-->
            <a href="{{ route('pelajar.index') }}">
                <img alt="Logo" src="{{ url('disc/assets/media/logos/Routind free.png') }}" class="h-30px" />
            </a>
            <!--end::Logo image-->
        </div>
        <!--end::Logo-->
        <!--begin::Primary menu-->
        <div class="app-sidebar-menu flex-grow-1 hover-scroll-overlay-y scroll-ps mx-2 my-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div id="kt_aside_menu" class="menu menu-rounded menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold fs-6" data-kt-menu="true">
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item {!! (Request::segment(1) == 'informasi' || Request::segment(1) == 'profil' || Request::segment(1) == 'pengaturan'|| Request::segment(1) == 'paket'|| Request::segment(1) == 'invoice') ? 'here show' : '' !!} py-2">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="ki-outline ki-home-2 fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Home</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'informasi') ? 'active' : '' !!}" href="{{ route('pelajar.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'profil' && Request::segment(2) == '') ? 'active' : '' !!}" href="{{ route('pelajar.profil') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Profil</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'pengaturan') ? 'active' : '' !!}" href="{{ route('pelajar.setting') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Pengaturan</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                @if(auth()->user()->wp_type==2)
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item {!! (Request::segment(1) == 'faktur') ? 'here show' : '' !!} py-2">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="ki-outline ki-subtitle fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Faktur Area</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item {!! (Request::segment(2) == 'pajak' || Request::segment(2) == 'retur') ? 'here show' : '' !!} menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Faktur</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {!! (Request::segment(2) == 'pajak' && Request::segment(3) == 'keluaran') ? 'active' : '' !!}" href="{{ route('faktur.pajak', ['type'=>'keluaran']) }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pajak Keluaran</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {!! (Request::segment(2) == 'pajak' && Request::segment(3) == 'masukan') ? 'active' : '' !!}" href="{{ route('faktur.pajak', ['type'=>'masukan']) }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pajak Masukan</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {!! (Request::segment(2) == 'retur' && Request::segment(3) == 'keluaran') ? 'active' : '' !!}" href="{{ route('faktur.retur', ['type'=>'keluaran']) }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Retur Pajak Keluaran</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {!! (Request::segment(2) == 'retur' && Request::segment(3) == 'masukan') ? 'active' : '' !!}" href="{{ route('faktur.retur', ['type'=>'masukan']) }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Retur Pajak Masukan</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item {!! (Request::segment(2) == 'other') ? 'here show' : '' !!} menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Dokumen Lainnya</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {!! (Request::segment(2) == 'other' && Request::segment(3) == 'keluaran') ? 'active' : '' !!}" href="{{ route('faktur.other', ['type'=>'keluaran']) }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Dokumen Ekspor</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {!! (Request::segment(2) == 'other' && Request::segment(3) == 'masukan') ? 'active' : '' !!}" href="{{ route('faktur.other', ['type'=>'masukan']) }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Dokumen Impor</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item {!! (Request::segment(1) == 'ebupot' || Request::segment(1) == 'pph21') ? 'here show' : '' !!} py-2">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="ki-outline ki-note-2 fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto" style="">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Bupot Area</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(3) == 'input-ps42152223' || Request::segment(3) == 'dftr-ps42152223') ? 'active' : '' !!}" href="{{ route('ebupot.pph.index', ['type'=>'dftr-ps42152223']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">BPPU</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(3) == 'input-ps26' || Request::segment(3) == 'dftr-ps26') ? 'active' : '' !!}" href="{{ route('ebupot.pph.index', ['type'=>'dftr-ps26']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">BPNR</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(3) == 'input-disetor-sendiri' || Request::segment(3) == 'dftr-disetor-sendiri') ? 'active' : '' !!}" href="{{ route('ebupot.pph.index', ['type'=>'dftr-disetor-sendiri']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Penyetoran Sendiri</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'pph21' &&  Request::segment(2) == 'bupot' && Request::segment(3) == 'selain_pegawai') ? 'active' : '' !!}" href="{{ route('pph21.bupot', ['type'=>'selain_pegawai']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">BP 21 Selain Pegawai Tetap</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'pph21' &&  Request::segment(2) == 'bupot' && Request::segment(3) == 'pegawai') ? 'active' : '' !!}" href="{{ route('pph21.bupot', ['type'=>'pegawai']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">BP Bulanan Pegawai Tetap</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'pph21' &&  Request::segment(2) == 'bupot' && Request::segment(3) == 'a1' || Request::segment(2) == 'a1') ? 'active' : '' !!}" href="{{ route('pph21.bupot', ['type'=>'a1']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Bukti Potong A1</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item {!! (Request::segment(1) == 'eform') ? 'here show' : '' !!} py-2">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="ki-outline ki-questionnaire-tablet fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Form Area</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'eform' &&  Request::segment(2) == 'arsip') ? 'active' : '' !!}" href="{{ route('pelajar.eform.arsip') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Arsip SPT</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'eform' &&  Request::segment(2) == 'buat') ? 'active' : '' !!}" href="{{ route('pelajar.eform.buat') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Buat SPT</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'eform' &&  Request::segment(2) == 'draf') ? 'active' : '' !!}" href="{{ route('pelajar.eform.draf') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Draf SPT</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                @else
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item {!! (Request::segment(1) == 'spt' || Request::segment(1) == 'efile') ? 'here show' : '' !!} py-2">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="ki-outline ki-notification-status fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Filling Area</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'spt' && Request::segment(2) == 'arsip') ? 'active' : '' !!}" href="{{ route('pelajar.spt.arsip') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Arsip SPT</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'spt' && Request::segment(2) == 'buat' || Request::segment(1) == 'efile') ? 'active' : '' !!}" href="{{ route('pelajar.spt.buat') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Buat SPT</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'spt' && Request::segment(2) == 'draf') ? 'active' : '' !!}" href="{{ route('pelajar.spt.draf') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Draf SPT</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                @endif
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item {!! (Request::segment(1) == 'returnsheets') ? 'here show' : '' !!} py-2">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="ki-outline ki-book fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-300px mh-75 overflow-auto">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">SPT Area</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(2) == 'konsep' || Request::segment(1)=='returnsheets' && Request::segment(3) == 'detail') ? 'active' : '' !!}" href="{{ route('spt.index', ['status'=>'konsep']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                <span class="menu-title">Konsep SPT</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(2) == 'menunggu') ? 'active' : '' !!}" href="{{ route('spt.index', ['status'=>'menunggu']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                <span class="menu-title">SPT Menunggu Pembayaran </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(2) == 'selesai') ? 'active' : '' !!}" href="{{ route('spt.index', ['status'=>'selesai']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                <span class="menu-title">SPT Dilaporkan</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(2) == 'dibatalkan') ? 'active' : '' !!}" href="{{ route('spt.index', ['status'=>'dibatalkan']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                <span class="menu-title">SPT Dibatalkan</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item {!! (Request::segment(1) == 'billing') ? 'here show' : '' !!} py-2">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="ki-outline ki-cheque fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Billing Area</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'billing' && Request::segment(2) == 'belum') ? 'active' : '' !!}" href="{{ route('pelajar.billing.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Billing Belum Dibayar</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'billing' && Request::segment(2) == '') ? 'active' : '' !!}" href="{{ route('pelajar.billing') }}" target="_blank">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Buat Billing</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {!! (Request::segment(1) == 'billing' && Request::segment(2) == 'payment') ? 'active' : '' !!}" href="{{ route('pelajar.billing.payment') }}" target="_blank">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Virtual Payment</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Primary menu-->
        @php
            $name = (auth()->user()->wp_type==1) ? strtoupper(auth()->user()->name) : strtoupper(auth()->user()->profile->corporate_name);
            $ava = Avatar::create($name)->toBase64();

        @endphp
        <!--begin::Footer-->
        <div class="d-flex flex-column flex-center pb-4 pb-lg-8" id="kt_app_sidebar_footer">
            <!--begin::User menu-->
            <div class="cursor-pointer symbol symbol-40px symbol-circle" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-attach="parent" data-kt-menu-placement="right-end">
                <img class="symbol-label fs-2 fw-semibold text-primary bg-light-primary" src="{{ $ava }}"/>
            </div>
            <!--begin::User account menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-40px symbol-circle me-3">
                            <img class="symbol-label fs-2 fw-semibold text-primary bg-light-primary" src="{{ $ava }}">
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5">{{ $name }}</div>
                            <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                @if(auth()->user()->hasRole('pengajar') || auth()->user()->hasRole('co-pengajar'))
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{ route('pengajar.index') }}" target="_blank" class="menu-link px-5">Area Edukasi</a>
                </div>
                @endif
                @php($class_student = \App\Models\ClassStudent::with('kelas')->where('student_id', auth()->user()->id)->first())
                @if($class_student)
                <div class="menu-item px-5">
                    <a href="{{ route('ruang.kelas', ['code'=>$class_student->kelas->code]) }}" target="_blank" class="menu-link px-5">Ruang Kelas</a>
                </div>
                @endif
                @if(Session::get('exam'))
                <div class="menu-item px-5">
                    <a href="{{ route('service.launch', 'exam') }}" target="_blank" class="menu-link px-5">Exam</a>
                </div>
                @endif
                @if(Session::get('lms'))
                <div class="menu-item px-5">
                    <a href="{{ route('service.launch', 'lms') }}" target="_blank" class="menu-link px-5">LMS</a>
                </div>
                @endif
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{ route('pelajar.profil') }}" class="menu-link px-5">Profil</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{ route('pelajar.setting') }}" class="menu-link px-5">Pengaturan</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">Mode
                        <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                            <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                            <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                        </span></span>
                    </a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-outline ki-night-day fs-2"></i>
                                </span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-outline ki-moon fs-2"></i>
                                </span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-outline ki-screen fs-2"></i>
                                </span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{ route('logout') }}" class="menu-link px-5"
                       onclick="event.preventDefault();var check = confirm('Apakah Anda yakin akan keluar?');if(check){document.getElementById('logout-form').submit();}">Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::User account menu-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Sidebar primary-->

    <!--begin::Sidebar secondary-->
    <div class="app-sidebar-secondary">
        <!--begin::Sidebar secondary wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Sidebar secondary wrapper-->
            <div class="d-flex flex-column pt-10 ps-11" id="kt_app_sidebar_secondary_header">
                <!--begin::Action-->
                <a href="{{ route('pelajar.index') }}" class="d-flex align-items-center custom-link fs-6 fw-semibold mb-5">
                <i class="ki-outline ki-black-left fs-2 me-3 text-white opacity-50"></i>Kembali ke dashboard</a>
                <!--end::Action-->
                <span class="fs-2 fw-bolder text-white">routind</span>
            </div>
            <!--end::Sidebar secondary wrapper-->
            <!--begin::Sidebar secondary menu-->
            <div class="app-sidebar-secondary-menu menu menu-sub-indention menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 py-4 py-lg-6" id="kt_app_sidebar_secondary_menu" data-kt-menu="true">
                <div id="kt_app_sidebar_secondary_menu_wrapper" class="hover-scroll-y px-3 mx-3" data-kt-scroll="true" data-kt-scroll-activate="{default: true, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_secondary_header" data-kt-scroll-wrappers="#kt_app_sidebar_secondary_menu" data-kt-scroll-offset="20px">
                    @if(Request::segment(1) == 'spt' || Request::segment(1) == 'efile')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Filling Area</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'spt' && Request::segment(2) == 'arsip') ? 'active' : '' !!}" href="{{ route('pelajar.spt.arsip') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Arsip SPT</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'spt' && Request::segment(2) == 'buat' || Request::segment(1) == 'efile') ? 'active' : '' !!}" href="{{ route('pelajar.spt.buat') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Buat SPT</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'spt' && Request::segment(2) == 'draf') ? 'active' : '' !!}" href="{{ route('pelajar.spt.draf') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Draf SPT</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @elseif(Request::segment(1) == 'billing')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Billing Area</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'billing' && Request::segment(2) == 'belum') ? 'active' : '' !!}" href="{{ route('pelajar.billing.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Billing Belum Dibayar</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'billing' && Request::segment(2) == '') ? 'active' : '' !!}" href="{{ route('pelajar.billing') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Buat Billing</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'billing' && Request::segment(2) == 'payment' || Request::segment(2) == 'inquiry') ? 'active' : '' !!}" href="{{ route('pelajar.billing.payment') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Virtual Payment</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @elseif(Request::segment(1) == 'eform')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Form Area</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'eform' &&  Request::segment(2) == 'arsip') ? 'active' : '' !!}" href="{{ route('pelajar.eform.arsip') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Arsip SPT</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'eform' &&  Request::segment(2) == 'buat') ? 'active' : '' !!}" href="{{ route('pelajar.eform.buat') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Buat SPT</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'eform' &&  Request::segment(2) == 'draf') ? 'active' : '' !!}" href="{{ route('pelajar.eform.draf') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Draf SPT</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @elseif(Request::segment(1) == 'faktur')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Faktur Area</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {!! (Request::segment(2) == 'pajak' || Request::segment(2) == 'retur') ? 'here show' : '' !!} menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Faktur</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {!! (Request::segment(2) == 'pajak' && Request::segment(3) == 'keluaran') ? 'active' : '' !!}" href="{{ route('faktur.pajak', ['type'=>'keluaran']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pajak Keluaran</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {!! (Request::segment(2) == 'pajak' && Request::segment(3) == 'masukan') ? 'active' : '' !!}" href="{{ route('faktur.pajak', ['type'=>'masukan']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pajak Masukan</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {!! (Request::segment(2) == 'retur' && Request::segment(3) == 'keluaran') ? 'active' : '' !!}" href="{{ route('faktur.retur', ['type'=>'keluaran']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Retur Pajak Keluaran</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {!! (Request::segment(2) == 'retur' && Request::segment(3) == 'masukan') ? 'active' : '' !!}" href="{{ route('faktur.retur', ['type'=>'masukan']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Retur Pajak Masukan</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {!! (Request::segment(2) == 'other') ? 'here show' : '' !!} menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Dokumen Lainnya</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {!! (Request::segment(2) == 'other' && Request::segment(3) == 'keluaran') ? 'active' : '' !!}" href="{{ route('faktur.other', ['type'=>'keluaran']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Dokumen Ekspor</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {!! (Request::segment(2) == 'other' && Request::segment(3) == 'masukan') ? 'active' : '' !!}" href="{{ route('faktur.other', ['type'=>'masukan']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Dokumen Impor</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                    @elseif (Request::segment(1)=='ebupot' || Request::segment(1)=='pph21')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">e-Bupot Area</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(3) == 'input-ps42152223' || Request::segment(3) == 'dftr-ps42152223') ? 'active' : '' !!}" href="{{ route('ebupot.pph.index', ['type'=>'dftr-ps42152223']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">BPPU</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(3) == 'input-ps26' || Request::segment(3) == 'dftr-ps26') ? 'active' : '' !!}" href="{{ route('ebupot.pph.index', ['type'=>'dftr-ps26']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">BPNR</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(3) == 'input-disetor-sendiri' || Request::segment(3) == 'dftr-disetor-sendiri') ? 'active' : '' !!}" href="{{ route('ebupot.pph.index', ['type'=>'dftr-disetor-sendiri']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Penyetoran Sendiri</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'pph21' &&  Request::segment(2) == 'bupot' && Request::segment(3) == 'selain_pegawai') ? 'active' : '' !!}" href="{{ route('pph21.bupot', ['type'=>'selain_pegawai']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">BP 21 Selain Pegawai Tetap</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'pph21' &&  Request::segment(2) == 'bupot' && Request::segment(3) == 'pegawai') ? 'active' : '' !!}" href="{{ route('pph21.bupot', ['type'=>'pegawai']) }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">BP Bulanan Pegawai Tetap</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'pph21' &&  Request::segment(2) == 'bupot' && Request::segment(3) == 'a1' || Request::segment(2) == 'a1') ? 'active' : '' !!}" href="{{ route('pph21.bupot', ['type'=>'a1']) }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">Bukti Potong A1</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @elseif (Request::segment(1)=='returnsheets')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">SPT Area</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(2) == 'konsep' || Request::segment(1)=='returnsheets' && Request::segment(3) == 'detail') ? 'active' : '' !!}" href="{{ route('spt.index', ['status'=>'konsep']) }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">Konsep SPT</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(2) == 'menunggu') ? 'active' : '' !!}" href="{{ route('spt.index', ['status'=>'menunggu']) }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">SPT Menunggu Pembayaran </span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(2) == 'selesai') ? 'active' : '' !!}" href="{{ route('spt.index', ['status'=>'selesai']) }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">SPT Dilaporkan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(2) == 'dibatalkan') ? 'active' : '' !!}" href="{{ route('spt.index', ['status'=>'dibatalkan']) }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">SPT Dibatalkan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @else
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Home</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'informasi') ? 'active' : '' !!}" href="{{ route('pelajar.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'profil' && Request::segment(2) == '') ? 'active' : '' !!}" href="{{ route('pelajar.profil') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Profil</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {!! (Request::segment(1) == 'pengaturan') ? 'active' : '' !!}" href="{{ route('pelajar.setting') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pengaturan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    @endif
                </div>
            </div>
            <!--end::Sidebar secondary menu-->
        </div>
        <!--end::Sidebar secondary wrapper-->
    </div>
    <!--end::Sidebar secondary-->
    <!--begin::Sidebar secondary toggle-->
    <button id="kt_app_sidebar_secondary_toggle" class="app-sidebar-secondary-toggle btn btn-sm btn-icon bg-body btn-color-gray-600 btn-active-color-primary position-absolute translate-middle z-index-1 start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex mb-4" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-secondary-collapse">
        <i class="ki-outline ki-arrow-left fs-2 rotate-180"></i>
    </button>
    <!--end::Sidebar secondary toggle-->
</div>
<!--end::Sidebar-->