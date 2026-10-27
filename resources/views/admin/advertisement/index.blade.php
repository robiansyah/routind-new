@extends('layouts.main')
@section('title', 'Advertisement')
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
            <h3 class="card-title text-capitalize">Daftar Advertisement</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-success ms-5" href="{{ route('admin.advertisement.create') }}">Lihat Chart</a>
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
                    <th>Akun</th>
                    <th>Total</th>
                    <th>Impresi</th>
                    <th>CPM</th>
                    <th>Tanggal</th>
                    <th width="75px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->account }}</td>
                        <td class="text-right">@money($item->total)</td>
                        <td class="text-center">@money($item->impression)</td>
                        <td class="text-center">
                            @if($item->impression > 0)
                            @money($item->total/$item->impression*1000)
                            @else
                            -
                            @endif
                        </td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->date)->isoFormat('DD MMMM Y') }}</td>
                        <td>
                            <form action="{{ route('admin.advertisement.destroy', ['advertisement'=>$item->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                @method('DELETE')
                                @csrf

                                <span data-toggle="tooltip" data-placement="top" title="Edit">
                                    <a href="#edit" data-toggle="modal" data-id="{{$item->id}}" data-category="{{$item->category}}" data-account="{{$item->account}}" data-budget="{{$item->budget}}" data-tax="{{$item->tax}}" data-total="{{$item->total}}" data-impression="{{$item->impression}}" data-date="{{$item->date}}" class="edit btn btn-sm btn-success">
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
                    <h4 class="modal-title">Tambah Advertisement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.advertisement.store') }}">
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
                            <label>Nama Akun</label>
                            <input type="text" name="account" class="form-control" placeholder="Nama Akun">
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="date" class="form-control" placeholder="Tanggal">
                        </div>
                        <div class="form-group">
                            <label>Budget Iklan</label>
                            <input type="number" name="budget" id="mbudget" class="form-control" placeholder="Budget Iklan">
                        </div>
                        <div class="form-group">
                            <label>Pajak</label>
                            <input type="number" name="tax" id="mtax" class="form-control" placeholder="Pajak">
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" name="total" id="mtotal" class="form-control" placeholder="Total">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Impresi</label>
                            <input type="number" name="impression" class="form-control" placeholder="Jumlah Impresi">
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
                            <label>Nama Akun</label>
                            <input type="text" name="account" id="account" class="form-control" placeholder="Nama Akun">
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="date" id="date" class="form-control" placeholder="Tanggal">
                        </div>
                        <div class="form-group">
                            <label>Budget Iklan</label>
                            <input type="number" name="budget" id="budget" class="form-control" placeholder="Budget Iklan">
                        </div>
                        <div class="form-group">
                            <label>Pajak</label>
                            <input type="number" name="tax" id="tax" class="form-control" placeholder="Pajak">
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" name="total" id="total" class="form-control" placeholder="Total">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Impresi</label>
                            <input type="number" name="impression" id="impression" class="form-control" placeholder="Jumlah Impresi">
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
        });

        $('.edit').on('click', function(){
            var id = $(this).attr('data-id');
            var category = $(this).attr('data-category');
            var account = $(this).attr('data-account');
            var budget = $(this).attr('data-budget');
            var tax = $(this).attr('data-tax');
            var total = $(this).attr('data-total');
            var impression = $(this).attr('data-impression');
            var date = $(this).attr('data-date');

            $("#category").val(category).change();
            $("#account").val(account);
            $("#budget").val(budget);
            $("#tax").val(tax);
            $("#total").val(total);
            $("#impression").val(impression);
            $("#date").val(date);
            $("#myForm").attr("action", "/admin/advertisement/"+id);
        });

        function calculateTotal() {
            let budget = parseFloat($('#budget').val()) || 0;
            let tax = parseFloat($('#tax').val()) || 0;

            let sum = budget + tax;

            $('#total').val(sum.toFixed(0));
        }

        function calculateTax() {
            let budget = parseFloat($('#budget').val()) || 0;

            let tax = budget * 0.11;

            $('#tax').val(tax.toFixed(0));
        }

        $('#budget').on('input', function() {
            calculateTax();
            calculateTotal();
        });

        $('#tax').on('input', function() {
            calculateTotal();
        });

        function calculateTotalM() {
            let budget = parseFloat($('#mbudget').val()) || 0;
            let tax = parseFloat($('#mtax').val()) || 0;

            let sum = budget + tax;

            $('#mtotal').val(sum.toFixed(0));
        }

        function calculateTaxM() {
            let budget = parseFloat($('#mbudget').val()) || 0;

            let tax = budget * 0.11;

            $('#mtax').val(tax.toFixed(0));
        }

        $('#mbudget').on('input', function() {
            calculateTaxM();
            calculateTotalM();
        });

        $('#mtax').on('input', function() {
            calculateTotalM();
        });

    </script>
@endsection