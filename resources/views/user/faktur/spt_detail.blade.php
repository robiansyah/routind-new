@extends('layouts.metronic')

@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .tooltip .tooltip-inner{
            max-width: 500px !important;
            width: 400px !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'SPT Detail')
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
                            <span class="nav-text fw-semibold fs-4 mb-3">Lampiran Detail</span>
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
                            <span class="nav-text fw-semibold fs-4 mb-3">Lampiran AB</span>
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
                            <span class="nav-text fw-semibold fs-4 mb-3">Induk</span>
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
            <div class="card-body">
                <!--begin::Tab Content-->
                <div class="tab-content">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade active show" id="kt_timeline_widget_2_tab_1" role="tabpanel">
                        <div class="table-responsive mb-5 py-5">
                            <h4>Formulir 1111 A1 - Daftar Ekspor BKP Berwujud, BKP Tidak Berwujud dan/atau JKP</h4>
                            <!--begin::Table-->
                            <table class="table table-bordered border-gray-600">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th rowspan="2" class="text-center align-middle">No</th>
                                        <th rowspan="2" class="text-center align-middle">Nama Pembeli</th>
                                        <th colspan="2">Dokumen Tertentu</th>
                                        <th rowspan="2" class="text-center align-middle">DPP</th>
                                        <th rowspan="2" class="text-center align-middle">Keterangan</th>
                                    </tr>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php $no=1; $total=0;?>
                                    @foreach ($dok as $item)
                                    @if($item->type=='A1')
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->doc_no }}</td>
                                        <td>{{ $item->doc_date }}</td>
                                        <td class="text-end">@money($item->dpp)</td>
                                        <td></td>
                                    </tr>
                                    <?php $total += $item->dpp;?>
                                    @endif
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                                <!--begin::Table foot-->
                                <tfoot>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <td colspan="4" class="text-center">Jumlah A1</td>
                                        <td class="text-end">@money($total)</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                <!--end::Table foot-->
                            </table>
                        </div>
                        <div class="table-responsive mb-5 py-5">
                            <h4>Formulir 1111 A2 - Daftar Pajak Keluaran atas Penyerahan Dalam Negeri dengan Faktur Pajak</h4>
                            <!--begin::Table-->
                            <table class="table table-bordered border-gray-600">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th rowspan="2" class="text-center align-middle">No</th>
                                        <th rowspan="2" class="text-center align-middle">Nama Pembeli</th>
                                        <th rowspan="2" class="text-center align-middle">NPWP</th>
                                        <th colspan="2">Faktur Pajak</th>
                                        <th rowspan="2" class="text-center align-middle">DPP</th>
                                        <th rowspan="2" class="text-center align-middle">PPN</th>
                                        <th rowspan="2" class="text-center align-middle">PPnBM</th>
                                        <th rowspan="2" class="text-center align-middle">Keterangan</th>
                                    </tr>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>Kode & No Seri</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php $no=1; $dpp=0; $ppn=0; $ppnbm=0;?>
                                    @foreach ($faktur as $item)
                                    @if($item->type=='A2')
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->npwp }}</td>
                                        <td>{{ $item->transaction_code.'.'.$item->invoice_no }}</td>
                                        <td>{{ $item->invoice_date }}</td>
                                        <td class="text-end">@money($item->dpp)</td>
                                        <td class="text-end">@money($item->ppn)</td>
                                        <td class="text-end">@money($item->ppnbm)</td>
                                        <td>{{ $item->retur_no }}</td>
                                    </tr>
                                    <?php $dpp += $item->dpp; $ppn += $item->ppn; $ppnbm += $item->ppnbm;?>
                                    @endif
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                                <!--begin::Table foot-->
                                <tfoot>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <td colspan="5" class="text-center">Jumlah A2</td>
                                        <td class="text-end">@money($dpp)</td>
                                        <td class="text-end">@money($ppn)</td>
                                        <td class="text-end">@money($ppnbm)</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                <!--end::Table foot-->
                            </table>
                        </div>
                        <div class="table-responsive mb-5 py-5">
                            <h4>Formulir 1111 B1 - Daftar Pajak Masukan yang Dapat Dikreditkan atas Impor BKP dan Pemanfaatan BKP Tidak Berwujud/JKP dari Luar Daerah Pabean</h4>
                            <!--begin::Table-->
                            <table class="table table-bordered border-gray-600">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th rowspan="2" class="text-center align-middle">No</th>
                                        <th rowspan="2" class="text-center align-middle">Nama Pembeli</th>
                                        <th colspan="2">Dokumen Tertentu</th>
                                        <th rowspan="2" class="text-center align-middle">DPP</th>
                                        <th rowspan="2" class="text-center align-middle">PPN</th>
                                        <th rowspan="2" class="text-center align-middle">PPnBM</th>
                                        <th rowspan="2" class="text-center align-middle">Keterangan</th>
                                    </tr>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php $no=1; $dpp=0; $ppn=0; $ppnbm=0;?>
                                    @foreach ($dok as $item)
                                    @if($item->type=='B1')
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->doc_no }}</td>
                                        <td>{{ $item->doc_date }}</td>
                                        <td class="text-end">@money($item->dpp)</td>
                                        <td class="text-end">@money($item->ppn)</td>
                                        <td class="text-end">@money($item->ppnbm)</td>
                                        <td></td>
                                    </tr>
                                    <?php $dpp += $item->dpp; $ppn += $item->ppn; $ppnbm += $item->ppnbm;?>
                                    @endif
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                                <!--begin::Table foot-->
                                <tfoot>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <td colspan="4" class="text-center">Jumlah B1</td>
                                        <td class="text-end">@money($dpp)</td>
                                        <td class="text-end">@money($ppn)</td>
                                        <td class="text-end">@money($ppnbm)</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                <!--end::Table foot-->
                            </table>
                        </div>
                        <div class="table-responsive mb-5 py-5">
                            <h4>Formulir 1111 B2 - Daftar Pajak Masukan yang Dapat Dikreditkan atas Perolehan BKP/JKP dalam Negeri</h4>
                            <!--begin::Table-->
                            <table class="table table-bordered border-gray-600">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th rowspan="2" class="text-center align-middle">No</th>
                                        <th rowspan="2" class="text-center align-middle">Nama Penjual</th>
                                        <th rowspan="2" class="text-center align-middle">NPWP</th>
                                        <th colspan="2">Faktur Pajak</th>
                                        <th rowspan="2" class="text-center align-middle">DPP</th>
                                        <th rowspan="2" class="text-center align-middle">PPN</th>
                                        <th rowspan="2" class="text-center align-middle">PPnBM</th>
                                        <th rowspan="2" class="text-center align-middle">Keterangan</th>
                                    </tr>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>Kode & No Seri</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php $no=1; $dpp=0; $ppn=0; $ppnbm=0;?>
                                    @foreach ($faktur as $item)
                                    @if($item->type=='B2')
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->npwp }}</td>
                                        <td>{{ $item->transaction_code.'.'.$item->invoice_no }}</td>
                                        <td>{{ $item->invoice_date }}</td>
                                        <td class="text-end">@money($item->dpp)</td>
                                        <td class="text-end">@money($item->ppn)</td>
                                        <td class="text-end">@money($item->ppnbm)</td>
                                        <td>{{ $item->retur_no }}</td>
                                    </tr>
                                    <?php $dpp += $item->dpp; $ppn += $item->ppn; $ppnbm += $item->ppnbm;?>
                                    @endif
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                                <!--begin::Table foot-->
                                <tfoot>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <td colspan="5" class="text-center">Jumlah B2</td>
                                        <td class="text-end">@money($dpp)</td>
                                        <td class="text-end">@money($ppn)</td>
                                        <td class="text-end">@money($ppnbm)</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                <!--end::Table foot-->
                            </table>
                        </div>
                        <div class="table-responsive mb-5 py-5">
                            <h4>Formulir 1111 B3 - Daftar Pajak Masukan yang Tidak Dapat Dikreditkan atau yang Mendapat Fasilitas</h4>
                            <!--begin::Table-->
                            <table class="table table-bordered border-gray-600">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th rowspan="2" class="text-center align-middle">No</th>
                                        <th rowspan="2" class="text-center align-middle">Nama Penjual</th>
                                        <th rowspan="2" class="text-center align-middle">NPWP</th>
                                        <th colspan="2">Faktur Pajak</th>
                                        <th rowspan="2" class="text-center align-middle">DPP</th>
                                        <th rowspan="2" class="text-center align-middle">PPN</th>
                                        <th rowspan="2" class="text-center align-middle">PPnBM</th>
                                        <th rowspan="2" class="text-center align-middle">Keterangan</th>
                                    </tr>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>Kode & No Seri</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php $no=1; $dpp=0; $ppn=0; $ppnbm=0;?>
                                    @foreach ($faktur as $item)
                                    @if($item->type=='B3')
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->npwp }}</td>
                                        <td>{{ $item->transaction_code.'.'.$item->invoice_no }}</td>
                                        <td>{{ $item->invoice_date }}</td>
                                        <td class="text-end">@money($item->dpp)</td>
                                        <td class="text-end">@money($item->ppn)</td>
                                        <td class="text-end">@money($item->ppnbm)</td>
                                        <td>{{ $item->retur_no }}</td>
                                    </tr>
                                    <?php $dpp += $item->dpp; $ppn += $item->ppn; $ppnbm += $item->ppnbm;?>
                                    @endif
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                                <!--begin::Table foot-->
                                <tfoot>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <td colspan="5" class="text-center">Jumlah B3</td>
                                        <td class="text-end">@money($dpp)</td>
                                        <td class="text-end">@money($ppn)</td>
                                        <td class="text-end">@money($ppnbm)</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                <!--end::Table foot-->
                            </table>
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_2" role="tabpanel">
                        <form id="itemForm" action="#" method="POST" class="table-responsive">
                            
                            <input type="hidden" name="category" value="lampiran_ab">
                            <input type="hidden" id="dpp_a21_init" value="{{ $induk->dpp_a21 }}">
                            <input type="hidden" id="ppn_a21_init" value="{{ $induk->ppn_a21 }}">
                            <input type="hidden" id="ppnbm_a21_init" value="{{ $induk->ppnbm_a21 }}">
                            <h4>I. REKAPITULASI PENYERAHAN</h4>
                            <table class="table table-row-bordered mb-10">
                                <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th colspan="2">URAIAN</th>
                                        <th class="text-center" width="15%">DPP</th>
                                        <th class="text-center" width="15%">PPN</th>
                                        <th class="text-center" width="15%">PPnBM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">A. Ekspor BKP Berwujud / BKP Tidak Berwujud/JKP</td>
                                        <td class="text-center">@money($induk->dpp_a1)</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">B. Penyerahan Dalam Negeri</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>1. Penyerahan Dalam Negeri dengan Faktur Pajak yang Tidak Digunggung</td>
                                        <td class="text-center">@money($induk->dpp_a2)</td>
                                        <td class="text-center">@money($induk->ppn_a2)</td>
                                        <td class="text-center">@money($induk->ppnbm_a2)</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>2. Penyerahan Dalam Negeri dengan Faktur Pajak yang Digunggung</td>
                                        <td><input class="form-control form-control-sm text-center w-auto uang hitung_a2" name="dpp_a2_covered" id="dpp_a2_covered" value="{{ $induk->dpp_a2_covered }}"></td>
                                        <td><input class="form-control form-control-sm text-center w-auto uang hitung_a2" name="ppn_a2_covered" id="ppn_a2_covered" value="{{ $induk->ppn_a2_covered }}"></td>
                                        <td><input class="form-control form-control-sm text-center w-auto uang hitung_a2" name="ppnbm_a2_covered" id="ppnbm_a2_covered" value="{{ $induk->ppnbm_a2_covered }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">C. Rincian Penyerahan Dalam Negeri</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>1. Penyerahan yang PPN atau PPN dan PPnBM-nya harus dipungut sendiri</td>
                                        <td class="text-center" id="dpp_a21">@money($induk->dpp_a21+$induk->dpp_a2_covered)</td>
                                        <td class="text-center" id="ppn_a21">@money($induk->ppn_a21+$induk->ppn_a2_covered)</td>
                                        <td class="text-center" id="ppnbm_a21">@money($induk->ppnbm_a21+$induk->ppnbm_a2_covered)</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>2. Penyerahan yang PPN atau PPN dan PPnBM-nya dipungut oleh Pemungut PPN</td>
                                        <td class="text-center">@money($induk->dpp_a22)</td>
                                        <td class="text-center">@money($induk->ppn_a22)</td>
                                        <td class="text-center">@money($induk->ppnbm_a22)</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>3. Penyerahan yang PPN atau PPN dan PPnBM-nya tidak dipungut</td>
                                        <td class="text-center">@money($induk->dpp_a23)</td>
                                        <td class="text-center">@money($induk->ppn_a23)</td>
                                        <td class="text-center">@money($induk->ppnbm_a23)</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>4. Penyerahan yang dibebaskan dari pengenaan PPN atau PPN dan PPnBM-nya</td>
                                        <td class="text-center">@money($induk->dpp_a24)</td>
                                        <td class="text-center">@money($induk->ppn_a24)</td>
                                        <td class="text-center">@money($induk->ppnbm_a24)</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>II. REKAPITULASI PEROLEHAN</h4>
                            <table class="table table-row-bordered mb-10">
                                <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th colspan="2">URAIAN</th>
                                        <th class="text-center" width="15%">DPP</th>
                                        <th class="text-center" width="15%">PPN</th>
                                        <th class="text-center" width="15%">PPnBM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">A. Impor BKP, Pemanfaatan BKP Tidak Berwujud dari Luar Daerah Pabean, dan Pemanfaatan JKP dari Luar Daerah Pabean Yang PM-nya dapat dikreditkan</td>
                                        <td class="text-center">@money($induk->dpp_b1)</td>
                                        <td class="text-center">@money($induk->ppn_b1)</td>
                                        <td class="text-center">@money($induk->ppnbm_b1)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">B. Perolehan BKP/JKP dari Dalam Negeri yang PM-nya dapat Dikreditkan</td>
                                        <td class="text-center">@money($induk->dpp_b2)</td>
                                        <td class="text-center">@money($induk->ppn_b2)</td>
                                        <td class="text-center">@money($induk->ppnbm_b2)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">C. Impor atau Perolehan Yang PM-nya Tidak Dapat Dikreditkan dan/atau Impor atau Perolehan yang Mendapat Fasilitas</td>
                                        <td class="text-center">@money($induk->dpp_b3)</td>
                                        <td class="text-center">@money($induk->ppn_b3)</td>
                                        <td class="text-center">@money($induk->ppnbm_b3)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">D. Jumlah Perolehan (II.A + II.B + II.C)</td>
                                        <td class="text-center">@money($induk->dpp_b1+$induk->dpp_b2+$induk->dpp_b3)</td>
                                        <td class="text-center">@money($induk->ppn_b1+$induk->ppn_b2+$induk->ppn_b3)</td>
                                        <td class="text-center">@money($induk->ppnbm_b1+$induk->ppnbm_b2+$induk->ppnbm_b3)</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>III. PERHITUNGAN PM YANG DAPAT DIKREDITKAN</h4>
                            <table class="table table-row-bordered mb-10">
                                <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th colspan="3">URAIAN</th>
                                        <th class="text-center" width="15%">PPN</th>
                                        <th class="text-center" width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3">A. Pajak Masukan atas Perolehan yang Dapat Dikreditkan ( II.A + II.B)</td>
                                        <td class="text-center" id="ppn_3a">@money($induk->ppn_b1+$induk->ppn_b2)</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">B. Pajak Masukan Lainnya</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">1. Kompensasi kelebihan PPN Masa Pajak sebelumnya</td>
                                        <td><input class="form-control form-control-sm text-center w-auto uang" name="ppn_input" id="ppn_input" value="{{ $induk->ppn_input }}"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">2. Kompensasi kelebihan karena pembetulan SPT PPN Masa Pajak (mm-yyyy)
                                        </td>
                                        <td class="text-center">0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">3. Hasil Perhitungan Kembali Pajak Masukan yang telah dikreditkan sebagai penambah (pengurang) Pajak Masukan</td>
                                        <td><input class="form-control form-control-sm text-center w-auto uang" name="ppn_correction" id="ppn_correction" value="{{ $induk->ppn_correction }}"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><strong>4. Jumlah (III.B.1 + III.B.2 + III.B.3)</strong></td>
                                        <td class="text-center" id="ppn_3b">@money($induk->ppn_correction+$induk->ppn_input)</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">C. Jumlah Pajak Masukan yang Dapat Diperhitungkan (III.A + III.B.4)</td>
                                        <td class="text-center" id="ppn_3c">@money($induk->ppn_b1+$induk->ppn_b2+$induk->ppn_correction+$induk->ppn_input)</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="p-5">
                                <h4>PERNYATAAN</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pernyataan_ab" id="pernyataan_ab" {!! ($induk->submit_ab=='ya') ? 'checked' : '' !!} required/>
                                    <label class="form-check-label text-danger">
                                        DENGAN MENYADARI SEPENUHNYA AKAN SEGALA AKIBATNYA, SAYA MENYATAKAN BAHWA APA YANG TELAH SAYA BERITAHUKAN DIATAS BESERTA LAMPIRAN-LAMPIRANNYA ADALAH BENAR, LENGKAP, JELAS DAN TIDAK BERSYARAT 
                                    </label>
                                    <label id="pernyataan_ab-error" class="error text-danger" for="pernyataan_ab"></label>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer d-flex justify-content-end py-1 pt-5 px-9">
                            <a href="{{ route('spt.index', ['status'=>'konsep']) }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                            <button type="submit" id="itemBtn" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Submit</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_3" role="tabpanel">
                        <form method="POST" id="indukForm" class="table-responsive">
                            <input type="hidden" name="category" value="induk">
                            <h4>I. PENYERAHAN BARANG DAN JASA</h4>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                    <tr>
                                        <td colspan="2">A. Terutang PPN</td>
                                        <td class="text-center" width="15%">DPP</td>
                                        <td class="text-center" width="15%">PPN</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>1. Ekspor</td>
                                        <td class="text-center">@money($induk->dpp_a1)</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>2. Penyerahan yang PPN-nya harus dipungut sendiri</td>
                                        <td class="text-center" id="dpp_a21_induk">@money($induk->dpp_a21+$induk->dpp_a2_covered)</td>
                                        <td class="text-center" id="ppn_a21_induk">@money($induk->ppn_a21+$induk->ppn_a2_covered)</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>3. Penyerahan yang PPN-nya dipungut oleh Pemungut PPN</td>
                                        <td class="text-center" id="dpp_a22_induk">@money($induk->dpp_a22)</td>
                                        <td class="text-center" id="ppn_a22_induk">@money($induk->ppn_a22)</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>4. Penyerahan yang PPN-nya tidak dipungut</td>
                                        <td class="text-center" id="dpp_a23_induk">@money($induk->dpp_a23)</td>
                                        <td class="text-center" id="ppn_a23_induk">@money($induk->ppn_a23)</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>5. Penyerahan yang dibebaskan dari pengenaan PPN</td>
                                        <td class="text-center" id="dpp_a24_induk">@money($induk->dpp_a24)</td>
                                        <td class="text-center" id="ppn_a24_induk">@money($induk->ppn_a24)</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Jumlah (I.A.1 + I.A.2 + I.A.3 + I.A.4 + I.A.5 )</td>
                                        <td class="text-center" id="dpp_jumlah">@money($induk->dpp_a21+$induk->dpp_a22+$induk->dpp_a23+$induk->dpp_a24+$induk->dpp_a2_covered)</td>
                                        <td class="text-center" id="ppn_jumlah">@money($induk->ppn_a21+$induk->ppn_a22+$induk->ppn_a23+$induk->ppn_a24+$induk->ppn_a2_covered)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">B. Tidak Terutang PPN</td>
                                        <td><input class="form-control form-control-sm text-center w-auto uang" name="dpp_not" id="dpp_not" value="{{ $induk->dpp_not }}"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">C. Jumlah Seluruh Penyerahan ( I.A + I.B)</td>
                                        <td class="text-center" id="dpp_all">@money($induk->dpp_a21+$induk->dpp_a22+$induk->dpp_a23+$induk->dpp_a24+$induk->dpp_a2_covered+$induk->dpp_not)</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>II. PENGHITUNGAN PPN KURANG/LEBIH BAYAR</h4>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                    <tr>
                                        <td>A. Pajak Keluaran yang harus dipungut sendiri</td>
                                        <td width="15%"></td>
                                        <td class="text-center" id="ppn_a21_induk2">@money($induk->ppn_a21+$induk->ppn_a2_covered)</td>
                                    </tr>
                                    <tr>
                                        <td>B. PPN disetor dimuka dalam Masa Pajak yang sama</td>
                                        <td></td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>C. Pajak Masukan yang dapat diperhitungkan</td>
                                        <td></td>
                                        <td class="text-center" id="ppn_calculated">@money($induk->ppn_calculated)</td>
                                    </tr>
                                    <tr>
                                        <td>D. PPN kurang atau (lebih) bayar (II.A-II.B-II.C)</td>
                                        <td></td>
                                        <td class="text-center" id="ppn_kurang">@money(($induk->ppn_a21+$induk->ppn_a2_covered)-($induk->ppn_calculated))</td>
                                    </tr>
                                    <tr>
                                        <td>E. PPN kurang atau (lebih) bayar pada SPT yang dibetulkan</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>F. PPN kurang atau (lebih) bayar karena pembetulan (II.D-IIE)</td>
                                        <td></td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>G. PPN Kurang bayar dilunasi tanggal </td>
                                        <td colspan="2">
                                        </td>
                                    </tr>
                                    <tr id="panel_ntpn_ppn">
                                        <td>
                                            <label class="mb-2">NTPN
                                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Status PPN Anda adalah Kurang Bayar<br>Untuk dapat melakukan pembayaran pajak Anda, pastikan Kode Billing yang Anda buat dengan menggunakan :<br>Kode Map : 411211 - PPN Dalam Negeri<br>Kode Jenis Setoran : 100 - Masa<br>Tahun Pajak : {{ $induk->spt->year }}">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                </span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="ntpn_ppn" id="ntpn_ppn" class="form-control w-auto" placeholder="NTPN"/>
                                                <button type="button" class="input-group-text" id="check_ppn">
                                                    <i class="ki-solid ki-shield-tick text-primary fs-2x"></i> Cek
                                                </button>
                                            </div>
                                            <label id="ntpn_ppn-error" class="error text-danger" for="ntpn_ppn"></label>
                                        </td>
                                        <td>
                                            <label class="mb-3">Tanggal</label>
                                            <input type="text" name="date_ppn" id="date_ppn" value="{{ $induk->date_ppn }}" class="form-control form-control-solid w-auto" readonly>
                                        </td>
                                        <td>
                                            <label class="mb-3">Nominal</label>
                                            <input type="text" name="nominal_ppn" id="nominal_ppn" value="{{ $induk->nominal_ppn }}" class="form-control form-control-solid w-auto uang" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                    <tr>
                                        <td colspan="4">
                                            H. PPN lebih bayar pada
                                            <label id="lebih_bayar-error" class="error text-danger" for="lebih_bayar"></label>
                                        </td>
                                    </tr>
                                    <?php $lebih_bayar = ($induk->lebih_bayar!='') ? json_decode($induk->lebih_bayar) : array();?>
                                    <tr>
                                        <td width="10%"></td>
                                        <td colspan="2">
                                            <div class="form-check form-check-custom me-10">
                                                <label class="form-check-label text-gray-800 me-2">1.1&nbsp;</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="2d_bukan" {!! (in_array('2d_bukan', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Butir II.D (Bukan SPT Pembetulan)</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-custom me-10">
                                                <label class="form-check-label text-gray-800 me-2">1.2&nbsp;</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="2d_pembetulan" {!! (in_array('2d_pembetulan', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800 me-2">Butir II. D atau </label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="2f_pembetulan" {!! (in_array('2f_pembetulan', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Butir II.F (SPT Pembetulan)</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>oleh</td>
                                        <td colspan="2">
                                            <div class="form-check form-check-custom me-10">
                                                <label class="form-check-label text-gray-800 me-2">2.1</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="pkp" {!! (in_array('pkp', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">PKP Pasal 9 ayat (4b) PPN</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-custom me-10">
                                                <label class="form-check-label text-gray-800 me-2">2.2</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="selain_pkp" {!! (in_array('selain_pkp', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Selain PKP Pasal 9 ayat (4b) PPN</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>diminta untuk</td>
                                        <td colspan="2">
                                            <div class="form-check form-check-custom me-10">
                                                <label class="form-check-label text-gray-800 me-2">3.1</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="berikutnya" {!! (in_array('berikutnya', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Dikompensaikan ke Masa Pajak berikutnya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-custom me-10">
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="masa" {!! (in_array('masa', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Dikompensasikan ke Masa Pajak (mm-yyyy)</label>
                                                <input type="text" class="form-control" name="kompensasi" value="{{ $induk->kompensasi }}" placeholder="mm-yyyy">
                                            </div>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">
                                            <div class="form-check form-check-custom me-10">
                                                <label class="form-check-label text-gray-800 me-2">3.2</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="dikembalikan" {!! (in_array('dikembalikan', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Dikembalikan (Restitusi)</label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Khusus Restitusi untuk PKP :</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">
                                            <div class="form-check form-check-custom me-10">
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="17c" {!! (in_array('17c', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800 me-2">Pasal 17C KUP, dilakukan dengan</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="17c_biasa" {!! (in_array('17c_biasa', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800 me-2">Prosedur Biasa</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="17c_pendahuluan" {!! (in_array('17c_pendahuluan', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Pengembalian Pendahuluan</label>
                                            </div>
                                        <td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">
                                            <div class="form-check form-check-custom me-10">
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="17d" {!! (in_array('17d', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800 me-2">Pasal 17D KUP, dilakukan dengan</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="17d_biasa" {!! (in_array('17d_biasa', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800 me-2">Prosedur Biasa</label>
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="17d_pendahuluan" {!! (in_array('17d_pendahuluan', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Pengembalian Pendahuluan</label>
                                            </div>
                                        <td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">
                                            <div class="form-check form-check-custom me-10">
                                                <input class="form-check-input w-20px h-20px lebih_bayar" type="checkbox" name="lebih_bayar[]" value="9_pendahuluan" {!! (in_array('9_pendahuluan', $lebih_bayar) ? 'checked' : '') !!}>
                                                <label class="form-check-label text-gray-800">Pasal 9 ayat (4c) PPN dilakukan dengan Pengembalian Pendahuluan</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>III. PPN TERUTANG ATAS KEGIATAN MEMBANGUN SENDIRI</h4>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                    <tr>
                                        <td width="30%">A. Jumlah Dasar Pengenaan Pajak</td>
                                        <td width="15%"><input class="form-control form-control-sm text-center w-auto uang" name="dpp_own" id="dpp_own" value="{{ $induk->dpp_own }}"></td>
                                        <td width="30%"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>B. PPN Terutang</td>
                                        <td><input class="form-control form-control-sm text-center w-auto uang ntpn" name="ppn_own" id="ppn_own" value="{{ $induk->ppn_own }}"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">C. Dilunasi Tanggal</td>
                                        <td>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr id="panel_ntpn_own">
                                        <td colspan="2">
                                            <label class="mb-2">NTPN
                                                <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Status PPN Anda adalah Kurang Bayar<br>Untuk dapat melakukan pembayaran pajak Anda, pastikan Kode Billing yang Anda buat dengan menggunakan :<br>Kode Map : 411211 - PPN Dalam Negeri<br>Kode Jenis Setoran : 103 - Kegiatan Membangun Sendiri<br>Tahun Pajak : {{ $induk->spt->year }}">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                </span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="ntpn_own" id="ntpn_own" class="form-control w-auto" placeholder="NTPN"/>
                                                <button type="button" class="input-group-text" id="check_own">
                                                    <i class="ki-solid ki-shield-tick text-primary fs-2x"></i> Cek
                                                </button>
                                            </div>
                                            <label id="ntpn_own-error" class="error text-danger" for="ntpn_own"></label>
                                        </td>
                                        <td>
                                            <label class="mb-3">Tanggal</label>
                                            <input type="text" name="date_own" id="date_own" value="{{ $induk->date_own }}" class="form-control form-control-solid w-auto" readonly>
                                        </td>
                                        <td>
                                            <label class="mb-3">Nominal</label>
                                            <input type="text" name="nominal_own" id="nominal_own" value="{{ $induk->nominal_own }}" class="form-control form-control-solid w-auto uang" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>IV. PEMBAYARAN KEMBALI PAJAK MASUKAN BAGI PKP GAGAL BERPRODUKSI</h4>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                    <tr>
                                        <td width="30%">A. PPN yang wajib dibayar kembali</td>
                                        <td width="15%"><input class="form-control form-control-sm text-center w-auto uang ntpn" name="ppn_fail" id="ppn_fail" value="{{ $induk->ppn_fail }}"></td>
                                        <td width="30%"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">B. Dilunasi Tanggal</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr id="panel_ntpn_fail">
                                        <td colspan="2">
                                            <label class="mb-2">NTPN
                                                <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Status PPN Anda adalah Kurang Bayar<br>Untuk dapat melakukan pembayaran pajak Anda, pastikan Kode Billing yang Anda buat dengan menggunakan :<br>Kode Map : 411211 - PPN Dalam Negeri<br>Kode Jenis Setoran : 106 - Pembayaran Masa atas BAPK/BAP<br>Tahun Pajak : {{ $induk->spt->year }}">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                </span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="ntpn_fail" id="ntpn_fail" class="form-control w-auto" placeholder="NTPN"/>
                                                <button type="button" class="input-group-text" id="check_fail">
                                                    <i class="ki-solid ki-shield-tick text-primary fs-2x"></i> Cek
                                                </button>
                                            </div>
                                            <label id="ntpn_fail-error" class="error text-danger" for="ntpn_fail"></label>
                                        </td>
                                        <td>
                                            <label class="mb-3">Tanggal</label>
                                            <input type="text" name="date_fail" id="date_fail" value="{{ $induk->date_fail }}" class="form-control form-control-solid w-auto" readonly>
                                        </td>
                                        <td>
                                            <label class="mb-3">Nominal</label>
                                            <input type="text" name="nominal_fail" id="nominal_fail" value="{{ $induk->nominal_fail }}" class="form-control form-control-solid w-auto uang" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>V. PAJAK PENJUALAN ATAS BARANG MEWAH</h4>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                    <tr>
                                        <td>A. PPnBM yang harus dipungut sendiri</td>
                                        <td width="15%"></td>
                                        <td class="text-center">@money($induk->ppnbm_a21+$induk->ppnbm_a2_covered)</td>
                                    </tr>
                                    <tr>
                                        <td>B. PPnBM Disetor Dimuka Dalam Masa Pajak Yang Sama</td>
                                        <td></td>
                                        <td><input class="form-control form-control-sm text-center w-auto uang" name="ppnbm_deposit" id="ppnbm_deposit" value="{{ $induk->ppnbm_deposit }}"></td>
                                    </tr>
                                    <tr>
                                        <td>C. PPnBM kurang atau (lebih) bayar (V.A-V.B)</td>
                                        <td></td>
                                        <td class="text-center" id="ppnbm_kurang">@money($induk->ppnbm_a21+$induk->ppnbm_a2_covered-$induk->ppnbm_deposit)</td>
                                    </tr>
                                    <tr>
                                        <td>D. PPnBM kurang atau (lebih) bayar pada SPT yang dibetulkan</td>
                                        <td></td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>E. PPnBM kurang atau (lebih) bayar karena pembetulan (V.C-V.D)</td>
                                        <td></td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>F. PPnBM Kurang bayar dilunasi tanggal  
                                        </td>
                                        <td colspan="2">

                                        </td>
                                    </tr>
                                    <tr id="panel_ntpn_ppnbm">
                                        <td>
                                            <label class="mb-2">NTPN
                                                <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Status PPnBM Anda adalah Kurang Bayar<br>Untuk dapat melakukan pembayaran pajak Anda, pastikan Kode Billing yang Anda buat dengan menggunakan :<br>Kode Map : 411221 - PPnBM Dalam Negeri<br>Kode Jenis Setoran : 100 - Masa<br>Tahun Pajak : {{ $induk->spt->year }}">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                </span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="ntpn_ppnbm" id="ntpn_ppnbm" class="form-control w-auto" placeholder="NTPN"/>
                                                <button type="button" class="input-group-text" id="check_ppnbm">
                                                    <i class="ki-solid ki-shield-tick text-primary fs-2x"></i> Cek
                                                </button>
                                            </div>
                                            <label id="ntpn_ppnbm-error" class="error text-danger" for="ntpn_ppnbm"></label>
                                        </td>
                                        <td>
                                            <label class="mb-3">Tanggal</label>
                                            <input type="text" name="date_ppnbm" id="date_ppnbm" value="{{ $induk->date_ppnbm }}" class="form-control form-control-solid w-auto" readonly>
                                        </td>
                                        <td>
                                            <label class="mb-3">Nominal</label>
                                            <input type="text" name="nominal_ppnbm" id="nominal_ppnbm" value="{{ $induk->nominal_ppnbm }}" class="form-control form-control-solid w-auto uang" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>VI. KELENGKAPAN SPT</h4>
                            <?php $lampiran = ($induk->lampiran!='') ? json_decode($induk->lampiran) : array();?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mt-3 d-flex">
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="ab" {!! (in_array('ab', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                Formulir 1111 AB
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="a2" {!! (in_array('a2', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                Formulir 1111 A2
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="b2" {!! (in_array('b2', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                Formulir 1111 B2
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="ppn" {!! (in_array('ppn', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                SSP PPN
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="kuasa" {!! (in_array('kuasa', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                Surat Kuasa Khusus
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="mt-3 d-flex">
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="a1" {!! (in_array('a1', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                Formulir 1111 A1
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="b1" {!! (in_array('b1', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                Formulir 1111 B1
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="b3" {!! (in_array('b3', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                Formulir 1111 B3
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom me-10">
                                            <input class="form-check-input w-20px h-20px" type="checkbox" name="lampiran[]" value="ppnbm" {!! (in_array('ppnbm', $lampiran) ? 'checked' : '') !!}>
                                            <label class="form-check-label text-gray-800">
                                                SSP PPnBM
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>PERNYATAAN</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pernyataan_induk" id="pernyataan_induk" {!! ($induk->submit_induk=='ya') ? 'checked' : '' !!} required/>
                                        <label class="form-check-label text-gray-800">
                                            DENGAN MENYADARI SEPENUHNYA AKAN SEGALA AKIBATNYA, SAYA MENYATAKAN BAHWA APA YANG TELAH SAYA BERITAHUKAN DIATAS BESERTA LAMPIRAN-LAMPIRANNYA ADALAH BENAR, LENGKAP, JELAS DAN TIDAK BERSYARAT 
                                        </label>
                                        <label id="pernyataan_induk-error" class="error text-danger" for="pernyataan_induk"></label>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row mb-2 mt-10">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="ttd_place" id="ttd_place" class="form-control w-auto" placeholder="Tempat Penandatangan" value="{{ $induk->ttd_place }}" required>
                                            <label id="ttd_place-error" class="error text-danger" for="ttd_place"></label>
                                        </div>
                                        <div class="col-lg-6 fv-row">
                                            <input type="date" name="ttd_date" id="ttd_date" class="form-control w-auto" placeholder="Tanggal SPT" value="{{ $induk->ttd_date }}" required>
                                            <label id="ttd_date-error" class="error text-danger" for="ttd_date"></label>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-2">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="ttd_name" id="ttd_name" class="form-control w-auto" placeholder="Nama Penandatangan" value="{{ $induk->ttd_name }}" required>
                                            <label id="ttd_name-error" class="error text-danger" for="ttd_name"></label>
                                        </div>
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="ttd_position" id="ttd_position" class="form-control w-auto" placeholder="Jabatan Penandatangan" value="{{ $induk->ttd_position }}" required>
                                            <label id="ttd_position-error" class="error text-danger" for="ttd_position"></label>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer d-flex justify-content-end py-1 pt-5 px-9">
                            <a href="{{ route('spt.index', ['status'=>'konsep']) }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                            <button type="submit" id="indukBtn" class="btn btn-primary me-2">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Save Draft</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                            <a href="{{ route('spt.update', ['id'=>$induk->spt_id]) }}" onclick="confirmation2(event, 'Apakah Anda Yakin Akan Mensubmit SPT Ini?', 'captchaModal2')" class="btn btn-primary" id="submit" {!! ($induk->submit_induk=='ya' && $induk->submit_ab=='ya') ? '' : 'hidden' !!}>
                                Submit
                            </a>
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
@section('modal')
    <div class="modal fade" id="captchaModal2" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form method="POST" id="myForm2">
                    @csrf
                    @method('PUT')

                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Tanda Tangan Dokumen</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Jenis Pembayaran</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <select name="type" data-kt-select2="true" data-placeholder="Pilih Jenis Pembayaran" class="form-control form-select form-select-md" data-dropdown-parent="#captchaModal2">
                                    <option value="deposit">Deposit</option>
                                    <option value="billing">Buat Billing</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Jenis Tanda Tangan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <input class="form-control form-control-solid" type="text" value="Tanda Tangan Wajib Pajak" readonly/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Kode Otorisasi</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row captcha" id="reload">
                                <span>{!! captcha_img() !!}</span>
                                <p style="margin: 0 4px; font-size: 12px;">klik untuk ubah kode</p>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-5 col-form-label required fw-semibold fs-6">Isikan Kode Otorisasi</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <input class="form-control captchaModal2" type="text" name="captcha" maxlength="4" placeholder="" required/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Modal footer-->
                </form>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
@endsection
@section('js')

    <script>
        var spt_id = {{ $induk->spt_id }};
        var spt_year = {{ $induk->spt->year }};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/faktur/spt.js?v=7') }}"></script>

    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection