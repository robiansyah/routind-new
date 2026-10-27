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
    <title>Lampiran I</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row mt-4 mb-4">
                <div class="col-md-10">
                    <a href="{!! (Request::segment(1) == 'pengajar') ? route('pengajar.pelajar.eform', ['id'=>$spt->id, 'type'=>'lampiran2']) : route('pelajar.eform.1770.detail', ['id'=>$spt->id, 'type'=>'lampiran2']) !!}" class="btn btn-sm btn-secondary">Sebelumnya</a>
                </div>
                <div class="col-md-2">
                    <a href="{!! (Request::segment(1) == 'pengajar') ? route('pengajar.pelajar.eform', ['id'=>$spt->id, 'type'=>'lanjutan']) : route('pelajar.eform.1770.detail', ['id'=>$spt->id, 'type'=>'lanjutan']) !!}" class="btn btn-sm btn-secondary">Selanjutnya</a>
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">FORMULIR</span></th>
                    <th class="text-center align-bottom">
                        Halaman 1
                        <h1>1770 - I</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - I</h5>
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
                    <td class="border-left border-right text-center">
                        PENGHITUNGAN PENGHASILAN NETO DALAM NEGERI DARI USAHA DAN/
                        <br>ATAU PEKERJAAN BEBAS BAGI WAJIB PAJAK YANG
                        <br>MENYELENGGARAKAN PEMBUKUAN
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
            <div class="row border p-2 mt-2 mb-2">
                <table class="table table-borderless">
                    <tr>
                        <td class="align-middle pb-3" width="240px">PEMBUKUAN / LAPORAN KEUANGAN</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="audit" id="audit1" value="ya" {!! ($lampiran1->audit=='ya') ? 'checked' : '' !!} {!! ($induk->jenis_lapor=='Pencatatan') ? 'disabled' : '' !!}>
                                <label class="form-check-label">Diaudit</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="audit" id="audit2" value="tidak" {!! ($lampiran1->audit=='tidak') ? 'checked' : '' !!} {!! ($induk->jenis_lapor=='Pencatatan') ? 'disabled' : '' !!}>
                                <label class="form-check-label">Tidak Diaudit</label>
                              </div>
                        </td>
                        <td>
                            <div style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}" class="opini">
                                <a href="#" id="opini" data-type="select" data-pk="{{ $lampiran1->id }}" data-name="opini" data-value="{{ $lampiran1->opini }}" data-title="Pilih Opini"></a> &nbsp;&nbsp;Opini Akuntan
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NAMA KANTOR AKUNTAN PUBLIK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="nama_kap" value="" disabled style="{!! ($lampiran1->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="nama_kap" class="xeditable opini" data-pk="{{ $lampiran1->id }}" data-name="nama_kap" style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}"> {{ $lampiran1->nama_kap }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NPWP KANTOR AKUNTAN PUBLIK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="npwp_kap" value="" disabled style="{!! ($lampiran1->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="npwp_kap" class="xeditable opini" data-pk="{{ $lampiran1->id }}" data-name="npwp_kap" style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}"> {{ $lampiran1->npwp_kap }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NAMA AKUNTAN PUBLIK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="nama_akuntan" value="" disabled style="{!! ($lampiran1->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="nama_akuntan" class="xeditable opini" data-pk="{{ $lampiran1->id }}" data-name="nama_akuntan" style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}"> {{ $lampiran1->nama_akuntan }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NPWP AKUNTAN PUBLIK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="npwp_akuntan" value="" disabled style="{!! ($lampiran1->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="npwp_akuntan" class="xeditable opini" data-pk="{{ $lampiran1->id }}" data-name="npwp_akuntan" style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}"> {{ $lampiran1->npwp_akuntan }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NAMA KANTOR KONSULTAN PAJAK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="nama_kkp" value="" disabled style="{!! ($lampiran1->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="nama_kkp" class="xeditable opini" data-pk="{{ $lampiran1->id }}" data-name="nama_kkp" style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}"> {{ $lampiran1->nama_kkp }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NPWP KANTOR KONSULTAN PAJAK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="npwp_kkp" value="" disabled style="{!! ($lampiran1->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="npwp_kkp" class="xeditable opini" data-pk="{{ $lampiran1->id }}" data-name="npwp_kkp" style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}"> {{ $lampiran1->npwp_kkp }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NAMA KONSULTAN PAJAK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="nama_konsultan" value="" disabled style="{!! ($lampiran1->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="nama_konsultan" class="xeditable opini" data-pk="{{ $lampiran1->id }}" data-name="nama_konsultan" style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}"> {{ $lampiran1->nama_konsultan }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NPWP KONSULTAN PAJAK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="npwp_konsultan" value="" disabled style="{!! ($lampiran1->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="npwp_konsultan" class="xeditable opini" data-pk="{{ $lampiran1->id }}" data-name="npwp_konsultan" style="{!! ($lampiran1->audit=='tidak') ? 'display:none' : '' !!}"> {{ $lampiran1->npwp_konsultan }} </a>
                        </td>
                    </tr>
                </table>
            </div>
            <table class="table table-bordered mb-5">
                <tr>
                    <td width="20px"></td>
                    <td>*) Pengisian kolom-kolom yang berisi nilai rupiah harus tanpa nilai desimal</td>
                    <td class="text-center">RUPIAH *)</td>
                </tr>
                <tr>
                    <td class="text-center">(1)</td>
                    <td class="text-center">(2)</td>
                    <td class="text-center">(3)</td>
                </tr>
                <tr>
                    <td class="text-center align-middle" height="100px">1.</td>
                    <td>
                        <b>Penghasilan dari Usaha dan/atau Pekerjaan Bebas Berdasarkan Laporan Keuangan Komersial</b>
                        <ol type="a">
                            <li class="p-2">Peredaran Usaha</li>
                            <li class="p-2">Harga Pokok Penjualan</li>
                            <li class="p-2">Laba/Rugi Bruto Usaha (1a - 1b)</li>
                            <li class="p-2">Biaya Usaha</li>
                            <li class="p-2">Penghasilan Neto (1c - 1d)</li>
                        </ol>
                    </td>
                    <td width="45%">
                        <br>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;1a.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir1a" class="butir1a" value="{{ $lampiran1->butir1a }}">
                                <input type="text" class="form-control text-right pencatatan" name="1a" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir1a" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir1a }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;1b.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir1b" class="butir1b" value="{{ $lampiran1->butir1b }}">
                                <input type="text" class="form-control text-right pencatatan" name="1b" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir1b" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir1b }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;1c.</label>
                            <div class="col-md-10">
                                <input type="text" name="butir1c" id="butir1c" value="@money($lampiran1->butir1c)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;1d.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir1d" class="butir1d" value="{{ $lampiran1->butir1d }}">
                                <input type="text" class="form-control text-right pencatatan" name="1d" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir1d" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir1d }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;1e.</label>
                            <div class="col-md-10">
                                <input type="text" name="butir1e" id="butir1e" value="@money($lampiran1->butir1c)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">2.</td>
                    <td>
                        <b>Penyesuaian Fiskal Positif</b>
                        <ol type="a">
                            <li class="p-2">Biaya yang Dibebankan/Dikeluarkan untuk Kepentingan Pribadi Wajib Pajak atau Orang yang Menjadi Tanggungannya</li>
                            <li class="p-2">Premi Asuransi Kesehatan, Asuransi Kecelakaan, Asuransi Jiwa, Asuransi Dwiguna, dan Asuransi Beasiswa yang Dibayar oleh Wajib Pajak</li>
                            <li class="p-2">Penggantian atau Imbalan Sehubungan dengan Pekerjaan atau Jasa yang Diberikan dalam Bentuk Natuna atau Kenikmatan</li>
                            <li class="p-2">Jumlah yang Melebihi Kewajaran yang Dibayarkan kepada Pihak yang Mempunyai Hubungan Istimewa Sehubungan dengan Pekerjaan yang Dilakukan</li>
                            <li class="p-2">Harta yang Dihibahkan, Bantuan atau Sumbangan</li>
                            <li class="p-2">Pajak Penghasilan</li>
                            <li class="p-2">Gaji yang DIbayarkan kepada Pemilik / Orang yang Menjadi Tanggungannya</li>
                            <li class="p-2">Sanksi Administrasi</li>
                            <li class="p-2">Selisih Penyusutan / Amortisasi Komersial diatas Penyusutan / Amortisasi Fiskal</li>
                            <li class="p-2">Biaya untuk Mendapatkan, Menagih dan Memelihara Penghasilan yang Dikenakan PPh Final dan Penghasilan yang tidak Termasuk Objek Pajak</li>
                            <li class="p-2">Penyesuaian Fiskal Positif Lainnya</li>
                            <li class="p-2">Jumlah (2a sd 2k)</li>
                        </ol>
                    </td>
                    <td>
                        <br>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2a.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2a" class="butir2a" value="{{ $lampiran1->butir2a }}">
                                <input type="text" class="form-control text-right pencatatan" name="2a" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2a" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2a }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2b.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2b" class="butir2b" value="{{ $lampiran1->butir2b }}">
                                <input type="text" class="form-control text-right pencatatan" name="2b" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2b" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2b }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2c.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2c" class="butir2c" value="{{ $lampiran1->butir2c }}">
                                <input type="text" class="form-control text-right pencatatan" name="2c" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2c" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2c }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2d.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2d" class="butir2d" value="{{ $lampiran1->butir2d }}">
                                <input type="text" class="form-control text-right pencatatan" name="2d" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2d" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2d }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2e.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2e" class="butir2e" value="{{ $lampiran1->butir2e }}">
                                <input type="text" class="form-control text-right pencatatan" name="2e" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2e" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2e }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2f.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2f" class="butir2f" value="{{ $lampiran1->butir2f }}">
                                <input type="text" class="form-control text-right pencatatan" name="2f" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2f" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2f }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2g.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2g" class="butir2g" value="{{ $lampiran1->butir2g }}">
                                <input type="text" class="form-control text-right pencatatan" name="2g" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2g" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2g }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2h.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2h" class="butir2h" value="{{ $lampiran1->butir2h }}">
                                <input type="text" class="form-control text-right pencatatan" name="2h" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2h" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2h }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2i.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2i" class="butir2i" value="{{ $lampiran1->butir2i }}">
                                <input type="text" class="form-control text-right pencatatan" name="2i" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2i" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2i }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2j.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2j" class="butir2j" value="{{ $lampiran1->butir2j }}">
                                <input type="text" class="form-control text-right pencatatan" name="2j" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2j" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2j }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2k.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir2k" class="butir2k" value="{{ $lampiran1->butir2k }}">
                                <input type="text" class="form-control text-right pencatatan" name="2k" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir2k" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir2k }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2l.</label>
                            <div class="col-md-10">
                                <input type="text" name="butir2l" id="butir2l" value="@money($lampiran1->butir2l)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">3.</td>
                    <td>
                        <b>Penyesuaian Fiskal Negatif</b>
                        <ol type="a">
                            <li class="p-2">Pnghasilan yang Dikenakan PPh Final dan Penghasilan yang Tidak Termasuk Objek Pajak Tetapi Termasuk dalam Peredaran Usaha</li>
                            <li class="p-2">Selisih Penyusutan / Amortisasi Komersial di bawah Penyusutan Amortisasi Fiskal</li>
                            <li class="p-2">Penyusutan Fiskal Negatif Lainnya</li>
                            <li class="p-2">Jumlah (3a sd 3c)</li>
                        </ol>
                    </td>
                    <td>
                        <br>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;3a.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir3a" class="butir3a" value="{{ $lampiran1->butir3a }}">
                                <input type="text" class="form-control text-right pencatatan" name="3a" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir3a" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir3a }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;3b.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir3b" class="butir3b" value="{{ $lampiran1->butir3b }}">
                                <input type="text" class="form-control text-right pencatatan" name="3b" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir3b" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir3b }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;3c.</label>
                            <div class="col-md-10 text-right">
                                <input type="hidden" id="butir3c" class="butir3c" value="{{ $lampiran1->butir3c }}">
                                <input type="text" class="form-control text-right pencatatan" name="3c" value="0" disabled style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}">
                                <a href="#" class="xedit pembukuan" data-pk="{{ $lampiran1->id }}" data-name="butir3c" style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}"> {{ $lampiran1->butir3c }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;3d.</label>
                            <div class="col-md-10">
                                <input type="text" name="butir3d" id="butir3d" value="@money($lampiran1->butir3d)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">4.</td>
                    <td class="align-middle">
                        <b>Jumlah Bagian A (1e + 2l - 3d)</b>
                    </td>
                    <td>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;4</label>
                            <div class="col-md-10">
                                <input type="text" name="butir4" id="butir4" value="@money($lampiran1->butir4)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
</body>

</html>
