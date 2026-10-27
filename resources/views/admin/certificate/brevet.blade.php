@extends('layouts.main')
@section('title', 'Brevet')
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
            <h3 class="card-title text-capitalize">Daftar Brevet</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#print">
                    <i class="fa fa-print"></i> Print
                </button>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#impor">
                    <i class="fa fa-file-excel"></i> Impor
                </button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="tbl">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>No Peserta</th>
                    <th>No Sertif</th>
                    <th>Nama</th>
                    <th>Batch</th>
                    <th>Visibilitas</th>
                    <th>Tanggal</th>
                    <th>Barcode</th>
                    <th width="100px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->participant_no }}</td>
                        <td>
                                <?php
                                $year = substr($item->date,0, 4);
                                $month = substr($item->date, 5, 2);
                                ?>
                            @if($year < 2025)
                                {{ $item->code }}
                            @else
                                {{ str_pad($item->no,5,"0",STR_PAD_LEFT)."/RTND/".$month."/".$year }}
                            @endif
                        </td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->visibility }}</td>
                        <td>{{ $item->date }}</td>
                        <td>
                            <img src="data:image/png;base64, {!! DNS2D::getBarcodePNG(url('certificates/'.$item->code), 'QRCODE') !!} " alt="barcode" width="100px" style="padding: 10px"/>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.certificate.brevet.destroy', ['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('brevet.certificate', ['code'=>$item->code]) }}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-print"></i></a>
                                <a href="{{ route('blank.certificate', ['code'=>$item->code]) }}" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i></a>
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

    <div class="modal fade" id="impor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Impor Brevet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.certificate.brevet.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <code>Download Format Impor Brevet <a href="{{ url('import/brevet-format-baru.xlsx') }}">Disini</a></code>
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

    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Edit Brevet</h4>
                </div>
                <form class="form" id="myForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>No Peserta</label>
                            <input type="text" name="participant_no" id="participant_no" class="form-control" placeholder="No Peserta">
                        </div>
                        <div class="form-group">
                            <label>Batch</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Batch">
                        </div>
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Kode">
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="date" id="date" class="form-control" placeholder="Tanggal">
                        </div>
                        <div class="form-group">
                            <label>Visibilitas</label>
                            <select name="visibility" id="visibility" class="form-control">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
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

    <div class="modal fade" id="print">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Print Sertifikat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" >
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tipe</label>
                            <select name="type" id="type" class="form-control">
                                <option value="full">Full</option>
                                <option value="blank">Kosongan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Awal</label>
                            <input type="text" name="start" id="start" class="form-control" placeholder="No Urut Sertifikat">
                        </div>
                        <div class="form-group">
                            <label>Akhir</label>
                            <input type="text" name="end" id="end" class="form-control" placeholder="No Urut Sertifikat">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick='downloadTwo()' data-dismiss="modal">Simpan</button>
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

            $("#tbl").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tbl_wrapper .col-md-6:eq(0)');

        });

        $('.edit').on('click', function(){
            var id = $(this).attr('data-id');
            $.get("{{ url('/admin/sertifikat/brevet') }}/" + id + "/edit", function (data) {
                $("#myForm").attr("action", "{{ url('/admin/sertifikat/brevet') }}/"+id);
                $('#name').val(data.data.name);
                $('#code').val(data.data.code);
                $('#date').val(data.data.date);
                $('#participant_no').val(data.data.participant_no);
                $('#visibility').val(data.data.visibility).change();
            })
        });

        function downloadTwo(){
            var awal = $('#start').val();
            var akhir = $('#end').val();
            var tipe = $('#type').val();
            @foreach($data as $item)
            var iteration = {{ $loop->iteration }};
                if(iteration >= awal && iteration <= akhir && tipe == 'full'){
                    window.open("{{ route('brevet.certificate', ['code'=>$item->code]) }}");
                }else if(iteration >= awal && iteration <= akhir && tipe == 'blank'){
                    window.open("{{ route('blank.certificate', ['code'=>$item->code]) }}");
                }
            @endforeach
        return false;
    }
</script>
@endsection