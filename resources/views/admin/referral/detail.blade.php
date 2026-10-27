@extends('layouts.main')
@section('title', 'Kelas')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-capitalize">
                <a href="{{ route('admin.referral.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                Detail Referral
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                <tbody>
                <tr>
                    <td class="fw-bold">Pengguna</td>
                    <td>{{ $referral->user->name }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Kode</td>
                    <td>{{ $referral->code }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Jumlah Pelajar</td>
                    <td>{{ count($referral->students) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
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
                <h3 class="card-title text-capitalize">Daftar Pelajar</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="tbl_pelajar">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="50px">Aksi / All <input type="checkbox" onclick="toggle(this);" class="chk_boxes" label="check all"/></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; ?>
                    @if(count($referral->students))
                    @foreach ($referral->students as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('pengajar.pelajar.detail', ['id'=>$item->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail">
                                    <i class="fas fa-folder"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr><td colspan="4">Tidak Ada</td></tr>
                    @endif
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
    $("#tbl_pelajar").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
    });
});
</script>
@endsection