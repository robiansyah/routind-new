@extends('layouts.main')

@section('title', 'SPT ' . $spt->form_code)
@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <div class="alert alert-{{ $msg }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('alert-' . $msg) }}
    </div>
    @endif
@endforeach  
<div class="card card-primary card-outline">
    <div class="card-body">
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-identitas-tab" data-toggle="pill"
                    href="#custom-content-below-identitas" role="tab" aria-controls="custom-content-below-identitas"
                    aria-selected="true">IDENTITAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-induk-tab" data-toggle="pill"
                    href="#custom-content-below-induk" role="tab" aria-controls="custom-content-below-induk"
                    aria-selected="false">INDUK</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-lampiran-i-tab" data-toggle="pill"
                    href="#custom-content-below-lampiran-i" role="tab" aria-controls="custom-content-below-lampiran-i"
                    aria-selected="false">LAMPIRAN I</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-lampiran-ii-tab" data-toggle="pill"
                    href="#custom-content-below-lampiran-ii" role="tab" aria-controls="custom-content-below-lampiran-ii"
                    aria-selected="false">LAMPIRAN II</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-lampiran-lain-tab" data-toggle="pill"
                    href="#custom-content-below-lampiran-lain" role="tab" aria-controls="custom-content-below-lampiran-lain"
                    aria-selected="false">LAMPIRAN LAIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-penilaian-tab" data-toggle="pill"
                    href="#custom-content-below-penilaian" role="tab" aria-controls="custom-content-below-penilaian"
                    aria-selected="false">PENILAIAN</a>
            </li>
        </ul>
        <br>
        <div class="tab-content" id="custom-content-below-tabContent">
            <div class="tab-pane fade active show" id="custom-content-below-identitas" role="tabpanel"
                aria-labelledby="custom-content-below-identitas-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Identitas SPT dan Wajib Pajak
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-xs">
                                    <label for="npwp" class="form-control-label">NPWP</label>
                                    <h6>{{ $spt->user->username }}</h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="nama" class="form-control-label">Nama WP</label>
                                    <h6>{{ $spt->user->name }}</h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="pekerjaan" class="form-control-label">Pekerjaan</label>
                                    <h6></h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="notelp" class="form-control-label">Nomor Telepon</label>
                                    <h6>0{{ $spt->user->mobile_phone }}</h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="klu" class="form-control-label">KLU</label>
                                    <h6></h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-xs">
                                    <label for="tahunPajak" class="form-control-label">Tahun Pajak</label>
                                    <h6>{{ $spt->year }}</h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="pembetulan" class="form-control-label">Pembetulan</label>
                                    <h6>{{ $spt->correction_to }}</h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="divKewajiban" class="form-control-label">Status Kewajiban Perpajakan Suami-Istri</label>
                                    <h6 id="txtKewajiban"></h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="divNpwpPasangan" class="form-control-label">NPWP Isteri/Suami</label>
                                    <h6 id="txtNpwpPasangan"></h6>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('pengajar.pelajar.detail', ['id' => $spt->user_id]) }}"
                            class="btn btn-default"><i class="fas fa-arrow-left"></i> Kembali</a>&nbsp;
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-induk" role="tabpanel"
                aria-labelledby="custom-content-below-induk-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Induk SPT
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="indukA">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">1</td>
                                <td style="width: 65%">Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan</td>
                                <td style="width: 30%"> <input type="text" id="Idk1" class="form-control form-control-sm uang induk" value="@money($spt->main->phNettoDN)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">2</td>
                                <td style="width: 65%">Penghasilan Neto Dalam Negeri Lainnya</td>
                                <td style="width: 30%"> <input type="text" id="Idk2" class="form-control form-control-sm uang induk" value="@money($spt->main->phNettoDNLain)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">3</td>
                                <td style="width: 65%">Penghasilan Neto Luar Negeri</td>
                                <td style="width: 30%"><input type="text" id="Idk3" class="form-control form-control-sm uang induk" value="@money($spt->main->phLN)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">4</td>
                                <td style="width: 65%">Jumlah Penghasilan Neto (1+2+3)</td>
                                <td style="width: 30%"> <input type="text" id="Idk4" class="form-control form-control-sm uang" value="@money($spt->main->jmlPhNetto)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">5</td>
                                <td style="width: 65%">Zakat/Sumbangan Keagamaan yang Sifatnya Wajib</td>
                                <td style="width: 30%"><input type="text" id="Idk5" class="form-control form-control-sm uang induk" value="@money($spt->main->zakatSumbang)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">6</td>
                                <td style="width: 65%">Jumlah Penghasilan Neto setelah Pengurangan Zakat/Sumbangan Keagamaan yang sifatnya Wajib (4-5)</td>
                                <td style="width: 30%"><input type="text" id="Idk6" class="form-control form-control-sm uang" value="@money($spt->main->jmlPhNettoAkhir)" style="text-align: right;" readonly placeholder="">
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-hover table-bordered" id="indukB">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">7</td>
                                <td style="width: 25%">Penghasilan Tidak Kena Pajak/Jumlah Tanggungan</td>
                                <td class="special-td" style="width: 40%; text-align: center">
                                    <?php $ptkp = $spt->main->jnsPtkp.$spt->main->jmlTanggungan ?>
                                    <select id="ddlPtkp" class="form-control form-control-sm select2me" aria-invalid="false" disabled="disabled">
                                        <option value="00" {!! ($ptkp=="00") ? "selected" : "" !!}>TK/0 Tidak Kawin Tidak Ada Tanggungan</option>
                                        <option value="01" {!! ($ptkp=="01") ? "selected" : "" !!}>TK/1 Tidak Kawin Tanggungan 1 Orang</option>
                                        <option value="02" {!! ($ptkp=="02") ? "selected" : "" !!}>TK/2 Tidak Kawin Tanggungan 2 Orang</option>
                                        <option value="03" {!! ($ptkp=="03") ? "selected" : "" !!}>TK/3 Tidak Kawin Tanggungan 3 Orang</option>
                                        <option value="10" {!! ($ptkp=="10") ? "selected" : "" !!}>K/0 Kawin Tidak Ada Tanggungan</option>
                                        <option value="11" {!! ($ptkp=="11") ? "selected" : "" !!}>K/1 Kawin Tanggungan 1 Orang</option>
                                        <option value="12" {!! ($ptkp=="12") ? "selected" : "" !!}>K/2 Kawin Tanggungan 2 Orang</option>
                                        <option value="13" {!! ($ptkp=="13") ? "selected" : "" !!}>K/3 Kawin Tanggungan 3 Orang</option>
                                        <option value="20" {!! ($ptkp=="20") ? "selected" : "" !!}>K/I/0 Kawin Penghasilan Istri Digabung Tidak Ada Tanggungan</option>
                                        <option value="21" {!! ($ptkp=="21") ? "selected" : "" !!}>K/I/1 Kawin Penghasilan Istri Digabung Tanggungan 1 Orang</option>
                                        <option value="22" {!! ($ptkp=="22") ? "selected" : "" !!}>K/I/2 Kawin Penghasilan Istri Digabung Tanggungan 2 Orang</option>
                                        <option value="23" {!! ($ptkp=="23") ? "selected" : "" !!}>K/I/3 Kawin Penghasilan Istri Digabung Tanggungan 3 Orang</option>
                                    </select>
                                </td>
                                <td style="width: 30%"><input type="text" id="Idk71" class="form-control form-control-sm uang" value="@money($spt->main->phTKP)" style="text-align: right;" readonly placeholder="">
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">8</td>
                                <td style="width: 65%">Penghasilan Kena Pajak (6-7)</td>
                                <td style="width: 30%"><input type="text" id="Idk8" class="form-control form-control-sm uang" value="@money($spt->main->phKP)" style="text-align: right;" readonly placeholder="">
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-hover table-bordered" id="indukC">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">9</td>
                                <td style="width: 65%">PPh Terutang (Tarif Pasal 17 UU PPh x Angka 8)</td>
                                <td style="width: 30%"><input type="text" id="Idk9" class="form-control form-control-sm uang" value="@money($spt->main->pphTerutang)" style="text-align: right;" readonly placeholder="">
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">10</td>
                                <td style="width: 65%">Pengembalian/Pengurangan PPh Pasal 24 yang telah dikreditkan</td>
                                <td style="width: 30%"><input type="text" id="Idk10" class="form-control form-control-sm uang induk" value="@money($spt->main->penguranganPs24)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">11</td>
                                <td style="width: 65%">Jumlah PPh Terutang (9+10)</td>
                                <td style="width: 30%"><input type="text" id="Idk11" class="form-control form-control-sm uang" value="@money($spt->main->jmlPPhTerutang)" style="text-align: right;" readonly placeholder="">
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-hover table-bordered" id="indukD">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">12</td>
                                <td style="width: 65%">PPh yang dipotong/dipungut pihak lain/ditanggung pemerintah dan/atau Kredit Pajak Luar Negeri dan/atau terutang di luar negeri</td>
                                <td style="width: 30%"><input type="text" id="Idk12" class="form-control form-control-sm uang induk"  value="@money($spt->main->pphDipotong)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">13</td>
                                <td style="width: 65%">PPh yang Harus Dibayar Sendiri</td>
                                <td style="width: 30%"><input type="text" id="Idk13" class="form-control form-control-sm uang" value="@money($spt->main->jmlBayarPPh)" style="text-align: right;" placeholder="" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">14</td>
                                <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; PPh Pasal 25</td>
                                <td style="width: 30%"><input type="text" id="Idk14a" class="form-control form-control-sm uang induk" value="@money($spt->main->pphPasal25)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center"></td>
                                <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; STP PPh Pasal 25 (Hanya Pokok Pajak)</td>
                                <td style="width: 30%"><input type="text" id="Idk14b" class="form-control form-control-sm uang induk" value="@money($spt->main->stppphPasal25)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr id="divFiskalLn" style="display: none;">
                                <td style="width: 5%; text-align: center"></td>
                                <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; Fiskal Luar Negeri</td>
                                <td style="width: 30%"><input type="text" id="Idk14c" class="form-control form-control-sm uang induk" value="@money($spt->main->fiskalLN)" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">15</td>
                                <td style="width: 65%">Jumlah Kredit Pajak (14a + 14b + 14c)</td>
                                <td style="width: 30%"> <input type="text" id="Idk15" class="form-control form-control-sm uang" value="@money($spt->main->jmlKreditPajak)" style="text-align: right;" readonly placeholder="">
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">16</td>
                                <td style="width: 65%; color: rgb(0, 128, 0); font-weight: bold;" id="lblPph">PPh</td>
                                <td style="width: 30%"> <input type="text" id="Idk16" class="form-control form-control-sm uang" value="@money($spt->main->pph)" style="text-align: right;" readonly placeholder="">
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr id="barisLebihBayar" style="display: none;">
                                <td style="width: 5%; text-align: center">17</td>
                                <td style="width: 50%">Permohonan : PPh Lebih Bayar pada angka 16 mohon</td>
                                <td style="width: 45%">
                                    <select class="form-control form-control-sm select2me" id="CbLebihBayar" aria-invalid="false" disabled="disabled">
                                        <option value="">Pilih</option>
                                        <option value="0" {!! ($spt->main->permohonanLB=="0") ? "selected" : "" !!}>Direstitusikan</option>
                                        <option value="1" {!! ($spt->main->permohonanLB=="1") ? "selected" : "" !!} disabled="disabled">Diperhitungkan dengan Utang Pajak</option>
                                        <option value="2" {!! ($spt->main->permohonanLB=="2") ? "selected" : "" !!}>Dikembalikan dengan SKPPKP Pasal 17 C (WP Patuh)</option>
                                        <option value="3" {!! ($spt->main->permohonanLB=="3") ? "selected" : "" !!}>Dikembalikan dengan SKPPKP Pasal 17 D (WP Tertentu)</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-hover table-bordered" id="tblAngsuran">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">18</td>
                                <td style="width: 30%">Angsuran PPh Pasal 25 Tahun Pajak Berikutnya Sebesar (Dihitung Berdasarkan)</td>
                                <td class="special-td" style="width: 35%">
                                    <select class="form-control form-control-sm" id="cbDsrHitPs25" aria-invalid="false" disabled="disabled">
                                        <option value="0" {!! ($spt->main->dsrHitAngs=="0") ? "selected" : "" !!}>Pilih..</option>
                                        <option value="1" {!! ($spt->main->dsrHitAngs=="1") ? "selected" : "" !!}>1/12 x Jumlah Pada Angka 13</option>
                                        <option value="2" {!! ($spt->main->dsrHitAngs=="2") ? "selected" : "" !!}>Penghitungan dalam lampiran tersendiri</option>
                                    </select>
                                    <span class="help-block"></span>
                                </td>
                                <td style="width: 30%; text-align: center"><input type="text" class="form-control form-control-sm uang" id="IdkAngs25" value="@money($spt->main->angsPPh25)" style="text-align: right;" readonly placeholder="">
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-lampiran-i" role="tabpanel"
                aria-labelledby="custom-content-below-lampiran-i-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Bagian A : Penghasilan Neto Dalam Negeri Lainnya(Tidak Termasuk Penghasilan Dikenakan PPh Final dan/atau Bersifat Final)
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="lamp1A">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">1</td>
                                <td style="width: 55%">Bunga</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagA01" class="form-control form-control-sm uang bgIa" value="@money($spt->spt1a->phBunga)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">2</td>
                                <td style="width: 55%">Royalti</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagA02" class="form-control form-control-sm uang bgIa" value="@money($spt->spt1a->phRoyalti)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">3</td>
                                <td style="width: 55%">Sewa</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagA03" class="form-control form-control-sm uang bgIa" value="@money($spt->spt1a->phSewa)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">4</td>
                                <td style="width: 55%">Hadiah</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagA04" class="form-control form-control-sm uang bgIa" value="@money($spt->spt1a->phHadiah)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">5</td>
                                <td style="width: 55%">Keuntungan dari Penjualan/Pengalihan Harta</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagA05" class="form-control form-control-sm uang bgIa" value="@money($spt->spt1a->phAlihHarta)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">6</td>
                                <td style="width: 55%">Penghasilan Lain</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagA06" class="form-control form-control-sm uang bgIa" value="@money($spt->spt1a->phLain)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="special-td" colspan="2" style="width: 5%; text-align: center">Jumlah Bagian A</td>
                                <td style="width: 40%"> <input type="text" id="txtJumlahA" class="form-control form-control-sm uang" value="@money($spt->spt1a->phBunga + $spt->spt1a->phRoyalti + $spt->spt1a->phSewa + $spt->spt1a->phHadiah + $spt->spt1a->phAlihHarta + $spt->spt1a->phLain)" style="text-align: right; font-weight: bold" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Bagian B : Penghasilan yang Tidak Termasuk Objek Pajak
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="lamp1A">
                            <tbody>
                            <tr>
                                <td style="width: 5%; text-align: center">1</td>
                                <td style="width: 55%">Bantuan/Sumbangan/Hibah</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagB01" class="form-control form-control-sm uang bgIb" value="@money($spt->spt1b->bantuanHibah)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">2</td>
                                <td style="width: 55%">Warisan</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagB02" class="form-control form-control-sm uang bgIb" value="@money($spt->spt1b->warisan)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">3</td>
                                <td style="width: 55%">Bagian Laba Anggota Perseroan Komanditer tidak atas saham, persekutuan, perkumpulan, firma, kongsi</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagB03" class="form-control form-control-sm uang bgIb" value="@money($spt->spt1b->labaAnggota)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">4</td>
                                <td style="width: 55%">Klaim Asuransi Kesehatan, Kecelakaan, Jiwa, Dwiguna, Beasiswa</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagB04" class="form-control form-control-sm uang bgIb" value="@money($spt->spt1b->asuransi)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">5</td>
                                <td style="width: 55%">Beasiswa</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagB05" class="form-control form-control-sm uang bgIb" value="@money($spt->spt1b->beasiswa)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center">6</td>
                                <td style="width: 55%">Penghasilan Lainnya yang tidak termasuk Objek Pajak</td>
                                <td style="width: 40%">
                                    <input type="text" id="BagB06" class="form-control form-control-sm uang bgIb" value="@money($spt->spt1b->phBOPLain)" style="text-align: right" readonly>
                                    <span class="help-block"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="special-td" colspan="2" style="width: 5%; text-align: center">Jumlah Bagian B</td>
                                <td style="width: 40%"> <input type="text" id="txtJumlahB" class="form-control form-control-sm uang" value="@money($spt->spt1b->bantuanHibah + $spt->spt1b->warisan + $spt->spt1b->labaAnggota + $spt->spt1b->asuransi + $spt->spt1b->beasiswa + $spt->spt1b->phBOPLain)" style="text-align: right; font-weight: bold" readonly>
                                    <span class="help-block"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Bagian C : Daftar Pemotongan/Pemungutan PPh Oleh Pihak Lain dan PPh Yang Ditanggung Pemerintah
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tblBuktiPotong" style="display: table; width: 100%;" role="grid" aria-describedby="tblBuktiPotong_info">
                            <thead>
                                <tr role="row">
                                    <th style="text-align: center; vertical-align: top; "
                                        width="30%">Nama Pemotong/ Pemungut Pajak</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="20%">NPWP Pemotong/ Pemungut Pajak</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="5%">Nomor Bukti Pemotongan/ Pemungutan</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="5%">Tanggal Bukti Pemotongan/ Pemungutan</th>  
                                    <th style="text-align: center; vertical-align: top;"
                                        width="10%">Jenis Pajak</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="15%">Jumlah PPh Yang Dipotong/ Dipungut</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>                                                                        
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="font-weight: bold; text-align: right;" rowspan="1">JAC</td>
                                    <td rowspan="1" colspan="1">
                                        <input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtJAC">
                                    </td>
                                    <td rowspan="1" colspan="1"></td>
                                </tr>     
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-lampiran-ii" role="tabpanel"
                aria-labelledby="custom-content-below-lampiran-ii-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Bagian A. Penghasilan yang dikenakan PPh Final dan/atau bersifat final
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tblPphFinal" width="100%" style="display: table; width: 100%;" role="grid" aria-describedby="tblPphFinal_info">
                            <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: top; "
                                        width="3%">No</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="37%">Sumber/Jenis Penghasilan</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="30%">DPP/Penghasilan Bruto</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="30%">PPh Terutang</th>  
                                    <th style="text-align: center; vertical-align: top;"
                                        width="30%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>                                                                        
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" style="font-weight: bold; text-align: right;">Jumlah</td>
                                    <td style="text-align: center; vertical-align: top;"
                                        width="30%"><input class="form-control form-control-sm uang" type="text" readonly id="txtJBA"/></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div hidden> 
                            <select id="ddlKewajibanFinal" name="ddlKewajibanFinal" class="form-control input-medium select2me" data-placeholder="Pilih..." hidden>
                                <option value="1">1. Bunga Deposito, Tabungan, Diskonto SBI,Surat Berharga Negara</option>
                                <option value="2">2. Bunga/Diskonto Obligasi</option>
                                <option value="3">3. Penjualan Saham di Bursa Efek</option>
                                <option value="4">4. Hadiah Undian</option>
                                <option value="5">5. Pesangon, Tunjangan Hari Tua, dan tebusan Pensiun yang dibayarkan sekaligus</option>
                                <option value="6">6. Honorarium Atas Beban APBD/APBN</option>
                                <option value="7">7. Pengalihan Hak Atas Tanah dan Bangunan</option>
                                <option value="8">8. Sewa Atas Tanah dan Bangunan</option>
                                <option value="9">9. Bangunan yang diterima dalam rangka Bangun Guna Serah</option>
                                <option value="10">10. Bunga Simpanan yang diserahkan oleh Koperasi kepada Anggota Koperasi</option>
                                <option value="11">11. Transaksi Derivatif</option>
                                <option value="12">12. Dividen</option>
                                <option value="13">13. Penghasilan Istri Dari Satu Pemberi Kerja</option>
                                <option value="14">14. Penghasilan Lain Yang Dikenakan Pajak Final Dan/Atau Bersifat Final</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Bagian B : Harta Pada Akhir Tahun
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tblHarta" role="grid" aria-describedby="tblHarta_info">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width: 30%">Kode Harta</th>
                                    <th style="text-align: center;width: 30%">Nama Harta</th>
                                    <th style="text-align: center;width: 5%">Tahun Perolehan</th>
                                    <th style="text-align: center;width: 25%">Harga Perolehan</th>
                                    <th style="text-align: center;width: 30%">Keterangan</th>
                                    <th style="text-align: center;width: 10%">Aksi</th>                                                                              
                                </tr>    
                            </thead>
                            <tbody>                                                                        
                            </tbody>
                            <tfoot>
                                <tr>                                                                       
                                    <td colspan="3" style="font-weight: bold; text-align: right">Sub Total</td>
                                    <td><input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtSubJBB"/></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>                                                                       
                                    <td colspan="3" style="font-weight: bold; text-align: right">Jumlah Bagian B (JBB)</td>
                                    <td><input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtJBB"/></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Bagian C : Kewajiban/Utang Pada Akhir Tahun
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tblHutang" role="grid" aria-describedby="tblHutang_info">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width: 5%">Kode Utang</th>
                                    <th style="text-align: center;width: 25%">Nama Pemberi Pinjaman</th>
                                    <th style="text-align: center;width: 30%">Alamat Pemberi Pinjaman</th>
                                    <th style="text-align: center;width: 10%">Tahun Peminjaman</th>
                                    <th style="text-align: center;width: 20%">Jumlah</th>
                                    <th style="text-align: center;width: 10%">Aksi</th>                                                                              
                                </tr>    
                            </thead>
                            <tbody>                                                                        
                            </tbody>
                            <tfoot>
                                <tr>                                                                       
                                    <td colspan="4" style="font-weight: bold; text-align: right">Sub Total</td>
                                    <td><input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtSubJBC"/></td>
                                    <td></td>
                                </tr>
                                <tr>                                                                       
                                    <td colspan="4" style="font-weight: bold;  text-align: right">Jumlah Bagian C (JBC)</td>
                                    <td><input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtJBC"/></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Bagian D : Daftar Susunan Anggota Keluarga
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tblTanggungan" role="grid">
                            <thead>
                                <tr role="row">
                                    <th style="text-align: center;width: 20%">Nama</th>
                                    <th style="text-align: center;width: 20%">Tanggal Lahir</th>
                                    <th style="text-align: center;width: 20%">NIK</th>
                                    <th style="text-align: center;width: 20%">Hubungan Keluarga</th>
                                    <th style="text-align: center;width: 20%">Pekerjaan</th>
                                    <th style="text-align: center;width: 20%">Aksi</th>
                                </tr>    
                            </thead>
                            <tbody>
                            </tbody> 
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-lampiran-lain" role="tabpanel"
                aria-labelledby="custom-content-below-lampiran-lain-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Panel Perhitungan PPh untuk Status PH atau MT
                        </h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row  my-0" id="divStatusNikah">   
                            <div class="col-md-1"></div>
                            <label class="col-form-label col-md-3" style="text-align: right">Lapor Sebagai</label>
                            <div class="radio-list col-md-6">
                                <label class="kt-radio kt-radio--bold kt-radio--brand col-md-5 my-2">
                                    <input type="radio" name="rbpisahharta" id="rbsuami" value="1"> Suami
                                        <span></span>
                                </label>
                                <label class="kt-radio kt-radio--bold kt-radio--brand">
                                    <input type="radio" name="rbpisahharta" id="rbistri" value="2"> Istri
                                        <span></span>
                                </label>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row my-2">
                            <div class="col-md-1"></div>
                            <label class="col-form-label col-md-3" style="text-align: right">Penghasilan Netto Suami</label>                                                                      
                            <div class="col-md-6">
                                <input type="text" id="idkPenghasilanSuami" class="form-control form-control-sm uang induk" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row my-2">
                            <div class="col-md-1"></div>
                            <label class="col-form-label col-md-3" style="text-align: right">Penghasilan Netto Istri</label>                                                                      
                            <div class="col-md-6">
                                <input type="text" id="idkPenghasilanIstri" class="form-control form-control-sm uang induk" style="text-align: right;" readonly>
                                    <span class="help-block"></span>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Data Pembayaran
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="tblPembayaran" width="100%">
                            <tbody>
                                <tr id="barisTglNtpn">
                                    <td style="width: 5%; text-align: center">-</td>
                                    <td colspan="2" style="width: 65%">Tanggal Pelunasan</td>                                                                      
                                    <td style="width: 30%;">
                                        <div class="input-group input-medium date">                                                                        
                                            <input id="tglSsp" name="tglSsp" type="text" class="form-control form-control-sm date-picker" readonly  data-date-format="dd-mm-yyyy" data-date-viewmode="years" data-date-end-date="0d">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>  
                            </tbody>
                        </table> 
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tblJnsPembayaran" style="display: table; width: 100%;" role="grid" aria-describedby="tblJnsPembayaran_info">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: top;"
                                            width="20%">Jenis Pembayaran</th>
                                        <th style="text-align: center; vertical-align: top;"
                                            width="30%">NTPN/Nomor Pemindahbukuan</th>
                                        <th style="text-align: center; vertical-align: top;"
                                            width="15%">Tanggal Pembayaran</th> 
                                        <th style="text-align: center; vertical-align: top;"
                                            width="20%">Jumlah</th>  
                                        <th style="text-align: center; vertical-align: top;"
                                            width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="font-weight: bold; text-align: right">Jumlah</td>
                                        <td style="text-align: center; vertical-align: top;"
                                            width="30%"><input class="form-control form-control-sm uang" type="text" readonly id="txtJmlNtpnPbk"/></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-penilaian" role="tabpanel"
                aria-labelledby="custom-content-below-penilaian-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Penilaian
                        </h4>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST"
                        action="{{ route('pengajar.pelajar.nilai', ['spt_id' => $spt->id]) }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Penilaian</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jenis" required>
                                        <option>Pilih Jenis Penilaian</option>
                                        <option value="Project" {!! ($spt->jenis_nilai=='Project') ? 'selected' : '' !!}>Project</option>
                                        <option value="Case Study" {!! ($spt->jenis_nilai=='Case Study') ? 'selected' : '' !!}>Case Study</option>
                                        <option value="Tugas" {!! $spt->jenis_nilai == 'Tugas' ? 'selected' : '' !!}>Tugas</option>
                                        <option value="Kuis" {!! $spt->jenis_nilai == 'Kuis' ? 'selected' : '' !!}>Kuis</option>
                                        <option value="UTS" {!! $spt->jenis_nilai == 'UTS' ? 'selected' : '' !!}>UTS</option>
                                        <option value="UAS" {!! $spt->jenis_nilai == 'UAS' ? 'selected' : '' !!}>UAS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Nilai</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nilai" value="{{ $spt->nilai }}" placeholder="Nilai"
                                        required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('pengajar.pelajar.detail', ['id' => $spt->user_id]) }}"
                                class="btn btn-default float-right mr-2"><i class="fas fa-arrow-left"></i> Kembali</a>&nbsp;
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection