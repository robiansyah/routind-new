@extends('layouts.metronic')

@section('title', 'Daftar SPT Tahun '.$year)
@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"><i class="ki-outline ki-plus fs-2"></i>Tambah SPT</button>
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
        <table class="table align-middle table-row-dashed gy-5" id="tbl_spt">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-25px">#</th>
                    <th>Masa Pajak</th>
                    <th>Pembetulan Ke</th>
                    <th>Proses</th>
                    <th>Status</th>
                    <th class="w-150px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php $no=1;?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->start_period.'-'.$item->year }}</td>
                        <td>{{ $item->correction_to }}</td>
                        <td><span class="badge badge-{!! ($item->send_flag=='2') ? 'primary' : 'warning' !!}">{!! ($item->send_flag=='2') ? 'Lapor' : 'Posting' !!}</span></td>
                        <td><span class="badge badge-{!! ($item->send_flag=='2') ? 'primary' : 'warning' !!}">{!! ($item->send_flag=='2') ? 'Sukses Lapor' : 'Sukses Posting' !!}</span></td>
                        <td>
                            @if($item->send_flag!='2')
                            <a href="{{ route('faktur.spt.detail', ['id'=>$item->id]) }}" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Buka SPT">
                                <i class="fa fa-folder text-success"></i>
                            </a>
                                @if($item->ppn->submit_ab=='ya' && $item->ppn->submit_induk=='ya')
                                <a href="{{ route('faktur.spt.status', ['id'=>$item->id, 'status'=>'approval']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Mengupload SPT Ini?', 'captchaModal')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Lapor SPT">
                                    <i class="fa fa-check-circle text-warning"></i>
                                </a>
                                @endif
                            <a href="{{ route('faktur.spt.status', ['id'=>$item->id, 'status'=>'destroy']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus SPT Ini?', 'captchaModal')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus SPT">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                            <a href="{{ route('faktur.pajak.spt.cetak', ['id'=>$item->id]) }}" target="_blank" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak SPT">
                                <i class="fa fa-print text-primary"></i>
                            </a>
                            @else
                                @if($class_student && $item->question_id=='')
                                    <button data-id="{{ $item->id }}" data-code="{{ $class_student->kelas->code }}" class="btn btn-icon btn-active-light-primary w-25px h-25px submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Penugasan">
                                        <i class="fa fa-bookmark text-danger"></i>
                                    </button>
                                @endif
                                <button data-id="{{ $item->id }}" class="btn btn-icon btn-active-light-primary w-25px h-25px bpe" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat BPE">
                                    <i class="fa fa-file-archive text-warning"></i>
                                </button>
                                <a href="{{ route('faktur.pajak.spt.cetak', ['id'=>$item->id]) }}" target="_blank" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak SPT">
                                    <i class="fa fa-print text-primary"></i>
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

    <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form method="POST" action="{{ route('faktur.spt.store') }}">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Tambah SPT Baru</h2>
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
                            @csrf
                            
                            <!--begin::Input group-->
                            <div class="row mb-2">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tahun Pajak</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <select name="year" id="year" data-kt-select2="true" data-placeholder="Pilih Tahun Pajak" class="form-control form-select form-select-md" data-dropdown-parent="#tambah">
                                        @for($i = date('Y'); $i > date('Y')-3; $i--)
                                            <option value="{{ $i }}" {!! (date('Y')==$i) ? 'selected' : '' !!}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-2">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Masa Pajak</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <select name="period" id="period" data-kt-select2="true" data-placeholder="Pilih Masa Pajak" class="form-control form-select form-select-md" data-dropdown-parent="#tambah">
                                        @for($i = 1; $i<= 12; $i++)
                                            <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {!! (date('n')==$i) ? 'selected' : '' !!}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-2">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Pembetulan Ke</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="correction_to" id="correction_to" class="form-control" value="0" required>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
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
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>
                    <!--end::Modal footer-->
                </form>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--begin::Modal - BPE-->
    <div class="modal fade" id="divBpe" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header py-5 d-flex justify-content-between">
                    <!--begin::Modal title-->
                    <h2>Detail BPE</h2>
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
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Description-->
                        <div class="fw-semibold fs-5">
                            Berikut ini adalah Bukti Penerimaan Elektronik Anda.<br>
                            ---------------------------------------------------
                        </div>
                        <div id="mname"></div>
                        <div id="mnpwp"></div>
                        <div id="myear"></div>
                        <div id="mperiod"></div>
                        <div id="mtype"></div>
                        <div id="mcorrection"></div>
                        <div id="mstatus"></div>
                        <div>
                            <label>Nominal :</label>
                            <label id="mnominal" class="uang"></label>
                        </div>
                        <div id="mdate"></div>
                        <div id="mntte"></div>
                        Terima kasih telah menyampaikan Laporan SPT Anda.
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - BPE-->
    @if($class_student)
        <div class="modal fade" id="submit" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <form method="POST" action="{{ route('ruang.kelas.question', ['code'=>$class_student->kelas->code]) }}">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="modal-title">Submit Penugasan</h2>
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
                            @csrf

                            <!--begin::Input group-->
                            <div class="row mb-2">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Pilih Penugasan</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <select name="question_id" id="question_id" data-kt-select2="true" data-placeholder="Pilih Penugasan" class="form-select form-select-md" data-dropdown-parent="#submit" required>
                                        <option value="">Pilih Penugasan</option>
                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <input type="hidden" name="spt" id="spt">
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
    @endif
@endsection
@section('js')

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/bpe.js') }}" type="text/javascript"></script>
    <script>
        $("#tbl_spt").DataTable();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
