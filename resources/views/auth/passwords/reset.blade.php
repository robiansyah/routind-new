@extends('layouts.auth_new')
@section('title', 'Atur Ulang Password')
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
                            <form class="form w-100" novalidate="novalidate" id="kt_new_password_form" data-kt-redirect-url="{{ route('login') }}" action="{{ route('password.update') }}">
                                <input type="hidden" name="token" value="{{ $token }}">
                                @csrf

                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-dark fw-bolder mb-3">Atur Ulang Password</h1>
                                    <!--end::Title-->
                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-6">Atur ulang password anda dengan mengisi form dibawah ini</div>
                                    <!--end::Link-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="email" placeholder="Email" name="email" value="{{ $email ?? old('email') }}" autocomplete="off" class="form-control bg-transparent" readonly/>
                                    <!--end::Email-->
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
                                    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group=-->
                                <!--end::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Repeat Password-->
                                    <input type="password" placeholder="Repeat Password" name="password_confirmation" autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Repeat Password-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Action-->
                                <div class="d-grid mb-10">
                                    <button type="button" id="kt_new_password_submit" class="btn btn-primary">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Submit</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Action-->
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
<script src="{{ url('disc/assets/js/custom/authentication/reset-password/new-password.js') }}"></script>
<!--end::Custom Javascript-->
@endsection
