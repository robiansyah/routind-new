@extends('layouts.academy')
@section('title', 'Sertifikat')
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
                        <span>Sertifikat</span>
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
                    <li class="breadcrumb-item text-gray-700">Sertifikat</li>
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
            <!--begin::Events-->
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-lg-17">
                        <!--begin::Row-->
                        <div class="row mb-3">
                            <!--begin::Col-->
                            <div class="col-md-12 pe-lg-10">
                                <h1 class="fw-bold text-dark mb-9">Detail Sertifikat</h1>
                                @if($data)
                                    <table class="table table-row-dashed fs-6 gy-3">
                                        <tr>
                                            <td class="w-75px">No</td>
                                            <td class="w-10px">:</td>
                                            <td>
                                                <?php
                                                    $year = substr($data->date,0, 4);
                                                    $month = substr($data->date, 5, 2);
                                                ?>
                                                @if($year < 2025)
                                                    {{ $data->code }}
                                                @else
                                                    {{ str_pad($data->no,5,"0",STR_PAD_LEFT)."/RTND/".$month."/".$year }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-75px">Nama</td>
                                            <td class="w-10px">:</td>
                                            <td>{!! ($data->user_id != '') ? $data->user->name : $data->username !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Materi/Modul</td>
                                            <td>:</td>
                                            <td>{{ $data->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td>{{ Carbon\Carbon::parse($data->date)->isoFormat('DD MMMM Y') }}</td>
                                        </tr>
                                    </table>
{{--                                    <a href="{{ route('order.index') }}" class="btn btn-primary">Kembali</a>--}}
                                @else
                                    Sertifikat Tidak Ditemukan, <a href="{{ route('academy') }}">Kembali</a>
                                @endif
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
            </div>
            <!--end::Events-->
        </div>
    </div>
@endsection