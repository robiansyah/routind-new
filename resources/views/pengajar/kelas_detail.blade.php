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
        <a href="{{ (auth()->user()->hasRole('prodi')) ? route('prodi.kelas') : route('pengajar.kelas')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        Detail Kelas
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
    <form action="{{ route('pengajar.destroyEnrolle') }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
        @method('DELETE')
        @csrf
        <div class="card-header">
            <h3 class="card-title text-capitalize">Daftar Pelajar</h3>
            <div class="card-tools">
                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i> Hapus</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tbl_pelajar">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="50px">Aksi / All <input type="checkbox" onclick="toggle(this);" class="chk_boxes" label="check all"/></th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($students as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nim }}</td>
                        <td>{{ $item->student->name }}</td>
                        <td>{{ $item->student->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('pengajar.pelajar.detail', ['id'=>$item->student_id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail">
                                <i class="fas fa-folder"></i>
                            </a>
                            <input role="checkbox" type="checkbox" name="id[]" class="cbox" value="{{ $item->id }}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<!-- /.card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-capitalize">Daftar Penugasan</h3>
        <div class="card-tools">
            <a href="{{ route('pengajar.soal.create', ['kelas_id'=>$kelas->id]) }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i> Tambah
            </a>
            <a href="{{ route('pengajar.soal.template', ['kelas_id'=>$kelas->id]) }}" class="btn btn-sm btn-warning">
                <i class="fa fa-plus"></i> Template
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tbl_penugasan">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Jenis</th>
                <th>Bobot</th>
                <th>Tanggal</th>
                <th>Penilaian</th>
                <th>Mengerjakan</th>
                <th width="75px">Status</th>
                <th width="100px">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            @foreach ($questions as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->type.' - '.$item->description }}</td>
                    <td class="text-center">{{ $item->weight }}%</td>
                    <td>{{ Carbon\Carbon::parse($item->start_date)->format('j M Y, H:i').' -- '.Carbon\Carbon::parse($item->end_date)->format('j M Y, H:i') }}</td>
                    <td class="text-center">{{ $item->assesments_count }}</td>
                    <td class="text-center">{{ $item->spt_count }}</td>
                    <td>
                        <form action="{{ route('pengajar.soal.status', ['kelas_id'=>$kelas->id, 'id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan mengubah status soal ini?')">
                            @csrf

                            {{ $item->status }}
                            <button type="submit" class="btn btn-sm {!! ($item->status=='Show') ? 'btn-success' : 'btn-danger' !!}" data-toggle="tooltip" data-placement="top" title="{!! ($item->status=='Show') ? 'Hide' : 'Show' !!}"><i class="fas fa-{!! ($item->status=='Show') ? 'check-circle' : 'times-circle' !!}"></i></button>
                        </form>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.soal.destroy', ['kelas_id'=>$kelas->id, 'id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf

                            <a href="{{ route('pengajar.soal.detail', ['kelas_id'=>$kelas->id, 'id'=>$item->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a href="{{ route('pengajar.soal.edit', ['kelas_id'=>$kelas->id, 'id'=>$item->id]) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
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
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-capitalize">Daftar Materi</h3>
        <div class="card-tools">
            <a href="{{ route('pengajar.materi.create', ['class_id'=>$kelas->id]) }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tbl_materi">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Nama Materi</th>
                <th>URL</th>
                <th width="100px">Status</th>
                <th width="100px">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            @foreach ($materials as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td><a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a></td>
                    <td>
                        <form action="{{ route('pengajar.materi.status', ['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan mengubah status materi ini?')">
                            @csrf

                            {{ $item->status }}
                            <button type="submit" class="btn btn-sm {!! ($item->status=='Show') ? 'btn-success' : 'btn-danger' !!}" data-toggle="tooltip" data-placement="top" title="{!! ($item->status=='Show') ? 'Hide' : 'Show' !!}"><i class="fas fa-{!! ($item->status=='Show') ? 'check-circle' : 'times-circle' !!}"></i></button>
                        </form>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.materi.destroy', ['materi'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf

                            <a href="{{ route('pengajar.materi.edit', ['materi'=>$item->id]) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
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

    $("#tbl_penugasan").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tbl_penugasan_wrapper .col-md-6:eq(0)');
    $("#tbl_pelajar").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tbl_pelajar_wrapper .col-md-6:eq(0)');
    $("#tbl_materi").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tbl_materi_wrapper .col-md-6:eq(0)');
});
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

</script>
@endsection