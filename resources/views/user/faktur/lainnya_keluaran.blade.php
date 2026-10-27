@extends('layouts.metronic')
@section('title')
    Dokumen Ekspor {!! ($period!='all') ? 'Bulan '.Carbon\Carbon::parse(date($year.'-'.$period.'-01'))->isoFormat('MMMM YYYY') : 'Semua Bulan Tahun '.$year !!}
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
            <div class="d-flex align-items-center position-relative my-1">
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
                                <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {!! ($period==str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected' : '' !!}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
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
                <button type="button"  name="tambahItem" id="tambahItem" class="btn btn-primary"><i class="ki-outline ki-plus fs-2"></i>Tambah Dokumen Ekspor</button>
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
        <table class="table align-middle table-row-dashed gy-5" id="tbl_pajak">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-25px">#</th>
                    <th>No Dok</th>
                    <th>Pelanggan</th>
                    <th>DPP</th>
                    <th>PPN</th>
                    <th class="w-75px">Masa</th>
                    <th class="w-50px">Jenis Dok</th>
                    <th class="w-50px">Status Approval</th>
                    <th class="w-75px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php $no=1;?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->other_no }}</td>
                        <td>{{ $item->transaction_name }}</td>
                        <td>@money($item->dpp)</td>
                        <td>@money($item->ppn)</td>
                        <td>{{ $item->other_period.'/'.$item->other_year }}</td>
                        <td><span class="badge badge-{!! ($item->status=='Normal') ? 'primary' : 'danger' !!}">{{ $item->status }}</span></td>
                        <td><span class="badge badge-{!! ($item->approval=='Approved') ? 'primary' : 'warning' !!}">{{ $item->approval }}</span></td>
                        <td>
                            @if($item->approval=='Draft')
                            <button type="button" class="btn btn-icon btn-active-light-primary w-25px h-25px editItem" data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Dokumen Ekspor">
                                <i class="fa fa-pencil text-success"></i>
                            </button>
                            <a href="{{ route('faktur.other.status', ['id'=>$item->id, 'type'=>'keluaran', 'status'=>'approval']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Mengupload Dokumen Ekspor Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Dokumen Ekspor">
                                <i class="fa fa-check-circle text-warning"></i>
                            </a>
                            <a href="{{ route('faktur.other.destroy', ['id'=>$item->id, 'type'=>'keluaran']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus Dokumen Ekspor Pajak Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Dokumen Ekspor">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                            @elseif($item->approval=='Approved')
                                @if($item->status=='Normal')
                                <a href="{{ route('faktur.other.status', ['id'=>$item->id, 'type'=>'keluaran', 'status'=>'cancel']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Mengbatalkan Dokumen Ekspor Ini?', 'captchaModal')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan Dokumen Ekspor">
                                    <i class="fa fa-ban text-danger"></i>
                                </a>
                                @endif
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
                    <form id="itemForm" name="itemForm" class="form" method="POST" action="{{ route('faktur.other.store', ['type'=>'keluaran']) }}">
                        @csrf
                        
                        <input type="hidden" name="id" id="item_id">
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Detail Transaksi</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <select name="transaction_detail" id="transaction_detail" data-kt-select2="true" data-placeholder="Pilih Detail Transaksi" class="form-select form-select-md" data-dropdown-parent="#itemForm">
                                    <option value="">Pilih Detail Transaksi</option>
                                    <option value="Ekspor BKP Berwujud">1. Ekspor BKP Berwujud</option>
                                    <option value="Ekspor BKP Tidak Berwujud">2. Ekspor BKP Tidak Berwujud</option>
                                    <option value="Ekspor JKP">3. Ekspor JKP</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Dokumen Transaksi</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <select name="transaction_doc" id="transaction_doc" data-kt-select2="true" data-placeholder="Pilih Dokumen Transaksi" class="form-select form-select-md" data-dropdown-parent="#itemForm">
                                    <option value="">Pilih Dokumen Transaksi</option>
                                    <option value="Dokumen Ekspor (PEB)">1. Dokumen Ekspor (PEB)</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Lawan Transaksi</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="transaction_name" id="transaction_name" class="form-control"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">No Dokumen</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="other_no" id="other_no" class="form-control"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tanggal Dokumen</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="date" name="other_date" id="other_date" class="form-control"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Masa / Tahun Pajak</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row">
                                <select name="other_period" id="other_period" aria-label="Pilih Masa Pajak" data-placeholder="Pilih Masa Pajak" class="form-control form-select form-select-md">
                                    <option value="">Pilih Masa Pajak</option>
                                    @for($i = 1; $i<= 12; $i++)
                                        <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-5 fv-row">
                                <select name="other_year" id="other_year" aria-label="Pilih Tahun Pajak" data-placeholder="Pilih Tahun Pajak" class="form-control form-select form-select-md">
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
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">DPP</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="dpp" id="dpp" class="form-control uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">PPN</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="ppn" id="ppn" class="form-control uang text-end" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">PPnBM</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="ppnbm" id="ppnbm" class="form-control uang text-end" value="0"/>
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

    <div class="modal fade" id="captchaModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form method="POST" id="myForm">
                    @csrf
    
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Batalkan Faktur Pajak</h2>
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
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Kode Keamanan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row captcha" id="reload">
                                <span>{!! captcha_img() !!}</span>
                                <p style="margin: 0 4px; font-size: 12px;">klik untuk ubah kode</p>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Isikan Kode Keamanan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <input class="form-control captchaModal" type="text" name="captcha" maxlength="4" placeholder="" required/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Modal footer-->
                </form>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/faktur/lainnya_keluaran.js') }}"></script>
    <script>
        $("#tbl_pajak").DataTable();
    </script>

    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection
