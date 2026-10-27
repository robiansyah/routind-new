@extends('layouts.metronic')

@section('title', 'Daftar Personalia')
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
                <!--begin::Add user-->
                <button type="button"  name="tambahItem" id="tambahItem" class="btn btn-primary me-2"><i class="ki-outline ki-plus fs-2"></i>Tambah Personalia</button>
                <!--end::Add user-->
                <!--begin::Import user-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal"><i class="ki-outline ki-file-up fs-2"></i>Import</button>
                <!--end::Import user-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed gy-5" id="tbl_personalia">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-25px">#</th>
                    <th>Nama</th>
                    <th>NPWP</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Periode Kerja</th>
                    <th class="w-75px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php $no=1;?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->npwp }}</td>
                        <td>{{ $item->position }}</td>
                        <td>
                            {!! $item->status.' - '.((substr($item->ptkp, 0, 1)=='0') ? 'TK/' : ((substr($item->ptkp, 0, 1)=='1') ? 'K/' : 'T/I/')).substr($item->ptkp, -1) !!}
                        </td>
                        <td>
                            {!! $item->start_date.' - <br>'. (($item->end_date!='') ? $item->end_date : 'Sekarang') !!}
                        </td>
                        <td>
                            @if($item->status=='Pegawai Tetap')
                            <button type="button" class="btn btn-icon btn-active-light-primary w-25px h-25px editItem" data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Personalia">
                                <i class="fa fa-pencil text-success"></i>
                            </button>
                            <a href="{{ route('pph21.personalia.status', ['id'=>$item->id, 'status'=>'cancel']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Mengganti Status Pegawai Ini?', 'statusModal')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Status Pegawai">
                                <i class="fa fa-ban text-warning"></i>
                            </a>
                            @endif
                            <a href="{{ route('pph21.personalia.destroy', ['id'=>$item->id]) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus Pegawai Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Personalia">
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
                    <form id="itemForm" name="itemForm" class="form" method="POST" action="{{ route('pph21.personalia.store') }}">
                        @csrf

                        <input type="hidden" name="id" id="item_id">
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">NPWP/NIK</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="npwp" id="npwp" class="form-control" placeholder="NPWP/NIK"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Jenis Kelamin</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <div class="mt-4 d-flex">
                                    <div class="form-check form-check-custom me-10">
                                        <input class="form-check-input w-20px h-20px" type="radio" name="gender" value="Laki-Laki" checked>
                                        <label class="form-check-label">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom me-10">
                                        <input class="form-check-input w-20px h-20px" type="radio" name="gender" value="Perempuan">
                                        <label class="form-check-label">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Alamat</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <textarea name="address" id="address" rows="3" class="form-control" placeholder="Alamat" required></textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">PTKP</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <select name="ptkp" id="ptkp" data-kt-select2="true" data-placeholder="Pilih PTKP" class="form-select form-select-md" data-dropdown-parent="#itemForm">
                                    <option value="">Pilih PTKP</option>
                                    <option value="00">TK/0</option>
                                    <option value="01">TK/1</option>
                                    <option value="02">TK/2</option>
                                    <option value="03">TK/3</option>
                                    <option value="10">K/0</option>
                                    <option value="11">K/1</option>
                                    <option value="12">K/2</option>
                                    <option value="13">K/3</option>
                                    <option value="20">K/I/0</option>
                                    <option value="21">K/I/1</option>
                                    <option value="22">K/I/2</option>
                                    <option value="23">K/I/3</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Jabatan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="position" id="position" class="form-control" placeholder="Jabatan"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Mulai Kerja</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Mulai Kerja"/>
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

    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form method="POST" id="myForm">
                    @csrf
    
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Edit Status Pegawai</h2>
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
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Status Pegawai</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <select name="status" id="status" data-kt-select2="true" data-placeholder="Pilih Status Pegawai" class="form-select form-select-md" data-dropdown-parent="#statusModal" required>
                                    <option value="Pensiun">Pensiun</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Akhir Kerja</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Akhir Kerja" required/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="statusBtn">Submit</button>
                    </div>
                    <!--end::Modal footer-->
                </form>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form class="form" method="POST" action="{{ route('pph21.personalia.import') }}" enctype="multipart/form-data">
                    @csrf

                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Import Pegawai</h2>
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
                        <code>Download Format Import Personalia <a href="{{ url('import/personalia.xlsx') }}">Disini</a></code>
                        <!--begin::Input group-->
                        <div class="row my-5">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">File</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="file" name="file" class="form-control" placeholder="File" required/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="statusBtn">Submit</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pph21/personalia-fix.js') }}"></script>

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
