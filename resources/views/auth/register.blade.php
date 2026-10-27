@extends('layouts.auth')
@section('title', 'Pendaftaran')
@section('content')
<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
    <!--begin::Wrapper-->
    <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
        <!--begin::Form-->
        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="{{ route('home') }}" action="{{ route('register') }}">
            @csrf

            <!--begin::Heading-->
            <div class="text-center mb-10">
                <!--begin::Title-->
                <h2 class="text-dark fw-bolder fs-1 mb-3">Pendaftaran</h2>
                <!--end::Title-->
                <!--begin::Link-->
                <div class="text-gray-500 fw-semibold fs-6">Silakan mengisi form dibawah ini untuk melakukan pendaftaran</div>
                <!--end::Link-->
            </div>
            <!--begin::Heading-->
            <!--begin::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Nama-->
                <input type="text" placeholder="Nama Lengkap" name="name" autocomplete="off" class="form-control bg-transparent" />
                <!--end::Nama-->
            </div>
            <!--end::Input group=-->
            <!--begin::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Email-->
                <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
                <!--end::Email-->
            </div>
            <!--end::Input group=-->
            <!--begin::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Mobile Phone-->
                <input type="email" placeholder="No HP" name="mobile_phone" autocomplete="off" class="form-control bg-transparent" />
                <!--end::Mobile Phone-->
            </div>
            <!--end::Input group=-->
            <!--begin::Input group-->
            <div class="fv-row mb-8" data-kt-password-meter="true">
                <!--begin::Wrapper-->
                <div class="mb-1">
                    <!--begin::Input wrapper-->
                    <div class="position-relative mb-3">
                        <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                            <i class="ki-outline ki-eye-slash fs-2"></i>
                            <i class="ki-outline ki-eye fs-2 d-none"></i>
                        </span>
                    </div>
                    <!--end::Input wrapper-->
                    <!--begin::Meter-->
                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                    </div>
                    <!--end::Meter-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Hint-->
                <div class="text-muted">Gunakan 8 karakter atau lebih dengan campuran huruf, angka & simbol.</div>
                <!--end::Hint-->
            </div>
            <!--end::Input group=-->
            <!--end::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Repeat Password-->
                <input type="password" placeholder="Ulangi Password" name="password_confirmation" autocomplete="off" class="form-control bg-transparent" />
                <!--end::Repeat Password-->
            </div>
            <!--end::Input group=-->
            <!--begin::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Mobile Phone-->
                <input type="text" placeholder="Kode Referral (Jika Ada)" name="referral" autocomplete="off" class="form-control bg-transparent" />
                <!--end::Mobile Phone-->
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
            <!--begin::Action-->
            <div class="d-grid mb-10">
                <button type="button" id="kt_sign_up_submit" class="btn btn-primary">
                    <!--begin::Indicator label-->
                    <span class="indicator-label">Daftar</span>
                    <!--end::Indicator label-->
                    <!--begin::Indicator progress-->
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    <!--end::Indicator progress-->
                </button>
            </div>
            <!--end::Action-->
            <!--begin::Sign up-->
            <div class="text-gray-500 text-center fw-semibold fs-6">Sudah Punya Akun?
            <a href="{{ route('login') }}" class="link-primary fw-semibold">Masuk</a></div>
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
            <a href="{{ route('event') }}">Courses</a>
            <a href="{{ route('partnership') }}">Partnership</a>
        </div>
        <!--end::Links-->
    </div>
    <!--end::Footer-->
</div>
@endsection
@section('js')

<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ url('disc/assets/js/custom/authentication/sign-up/general.js') }}"></script>
<!--end::Custom Javascript-->
@endsection

