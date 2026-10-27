@extends('layouts.main')

@section('title', 'Tambah Penilaian')
@section('css')
    <style>
        .none {
            display: none;
        }
    </style>
@endsection
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Penilaian</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('pengajar.penilaian.store', ['soal_id'=>$question->id]) }}">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Penilaian <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option>Pilih Penilaian</option>
                        @foreach($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jawaban</label>
                            <input type="text" name="answer" id="answer" class="form-control">
                            <select name="option" id="option" class="form-control none"></select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bobot %</label>
                            <input type="number" name="weight" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('pengajar.soal.detail', ['kelas_id'=>$question->class_id, 'id'=>$question->id]) }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection
@section('js')

    <script>
        $('#category_id').on('change', function () {
            $.ajax({
                url: '{{ route('pengajar.penilaian') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": $(this).val()
                },
                success: function (response) {
                    if(response.code==1){
                        $("#option").show();
                        $("#option").attr('required', '');
                        $("#answer").hide();
                        $("#answer").val('');
                        $("#answer").removeAttr('required');

                        $('#option').empty();
                        $('#option').append('<option value="">Pilih Jawaban</option>');
                        $.each(response.data, function (id, name) {
                            $('#option').append(new Option(name, id))
                        });
                    }else{
                        $("#answer").show();
                        $("#answer").attr('required', '');
                        $("#option").hide();
                        $("#option").val('').change();
                        $("#option").removeAttr('required');
                    }
                }
            })
        });
    </script>
@endsection