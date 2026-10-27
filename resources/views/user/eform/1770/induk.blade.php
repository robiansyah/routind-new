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
    <title>Induk</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row mt-4 mb-4">
                <div class="col-md-10">
                    <a href="{{ route('pelajar.eform.1770', ['id'=>$spt->id, 'type'=>'lanjutan']) }}" class="btn btn-sm btn-secondary">Sebelumnya</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('pelajar.eform.1770', ['id'=>$spt->id, 'type'=>'submit']) }}" class="btn btn-sm btn-secondary">Submit</a>
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                    <th class="text-center align-middle" rowspan="2">
                        <span style="font-size: 1rem">FORMULIR</span>
                        <h1>1770</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <b>SPT TAHUNAN PPh WAJIB PAJAK ORANG PRIBADI</b>
                    </th>
                    <th class="text-center align-middle" rowspan="2">
                        <span style="font-size: 1rem">TAHUN PAJAK</span>
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
                    <td class="border-left border-right text-center">
                        BAGI WAJIB PAJAK YANG MEMPUNYAI PENGHASILAN<br>
                        <ul>
                            <li>DARI USAHA/PEKERJAAN BEBAS;</li>
                            <li>DARI SATU ATAU LEBIH PEMBERI KERJA</li>
                            <li>YANG DIKENAKAN PPH FINAL/ATAU BERSIFAT FINAL</li>
                            <li>DALAM NEGERI LAINNYA ATAU LUAR NEGERI</li>
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
                        <td class="align-middle" width="200px">NPWP</td>
                        <td colspan="3"><input type="text" class="form-control" name="npwp" value="{{ auth()->user()->username }}" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle">NAMA WAJIB PAJAK</td>
                        <td colspan="3"><input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle">JENIS USAHA/PEKERJAAN BEBAS</td>
                        <td><input type="text" class="form-control" name="" value="" disabled></td>
                        <td class="align-middle">KLU</td>
                        <td><input type="text" class="form-control" name="" value="" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle pt-2 pb-2">NO TELP.</td>
                        <td class="pt-2 pb-2">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="telp"> {{ $induk->telp }} </a>
                        </td>
                        <td class="align-middle pt-2 pb-2">NO FAKS</td>
                        <td class="pt-2 pb-2">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="faks"> {{ $induk->faks }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">STATUS KEWAJIBAN PERPAJAKAN SUAMI ISTRI</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_pajak" id="status_pajak1" value="KK" {!! ($induk->status_pajak=='KK') ? 'checked' : '' !!}>
                                <label class="form-check-label">KK</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_pajak" id="status_pajak2" value="HB" {!! ($induk->status_pajak=='HB') ? 'checked' : '' !!}>
                                <label class="form-check-label">HB</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_pajak" id="status_pajak3" value="PH" {!! ($induk->status_pajak=='PH') ? 'checked' : '' !!}>
                                <label class="form-check-label">PH</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_pajak" id="status_pajak4" value="MT" {!! ($induk->status_pajak=='MT') ? 'checked' : '' !!}>
                                <label class="form-check-label">MT</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">NPWP SUAMI ISTRI</td>
                        <td colspan="3"><input type="text" class="form-control" name="npwp_si" value="{{ $induk->npwp_si }}" disabled></td>
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
                    <td class="vertical-text text-center align-middle" height="100px">A. Penghasilan Neto</td>
                    <td>
                        <ol start="1">
                            <li class="py-1">
                                Penghasilan Neto Dalam Negeri dari Usahan dan/atau Pekerjaan Bebas<br>
                                [Diisi dari Formulir 1770 - I Halaman 1 Jumlah Bagian A atau Formulir 1770 - I Hal 2 Jumlah Bagian B Kolom 5]
                            </li>
                            <li class="py-1">
                                Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan<br>
                                [Diisi dari Formulir 1770 - I Halaman 2 Jumlah Bagian C Kolom 5]
                            </li>
                            <li class="py-1">
                                Penghasilan Neto Dalam Negeri Lainnya<br>
                                [Diisi dari Formulir 1770 - I Halaman 2 Jumlah Bagian D Kolom 3]
                            </li>
                            <li class="py-1">
                                Penghasilan Neto Luar Negeri<br>
                                [Apabila memiliki penghasilan dari luar negeri agar diisi dari Lampiran Tersendiri]
                            </li>
                            <li class="py-2">Jumlah Penghasilan Neto (1 + 2 + 3 +4)</li>
                            <li class="py-2">Zakat / Sumbangan Keagamaan yang Bersifat Wajib</li>
                            <li class="py-2">Jumlah Penghasilan Neto Setelah Pengurangan Zakat / Sumbangan (5-6)</li>
                        </ol>
                    </td>
                    <td width="45%">
                        <?php 
                            $butir1 = ($induk->jenis_lapor=='Pembukuan') ? $lampiran1a->butir4 : $lampiran1b->penghasilan_jumlah;
                            $butir5 = $butir1+$lampiran1c+$lampiran1d->jumlah+$induk->neto_ln;
                            $butir7 = ($butir5-$induk->zakat>0) ? $butir5-$induk->zakat : 0;
                            $butir9 = ($butir7-$induk->kompensasi>0) ? $butir7-$induk->kompensasi : 0;
                            $butir12 = $induk->pkp*5/100;
                            $butir14 = $butir12+$induk->pph_24;
                            $butir16 = $butir14-$lampiran2a;
                            $butir19 = $butir16-($induk->pph_25+$induk->stp_pph_25);

                        ?>
                        <br>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;1</label>
                            <div class="col-md-10 text-right">
                                <input type="text" name="butir1" id="butir1" value="@money($butir1)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2</label>
                            <div class="col-md-10 text-right">
                                <input type="text" name="butir2" id="butir2" value="@money($lampiran1c)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;3</label>
                            <div class="col-md-10">
                                <input type="text" name="butir3" id="butir3" value="@money($lampiran1d->jumlah)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;4</label>
                            <div class="col-md-10 text-right pt-2 pr-4">
                                <input type="hidden" id="butir4" class="neto_ln" value="{{ $induk->neto_ln }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="neto_ln"> {{ $induk->neto_ln }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;5</label>
                            <div class="col-md-10">
                                <input type="text" name="butir5" id="butir5" value="@money($butir5)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;6</label>
                            <div class="col-md-10 text-right pt-2 pr-4">
                                <input type="hidden" id="butir6" class="zakat" value="{{ $induk->zakat }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="zakat"> {{ $induk->zakat }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;7</label>
                            <div class="col-md-10">
                                <input type="text" name="butir7" id="butir7" value="@money($butir7)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="vertical-text text-center align-middle">B.Penghasilan Kena Pajak </td>
                    <td>
                        <ol start="8">
                            <li class="py-2">Kompensasi Kerugian</li>
                            <li class="py-2">Jumlah Penghasilan Neto Setelah Kompensasi Kerugian (7-8)</li>
                            <li class="py-2">
                                <span class="pr-2">Penghasilan TIdak Kena Pajak</span>
                                <a href="#" id="ptkp_code" data-type="select" data-pk="{{ $induk->id }}" data-name="ptkp_code" data-value="{{ $induk->ptkp_code }}" data-title="Pilih PTKP"></a>
                            </li>
                            <li class="py-2">Penghasilan Kena Pajak</li>
                        </ol>
                    </td>
                    <td>
                        <div class="form-group mt-2 mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;8</label>
                            <div class="col-md-10 text-right pt-2 pr-4">
                                <input type="hidden" id="butir8" class="kompensasi" value="{{ $induk->kompensasi }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="kompensasi"> {{ $induk->kompensasi }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;9</label>
                            <div class="col-md-10 text-right">
                                <input type="text" name="butir9" id="butir9" value="@money($butir9)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;10</label>
                            <div class="col-md-10 text-right">
                                <input type="text" name="butir10" id="butir10" value="@money($induk->ptkp)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;11</label>
                            <div class="col-md-10 text-right">
                                <input type="text" name="butir11" id="butir11" value="@money($induk->pkp)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="vertical-text text-center align-middle">C. PPh Terutang</td>
                    <td>
                        <ol start="12">
                            <li class="py-2">PPh Terutang (Tarif Pasal 17 UU PPh X Angka 11)</li>
                            <li class="py-2">Pengembalian/Pengurangan PPh Pasal 24 yang telah Dikreditkan</li>
                            <li class="py-2">Jumlah PPh Terutang (12 + 13)</li>
                        </ol>
                    </td>
                    <td>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;12</label>
                            <div class="col-md-10 text-right">
                                <input type="text" name="butir12" id="butir12" value="@money($butir12)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;13</label>
                            <div class="col-md-10 text-right pt-2 pr-4">
                                <input type="hidden" id="butir13" class="pph_24" value="{{ $induk->pph_24 }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="pph_24"> {{ $induk->pph_24 }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;14</label>
                            <div class="col-md-10 text-right">
                                <input type="text" name="butir14" id="butir14" value="@money($butir14)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="vertical-text text-center align-middle">D. Kredit Pajak</td>
                    <td class="align-middle">
                        <ol start="15">
                            <li class="py-2">
                                PPh yang Dipotong / Dipungut Pihak Lain, Dibayar/Dipotong di Luar Negeri dan Ditanggung Pemerintah<br>
                                [Diisi dari Formulir 1770 - II Jumlah Bagian A Kolom 7]
                            </li>
                            <li>
                                <div class="col-md-12 form-check">
                                    <input class="form-check-input" type="radio" name="butir16_option" value="1" {!! ($butir16>=0) ? 'checked' : '' !!} disabled>
                                    <label class="form-check-label align-middle">
                                      a. PPh yang Harus Dibayar Sendiri
                                    </label>
                                </div>
                                <div class="col-md-12 form-check">
                                    <input class="form-check-input" type="radio" name="butir16_option" value="2" {!! ($butir16<0) ? 'checked' : '' !!} disabled>
                                    <label class="form-check-label align-middle">
                                      b. PPh yang Lebih Dipotong/Dipungut 
                                    </label>
                                </div>
                            </li>
                            <li class="py-2">
                                PPh yang Dibayar Sendiri<br>
                                a. PPh Pasal 25 Bulanan<br>
                                b. STP PPh Pasal 25 (Hanya Pokok Saja)
                            </li>
                            <li class="py-2">Jumlah Kredit Pajak (17a + 17b)</li>
                        </ol>
                    </td>
                    <td>
                        <div class="form-group mt-2 mb-4 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;15</label>
                            <div class="col-md-10">
                                <input type="text" name="butir15" id="butir15" value="@money($lampiran2a)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;16</label>
                            <div class="col-md-10">
                                <input type="text" name="butir16" id="butir16" value="@money($butir16)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;17a</label>
                            <div class="col-md-10 text-right pt-2 pr-4">
                                <input type="hidden" id="butir17a" class="pph_25" value="{{ $induk->pph_25 }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="pph_25"> {{ $induk->pph_25 }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;17b</label>
                            <div class="col-md-10 text-right pt-2 pr-4">
                                <input type="hidden" id="butir17b" class="stp_pph_25" value="{{ $induk->stp_pph_25 }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="stp_pph_25"> {{ $induk->stp_pph_25 }} </a>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;18</label>
                            <div class="col-md-10">
                                <input type="text" name="butir18" id="butir18" value="@money($induk->pph_25+$induk->stp_pph_25)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="vertical-text text-center align-middle" rowspan="2">E. PPh Kurang/ Lebih Bayar</td>
                    <td>
                        <ol start="19">
                            <li>
                                <div class="row">
                                    <div class="md-8 pl-3">
                                        <div class="col-md-12 form-check">
                                            <input class="form-check-input" type="radio" name="butir19_option" value="1" {!! ($butir19>=0) ? 'checked' : '' !!} disabled>
                                            <label class="form-check-label align-middle">
                                                a. PPh yang Kurang Dibayar (PPh Pasal)
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-check">
                                            <input class="form-check-input" type="radio" name="butir19_option" value="2" {!! ($butir19<0) ? 'checked' : '' !!} disabled>
                                            <label class="form-check-label align-middle">
                                                b. PPh yang Lebih Dibayar
                                            </label>
                                        </div>
                                    </div>
                                    <div class="md-4">
                                        Tanggal Lunas <a href="#" id="tanggal" class="xdate text-right" data-type="combodate" data-value="{{ $induk->tanggal_lunas }}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="{{ $induk->id }}" data-name="tanggal_lunas"></a>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </td>
                    <td>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;19</label>
                            <div class="col-md-10">
                                <input type="text" name="butir19" id="butir19" value="@money($induk->pph_25+$induk->stp_pph_25)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">
                        <ol start="20">
                            <li>Permohonan PPh Lebih Bayar pada 19.b</li>
                        </ol>
                    </td>
                    <td>
                        <div class="form-group row">
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="checkbox" id="lebih_bayar" {!! ($induk->lebih_bayar=='direstitusikan' || $butir19<0) ? 'checked' : '' !!} disabled>
                                <label class="form-check-label align-middle">
                                  a. DIPERSTITUSIKAN
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="checkbox" disabled>
                                <label class="form-check-label align-middle">
                                  b. DIPERHITUNGKAN DENGAN UTANG PAJAK
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="checkbox" disabled>
                                <label class="form-check-label align-middle">
                                  c. DIKEMBALIKAN DENGAN SKPPKP PASAL 17C
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="checkbox" disabled>
                                <label class="form-check-label align-middle">
                                  d. DIKEMBALIKAN DENGAN SKPPKP PASAL 17D
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="vertical-text text-center align-middle">F. Angsuran</td>
                    <td>
                        <ol start="21">
                            <li>Angsuran PPh Pasal 25 Tahun Pajak Berikutnya Dihitung sebesar<br>Dihitung Berdasarkan</li>
                        </ol>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="angsuran_check">
                            <label class="form-check-label">a. 1/12 x Jumlah 16</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" disabled>
                            <label class="form-check-label">Perhitungan Pengusaha Tertentu</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" disabled>
                            <label class="form-check-label">Perhitungan dalam Lampiran<br>Tersendiri</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group mb-2 row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;21</label>
                            <div class="col-md-10 text-right pt-2 pr-4">
                                <input type="hidden" id="butir21" class="angsuran" value="{{ $induk->angsuran }}">
                                <a href="#" id="angsuran" class="xedit" data-pk="{{ $induk->id }}" data-name="angsuran"> {{ $induk->angsuran }} </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-borderless mb-5">
                <tr>
                    <th colspan="3" class="text-center border"><b>Pernyataan</b></th>
                </tr>
                <tr>
                    <td colspan="3" class="border-left border-right">Dengan menyadari sepenuhnya akan segala akibatnya termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku,</td>
                </tr>
                <tr>
                    <td width="200px">
                        <div class="col-md-12 form-check">
                            <input class="form-check-input" type="checkbox" name="" value=""  checked disabled>
                            <label class="form-check-label align-middle">
                                Wajib Pajak
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 form-check">
                            <input class="form-check-input" type="checkbox" name="" value=""  disabled>
                            <label class="form-check-label align-middle">
                                Kuasa
                            </label>
                        </div>
                    </td>
                    <td class="border-right">
                        Tanggal <a href="#" class="xdate" data-type="combodate" data-value="{{ $induk->tanggal_lapor }}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="{{ $induk->id }}" data-name="tanggal_lapor"></a>
                    </td>
                </tr>
                <tr>
                    <td class="border-left">Nama Wajib Pajak</td>
                    <td>
                        <input type="text" class="form-control" name="npwp" value="{{ auth()->user()->name }}" disabled>
                    </td>
                    <td rowspan="2" class="border-bottom border-right">Tanda Tangan</td>
                </tr>
                <tr>
                    <td class="border-left border-bottom pt-2">NPWP</td>
                    <td class="border-bottom pt-2">
                        <input type="text" class="form-control" name="npwp" value="{{ auth()->user()->username }}" disabled>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>$.fn.poshytip={defaults:null}</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/eform/1770/induk.js') }}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
