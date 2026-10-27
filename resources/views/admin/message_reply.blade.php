@extends('layouts.main')
@section('title', 'Balas Pesan')
@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <div class="col-md-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Balas Pesan</h3>
            </div>
            <form method="POST" action="{{ route('admin.message.update', ['id'=>$data->id]) }}">
            <div class="card-body">
                <div class="form-group">
                    <input type="email" name="email" value="{{ $data->email }}" class="form-control" placeholder="To:">
                </div>
                <div class="form-group">
                    <input type="text" name="subject" value="Re: {{ $data->subject }}" class="form-control" placeholder="Subject:">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="reply" class="form-control">{{ $data->message }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                </div>
                <a href="{{ route('admin.message') }}" class="btn btn-default"><i class="fas fa-times"></i> Discard</a>
            </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('js')
    <!-- Summernote -->
    <script src="{{ url('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
    $(function () {
        //Add text editor
        $('#compose-textarea').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 250
        });
    })
    </script>
@endsection