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
            <form>
                <div class="row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-group row mt-4 text-center">
                            <div class="col-md-3 col-3">
                                @if($spt->send_flag != 2)
                                <a href="{{ route('pelajar.eform.draf') }}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left fa-sm" aria-hidden="true"></i> Draf</a>
                                @else
                                    <a href="{{ route('pelajar.eform.arsip') }}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left fa-sm" aria-hidden="true"></i> Arsip</a>
                                @endif
                            </div>
                            <div class="col-md-6 col-6">
                                <select name="type" class="form-control">
                                    <option value="induk">Induk</option>
                                    <option value="lanjutan">Induk Lanjutan</option>
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
                </div>
            </form>
            <table class="table table-borderless">
                <tr>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">FORMULIR</span></th>
                    <th class="text-center align-bottom">
                        <h1>1771</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>SPT TAHUNAN</h5>
                        <b>PAJAK PENGHASILAN WAJIB PAJAK BADAN</b>
                    </th>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">TAHUN PAJAK</span></th>
                    <th class="text-center align-bottom">
                        <h2>{{ $spt->year }}</h2>
                    </th>
                </tr>
                <tr>
                    <td>KEMENTRIAN KEUANGAN RI</td>
                    <td class="border-left border-right">PERHATIAN :
                        <ul>
                            <li>SEBELUM MENGISI, BACA DAHULU PETUNJUK PENGISIAN</li>
                            <li>ISI DENGAN HURUF CETAK</li>
                            <li>BERI TANDA "X" PADA (RADIO BUTTON/CHECKBOX) YANG SESUAI</li>
                        </ul>
                    </td>
                    <td>SPT PEMBETULAN KE</td>
                </tr>
            </table>
            <div class="row border p-2">
                <table class="table table-borderless">
                    <tr>
                        <td class="vertical-text border-right text-center" rowspan="6" width="10px">
                            <b style="font-size: 1rem">IDENTITAS</b>
                        </td>
                        <td class="align-middle" width="180px">NPWP</td>
                        <td><input type="text" class="form-control" name="npwp" value="{{ auth()->user()->npwp }}" disabled></td>
                        <td colspan="2" class="align-middle">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="" value="">
                                <label class="form-check-label align-middle">
                                    Bentuk Usaha Tetap (BUT)
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">NAMA WAJIB PAJAK</td>
                        <td colspan="3"><input type="text" class="form-control" name="name" value="{{ auth()->user()->profile->corporate_name }}" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle">JENIS USAHA</td>
                        <td><input type="text" class="form-control" name="" value="" disabled></td>
                        <td class="align-middle">KLU</td>
                        <td><input type="text" class="form-control" name="" value="" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle pt-2">NO TELP.</td>
                        <td class="pt-2">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="telp"> {{ $induk->telp }} </a>
                        </td>
                        <td class="align-middle pt-2">NO FAKS</td>
                        <td class="pt-2">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="faks"> {{ $induk->faks }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="pt-3">PERIODE PEMBUKUAN</td>
                        <td colspan="3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <div class="col-md-5 pt-2">
                                            <a href="#" class="xdate" data-type="combodate" data-value="01/2023" data-format="MM/YYYY" data-viewformat="MM/YYYY" data-template="MM / YYYY" data-pk="{{ $induk->id }}" data-name="periode_awal"></a>
                                        </div>
                                        <label class="col-md-1 col-form-label pt-2">s.d</label>
                                        <div class="col-md-5 pt-2">
                                            <a href="#" class="xdate" data-type="combodate" data-value="12/2023" data-format="MM/YYYY" data-viewformat="MM/YYYY" data-template="MM / YYYY" data-pk="{{ $induk->id }}" data-name="periode_akhir"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">NEGARA DOMILISI KANTOR PUSAT (Khusus BUT)</td>
                        <td colspan="3">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="alamat" data-type="textarea"> {{ $induk->alamat }} </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row border p-2 mt-2 mb-2">
                <table class="table table-borderless">
                    <tr>
                        <td class="align-middle pb-3" width="240px">PEMBUKUAN / LAPORAN KEUANGAN</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="audit" id="audit1" value="ya" {!! ($induk->audit=='ya') ? 'checked' : '' !!}>
                                <label class="form-check-label">Diaudit</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="audit" id="audit2" value="tidak" {!! ($induk->audit=='tidak') ? 'checked' : '' !!}>
                                <label class="form-check-label">Tidak Diaudit</label>
                              </div>
                        </td>
                        <td>
                            <div style="{!! ($induk->audit=='tidak') ? 'display:none' : '' !!}" class="opini">
                                <a href="#" id="opini" data-type="select" data-pk="{{ $induk->id }}" data-name="opini" data-value="{{ $induk->opini }}" data-title="Pilih Opini"></a> &nbsp;&nbsp;Opini Akuntan
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NAMA KANTOR AKUNTAN PUBLIK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="nama_kap" value="" disabled style="{!! ($induk->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="nama_kap" class="xeditable opini" data-pk="{{ $induk->id }}" data-name="nama_kap" style="{!! ($induk->audit=='tidak') ? 'display:none' : '' !!}"> {{ $induk->nama_kap }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NPWP KANTOR AKUNTAN PUBLIK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="npwp_kap" value="" disabled style="{!! ($induk->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="npwp_kap" class="xeditable opini" data-pk="{{ $induk->id }}" data-name="npwp_kap" style="{!! ($induk->audit=='tidak') ? 'display:none' : '' !!}"> {{ $induk->npwp_kap }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NAMA AKUNTAN PUBLIK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="nama_akuntan" value="" disabled style="{!! ($induk->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="nama_akuntan" class="xeditable opini" data-pk="{{ $induk->id }}" data-name="nama_akuntan" style="{!! ($induk->audit=='tidak') ? 'display:none' : '' !!}"> {{ $induk->nama_akuntan }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NPWP AKUNTAN PUBLIK</td>
                        <td colspan="2">
                            <input type="text" class="form-control audit" name="npwp_akuntan" value="" disabled style="{!! ($induk->audit=='ya') ? 'display:none' : '' !!}">
                            <a href="#" id="npwp_akuntan" class="xeditable opini" data-pk="{{ $induk->id }}" data-name="npwp_akuntan" style="{!! ($induk->audit=='tidak') ? 'display:none' : '' !!}"> {{ $induk->npwp_akuntan }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NAMA KANTOR KONSULTAN PAJAK</td>
                        <td colspan="2">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="nama_kkp"> {{ $induk->nama_kkp }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NPWP KANTOR KONSULTAN PAJAK</td>
                        <td colspan="2">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="npwp_kkp"> {{ $induk->npwp_kkp }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NAMA KONSULTAN PAJAK</td>
                        <td colspan="2">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="nama_konsultan"> {{ $induk->nama_konsultan }} </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle pb-3">NPWP KONSULTAN PAJAK</td>
                        <td colspan="2">
                            <a href="#" class="xeditable" data-pk="{{ $induk->id }}" data-name="npwp_konsultan"> {{ $induk->npwp_konsultan }} </a>
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
                    <td class="vertical-text text-center" height="100px">A. PENGHASILAN KENA PAJAK</td>
                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                1. PENGHASILAN NETTO FISKAL
                                <br>Diisi dari Formulir 1771-I Nomor 8 Kolom 3
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                2. KOMPENSASI KERUGIAN FISKAL
                                <br>Diisi dari Lampiran Khusus 2A Jumlah Kolom 8
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                3. PENGHASILAN KENA PAJAK (1-2)
                            </div>
                        </div>
                    </td>
                    <td width="45%">
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;1</label>
                            <div class="col-md-10">
                                <input type="text" name="a1" id="a1" value="@money($lampiran1->total)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;2</label>
                            <div class="col-md-10">
                                <input type="text" name="a2" id="a2" value="@money($lampkhus2a->nilai65)" class="form-control text-right" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;3</label>
                            <div class="col-md-10">
                                <input type="text" name="a3" id="a3" value="@money($lampiran1->total-$lampkhus2a->nilai65)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="vertical-text text-center align-middle">B. PPh TERUTANG</td>
                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                4. PPh TERUTANG (Pilih salah satu sesuai dengan kriteria Wajib Pajak.)
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="pph_terutang" value="pasal 17 ayat 1b" {!! ($induk->tarif_pph=='pasal 17 ayat 1b') ? 'checked' : '' !!} {!! ($lampiran1->total<=50000000000) ? 'disabled' : '' !!}>
                                <label class="form-check-label align-middle">
                                  Tarif PPh Ps. 17 ayat (1) Huruf b X angka 3
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="pph_terutang" value="pasal 17 ayat 2b" {!! ($induk->tarif_pph=='pasal 17 ayat 2b') ? 'checked' : '' !!} {!! ($lampiran1->total<=50000000000) ? 'disabled' : '' !!}>
                                <label class="form-check-label align-middle">
                                  Tarif PPh Ps. 17 ayat (2b) X Angka 3
                                </label>
                            </div>
                            <div class="col-md-6 form-check pl-5">
                                <input class="form-check-input" type="radio" name="pph_terutang" id="pasal 31e ayat 1" {!! ($induk->tarif_pph=='pasal 31e ayat 1') ? 'checked' : '' !!} {!! ($lampiran1->total>50000000000) ? 'disabled' : '' !!}>
                                <label class="form-check-label align-middle">
                                 Tarif PPh Ps. 31E Ayat (1)
                                </label>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                5. PENGEMBALIAN / PENGURANGAN KREDIT PAJAK LUAR NEGERI
                                <br>(PPh Ps. 24) YANG TELAH DIPERHITUNGKAN TAHUN LALU
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                6. JUMLAH PPh TERUTANG (4 + 5)
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group row mt-2">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;4</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-right" name="b4" id="b4" value="@money($induk->pph_terutang)" disabled>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;5</label>
                            <div class="col-md-10 text-right pr-4 pt-1">
                                <input type="hidden" id="b5" class="pengembalian" value="{{ $induk->pengembalian }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="pengembalian"> {{ $induk->pengembalian }} </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;6</label>
                            <div class="col-md-10">
                                <input type="text" name="b6" id="b6" value="@money($induk->pph_terutang+$induk->pengembalian)" class="form-control text-right" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="vertical-text text-center align-middle" rowspan="2">C. KREDIT PAJAK</td>
                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                7. PPh DITANGGUNG PEMERINTAH (Proyek Bantuan Luar Negeri)
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-12">
                                8. a. KREDIT PAJAK DALAM NEGERI
                                <br>Diisi dari Formulir 1771-III Jumlah Kolom 6
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-12">
                                b. KREDIT PAJAK LUAR NEGERI
                                <br>Diisi dari Lampiran Khusus 7A Jumlah Kolom 12
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                c.JUMLAH (8a + 8b)
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;7</label>
                            <div class="col-md-10 text-right pr-4 pt-1">
                                <input type="hidden" id="c7" class="pph_ditanggung" value="{{ $induk->pph_ditanggung }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="pph_ditanggung"> {{ $induk->pph_ditanggung }} </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;8a</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-right" name="c8a" id="c8a" value="@money($pph_potput)" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;8b</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-right" name="c8b" id="c8b" value="0" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;8c</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-right" name="c8c" id="c8c" value="@money($pph_potput)" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                9. (6 - 7 - 8c)
                            </div>
                            <?php
                            $butir9 = $induk->pph_terutang+$induk->pengembalian-$induk->pph_ditanggung-$pph_potput;
                            $butir9_option = ($butir9 >= 0) ? 'butir9_option1' : 'butir9_option2';
                            $butir11 = $butir9-($induk->pph_sendiri+$induk->stp_pph);
                            $butir11_option = ($butir11 >= 0) ? 'butir11_option1' : 'butir11_option2';
                            ?>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="butir9_option" value="butir9_option1" {!! ($butir9_option=='butir9_option1') ? 'checked' : '' !!} disabled>
                                <label class="form-check-label align-middle">
                                  a. PPh YANG HARUS DIBAYAR SENDIRI
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="butir9_option" value="butir9_option2" {!! ($butir9_option=='butir9_option2') ? 'checked' : '' !!} disabled>
                                <label class="form-check-label align-middle">
                                  b. PPh YANG LEBIH DIPOTONG / DIPUNGUT
                                </label>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                10. PPh YANG DIBAYAR SENDIRI
                                <br>a. PPh Ps. 25 BULANAN
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                b. STP PPh Ps. 25 (Hanya Pokok Pajak)
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-12">
                                c. JUMLAH (10a + 10b)
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group row pt-2">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;9</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-right" name="c9" id="c9" value="@money($butir9)" disabled>
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;10a</label>
                            <div class="col-md-10 text-right pr-4 pt-1">
                                <input type="hidden" id="c10a" class="pph_sendiri" value="{{ $induk->pph_sendiri }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="pph_sendiri"> {{ $induk->pph_sendiri }} </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;10b</label>
                            <div class="col-md-10 text-right pr-4 pt-1">
                                <input type="hidden" id="c10b" class="stp_pph" value="{{ $induk->stp_pph }}">
                                <a href="#" class="xedit" data-pk="{{ $induk->id }}" data-name="stp_pph"> {{ $induk->stp_pph }} </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;10c</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-right" name="c10c" id="c10c" value="@money($induk->pph_sendiri+$induk->stp_pph)" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="vertical-text text-center align-middle">D. PPh KURANG/LEBIH BAYAR</td>
                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                11. (9 - 10c)
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="butir11_option" value="butir11_option1" {!! ($butir11_option=='butir11_option1') ? 'checked' : '' !!} disabled>
                                <label class="form-check-label align-middle">
                                  a. PPh YANG KURANG DIBAYAR (PPh PS. 29)
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="butir11_option" value="butir11_option2" {!! ($butir11_option=='butir11_option2') ? 'checked' : '' !!} disabled>
                                <label class="form-check-label align-middle">
                                  b. PPh YANG LEBIH DIBAYAR (PPh Ps. 28A)
                                </label>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-12">
                                12. PPh YANG KURANG DIBAYAR PADA ANGKA 11.a DISETOR TANGGAL
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-12">
                                13. PPh YANG LEBIH DIBAYAR PADA ANGKA 11.b MOHON :
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                Khusus Restitusi untuk Wajib Pajak dengan Kriteria Tertentu :
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group row pt-2">
                            <label class="col-md-1 col-form-label">&nbsp;&nbsp;11</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-right" name="d11" id="d11" value="@money($butir11)" disabled>
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label class="col-md-2 col-form-label">&nbsp;&nbsp;Tanggal</label>
                            <div class="col-md-9 pt-1">
                                <input type="text" class="form-control butir11_option2" name="tanggal" value="" disabled style="{!! ($butir11_option=='butir11_option1') ? 'display:none' : '' !!}">
                                <a href="#" id="tanggal" class="xdate butir11_option1" data-type="combodate" data-value="{{ $induk->tanggal }}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="{{ $induk->id }}" data-name="tanggal" style="{!! ($butir11_option=='butir11_option2') ? 'display:none' : '' !!}"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="lebih_bayar" value="direstitusikan" {!! ($butir11_option=='butir11_option1') ? 'disabled' : '' !!} {!! ($induk->lebih_bayar=='direstitusikan') ? 'checked' : '' !!}>
                                <label class="form-check-label align-middle">
                                  DIPERSTITUSIKAN
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="radio" name="lebih_bayar" id="lebih_bayar2" value="diperhitungkan" disabled>
                                <label class="form-check-label align-middle">
                                  DIPERHITUNGKAN DENGAN UTANG PAJAK
                                </label>
                            </div>
                            <div class="col-md-12 form-check pl-5">
                                <input class="form-check-input" type="checkbox" name="" value="">
                                <label class="form-check-label align-middle">
                                    Pengembalian Pendahukluan (Pasal 17C atau Pasal 17D UU KUP)
                                </label>
                            </div>
                        </div>
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
    @if($spt->send_flag != 2)
    <script src="{{ url('disc/assets/js/custom/eform/1771/induk.js') }}"></script>
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
