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
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-lg-17">
                        <!--begin::Row-->
                        <div class="row mb-3">
                            <!--begin::Col-->
                            <div class="col-md-12 pe-lg-10">
                                <!--begin::Form-->
                                <form action="{{ route('order.check') }}" class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="post">
                                    @csrf

                                    <h1 class="fw-bold text-dark mb-9">Cek Pendaftaran</h1>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Invoice / Kode</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-9 fv-row">
                                            <input type="text" name="code" id="code" class="form-control detail" placeholder="Invoice / Kode" required>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary"> Cek </button>
                                    <!--end::Submit-->
                                </form>
                                <!--end::Form-->
                                @if($data=='check')
                                    <h1 class="fw-bold text-dark mb-9">Detail Pendaftaran</h1>
                                    @if($order)
                                        <table class="table table-row-dashed fs-6 gy-3">
                                            <tr>
                                                <td class="w-75px">Nama</td>
                                                <td class="w-10px">:</td>
                                                <td>{{ $order->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Course</td>
                                                <td>:</td>
                                                <td>{{ $order->batch->event->title." - ".$order->batch->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Invoice</td>
                                                <td>:</td>
                                                <td>{{ $order->invoice_code }}</td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td>:</td>
                                                <td>Rp<span>@money($order->amount)</span></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td>{{ $order->status }}</td>
                                            </tr>
                                        </table>
                                    @else
                                        Pendaftaran Tidak Ditemukan.
                                    @endif
                                @endif
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
            </div>
            <!--end::Courses-->
        </div>
    </div>
@endsection