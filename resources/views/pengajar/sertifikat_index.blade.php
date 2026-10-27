@extends('layouts.main')
@section('title', 'Sertifikat')
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
                <a href="{{ route('pengajar.kelas')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                Sertifikat
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                <tbody>
                <tr>
                    <td class="fw-bold">Nama Kelas</td>
                    <td>{{ $kelas->name }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Kode</td>
                    <td>{{ $kelas->code }}</td>
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
            <div class="card-tools">
                <a href="{{ route('pengajar.certificate.create', ['id'=>$kelas->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Sertifikat Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tbl_pelajar">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Sertifikat</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($students as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nim }}</td>
                        <td>{{ $item->student->name }}</td>
                        <td>
                            @if(count($item->student->certificates))
                                @foreach($item->student->certificates as $certificate)
                                    @if($loop->first)
                                        <a href="{{ route('print.certificate', ['code'=>$certificate->code]) }}" target="_blank">{{ $certificate->name }}</a>
                                    @else
                                        <br><a href="{{ route('print.certificate', ['code'=>$certificate->code]) }}" target="_blank">{{ $certificate->name }}</a>
                                    @endif
                                @endforeach
                            @endif
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

    $("#tbl_penugasan").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
    });
    $("#tbl_pelajar").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
    });
});
</script>
@endsection