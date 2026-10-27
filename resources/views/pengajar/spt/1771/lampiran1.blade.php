<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
    <title>Lampiran I</title>
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
                                <option value="lampiran1" selected>Lampiran I</option>
                                <option value="lampiran2">Lampiran II</option>
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
                </div>
            </form>
            <table class="table table-borderless">
                <tr>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">FORMULIR</span></th>
                    <th class="text-center align-bottom">
                        <h1>1771 -I</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - I</h5>
                        <b>SPT TAHUNAN PAJAK PENGHASILAN WAJIB PAJAK BADAN</b>
                    </th>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">TAHUN PAJAK</span></th>
                    <th class="text-center align-middle" rowspan="2">
                        <h2>{{ $spt->year }}</h2>
                    </th>
                </tr>
                <tr>
                    <td>KEMENTRIAN KEUANGAN RI</td>
                    <td class="border-left border-right text-center">
                        <b>PENGHITUNGAN PENGHASILAN NETO FISKAL</b>
                    </td>
                </tr>
            </table>
            <div class="row border mb-3">
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
            <table class="table table-borderless">
                <tr>
                    <th class="border text-center" width="30px">No</th>
                    <th class="border text-center" width="50%">Uraian</th>
                    <th class="border text-center">Rupiah</th>
                </tr>
                <tr>
                    <td class="border text-center">(1)</td>
                    <td class="border text-center">(2)</td>
                    <td class="border text-center">(3)</td>
                </tr>
                <tr>
                    <td class="text-center border-left">1</td>
                    <td class="border-left"><b>Penghasilan Neto Komersial Dalam Negeri</b></td>
                    <td class="border-left border-right"></td>
                </tr>
                <tr>
                    <td class="border-left"></td>
                    <td class="border-left">
                        <table class="table tablde-borderless">
                            <tr>
                                <td class="p-2">a. Peredaran Usaha</td>
                            </tr>
                            <tr>
                                <td class="p-2">b. Harga Pokok Penjualan</td>
                            </tr>
                            <tr>
                                <td class="p-2">c. Biaya Usaha Lainnya</td>
                            </tr>
                            <tr>
                                <td class="p-2">d. Penghasilan Neto dari Usaha (1a - 1b - 1c)</td>
                            </tr>
                            <tr>
                                <td class="p-2">e. Penghasilan dari Luar Usaha</td>
                            </tr>
                            <tr>
                                <td class="p-2">f. Biaya dari Luar Usaha</td>
                            </tr>
                            <tr>
                                <td class="p-2">g. Penghasilan Neto dari Luar Usaha (1e - 1f)</td>
                            </tr>
                            <tr>
                                <td class="p-2">h. Jumlah (1d + 1g)</td>
                            </tr>
                        </table>
                    </td>
                    <td class="border-left border-right">
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">1a.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="peredaran_usaha" value="@money($lampiran1->peredaran_usaha)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">1b.</td>
                                <td class="border">
                                    <input type="text" name="jumlah_hpp" id="jumlah_hpp" value="@money($lampiran2->jumlah_hpp)" class="form-control text-right" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">1c.</td>
                                <td class="border">
                                    <input type="text" name="jumlah_bul" id="jumlah_bul" value="@money($lampiran2->jumlah_bul)" class="form-control text-right" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">1d.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="jumlah_1d" id="jumlah_1d" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">1e.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="penghasilan_luar" value="@money($lampiran1->penghasilan_luar)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">1f.</td>
                                <td class="border">
                                    <input type="text" name="jumlah_bdlu" id="jumlah_bdlu" value="@money($lampiran2->jumlah_bdlu)" class="form-control text-right" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">1g.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="jumlah_1g" id="jumlah_1g" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">1h.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="jumlah_1h" id="jumlah_1h" disabled>
                                </td>
                            </tr>
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td class="text-center border-left">2</td>
                    <td class="border-left"><b>Penghasilan Neto Komersial Luar Negeri</b></td>
                    <td class="border-left border-right">
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">2.</td>
                                <td class="border"><input type="text" class="form-control text-right" name="luar_negeri" id="luar_negeri" value="0" disabled></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-center border-left">3</td>
                    <td class="border-left"><b>Jumlah Penghasilan Neto Komersial (1h + 2)</b></td>
                    <td class="border-left border-right">
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">3.</td>
                                <td class="border"><input type="text" class="form-control text-right" name="jumlah_3" id="jumlah_3" value="0" disabled></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle border">4</td>
                    <td class="border align-middle"><b>Penghasilan yang Dikenakan PPh Final dan yang Tidak Termasuk Objek Pajak</b></td>
                    <td class="border">
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">4.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="pph_final" value="@money($lampiran1->pph_final)">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="border text-center align-middle">5</td>
                    <td class="border">
                        <b>Penyesuaian Fiskal Positif</b>
                        <table class="table tablde-borderless">
                            <tr>
                                <td>a. Biaya yang Dibebankan / Dikeluarkan untuk Kepentingan Pemegang Saham, Sekutu atau Anggota</td>
                            </tr>
                            <tr>
                                <td>b. Pembentukan atau pemupukan dana cadangan</td>
                            </tr>
                            <tr>
                                <td>c. Penggantian atau Imbalan Pekerjaan atau Jasa dalam Bentuk Natura dan Kenikmatan</td>
                            </tr>
                            <tr>
                                <td>d. Jumlah yang melebihi Kewajaran yang Dibayarkan kepada Pemegang Saham/ Pihak yang Mempunyai Hubungan Istimewa Sehubungan dengan Pekerjaan</td>
                            </tr>
                            <tr>
                                <td>e. Harta yang Dihibahkan, Bantuan atau Sumbangan</td>
                            </tr>
                            <tr>
                                <td>f. Pajak Penghasilan</td>
                            </tr>
                            <tr>
                                <td>g. Gaji yang Dibayarkan kepada Anggota Persekutuan, Firma atau CV yang Modalnya tidak Terbagi atas Saham</td>
                            </tr>
                            <tr>
                                <td>h. Sanksi Administrasi</td>
                            </tr>
                            <tr>
                                <td>i. Selisih Penyusutan Komersial Diatas Penyusutan Fiskal <br>(Diisi dari Lampiran Khusus 1A)</td>
                            </tr>
                            <tr>
                                <td>j.Selisih Amortisasi Komersial Diatas Amortisasi Fiskal <br>(Diisi dari Lampiran Khusus 1A)</td>
                            </tr>
                            <tr>
                                <td>k. Biaya yang Ditangguhkan Pengakuannya</td>
                            </tr>
                            <tr>
                                <td>l. Penyesuaian Fiskal Positif Lainnya</td>
                            </tr>
                            <tr>
                                <td>m. Jumlah (5a sd 5i)</td>
                            </tr>
                        </table>
                    </td>
                    <td class="border">
                        &nbsp;
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">5a.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5a" value="@money($lampiran1->butir_5a)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5b.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5b" value="@money($lampiran1->butir_5b)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5c.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5c" value="@money($lampiran1->butir_5c)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5d.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5d" value="@money($lampiran1->butir_5d)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5e.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5e" value="@money($lampiran1->butir_5e)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5f.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5f" value="@money($lampiran1->butir_5f)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5g.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5g" value="@money($lampiran1->butir_5g)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5h.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5h" value="@money($lampiran1->butir_5h)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5i.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="butir_5i" id="butir_5i" value="{!! ($penyusutan->selisih<0) ? number_format(abs($penyusutan->selisih), 0, ',', '.') : 0 !!}" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5j.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="butir_5j" id="butir_5j" value="{!! ($amortisasi->selisih<0) ? number_format(abs($amortisasi->selisih), 0, ',', '.') : 0 !!}" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5k.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5k" value="@money($lampiran1->butir_5k)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5l.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_5l" value="@money($lampiran1->butir_5l)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">5m.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="butir_5m" id="butir_5m" value="0" disabled>
                                </td>
                            </tr>
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td class="border text-center align-middle">6</td>
                    <td class="border">
                        <b>Penyesuaian Fiskal Negatif</b>
                        <table class="table tablde-borderless">
                            <tr>
                                <td>a. Selisih Penyusutan Komersial di bawah Penyusutan Fiskal<br>(Diisi dari Lampiran Khusus 1A)</td>
                            </tr>
                            <tr>
                                <td>b. Selisih Amortisasi Komersial di bawah Amortisasi Fiskal<br>(Diisi dari Lampiran Khusus 1A)</td>
                            </tr>
                            <tr>
                                <td>c. Penghasilan yang Ditangguhkan Pengakuannya</td>
                            </tr>
                            <tr>
                                <td>d. Penyesuaian Fiskal Negatif Lainnya</td>
                            </tr>
                            <tr>
                                <td>e. Jumlah (6a sd 6d)</td>
                            </tr>
                        </table>
                    </td>
                    <td class="border">
                        &nbsp;
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">6a.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="butir_6a" id="butir_6a" value="{!! ($penyusutan->selisih>0) ? number_format($penyusutan->selisih , 0, ',', '.') : 0 !!}" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">6b.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="butir_6b" id="butir_6b" value="{!! ($amortisasi->selisih>0) ? number_format($amortisasi->selisih , 0, ',', '.') : 0 !!}" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">6c.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_6c" value="@money($lampiran1->butir_6c)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">6d.</td>
                                <td class="border align-middle text-right">
                                    <input type="text" class="form-control text-right" disabled id="butir_6d" value="@money($lampiran1->butir_6d)">
                                </td>
                            </tr>
                            <tr>
                                <td class="border align-middle">6e.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="butir_6e" id="butir_6e" value="0" disabled>
                                </td>
                            </tr>
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle border">7</td>
                    <td class="border">
                        <b>Fasilitas Penanaman Modal Berupa Pengurangan Penghasilan Neto</b>
                        <br> Tahun Ke 7A
                    </td>
                    <td class="border">
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">7.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="butir_7" id="butir_7" value="0" disabled>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle border">8</td>
                    <td class="border align-middle">
                        <b>Penghasilan Neto Fiskal (3 - 4 + 5m - 6e - 7b)</b>
                    </td>
                    <td class="border">
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">8.</td>
                                <td class="border">
                                    <input type="text" class="form-control text-right" name="butir_8" id="butir_8" value="0" disabled>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <h6>Catatan :</h6>
            Pindahkan jumlah Angka 8 ke Formulis 1771 Huruf A Angka 1.
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</body>

</html>
