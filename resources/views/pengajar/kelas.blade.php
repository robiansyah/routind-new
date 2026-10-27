@extends('layouts.main')
@section('title', 'Kelas')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ url('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <div class="alert alert-{{ $msg }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('alert-' . $msg) }}
    </div>
    @endif
@endforeach  
<!-- Default box -->
<div class="card">
    <div class="card-header">
      <h3 class="card-title text-capitalize">Daftar Kelas</h3>
      <div class="card-tools">
          @if(auth()->user()->hasRole('pengajar') || auth()->user()->hasRole('co-pengajar'))
              <a href="#masukan" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-plus"></i> Faktur Pajak Masukan</a>
          @endif
        @if(auth()->user()->hasRole('pengajar'))
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
          <i class="fa fa-plus"></i> Tambah
        </button>
        @endif
      </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tbl">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nama Kelas</th>
              <th>Kode</th>
              <th>Co Dosen / Asisten</th>
              <th>Pelajar</th>
              <th>Materi</th>
              <th>Soal</th>
              <th>Champion</th>
              <th width="200px">Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php $no=1; ?>
              @foreach ($data as $item)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->code }}</td>
                  <td>{{ $item->co->name }}</td>
                  <td class="text-center">{{ $item->students_count }}</td>
                  <td class="text-center">{{ $item->materials_count }}</td>
                  <td class="text-center">{{ $item->questions_count }}</td>
                  <td>
                      <form action="{{ route('pengajar.kelas.champion', ['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan mengubah champion kelas ini?')">
                          @csrf

                          {{ $item->champion }}
                          <button type="submit" class="btn btn-sm {!! ($item->champion=='Show') ? 'btn-success' : 'btn-danger' !!}" data-toggle="tooltip" data-placement="top" title="{!! ($item->champion=='Show') ? 'Hide' : 'Show' !!}"><i class="fas fa-{!! ($item->champion=='Show') ? 'check-circle' : 'times-circle' !!}"></i></button>
                      </form>
                  </td>
                  <td>
                    <form action="{{ route('pengajar.kelas.destroy', ['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                      @method('DELETE')
                      @csrf

                      <a href="{{ route('pengajar.kelas.detail', ['id'=>$item->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail">
                          <i class="fas fa-folder"></i>
                      </a>
                        <a href="{{ route('pengajar.certificate', ['id'=>$item->id]) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Sertifikat">
                            <i class="fas fa-certificate"></i>
                        </a>
                        @if(auth()->user()->hasRole('pengajar'))
                        <a href="{{ route('pengajar.kelas.kode', ['id'=>$item->id]) }}" onclick="return confirm('Apakah anda yakin akan mengubah kode kelas ini?')" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah Kode">
                            <i class="fas fa-code"></i>
                        </a>
                        <a href="{{ route('pengajar.kelas.duplicate', ['id'=>$item->id]) }}" onclick="return confirm('Apakah anda yakin akan menduplikat kode kelas ini?')" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Duplikat Kelas">
                            <i class="fas fa-clone"></i>
                        </a>
                      <span data-toggle="tooltip" data-placement="top" title="Edit">
                        <a href="#edit" data-toggle="modal" data-id="{{$item->id}}" data-name="{{$item->name}}" data-co="{{ $item->co_id }}" class="edit btn btn-sm btn-success">
                          <i class="fas fa-edit"></i>
                        </a>
                      </span>
                      <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                        @endif
                    </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->

<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Kelas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('pengajar.kelas.store') }}">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Kelas</label>
          <input type="text" name="name" class="form-control" placeholder="Nama Kelas">
        </div>
        <div class="form-group">
          <label>Co Dosen / Asisten (Jika Ada)</label>
            <select name="co_id" class="select2 form-control">
                <option value="">Pilih Co Dosen / Asisten</option>
            @foreach($co as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
            </select>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Kelas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="myForm">
      @csrf
      @method('PUT')
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Kelas</label>
          <input type="text" name="name" id="mname" class="form-control" placeholder="Nama Kelas">
        </div>
          <div class="form-group">
              <label>Co Dosen / Asisten (Jika Ada)</label>
              <select name="co_id" id="mco" class="select2 form-control">
                  <option value="">Pilih Co Dosen / Asisten</option>
                  @foreach($co as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="masukan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Faktur Pajak Masukan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('pengajar.masukan.store') }}">
                @csrf
                <div class="modal-body">
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Kelas</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <div class="input-group">
                                <select name="class_id[]" id="class_id" class="select2 form-control form-select form-select-md" multiple required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Kode & No Seri Faktur</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <div class="input-group">
                                <input type="text" name="invoice_no" id="invoice_no" class="form-control invoice_no" placeholder="Kode & No Seri Faktur">
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">NPWP/NIK</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="customer_id" id="customer_id" class="form-control" required/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="customer_name" id="customer_name" class="form-control" required/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Alamat</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <textarea name="customer_address" id="customer_address" rows="3" class="form-control"></textarea>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tanggal Faktur</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="date" name="invoice_date" id="invoice_date" class="form-control"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Masa / Tahun Pajak</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <select name="invoice_period" id="invoice_period" aria-label="Pilih Masa Pajak" data-placeholder="Pilih Masa Pajak" class="form-control form-select form-select-md">
                                <option value="">Pilih Masa Pajak</option>
                                @for($i = 1; $i<= 12; $i++)
                                    <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-5 fv-row">
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
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Dapat Dikreditkan ? </label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <div class="mt-2 d-flex">
                                <div class="form-check form-check-custom me-10">
                                    <input class="form-check-input w-20px h-20px" type="radio" name="credit" value="tidak" checked>
                                    <label class="form-check-label">
                                        Tidak
                                    </label>
                                </div>
                                <div class="form-check form-check-custom me-10">
                                    <input class="form-check-input w-20px h-20px" type="radio" name="credit" value="ya">
                                    <label class="form-check-label">
                                        Ya
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">DPP</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="dpp" id="dpp" class="form-control uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">PPN</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="ppn" id="ppn" class="form-control uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">PPnBM</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="ppnbm" id="ppnbm" class="form-control uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@section('js')

<!-- DataTables  & Plugins -->
<script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ url('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
{{--New--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();

  $('.select2').select2({
      theme: 'bootstrap4'
    });

  $("#tbl").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tbl_wrapper .col-md-6:eq(0)');

    $('.edit').on('click', function(){
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var co = $(this).attr('data-co');

        $("#mname").val(name);
        $("#mco").val(co).change();
        $("#myForm").attr("action", "/pengajar/kelas/"+id);
    });

    $('#dpp').change(function() {
        var dpp = number.getVal('#dpp');
        number.setVal('#ppn', dpp*0.12);
    });

    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});

    $(".invoice_no").inputmask({
        mask: "99.99.99.999-99999999"
    });

    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value.indexOf("_") < 0 && value !== "";
    }, "Harap periksa kembali Kode & No Seri Faktur Pajak");
});
</script>
@endsection