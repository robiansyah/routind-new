<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
    <title>Induk Lanjutan</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row mt-4 text-center">
                            <div class="col-md-9 col-9">
                            <select name="type" class="form-control">
                                <option value="induk">Induk</option>
                                <option value="lanjutan" selected>Induk Lanjutan</option>
                                <option value="lampiran1">Lampiran I</option>
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
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                        <div class="form-group row mt-4 text-center">
                            <div class="col-md-3 col-3">
                                <a href="{!! (Request::segment(1) == 'pengajar') ? route('pengajar.pelajar.eform', ['id'=>$spt->id, 'type'=>'submit']) : route('pelajar.eform.1771.detail', ['id'=>$spt->id, 'type'=>'submit']) !!}" class="btn btn-sm btn-secondary">Kirim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <table class="table table-borderless">
                <tr>
                    <th class="border text-center" width="40px"></th>
                    <th class="border" colspan="2"><b>Formulir 1771</b></th>
                </tr>
                <tr>
                    <th class="border text-center"></th>
                    <th class="border text-center" width="50%"></th>
                    <th class="border text-center">Rupiah</th>
                </tr>
                <tr>
                    <td class="border text-center">(1)</td>
                    <td class="border text-center">(2)</td>
                    <td class="border text-center">(3)</td>
                </tr>
                <tr>
                    <td class="border text-center align-middle vertical-text">E. Angsuran PPh Pasal 25 Tahun Berjalan</td>
                    <td class="border">
                        <table class="table tablde-borderless">
                            <tr>
                                <td class="pt-2">14. a. Penghasilan yang Menjadi Dasar Penghitungan Angsuran</td>
                            </tr>
                            <tr>
                                <td class="pt-2">b. Kompensasi Kerugian Fiskal <br>(Diisi dari Lampiran Khusus 2A Jumlah Kolom 9)</td>
                            </tr>
                            <tr>
                                <td class="pb-2">c. Penghasilan Kena Pajak (14a - 14b)</td>
                            </tr>
                            <tr>
                                <td class="pb-2">d. PPh yang Terutang<br>(Tarif PPh dari Bagian B Nomor 4 X 14c)</td>
                            </tr>
                            <tr>
                                <td>e. Kredit Pajak Tahun Pajak yang Lalu atas Penghasilan yang Termasuk dalam Angka 14a yang Dipotong / Dipungut oleh Pihak Lain</td>
                            </tr>
                            <tr>
                                <td class="pb-2">f. PPh yang Harus Dibayar Sendiri (14d - 14e)</td>
                            </tr>
                            <tr>
                                <td>g. PPh Pasal 25 (1/12 x 14f)</td>
                            </tr>
                        </table>
                    </td>
                    <td class="border">
                        <table class="table">
                            <tr>
                                <td class="align-middle" width="25px">14a.</td>
                                <td class="">
                                    <input type="text" class="form-control text-right" name="e14a" id="e14a" value="@money($induk->penghasilan)" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class=" align-middle">14b.</td>
                                <td class="">
                                    <input type="text" class="form-control text-right" name="e14b" id="e14b" value="@money($lampkhus2a->nilai66)" disabled>    
                                </td>
                            </tr>
                            <tr>
                                <td class=" align-middle">14c.</td>
                                <td class="">
                                    <input type="text" class="form-control text-right" name="e14c" id="e14c" value="@money($induk->penghasilan-$lampkhus2a->nilai66)" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class=" align-middle">14d.</td>
                                <td class="">
                                    <input type="text" class="form-control text-right" name="e14d" id="e14d" value="@money($induk->pph_terutang_14)" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class=" align-middle">14e.</td>
                                <td class="">
                                    <input type="text" class="form-control text-right" name="e14e" id="e14e" value="@money($induk->kredit_pajak)" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class=" align-middle">14f.</td>
                                <td class=""><input type="text" class="form-control text-right" name="e14f" id="e14f" value="@money($induk->pph_terutang_14-$induk->kredit_pajak)" disabled></td>
                            </tr>
                            <tr>
                                <td class=" align-middle">14g.</td>
                                <td class=""><input type="text" class="form-control text-right" name="e14g" id="e14g" value="@money((1/12)*($induk->pph_terutang_14-$induk->kredit_pajak))" disabled></td>
                            </tr>
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td class="border text-center align-middle vertical-text">F. PPh Final dan<br>Penghasilan Bukan<br>Objek Pajak</td>
                    <td class="border">
                        <table class="table tablde-borderless">
                            <tr>
                                <td>15. a. PPh Finall<br>(Diisi dari Formulir 1771-IV Jumlah Bagian A Kolom 5)</td>
                            </tr>
                            <tr>
                                <td>b. Penghasilan yang Tidak Termasuk Objek Pajak<br>Penghasilan Bruto (Diisi dari Formulir 1771-IV Jumlah Bagian A Kolom 3)</td>
                            </tr>
                        </table>
                    </td>
                    <td class="border">
                        <table class="table">
                            <tr>
                                <td class="border align-middle" width="25px">15a.</td>
                                <td class="border"><input type="text" class="form-control text-right" name="f15a" id="f15a" value="@money($lampiran4a->total)" disabled></td>
                            </tr>
                            <tr>
                                <td class="border align-middle">15b.</td>
                                <td class="border"><input type="text" class="form-control text-right" name="f15b" id="f15b" value="@money($lampiran4b->total)" disabled></td>
                            </tr>
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle border vertical-text">G. Pernyataan<br>Transaksi Dalam<br>Hubungan Istimewa</td>
                    <td class="border" colspan="2">
                        <div class="form-group row">
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="pernyataan" value="ada" disabled>
                                <label class="form-check-label align-middle">
                                    Ada Transaksi Dalam Hubungan Istimewa dan/atau Transaksi dengan Pihak yang Merupakan Penduduk Negara Tax Haven Country.    (Wajib melampirkan Lampiran Khusus 3A, 3A-1, dan 3A-2 Buku Petunjuk  Pengisian SPT )*
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="pernyataan" value="tidak ada" checked>
                                <label class="form-check-label align-middle">
                                    Tidak  Ada Transaksi Dalam Hubungan Istimewa dan/atau Transaksi dengan Pihak yang Merupakan Penduduk Negara Tax Haven Country
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle border vertical-text">H. Lampiran</td>
                    <td class="border" colspan="2">
                        17. Selain Lampiran-Lampiran 1771-I,  1771-II,  1771-III,  1771-IV,  1771-V,  dan  1771-VI Bersama Ini Dilampirkan Pula 
                        <table class="table">
                            <tr>
                                <td>a.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Surat Setoran Pajak Lembar Ke-3 Pph Pasal 29
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>b.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Laporan Keuangan
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>c.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Transkrip Kutipan Elemen-Elemen Dari Laporan Keuangan  (Lampiran Khusus 8A-1 / 8A-2 / 8A-3 / 8A-4 / 8A-5 / 8A-6/ 8A-7/ 8A-8)*
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>d.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Daftar Penyusutan Dan Amortisasi Fiskal  (Lampiran Khusus 1A Buku Petunjuk Pengisian SPT)*
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>e.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Perhitungan Kompensasi Kerugian Fiskal  (Lampiran Khusus 2A Buku Petunjuk Pengisian SPT)*
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>f.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Daftar Fasilitas Penanaman Modal   (Lampiran Khusus 4A Buku Petunjuk Pengisian SPT)*
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>g.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Daftar Cabang Utama Perusahaan   (Lampiran Khusus 5A Buku Petunjuk Pengisian SPT)*
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>h.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Surat Setoran Pajak Lembar Ke-3 PPh Pasal 26 Ayat (4)  (Khusus bagi BUT)
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>i.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Perhitungan PPh Pasal 26 Ayat (4) (Khusus BUT)  (Lampiran Khusus 6A Buku Petunjuk Pengisian SPT)*
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>j.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Kredit Pajak Luar Negeri   (Lampiran Khusus 7A Buku Petunjuk Pengisian SPT)*
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>k.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Surat Kuasa Khusus (Bila dikuasakan)
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>l.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <label class="form-check-label align-middle">
                                            Rincian Jumlah Penghasilan Dan Pembayaran PPh Final Pp 46/2013 Per Masa Pajak Dari Masing-Masing Tempat Usaha
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>m.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>n.</td>
                                <td>
                                    <div class="col-md-12 form-check">
                                        <input class="form-check-input" type="checkbox" name="" value="" >
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <table class="table table-borderless">
                <tr>
                    <th colspan="8" class="text-center border"><b>Pernyataan</b></th>
                </tr>
                <tr>
                    <td colspan="8" class="border-left border-right">Dengan menyadari sepenuhnya akan segala akibatnya termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku,</td>
                </tr>
                <tr>
                    <td class="border-left">a.</td>
                    <td width="200px">
                        <div class="col-md-12 form-check">
                            <input class="form-check-input" type="checkbox" name="" value=""  checked disabled>
                            <label class="form-check-label align-middle">
                                Wajib Pajak
                            </label>
                        </div>
                    </td>
                    <td>b.</td>
                    <td>
                        <div class="col-md-12 form-check">
                            <input class="form-check-input" type="checkbox" name="" value=""  disabled>
                            <label class="form-check-label align-middle">
                                Kuasa
                            </label>
                        </div>
                    </td>
                    <td>c.</td>
                    <td>
                        {{ $induk->tempat_ttd }}
                    </td>
                    <td>d.</td>
                    <td class="border-right">
                        {{ $induk->tanggal_ttd }}
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="border-left">Tanda Tangan dan Cap Perusahaan</td>
                    <td colspan="3" class="border-right pt-2">
                        <textarea class="form-control" name="" id="" cols="10" rows="4"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="border-left">Nama Lengkap Pengurus / Kuasa</td>
                    <td>c.</td>
                    <td colspan="5" class="border-right">
                        {{ $induk->nama_lengkap }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="border-left border-bottom pt-2">NPWP</td>
                    <td class="border-bottom pt-2">d.</td>
                    <td colspan="5" class="border-bottom border-right pt-2">
                        {{ $induk->npwp }}
                    </td>
                </tr>
            </table>
            <br>
            <br>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</body>

</html>
