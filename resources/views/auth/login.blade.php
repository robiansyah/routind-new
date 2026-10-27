@extends('layouts.auth_new')
@section('title', 'Login')
@section('content')
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-1 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-1">
                    <!--begin::Form-->
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <!--begin::Wrapper-->
                        <div class="w-lg-500px p-10">
                            <!--begin::Form-->
                            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('home') }}" action="{{ route('login') }}" method="POST">
                                @csrf

                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Logo-->
                                    <a href="{{ route('login') }}" class="mb-0 mb-lg-12">
                                        <img alt="Logo" src="{{ url('disc/assets/media/logos/Logo Routind warna.png') }}" class="h-60px h-lg-75px" loading="lazy" />
                                    </a>
                                    <!--end::Logo-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold mt-3 fs-6">Masuk ke akun anda</div>
                                    <!--end::Subtitle=-->
                                </div>
                                <!--begin::Heading-->
                                <div class="row g-3 mb-9">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <!--begin::Google link=-->
                                        <a href="{{ url('/auth/google') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                            <img alt="Logo" src="{{ url('disc/assets/media/svg/brand-logos/google-icon.svg') }}" class="h-15px me-3" loading="lazy">Sign in with Google</a>
                                        <!--end::Google link=-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <!--begin::Google link=-->
                                        <a href="{{ url('/auth/github') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                            <img alt="Logo" src="{{ url('disc/assets/media/svg/brand-logos/github-icon.svg') }}" class="h-15px me-3" loading="lazy">Sign in with Github</a>
                                        <!--end::Google link=-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                                </div>
                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" required/>
                                    <!--end::Email-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-3" data-kt-password-meter="true">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" required/>
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="ki-outline ki-eye-slash fs-2"></i>
                                        <i class="ki-outline ki-eye fs-2 d-none"></i>
                                    </span>
                                    <!--end::Password-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-3">
                                    <div class="mt-5 d-flex align-items-start">
                                        <div class="captcha me-4" id="reload">
                                            <span>{!! captcha_img() !!}</span>
                                            <p class="m-0 fs-8">klik untuk ubah kode</p>
                                        </div>
                                        <input type="text" placeholder="Kode Keamanan" name="captcha" id="captcha" maxlength="4" autocomplete="off" class="form-control bg-transparent" required/>
                                    </div>
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <!--begin::Link-->
                                    <a href="{{ route('password.request') }}" class="link-primary">Lupa Password ?</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Submit button-->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Masuk</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Submit button-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
            <!--begin::Footer-->
            <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                <!--begin::Links-->
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="{{ route('academy') }}">Academy</a>
                    <a href="{{ route('event') }}">Courses</a>
                    <a href="{{ route('partnership') }}">Partnership</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->

        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-2 order-lg-2" style="background-image: url('/disc/assets/media/auth/bg6.jpg'); min-height: 400px;">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <div class="text-center w-100">
                    <h2 class="fs-2hx text-dark mb-5">Our Partners</h2>
                    <div class="tns" style="direction: ltr">
                        <div data-tns="true" data-tns-nav-position="bottom" data-tns-mouse-drag="true" data-tns-controls="false">
                            @foreach(\App\Models\Partnership::orderBy('created_at', 'desc')->lazy() as $item)
                                <div class="text-center px-2">
                                    <img src="{{ url('img/'.$item->logo) }}" class="mw-lg-50 mw-100px" title="{{ $item->name }}" loading="lazy" />
                                    <p class="fs-4 text-dark mt-3">{{ $item->name }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
@endsection
@section('js')

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ url('disc/assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <!--end::Custom Javascript-->
@endsection

