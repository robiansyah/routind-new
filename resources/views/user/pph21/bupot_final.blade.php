@extends('layouts.metronic')

@section('title')
    Bukti Potong Final Bulan {{ Carbon\Carbon::parse(date($year.'-'.$period.'-01'))->isoFormat('MMMM YYYY') }}
@endsection
@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1 me-3">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Cari" />
            </div>
            <!--end::Search-->
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
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Masa:</label>
                            <select name="period" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Pilih Masa" data-allow-clear="true" data-hide-search="true">
                                <option value="all">Pilih Semua</option>
                                @for($i = 1; $i<= 12; $i++)
                                <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {!! ($period==str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected' : '' !!}>{{ str_pad($i, 2, "0", STR_PAD_LEFT).' - '.Carbon\Carbon::parse(date('Y-'.str_pad($i, 2, "0", STR_PAD_LEFT).'-01'))->isoFormat('MMMM') }}</option>
                                @endfor
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Tahun:</label>
                            <select name="year" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Pilih Tahun" data-allow-clear="true" data-hide-search="true">
                                <option value="all">Pilih Semua</option>
                                @for($i = date('Y'); $i > date('Y')-3; $i--)
                                <option value="{{ $i }}" {!! ($year==$i) ? 'selected' : '' !!}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true">Batal</button>
                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true">Apply</button>
                        </div>
                        <!--end::Actions-->
                        </form>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
                <!--begin::Add user-->
                <button type="button"  name="tambahItem" id="tambahItem" class="btn btn-primary"><i class="ki-outline ki-plus fs-2"></i>Tambah</button>
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
        <table class="table align-middle table-row-dashed gy-5" id="tbl_final">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-25px">#</th>
                    <th>Nama</th>
                    <th>No Bupot</th>
                    <th>Kode Objek Pajak</th>
                    <th>Penghasilan</th>
                    <th>PPh</th>
                    <th class="w-75px">Masa</th>
                    <th class="w-75px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php $no=1;?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->no }}</td>
                        <td>{{ $item->object_code }}</td>
                        <td>@money($item->bruto)</td>
                        <td>@money($item->pph)</td>
                        <td>{{ $item->period.'/'.$item->year }}</td>
                        <td>
                            <a href="{{ route('pph21.final.cetak', ['id'=>$item->id]) }}" target="blank" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Bupot">
                                <i class="fa fa-print text-primary"></i>
                            </a>
                            <button type="button" class="btn btn-icon btn-active-light-primary w-25px h-25px editItem" data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bupot">
                                <i class="fa fa-pencil text-success"></i>
                            </button>
                            <a href="{{ route('pph21.bupot.destroy', ['id'=>$item->id, 'type'=>'tidak_final']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus Bupot Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Bupot">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
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

    <div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="modal-title" id="itemHeading"></h2>
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
                    <form id="itemForm" name="itemForm" class="form" method="POST" action="{{ route('pph21.bupot.store', ['type'=>'final']) }}">
                        @csrf
                        
                        <input type="hidden" name="id" id="item_id">
                        <input type="hidden" name="no" id="item_no">
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Masa / Tahun Pajak</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <select name="period" id="period" aria-label="Pilih Masa Pajak" data-placeholder="Pilih Masa Pajak" class="form-control form-select form-select-md">
                                    <option value="">Pilih Masa Pajak</option>
                                    @for($i = 1; $i<= 12; $i++)
                                        <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT).' - '.Carbon\Carbon::parse(date('Y-'.str_pad($i, 2, "0", STR_PAD_LEFT).'-01'))->isoFormat('MMMM') }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-5 fv-row">
                                <select name="year" id="year" aria-label="Pilih Tahun Pajak" data-placeholder="Pilih Tahun Pajak" class="form-control form-select form-select-md">
                                    <option value="">Pilih Tahun Pajak</option>
                                    @for($i = date('Y'); $i > date('Y')-3; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row" id="dengan_npwp">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">NPWP</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" class="form-control hitung" name="npwp" id="npwp" placeholder="NPWP">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row" id="tanpa_npwp">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">NIK/No. Paspor</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" class="form-control hitung" name="nik" id="nik" placeholder="NIK/No. Paspor">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <div class="col-lg-3 fv-row"></div>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <div class="form-check form-check-sm mt-2 mb-2">
                                    <input class="form-check-input" type="checkbox" id="not" />
                                    <label class="form-check-label fw-semibold fs-6">
                                        Klik jika lawan transaksi tidak memiliki NPWP
                                    </label>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap" required>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Alamat</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <textarea name="address" id="address" class="form-control"></textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <div class="col-lg-3 fv-row">
                                <div class="form-check form-check-sm mt-5">
                                    <input class="form-check-input" type="checkbox" id="asing" />
                                    <label class="form-check-label fw-semibold fs-6">
                                        WP Asing
                                    </label>
                                </div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row" id="country_list">
                                <select name="country_code" id="country_code" data-kt-select2="true" data-placeholder="Pilih Negara" class="form-select form-select-md" data-dropdown-parent="#itemForm">
                                    <option value="">Pilih Negara</option>
                                    @foreach ($countries as $item)
                                        <option value="{{ $item->code }}">{{ $item->name.'['.$item->code.']' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Kode Objek Pajak</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <select name="object_code" id="object_code" data-kt-select2="true" data-placeholder="Pilih Kode Objek Pajak" class="form-select form-select-md" data-dropdown-parent="#itemForm">
                                    <option value="">Pilih Kode Objek Pajak</option>
                                    @foreach ($objects as $item)
                                        <option value="{{ $item->kdObjPjk }}">{{ $item->kdObjPjk.' - '.$item->nmObjkPjk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Penghasilan Bruto</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <input type="text" name="bruto" id="bruto" class="form-control text-end uang" value="0">
                            </div>
                            <!--end::Col-->
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6 text-end">DPP</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <input type="text" name="dpp" id="dpp" class="form-control text-end uang hitung" value="0">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tarif (%)</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <input type="text" name="tarif" id="tarif" class="form-control text-end hitung" value="0" size="3">
                            </div>
                            <!--end::Col-->
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6 text-end">PPh Dipotong</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <input type="text" name="pph" id="pph" class="form-control form-control-solid text-end uang" value="" readonly>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tanggal Pembuatan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </form>
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="itemBtn" value="create">Simpan</button>
                </div>
                <!--end::Modal footer-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pph21/final-edit.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
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
