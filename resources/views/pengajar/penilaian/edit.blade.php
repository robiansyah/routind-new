@extends('layouts.main')

@section('title', 'Edit Penilaian')
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
            <h3 class="card-title">Edit Penilaian</h3>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form method="POST" action="{{ route('pengajar.penilaian.update', ['soal_id'=>$question->id, 'id'=>$assesment->id]) }}">
            @method('PUT')
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
                    <input type="hidden" id="category" value="{{ $assesment->category_id }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jawaban</label>
                            <input type="text" name="answer" id="answer" value="{{ $assesment->answer }}" class="form-control">
                            <select name="option" id="option" class="form-control none"></select>
                            <input type="hidden" name="option_id" id="option_id" value="{{ $assesment->option_id }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bobot %</label>
                            <input type="number" name="weight" class="form-control" value="{{ $assesment->weight }}" required>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('pengajar.soal.detail', ['kelas_id'=>$question->class_id, 'id'=>$question->id]) }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection
@section('js')

    <script>
        $(document).ready(function () {
            var category = $('#category').val();
            var option_id = $('#option_id').val();

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
                            $('#option').val(option_id).change();
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

            $('#category_id').val(category).change();
        });

        {{--var unit = $('#unit').val();--}}
        {{--var position = $('#position').val();--}}
        {{--if(unit != ''){--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route('position.list') }}',--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--            "code": unit--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            $('#kode_jabatan').empty();--}}
        {{--            $('#kode_jabatan').append('<option value="">Pilih Jabatan</option>');--}}
        {{--            $.each(response, function (code, name) {--}}
        {{--                $('#kode_jabatan').append(new Option(name, code))--}}
        {{--            });--}}
        {{--            $('#kode_jabatan').val(position).change();--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}
    </script>
@endsection