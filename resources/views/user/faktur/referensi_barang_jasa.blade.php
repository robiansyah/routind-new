@extends('layouts.metronic')

@section('title', 'Referensi Barang / Jasa')
@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        <!--begin::Table Widget 4-->
        <div class="card card-flush h-xl-100">
            <!--begin::Card header-->
            <div class="card-header pt-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Daftar Referensi</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Barang / Jasa</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <a href="#tambah" data-bs-toggle="modal" class="btn btn-primary">Tambah</a>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-2">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed gy-3" id="tbl_referensi">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th class="w-100px">Aksi</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
                        <?php $no=1;?>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>@money($item->price)</td>
                                <td>
                                    <span class="edit" data-bs-toggle="modal" data-id="{{ $item->id }}" data-bs-target="#edit" >
                                        <button type="button" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit Referensi">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </span>
                                    <a href="{{ route('faktur.referensi.destroy', ['id'=>$item->id, 'type'=>'barang_jasa']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus Barang / Jasa Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Faktur">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Table Widget 4-->
    </div>
    <!--end::Col-->
</div>
@endsection
@section('modal')

<!--begin::Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form method="POST" action="{{ route('faktur.referensi.store', ['type'=>'barang_jasa']) }}">
            @csrf

            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Tambah Barang / Jasa</h2>
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
                <div class="mb-5 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="form-label mb-3">Kode Barang / Jasa</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control" name="code" placeholder="Kode Barang / Jasa">
                    <!--end::Input-->
                </div>
                <div class="mb-5 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Nama Barang / Jasa</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control" name="name" placeholder="Nama Barang / Jasa" required>
                    <!--end::Input-->
                </div>
                <div class="mb-5 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Harga Barang / Jasa</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="number" class="form-control" name="price" placeholder="Harga Barang / Jasa">
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <!--end::Modal footer-->
            </form>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal -->
<!--begin::Modal - Detail-->
<div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form method="POST" id="myForm">
                @method('PUT')
                @csrf
    
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>Ubah Barang / Jasa</h2>
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
                    <div class="mb-5 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="form-label mb-3">Kode Barang / Jasa</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control" name="code" id="mcode" placeholder="Kode Barang / Jasa">
                        <!--end::Input-->
                    </div>
                    <div class="mb-5 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Nama Barang / Jasa</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control" name="name" id="mname" placeholder="Nama Barang / Jasa" required>
                        <!--end::Input-->
                    </div>
                    <div class="mb-5 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Harga Barang / Jasa</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" class="form-control" name="price" id="mprice" placeholder="Harga Barang / Jasa">
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
                <!--end::Modal footer-->
            </form>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal -->
@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $("#tbl_referensi").DataTable();
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });

        $('.edit').on('click', function(){
            var id = $(this).attr('data-id');
            $.get('/faktur/referensi/barang_jasa/' + id + '/edit', function (result) {
                $('#mname').val(result.name);
                $('#mprice').val(result.price);
                $('#mcode').val(result.code);
                $("#myForm").attr("action", "/faktur/referensi/barang_jasa/"+id);
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