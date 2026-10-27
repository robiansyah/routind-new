@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('home') }}" action="{{ route('login') }}" method="POST">
                @csrf

                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h2 class="text-dark fw-bolder fs-1 mb-3">Masuk</h2>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6">Masuk ke akun anda dengan mengisi form dibawah ini</div>
                    <!--end::Subtitle=-->
                </div>
                <!--begin::Heading-->
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
                <!--begin::Sign up-->
                <div class="text-gray-500 text-center fw-semibold fs-6">Belum Punya Akun?
                    <a href="{{ route('register') }}" class="link-primary">Daftar</a></div>
                <!--end::Sign up-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Footer-->
        <div class="d-flex flex-stack">
            <!--begin::Links-->
            <div class="d-flex fw-semibold text-primary fs-base gap-5">
                <a href="{{ route('academy') }}">Academy</a>
                <a href="{{ route('event') }}">Event</a>
                <a href="{{ route('partnership') }}">Partnership</a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
@endsection
@section('js')

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ url('disc/assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <!--end::Custom Javascript-->
@endsection