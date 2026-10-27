@extends('layouts.metronic')
@section('title')
    Faktur Pajak Keluaran {!! ($period!='all') ? 'Bulan '.Carbon\Carbon::parse(date($year.'-'.$period.'-01'))->isoFormat('MMMM YYYY') : 'Semua Bulan Tahun '.$year !!}
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"><i class="ki-outline ki-plus fs-2"></i>Tambah Faktur Keluaran</button>
{{--                <a href="{{ route('faktur.pajak.tambah') }}" onclick="confirmation(event, 'Apakah Anda Akan Membuat Faktur Pajak Keluaran Baru?')" class="btn btn-primary"><i class="ki-outline ki-plus fs-2"></i>Tambah Faktur Keluaran</a>--}}
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
                    <th>Kode & No Faktur</th>
                    <th>Pelanggan</th>
                    <th>DPP</th>
                    <th>PPN</th>
                    <th class="w-75px">Masa</th>
                    <th class="w-50px">Status</th>
                    <th class="w-75px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php $no=1;?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->transaction_code.".".$item->invoice_no }}</td>
                        <td>{{ $item->customer_name }}</td>
                        <td>{!! ($item->payment=='lunas') ? number_format($item->dpp, 0, ',', '.') : number_format($item->dpp_split, 0, ',', '.') !!}</td>
                        <td>{!! ($item->payment=='lunas') ? number_format($item->ppn, 0, ',', '.') : number_format($item->ppn_split, 0, ',', '.') !!}</td>
                        <td>{{ $item->invoice_period.'/'.$item->invoice_year }}</td>
                        <td><span class="badge badge-{!! ($item->approval=='Approved') ? 'primary' : (($item->approval=='Deleted') ? 'danger' : (($item->approval=='Created') ? 'success' : (($item->approval=='Amanded') ? 'dark' : 'warning'))) !!}">{{ $item->approval }}</span></td>
                        <td>
                            <a href="{{ route('faktur.pajak.cetak', ['id'=>$item->id]) }}" target="blank" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Faktur">
                                <i class="fa fa-print text-primary"></i>
                            </a>
                            @if($item->approval=='Draft' || $item->approval=='Created')
                                <a href="{{ route('faktur.pajak.edit', ['id'=>$item->id, 'type'=>'keluaran']) }}" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Faktur">
                                    <i class="fa fa-pencil text-success"></i>
                                </a>
                                <a href="{{ route('faktur.pajak.status', ['id'=>$item->id, 'type'=>'keluaran', 'status'=>'approval']) }}" onclick="confirmation2(event, 'Apakah Anda Yakin Akan Mengupload Faktur Pajak Ini?', 'captchaModal2')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Faktur">
                                    <i class="fa fa-check-circle text-warning"></i>
                                </a>
                                @if($item->status=='Normal')
                                <a href="{{ route('faktur.pajak.destroy', ['id'=>$item->id, 'type'=>'keluaran']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus Faktur Pajak Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Faktur">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                                @endif
                            @elseif($item->approval=='Approved')
                                @if($item->status=='Normal' || $item->status=='Normal - Pengganti')
                                <a href="{{ route('faktur.pajak.pengganti', ['id'=>$item->id, 'type'=>'keluaran']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Mengganti Faktur Pajak Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Faktur Pengganti">
                                    <i class="fa fa-edit text-success"></i>
                                </a>
                                <a href="{{ route('faktur.pajak.status', ['id'=>$item->id, 'type'=>'keluaran', 'status'=>'cancel']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Mengbatalkan Faktur Pajak Ini?', 'captchaModal')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan Faktur">
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
    <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="modal-title">Tambah Faktur Keluaran</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <form id="itemForm" name="itemForm" class="form" method="POST" action="{{ route('faktur.pajak.tambah') }}">
                @csrf
                <!--begin::Modal body-->
                <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal Faktur</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="invoice_date" id="invoice_date" class="form-control"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tahun Pajak</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <select name="invoice_year" id="invoice_year" aria-label="Pilih Tahun Pajak" data-placeholder="Pilih Tahun Pajak" class="form-control form-select form-select-md">
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
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Masa Pajak</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <select name="invoice_period" id="invoice_period" aria-label="Pilih Masa Pajak" data-placeholder="Pilih Masa Pajak" class="form-control form-select form-select-md">
                                    <option value="">Pilih Masa Pajak</option>
                                    @for($i = 1; $i<= 12; $i++)
                                        <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
                </div>
                <!--end::Modal footer-->
                </form>
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
                        <h2 class="modal-title">Tanda Tangan Dokumen</h2>
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
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Jenis Tanda Tangan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <input class="form-control form-control-solid" type="text" value="Tanda Tangan Wajib Pajak" readonly/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Kode Otorisasi</label>
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
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Isikan Kode Otorisasi</label>
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

    <div class="modal fade" id="captchaModal2" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form method="POST" id="myForm2">
                    @csrf

                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Tanda Tangan Dokumen</h2>
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
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Jenis Tanda Tangan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <input class="form-control form-control-solid" type="text" value="Tanda Tangan Wajib Pajak" readonly/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Kode Otorisasi</label>
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
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Isikan Kode Otorisasi</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <input class="form-control captchaModal2" type="text" name="captcha" maxlength="4" placeholder="" required/>
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

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/faktur/pajak_keluaran.js') }}"></script>
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
    @if($errors->any())
        <script>
            common.showNotif("{!! implode('', $errors->all('<div>:message</div>')) !!}", "error");
        </script>
    @endif
@endsection
