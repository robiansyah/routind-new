@extends('layouts.academy')
@section('title', 'Course')
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
                        <span>Courses</span>
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
                    <li class="breadcrumb-item text-gray-700">Courses</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">Order</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
            <!--begin::Courses-->
            <div class="col-xl-8 mb-5 mb-xl-10">
                <div class="card card-flush pt-3 mb-0">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Detail Transaksi</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 fs-6">
                        <!--begin::Section-->
                        <div class="mb-3">
                            <!--begin::Details-->
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold text-gray-600 w-50">Order ID</span>
                                <span class="fw-semibold text-gray-600 w-50">Status Pembayaran</span>
                            </div>
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold text-gray-800 w-50">{{ $order->invoice_code }}</span>
                                <span class="fw-semibold text-gray-800 w-50">
                                    @if($order->status=='UNPAID')
                                        <div class="badge badge-light-primary fs-6 fw-bold my-2">Menunggu Pembayaran</div> <a href="{{ $order->invoice_url }}" class="btn btn-sm btn-primary">Bayar</a>
                                    @elseif($order->status=='PAID')
                                        <div class="badge badge-light-success fs-6 fw-bold my-2">Pembayaran Berhasil</div>
                                    @else
                                        <div class="badge badge-light-danger fs-6 fw-bold my-2">Pembayaran Batal</div>
                                    @endif
                                </span>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Seperator-->
                        <div class="separator separator-dashed mb-5"></div>
                        <!--end::Seperator-->
                        <!--begin::Section-->
                        <div class="mb-3">
                            <!--begin::Details-->
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold text-gray-600 w-50">Batas Pembayaran</span>
                                <span class="fw-semibold text-gray-600 w-50">Kode Promo</span>
                            </div>
                            <div class="d-flex flex-row mb-2">
                                <span class="fw-semibold text-gray-800 w-50" data-countdown="{!! ($order->status=='UNPAID') ? date("Y-m-d H:i:s", strtotime($order->created_at . "+1 hour")) : '' !!}"></span>
                                <span class="fw-semibold text-gray-800 w-50">{{ $order->discount_code }}</span>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Seperator-->
                        <div class="separator separator-dashed mb-3"></div>
                        <!--end::Seperator-->
                        <!--begin::Details-->
                        <div class="d-flex flex-row mb-2">
                            <span class="fw-semibold text-gray-400 me-2 w-50 text-capitalize">{{ $order->batch->event->title." - ".$order->batch->name }}</span>
                            <span class="fw-semibold text-gray-700 text-end w-50">Rp<span>@money($order->batch->price)</span></span>
                        </div>
                        <div class="d-flex flex-row mb-2">
                            <span class="fw-semibold text-gray-400 me-2 w-50">Diskon</span>
                            <span class="fw-semibold text-gray-700 text-end w-50">Rp<span>@money($order->discount_amount)</span></span>
                        </div>
                        <div class="d-flex flex-row mb-2">
                            <span class="fw-semibold text-gray-400 me-2 w-50">Biaya Transaksi</span>
                            <span class="fw-semibold text-gray-700 text-end w-50">Rp<span>@money($order->amount-$order->nett)</span></span>
                        </div>
                        <div class="d-flex flex-row mb-2">
                            <span class="fw-semibold fs-4 text-gray-900 me-2 w-50">Total</span>
                            <span class="fw-semibold fs-4 text-gray-900 text-end w-50">Rp<span>@money($order->amount)</span></span>
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <!--end::Courses-->
        </div>
    </div>
@endsection
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%H:%M:%S'));
            });
        });
    </script>
@endsection