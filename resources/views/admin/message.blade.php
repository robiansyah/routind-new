@extends('layouts.main')
@section('title', 'Pesan')
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
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-capitalize">Daftar Pesan</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tbl">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Subject</th>
                    <th>Pesan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{!! $item->message !!}</td>
                        <td>
                            <span class="badge bg-{!! ($item->status!='Belum') ? 'success' : 'danger' !!}">{{ $item->status }}</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.message.destroy', ['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                @method('DELETE')
                                @csrf

                                <a href="{{ route('admin.message.reply', ['id'=>$item->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Balas">
                                    <i class="fas fa-reply"></i>
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
    </div>
    <!-- /.card -->
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
    </script>
@endsection