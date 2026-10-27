@extends('layouts.main')

@section('title', 'Edit Penugasan/Soal')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Penugasan/Soal</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('pengajar.soal.update', ['kelas_id'=>$class_id, 'id'=>$question->id]) }}">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Jenis SPT <span class="text-danger">*</span></label>
                    <select name="form_id" class="form-control" required>
                        <option>Pilih Jenis SPT</option>
                        @foreach($forms as $item)
                            <option value="{{ $item->id }}" {!! ($question->form_id==$item->id) ? 'selected' : '' !!}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Soal <span class="text-danger">*</span></label>
                    <textarea rows="2" name="question" id="question" class="form-control no-resize" placeholder="Soal" required>{!! $question->question !!}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipe Soal <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option>Pilih Tipe Soal</option>
                                <option value="Project" {!! ($question->type=='Project') ? 'selected' : '' !!}>Project</option>
                                <option value="Case Study" {!! ($question->type=='Case Study') ? 'selected' : '' !!}>Case Study</option>
                                <option value="Tugas" {!! ($question->type=='Tugas') ? 'selected' : '' !!}>Tugas</option>
                                <option value="Kuis" {!! ($question->type=='Kuis') ? 'selected' : '' !!}>Kuis</option>
                                <option value="UTS" {!! ($question->type=='UTS') ? 'selected' : '' !!}>UTS</option>
                                <option value="UAS" {!! ($question->type=='UAS') ? 'selected' : '' !!}>UAS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bobot Soal (%) <span class="text-danger">*</span></label>
                            <input type="number" name="weight" class="form-control" value="{{ $question->weight }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="start_date" class="form-control" value="{{ $question->start_date }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Akhir <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="end_date" class="form-control" value="{{ $question->end_date }}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan <span class="text-danger">*</span></label>
                    <textarea rows="2" name="description" id="description" class="form-control no-resize" placeholder="Keteragan" required>{!! $question->description !!}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('pengajar.kelas.detail', $class_id) }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
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
        ClassicEditor
            .create(document.querySelector('#question'))
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    </script>
@endsection