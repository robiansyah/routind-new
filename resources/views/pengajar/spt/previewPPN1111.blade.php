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
                       aria-selected="false">Lampiran Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-lampiran-i-tab" data-toggle="pill"
                       href="#custom-content-below-lampiran-i" role="tab" aria-controls="custom-content-below-lampiran-i"
                       aria-selected="false">Lampiran AB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-lampiran-ii-tab" data-toggle="pill"
                       href="#custom-content-below-lampiran-ii" role="tab" aria-controls="custom-content-below-lampiran-ii"
                       aria-selected="false">Induk</a>
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
                                        <h6>{{ $spt->user->npwp }}</h6>
                                    </div>
                                    <div class="form-group form-group-xs">
                                        <label for="nama" class="form-control-label">Nama WP</label>
                                        <h6>{{ $spt->user->profile->corporate_name }}</h6>
                                    </div>
                                    <div class="form-group form-group-xs">
                                        <label for="notelp" class="form-control-label">Nomor Telepon</label>
                                        <h6>0{{ $spt->user->mobile_phone }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-xs">
                                        <label for="tahunPajak" class="form-control-label">Masa Pajak</label>
                                        <h6>{{ $spt->start_period }}</h6>
                                    </div>
                                    <div class="form-group form-group-xs">
                                        <label for="tahunPajak" class="form-control-label">Tahun Pajak</label>
                                        <h6>{{ $spt->year }}</h6>
                                    </div>
                                    <div class="form-group form-group-xs">
                                        <label for="pembetulan" class="form-control-label">Pembetulan</label>
                                        <h6>{{ $spt->correction_to }}</h6>
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
                                Lampiran Detail
                            </h4>
                        </div>
                        <div class="card-body">
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
                                    @foreach ($spt->ppnDocs as $item)
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
                                    @foreach ($spt->ppnFactur as $item)
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
                                    @foreach ($spt->ppnDocs as $item)
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
                                    @foreach ($spt->ppnFactur as $item)
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
                                    @foreach ($spt->ppnFactur as $item)
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
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-content-below-lampiran-i" role="tabpanel"
                     aria-labelledby="custom-content-below-lampiran-i-tab">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Lampiran AB
                            </h4>
                        </div>
                        <div class="card-body">
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
                                    <td class="text-center">@money($spt->ppn->dpp_a1)</td>
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
                                    <td class="text-center">@money($spt->ppn->dpp_a2)</td>
                                    <td class="text-center">@money($spt->ppn->ppn_a2)</td>
                                    <td class="text-center">@money($spt->ppn->ppnbm_a2)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>2. Penyerahan Dalam Negeri dengan Faktur Pajak yang Digunggung</td>
                                    <td>@money($spt->ppn->dpp_a2_covered)</td>
                                    <td>@money($spt->ppn->ppn_a2_covered)</td>
                                    <td>@money($spt->ppn->ppnbm_a2_covered)</td>
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
                                    <td class="text-center" id="dpp_a21">@money($spt->ppn->dpp_a21+$spt->ppn->dpp_a2_covered)</td>
                                    <td class="text-center" id="ppn_a21">@money($spt->ppn->ppn_a21+$spt->ppn->ppn_a2_covered)</td>
                                    <td class="text-center" id="ppnbm_a21">@money($spt->ppn->ppnbm_a21+$spt->ppn->ppnbm_a2_covered)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>2. Penyerahan yang PPN atau PPN dan PPnBM-nya dipungut oleh Pemungut PPN</td>
                                    <td class="text-center">@money($spt->ppn->dpp_a22)</td>
                                    <td class="text-center">@money($spt->ppn->ppn_a22)</td>
                                    <td class="text-center">@money($spt->ppn->ppnbm_a22)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>3. Penyerahan yang PPN atau PPN dan PPnBM-nya tidak dipungut</td>
                                    <td class="text-center">@money($spt->ppn->dpp_a23)</td>
                                    <td class="text-center">@money($spt->ppn->ppn_a23)</td>
                                    <td class="text-center">@money($spt->ppn->ppnbm_a23)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>4. Penyerahan yang dibebaskan dari pengenaan PPN atau PPN dan PPnBM-nya</td>
                                    <td class="text-center">@money($spt->ppn->dpp_a24)</td>
                                    <td class="text-center">@money($spt->ppn->ppn_a24)</td>
                                    <td class="text-center">@money($spt->ppn->ppnbm_a24)</td>
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
                                    <td class="text-center">@money($spt->ppn->dpp_b1)</td>
                                    <td class="text-center">@money($spt->ppn->ppn_b1)</td>
                                    <td class="text-center">@money($spt->ppn->ppnbm_b1)</td>
                                </tr>
                                <tr>
                                    <td colspan="2">B. Perolehan BKP/JKP dari Dalam Negeri yang PM-nya dapat Dikreditkan</td>
                                    <td class="text-center">@money($spt->ppn->dpp_b2)</td>
                                    <td class="text-center">@money($spt->ppn->ppn_b2)</td>
                                    <td class="text-center">@money($spt->ppn->ppnbm_b2)</td>
                                </tr>
                                <tr>
                                    <td colspan="2">C. Impor atau Perolehan Yang PM-nya Tidak Dapat Dikreditkan dan/atau Impor atau Perolehan yang Mendapat Fasilitas</td>
                                    <td class="text-center">@money($spt->ppn->dpp_b3)</td>
                                    <td class="text-center">@money($spt->ppn->ppn_b3)</td>
                                    <td class="text-center">@money($spt->ppn->ppnbm_b3)</td>
                                </tr>
                                <tr>
                                    <td colspan="2">D. Jumlah Perolehan (II.A + II.B + II.C)</td>
                                    <td class="text-center">@money($spt->ppn->dpp_b1+$spt->ppn->dpp_b2+$spt->ppn->dpp_b3)</td>
                                    <td class="text-center">@money($spt->ppn->ppn_b1+$spt->ppn->ppn_b2+$spt->ppn->ppn_b3)</td>
                                    <td class="text-center">@money($spt->ppn->ppnbm_b1+$spt->ppn->ppnbm_b2+$spt->ppn->ppnbm_b3)</td>
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
                                    <td class="text-center" id="ppn_3a">@money($spt->ppn->ppn_b1+$spt->ppn->ppn_b2)</td>
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
                                    <td class="text-center">0</td>
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
                                    <td>@money($spt->ppn->ppn_correction)></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2"><strong>4. Jumlah (III.B.1 + III.B.2 + III.B.3)</strong></td>
                                    <td class="text-center" id="ppn_3b">@money($spt->ppn->ppn_correction)</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3">C. Jumlah Pajak Masukan yang Dapat Diperhitungkan (III.A + III.B.4)</td>
                                    <td class="text-center" id="ppn_3c">@money($spt->ppn->ppn_b1+$spt->ppn->ppn_b2+$spt->ppn->ppn_correction)</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-content-below-lampiran-ii" role="tabpanel" aria-labelledby="custom-content-below-lampiran-ii-tab">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Induk
                            </h4>
                        </div>
                        <div class="card-body">
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
                                    <td class="text-center">@money($spt->ppn->dpp_a1)</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>2. Penyerahan yang PPN-nya harus dipungut sendiri</td>
                                    <td class="text-center" id="dpp_a21_induk">@money($spt->ppn->dpp_a21+$spt->ppn->dpp_a2_covered)</td>
                                    <td class="text-center" id="ppn_a21_induk">@money($spt->ppn->ppn_a21+$spt->ppn->ppn_a2_covered)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>3. Penyerahan yang PPN-nya dipungut oleh Pemungut PPN</td>
                                    <td class="text-center" id="dpp_a22_induk">@money($spt->ppn->dpp_a22)</td>
                                    <td class="text-center" id="ppn_a22_induk">@money($spt->ppn->ppn_a22)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>4. Penyerahan yang PPN-nya tidak dipungut</td>
                                    <td class="text-center" id="dpp_a23_induk">@money($spt->ppn->dpp_a23)</td>
                                    <td class="text-center" id="ppn_a23_induk">@money($spt->ppn->ppn_a23)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>5. Penyerahan yang dibebaskan dari pengenaan PPN</td>
                                    <td class="text-center" id="dpp_a24_induk">@money($spt->ppn->dpp_a24)</td>
                                    <td class="text-center" id="ppn_a24_induk">@money($spt->ppn->ppn_a24)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Jumlah (I.A.1 + I.A.2 + I.A.3 + I.A.4 + I.A.5 )</td>
                                    <td class="text-center" id="dpp_jumlah">@money($spt->ppn->dpp_a21+$spt->ppn->dpp_a22+$spt->ppn->dpp_a23+$spt->ppn->dpp_a24+$spt->ppn->dpp_a2_covered)</td>
                                    <td class="text-center" id="ppn_jumlah">@money($spt->ppn->ppn_a21+$spt->ppn->ppn_a22+$spt->ppn->ppn_a23+$spt->ppn->ppn_a24+$spt->ppn->ppn_a2_covered)</td>
                                </tr>
                                <tr>
                                    <td colspan="2">B. Tidak Terutang PPN</td>
                                    <td><input class="form-control form-control-sm text-center w-auto uang" name="dpp_not" id="dpp_not" value="{{ $spt->ppn->dpp_not }}"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2">C. Jumlah Seluruh Penyerahan ( I.A + I.B)</td>
                                    <td class="text-center" id="dpp_all">@money($spt->ppn->dpp_a21+$spt->ppn->dpp_a22+$spt->ppn->dpp_a23+$spt->ppn->dpp_a24+$spt->ppn->dpp_a2_covered+$spt->ppn->dpp_not)</td>
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
                                    <td class="text-center" id="ppn_a21_induk2">@money($spt->ppn->ppn_a21+$spt->ppn->ppn_a2_covered)</td>
                                </tr>
                                <tr>
                                    <td>B. PPN disetor dimuka dalam Masa Pajak yang sama</td>
                                    <td></td>
                                    <td class="text-center">0</td>
                                </tr>
                                <tr>
                                    <td>C. Pajak Masukan yang dapat diperhitungkan</td>
                                    <td></td>
                                    <td class="text-center" id="ppn_calculated">@money($spt->ppn->ppn_calculated)</td>
                                </tr>
                                <tr>
                                    <td>D. PPN kurang atau (lebih) bayar (II.A-II.B-II.C)</td>
                                    <td></td>
                                    <td class="text-center" id="ppn_kurang">@money(($spt->ppn->ppn_a21+$spt->ppn->ppn_a2_covered)-($spt->ppn->ppn_calculated))</td>
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
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Status PPN Anda adalah Kurang Bayar<br>Untuk dapat melakukan pembayaran pajak Anda, pastikan Kode Billing yang Anda buat dengan menggunakan :<br>Kode Map : 411211 - PPN Dalam Negeri<br>Kode Jenis Setoran : 100 - Masa<br>Tahun Pajak : {{ $spt->ppn->spt->year }}">
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
                                        <input type="text" name="date_ppn" id="date_ppn" value="{{ $spt->ppn->date_ppn }}" class="form-control form-control-solid w-auto" readonly>
                                    </td>
                                    <td>
                                        <label class="mb-3">Nominal</label>
                                        <input type="text" name="nominal_ppn" id="nominal_ppn" value="{{ $spt->ppn->nominal_ppn }}" class="form-control form-control-solid w-auto uang" readonly>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                <tr>
                                    <td colspan="4">H. PPN lebih bayar pada</td>
                                </tr>
                                <tr>
                                    <td width="10%"></td>
                                    <td colspan="2">
                                        1.1 <input type="checkbox" disabled="disabled"> Butir II.D (Bukan SPT Pembetulan)
                                    </td>
                                    <td>
                                        1.2 <input type="checkbox" disabled="disabled"> Butir II. D atau
                                        <input type="checkbox" disabled="disabled"> Butir II.F (SPT Pembetulan)
                                    </td>
                                </tr>
                                <tr>
                                    <td>oleh</td>
                                    <td colspan="2">
                                        2.1 <input type="checkbox" disabled="disabled">  PKP Pasal 9 ayat (4b) PPN</td>
                                    <td>
                                        2.2 <input type="checkbox" disabled="disabled"> Selain PKP Pasal 9 ayat (4b) PPN</td>
                                </tr>
                                <tr>
                                    <td>diminta untuk</td>
                                    <td colspan="2">
                                        3.1 <input type="checkbox" disabled="disabled"> Dikompensaikan ke Masa Pajak berikutnya,</td>
                                    <td>
                                        <input type="checkbox" disabled="disabled"> Dikompensasikan ke Masa Pajak (mm-yyyy) <input type="text" size="2" ng-model="formIndukController.sptInduk.attribute43" ng-disabled="!formIndukController.attribute43isEnabled" limit-to="2" number-only="" format-masa="" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> - <input type="text" size="4" ng-model="formIndukController.sptInduk.attribute44" ng-disabled="!formIndukController.attribute44isEnabled" limit-to="4" number-only="" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2">3.2 <input type="checkbox" disabled="disabled"> Dikembalikan (Restitusi)</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Khusus Restitusi untuk PKP :</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <input type="checkbox" disabled="disabled"> Pasal 17C KUP, dilakukan dengan</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" disabled="disabled"> Prosedur Biasa,</td>
                                    <td>
                                        <input type="checkbox" disabled="disabled"> Pengembalian Pendahuluan</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3"><input type="checkbox" disabled="disabled"> Pasal 17D KUP, dilakukan dengan</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" disabled="disabled">  Prosedur Biasa, </td>
                                    <td><input type="checkbox" disabled="disabled"> Pengembalian Pendahuluan</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3"><input type="checkbox" disabled="disabled">  Pasal 9 ayat (4c) PPN dilakukan dengan Pengembalian Pendahuluan</td>
                                </tr>
                                </tbody>
                            </table>

                            <h4>III. PPN TERUTANG ATAS KEGIATAN MEMBANGUN SENDIRI</h4>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                <tr>
                                    <td width="30%">A. Jumlah Dasar Pengenaan Pajak</td>
                                    <td width="15%"><input class="form-control form-control-sm text-center w-auto uang" name="dpp_own" id="dpp_own" value="{{ $spt->ppn->dpp_own }}"></td>
                                    <td width="30%"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>B. PPN Terutang</td>
                                    <td><input class="form-control form-control-sm text-center w-auto uang ntpn" name="ppn_own" id="ppn_own" value="{{ $spt->ppn->ppn_own }}"></td>
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
                                            <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Status PPN Anda adalah Kurang Bayar<br>Untuk dapat melakukan pembayaran pajak Anda, pastikan Kode Billing yang Anda buat dengan menggunakan :<br>Kode Map : 411211 - PPN Dalam Negeri<br>Kode Jenis Setoran : 103 - Kegiatan Membangun Sendiri<br>Tahun Pajak : {{ $spt->ppn->spt->year }}">
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
                                        <input type="text" name="date_own" id="date_own" value="{{ $spt->ppn->date_own }}" class="form-control form-control-solid w-auto" readonly>
                                    </td>
                                    <td>
                                        <label class="mb-3">Nominal</label>
                                        <input type="text" name="nominal_own" id="nominal_own" value="{{ $spt->ppn->nominal_own }}" class="form-control form-control-solid w-auto uang" readonly>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <h4>IV. PEMBAYARAN KEMBALI PAJAK MASUKAN BAGI PKP GAGAL BERPRODUKSI</h4>
                            <table class="table table-row-bordered mb-10">
                                <tbody>
                                <tr>
                                    <td width="30%">A. PPN yang wajib dibayar kembali</td>
                                    <td width="15%"><input class="form-control form-control-sm text-center w-auto uang ntpn" name="ppn_fail" id="ppn_fail" value="{{ $spt->ppn->ppn_fail }}"></td>
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
                                            <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Status PPN Anda adalah Kurang Bayar<br>Untuk dapat melakukan pembayaran pajak Anda, pastikan Kode Billing yang Anda buat dengan menggunakan :<br>Kode Map : 411211 - PPN Dalam Negeri<br>Kode Jenis Setoran : 106 - Pembayaran Masa atas BAPK/BAP<br>Tahun Pajak : {{ $spt->ppn->spt->year }}">
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
                                        <input type="text" name="date_fail" id="date_fail" value="{{ $spt->ppn->date_fail }}" class="form-control form-control-solid w-auto" readonly>
                                    </td>
                                    <td>
                                        <label class="mb-3">Nominal</label>
                                        <input type="text" name="nominal_fail" id="nominal_fail" value="{{ $spt->ppn->nominal_fail }}" class="form-control form-control-solid w-auto uang" readonly>
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
                                    <td class="text-center">@money($spt->ppn->ppnbm_a21+$spt->ppn->ppnbm_a2_covered)</td>
                                </tr>
                                <tr>
                                    <td>B. PPnBM Disetor Dimuka Dalam Masa Pajak Yang Sama</td>
                                    <td></td>
                                    <td><input class="form-control form-control-sm text-center w-auto uang" name="ppnbm_deposit" id="ppnbm_deposit" value="{{ $spt->ppn->ppnbm_deposit }}"></td>
                                </tr>
                                <tr>
                                    <td>C. PPnBM kurang atau (lebih) bayar (V.A-V.B)</td>
                                    <td></td>
                                    <td class="text-center" id="ppnbm_kurang">@money($spt->ppn->ppnbm_a21+$spt->ppn->ppnbm_a2_covered-$spt->ppn->ppnbm_deposit)</td>
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
                                            <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Status PPnBM Anda adalah Kurang Bayar<br>Untuk dapat melakukan pembayaran pajak Anda, pastikan Kode Billing yang Anda buat dengan menggunakan :<br>Kode Map : 411221 - PPnBM Dalam Negeri<br>Kode Jenis Setoran : 100 - Masa<br>Tahun Pajak : {{ $spt->ppn->spt->year }}">
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
                                        <input type="text" name="date_ppnbm" id="date_ppnbm" value="{{ $spt->ppn->date_ppnbm }}" class="form-control form-control-solid w-auto" readonly>
                                    </td>
                                    <td>
                                        <label class="mb-3">Nominal</label>
                                        <input type="text" name="nominal_ppnbm" id="nominal_ppnbm" value="{{ $spt->ppn->nominal_ppnbm }}" class="form-control form-control-solid w-auto uang" readonly>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
                                        <input type="number" class="form-control" name="nilai" value="{{ $spt->nilai }}" placeholder="Nilai" required>
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