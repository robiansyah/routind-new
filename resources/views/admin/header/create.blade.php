@extends('layouts.main')

@section('title', 'Tambah Header')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Header</h3>
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
        <form method="POST" action="{{ route('admin.header.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Nama Header <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Header" required>
                </div>
                <div class="form-group">
                    <label>Link <span class="text-danger">*</span></label>
                    <input type="text" name="link" class="form-control" placeholder="https://" required>
                </div>
                <div class="form-group">
                    <label>Logo <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" required>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.header.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection