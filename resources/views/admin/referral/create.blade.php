@extends('layouts.main')

@section('title', 'Tambah Referral')
@section('css')
    <link rel="stylesheet" href="{{ url('adminlte/plugins/select2/css/select2.min.css') }}" >
    <link rel="stylesheet" href="{{ url('adminlte/dist/css/adminlte.min.css') }}">
@endsection
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Referral</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.referral.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pengguna <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-control single" style="width: 100%;" required>
                                <option value="">Pilih Pengguna</option>
                                @foreach($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lama Premium <span class="text-danger">*</span></label>
                            <input type="number" name="length" class="form-control" placeholder="Lama Premium" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" placeholder="Kode" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Akhir <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.referral.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection
@section('js')
    <script src="{{ url('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.single').select2();
        });
    </script>
@endsection