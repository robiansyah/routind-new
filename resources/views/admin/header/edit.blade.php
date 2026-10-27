@extends('layouts.main')

@section('title', 'Edit Header')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Header</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.header.update', ['header' => $header->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Nama Header <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Header" value="{{ $header->name }}" required>
                </div>
                <div class="form-group">
                    <label>Link <span class="text-danger">*</span></label>
                    <input type="text" name="link" class="form-control" placeholder="Link" value="{{ $header->link }}" required>
                </div>
                <div class="form-group">
                    <label>Gambar (Diisi Apabila Ingin Mengubah Gambar)</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.header.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection