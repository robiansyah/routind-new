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
                        <span>Certificate</span>
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
                    <li class="breadcrumb-item text-gray-700">Certificate</li>
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
                                <form action="{{ route('certificate.check') }}" class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="post">
                                    @csrf

                                    <h1 class="fw-bold text-dark mb-9">Cek Sertifikat Kamu</h1>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Email</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="email" name="email" class="form-control detail" placeholder="Masukan Email" required>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Kode Keamanan</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <div class="fv-row mb-3">
                                                <div class="mt-5 d-flex align-items-start">
                                                    <div class="captcha me-4" id="reload">
                                                        <span>{!! captcha_img() !!}</span>
                                                        <p class="m-0 fs-8">klik untuk ubah kode</p>
                                                    </div>
                                                    <input type="text" placeholder="Masukan Kode Keamanan" name="captcha" id="captcha" maxlength="4" autocomplete="off" class="form-control bg-transparent" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary"> Cek </button>
                                    <!--end::Submit-->
                                </form>
                                <!--end::Form-->
                                @if($data=='check')
                                    <h1 class="fw-bold text-dark mb-9">Daftar Sertifikat Kamu</h1>
                                    @if(count($certificates))
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-row-dashed fs-6 gy-4">
                                                <tr>
                                                    <th class="w-250px">No Sertifikat</th>
                                                    <th>Kegiatan</th>
                                                    <th class="w-100px text-center">Aksi</th>
                                                </tr>
                                                @foreach($certificates as $item)
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            $year = substr($item->date,0, 4);
                                                            $month = substr($item->date, 5, 2);
                                                            ?>
                                                            @if($year < 2025)
                                                                {{ $item->code }}
                                                            @else
                                                                {{ str_pad($item->no,5,"0",STR_PAD_LEFT)."/RTND/".$month."/".$year }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td class="text-center">
                                                            @if($item->participant_no=='')
                                                                <a href="{{ route('print.certificate', ['code'=>$item->code]) }}" class="btn btn-icon btn-active-light-primary w-30px h-30px" target="_blank"><i class="fa fa-print text-primary"></i></a>
                                                            @else
                                                                <a href="{{ route('brevet.certificate', ['code'=>$item->code]) }}" class="btn btn-icon btn-active-light-primary w-30px h-30px" target="_blank"><i class="fa fa-print text-primary"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @else
                                        Sertifikat Tidak Ditemukan.
                                    @endif
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
@section('js')
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
    @if($errors->any())
        <script>
            common.showMessage("Error", "{!! implode('', $errors->all('<div>:message</div>')) !!}", "error");
        </script>
    @endif
@endsection