@extends('layouts.main')

@section('title', 'Tambah invoice')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah invoice</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.invoice.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Invoice <span class="text-danger">*</span></label>
                            <input type="number" name="no" class="form-control" placeholder="No Invoice" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kepada <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Kepada" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" placeholder="Alamat" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode Barang/Jasa <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" placeholder="Kode Barang/Jasa" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Barang/Jasa <span class="text-danger">*</span></label>
                            <input type="text" name="item" class="form-control" placeholder="Nama Barang/Jasa" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" placeholder="Harga" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Diskon <span class="text-danger">*</span></label>
                            <input type="number" name="discount" class="form-control" placeholder="Diskon" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kuantitas <span class="text-danger">*</span></label>
                            <input type="number" name="qty" class="form-control" placeholder="Kuantitas" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" placeholder="Tanggal" required>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.invoice.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection