@extends('layouts.metronic')
@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Checkout')
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Content-->
        <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="fw-bold">Paket</h2>
                    </div>
                    <!--begin::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Selected customer-->
                    <div class="d-flex align-items-center p-3 mb-2">
                        <img alt="Pic" src="{{ url('disc/assets/media/paket/'.$type.'.png') }}" class="w-100px rounded me-4">
                        <!--begin::Info-->
                        <div class="d-flex flex-column">
                            <span class="fs-3 fw-bold text-gray-900 text-capitalize me-2">{{ $type }}</span>
                            <span class="fw-semibold text-gray-600 me-2">Rp{!! ($type=='premium') ? '75.000' : '25.000' !!}</span>
                            <span class="fw-semibold text-gray-800">Masa Aktif 6 Bulan</span>
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
                                <i class="ki-solid ki-shield-tick text-primary fs-2x"></i> Cek
                            </button>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Customer-->
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
                    @foreach($channels as $item)
                        <!--begin:Option-->
                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <img src="{{ $item->icon_url }}" class="w-75px me-5" alt="">
                                <!--end:Icon-->

                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bold fs-6">{{ $item->name }}</span>
                                    <span class="fs-7 text-muted">Biaya Rp @money($item->total_fee->flat)</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                            <!--begin:Input-->
                            <span class="form-check form-check-custom form-check-solid me-5">
                                <input class="form-check-input payment" type="radio" name="payment_method" value="{{ $item->code }}">
                            </span>
                            <!--end:Input-->
                        </label>
                        <!--end::Option-->
                        <div class="separator separator-dashed mb-5"></div>
                    @endforeach
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Payment method-->
        </div>
        <!--end::Content-->
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
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
                    <form id="checkout_form" redirect-url="{{ route('pelajar.invoice') }}" method="POST">
                        <!--begin::Section-->
                        <div class="mb-7">
                            <!--begin::Title-->
                            <h5 class="mb-3">Rincian Pembayaran</h5>
                            <!--end::Title-->

                            <!--begin::Details-->
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold text-gray-400 me-2 w-50">Sub Total</span>
                                <span class="fw-semibold text-gray-700 text-end w-50">Rp<span id="sub">{!! ($type=='premium') ? '75.000' : '25.000' !!}</span></span>
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
                                <span class="fw-semibold fs-4 text-gray-900 text-end w-50">Rp<span id="total">{!! ($type=='premium') ? '75.000' : '25.000' !!}</span></span>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Seperator-->
                        <div class="separator separator-dashed mb-7"></div>
                        <!--end::Seperator-->
                        <!--begin::Actions-->
                        <div class="mb-0">
                            <input type="hidden" name="paket" id="paket" value="{{ $type }}">
                            <input type="hidden" name="diskon_id" id="diskon_id">
                            <input type="hidden" name="code" id="code">
                            <button type="button" class="btn btn-primary" id="checkout_button">
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

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/checkout.js') }}"></script>
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