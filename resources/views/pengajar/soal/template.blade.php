@extends('layouts.main')

@section('title', 'Tambah Penugasan/Soal')
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Penugasan/Soal</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('pengajar.soal.template.store', ['kelas_id'=>$class_id]) }}">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Template Soal <span class="text-danger">*</span></label>
                    <select name="template_id" id="template_id" class="select2 form-control" required>
                            <option value="">Pilih Template Soal</option>
                        @foreach($templates as $item)
                            <option value="{{ $item->id }}">{{ $item->form->name." - ".$item->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Soal <span class="text-danger">*</span></label>
                    <div id="soal"></div>
                    <div id="assesment" class="my-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipe Soal <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option>Pilih Tipe Soal</option>
                                <option value="Project">Project</option>
                                <option value="Case Study">Case Study</option>
                                <option value="Tugas">Tugas</option>
                                <option value="Kuis">Kuis</option>
                                <option value="UTS">UTS</option>
                                <option value="UAS">UAS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bobot Soal (%)</label>
                            <input type="number" name="weight" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Akhir <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="end_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan <span class="text-danger">*</span></label>
                    <textarea rows="2" name="description" id="description" class="form-control no-resize" placeholder="Keteragan" required></textarea>
                </div>
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
@section('js')

    <!-- Select2 -->
    <script src="{{ url('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2({
          theme: 'bootstrap4'
        });
        $('#template_id').on('change', function() {
          var id = this.value;
            $.get('/pengajar/template/' + id, function (data) {
                var content = data.data.question;
                content += '<b>Penilaian</b><br>';
                data.data.assesments.forEach(function (arrayItem) {
                    content += 'Indikator : ' +arrayItem.category.name +' Jawaban : '+ arrayItem.answer +' <br>'
                });
                $('#soal').empty().append(content);
            })
        });
    </script>
@endsection