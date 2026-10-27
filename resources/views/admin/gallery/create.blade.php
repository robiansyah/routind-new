@extends('layouts.main')

@section('title', 'Tambah Galeri')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Galeri</h3>
        </div>
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
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Kategori <span class="text-danger">*</span></label>
                    <select name="type" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="university">University</option>
                        <option value="brevet">Brevet</option>
                        <option value="short course">Short Course</option>
                        <option value="bootcamp">Bootcamp</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Keteragan" required>
                </div>
                <div class="form-group">
                    <label>Gambar <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" required>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection