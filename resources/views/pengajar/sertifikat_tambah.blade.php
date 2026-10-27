@extends('layouts.main')
@section('title', 'Tambah Sertifikat')
@section('content')
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get('alert-' . $msg) }}
            </div>
        @endif
    @endforeach
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-capitalize">Tambah Sertifikat</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{route('pengajar.certificate.store', ['id'=>$kelas->id])}}" method="POST" class="form-horizontal">
                @csrf

                <div class="table-responsive">
                    <div class="form-group">
                        <label>Penanda Tangan <span class="text-danger">*</span></label>
                        <select name="sign_id" class="form-control" required>
                            <option value="">Pilih Penanda Tangan</option>
                            @foreach($sign as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Desain <span class="text-danger">*</span></label>
                        <select name="design_id" class="form-control" required>
                            <option value="">Pilih Desain</option>
                            @foreach($design as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sebagai/Partisipasi <span class="text-danger">*</span></label>
                        <input type="text" name="description" class="form-control" value="Atas partisipasinya pada pelatihan" required>
                    </div>
                    <div class="form-group">
                        <label>Modul/Materi <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="Modul Simulator" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Sertifikat <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-dark">
                        <tr class="border-0">
                            <th class="border-0 rounded-start" style="width:5%">
                                <input type="checkbox" onclick="toggle(this);" class="chk_boxes" label="check all"/>
                            </th>
                            <th class="border-0">NIM</th>
                            <th class="border-0">Nama</th>
                        </tr>
                        </thead>
                        <div class="mt-3"></div>
                        <tbody>
                        @foreach($students as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="chk_boxes" name="student_id[]" value="{{ $item->student->id }}"/>
                                </td>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->student->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <button type="submit" class="btn btn-raised btn-info btn-round waves-effect">Simpan</button>
                <a href="{{route('pengajar.kelas.detail', [$kelas->id])}}" class="btn btn-raised btn-danger btn-round waves-effect">Kembali</a>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
@section('js')

    <script>
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>
@endsection