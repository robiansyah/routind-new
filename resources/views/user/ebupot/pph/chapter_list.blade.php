@extends('layouts.metronic')

@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('title')
    Bulan {{ Carbon\Carbon::parse(date($year.'-'.$period.'-01'))->isoFormat('MMMM YYYY') }}
@endsection
@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <span class="fw-bold text-dark fs-2">Daftar Bukti Potong PPh Unifikasi Bulan {{ Carbon\Carbon::parse(date($year.'-'.$period.'-01'))->isoFormat('MMMM YYYY') }}</span>
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
                        <form method="GET" action="">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Masa:</label>
                            <select name="period" id="period" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Pilih Masa" data-allow-clear="true" data-hide-search="true">
                                @for($i = 1; $i<= 12; $i++)
                                <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {!! ($period==str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected' : '' !!}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
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
                                <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true">Apply</button>
                            </div>
                        </form>
                        <!--end::Actions-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
                <!--begin::Add user-->
                <a href="{{ route('ebupot.pph', ['type'=>'input-ps42152223']) }}" class="btn btn-primary"><i class="ki-outline ki-plus fs-2"></i>Tambah</a>
                <!--end::Add user-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4 table-responsive">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-7 gy-5" id="tbl_dftr_ps42152223">
            <thead>
                <tr class="text-start text-muted fw-bold fs-8 text-uppercase gs-0">
                    <th>Periode</th>
                    <th>Kode Objek Pajak</th>
                    <th>Nomor Bukti Pemotongan</th>
                    <th>Identitas</th>
                    <th>Nama</th>
                    <th>Jumlah Penghasilan Bruto (Rp)</th>
                    <th>Jumlah PPh Terutang (Rp)</th>
                    <th>Status</th>
                    <th class="w-125px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->periode }}</td>
                        <td>{{ $item->kdObjPjk }}</td>
                        <td>{{ $item->noBupot }}</td>
                        <td>{{ $item->idDipotong }}</td>
                        <td>{{ $item->nmDipotong }}</td>
                        <td>@money($item->jmlBruto)</td>
                        <td>@money($item->jmlPphDipotong)</td>
                        <td class="text-center">
                            @if($item->fgPosting === "1")
                                <span class="badge badge-success">Sudah Posting</span>
                            @else
                                <span class="badge badge-warning">Belum Posting</span>
                            @endif
                            <br><span class="badge badge-secondary">{!! ($item->revNo > 0) ? 'Rev-'.$item->revNo : 'Normal' !!}</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-icon btn-primary w-20px h-20px m-1 view-btn" data-id="{{ $item->idBupot }}" data-bs-toggle="tooltip" data-bs-placement="top" title="lihat">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-success w-20px h-20px m-1 edit-btn" data-id="{{ $item->idBupot }}" data-no="{{ $item->revNo }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-danger w-20px h-20px m-1 delete-btn" data-id="{{ $item->idBupot }}" data-no="{{ $item->revNo }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-warning w-20px h-20px m-1 send-btn" data-id="{{ $item->idBupot }}" data-nama="{{ $item->nmDipotong }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Email">
                                <i class="fa fa-envelope"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection
@section('modal')
<div class="modal fade" id="modal_cetak" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="modal-title">Bukti Potong</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body">
                <div id="isi_cetak"></div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pages/dftr_ps42152223_new.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection