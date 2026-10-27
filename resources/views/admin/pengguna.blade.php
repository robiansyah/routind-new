@extends('layouts.main')
@section('title', 'Pengguna')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    </div>
@endif
<!-- Default box -->
<div class="card">
    <div class="card-header">
      <h3 class="card-title text-capitalize">Daftar {{ Request::segment(3) }}</h3>
      <div class="card-tools">
          <button type="button" class="btn btn-sm btn-primary me-2" data-toggle="modal" data-target="#tambah">
              <i class="fa fa-plus"></i> Tambah
          </button>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#impor">
              <i class="fa fa-file-excel"></i> Impor
          </button>
      </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered" id="table">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Paket</th>
                <th>Status</th>
                <th width="100px">Aksi</th>
              </tr>
            </thead>
            <tbody>
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
                <h4 class="modal-title">Tambah Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.pengguna.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="number" name="mobile_phone" class="form-control" placeholder="No HP">
                    </div>
                    <div class="form-group">
                        <label>Jenis Pengguna</label>
                        <select name="role_id" class="form-control" required>
                            <option value="">Pilih Jenis Pengguna</option>
                            <option value="2">Pelajar</option>
                            <option value="3">Pengajar</option>
                            <option value="4">Co-Pengajar</option>
                            <option value="5">Admin Prodi</option>
                            <option value="6">Affiliate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Institusi (Jika Ada)</label>
                        <select name="institution_code" class="form-control">
                            <option value="">Pilih Institusi</option>
                            @foreach($partnership as $item)
                                <option value="{{ $item->code }}">{{ $item->name }}</option>
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
                <h4 class="modal-title">Edit Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="myForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="number" name="mobile_phone" id="mobile_phone" class="form-control" placeholder="No HP">
                    </div>
                    <div class="form-group">
                        <label>Jenis Pengguna</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Pilih Jenis Pengguna</option>
                            <option value="2">Pelajar</option>
                            <option value="3">Pengajar</option>
                            <option value="4">Co-Pengajar</option>
                            <option value="5">Admin Prodi</option>
                            <option value="6">Affiliate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Institusi (Jika Ada)</label>
                        <select name="institution_code" id="institution_code" class="form-control">
                            <option value="">Pilih Institusi</option>
                            @foreach($partnership as $item)
                                <option value="{{ $item->code }}">{{ $item->name }}</option>
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

<div class="modal fade" id="impor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Impor Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.pengguna.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <code>Download Format Impor Pengguna <a href="{{ url('import/pengguna-kelas.xlsx') }}">Disini</a></code>
                    <br>
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" name="file" class="form-control" placeholder="File" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Impor</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();

    $('#table').DataTable({
        processing: true,
        serverSide: true,
        searchDelay:1000,
        ajax: "{{ route('admin.pengguna', [$type]) }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'mobile_phone', name: 'mobile_phone'},
            {data: 'paket', name: 'paket'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
            {
                "targets": 0, // your case first column
                "className": "text-center",
                "width": "5px"
           }
        ]
    });

    $('table tbody').on('click', '.edit', function() {
        var id = $(this).attr('data-id');
        $.get('/admin/pengguna/' + id +'/edit', function (data) {
            $("#myForm").attr("action", "/admin/pengguna/"+id);
            $('#role_id').val(data.data.roles[0].id).change();
            $('#institution_code').val(data.data.institution_code).change();
            $('#name').val(data.data.name);
            $('#email').val(data.data.email);
            $('#mobile_phone').val(data.data.mobile_phone);
        })
    });
});
</script>
@endsection