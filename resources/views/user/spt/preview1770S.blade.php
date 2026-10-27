
@extends('layouts.metronic')

@section('title', 'SPT 1770S')
@section('content')
<div class="row">
    <!--begin::Col-->
    <div class="col-xxl-12">
        <!--begin::Timeline widget 2-->
        <div class="card h-xl-100" id="kt_timeline_widget_2_card">
            <!--begin::Header-->
            <div class="card-header position-relative py-0 border-bottom-2">
                <!--begin::Nav-->
                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3" role="tablist">
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0 active" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_1" aria-selected="true" role="tab">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Identitas</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_2" aria-selected="false" role="tab" tabindex="-1">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Induk</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_3" aria-selected="false" role="tab" tabindex="-1">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Lampiran I</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_4" aria-selected="false" role="tab" tabindex="-1">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Lampiran II</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_5" aria-selected="false" role="tab" tabindex="-1">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Lampiran Lain</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Nav-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-1">
                <!--begin::Tab Content-->
                <div class="tab-content">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade active show" id="kt_timeline_widget_2_tab_1" role="tabpanel">
                        <h4 class="mt-5 mb-5">Identitas SPT dan Wajib Pajak</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="npwp" class="form-control-label mt-4 mb-2">NPWP</label>
                                    <h6 id="txtNpwp" style="text-align: left; font-weight: bold">{{ auth()->user()->username }}</h6>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="form-group">
                                    <label for="nama" class="form-control-label mt-4 mb-2">Nama WP</label>
                                    <h6 style="text-align: left; font-weight: bold">{{ auth()->user()->name }}</h6>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="form-group">
                                    <label for="pekerjaan" class="form-control-label mt-4 mb-2">Pekerjaan</label>
                                    <h6 style="text-align: left; font-weight: bold"></h6>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="form-group">
                                    <label for="notelp" class="form-control-label mt-4 mb-2">Nomor Telepon</label>
                                    <h6 style="text-align: left; font-weight: bold">0{{ auth()->user()->mobile_phone }}</h6>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="form-group">
                                    <label for="klu" class="form-control-label mt-4 mb-2">KLU</label>
                                    <h6 style="text-align: left; font-weight: bold"></h6>
                                </div>
                                <div class="separator separator-dashed"></div>                                                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ThnPajak" class="form-control-label mt-4 mb-2">Tahun Pajak</label>
                                    <h6 id="thnPajak" style="text-align: left;">{{ $spt->year }}</h6>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="form-group">
                                    <label for="txtPembetulanKe" class="form-control-label mt-4 mb-2">Pembetulan</label>
                                    <h6 id="txtPembetulanKe" style="text-align: left;">{{ $spt->correction_to }}</h6>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="form-group">
                                    <label for="divKewajiban" class="form-control-label mt-4 mb-2">Status Kewajiban Perpajakan Suami-Istri</label>
                                    <h6 id="txtKewajiban"></h6>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="form-group">
                                    <label for="divNpwpPasangan" class="form-control-label mt-4 mb-2">NPWP Isteri/Suami</label>
                                    <h6 id="txtNpwpPasangan"></h6>
                                </div>                                                            
                                <div class="separator separator-dashed"></div>
                            </div>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_2" role="tabpanel">
                        <div class="table-responsive">
                            <h4 class="mt-5 mb-5">Induk SPT</h4>
                            <table class="table table-striped table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan</td>
                                    <td>
                                        <input type="text" id="Idk1" class="form-control form-control-sm uang induk" value="{{ $spt->main->phNettoDN }}" style="text-align: right;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Penghasilan Neto Dalam Negeri Lainnya</td>
                                    <td>
                                        <input type="text" id="Idk2" class="form-control form-control-sm uang induk" value="{{ $spt->main->phNettoDNLain }}" style="text-align: right;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Penghasilan Neto Luar Negeri</td>
                                    <td>
                                        <input type="text" id="Idk3" class="form-control form-control-sm uang induk" value="{{ $spt->main->phLN }}" style="text-align: right;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Jumlah Penghasilan Neto (1+2+3)</td>
                                    <td>
                                        <input type="text" id="Idk4" class="form-control form-control-sm uang" value="{{ $spt->main->jmlPhNetto }}" style="text-align: right;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Zakat/Sumbangan Keagamaan yang Sifatnya Wajib</td>
                                    <td><input type="text" id="Idk5" class="form-control form-control-sm uang induk" value="{{ $spt->main->zakatSumbang }}" style="text-align: right;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>Jumlah Penghasilan Neto setelah Pengurangan Zakat/Sumbangan Keagamaan yang sifatnya Wajib (4-5)</td>
                                    <td><input type="text" id="Idk6" class="form-control form-control-sm uang" value="{{ $spt->main->jmlPhNettoAkhir }}" style="text-align: right;" readonly placeholder=""> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td>
                                        <div class="row">
                                            <!--begin::Label-->
                                            <label class="col-lg-6">Penghasilan Tidak Kena Pajak/Jumlah Tanggungan</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row">
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
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" id="Idk71" class="form-control form-control-sm uang" value="{{ $spt->main->phTKP }}" style="text-align: right;" readonly placeholder="">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">8</td>
                                    <td>Penghasilan Kena Pajak (6-7)</td>
                                    <td><input type="text" id="Idk8" class="form-control form-control-sm uang" value="{{ $spt->main->phKP }}" style="text-align: right;" readonly placeholder="">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">9</td>
                                    <td>PPh Terutang (Tarif Pasal 17 UU PPh x Angka 8)</td>
                                    <td><input type="text" id="Idk9" class="form-control form-control-sm uang" value="{{ $spt->main->pphTerutang }}" style="text-align: right;" readonly placeholder="">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">10</td>
                                    <td>Pengembalian/Pengurangan PPh Pasal 24 yang telah dikreditkan</td>
                                    <td><input type="text" id="Idk10" class="form-control form-control-sm uang induk" value="{{ $spt->main->penguranganPs24 }}" style="text-align: right;" readonly>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">11</td>
                                    <td>Jumlah PPh Terutang (9+10)</td>
                                    <td><input type="text" id="Idk11" class="form-control form-control-sm uang" value="{{ $spt->main->jmlPPhTerutang }}" style="text-align: right;" readonly placeholder="">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">12</td>
                                    <td>PPh yang dipotong/dipungut pihak lain/ditanggung pemerintah dan/atau Kredit Pajak Luar Negeri dan/atau terutang di luar negeri</td>
                                    <td><input type="text" id="Idk12" class="form-control form-control-sm uang induk"  value="{{ $spt->main->pphDipotong }}" style="text-align: right;" readonly>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">13</td>
                                    <td>PPh yang Harus Dibayar Sendiri</td>
                                    <td><input type="text" id="Idk13" class="form-control form-control-sm uang" value="{{ $spt->main->jmlBayarPPh }}" style="text-align: right;" placeholder="" readonly>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">14</td>
                                    <td>PPh Yang dibayar Sendiri --&gt; PPh Pasal 25</td>
                                    <td><input type="text" id="Idk14a" class="form-control form-control-sm uang induk" value="{{ $spt->main->pphPasal25 }}" style="text-align: right;" readonly>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"></td>
                                    <td>PPh Yang dibayar Sendiri --&gt; STP PPh Pasal 25 (Hanya Pokok Pajak)</td>
                                    <td><input type="text" id="Idk14b" class="form-control form-control-sm uang induk" value="{{ $spt->main->stppphPasal25 }}" style="text-align: right;" readonly>
                                        
                                    </td>
                                </tr>
                                <tr id="divFiskalLn" style="display: none;">
                                    <td class="text-center"></td>
                                    <td>PPh Yang dibayar Sendiri --&gt; Fiskal Luar Negeri</td>
                                    <td><input type="text" id="Idk14c" class="form-control form-control-sm uang induk" value="{{ $spt->main->fiskalLN }}" style="text-align: right;" readonly>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">15</td>
                                    <td>Jumlah Kredit Pajak (14a + 14b + 14c)</td>
                                    <td> <input type="text" id="Idk15" class="form-control form-control-sm uang" value="{{ $spt->main->jmlKreditPajak }}" style="text-align: right;" readonly placeholder="">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">16</td>
                                    <td style="width: 65%; color: rgb(0, 128, 0); font-weight: bold;" id="lblPph">PPh</td>
                                    <td> <input type="text" id="Idk16" class="form-control form-control-sm uang" value="{{ $spt->main->pph }}" style="text-align: right;" readonly placeholder="">
                                        
                                    </td>
                                </tr>
                                <tr id="barisLebihBayar" style="display: none;">
                                    <td class="text-center">17</td>
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
                                <tr>
                                    <td class="text-center">18</td>
                                    <td>Angsuran PPh Pasal 25 Tahun Pajak Berikutnya Sebesar (Dihitung Berdasarkan)</td>
                                    <td class="special-td" style="width: 35%">
                                        <select class="form-control form-control-sm" id="cbDsrHitPs25" aria-invalid="false" disabled="disabled">
                                            <option value="0" {!! ($spt->main->dsrHitAngs=="0") ? "selected" : "" !!}>Pilih..</option>
                                            <option value="1" {!! ($spt->main->dsrHitAngs=="1") ? "selected" : "" !!}>1/12 x Jumlah Pada Angka 13</option>
                                            <option value="2" {!! ($spt->main->dsrHitAngs=="2") ? "selected" : "" !!}>Penghitungan dalam lampiran tersendiri</option>
                                        </select>
                                        
                                    </td>
                                    <td style="width: 30%; text-align: center"><input type="text" class="form-control form-control-sm uang" id="IdkAngs25" value="{{ $spt->main->angsPPh25 }}" style="text-align: right;" readonly placeholder="">
                                        
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_3" role="tabpanel">
                        <div class="table-responsive">
                            <h4 class="mt-5 mb-5">Bagian A : Penghasilan Neto Dalam Negeri Lainnya(Tidak Termasuk Penghasilan Dikenakan PPh Final dan/atau Bersifat Final)</h4>
                            <table class="table table-striped table-hover table-bordered" id="lamp1A">
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Bunga</td>
                                    <td width="40%">
                                        <input type="text" id="BagA01" class="form-control form-control-sm uang bgIa" value="{{ $spt->spt1a->phBunga }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Royalti</td>
                                    <td>
                                        <input type="text" id="BagA02" class="form-control form-control-sm uang bgIa" value="{{ $spt->spt1a->phRoyalti }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Sewa</td>
                                    <td>
                                        <input type="text" id="BagA03" class="form-control form-control-sm uang bgIa" value="{{ $spt->spt1a->phSewa }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Hadiah</td>
                                    <td>
                                        <input type="text" id="BagA04" class="form-control form-control-sm uang bgIa" value="{{ $spt->spt1a->phHadiah }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Keuntungan dari Penjualan/Pengalihan Harta</td>
                                    <td>
                                        <input type="text" id="BagA05" class="form-control form-control-sm uang bgIa" value="{{ $spt->spt1a->phAlihHarta }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>Penghasilan Lain</td>
                                    <td>
                                        <input type="text" id="BagA06" class="form-control form-control-sm uang bgIa" value="{{ $spt->spt1a->phLain }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="special-td" colspan="2" class="text-center">Jumlah Bagian A</td>
                                    <td> <input type="text" id="txtJumlahA" class="form-control form-control-sm uang" value="{{ $spt->spt1a->phBunga + $spt->spt1a->phRoyalti + $spt->spt1a->phSewa + $spt->spt1a->phHadiah + $spt->spt1a->phAlihHarta + $spt->spt1a->phLain }}" style="text-align: right; font-weight: bold" readonly>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <h4 class="mt-5 mb-5">Bagian B : Penghasilan yang Tidak Termasuk Objek Pajak</h4>
                            <table class="table table-striped table-hover table-bordered" id="lamp1A">
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Bantuan/Sumbangan/Hibah</td>
                                    <td width="30%">
                                        <input type="text" id="BagB01" class="form-control form-control-sm uang bgIb" value="{{ $spt->spt1b->bantuanHibah }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Warisan</td>
                                    <td>
                                        <input type="text" id="BagB02" class="form-control form-control-sm uang bgIb" value="{{ $spt->spt1b->warisan }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Bagian Laba Anggota Perseroan Komanditer tidak atas saham, persekutuan, perkumpulan, firma, kongsi</td>
                                    <td>
                                        <input type="text" id="BagB03" class="form-control form-control-sm uang bgIb" value="{{ $spt->spt1b->labaAnggota }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Klaim Asuransi Kesehatan, Kecelakaan, Jiwa, Dwiguna, Beasiswa</td>
                                    <td>
                                        <input type="text" id="BagB04" class="form-control form-control-sm uang bgIb" value="{{ $spt->spt1b->asuransi }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Beasiswa</td>
                                    <td>
                                        <input type="text" id="BagB05" class="form-control form-control-sm uang bgIb" value="{{ $spt->spt1b->beasiswa }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>Penghasilan Lainnya yang tidak termasuk Objek Pajak</td>
                                    <td>
                                        <input type="text" id="BagB06" class="form-control form-control-sm uang bgIb" value="{{ $spt->spt1b->phBOPLain }}" style="text-align: right" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="special-td" colspan="2" class="text-center">Jumlah Bagian B</td>
                                    <td> <input type="text" id="txtJumlahB" class="form-control form-control-sm uang" value="{{ $spt->spt1b->bantuanHibah + $spt->spt1b->warisan + $spt->spt1b->labaAnggota + $spt->spt1b->asuransi + $spt->spt1b->beasiswa + $spt->spt1b->phBOPLain }}" style="text-align: right; font-weight: bold" readonly>
                                        </td>
                                </tr>
                                </tbody>
                            </table>
                            <h4 class="mt-5 mb-5">Bagian C : Daftar Pemotongan/Pemungutan PPh Oleh Pihak Lain dan PPh Yang Ditanggung Pemerintah </h4>
                            <table class="table table-bordered table-striped table-hover">
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
                                @php($jac=0)
                                @if(count($spt->spt1c))
                                    @foreach($spt->spt1c as $item)
                                        <tr>
                                            <td>{{ $item->nmPemotong }}</td>
                                            <td>{{ $item->npwpPemotong }}</td>
                                            <td>{{ $item->nomorBP }}</td>
                                            <td>{{ $item->tglBP }}</td>
                                            <td>{{ $item->pasalPph }}</td>
                                            <td>@money($item->jmlPPhDiPotong)</td>
                                            <td></td>
                                        </tr>
                                        @php($jac += $item->jmlPPhDiPotong)
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="font-weight: bold; text-align: right;" rowspan="1">JAC</td>
                                        <td rowspan="1" colspan="1">
                                            <input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly value="{{ $jac }}">
                                        </td>
                                        <td rowspan="1" colspan="1"></td>
                                    </tr>     
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_4" role="tabpanel">
                        <div class="table-responsive">
                            <h4 class="mt-5 mb-5">Bagian A. Penghasilan yang dikenakan PPh Final dan/atau bersifat final</h4>
                            <table class="table table-bordered table-striped table-hover" id="tblPphFinal" width="100%" aria-describedby="tblPphFinal_info">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: top;"
                                            width="37%">Sumber/Jenis Penghasilan</th>
                                        <th style="text-align: center; vertical-align: top;"
                                            width="30%">DPP/Penghasilan Bruto</th>
                                        <th style="text-align: center; vertical-align: top;"
                                            width="30%">PPh Terutang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($jba=0)
                                @if($spt->spt2a->phBungaDep != null)
                                    <tr>
                                        <td>Bunga Deposito, Tabungan, Diskonto SBI,Surat Berharga Negara</td>
                                        <td>@money($spt->spt2a->phBungaDep)</td>
                                        <td>@money($spt->spt2a->pjkBungaDep)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkBungaDep)
                                @endif
                                @if($spt->spt2a->phBungaObl != null)
                                    <tr>
                                        <td>Bunga/Diskonto Obligasi</td>
                                        <td>@money($spt->spt2a->phBungaObl)</td>
                                        <td>@money($spt->spt2a->pjkBungaObl)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkBungaOb)
                                @endif
                                @if($spt->spt2a->phJualSaham != null)
                                    <tr>
                                        <td>Penjualan Saham di Bursa Efek</td>
                                        <td>@money($spt->spt2a->phJualSaham)</td>
                                        <td>@money($spt->spt2a->pjkJualSaham)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkJualSah)
                                @endif
                                @if($spt->spt2a->phHadiah != null)
                                    <tr>
                                        <td>Hadiah Undian</td>
                                        <td>@money($spt->spt2a->phHadiah)</td>
                                        <td>@money($spt->spt2a->pjkHadiah)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkHadiah )
                                @endif
                                @if($spt->spt2a->phPesangon != null)
                                    <tr>
                                        <td>Pesangon, Tunjangan Hari Tua, dan tebusan Pensiun yang dibayarkan sekaligus</td>
                                        <td>@money($spt->spt2a->phPesangon)</td>
                                        <td>@money($spt->spt2a->pjkPesangon)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkPesango)
                                @endif
                                @if($spt->spt2a->phHonor != null)
                                    <tr>
                                        <td>Honorarium Atas Beban APBD/APBN</td>
                                        <td>@money($spt->spt2a->phHonor)</td>
                                        <td>@money($spt->spt2a->pjkHonor)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkHonor)
                                @endif
                                @if($spt->spt2a->phAlihTB != null)
                                    <tr>
                                        <td>Pengalihan Hak Atas Tanah dan Bangunan</td>
                                        <td>@money($spt->spt2a->phAlihTB)</td>
                                        <td>@money($spt->spt2a->pjkAlihTB)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkAlihTB )
                                @endif
                                @if($spt->spt2a->phSewaTB != null)
                                    <tr>
                                        <td>Sewa Atas Tanah dan Bangunan</td>
                                        <td>@money($spt->spt2a->phSewaTB)</td>
                                        <td>@money($spt->spt2a->pjkSewaTB)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkSewaTB)
                                @endif
                                @if($spt->spt2a->phBgnGunaSerah != null)
                                    <tr>
                                        <td>Bangunan yang diterima dalam rangka Bangun Guna Serah</td>
                                        <td>@money($spt->spt2a->phBgnGunaSerah)</td>
                                        <td>@money($spt->spt2a->pjkBgnGunaSerah)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkBgnGuna)
                                @endif
                                @if($spt->spt2a->phBungaSimp != null)
                                    <tr>
                                        <td>Bunga Simpanan yang diserahkan oleh Koperasi kepada Anggota Koperasi</td>
                                        <td>@money($spt->spt2a->phBungaSimp)</td>
                                        <td>@money($spt->spt2a->pjkBungaSimp)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkBungaSi)
                                @endif
                                @if($spt->spt2a->phTrDerivatif != null)
                                    <tr>
                                        <td>Transaksi Derivatif</td>
                                        <td>@money($spt->spt2a->phTrDerivatif)</td>
                                        <td>@money($spt->spt2a->pjkTrDerivatif)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkTrDeriv)
                                @endif
                                @if($spt->spt2a->phDividen != null)
                                    <tr>
                                        <td>Dividen</td>
                                        <td>@money($spt->spt2a->phDividen)</td>
                                        <td>@money($spt->spt2a->pjkDividen)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkDividen)
                                @endif
                                @if($spt->spt2a->phIstri != null)
                                    <tr>
                                        <td>Penghasilan Istri Dari Satu Pemberi Kerja</td>
                                        <td>@money($spt->spt2a->phIstri)</td>
                                        <td>@money($spt->spt2a->pjkPhIstri)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkPhIstri)
                                @endif
                                @if($spt->spt2a->phLain != null)
                                    <tr>
                                        <td>Penghasilan Lain Yang Dikenakan Pajak Final Dan/Atau Bersifat Final</td>
                                        <td>@money($spt->spt2a->phLain)</td>
                                        <td>@money($spt->spt2a->pjkPhLain)</td>
                                    </tr>
                                    @php($jba += $spt->spt2a->pjkPhLain)
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="font-weight: bold; text-align: right;">Jumlah</td>
                                        <td style="text-align: center; vertical-align: top;"
                                            width="30%"><input class="form-control form-control-sm uang" type="text" readonly value="{{ $jba }}"/></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <h4 class="mt-5 mb-5">Bagian B : Harta Pada Akhir Tahun</h4>
                            <table class="table table-bordered table-striped table-hover" id="tblHarta" aria-describedby="tblHarta_info">
                                <thead>
                                    <tr>
                                        <th style="font-size: small;text-align: center;width: 30%">Kode Harta</th>
                                        <th style="font-size: small;text-align: center;width: 30%">Nama Harta</th>
                                        <th style="font-size: small;text-align: center;width: 5%">Tahun Perolehan</th>
                                        <th style="font-size: small;text-align: center;width: 25%">Harga Perolehan</th>
                                        <th style="font-size: small;text-align: center;width: 30%">Keterangan</th>
                                        <th style="font-size: small;text-align: center;width: 10%">Aksi</th>                                                                              
                                    </tr>    
                                </thead>
                                <tbody>
                                @php($jbb=0)
                                @if(count($spt->spt2b))
                                    @foreach($spt->spt2b as $item)
                                        <tr>
                                            <td>{{ $item->kodeHarta }}</td>
                                            <td>{{ $item->jnsHarta }}</td>
                                            <td>{{ $item->thPerolehan }}</td>
                                            <td>@money($item->harga)</td>
                                            <td>{{ $item->ket }}</td>
                                            <td></td>
                                        </tr>
                                        @php($jbb += $item->harga)
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr>                                                                       
                                        <td colspan="3" style="font-weight: bold; text-align: right">Sub Total</td>
                                        <td><input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly value="{{ $jbb }}"/></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>                                                                       
                                        <td colspan="3" style="font-weight: bold; text-align: right">Jumlah Bagian B (JBB)</td>
                                        <td><input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly value="{{ $jbb }}"/></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <h4 class="mt-5 mb-5">Bagian C : Kewajiban/Utang Pada Akhir Tahun</h4>
                            <table class="table table-bordered table-striped table-hover" id="tblHutang" aria-describedby="tblHutang_info">
                                <thead>
                                    <tr>
                                        <th style="font-size: small;text-align: center;width: 5%">Kode Utang</th>
                                        <th style="font-size: small;text-align: center;width: 25%">Nama Pemberi Pinjaman</th>
                                        <th style="font-size: small;text-align: center;width: 30%">Alamat Pemberi Pinjaman</th>
                                        <th style="font-size: small;text-align: center;width: 10%">Tahun Peminjaman</th>
                                        <th style="font-size: small;text-align: center;width: 20%">Jumlah</th>
                                        <th style="font-size: small;text-align: center;width: 10%">Aksi</th>                                                                              
                                    </tr>    
                                </thead>
                                <tbody>
                                @php($jbc=0)
                                @if(count($spt->spt2c))
                                    @foreach($spt->spt2c as $item)
                                        <tr>
                                            <td>{{ $item->kodeUtang }}</td>
                                            <td>{{ $item->nmPbrPinjam }}</td>
                                            <td>{{ $item->almtPbrPinjam }}</td>
                                            <td>{{ $item->thPinjam }}</td>
                                            <td>@money($item->jmlPinjam)</td>
                                            <td></td>
                                        </tr>
                                        @php($jbc += $item->jmlPinjam)
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr>                                                                       
                                        <td colspan="4" style="font-weight: bold; text-align: right">Sub Total</td>
                                        <td><input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly value="{{ $jbc }}"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>                                                                       
                                        <td colspan="4" style="font-weight: bold;  text-align: right">Jumlah Bagian C (JBC)</td>
                                        <td><input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly value="{{ $jbc }}"/></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <h4 class="mt-5 mb-5">Bagian D : Daftar Susunan Anggota Keluarga</h4>
                            <table class="table table-bordered table-striped table-hover" id="tblTanggungan" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th style="font-size: small;text-align: center;width: 20%">Nama</th>
                                        <th style="font-size: small;text-align: center;width: 20%">Tanggal Lahir</th>
                                        <th style="font-size: small;text-align: center;width: 20%">NIK</th>
                                        <th style="font-size: small;text-align: center;width: 20%">Hubungan Keluarga</th>
                                        <th style="font-size: small;text-align: center;width: 20%">Pekerjaan</th>
                                        <th style="font-size: small;text-align: center;width: 20%">Aksi</th>
                                    </tr>    
                                </thead>
                                <tbody>
                                @if(count($spt->spt2d))
                                    @foreach($spt->spt2d as $item)
                                        <tr>
                                            <td>{{ $item->nmAgKel }}</td>
                                            <td>{{ $item->tglLahir }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->hubKel }}</td>
                                            <td>{{ $item->kerja }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody> 
                            </table>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_5" role="tabpanel">
                        <div class="panelPisahHarta">
                            <h4 class="mt-5 mb-5">Panel Perhitungan PPh untuk Status PH atau MT</h4>
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
                                        
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row my-2">
                                <div class="col-md-1"></div>
                                <label class="col-form-label col-md-3" style="text-align: right">Penghasilan Netto Istri</label>                                                                      
                                <div class="col-md-6">
                                    <input type="text" id="idkPenghasilanIstri" class="form-control form-control-sm uang induk" style="text-align: right;" readonly>
                                        
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                        <div class="panelPembayaran">
                            <h4 class="mt-5 mb-5">Data Pembayaran</h4>
                            <table class="table table-striped table-hover table-bordered" id="tblPembayaran" width="100%">
                                <tbody>
                                    <tr id="barisTglNtpn">
                                        <td class="text-center">-</td>
                                        <td colspan="2">Tanggal Pelunasan</td>                                                                      
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
                                <table class="table table-striped table-hover" id="tblJnsPembayaran" aria-describedby="tblJnsPembayaran_info">
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
                                    <tbod>
                                        @php($ntpn = 0)
                                        @if(count($spt->payments))
                                            @foreach($spt->payments as $item)
                                                <tr>
                                                    <td>{!! ($item->jnstrx==1) ? 'NTPN' : 'Pemidahbukuan'  !!}</td>
                                                    <td>{{ $item->ntpnPbk }}</td>
                                                    <td>{{ $item->tglBayar }}</td>
                                                    <td>@money($item->nilai)</td>
                                                    <td></td>
                                                </tr>
                                                @php($ntpn += $item->nilai)
                                            @endforeach
                                        @endif
                                    </tbod>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" style="font-weight: bold; text-align: right">Jumlah</td>
                                            <td style="text-align: center; vertical-align: top;"
                                                width="30%"><input class="form-control form-control-sm uang" type="text" readonly value="{{ $ntpn }}"/></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                </div>
                <!--end::Tab Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Tables Widget 2-->
    </div>
    <!--end::Col-->
</div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
    <script>
        $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});
    </script>
@endsection