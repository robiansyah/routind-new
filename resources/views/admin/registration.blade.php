@extends('layouts.main')
@section('title', 'Registrasi')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
    <div class="card">
        <div class="body px-3 py-4">
            <form method="GET" action="{{ route('admin.registration') }}">
                <div class="row clearfix">
                    <div class="col-sm-5">
                        <select class="form-control select2bs4" id="event_id" name="event_id[]" multiple>
                            <option value="">Semua Course</option>
                            @foreach($events as $item)
                                <option value="{{ $item->id }}" {!! ($event_id==$item->id) ? "selected" : "" !!}>{{ $item->event->title." - ".$item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control select2bs4" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="PAID" {!! ($status=='PAID') ? "selected" : "" !!}>PAID</option>
                            <option value="UNPAID" {!! ($status=='UNPAID') ? "selected" : "" !!}>UNPAID/FAILED</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" name="submit" value="filter" class="btn btn-round btn-info float-md-right">
                            <i class="zmdi zmdi-filter-list"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-capitalize">Daftar Registrasi</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tbl">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Institusi</th>
                    <th>Event</th>
                    <th>Nett</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>File</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->mobile_phone }}</td>
                        <td>{{ $item->institution }}</td>
                        <td>{{ $item->batch->event->title." - ".$item->batch->name }}</td>
                        <td>@money($item->nett)</td>
                        <td>
                            <span class="badge bg-{!! ($item->status=='PAID' || $item->status=='SETTLED') ? 'success' : 'danger' !!}">{{ $item->status }}</span>
                        </td>
                        <td>{{ $item->created_at->format('d M Y - H:i') }}</td>
                        <td>
                            @if($item->file)
                            <a data-source="{{ asset('storage/'.$item->file) }}" data-title="{{ $item->name }}" href="#berkas" data-toggle="modal" class="berkas badge badge-info">KTM </a>
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
    <div class="modal fade" id="berkas" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="title" id="mtitles"></h5>
                </div>
                <div class="modal-body">
                    <span id="mfile"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                        Tutup
                    </button>
                    <span id="mdownload"></span>
                </div>
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
    <script src="{{ url('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('[data-toggle="tooltip"]').tooltip();

            $("#tbl").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tbl_wrapper .col-md-6:eq(0)');

        });
        //berkas
        $('.berkas').on('click', function(){
            var jdl = $(this).attr('data-title');
            var file = $(this).attr('data-source');
            var ext = file.slice(-3);
            if(ext == 'jpg' || ext == 'png' || ext == 'peg' || ext == 'JPG' || ext == 'PNG' || ext == 'PEG') var src = "<img src='"+file+"' class='img-responsive' style='margin:auto;'>";
            else if(ext == 'pdf') var src ="<iframe src='"+file+"' frameborder='0' style='width:100%;min-height:500px;'></iframe>";
            else var src = "<iframe src='https://view.officeapps.live.com/op/view.aspx?src="+file+"' style='width:100%;min-height:500px;'></iframe>";
            var link = "<a href='"+file+"' target='_blank' class='btn btn-info waves-effect'>Download</a>"
            $("#mfile").html(src);
            $('#mtitles').html(jdl);
            $('#mdownload').html(link);
        });
    </script>
@endsection