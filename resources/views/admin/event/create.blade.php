@extends('layouts.main')

@section('title', 'Tambah Event')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Event</h3>
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
        <form method="POST" action="{{ route('admin.event.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Kategori <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="Judul" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi <span class="text-danger">*</span></label>
                    <textarea rows="2" name="description" id="description" class="form-control no-resize" placeholder="Deskripsi"></textarea>
                </div>
                <div class="form-group">
                    <label>Tentang <span class="text-danger">*</span></label>
                    <textarea rows="2" name="about" id="about" class="form-control no-resize" placeholder="Tentang"></textarea>
                </div>
                <div class="form-group">
                    <label>Prospek Karir <span class="text-danger">*</span></label>
                    <textarea rows="2" name="career" id="career" class="form-control no-resize" placeholder="Prospek Karir"></textarea>
                </div>
                <div class="form-group">
                    <label>Yang bisa kamu dapatkan <span class="text-danger">*</span></label>
                    <textarea rows="2" name="earn" id="earn" class="form-control no-resize" placeholder="Yang bisa kamu dapatkan"></textarea>
                </div>
                <div class="form-group">
                    <label>Benefit <span class="text-danger">*</span></label>
                    <textarea rows="2" name="benefit" id="benefit" class="form-control no-resize" placeholder="Benefit"></textarea>
                </div>
                <div class="form-group">
                    <label>Kurikulum dan Silabus <span class="text-danger">*</span></label>
                    <textarea rows="2" name="curriculum" id="curriculum" class="form-control no-resize" placeholder="Kurikulum dan Silabus"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gambar <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" placeholder="Harga" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lokasi <span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control" placeholder="Lokasi" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="show">Show</option>
                                <option value="hide">Hide</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.event.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection
@section('js')

    <!-- Include CKEditor 5 from CDN -->
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