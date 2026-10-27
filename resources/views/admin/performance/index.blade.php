@extends('layouts.main')
@section('title', 'Performance')
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
            <h3 class="card-title text-capitalize">Daftar Performance</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-success ms-5" href="{{ route('admin.performance.create') }}">Lihat Performance</a>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tbl">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Bulan</th>
                    <th>Pelatihan</th>
                    <th>Sertifikasi</th>
                    <th>Total</th>
                    <th width="150px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->month }} - {{ $item->year }}</td>
                        <td class="text-center">{{ $item->training }}</td>
                        <td class="text-center">{{ $item->certification }}</td>
                        <td class="text-center">{{ $item->training+$item->certification }}</td>
                        <td>
                            <form action="{{ route('admin.performance.destroy', ['performance'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                @method('DELETE')
                                @csrf

                                <span data-toggle="tooltip" data-placement="top" title="Edit">
                                    <a href="#edit" data-toggle="modal" data-id="{{$item->id}}" data-category="{{$item->category}}" data-month="{{$item->month}}" data-year="{{$item->year}}" data-training="{{$item->training}}" data-certification="{{$item->certification}}" data-description="{{$item->description}}" class="edit btn btn-sm btn-success">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                </span>
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

    <div class="modal fade" id="tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Performance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.performance.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <select name="category" class="form-control" required>
                                <option value="Brevet Pajak">Brevet Pajak</option>
                                <option value="Accurate">Accurate</option>
                                <option value="CTT">CTT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pelatihan</label>
                            <input type="number" name="training" class="form-control" placeholder="Jumlah Pelatihan">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Sertifikasi</label>
                            <input type="number" name="certification" class="form-control" placeholder="Jumlah Sertifikasi">
                        </div>
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="month" class="form-control" required>
                                @for($i=1; $i<=12; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name="year" class="form-control" required>
                                @php($year = date('Y'))
                                @for($i=2025; $i<=$year; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="description" class="form-control" placeholder="Keterangan">
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
                    <h4 class="modal-title">Edit Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="myForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="Brevet Pajak">Brevet Pajak</option>
                                <option value="Accurate">Accurate</option>
                                <option value="CTT">CTT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pelatihan</label>
                            <input type="number" name="training" id="training" class="form-control" placeholder="Jumlah Pelatihan">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Sertifikasi</label>
                            <input type="number" name="certification" id="certification" class="form-control" placeholder="Jumlah Sertifikasi">
                        </div>
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="month" id="month" class="form-control" required>
                                @for($i=1; $i<=12; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name="year" id="year" class="form-control" required>
                                @php($year = date('Y'))
                                @for($i=2025; $i<=$year; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Keterangan">
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

            $('.edit').on('click', function(){
                var id = $(this).attr('data-id');
                var category = $(this).attr('data-category');
                var month = $(this).attr('data-month');
                var year = $(this).attr('data-year');
                var training = $(this).attr('data-training');
                var certification = $(this).attr('data-certification');
                var description = $(this).attr('data-description');

                $("#category").val(category).change();
                $("#month").val(month).change();
                $("#year").val(year).change();
                $("#training").val(training);
                $("#certification").val(certification);
                $("#description").val(description);
                $("#myForm").attr("action", "/admin/performance/"+id);
            });
        });
    </script>
@endsection