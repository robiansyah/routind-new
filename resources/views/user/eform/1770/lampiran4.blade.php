<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var spt_id = {{ $spt->id }};
    </script>
    <title>Lampiran IV</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row mt-4 mb-4">
                <div class="col-md-10">
                    <a href="{{ route('pelajar.spt.draf') }}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left fa-sm" aria-hidden="true"></i> Draf</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('pelajar.eform.1770', ['id'=>$spt->id, 'type'=>'lampiran3']) }}" class="btn btn-sm btn-secondary">Selanjutnya</a>
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                    <th class="text-center align-middle" rowspan="2">
                        <span style="font-size: 1rem">FORMULIR</span>
                        <h1>1770 - IV</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - IV</h5>
                        <b>SPT TAHUNAN PPh WAJIB PAJAK ORANG PRIBADI</b>
                    </th>
                    <th class="text-center align-middle" rowspan="2">
                        <span style="font-size: 1rem">TAHUN PAJAK</span>
                        <h2>{{ $spt->year }}</h2>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_lapor" value="Pembukuan" {!! ($induk->jenis_lapor=='Pembukuan') ? 'checked' : '' !!}>
                            <label class="form-check-label">Pembukuan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_lapor" value="Pencatatan" {!! ($induk->jenis_lapor=='Pencatatan') ? 'checked' : '' !!}>
                            <label class="form-check-label">Pencatatan</label>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td class="border-left border-right">
                        <ul>
                            <li>HARTA PADA AKHIR TAHUN</li>
                            <li>KEWAJIBAN/UTANG PADA AKHIR TAHUN</li>
                            <li>DAFTAR SUSUNAN ANGGOTA KELUARGA</li>
                        </ul>
                    </td>
                </tr>
            </table>
            <div class="row border p-2 mb-3">
                <table class="table table-borderless">
                    <tr>
                        <td colspan="2"><b style="font-size: 1rem">IDENTITAS</b></td>
                    </tr>
                    <tr>
                        <td class="align-middle" width="180px">NPWP</td>
                        <td><input type="text" class="form-control" name="npwp" value="{{ auth()->user()->username }}" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle">NAMA WAJIB PAJAK</td>
                        <td><input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" disabled></td>
                    </tr>
                </table>
            </div>
            <b>Bagian A : Harta Pada Akhir Tahun</b>
            <table class="table table-bordered mt-2 mb-3" id="harta">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="16%">Kode Harta</th>
                        <th class="text-center align-middle" width="16%">Nama Harta</th>
                        <th class="text-center align-middle" width="16%">Tahun Perolehan</th>
                        <th class="text-center align-middle" width="16%">Harga Perolehan</th>
                        <th class="text-center align-middle" width="16%">Keterangan</th>
                        <th class="text-center align-middle" width="20px">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="4">Jumlah Bagian A</th>
                        <th class="text-right p-2"></th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
            <button type="button"  name="tambahHarta" id="tambahHarta" class="btn btn-sm btn-secondary mt-2 mb-5">Tambah</button>

            <br><b>Bagian B: Kewajiban/Utang Pada Akhir Tahun</b>
            <table class="table table-bordered mt-2 mb-3" id="utang">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="16%">Kode Utang</th>
                        <th class="text-center align-middle" width="16%">Nama Pemberi Pinjaman</th>
                        <th class="text-center align-middle" width="16%">Alamat Pemberi Pinjaman</th>
                        <th class="text-center align-middle" width="16%">Tahun Peminjaman</th>
                        <th class="text-center align-middle" width="16%">Jumlah Peminjaman</th>
                        <th class="text-center align-middle" width="20px">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="5">Jumlah Bagian B</th>
                        <th class="text-right p-2"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <button type="button"  name="tambahUtang" id="tambahUtang" class="btn btn-sm btn-secondary mt-2 mb-5">Tambah</button>

            <br><b>Bagian C: Daftar Susunan Anggota Keluarga</b>
            <table class="table table-bordered mt-2 mb-3" id="keluarga">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="20%">Nama Anggota Keluarga</th>
                        <th class="text-center align-middle" width="20%">NIK</th>
                        <th class="text-center align-middle" width="20%">Hubungan</th>
                        <th class="text-center align-middle" width="20%">Pekerjaan</th>
                        <th class="text-center align-middle" width="20px">Aksi</th>
                    </tr>
                </thead>
            </table>
            <button type="button"  name="tambahKeluarga" id="tambahKeluarga" class="btn btn-sm btn-secondary mt-2 mb-5">Tambah</button>
        </div>
    </div>

    @include('components.1770.lampiran4')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/eform/1770/lampiran4.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
