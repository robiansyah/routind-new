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
    <title>Lampiran IV</title>
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
                                <option value="lampiran4" selected>Lampiran IV</option>
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
                </div>
            </form>
            <table class="table table-borderless">
                <tr>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">FORMULIR</span></th>
                    <th class="text-center align-bottom">
                        <h1>1771 -IV</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - IV</h5>
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
                        PPh FINAL DAN PENGHASILAN YANG TIDAK TERMASUK OBJEK PAJAK
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
            <b>BAGIAN A : PPh FINAL</b>
            <table class="table table-bordered">
                <tr>
                    <th class="text-center align-middle">NO</th>
                    <th class="text-center align-middle">JENIS PENGHASILAN</th>
                    <th class="text-center align-middle">DASAR PENGENAAN PAJAK (Rupiah)</th>
                    <th class="text-center align-middle">TARIF (%)</th>
                    <th class="text-center align-middle">PPH TERUTANG (Rupiah)</th>
                </tr>
                <tr>
                    <td class="text-center">(1)</td>
                    <td class="text-center">(2)</td>
                    <td class="text-center">(3)</td>
                    <td class="text-center">(4)</td>
                    <td class="text-center">(5)</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">1.</td>
                    <td class="align-middle">BUNGA DEPOSITO / TABUNGAN DAN DISKONTO SBI / SBN</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_deposito"> {{ $lampiran4a->pjk_deposito }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_deposito"> {{ $lampiran4a->ph_deposito }} </a>
                    </td>
                    <td>
                        <input type="text" name="deposito" id="deposito" value="@money(($lampiran4a->pjk_deposito*$lampiran4a->ph_deposito)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">2.</td>
                    <td class="align-middle">BUNGA / DISKONTO OBLIGASI</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_obligasi"> {{ $lampiran4a->pjk_obligasi }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_obligasi"> {{ $lampiran4a->ph_obligasi }} </a>
                    </td>
                    <td>
                        <input type="text" name="obligasi" id="obligasi" value="@money(($lampiran4a->pjk_obligasi*$lampiran4a->ph_obligasi)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">3.</td>
                    <td class="align-middle">PENGHASILAN PENJUALAN SAHAM YANG DIPERDAGANGKAN DI BURSA EFEK</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_bursa"> {{ $lampiran4a->pjk_bursa }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_bursa"> {{ $lampiran4a->ph_bursa }} </a>
                    </td>
                    <td>
                        <input type="text" name="bursa" id="bursa" value="@money(($lampiran4a->pjk_bursa*$lampiran4a->ph_bursa)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">4.</td>
                    <td class="align-middle">PENGHASILAN PENJUALAN SAHAM MILIK PERUSAHAAN MODAL VENTURA</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_ventura"> {{ $lampiran4a->pjk_ventura }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_ventura"> {{ $lampiran4a->ph_ventura }} </a>
                    </td>
                    <td>
                        <input type="text" name="ventura" id="ventura" value="@money(($lampiran4a->pjk_ventura*$lampiran4a->ph_ventura)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">5.</td>
                    <td class="align-middle">PENGHASILAN USAHA PENYALUR / DEALER / AGEN PRODUK BBM</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_bbm"> {{ $lampiran4a->pjk_bbm }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_bbm"> {{ $lampiran4a->ph_bbm }} </a>
                    </td>
                    <td>
                        <input type="text" name="bbm" id="bbm" value="@money(($lampiran4a->pjk_bbm*$lampiran4a->ph_bbm)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">6.</td>
                    <td class="align-middle">PENGHASILAN PENGALIHAN HAK ATAS TANAH / BANGUNAN</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_pengalihan"> {{ $lampiran4a->pjk_pengalihan }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_pengalihan"> {{ $lampiran4a->ph_pengalihan }} </a>
                    </td>
                    <td>
                        <input type="text" name="pengalihan" id="pengalihan" value="@money(($lampiran4a->pjk_pengalihan*$lampiran4a->ph_pengalihan)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">7.</td>
                    <td class="align-middle">PENGHASILAN PERSEWAAN ATAS TANAH / BANGUNAN</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_persewaan"> {{ $lampiran4a->pjk_persewaan }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_persewaan"> {{ $lampiran4a->ph_persewaan }} </a>
                    </td>
                    <td>
                        <input type="text" name="persewaan" id="persewaan" value="@money(($lampiran4a->pjk_persewaan*$lampiran4a->ph_persewaan)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle p-2">8.</td>
                    <td class="align-middle">IMBALAN JASA KONSTRUKSI :</td>
                    <td colspan="3" class="bg-secondary">&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">8a.</td>
                    <td class="align-middle">PELAKSANA KONSTRUKSI</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_pelaksana"> {{ $lampiran4a->pjk_pelaksana }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_pelaksana"> {{ $lampiran4a->ph_pelaksana }} </a>
                    </td>
                    <td>
                        <input type="text" name="pelaksana" id="pelaksana" value="@money(($lampiran4a->pjk_pelaksana*$lampiran4a->ph_pelaksana)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">8b.</td>
                    <td class="align-middle">PERENCANA KONSTRUKSI</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_perencana"> {{ $lampiran4a->pjk_perencana }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_perencana"> {{ $lampiran4a->ph_perencana }} </a>
                    </td>
                    <td>
                        <input type="text" name="perencana" id="perencana" value="@money(($lampiran4a->pjk_perencana*$lampiran4a->ph_perencana)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">8c.</td>
                    <td class="align-middle">PENGAWAS KONSTRUKSI</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_pengawas"> {{ $lampiran4a->pjk_pengawas }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_pengawas"> {{ $lampiran4a->ph_pengawas }} </a>
                    </td>
                    <td>
                        <input type="text" name="pengawas" id="pengawas" value="@money(($lampiran4a->pjk_pengawas*$lampiran4a->ph_pengawas)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">9.</td>
                    <td class="align-middle">PERWAKILAN DAGANG ASING</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_dagang_asing"> {{ $lampiran4a->pjk_dagang_asing }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_dagang_asing"> {{ $lampiran4a->ph_dagang_asing }} </a>
                    </td>
                    <td>
                        <input type="text" name="dagang_asing" id="dagang_asing" value="@money(($lampiran4a->pjk_dagang_asing*$lampiran4a->ph_dagang_asing)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">10.</td>
                    <td class="align-middle">PELAYARAN / PENERBANGAN ASING</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_pelayaran_asing"> {{ $lampiran4a->pjk_pelayaran_asing }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_pelayaran_asing"> {{ $lampiran4a->ph_pelayaran_asing }} </a>
                    </td>
                    <td>
                        <input type="text" name="pelayaran_asing" id="pelayaran_asing" value="@money(($lampiran4a->pjk_pelayaran_asing*$lampiran4a->ph_pelayaran_asing)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">11.</td>
                    <td class="align-middle">PELAYARAN DALAM NEGERI</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_pelayaran"> {{ $lampiran4a->pjk_pelayaran }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_pelayaran"> {{ $lampiran4a->ph_pelayaran }} </a>
                    </td>
                    <td>
                        <input type="text" name="pelayaran" id="pelayaran" value="@money(($lampiran4a->pjk_pelayaran*$lampiran4a->ph_pelayaran)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">12.</td>
                    <td class="align-middle">PENILAIAN KEMBALI AKTIVA TETAP</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_aktiva"> {{ $lampiran4a->pjk_aktiva }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_aktiva"> {{ $lampiran4a->ph_aktiva }} </a>
                    </td>
                    <td>
                        <input type="text" name="aktiva" id="aktiva" value="@money(($lampiran4a->pjk_aktiva*$lampiran4a->ph_aktiva)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">13.</td>
                    <td class="align-middle">TRANSAKSI DERIVATIF YANG DIPERDAGANGKAN DI BURSA</td>
                    <td class="align-middle text-center">
                        <a href="#" class="xedit" data-pk="{{ $lampiran4a->id }}" data-name="pjk_derivatif"> {{ $lampiran4a->pjk_derivatif }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="xpph" data-pk="{{ $lampiran4a->id }}" data-name="ph_derivatif"> {{ $lampiran4a->ph_derivatif }} </a>
                    </td>
                    <td>
                        <input type="text" name="derivatif" id="derivatif" value="@money(($lampiran4a->pjk_derivatif*$lampiran4a->ph_derivatif)/100)" class="form-control text-right" disabled>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle text-center"><b>JUMLAH</b></td>
                    <td><input type="text" name="terutang" id="terutang" value="@money($lampiran4a->terutang)" class="form-control text-right" disabled></td>
                </tr>
            </table>
            <br><span>14. JENIS PENGHASILAN LAINNYA
            <table class="table table-bordered mt-2 mb-3" id="penghasilan">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="21%">Jenis Penghasilan</th>
                        <th class="text-center align-middle" width="21%">Dasar Pengenaan Pajak (Rupiah)</th>
                        <th class="text-center align-middle" width="21%">Tarif (%)</th>
                        <th class="text-center align-middle" width="21%">PPH Terutang</th>
                        <th class="text-center align-middle" width="20px">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Jumlah PPh Terutang</th>
                        <th class="text-right p-2"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <button type="button"  name="tambahPenghasilan" id="tambahPenghasilan" class="btn btn-sm btn-secondary mt-2 mb-5">Tambah</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group row mt-2">
                        <label class="col-md-6 text-right mt-2"><b>Bagian A</b></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control text-right" name="total_a" id="total_a" value="@money($lampiran4a->total)" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <br><b>BAGIAN B : PENGHASILAN YANG TIDAK TERMASUK OBJEK PAJAK</b>
            <table class="table table-bordered mt-2">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center" width="50%">JENIS PENGHASILAN</th>
                    <th class="text-center" width="45%">PENGHASILAN BRUTO (Rupiah)</th>
                </tr>
                <tr>
                    <td class="text-center">(1)</td>
                    <td class="text-center">(2)</td>
                    <td class="text-center">(3)</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">1.</td>
                    <td class="align-middle">BANTUAN / SUMBANGAN</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran4b->id }}" data-name="bantuan"> {{ $lampiran4b->bantuan }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">2.</td>
                    <td class="align-middle">HIBAH</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran4b->id }}" data-name="hibah"> {{ $lampiran4b->hibah }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">3.</td>
                    <td>DIVIDEN / BAGIAN LABA DARI PENYERTAAN MODAL PADA BADAN USAHA DI INDONESIA (Pasal 4 Ayat (3) Huruf f UU PPh)</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran4b->id }}" data-name="dividen"> {{ $lampiran4b->dividen }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">4.</td>
                    <td>IURAN DAN PENGHASILAN TERTENTU YANG DITERIMA DANA PENSIUN</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran4b->id }}" data-name="iuran"> {{ $lampiran4b->iuran }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">5.</td>
                    <td>BAGIAN LABA YANG DITERIMA PERUSAHAAN MODAL VENTURA DARI BADAN PASANGAN USAHA</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran4b->id }}" data-name="laba"> {{ $lampiran4b->laba }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">6.</td>
                    <td>SISA LEBIH YANG DITERIMA ATAU DIPEROLEH BADAN ATAU LEMBAGA NIRLABA YANG BERGERAK DALAM BIDANG PENDIDIKAN DAN/ATAU BIDANG PENELITIAN DAN PENGEMBANGAN, YANG TELAH TERDAFTAR PADA INSTANSI YANG MEMBIDANGINYA, YANG DITANAMKAN KEMBALI DALAM BENTUK SARANA DAN PRASARANA KEGIATAN PENDIDIKAN DAN/ATAU PENELITIAN DAN PENGEMBANGAN (Pasal 4 Ayat (3) Huruf m UU PPh)"											
                    </td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran4b->id }}" data-name="sisa"> {{ $lampiran4b->sisa }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2"><b>JUMLAH BAGIAN B	(JBB)</b></td>
                    <td><input type="text" name="jbb" id="jbb" value="@money($lampiran4b->jumlah)" class="form-control text-right" disabled></td>
                </tr>
            </table>
            <br><span>7. JENIS PENGHASILAN LAINNYA</span>
            <table class="table table-bordered mt-2 mb-3" id="lainnya">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="50%">Jenis Penghasilan</th>
                        <th class="text-center align-middle" width="35%">Penghasilan Bruto (Rupiah)</th>
                        <th class="text-center align-middle" width="40px">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="2">Jumlah Penghasilan Bruto</th>
                        <th class="text-right p-2"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <button type="button"  name="tambahLainnya" id="tambahLainnya" class="btn btn-sm btn-secondary mt-2 mb-5">Tambah</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group row mt-2">
                        <label class="col-md-6 text-right mt-2"><b>Bagian B</b></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control text-right" name="total_b" id="total_b" value="@money($lampiran4b->total)" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.1771.lampiran4')
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
    <script src="{{ url('disc/assets/js/custom/eform/1771/lampiran4.js') }}"></script>
    @else
    <script src="{{ url('disc/assets/js/custom/eform/1771/pengajar/lampiran4.js') }}"></script>
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
