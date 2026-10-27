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
    <title>Lampkhus 1a</title>
</head>
<body>
    <form style="width: 130%;">
        <div class="row">
            <div class="col-md-6 offset-md-4">
                <div class="form-group row mt-4 text-center">
                    <div class="col-md-4 col-4">
                    <select name="type" class="form-control">
                        <option value="induk">Induk</option>
                        <option value="lanjutan">Induk Lanjutan</option>
                        <option value="lampiran1">Lampiran I</option>
                        <option value="lampiran2">Lampiran II</option>
                        <option value="lampiran3" selected>Lampiran III</option>
                        <option value="lampiran4">Lampiran IV</option>
                        <option value="lampiran5">Lampiran V</option>
                        <option value="lampiran6">Lampiran VI</option>
                        <option value="lampkhus1a">Lampkhus 1A</option>
                        <option value="lampkhus2a">Lampkhus 2A</option>
                    </select>
                    </div>
                    <div class="col-md-3 col-3">
                        <button class="btn btn-sm btn-secondary">Buka</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <table class="table table-borderless">
                    <tr>
                        <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">FORMULIR</span></th>
                        <th class="text-center align-bottom">
                            <h1>1771 -III</h1>
                        </th>
                        <th class="text-center border-left border-right border-bottom">
                            <h5>LAMPIRAN - III</h5>
                            <h5>SPT TAHUNAN PAJAK PENGHASILAN WAJIB PAJAK BADAN</h5>
                        </th>
                        <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">TAHUN PAJAK</span></th>
                        <th class="text-center align-middle" rowspan="2">
                            <h2>{{ $spt->year }}</h2>
                        </th>
                    </tr>
                    <tr>
                        <td>KEMENTRIAN KEUANGAN RI</td>
                        <td class="border-left border-right">
                            <h5>KREDIT PAJAK DALAM NEGERI</h5>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-10 offset-md-1 border">
                <div class="form-group row pt-3">
                    <label class="col-md-2 col-form-label">NPWP</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="{{ auth()->user()->npwp }}" disabled>
                    </div>
                    <label class="col-md-2 col-form-label">NAMA WAJIB PAJAK</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="{{ auth()->user()->profile->corporate_name }}" disabled>
                    </div>
                </div>
                <div class="form-group row pb-3">
                    <label class="col-md-2 col-form-label">Periode</label>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $induk->periode_awal }}" disabled>
                                    </div>
                                    <label class="col-md-1 col-form-label">s.d</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $induk->periode_akhir }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 mt-4">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label"><b>A. PEMOTONGAN/PEMUNGUTAN PPH PASAL 22,23/26</b></label>
                    <div class="col-md-4">     
                    </div>
                </div>
                <table class="table table-bordered" id="pemotongan">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" width="10px">No</th>
                            <th class="text-center align-middle" width="10%">Nama Pemotong/ Pemungut</th>
                            <th class="text-center align-middle" width="10%">NPWP</th>
                            <th class="text-center align-middle" width="10%">Jenis Penghasilan</th>
                            <th class="text-center align-middle" width="10%">Objek Potput (Rupiah)</th>
                            <th class="text-center align-middle" width="10%">PPH Potput</th>
                            <th class="text-center align-middle" width="10%">No Bukti</th>
                            <th class="text-center align-middle" width="10%">Tanggal Bukti</th>
                            <th class="text-center align-middle" width="10%">Alamat Pemotong/ Pemungut</th>
                            <th class="text-center align-middle" width="10%">NTPN</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="5">Jumlah PPh</th>
                            <th class="text-center p-2"></th>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/eform/1771/pengajar/lampiran3.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>