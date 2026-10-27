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
    <title>Submit</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group row mt-4 text-center">
                            <div class="col-md-3 col-3">
                                <a href="{{ route('pelajar.eform.1771', ['id'=>$spt->id, 'type'=>'lanjutan']) }}" class="btn btn-sm btn-secondary">Sebelumnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
            <form method="POST" action="{{ route('eform.submit', ['id'=>$spt->id]) }}" enctype="multipart/form-data">
                @csrf

                <label>Laporan Keuangan</label>
                <input type="file" name="file_laporan" class="form-control-file" disabled>
                <small class="form-text text-muted">
                File yang diupload berjenis pdf, ukuran max 2MB
                </small>
                <br>
                <label>Rekapitulasi Peredaran Bruto PP 23 Tahun 2018 dan/atau PP 55 Tahun 2022</label>
                <input type="file" name="file_rekapitulasi" class="form-control-file" disabled>
                <small class="form-text text-muted">
                File yang diupload berjenis pdf, ukuran max 2MB
                </small>
                <br>
                <label>Daftar Nominatif Biaya Promosi dan/atau Biaya Entertainment</label>
                <input type="file" name="file_nominatif" class="form-control-file" disabled>
                <small class="form-text text-muted">
                File yang diupload berjenis pdf, ukuran max 2MB
                </small>
                <br>
                <label>Dokumen-dokumen Lampiran Khusus BUT</label>
                <input type="file" name="file_but" class="form-control-file" disabled>
                <small class="form-text text-muted">
                File yang diupload berjenis pdf, ukuran max 2MB
                </small>
                <br>
                <label>Dokumen-dokumen Lampiran Khusus WP Migas</label>
                <input type="file" name="file_migas" class="form-control-file" disabled>
                <small class="form-text text-muted">
                File yang diupload berjenis pdf, ukuran max 2MB
                </small>
                <br>
                <label>Laporan Perbandingan Utang-Modal dan Laporan Utang Swasta Luar Negri</label>
                <input type="file" name="file_perbandingan" class="form-control-file" disabled>
                <small class="form-text text-muted">
                File yang diupload berjenis pdf, ukuran max 2MB
                </small>
                <br>
                <label>Dokumen Lampiran Lainnya</label>
                <input type="file" name="file_lainnya" class="form-control-file" disabled>
                <small class="form-text text-muted">
                File yang diupload berjenis pdf, ukuran max 2MB
                </small>
                @if($induk->kurang_bayar > 0)
                <table class="table table-bordered mt-4" id="setor">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" width="10px">No</th>
                            <th class="text-center align-middle" width="15%">Kode MAP</th>
                            <th class="text-center align-middle" width="15%">Kode Jenis</th>
                            <th class="text-center align-middle" width="15%">Tanggal (SSP/PBK)</th>
                            <th class="text-center align-middle" width="15%">Jumlah Bayar</th>
                            <th class="text-center align-middle" width="15%">NTPN</th>
                            <th class="text-center align-middle" width="20px">Aksi</th>
                        </tr>
                    </thead>
                </table>
                <button type="button"  name="tambahSetor" id="tambahSetor" class="btn btn-sm btn-secondary mt-2 mb-5">Tambah</button>
                
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
                <h6 id="kurang_bayar" class="text-danger text-center"></h6>
                @endif
                <br>
                <input type="hidden" name="spt_id" value="{{ $spt->id }}">
                @if($spt->send_flag != 2)
                <div class="form-group row text-center mt-2">
                    <div class="col-md-1">
                        <button type="submit" id="submit" class="btn btn-sm btn-primary">Submit</button><br><br>
                    </div>
                    <label class="col-md-8 col-form-label text-left"><h6>Silakan klik submit apabila anda yakin data telah terinput dengan benar.</h6></label>
                </div>
                @endif
            </form>
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
    @if($spt->send_flag != 2)
    <script src="{{ url('disc/assets/js/custom/eform/1771/submit.js') }}"></script>
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
