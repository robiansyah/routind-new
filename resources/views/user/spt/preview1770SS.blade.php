@extends('layouts.metronic')

@section('title', 'SPT 1770SS')
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
                            <span class="nav-text fw-semibold fs-4 mb-3">Bagian A</span>
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
                            <span class="nav-text fw-semibold fs-4 mb-3">Bagian B</span>
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
                            <span class="nav-text fw-semibold fs-4 mb-3">Bagian C</span>
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
                            </div>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_2" role="tabpanel">
                        <div class="table-responsive">
                            <h4 class="mt-5 mb-5">A. Pajak Penghasilan</h4>
                            <table class="table table-striped table-hover table-bordered mobile-djp">
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td colspan="2">Penghasilan Bruto Dalam Negeri Sehubungan Dengan Pekerjaan dan penghasilan neto dalam negeri</td>
                                    <td>
                                        <input type="text" id="txtBagA1" readonly name="txtBagA1" value="{{ $spt->spta->gross }}" class="form-control form-control-sm uang" style="text-align: right">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td colspan="2">Pengurangan</td>
                                    <td>
                                        <input type="text" id="txtBagA2" readonly name="txtBagA2" value="{{ $spt->spta->reduction }}" class="form-control form-control-sm uang" style="text-align: right">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Penghasilan Tidak Kena Pajak</td>
                                    <td class="special-td">
                                        <select class="form-control form-control-sm" id="ddlPtkp" disabled="disabled">
                                            <option value="0">Pilih...</option>
                                            <option value="00" {!! ($spt->spta->ptkp_type=="00") ? "selected" : "" !!}>TK/0 Tidak Kawin Tidak Ada Tanggungan</option>
                                            <option value="01" {!! ($spt->spta->ptkp_type=="01") ? "selected" : "" !!}>TK/1 Tidak Kawin Tanggungan 1 Orang</option>
                                            <option value="02" {!! ($spt->spta->ptkp_type=="02") ? "selected" : "" !!}>TK/2 Tidak Kawin Tanggungan 2 Orang</option>
                                            <option value="03" {!! ($spt->spta->ptkp_type=="03") ? "selected" : "" !!}>TK/3 Tidak Kawin Tanggungan 3 Orang</option>
                                            <option value="10" {!! ($spt->spta->ptkp_type=="10") ? "selected" : "" !!}>K/0 Kawin Tidak Ada Tanggungan</option>
                                            <option value="11" {!! ($spt->spta->ptkp_type=="11") ? "selected" : "" !!}>K/1 Kawin Tanggungan 1 Orang</option>
                                            <option value="12" {!! ($spt->spta->ptkp_type=="12") ? "selected" : "" !!}>K/2 Kawin Tanggungan 2 Orang</option>
                                            <option value="13" {!! ($spt->spta->ptkp_type=="13") ? "selected" : "" !!}>K/3 Kawin Tanggungan 3 Orang</option>
                                            <option value="20" {!! ($spt->spta->ptkp_type=="20") ? "selected" : "" !!}>K/I/0 Kawin Penghasilan Istri Digabung Tidak Ada Tanggungan</option>
                                            <option value="21" {!! ($spt->spta->ptkp_type=="21") ? "selected" : "" !!}>K/I/1 Kawin Penghasilan Istri Digabung Tanggungan 1 Orang</option>
                                            <option value="22" {!! ($spt->spta->ptkp_type=="22") ? "selected" : "" !!}>K/I/2 Kawin Penghasilan Istri Digabung Tanggungan 2 Orang</option>
                                            <option value="23" {!! ($spt->spta->ptkp_type=="23") ? "selected" : "" !!}>K/I/3 Kawin Penghasilan Istri Digabung Tanggungan 3 Orang</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" id="txtBagA3" readonly name="txtBagA3" value="{{ $spt->spta->ptkp }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td colspan="2">Penghasilan Kena Pajak</td>
                                    <td>
                                        <input type="text" id="txtBagA4" readonly name="txtBagA4" value="{{ $spt->spta->pkp }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td colspan="2" style="width: 35%;">Pajak Penghasilan Terutang</td>
                                    <td>
                                        <input type="text" id="txtBagA5" readonly name="txtBagA5" value="{{ $spt->spta->pph_debt }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td colspan="2" style="width: 35%;">Pajak Penghasilan yang telah dipotong oleh pihak lain</td>
                                    <td>
                                        <input type="text" id="txtBagA6" readonly name="txtBagA6" value="{{ $spt->spta->pph_deducted }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td colspan="2" style="width: 35%;">Nihil</td>
                                    <td>
                                        <input type="text" id="txtBagA7" readonly name="txtBagA7" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <h4 class="mt-5 mb-5">Data Pembayaran</h4>
                            <table class="table table-djp table-md table-striped table-hover" id="tblJnsPembayaran" width="100%" style="display: table; width: 100%;" role="grid" aria-describedby="tblJnsPembayaran_info">
                                <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="20%">Jenis Pembayaran</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="30%">NTPN/Nomor<br>Pemindahbukuan</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="15%">Tanggal Pembayaran</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="20%">Jumlah</th>
                                    <th style="text-align: center; vertical-align: top;"
                                        width="15%">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3" style="text-align: center;">Jumlah</td>
                                    <td style="text-align: center; vertical-align: top;"
                                        width="30%"><input class="form-control form-control-sm uang" type="text" readonly id="txtJmlNtpnPbk"/></td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_3" role="tabpanel">
                        <div class="table-responsive">
                            <h4 class="mt-5 mb-5">B. Penghasilan yang dikenakan PPh Final dan yang dikecualikan dari Objek Pajak</h4>
                            <table class="table table-striped table-hover table-bordered mobile-djp">
                                <tbody>
                                <tr>
                                    <td class="text-center">8</td>
                                    <td style="width: 65%">Dasar Pengenaan Pajak/Penghasilan Bruto Pajak Penghasilan Final</td>
                                    <td>
                                        <input type="text" id="txtBagB1" readonly name="txtBagB1" value="{{ $spt->sptb->final_gross_tax }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">9</td>
                                    <td style="width: 65%">Pajak Penghasilan Final Terutang</td>
                                    <td>
                                        <input type="text" id="txtBagB2" readonly name="txtBagB2" value="{{ $spt->sptb->pph_final }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">10</td>
                                    <td style="width: 65%">Penghasilan yang Dikecualikan dari Objek Pajak</td>
                                    <td>
                                        <input type="text" id="txtBagB3" readonly name="txtBagB3" value="{{ $spt->sptb->excluded_income }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_4" role="tabpanel">
                        <div class="table-responsive">
                            <h4 class="mt-5 mb-5">C. Daftar Harta dan Kewajiban</h4>
                            <table class="table table-striped table-hover table-bordered mobile-djp">
                                <tbody>
                                <tr>
                                    <td class="text-center">11</td>
                                    <td style="width: 65%">Jumlah Keseluruhan Harta yang Dimiliki pada Akhir Tahun Pajak</td>
                                    <td>
                                        <input type="text" id="txtBagC1" readonly name="txtBagC1" value="{{ $spt->sptc->assets }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">12</td>
                                    <td style="width: 65%">Jumlah Keseluruhan Kewajiban/Utang pada Akhir Tahun Pajak</td>
                                    <td>
                                        <input type="text" id="txtBagC2" readonly name="txtBagC2" value="{{ $spt->sptc->debt }}" class="form-control form-control-sm uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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

<script src="{{ url('assets/js/app.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/page/djpcommon.js') }}" type="text/javascript"></script>
@endsection