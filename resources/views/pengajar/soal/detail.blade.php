@extends('layouts.main')
@section('title', 'Detail Soal')
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
                <a href="{{ route('pengajar.kelas.detail', ['id'=>$kelas->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                Detail Soal
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                <tbody>
                <tr>
                    <td class="fw-bold" width="100px">Soal</td>
                    <td>{!! $question->question !!}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Jenis SPT</td>
                    <td>{{ $question->form->name }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Bobot (%)</td>
                    <td>{{ $question->weight }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Tanggal</td>
                    <td>{{ $question->start_date.' - '.$question->end_date }}</td>
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-capitalize">Daftar Penilaian</h3>
            <div class="card-tools">
                <a href="{{ route('pengajar.penilaian.create', ['soal_id'=>$question->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tbl_penilaian">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Penilaian</th>
                    <th>Jawaban</th>
                    <th>Bobot</th>
                    <th width="100px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; $weight=0;?>
                @foreach ($question->assesments as $item)
                    <tr>
                        <td>{{ $no++ }}</td>

                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->answer }}</td>
                        <td class="text-center">{{ $item->weight }}</td>
                        <td class="text-center">
                            <form action="{{ route('pengajar.penilaian.destroy', ['soal_id'=>$question->id, 'id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                @method('DELETE')
                                @csrf

                                <a href="{{ route('pengajar.penilaian.edit', ['soal_id'=>$question->id, 'id'=>$item->id]) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @php($weight += $item->weight)
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td class="text-center" colspan="3"><b>Jumlah Bobot</b></td>
                    <td class="text-center">{!! ($weight==100) ? '<span class="badge badge-success">'.$weight.'</span>' : '<span class="badge badge-danger">'.$weight.'</span>' !!}</td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card">
        <form action="{{ route('pengajar.penilaian.pelajar.destroy') }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
            @method('DELETE')
            @csrf
        <div class="card-header">
            <h3 class="card-title text-capitalize">Daftar Pelajar Submit</h3>
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
                    <th>Nilai</th>
                    <th>Ket</th>
                    <th width="100px">Aksi / All <input type="checkbox" onclick="toggle(this);" class="chk_boxes" label="check all"/></th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($question->spt as $item)
                    <tr>
                        <td>{{ $no++ }}</td>

                        <td>{{ $item->user->username }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->nilai }}</td>
                        <td>{!! $item->note !!}</td>
                        <td class="text-center">
                            @if($item->form_code=='1770S' || $item->form_code=='1770SS' || $item->form_code=='PPN1111')
                                <a href="{{ route('pengajar.pelajar.spt', ['spt_id'=>$item->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail">
                                    <i class="fas fa-folder"></i>
                                </a>
                            @elseif($item->form_code=='1770' || $item->form_code=='1771')
                                <a href="{{ route('pengajar.pelajar.eform', ['id'=>$item->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail">
                                    <i class="fas fa-folder"></i>
                                </a>
                            @endif
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
        $('[data-toggle="tooltip"]').tooltip();

         $("#tbl_penilaian").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tbl_penilaian_wrapper .col-md-6:eq(0)');

        $("#tbl_pelajar").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tbl_pelajar_wrapper .col-md-6:eq(0)');

        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endsection