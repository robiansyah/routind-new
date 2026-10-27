@extends('layouts.academy')
@section('title', 'Hubungi Kami')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
        <!--begin::Toolbar container-->
        <div class="d-flex flex-stack flex-row-fluid">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-column flex-row-fluid">
                <!--begin::Toolbar wrapper-->
                <!--begin::Page title-->
                <div class="page-title d-flex align-items-center me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-lg-2x gap-2">
                        <span>Hubungi Kami</span>
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                        <a href="{{ route('academy') }}" class="text-white text-hover-primary">
                            <i class="ki-outline ki-home text-gray-700 fs-6"></i>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">Academy</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">Hubungi Kami</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Contact-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <!--begin::Row-->
                <div class="row mb-3">
                    <!--begin::Col-->
                    <div class="col-md-12 pe-lg-10">
                        <!--begin::Form-->
                        <form action="" class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="post" id="kt_contact_form">
                            @csrf

                            <h1 class="fw-bold text-dark mb-9">Tulis Pesan Anda</h1>
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-semibold mb-2">Nama</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control" placeholder="" name="name" required>
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <!--end::Label-->
                                    <label class="fs-5 fw-semibold mb-2">Email</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input type="email" class="form-control" placeholder="" name="email" required>
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-semibold mb-2">Subjek</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" placeholder="" name="subject" required>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row fv-plugins-icon-container">
                                <label class="fs-6 fw-semibold mb-2">Pesan</label>
                                <textarea class="form-control" rows="6" name="message" placeholder="" required></textarea>
                            </div>
                            <!--end::Input group-->
                            <div class="fv-row mb-10">
                                <label class="fs-6 fw-semibold mb-2">Kode Keamanan</label>
                                <div class="d-flex align-items-start">
                                    <div class="captcha me-4" id="reload">
                                        <span>{!! captcha_img() !!}</span>
                                        <p class="m-0 fs-8">klik untuk mengganti</p>
                                    </div>
                                    <input type="text" name="captcha" id="captcha" maxlength="4" autocomplete="off" class="form-control bg-transparent" required/>
                                </div>
                            </div>
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary" id="kt_contact_submit_button">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Submit</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                            <!--end::Submit-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-5 mb-5 mb-lg-15">
                    <!--begin::Col-->
                    <div class="col-sm-4 ps-lg-10">
                        <!--begin::Address-->
                        <div class="text-center bg-light card-rounded d-flex flex-column flex-center p-10 h-100">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-briefcase fs-3tx text-primary"></i>
                            <!--end::Icon-->
                            <!--begin::Subtitle-->
                            <h1 class="text-dark fw-bold my-5">Proposal</h1>
                            <!--end::Subtitle-->
                            <!--begin::Description-->
                            <a href="https://drive.google.com/drive/folders/1PXr4XLnliFfBNVIHQZLK79zSY6XYzAfn?usp=sharing" target="_blank" class="text-gray-700 fs-3 fw-semibold">Download</a>
                            <!--end::Description-->
                        </div>
                        <!--end::Address-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-sm-4 pe-lg-10">
                        <!--begin::Phone-->
                        <div class="bg-light card-rounded d-flex flex-column flex-center flex-center p-10 h-100">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-whatsapp fs-3tx text-primary"></i>
                            <!--end::Icon-->
                            <!--begin::Subtitle-->
                            <h1 class="text-dark fw-bold my-5">Let’s Speak</h1>
                            <!--end::Subtitle-->
                            <!--begin::Number-->
                            <a href="https://wa.me/6285947517463" target="_blank" class="text-gray-700 fw-semibold fs-2">085947517463</a>
                            <!--end::Number-->
                        </div>
                        <!--end::Phone-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-sm-4 ps-lg-10">
                        <!--begin::Address-->
                        <div class="text-center bg-light card-rounded d-flex flex-column flex-center p-10 h-100">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-geolocation fs-3tx text-primary"></i>
                            <!--end::Icon-->
                            <!--begin::Subtitle-->
                            <h1 class="text-dark fw-bold my-5">Office</h1>
                            <!--end::Subtitle-->
                            <!--begin::Description-->
                            <a href="https://maps.app.goo.gl/5rREkLoJ2w6rpmZDA" target="_blank" class="text-gray-700 fs-3 fw-semibold">Perum Vila Bukit Tidar Blok A1-128, Malang</a>
                            <!--end::Description-->
                        </div>
                        <!--end::Address-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Card-->
                <div class="card mb-4 bg-light text-center">
                    <!--begin::Body-->
                    <div class="card-body py-12">
                        <!--begin::Icon-->
                        <a href="#" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="" loading="lazy">
                        </a>
                        <!--end::Icon-->
                        <!--begin::Icon-->
                        <a href="https://www.instagram.com/routind.academy_?igsh=MWNkbGhqcmptdXA4ZQ==" target="_blank" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="" loading="lazy">
                        </a>
                        <!--end::Icon-->
                        <!--begin::Icon-->
                        <a href="#" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/twitter.svg" class="h-30px my-2" alt="" loading="lazy">
                        </a>
                        <!--end::Icon-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Contact-->
    </div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showMessage("", "{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}", "Ok, got it!");
            </script>
        @endif
    @endforeach
    @if($errors->any())
        <script>
            common.showMessage("Error", "{!! implode('', $errors->all()) !!}", "error", "Ok, got it!");
        </script>
    @endif
@endsection