@extends('layouts.main')
@section('title', 'Invoice')
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
            <h3 class="card-title text-capitalize">Daftar Invoice</h3>
            <div class="card-tools">
                <a href="{{ route('admin.invoice.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tbl">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Tanggal</th>
                    <th>Invoice</th>
                    <th>Kepada</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Disc</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="150px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ Carbon\Carbon::parse($item->date)->format('j M Y') }}</td>
                        <td>{{ $item->no }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->item }}</td>
                        <td>@money($item->price)</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->discount }}</td>
                        <td>
                            @if($item->type!='' && $item->payment != '')
                                @money($item->payment)
                            @else
                                @money(($item->price*$item->qty)-$item->discount)
                            @endif
                        </td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <form action="{{ route('admin.invoice.destroy', ['invoice'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('admin.invoice.edit', ['invoice'=>$item->id]) }}" class="edit btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.invoice.print', ['invoice'=>$item->id]) }}" target="_blank" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Print">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a href="{{ route('admin.invoice.status', ['invoice'=>$item->id]) }}" onclick="return confirm('Apakah anda yakin akan mengubah data ini?')" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="PAID/UNPAID">
                                    <i class="fas fa-check"></i>
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