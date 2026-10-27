@extends('layouts.main')

@section('title', 'Tambah Batch')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Batch</h3>
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
        <form method="POST" action="{{ route('admin.batch.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Event <span class="text-danger">*</span></label>
                            <select name="event_id" class="form-control" required>
                                <option value="">Pilih Event</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Batch <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Batch" required>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Batas Registrasi <span class="text-danger">*</span></label>
                            <input type="date" name="registration" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link Grup WA <span class="text-danger">*</span></label>
                            <input type="text" name="link_group" class="form-control" placeholder="Link Grup" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" placeholder="Harga" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Diskon <span class="text-danger">*</span></label>
                            <input type="number" name="discount" class="form-control" placeholder="Diskon" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Kode / Akan muncul Diinvoice <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" placeholder="Contoh : B23 / BC23 / BCA23 / A23 / CAP23 (maksimal 8 karakter)" required>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.batch.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@endsection