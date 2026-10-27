<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
    <script>
        var spt_id = {{ $spt->id }};
    </script>
    <title>Submit</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group row mt-4 text-center">
                        <div class="col-md-3 col-3">
                            <a href="{!! (Request::segment(1) == 'pengajar') ? route('pengajar.pelajar.eform', ['id'=>$spt->id, 'type'=>'induk']) : route('pelajar.eform.1770.detail', ['id'=>$spt->id, 'type'=>'induk']) !!}" class="btn btn-sm btn-secondary">Sebelumnya</a>
                        </div>
                    </div>
                </div>
            </div>
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4>Error</h4> 
                    <span style="font-size: 14px">
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </span>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>
            @endif
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {!! Session::get('alert-' . $msg) !!}
                </div>
                @endif
            @endforeach

            @if($induk->jenis_lapor=='Pembukuan')
            <a href="{!! ($induk->file_laporan!='') ? url('uploads/'.$induk->file_laporan) : '#' !!}" target="_blank">Laporan Keuangan</a>
            @else
            <a href="{!! ($induk->file_rekapitulasi!='') ? url('uploads/'.$induk->file_rekapitulasi) : '#' !!}" target="_blank">Rekapitulasi Peredaran Bruto PP 23 Tahun 2018 dan/atau PP 55 Tahun 2022</a>
            @endif
            <br>
            <a href="{!! ($induk->file_bupot!='') ? url('uploads/'.$induk->file_bupot) : '#' !!}" target="_blank">Bukti Potong</a>
            <br>
            <a href="{!! ($induk->file_lainnya!='') ? url('uploads/'.$induk->file_lainnya) : '#' !!}" target="_blank">Dokumen Lampiran Lainnya</a>
            @if($induk->kurang_bayar > 0)
            <table class="table table-bordered mt-4" id="setor">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="15%">Kode MAP</th>
                        <th class="text-center align-middle" width="15%">Kode Jenis</th>
                        <th class="text-center align-middle" width="15%">Tanggal (SSP/PBK)</th>
                        <th class="text-center align-middle" width="15%">Nilai (SSP/PBK)</th>
                        <th class="text-center align-middle" width="15%">NTPN</th>
                    </tr>
                </thead>
            </table>

            <div class="form-group row text-center mt-2">
                <label class="col-md-2 col-form-label">Kurang Bayar</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="kurang" id="kurang" value="@money($induk->kurang_bayar)" disabled>
                </div>
                <label class="col-md-2 col-form-label">Jumlah Setor</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="pembayaran" id="pembayaran" value="@money($bayar)" disabled>
                </div>
            </div>
            @endif
            <br>
            @if(Request::segment(1) == 'pengajar')
            <form class="form-horizontal" method="POST"
                  action="{{ route('pengajar.pelajar.nilai', ['spt_id' => $spt->id]) }}">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Penilaian</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="jenis" required>
                            <option>Pilih Jenis Penilaian</option>
                            <option value="Project" {!! ($spt->jenis_nilai=='Project') ? 'selected' : '' !!}>Project</option>
                            <option value="Case Study" {!! ($spt->jenis_nilai=='Case Study') ? 'selected' : '' !!}>Case Study</option>
                            <option value="Tugas" {!! $spt->jenis_nilai == 'Tugas' ? 'selected' : '' !!}>Tugas</option>
                            <option value="Kuis" {!! $spt->jenis_nilai == 'Kuis' ? 'selected' : '' !!}>Kuis</option>
                            <option value="UTS" {!! $spt->jenis_nilai == 'UTS' ? 'selected' : '' !!}>UTS</option>
                            <option value="UAS" {!! $spt->jenis_nilai == 'UAS' ? 'selected' : '' !!}>UAS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nilai</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="nilai" value="{{ $spt->nilai }}" placeholder="Nilai"
                               required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right"> Simpan</button>
                <a href="{{ route('pengajar.pelajar.detail', ['id' => $spt->user_id]) }}"
                   class="btn btn-danger float-right mr-2"> Kembali</a>
            </form>
                @endif
        </div>
    </div>

    @include('components.1771.submit')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/eform/1770/pengajar/submit.js') }}"></script>
</body>

</html>
