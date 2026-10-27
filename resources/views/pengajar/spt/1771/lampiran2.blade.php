<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
    <title>Lampiran II</title>
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
                        <option value="lampiran2" selected>Lampiran II</option>
                        <option value="lampiran3">Lampiran III</option>
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
                            <h1>1771 -II</h1>
                        </th>
                        <th class="text-center border-left border-right border-bottom">
                            <h5>LAMPIRAN - II</h5>
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
                            <h5>PERINCIAN HARGA POKOK PENJUALAN, BIAYA USAHA LAINNYA DAN BIAYA DARI LUAR USAHA SECARA KOMERSIL</h5>
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
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="19%">Perincian</th>
                        <th class="text-center align-middle" width="19%">Harga Pokok Penjualan (Rupiah)</th>
                        <th class="text-center align-middle" width="19%">Biaya Usaha Lainnya</th>
                        <th class="text-center align-middle" width="19%">Biaya Dari Luar Usaha (Rupiah)</th>
                        <th class="text-center align-middle" width="19%">Jumlah (Rupiah)</th>
                    </tr>
                    <tr>
                        <td class="text-center">(1)</td>
                        <td class="text-center">(2)</td>
                        <td class="text-center">(3)</td>
                        <td class="text-center">(4)</td>
                        <td class="text-center">(5)</td>
                        <td class="text-center">(6) = (3) + (4) + (5)</td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">1</td>
                        <td class="align-middle">Pembelian Bahan / Barang Dagangan</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_barang)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_barang)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_barang)
                        </td>
                        <td>
                            <input type="text" name="jumlah_barang" id="jumlah_barang" value="@money($lampiran2->jumlah_barang)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">2</td>
                        <td class="align-middle">Gaji, Upah, Bonus, Gratifikasi, Honorarium, THR, Dsb</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_gaji)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_gaji)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_gaji)
                        </td>
                        <td>
                            <input type="text" name="jumlah_gaji" id="jumlah_gaji" value="@money($lampiran2->jumlah_gaji)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">3</td>
                        <td class="align-middle">Biaya Transportasi</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_transportasi)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_transportasi)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_transportasi)
                        </td>
                        <td>
                            <input type="text" name="jumlah_transportasi" id="jumlah_transportasi" value="@money($lampiran2->jumlah_transportasi)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">4</td>
                        <td class="align-middle">Biaya Penyusutan dan Amortisasi</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_penyusutan)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_penyusutan)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_penyusutan)
                        </td>
                        <td>
                            <input type="text" name="jumlah_penyusutan" id="jumlah_penyusutan" value="@money($lampiran2->jumlah_penyusutan)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">5</td>
                        <td class="align-middle">Biaya Sewa</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_sewa)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_sewa)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_sewa)
                        </td>
                        <td>
                            <input type="text" name="jumlah_sewa" id="jumlah_sewa" value="@money($lampiran2->jumlah_sewa)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">6</td>
                        <td class="align-middle">Biaya Bunga Pinjaman</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_bunga)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_bunga)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_bunga)
                        </td>
                        <td>
                            <input type="text" name="jumlah_bunga" id="jumlah_bunga" value="@money($lampiran2->jumlah_bunga)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">7</td>
                        <td class="align-middle">Biaya Sehubungan dengan Jasa</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_jasa)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_jasa)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_jasa)
                        </td>
                        <td>
                            <input type="text" name="jumlah_jasa" id="jumlah_jasa" value="@money($lampiran2->jumlah_jasa)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">8</td>
                        <td class="align-middle">Biaya Piutang Tak Tertagih</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_piutang)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_piutang)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_piutang)
                        </td>
                        <td>
                            <input type="text" name="jumlah_piutang" id="jumlah_piutang" value="@money($lampiran2->jumlah_piutang)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">9</td>
                        <td class="align-middle">Biaya Royalti</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_royalti)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_royalti)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_royalti)
                        </td>
                        <td>
                            <input type="text" name="jumlah_royalti" id="jumlah_royalti" value="@money($lampiran2->jumlah_royalti)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">10</td>
                        <td class="align-middle">Biaya Pemasaran / Promosi</td>
                        <<td class="align-middle text-center">
                            @money($lampiran2->hpp_pemasaran)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_pemasaran)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_pemasaran)
                        </td>
                        <td>
                            <input type="text" name="jumlah_pemasaran" id="jumlah_pemasaran" value="@money($lampiran2->jumlah_pemasaran)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">11</td>
                        <td class="align-middle">Biaya Lainnya</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_lainnya)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_lainnya)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_lainnya)
                        </td>
                        <td>
                            <input type="text" name="jumlah_lainnya" id="jumlah_lainnya" value="@money($lampiran2->jumlah_lainnya)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">12</td>
                        <td class="align-middle">Persediaan Awal</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_awal)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_awal)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_awal)
                        </td>
                        <td>
                            <input type="text" name="jumlah_awal" id="jumlah_awal" value="@money($lampiran2->jumlah_awal)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">13</td>
                        <td class="align-middle">Persediaan Akhir</td>
                        <td class="align-middle text-center">
                            @money($lampiran2->hpp_akhir)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bul_akhir)
                        </td>
                        <td class="align-middle text-center">
                            @money($lampiran2->bdlu_akhir)
                        </td>
                        <td>
                            <input type="text" name="jumlah_akhir" id="jumlah_akhir" value="@money($lampiran2->jumlah_akhir)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">14</td>
                        <td class="align-middle">Jumlah 1 sd 12 Dikurangi 13</td>
                        <td>
                            <input type="text" name="jumlah_hpp" id="jumlah_hpp" value="@money($lampiran2->jumlah_hpp)" class="form-control text-right" disabled>
                        </td>
                        <td>
                            <input type="text" name="jumlah_bul" id="jumlah_bul" value="@money($lampiran2->jumlah_bul)" class="form-control text-right" disabled>
                        </td>
                        <td>
                            <input type="text" name="jumlah_bdlu" id="jumlah_bdlu" value="@money($lampiran2->jumlah_bdlu)" class="form-control text-right" disabled>
                        </td>
                        <td>
                            <input type="text" name="total" id="total" value="@money($lampiran2->total)" class="form-control text-right" disabled>
                        </td>
                    </tr>
                </table>
                <br>
                <h6>Catatan</h6>
                <ul>
                    <li>Nomor 1 untuk Perusahaan Dagang diisi pembelian barang dagangan, untuk perusahaan industri diisi pembelian bahan baku, bahan penolong dan barang jadi.</li>
                    <li>Nomor 7 termasuk management fee, technical assistance fee, dan jasa lainnya</li>
                    <li>Nomor 11 diisi dengan total biaya yang tidak tertampung dalam perincian 1 s.d. 10.</li>
                    <li>Nomor 12 dan 13 untuk perusahaan dagang diisi total persediaan awal dan akhir barang dagangan, untuk perusahaan industri diisi total persediaan awal/akhir bahan baku/bahan penolong ditambah barang setengah jadi ditambah barang jadi.</li>
                    <li>Nomor 6. Biaya Bunga Pinjaman maka harus melampirkan dokumen DER (Debt to Equity Ratio)</li>
                    <li>Nomor 10. Biaya Pemasaran/Promosi maka harus melampirkan dikumen Daftar Normatif</li>
                </ul>
            </div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</body>
</html>