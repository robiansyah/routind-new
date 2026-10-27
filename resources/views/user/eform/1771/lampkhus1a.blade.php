<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var spt_id = {{ $spt->id }};
    </script>
    <title>Lampkhus 1a</title>
</head>
<body>
    <form style="width: 150%;">
        <div class="row">
            <div class="col-md-6 offset-md-4">
                <div class="form-group row mt-4 text-center">
                    <div class="col-md-4 col-4">
                    <select name="type" class="form-control">
                        <option value="induk">Induk</option>
                        <option value="lanjutan">Induk Lanjutan</option>
                        <option value="lampiran1">Lampiran I</option>
                        <option value="lampiran2">Lampiran II</option>
                        <option value="lampiran3">Lampiran III</option>
                        <option value="lampiran4">Lampiran IV</option>
                        <option value="lampiran5">Lampiran V</option>
                        <option value="lampiran6">Lampiran VI</option>
                        <option value="lampkhus1a" selected>Lampkhus 1A</option>
                        <option value="lampkhus2a">Lampkhus 2A</option>
                    </select>
                    </div>
                    <div class="col-md-3 col-3">
                        <button class="btn btn-sm btn-secondary">Buka</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <h5>LAMPIRAN KHUSUS</h5>
                <h5>SPT TAHUNAN PAJAK PENGHASILAN WAJIB PAJAK BADAN</h5>
                <h6>TAHUN PAJAK {{ $spt->year }}</h6>
                <h6>DAFTAR PENYUSUTAN DAN AMORTISASI FISKAL</h6>
            </div>
            <div class="col-md-10 offset-md-1 border">
                <div class="form-group row pt-3 pb-3">
                    <label class="col-md-1 col-form-label">NPWP</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="{{ auth()->user()->npwp }}" disabled>
                    </div>
                    <label class="col-md-2 col-form-label">NAMA WAJIB PAJAK</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" value="{{ auth()->user()->profile->corporate_name }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 mt-4">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><b>I. DAFTAR PENYUSUTAN FISKAL</b></label>
                    <div class="col-md-4">     
                    </div>
                </div>
                <table class="table table-bordered data-table" id="penyusutan">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" width="10px">No</th>
                            <th class="text-center align-middle" width="9%">Jenis Harta</th>
                            <th class="text-center align-middle" width="9%">Kelompok Harta</th>
                            <th class="text-center align-middle" width="9%">Nama Harta</th>
                            <th class="text-center align-middle" width="5%">Bulan Perolehan</th>
                            <th class="text-center align-middle" width="5%">Tahun Perolehan</th>
                            <th class="text-center align-middle" width="9%">Harga Perolehan</th>
                            <th class="text-center align-middle" width="9%">Nilai Sisa Buku Fiskal Awal Tahun</th>
                            <th class="text-center align-middle" width="9%">Metode Penyusutan Komersial</th>
                            <th class="text-center align-middle" width="9%">Metode Penyusutan Fiskal</th>
                            <th class="text-center align-middle" width="9%">Penyusutan Fiskal Tahun Ini</th>
                            <th class="text-center align-middle" width="9%">Catatan</th>
                            <th class="text-center align-middle" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tr>
                        <td colspan="10" class="align-middle">Jumlah Penyusutan Fiskal</td>
                        <td>
                            <input type="text" class="form-control text-center" name="penyusutan_fiskal" id="penyusutan_fiskal" value="{!! ($penyusutan) ? number_format($penyusutan->jumlah_fiskal, 0, ',', '.') : 0 !!}" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" class="align-middle">Jumlah Penyusutan Komersial</td>
                        <td class="align-middle text-center p-2">
                            <input type="hidden" id="penyusutan_komersial" value="{{ $penyusutan->jumlah_komersial }}">
                            <a href="#" class="xedit" data-pk="{{ $penyusutan->id }}" data-name="jumlah_komersial"> @money($penyusutan->jumlah_komersial) </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" class="align-middle">Selisih Penyusutan</td>
                        <td>
                            <input type="text" class="form-control text-center" name="selisih_penyusutan" id="selisih_penyusutan" value="{!! ($penyusutan) ? number_format($penyusutan->selisih, 0, ',', '.') : 0 !!}" disabled>
                        </td>
                    </tr>
                </table>
                <button type="button"  name="tambahPenyusutan" id="tambahPenyusutan" class="btn btn-sm btn-secondary mt-2">Tambah</button>
                
            </div>
            <div class="col-md-10 offset-md-1 mt-4">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><b>II. DAFTAR AMORTISASI FISKAL</b></label>
                    <div class="col-md-4">     
                    </div>
                </div>
                <table class="table table-bordered" id="amortisasi">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" width="10px">No</th>
                            <th class="text-center align-middle" width="9%">Jenis Harta</th>
                            <th class="text-center align-middle" width="9%">Kelompok Harta</th>
                            <th class="text-center align-middle" width="9%">Nama Harta</th>
                            <th class="text-center align-middle" width="5%">Bulan Perolehan</th>
                            <th class="text-center align-middle" width="5%">Tahun Perolehan</th>
                            <th class="text-center align-middle" width="9%">Harga Perolehan</th>
                            <th class="text-center align-middle" width="9%">Nilai Sisa Buku Fiskal Awal Tahun</th>
                            <th class="text-center align-middle" width="9%">Metode Amortisasi Komersial</th>
                            <th class="text-center align-middle" width="9%">Metode Amortisasi Fiskal</th>
                            <th class="text-center align-middle" width="9%">Amortisasi Fiskal Tahun Ini</th>
                            <th class="text-center align-middle" width="9%">Catatan</th>
                            <th class="text-center align-middle" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tr>
                        <td colspan="10" class="align-middle">Jumlah Amortisasi Fiskal</td>
                        <td>
                            <input type="text" class="form-control text-center" name="amortisasi_fiskal" id="amortisasi_fiskal" value="{!! ($amortisasi) ? number_format($amortisasi->jumlah_fiskal, 0, ',', '.') : 0 !!}" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" class="align-middle">Jumlah Amortisasi Komersial</td>
                        <td class="align-middle text-center p-2">
                            <input type="hidden" id="amortisasi_komersial" value="{{ $amortisasi->jumlah_komersial }}">
                            <a href="#" class="xedit" data-pk="{{ $amortisasi->id }}" data-name="jumlah_komersial"> {{ $amortisasi->jumlah_komersial }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" class="align-middle">Selisih Amortisasi</td>
                        <td>
                            <input type="text" class="form-control text-center" name="selisih_amortisasi" id="selisih_amortisasi" value="{!! ($amortisasi) ? number_format($amortisasi->selisih, 0, ',', '.') : 0 !!}" disabled>
                        </td>
                    </tr>
                </table>
                <button type="button"  name="tambahAmortisasi" id="tambahAmortisasi" class="btn btn-sm btn-secondary mt-2">Tambah</button>
            </div>
        </div>
    </form>
    @include('components.1771.lampkhus1a')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script>$.fn.poshytip={defaults:null}</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    @if($spt->send_flag != 2)
    <script src="{{ url('disc/assets/js/custom/eform/1771/lampkhus1a.js?v=2') }}"></script>
    @else
    <script src="{{ url('disc/assets/js/custom/eform/1771/pengajar/lampkhus1a.js') }}"></script>
    @endif
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>