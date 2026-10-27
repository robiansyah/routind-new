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
    <title>Lampiran II</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row mt-4 mb-4">
                <div class="col-md-10">
                    <a href="{!! (Request::segment(1) == 'pengajar') ? route('pengajar.pelajar.eform', ['id'=>$spt->id, 'type'=>'lampiran3']) : route('pelajar.eform.1770.detail', ['id'=>$spt->id, 'type'=>'lampiran3']) !!}" class="btn btn-sm btn-secondary">Sebelumnya</a>
                </div>
                <div class="col-md-2">
                    <a href="{!! (Request::segment(1) == 'pengajar') ? route('pengajar.pelajar.eform', ['id'=>$spt->id, 'type'=>'lampiran1']) : route('pelajar.eform.1770.detail', ['id'=>$spt->id, 'type'=>'lampiran1']) !!}" class="btn btn-sm btn-secondary">Selanjutnya</a>
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">FORMULIR</span></th>
                    <th class="text-center align-bottom">
                        <h1>1770 - II</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - II</h5>
                        <b>SPT TAHUNAN PPh WAJIB PAJAK ORANG PRIBADI</b>
                    </th>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">TAHUN PAJAK</span></th>
                    <th class="text-center align-middle" rowspan="2">
                        <h2>{{ $spt->year }}</h2>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_lapor" value="Pembukuan" {!! ($induk->jenis_lapor=='Pembukuan') ? 'checked' : '' !!} disabled>
                            <label class="form-check-label">Pembukuan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_lapor" value="Pencatatan" {!! ($induk->jenis_lapor=='Pencatatan') ? 'checked' : '' !!} disabled>
                            <label class="form-check-label">Pencatatan</label>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>KEMENTRIAN KEUANGAN RI</td>
                    <td class="border-left border-right">
                        <b class="text-center">
                            DAFTAR PEMOTONGAN/PEMUNGUTAN PPh OLEH PIHAK LAIN, <br>
                            PPh YANG DIBAYARKAN/DIPOTONG DI LUAR NEGERI DAN<br>
                            PPh DITANGGUNG PEMERINTAH
                        </b>
                    </td>
                </tr>
            </table>
            <div class="row border p-2 mb-3">
                <table class="table table-borderless">
                    <tr>
                        <td class="vertical-text border-right text-center" rowspan="6" width="10px">
                            <b style="font-size: 1rem">IDENTITAS</b>
                        </td>
                        <td class="align-middle" width="180px">NPWP</td>
                        <td><input type="text" class="form-control" name="npwp" value="{{ auth()->user()->username }}" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle">NAMA WAJIB PAJAK</td>
                        <td><input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" disabled></td>
                    </tr>
                </table>
            </div>
            <b>Bagian A : DAFTAR PEMOTONGAN/PEMUNGUTAN PPh OLEH PIHAK LAIN, PPh YANG DIBAYARKAN/DIPOTONG DI LUAR NEGERI DAN PPh DITANGGUNG PEMERINTAH</b>
            <table class="table table-bordered mt-2 mb-3" id="bupot">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px" rowspan="2">No</th>
                        <th class="text-center align-middle" rowspan="2">Nama Pemotong / Pemungut Pajak</th>
                        <th class="text-center align-middle" rowspan="2">NPWP Pemotong/Pemungut Pajak</th>
                        <th class="text-center align-middle" colspan="2">Bukti Pemotongan</th>
                        <th class="text-center align-middle" rowspan="2">Jenis Pajak : PPh Ps 21/22/23/26/DTP</th>
                        <th class="text-center align-middle" rowspan="2">Jumlah PPh yang Dipotong/pungut</th>
                    </tr>
                    <tr>
                        <th class="text-center align-middle">Nomor</th>
                        <th class="text-center align-middle">Tanggal</th>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">(1)</td>
                        <td class="text-center align-middle">(2)</td>
                        <td class="text-center align-middle">(3)</td>
                        <td class="text-center align-middle">(4)</td>
                        <td class="text-center align-middle">(5)</td>
                        <td class="text-center align-middle">(6)</td>
                        <td class="text-center align-middle">(7)</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="6">Jumlah Bagian A</th>
                        <th class="text-right p-2"></th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>

    @include('components.1770.lampiran2')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/eform/1770/pengajar/lampiran2.js') }}"></script>
</body>

</html>
