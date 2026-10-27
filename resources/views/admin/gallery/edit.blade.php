@extends('layouts.main')

@section('title', 'Edit Event')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Event</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.gallery.update', ['gallery' => $gallery->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Kategori <span class="text-danger">*</span></label>
                    <select name="type" class="form-control" disabled>
                        <option value="">Pilih Kategori</option>
                        <option value="university" {!! ($gallery->type=='university') ? 'selected' : '' !!}>University</option>
                        <option value="brevet" {!! ($gallery->type=='brevet') ? 'selected' : '' !!}>Brevet</option>
                        <option value="short course" {!! ($gallery->type=='short course') ? 'selected' : '' !!}>Short Course</option>
                        <option value="bootcamp" {!! ($gallery->type=='bootcamp') ? 'selected' : '' !!}>Bootcamp</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Keteragan" value="{{ $gallery->name }}" required>
                </div>
                <div class="form-group">
                    <label>Gambar (Jika ingin mengubah gambar)<span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        // Initialize CKEditor
        const editors = {}; // You can also use new Map() if you use ES6.
        function createEditor( elementId ) {
            return ClassicEditor
                .create( document.getElementById( elementId ) )
                .then( editor => {
                    editors[ elementId ] = editor;
                } )
                .catch( err => console.error( err.stack ) );
        }
        createEditor('description');
        createEditor('about');
        createEditor('career');
        createEditor('earn');
        createEditor('benefit');
        createEditor('curriculum');
    </script>
{{--    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>--}}
{{--    <script>--}}
{{--	    $('#description').summernote({height: 150});--}}
{{--    </script>--}}
@endsection