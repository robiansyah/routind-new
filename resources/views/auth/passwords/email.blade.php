@extends('layouts.auth_new')
@section('title', 'Lupa Password')
@section('content')
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
                            <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" data-kt-redirect-url="{{ route('login') }}" action="{{ route('password.email') }}">
                                @csrf

                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Title-->
                                    <h2 class="text-dark fw-bolder fs-1 mb-3">Lupa Password</h2>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">Masukkan email anda untuk mereset password</div>
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
                                <!--begin::Actions-->
                                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                    <button type="button" id="kt_password_reset_submit" class="btn btn-primary me-4">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Submit</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
                                </div>
                                <!--end::Actions-->
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
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-2 order-lg-2" style="background-image: url('/disc/assets/media/auth/bg6.jpg')">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <h2 class="fs-2hx text-dark mb-5">Our Partners</h2>
                <!--begin::Image-->
                <div class="tns" style="direction: ltr">
                    <div data-tns="true" data-tns-nav-position="bottom" data-tns-mouse-drag="true" data-tns-controls="false">
                        @foreach(\App\Models\Partnership::orderBy('created_at', 'desc')->limit(5)->get() as $item)
                            <!--begin::Item-->
                            <div class="text-center">
                                <img src="{{ url('img/'.$item->logo) }}" class="mw-50" title="{{ $item->name }}" />
                                <p class="fs-2 text-dark mt-5">{{ $item->name }}</p>
                            </div>
                            <!--end::Item-->
                        @endforeach
                    </div>
                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
@endsection
@section('js')

<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ url('disc/assets/js/custom/authentication/reset-password/reset-password.js') }}"></script>
<!--end::Custom Javascript-->
@endsection