@extends('layouts.main')
@section('title', 'Pelajar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')

<!-- Default box -->
<div class="card">
    <div class="card-header">
      <h3 class="card-title text-capitalize">
        <a href="{{ route('pengajar.kelas.detail', ['id'=>$kelas->class_id])}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        Detail Pelajar
    </h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
            <tbody>
            <tr>
                <td class="fw-bold">NIM</td>
                <td>{{ $kelas->nim }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Nama</td>
                <td>{{ $pelajar->name }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Email</td>
                <td>{{ $pelajar->email }}</td>
            </tr>
            <tr>
                <td class="fw-bold">No HP</td>
                <td>+62{{ $pelajar->mobile_phone }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
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
      <h3 class="card-title text-capitalize">SPT</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tbl">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Jenis SPT</th>
              <th>Tahun / Masa Pajak</th>
              <th>Pembetulan</th>
              <th>Status</th>
              <th>Jumlah</th>
              <th>Jenis Penilaian</th>
              <th>Nilai</th>
              <th width="50px">Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php $no=1; ?>
              @foreach ($spt as $item)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $item->form_code }}</td>
                  <td>
                      {{ $item->year."/".$item->start_period."-".$item->end_period }}
                  </td>
                  <td>{{ $item->correction_to }}</td>
                  <td>{!! ($item->status=='0') ? 'Nihil' : 'Kurang Bayar' !!}</td>
                  <td>{!! ($item->tax_value==null) ? 0 : number_format($item->tax_value, 0, ',', '.') !!}</td>
                  <td>{{ $item->jenis_nilai }}</td>
                  <td>{{ $item->nilai }}</td>
                  <td class="text-center">
                          <form action="{{ route('pengajar.pelajar.destroy', ['id'=>$item->id, 'type'=>'spt']) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                          @method('DELETE')
                          @csrf
                          @if($item->form_code=='1770S' || $item->form_code=='1770SS' || $item->form_code=='PPN1111' || $item->form_code=='PPH21' || $item->form_code=='PPHUNI')
                            <a href="{{ route('pengajar.pelajar.spt', ['spt_id'=>$item->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail">
                                <i class="fas fa-folder"></i>
                            </a>
                          @elseif($item->form_code=='1770' || $item->form_code=='1771')
                              <a href="{{ route('pengajar.pelajar.eform', ['id'=>$item->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail">
                                  <i class="fas fa-folder"></i>
                              </a>
                          @endif
                          <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                      </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-capitalize">Faktur</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tbl_faktur">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Faktur</th>
                <th>Kode & No Faktru</th>
                <th>Pelanggan / Pemungut</th>
                <th>DPP</th>
                <th>PPN</th>
                <th>Masa</th>
                <th>Status</th>
                <th>Status Approval</th>
                <th width="50px">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            @foreach ($invoice['keluaran'] as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Keluaran</td>
                    <td>{{ $item->transaction_code.".".$item->invoice_no }}</td>
                    <td>{{ $item->customer_name }}</td>
                    <td>{!! ($item->payment=='lunas') ? number_format($item->dpp, 0, ',', '.') : number_format($item->dpp_split, 0, ',', '.') !!}</td>
                    <td>{!! ($item->payment=='lunas') ? number_format($item->ppn, 0, ',', '.') : number_format($item->ppn_split, 0, ',', '.') !!}</td>
                    <td>{{ $item->invoice_period.'/'.$item->invoice_year }}</td>
                    <td>
                        <span class="badge badge-{!! ($item->status=='Normal') ? 'primary' : (($item->status=='Normal - Pengganti') ? 'success' : (($item->status=='Diganti') ? 'warning' : 'danger')) !!}">
                            {!! ($item->status=='Normal - Pengganti') ? 'Normal - <br> Pengganti' : $item->status !!}
                        </span>
                    </td>
                    <td><span class="badge badge-{!! ($item->approval=='Approved') ? 'primary' : 'warning' !!}">{{ $item->approval }}</span></td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.pelajar.destroy', ['id'=>$item->id, 'type'=>'keluaran']) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @foreach ($invoice['masukan'] as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Masukan</td>
                    <td>{{ $item->transaction_code.".".$item->invoice_no }}</td>
                    <td>{{ $item->collector_name }}</td>
                    <td>@money($item->dpp)</td>
                    <td>@money($item->ppn)</td>
                    <td>{{ $item->invoice_period.'/'.$item->invoice_year }}</td>
                    <td>
                        <span class="badge badge-{!! ($item->status=='Normal') ? 'primary' : 'danger' !!}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td><span class="badge badge-{!! ($item->approval=='Approved') ? 'primary' : 'warning' !!}">{{ $item->approval }}</span></td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.pelajar.destroy', ['id'=>$item->id, 'type'=>'masukan']) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @foreach ($retur['keluaran'] as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Retur Keluaran</td>
                    <td>{{ $item->retur_no }}</td>
                    <td>-</td>
                    <td>@money($item->dpp)</td>
                    <td>@money($item->ppn)</td>
                    <td>{{ $item->retur_period.'/'.$item->retur_year }}</td>
                    <td>
                        -
                    </td>
                    <td><span class="badge badge-{!! ($item->approval=='Approved') ? 'primary' : 'warning' !!}">{{ $item->approval }}</span></td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.pelajar.destroy', ['id'=>$item->id, 'type'=>'retur-keluaran']) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @foreach ($retur['masukan'] as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Retur Masukan</td>
                    <td>{{ $item->retur_no }}</td>
                    <td>-</td>
                    <td>@money($item->dpp)</td>
                    <td>@money($item->ppn)</td>
                    <td>{{ $item->retur_period.'/'.$item->retur_year }}</td>
                    <td>
                        -
                    </td>
                    <td><span class="badge badge-{!! ($item->approval=='Approved') ? 'primary' : 'warning' !!}">{{ $item->approval }}</span></td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.pelajar.destroy', ['id'=>$item->id, 'type'=>'retur-masukan']) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-capitalize">Dokumen Lainnya</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tbl_lain">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Dokumen</th>
                <th>No Dokumen</th>
                <th>Pelanggan / Pemungut</th>
                <th>DPP</th>
                <th>PPN</th>
                <th>Masa</th>
                <th>Status</th>
                <th>Status Approval</th>
                <th width="50px">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            @foreach ($other['keluaran'] as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Ekspor</td>
                    <td>{{ $item->other_no }}</td>
                    <td>{{ $item->transaction_name }}</td>
                    <td>@money($item->dpp)</td>
                    <td>@money($item->ppn)</td>
                    <td>{{ $item->other_period.'/'.$item->other_year }}</td>
                    <td>
                        <span class="badge badge-{!! ($item->status=='Normal') ? 'primary' : 'danger' !!}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td><span class="badge badge-{!! ($item->approval=='Approved') ? 'primary' : 'warning' !!}">{{ $item->approval }}</span></td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.pelajar.destroy', ['id'=>$item->id, 'type'=>'dok-keluaran']) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @foreach ($other['masukan'] as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Impor</td>
                    <td>{{ $item->other_no }}</td>
                    <td>{{ $item->transaction_name }}</td>
                    <td>@money($item->dpp)</td>
                    <td>@money($item->ppn)</td>
                    <td>{{ $item->other_period.'/'.$item->other_year }}</td>
                    <td>
                        <span class="badge badge-{!! ($item->status=='Normal') ? 'primary' : 'danger' !!}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td><span class="badge badge-{!! ($item->approval=='Approved') ? 'primary' : 'warning' !!}">{{ $item->approval }}</span></td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.pelajar.destroy', ['id'=>$item->id, 'type'=>'dok-masukan']) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-capitalize">Bupot Unifikasi</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tbl_bupot">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Kode Objek</th>
                <th>No Bupot</th>
                <th>Pelanggan / Pemungut</th>
                <th>DPP</th>
                <th>PPN</th>
                <th>Masa</th>
                <th width="50px">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            @foreach ($bupot as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->kdObjPjk }}</td>
                    <td>{{ $item->noBupot }}</td>
                    <td>{{ $item->namaDipotong }}</td>
                    <td>@money($item->jmlBruto)</td>
                    <td>@money($item->pphDipotong)</td>
                    <td>{{ $item->msPajak.'/'.$item->thnPajak }}</td>
                    <td class="text-center">
                        <form action="{{ route('pengajar.pelajar.destroy', ['id'=>$item->id, 'type'=>'bupot']) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
@section('js')

<!-- DataTables  & Plugins -->
<script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $("#tbl").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
    });
    $("#tbl_faktur").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
    });
    $("#tbl_lain").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
    });
    $("#tbl_bupot").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
    });

});
</script>
@endsection