@extends('layouts.main')
@section('title', 'Enrolle Pelajar')
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
      <h3 class="card-title text-capitalize">Enrolle Pelajar</h3>
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
        <form action="{{route('pengajar.storeEnrolle', ['id'=>$class_id])}}" method="POST" class="form-horizontal">
            @csrf

            <div class="table-responsive">
                <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-dark">
                    <tr class="border-0">
                        <th class="border-0 rounded-start" style="width:5%">
                            <input type="checkbox" onclick="toggle(this);" class="chk_boxes" label="check all"/>
                        </th>
                        <th class="border-0">NPWP</th>
                        <th class="border-0">Nama</th>
                        <th class="border-0">Email</th>
                    </tr>
                    </thead>
                    <div class="mt-3"></div>
                    <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-control" name="student_id[]" value="{{ $student->id }}"/>
                        </td>
                        <td>{{ $student->username }}</td>
                        <td class="text-center">{{ $student->name }}</td>
                        <td class="text-center">{{ $student->email }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <button type="submit" class="btn btn-raised btn-info btn-round waves-effect">Simpan</button>
            <a href="{{route('pengajar.kelas.detail', [$class_id])}}" class="btn btn-raised btn-danger btn-round waves-effect">Kembali</a>
        </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->

<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Kelas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('pengajar.kelas.store') }}">
      @csrf  
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Kelas</label>
          <input type="text" name="name" class="form-control" placeholder="Nama Kelas">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Kelas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="myForm">
      @csrf
      @method('PUT')
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Kelas</label>
          <input type="text" name="name" id="mname" class="form-control" placeholder="Nama Kelas">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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