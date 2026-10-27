@extends('layouts.main')

@section('title', 'Edit Materi')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Materi</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('pengajar.materi.update', ['materi'=>$materi->id]) }}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label>Nama Materi <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ $materi->name }}" class="form-control" placeholder="Nama Materi" required>
                </div>
                <div class="form-group">
                    <label>URL Materi <span class="text-danger">*</span></label>
                    <input type="url" name="url" value="{{ $materi->url }}" class="form-control" placeholder="URL Materi" required>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('pengajar.kelas.detail', $materi->class_id) }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection