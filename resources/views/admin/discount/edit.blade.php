@extends('layouts.main')

@section('title', 'Edit Diskon')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Diskon</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.discount.update', ['discount'=>$discount->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $discount->name }}" class="form-control" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode <span class="text-danger">*</span></label>
                            <input type="text" name="code" value="{{ $discount->code }}" class="form-control" placeholder="Kode" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipe <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="">Pilih Tipe</option>
                                <option value="rupiah" {!! ($discount->type=='rupiah') ? 'selected' : '' !!}>Rupiah</option>
                                <option value="persen" {!! ($discount->type=='persen') ? 'selected' : '' !!}>Persen</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah <span class="text-danger">*</span></label>
                            <input type="number" name="amount" value="{{ $discount->amount }}" class="form-control" placeholder="Harga" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" value="{{ $discount->start_date }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Akhir <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" value="{{ $discount->end_date }}" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.discount.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection