@extends('layouts.metronic')

@section('title')
    Daftar Gaji Bulan {{ Carbon\Carbon::parse(date($year.'-'.$period.'-01'))->isoFormat('MMMM YYYY') }}
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
                                <label class="form-label fs-6 fw-semibold">Bulan:</label>
                                <select name="period" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Pilih Bulan" data-allow-clear="true" data-hide-search="true">
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
                <a href="{{ route('pph21.gaji.create', ['period'=>$period, 'year'=>$year]) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menambahkan gaji pada bulan ini?')" class="btn btn-primary"><i class="ki-outline ki-bank fs-2"></i>Tambah Gaji</a>
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
        <table class="table align-middle table-row-dashed gy-5" id="tbl_gaji">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-25px">#</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Bulan</th>
                    <th>Bruto</th>
                    @if($year>=2024)
                    <th>TER</th>
                    @endif
                    <th>Terutang</th>
                    <th class="w-75px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php $no=1;?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->personalia->name }}</td>
                        <td>{{ $item->personalia->position }}</td>
                        <td>
                            {!! $item->status.' - '.((substr($item->ptkp_code, 0, 1)=='0') ? 'TK/' : ((substr($item->ptkp_code, 0, 1)=='1') ? 'K/' : 'T/I/')).substr($item->ptkp_code, -1) !!}
                        </td>
                        <td>{{ $item->period."-".$item->year }}</td>
                        <td>@money($item->bruto)</td>
                        @if($year>=2024)
                        <td>{!! ($item->ptkp < 63000000) ? 'A' : (($item->ptkp <72000000) ? 'B' : 'C') !!}</td>
                        @endif
                        <td>@money($item->terutang)</td>
                        <td>
                            <button type="button" class="btn btn-icon btn-active-light-primary w-25px h-25px editItem" data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Gaji">
                                <i class="fa fa-pencil text-success"></i>
                            </button>
                            @if($year>=2024)
                            <a href="{{ route('pph21.ter.cetak', ['id'=>$item->id]) }}" target="blank" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Bupot">
                                <i class="fa fa-print text-primary"></i>
                            </a>
                            @endif
                            <a href="{{ route('pph21.gaji.destroy', ['id'=>$item->id]) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus Pegawai Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Gaji">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                            @if($item->period==12)
                            <a href="{{ route('pph21.gaji.export', ['id'=>$item->id]) }}" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Gaji">
                                <i class="fa fa-file-excel text-success"></i>
                            </a>
                            @endif
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
                    <form id="itemForm" name="itemForm" class="form" method="POST" action="{{ route('pph21.gaji.store') }}">
                        @csrf

                        <h3>A. Penghasilan</h3>
                        <input type="hidden" name="id" id="item_id">
                        <span id="penghasilan">
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">1. Gaji/Pensiun atau THT/JHT</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="salary" id="salary" class="form-control form-control-sm uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">2. Tunjangan PPh</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="pph" id="pph" class="form-control form-control-sm uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">3. Tunjangan Lainnya, Uang Lembur, dan sebagainya</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="other" id="other" class="form-control form-control-sm uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">4. Honorarium dan Imbalan Lainnya Sejenisnya</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="honorarium" id="honorarium" class="form-control form-control-sm uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">5. Premi Asuransi yang dibayar Pemberi Kerja</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="premi" id="premi" class="form-control form-control-sm uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">6. Natura dan Kenikmatan Lainnya</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="natura" id="natura" class="form-control form-control-sm uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">7. Tantiem, Bonus, Gratifikasi, Jasa Produksi dan THR</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="thr" id="thr" class="form-control form-control-sm uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        </span>
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">8. Penghasilan Bruto</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="bruto" id="bruto" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <h3 class="mt-2">B. Pengurangan</h3>
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">9. Biaya Jabatan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="position" id="position" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">10. Iuran Pensiun atau Iuran THT/JHT</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="pension" id="pension" class="form-control form-control-sm uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <!--begin::Label-->
                            <label class="col-lg-8 col-form-label required fw-semibold fs-6">11. Zakat/Iuran Wajib Keagamaan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="zakat" id="zakat" class="form-control form-control-sm uang text-end" value="0"/>
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
    <script src="{{ url('disc/assets/js/custom/pph21/income.js') }}"></script>

    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection
