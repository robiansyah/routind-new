@extends('layouts.academy')
@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Checkout')
@section('content')
    @php
    $name = ''; $email= ''; $mobile='';
    if(auth()->user()){
        $name = auth()->user()->name;
        $email = auth()->user()->email;
        $mobile = auth()->user()->mobile_phone;
    }
    @endphp
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Content-->
        <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
            <!--begin::Customer-->
            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="fw-bold">Detail</h2>
                    </div>
                    <!--begin::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama Lengkap</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="mname" id="mname" class="form-control detail" placeholder="Nama Lengkap" value="{{ $name }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="email" name="memail" id="memail" class="form-control detail" placeholder="Email Aktif" value="{{ $email }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">No HP</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="number" name="mmobile" id="mmobile" class="form-control detail" placeholder="No HP" value="{{ $mobile }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Lembaga / Instansi / Universitas</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="minstitution" id="minstitution" class="form-control detail" placeholder="Lembaga / Instansi / Universitas">
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Customer-->
            <!--begin::Paket-->
            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="fw-bold">Event Detail</h2>
                    </div>
                    <!--begin::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Selected customer-->
                    <div class="d-flex align-items-center p-3 mb-2">
                        <img alt="Pic" src="{{ url('img/'.$event->image) }}" class="w-125px rounded me-4">
                        <!--begin::Info-->
                        <div class="d-flex flex-column">
                            <span class="fs-3 fw-bold text-gray-900 text-capitalize me-2">{{ $event->title }}</span>
                            <span class="fw-semibold text-gray-600 me-2"><span>Rp</span>@money($event->price)</span>
                            <span class="fw-semibold text-gray-600">
                                {{ $event->location.' on '.Carbon\Carbon::parse($event->start_date)->format('j M Y, g:i') }} - {!!(Carbon\Carbon::parse($event->start_date)->format('j M Y')==Carbon\Carbon::parse($event->end_date)->format('j M Y')) ? Carbon\Carbon::parse($event->end_date)->format('g:i') : Carbon\Carbon::parse($event->end_date)->format('j M Y, g:i') !!}<br>
                            </span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Selected customer-->
                    <div class="d-flex flex-column mb-10 w-75">
                        <!--begin::Label-->
                        <div class="fs-5 fw-bold form-label mb-3">Kode Promo (Apabila ada)</div>
                        <!--end::Label-->
                        <div class="input-group w-auto">
                            <input type="text" name="diskon" id="diskon" class="form-control text-uppercase" placeholder="Kode Promo"/>
                            <button type="button" class="input-group-text" id="cek_diskon">
                                <i class="ki-solid ki-shield-tick text-primary fs-2x"></i> Gunakan
                            </button>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Paket-->
            @if($event->price > 0)
            <!--begin::Payment method-->
            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="fw-bold">Metode Pembayaran</h2>
                    </div>
                    <!--begin::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin:Option-->
                    <label class="d-flex flex-stack mb-5 cursor-pointer">
                        <!--begin:Label-->
                        <span class="d-flex align-items-center me-2">
                            <!--begin:Icon-->
                            <img src="" class="w-75px me-5" alt="">
                            <!--end:Icon-->

                            <!--begin:Info-->
                            <span class="d-flex flex-column">
                                <span class="fw-bold fs-6">BNI Virtual Account</span>
                                <span class="fs-7 text-muted">Biaya Rp 5.000</span>
                            </span>
                            <!--end:Info-->
                        </span>
                        <!--end:Label-->
                        <!--begin:Input-->
                        <span class="form-check form-check-custom form-check-solid me-5">
                            <input class="form-check-input payment" type="radio" name="payment_method" value="BNI">
                        </span>
                        <!--end:Input-->
                    </label>
                    <!--end::Option-->
                    <div class="separator separator-dashed mb-5"></div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Payment method-->
            @endif
        </div>
        <!--end::Content-->
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-lg-350px w-xl-400px mb-10 order-2 order-lg-2">
            <!--begin::Card-->
            <div class="card card-flush pt-3 mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95" style="">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Ringkasan</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 fs-6">
                    <form id="checkout_form" action="{{ route('coXendit') }}" method="POST">
                        @csrf
                        <!--begin::Section-->
                        <div class="mb-7">
                            <!--begin::Title-->
                            <h5 class="mb-3">Rincian Pembayaran</h5>
                            <!--end::Title-->

                            <!--begin::Details-->
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold text-gray-400 me-2 w-50">Sub Total</span>
                                <span class="fw-semibold text-gray-700 text-end w-50">Rp<span id="sub">@money($event->price)</span></span>
                            </div>
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold text-gray-400 me-2 w-50">Diskon</span>
                                <span class="fw-semibold text-gray-700 text-end w-50">Rp<span id="diskon_nominal">0</span></span>
                            </div>
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold text-gray-400 me-2 w-50">Biaya Admin</span>
                                <span class="fw-semibold text-gray-700 text-end w-50">Rp<span id="biaya_admin">0</span></span>
                            </div>
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold fs-4 text-gray-900 me-2 w-50">Total</span>
                                <span class="fw-semibold fs-4 text-gray-900 text-end w-50">Rp<span id="total">@money($event->price)</span></span>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Seperator-->
                        <div class="separator separator-dashed mb-7"></div>
                        <!--end::Seperator-->
                        <!--begin::Actions-->
                        <div class="mb-0">
                            <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="name" id="name" value="{{ $name }}" required>
                            <input type="hidden" name="email" id="email" value="{{ $email }}" required>
                            <input type="hidden" name="mobile" id="mobile" value="{{ $mobile }}" required>
                            <input type="hidden" name="institution" id="institution" required>
                            <input type="hidden" name="diskon_id" id="diskon_id">
                            <input type="hidden" name="code" id="code">
                            <button type="submit" class="btn btn-primary" id="checkout_button">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Lanjut Pembayaran</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Sidebar-->
    </div>
@endsection
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
{{--    <script src="{{ url('disc/assets/js/custom/academycheckout-new.js') }}"></script>--}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection