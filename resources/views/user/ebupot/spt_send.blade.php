@extends('layouts.metronic')

@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'SPT Detail')
@section('content')
<!--begin::Card-->
<div class="card card-flush">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin:::Tabs-->
        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-5">
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#lampiran_doss">
                    Lampiran DOSS
                </a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#lampiran_dopp">
                    Lampiran DOPP
                </a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#lampiran_dbpi">
                    Lampiran DBP bagian I
                </a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#lampiran_dbpii">
                    Lampiran DBP bagian II
                </a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#induk">
                    Induk SPT
                </a>
            </li>
            <!--end:::Tab item-->
        </ul>
        <!--end:::Tabs-->
        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="lampiran_doss" role="tabpanel">
                <div class="table-responsive mb-5 py-5">
                    <h4>I. Imbalan yang Diterima/Diperoleh Sehubungan dengan Pengangkutan Orang dan/atau Barang Termasuk Penyewaan Kapal Laut Oleh Perusahaan Pelayaran Dalam Negeri</h4>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Jumlah Dasar Pengenaan Pajak (Rp)</th>
                                <th>Jumlah PPh (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pt-5">a. Penghasilan dari Indonesia</td>
                                <td>
                                    <input id="jmlBruto7a" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlBruto7a" value="0" disabled>
                                </td>
                                <td>
                                    <input id="jmlPph7a" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlPph7a" value="0" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="pt-5">b. Penghasilan dari Luar Indonesia</td>
                                <td>
                                    <input id="jmlBruto7b" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlBruto7b" value="0" disabled>
                                </td>
                                <td>
                                    <input id="jmlPph7b" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlPph7b" value="0" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="pt-5">c. PPh Pasal 24 yang dapat diperhitungkan</td>
                                <td>
                                    <input id="jmlBruto7c" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlBruto7c" value="0" disabled>
                                </td>
                                <td>
                                    <input id="jmlPph7c" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlPph7c" value="0" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="pt-5">d. PPh yang dipotong pihak lain</td>
                                <td>
                                    <input id="jmlBruto7d" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlBruto7d" value="0" disabled>
                                </td>
                                <td>
                                    <input id="jmlPph7d" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlPph7d" value="0" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="pt-5">e. PPh yang disetor sendiri</td>
                                <td>
                                    <input id="jmlBruto7e" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlBruto7e" value="0" disabled>
                                </td>
                                <td>
                                    <input id="jmlPph7e" type="text" class="form-control form-control-sm text-end currency mb-2" autocomplete="off" name="jmlPph7e" value="0" disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <h4>II. Objek PPh yang disetor sendiri</h4>
                    <table class="table table-bordered" id="tbl_doss">
                        <thead>
                            <tr class="fw-bold fs-7 text-uppercase gs-0">
                                <th>Uraian</th>
                                <th>Kode Objek Pajak</th>
                                <th>Jumlah DPP (Rp)</th>
                                <th>Jumlah PPh (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data->docs as $item)
                            @if($item->object->kdBupot == 2)
                                <tr>
                                    <td class="text-left">
                                        ({{ $item->object->kdJnsPjk }}) {{ $item->object->nmObjkPjk }}
                                    </td>
                                    <td class="text-center">{{ $item->object->kdObjPjk }}</td>
                                    <td class="text-end">@money($item->jmlBruto)</td>
                                    <td class="text-end">@money($item->jmlPph)</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="lampiran_dopp" role="tabpanel">
                <div class="table-responsive mb-5 py-5">
                    <h4>Objek Pajak yang dilakukan pemungutan/pemotongan</h4>
                    <table class="table table-bordered" id="tbl_dopp">
                        <thead>
                            <tr class="fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-250px">Uraian</th>
                                <th>Kode Objek Pajak</th>
                                <th>Jumlah DPP (Rp)</th>
                                <th>Jumlah PPh (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data->docs as $item)
                            @if($item->object->kdBupot != 2)
                            <tr>
                                <td class="text-left">
                                    ({{ $item->object->kdJnsPjk }}) {{ $item->object->nmObjkPjk }}
                                </td>
                                <td class="text-center">{{ $item->object->kdObjPjk }}</td>
                                <td class="text-end">@money($item->jmlBruto)</td>
                                <td class="text-end">@money($item->jmlPph)</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="lampiran_dbpi" role="tabpanel">
                <div class="table-responsive mb-5 py-5">
                    <h4>A. Daftar Bukti Pemotongan/Pemungutan Unifikasi Berformat Standar</h4>
                    <table class="table table-bordered" id="tbl_dbp1">
                        <thead>
                        <tr class="fw-bold fs-7 text-uppercase gs-0">
                            <th>Pasal</th>
                            <th>NPWP/NIK/TIN</th>
                            <th>Nama</th>
                            <th>Kode Objek Pajak</th>
                            <th>Nomor Bukti Potong/Pungut</th>
                            <th>Tanggal Bukti Potong/Pungut</th>
                            <th>Jumlah DPP (Rp)</th>
                            <th>Jumlah PPh (Rp)</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $jmlBupot = 0; ?>
                        @foreach($bupot as $item)
                            <tr>
                                <td>{{ $item->kdJnsPjk }}</td>
                                <td>{{ $item->idDipotong }}</td>
                                <td>{{ $item->namaDipotong }}</td>
                                <td>{{ $item->kdObjPjk }}</td>
                                <td>{{ $item->noBupot }}</td>
                                <td>{{ $item->tglPemotongan }}</td>
                                <td>@money($item->jmlBruto)</td>
                                <td>@money($item->pphDipotong)</td>
                                <td>-</td>
                            </tr>
                            <?php ++$jmlBupot;?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="lampiran_dbpii" role="tabpanel">
                <div class="table-responsive mb-5 py-5">
                    <h4>B. Daftar Surat Setoran Pajak, Bukti Penerimaan Negara dan Bukti Pemindahbukuan</h4>
                    <table class="table table-bordered" id="tbl_dbp2">
                        <thead>
                        <tr class="fw-bold fs-7 text-uppercase gs-0">
                            <th>Kode Akun Pajak</th>
                            <th>Kode Jenis Setoran</th>
                            <th>NTPN/No Bukti Pbk</th>
                            <th>Tanggal SSP/BPN/Bukti Pbk</th>
                            <th>Jumlah PPh Disetor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deposit as $item)
                            <tr>
                                <td>{{ $item->kdMap }}</td>
                                <td>{{ $item->kdJnsSetor }}</td>
                                <td>{{ $item->noBuktiSetor }}</td>
                                <td>{{ $item->tglSetor }}</td>
                                <td>@money($item->jmlSetor)</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="induk" role="tabpanel">
                <div class="table-responsive mb-5 py-5">
                    <?php
                        $ps42pph_ss = 0; $ps42setor_ss = 0; $ps15pph_ss = 0; $ps15setor_ss = 0;
                        $ps42pph = 0; $ps42setor = 0; $ps15pph = 0; $ps15setor = 0;
                        $ps22pph = 0; $ps22setor = 0; $ps26pph = 0; $ps26setor = 0; $ps23pph = 0; $ps23setor = 0;
                        //pph
                        foreach($data->docs as $item){
                            if($item->object->kdBupot==2){
                                if($item->object->kdJnsPjk == "PPH4-2") {
                                    $ps42pph_ss += $item->jmlPph;
                                }else {
                                    $ps15pph_ss += $item->jmlPph;
                                }
                            }else{
                                if($item->object->kdJnsPjk == "PPH4-2"){
                                    $ps42pph += $item->jmlPph;
                                }elseif($item->object->kdJnsPjk == "PPH22"){
                                    $ps22pph += $item->jmlPph;
                                }elseif($item->object->kdJnsPjk == "PPH26"){
                                    $ps26pph += $item->jmlPph;
                                }elseif($item->object->kdJnsPjk == "PPH23"){
                                    $ps23pph += $item->jmlPph;
                                }else{
                                    $ps15pph += $item->jmlPph;
                                }
                            }
                        }

                        //setor
                        foreach ($deposit as $item){
                            if($item->fgSsKb == 1){
                                if($item->pay->object->kdJnsPjk == "PPH4-2") {
                                    $ps42setor_ss += $item->jmlSetor;
                                }else {
                                    $ps15setor_ss += $item->jmlSetor;
                                }
                            }else{
                                if($item->pay->object->kdJnsPjk == "PPH4-2"){
                                    $ps42setor += $item->jmlSetor;
                                }elseif($item->pay->object->kdJnsPjk == "PPH22"){
                                    $ps22setor += $item->jmlSetor;
                                }elseif($item->pay->object->kdJnsPjk == "PPH26"){
                                    $ps26setor += $item->jmlSetor;
                                }elseif($item->pay->object->kdJnsPjk == "PPH23"){
                                    $ps23setor += $item->jmlSetor;
                                }else{
                                    $ps15setor += $item->jmlSetor;
                                }
                            }
                        }
                    ?>
                    <h4>I. PPh YANG DISETOR SENDIRI</h4>
                    <table class="table table-bordered border-gray-600" id="tbl_indukpphss">
                        <thead>
                        <tr class="fw-bold fs-7 text-uppercase gs-0">
                            <th class="text-center">No</th>
                            <th class="text-center">Uraian</th>
                            <th class="text-center">PPh Terutang </th>
                            <th class="text-center" width="20%">JUMLAH PPh YANG DITANGGUNG PEMERINTAH</th>
                            <th class="text-center" width="20%">JUMLAH PPh YANG DISETOR (Rp)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-left">PASAL 4 AYAT (2)</td>
                            <td class="text-end">{{ number_format($ps42pph_ss, 0, ',', '.') }}</td>
                            <td class="text-end">0</td>
                            <td class="text-end">{{ number_format($ps42setor_ss, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-left">PASAL 15
                            </td>
                            <td class="text-end">{{ number_format($ps15pph_ss, 0, ',', '.') }}</td>
                            <td class="text-end">0</td>
                            <td class="text-end">{{ number_format($ps15setor_ss, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-left">JUMLAH YANG DISETORKAN SENDIRI</td>
                            <td class="text-end">{{ number_format($ps42pph_ss+$ps15pph_ss, 0, ',', '.') }}</td>
                            <td class="text-end">0</td>
                            <td class="text-end">{{ number_format($ps42setor_ss+$ps15setor_ss, 0, ',', '.') }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <h4>II. PPh YANG TELAH DILAKUKAN PEMOTONGAN/PEMUNGUTAN</h4>
                    <table class="table table-bordered border-gray-600" id="tbl_indukpotput">
                        <thead>
                        <tr class="fw-bold fs-7 text-uppercase gs-0">
                            <th class="text-center">No</th>
                            <th class="text-center">Uraian</th>
                            <th class="text-center">PPh Terutang</th>
                            <th class="text-center"width="20%">JUMLAH PPh YANG DITANGGUNG PEMERINTAH</th>
                            <th class="text-center"width="20%">JUMLAH PPh YANG DISETOR (Rp)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-left">PASAL 22</td>
                            <td class="text-end">{{ number_format($ps22pph, 0, ',', '.') }}</td>
                            <td class="text-end">0</td>
                            <td class="text-end">{{ number_format($ps22setor, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-left">PASAL 26</td>
                            <td class="text-end">{{ number_format($ps26pph, 0, ',', '.') }}</td>
                            <td class="text-end">0</td>
                            <td class="text-end">{{ number_format($ps26setor, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-left">PASAL 23</td>
                            <td class="text-end">{{ number_format($ps23pph, 0, ',', '.') }}</td>
                            <td class="text-end">0</td>
                            <td class="text-end">{{ number_format($ps23setor, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-left">PASAL 4
                                AYAT (2)
                            </td>
                            <td class="text-end">{{ number_format($ps42pph, 0, ',', '.') }}</td>
                            <td class="text-end">0</td>
                            <td class="text-end">{{ number_format($ps42setor, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-left">PASAL 15
                            </td>
                            <td class="text-end">{{ number_format($ps15pph, 0, ',', '.') }}</td>
                            <td class="text-end">0</td>
                            <td class="text-end">{{ number_format($ps15setor, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td class="text-left">JUMLAH YANG DIPOTONG/DIPUNGUT
                            </td>
                            <td class="text-end">
                                {{ number_format($ps42pph+$ps15pph+$ps23pph+$ps22pph+$ps26pph, 0, ',', '.') }}
                            </td>
                            <td class="text-end">0</td>
                            <td class="text-end">
                                {{ number_format($ps42setor+$ps15setor+$ps23setor+$ps22setor+$ps26setor, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-left" colspan="3">JUMLAH BUKTI PEMOTONGAN/PEMUNGUTAN</td>
                            <td class="text-center">{{ $jmlBupot }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <h4>III. REKAPITULASI PPh</h4>
                    <table class="table table-bordered border-gray-600" id="tbl_indukrekap">
                        <thead>
                        <tr class="fw-bold fs-7 text-uppercase gs-0">
                            <th class="text-center">No</th>
                            <th class="text-center">Uraian</th>
                            <th class="text-center">PPh Terutang</th>
                            <th class="text-center" width="20%">JUMLAH PPh YANG DITANGGUNG PEMERINTAH</th>
                            <th class="text-center" width="20%">JUMLAH PPh YANG DISETOR (Rp)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">10</td>
                            <td class="text-left">JUMLAH TOTAL PPh DAN PPh YANG DISETOR
                            </td>
                            <td class="text-end">
                                {{ number_format($ps42pph+$ps15pph+$ps23pph+$ps22pph+$ps26pph+$ps42pph_ss+$ps15pph_ss, 0, ',', '.') }}
                            </td>
                            <td class="text-end">0</td>
                            <td class="text-end">
                                {{ number_format($ps42setor+$ps15setor+$ps23setor+$ps22setor+$ps26setor+$ps42setor_ss+$ps15setor_ss, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">11</td>
                            <td class="text-left" colspan="2">JUMLAH TOTAL PPh YANG DISETOR PADA SPT YANG DIBETULKAN</td>
                            <td class="text-end" colspan="2">0</td>
                        </tr>
                        <tr>
                            <td class="text-center">12</td>
                            <td class="text-left" colspan="2">JUMLAH PPh YANG KURANG (LEBIH) DISETOR KARENA PEMBETULAN
                            </td>
                            <td class="text-end" colspan="2">0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end py-1 pt-5 px-9 mb-5">
                    <a href="{{ route('spt.index', ['status'=>'konsep']) }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                    <a href="{{ route('spt.update', ['id'=>$data->id]) }}" onclick="confirmation2(event, 'Apakah Anda Yakin Akan Mensubmit SPT Ini?', 'captchaModal2')" class="btn btn-primary">
                        Submit
                    </a>
                </div>
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
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

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>

    <script>
        $('#tbl_dopp').DataTable();
        $('#tbl_doss').DataTable();
        $('#tbl_dbp1').DataTable();
        $('#tbl_dbp2').DataTable();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection