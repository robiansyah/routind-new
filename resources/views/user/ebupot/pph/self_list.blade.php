@extends('layouts.metronic')

@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('title', 'PPh yang Disetor Sendiri')
@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <span class="fw-bold text-dark fs-2">Daftar Bukti Potong Disetor Sendiri</span>
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <!--begin::Filter-->
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Content-->
                    <div class="px-7 py-5">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Masa:</label>
                            <select name="period" id="period" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Pilih Masa" data-allow-clear="true" data-hide-search="true">
                                @for($i = 1; $i<= 12; $i++)
                                <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {!! (date('m')==str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected' : '' !!}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Tahun:</label>
                            <select name="year" id="year" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Pilih Tahun" data-allow-clear="true" data-hide-search="true">
                                @for($i = date('Y'); $i > date('Y')-3; $i--)
                                <option value="{{ $i }}" {!! (date('Y')==$i) ? 'selected' : '' !!}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true">Batal</button>
                            <button type="button" id="btn-cari" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true">Apply</button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
                <!--begin::Add user-->
                <a href="{{ route('ebupot.pph', ['type'=>'input-disetor-sendiri']) }}" class="btn btn-primary"><i class="ki-outline ki-plus fs-2"></i>Tambah</a>
                <!--end::Add user-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed gy-5" id="tbl_dftr_pphss">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th>Periode</th>
                    <th>Kode Objek Pajak</th>
                    <th>Nomor Bukti Setor</th>
                    <th>Jumlah Penghasilan Bruto (Rp)</th>
                    <th>PPh Disetor (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection

@section('js')

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pages/dftr_pphss.js') }}" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection