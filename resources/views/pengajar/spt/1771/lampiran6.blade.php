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
    <title>Lampiran VI</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form>
                <div class="row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-group row mt-4 text-center">
                            <div class="col-md-6 col-6">
                            <select name="type" class="form-control">
                                <option value="induk">Induk</option>
                                <option value="lanjutan">Induk Lanjutan</option>
                                <option value="lampiran1">Lampiran I</option>
                                <option value="lampiran2">Lampiran II</option>
                                <option value="lampiran3">Lampiran III</option>
                                <option value="lampiran4">Lampiran IV</option>
                                <option value="lampiran5">Lampiran V</option>
                                <option value="lampiran6" selected>Lampiran VI</option>
                                <option value="lampkhus1a">Lampkhus 1A</option>
                                <option value="lampkhus2a">Lampkhus 2A</option>
                            </select>
                            </div>
                            <div class="col-md-3 col-3">
                                <button class="btn btn-sm btn-secondary">Buka</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-borderless">
                <tr>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">FORMULIR</span></th>
                    <th class="text-center align-bottom">
                        <h1>1771 -VI</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - VI</h5>
                        <b>SPT TAHUNAN PAJAK PENGHASILAN WAJIB PAJAK BADAN</b>
                    </th>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">TAHUN PAJAK</span></th>
                    <th class="text-center align-middle" rowspan="2">
                        <h2>{{ $spt->year }}</h2>
                    </th>
                </tr>
                <tr>
                    <td>KEMENTRIAN KEUANGAN RI</td>
                    <td class="border-left border-right">
                        <ul>
                            <li>DAFTAR PENYERTAAN MODAL PADA PERUSAJAAN AFILIASI</li>
                            <li>DAFTAR UTANG DARI PEMEGANG SAHAM DAN/ATAU PERUSAHAAN AFILIASI</li>
                            <li>DAFTAR PIUTANG KEPADA PEMEGANG SAHAM DAN/ATAU PERUSAHAAN AFILIASI</li>
                        </ul>
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
                        <td><input type="text" class="form-control" name="npwp" value="{{ auth()->user()->npwp }}" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle">NAMA WAJIB PAJAK</td>
                        <td><input type="text" class="form-control" name="name" value="{{ auth()->user()->profile->corporate_name }}" disabled></td>
                    </tr>
                    <tr>
                        <td class="pt-2">PERIODE PEMBUKUAN</td>
                        <td>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" value="{{ $induk->periode_awal }}" disabled>
                                        </div>
                                        <label class="col-md-1 col-form-label">s.d</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" value="{{ $induk->periode_akhir }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <b>BAGIAN A : DAFTAR PENYERTAAN MODAL PADA PERUSAHAAN AFILIASI</b>
            <table class="table table-bordered mt-2 mb-3" id="modal">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="16%">Nama</th>
                        <th class="text-center align-middle" width="16%">Alamat</th>
                        <th class="text-center align-middle" width="16%">NPWP</th>
                        <th class="text-center align-middle" width="16%">Rupiah</th>
                        <th class="text-center align-middle" width="16%">% (Persen)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="4">Jumlah Penyertaan Modal</th>
                        <th class="text-right p-2"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>

            <br><b>BAGIAN B : DAFTAR UTANG DARI PEMEGANG SAHAM DAN/ATAU PERUSAHAAN AFILIASI</b>
            <table class="table table-bordered mt-2 mb-3" id="utang">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="16%">Nama</th>
                        <th class="text-center align-middle" width="16%">NPWP</th>
                        <th class="text-center align-middle" width="16%">Jumlah Pinjaman</th>
                        <th class="text-center align-middle" width="16%">Tahun</th>
                        <th class="text-center align-middle" width="16%">% Bunga/Tahun</th>
                    </tr>
                </thead>
            </table>

            <br><b>BAGIAN C : DAFTAR PIUTANG KEPADA PEMEGANG SAHAM DAN/ATAU PERUSAHAAN AFILIASI</b>
            <table class="table table-bordered mt-2 mb-3" id="piutang">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="16%">Nama</th>
                        <th class="text-center align-middle" width="16%">NPWP</th>
                        <th class="text-center align-middle" width="16%">Jumlah Pinjaman</th>
                        <th class="text-center align-middle" width="16%">Tahun</th>
                        <th class="text-center align-middle" width="16%">% Bunga/Tahun</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('components.1771.lampiran6')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('disc/assets/js/custom/eform/1771/pengajar/lampiran6.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
