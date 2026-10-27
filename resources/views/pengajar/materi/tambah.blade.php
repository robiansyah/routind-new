@extends('layouts.main')

@section('title', 'Tambah Materi')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Materi</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('pengajar.materi.store') }}">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label>Nama Materi <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Nama Materi" required>
            </div>
            <div class="form-group">
                <label>URL Materi <span class="text-danger">*</span></label>
                <input type="url" name="url" class="form-control" placeholder="URL Materi" required>
            </div>
            <input type="hidden" name="class_id" value="{{ $class_id }}">
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ route('pengajar.kelas.detail', $class_id) }}" class="btn btn-default">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection