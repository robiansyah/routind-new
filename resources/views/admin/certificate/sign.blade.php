@extends('layouts.main')
@section('title', 'Tanda Tangan')
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
            <h3 class="card-title text-capitalize">Daftar Tanda Tangan</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary me-2" data-toggle="modal" data-target="#tambah">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="tbl">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>TTD</th>
                    <th width="100px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->position }}</td>
                        <td><img src="{{ url($item->image) }}" width="100px"></td>
                        <td class="text-center">
                            <form action="{{ route('admin.certificate.sign.destroy', ['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                @method('DELETE')
                                @csrf

                                <a href="#edit" data-toggle="modal" data-id="{{ $item->id }}" class="edit btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
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
                    <h4 class="modal-title">Tambah TTD</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.certificate.sign.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Penanda Tangan</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Penanda Tangan">
                        </div>
                        <div class="form-group">
                            <label>Jabatan/Posisi Penanda Tangan</label>
                            <input type="text" name="position" class="form-control" placeholder="Jabatan/Posisi Penanda Tangan">
                        </div>
                        <div class="form-group">
                            <label>Tanda Tangan</label>
                            <input type="file" name="image" class="form-control" required>
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

    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Edit Bahan Kajian</h4>
                </div>
                <form class="form" id="myForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama Penanda Tangan</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Penanda Tangan">
                        </div>
                        <div class="form-group">
                            <label>Jabatan/Posisi Penanda Tangan</label>
                            <input type="text" name="position" id="position" class="form-control" placeholder="Jabatan/Posisi Penanda Tangan">
                        </div>
                        <div class="form-group">
                            <label>Tanda Tangan (Diisi Apabila Ingin Mengubah Tanda Tangan)</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info waves-effect">Edit</button>
                    </div>
                </form>
            </div>
        </div>
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
    <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip();

          $("#tbl").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tbl_wrapper .col-md-6:eq(0)');
        });

        $('.edit').on('click', function(){
            var id = $(this).attr('data-id');
            $.get("{{ url('/admin/sertifikat/ttd') }}/" + id + "/edit", function (data) {
                $("#myForm").attr("action", "{{ url('/admin/sertifikat/ttd') }}/"+id);
                $('#name').val(data.data.name);
                $('#position').val(data.data.position);
            })
        });
    </script>
@endsection