@extends('layouts.metronic')

@section('title', 'Buat SPT 1770SS')
@section('css')

<link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')

<!--begin::Card-->
<div class="card">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Stepper-->
        <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
            <!--begin::Nav-->
            <div class="stepper-nav mb-5">
                <!--begin::Step 1-->
                <div class="stepper-item current" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Isi Data Formulir</h3>
                </div>
                <!--end::Step 1-->
                <!--begin::Step 2-->
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Isi SPT</h3>
                </div>
                <!--end::Step 2-->
                <!--begin::Step 3-->
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Kirim SPT</h3>
                </div>
                <!--end::Step 3-->
            </div>
            <!--end::Nav-->
            <!--begin::Form-->
            <form class="mx-auto mw-800px w-100 pt-10 pb-10" novalidate="novalidate" id="kt_create_account_form">
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-10 pb-lg-15">
                            <!--begin::Title-->
                            <h2 class="fw-bold d-flex align-items-center text-dark">Data Formulir</h2>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tahun Pajak</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <select name="year" id="year" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-control form-select form-select-md">
                                    <option value="">Pilih Tahun Pajak</option>
                                    @for($i = date('Y'); $i > date('Y')-6; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Status SPT</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <div class="mt-3 d-flex">
                                    <div class="form-check form-check-custom me-10">
                                        <input class="form-check-input w-20px h-20px" type="radio" name="status" id="status1" value="normal" checked>
                                        <label class="form-check-label">
                                            Normal
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom me-10">
                                        <input class="form-check-input w-20px h-20px" type="radio" name="status" id="status2" value="pembetulan">
                                        <label class="form-check-label">
                                            Pembetulan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row fv-row">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Pembetulan Ke</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="txtPembetulanKe" id="txtPembetulanKe" class="form-control form-control-solid text-end" value="0" readonly>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 1-->
                <!--begin::Step 2-->
                <div data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-2 pb-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">A. Pajak Penghasilan</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">1</td>
                                <td colspan="2" style="width: 35%">Penghasilan Bruto Dalam Negeri Sehubungan Dengan Pekerjaan dan Penghasilan Neto Dalam Negeri</td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagA1" name="txtBagA1" class="form-control form-control-sm uang text-end" onblur="spt1770ss.cekBruto(); spt1770ss.hitungPph();">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">2</td>
                                <td colspan="2" style="width: 35%">Pengurangan</td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagA2" name="txtBagA2" class="form-control form-control-sm uang text-end" onblur="spt1770ss.hitungPph();">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">3
                                </td>
                                <td style="width: 25%">Penghasilan Tidak Kena Pajak
                                </td>
                                <td class="special-td" style="width: 45%">
                                    <select class="form-control form-control-sm select2me" id="ddlPtkp" name="ddlPtkp">
                                        <option value="">Pilih...</option>
                                        <option value="00">TK/0 Tidak Kawin Tidak Ada Tanggungan
                                        </option>
                                        <option value="01">TK/1 Tidak Kawin Tanggungan 1 Orang
                                        </option>
                                        <option value="02">TK/2 Tidak Kawin Tanggungan 2 Orang
                                        </option>
                                        <option value="03">TK/3 Tidak Kawin Tanggungan 3 Orang
                                        </option>
                                        <option value="10">K/0 Kawin Tidak Ada Tanggungan
                                        </option>
                                        <option value="11">K/1 Kawin Tanggungan 1 Orang
                                        </option>
                                        <option value="12">K/2 Kawin Tanggungan 2 Orang
                                        </option>
                                        <option value="13">K/3 Kawin Tanggungan 3 Orang
                                        </option>
                                        <option value="20">K/I/0 Kawin Penghasilan Istri Digabung Tidak Ada Tanggungan
                                        </option>
                                        <option value="21">K/I/1 Kawin Penghasilan Istri Digabung Tanggungan 1 Orang
                                        </option>
                                        <option value="22">K/I/2 Kawin Penghasilan Istri Digabung Tanggungan 2 Orang
                                        </option>
                                        <option value="23">K/I/3 Kawin Penghasilan Istri Digabung Tanggungan 3 Orang
                                        </option>
                                    </select>
                                </td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagA3" readonly="" name="txtBagA3" class="form-control form-control-sm uang text-end">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">4</td>
                                <td colspan="2" style="width: 35%">Penghasilan Kena Pajak</td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagA4" readonly="" name="txtBagA4" class="form-control form-control-sm uang text-end">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">5</td>
                                <td colspan="2" style="width: 35%;">Pajak Penghasilan Terutang</td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagA5" readonly="" name="txtBagA5" class="form-control form-control-sm uang text-end">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">6</td>
                                <td colspan="2" style="width: 35%;">Pajak Penghasilan yang telah dipotong oleh pihak lain</td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagA6" name="txtBagA6" class="form-control form-control-sm uang text-end" onblur="spt1770ss.hitungPph();">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">7</td>
                                <td colspan="2" style="width: 35%; color: black; font-weight: bold;" id="lblLbkbn">Nihil</td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagA7" readonly="" name="txtBagA7" class="form-control form-control-sm uang" style="text-align: right; color: black; font-weight: bold;">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="p-5 my-5" id="panelPembayaran">
                            <h3 class="fw-bold text-danger">Status SPT Anda adalah Kurang Bayar, sudahkah Anda melakukan pembayaran?</h3>
                            <div class="col-md-12 mt-5">
                                <div class="mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rdBayar" id="rb1" value="1">
                                        <label class="form-check-label text-gray-800">
                                            <strong>Belum</strong>, <i>Saya akan membuat kode billing untuk melakukan pembayaran</i>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rdBayar" id="rb2" value="2">
                                        <label class="form-check-label text-gray-800">
                                            <strong>Sudah</strong>, <i>Saya sudah melakukan pembayaran</i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover table-bordered" id="tblPembayaran" width="100%">
                                <tbody>
                                    <tr id="barisCreateBilling">
                                        <td style="width: 5%; text-align: center"></td>
                                        <td colspan="2" style="width: 65%;">Buat kode billing pembayaran pajak</td>
                                        <td style="width: 30%;">
                                            <button type="button" id="btnBilling" class="btn btn-djp btn-elevate btn-pill"><i class="fa fa-money-bill-alt"></i> Buat Kode Billing</button>
                                        </td>
                                    </tr>
                                    <tr id="barisKodeBilling" style="display: none">
                                        <td style="width: 5%; text-align: center"></td>
                                        <td colspan="2" style="width: 65%;"><strong>Kode Billing ini bukan kode pembayaran</strong>. silakan gunakan Kode Billing ini saat melakukan pembayaran pajak melalui menu Billing, submenu menu Billing, submenu Virtual Payment</td>
                                        <td style="width: 30%;">
                                            <input type="text" class="form-control form-control-sm" readonly id="txtKodeBilling" />
                                        </td>
                                    </tr>
                                    <tr id="barisKodeBillingExpDate" style="display: none">
                                        <td style="width: 5%; text-align: center"></td>
                                        <td colspan="2" style="width: 65%;"><strong>Silakan membayar pajak melalui menu Billing, submenu Virtual Payment sebelum</strong></td>
                                        <td style="width: 30%;">
                                            <input type="text" class="form-control form-control-sm" readonly id="txtKodeBillingExpDate" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="form-group" id="formTblByr">
                                <div class="col-md-12">
                                    <div class="kt-align-right">
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" id="buktiBayar_new" class="btn btn-primary">
                                                Tambah <i class="ki-outline ki-plus fs-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="kt-space-20"></div>
                                    <div class="table-responsive">
                                        <table class="table table-djp table-md table-striped table-hover" id="tblJnsPembayaran" width="100%" style="display: table; width: 100%;" role="grid" aria-describedby="tblJnsPembayaran_info">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: top;" width="20%">Jenis Pembayaran</th>
                                                    <th style="text-align: center; vertical-align: top;" width="30%">NTPN/Nomor
                                                        <br>Pemindahbukuan</th>
                                                    <th style="text-align: center; vertical-align: top;" width="15%">Tanggal Pembayaran</th>
                                                    <th style="text-align: center; vertical-align: top;" width="20%">Jumlah</th>
                                                    <th style="text-align: center; vertical-align: top;" width="15%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" style="font-weight: bold; text-align: right">Jumlah</td>
                                                    <td style="text-align: center; vertical-align: top;" width="30%">
                                                        <input class="form-control form-control-sm uang" type="text" readonly id="txtJmlNtpnPbk" />
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--Modal tombol tambah (awal)-->
                            <div class="modal fade" id="divJnsPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 12px;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2>Bukti Pembayaran Baru</h2>
                                            <!--begin::Close-->
                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                <i class="ki-outline ki-cross fs-1"></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-1"></div>
                                                    <label class="col-form-label required col-md-4">Jenis Pembayaran</label>
                                                    <div class="col-md-6">
                                                        <div class="mb-10 d-flex">
                                                            <div class="form-check form-check-custom me-10">
                                                                <input class="form-check-input" type="radio" name="rbPbyrn" id="rbByr1" value="1" checked>
                                                                <label class="form-check-label">
                                                                    NTPN
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-custom me-10">
                                                                <input class="form-check-input" type="radio" name="rbPbyrn" id="rbByr2" value="2">
                                                                <label class="form-check-label">
                                                                    Pemindahbukuan
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-1"></div>
                                                    <label class="col-form-label required col-md-4">NTPN/Nomor Pbk</label>
                                                    <div class="col-md-6">
                                                        <input type="text" id="pbyrnNomor" class="form-control form-control-sm" maxlength="100" style="text-align: left" placeholder="">
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-1"></div>
                                                    <label class="col-form-label col-md-4">Tanggal Pembayaran</label>
                                                    <div class="col-md-6">
                                                        <input type="text" id="pbyrnTglBuktiByr" class="form-control form-control-sm" readonly="">
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-1"></div>
                                                    <label class="col-form-label col-md-4">Jumlah</label>
                                                    <div class="col-md-6">
                                                        <input type="text" id="pbyrnJml" class="form-control form-control-sm uang" readonly="">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" id="btnAddBuktiBayar" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Modal tombol tambah (tutup)-->
                        </div>
                        <!--end::Portlet Kurang Bayar-->
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">B. Penghasilan yang dikenakan PPh Final dan yang dikecualikan dari Objek Pajak</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">8
                                </td>
                                <td style="width: 65%">Dasar Pengenaan Pajak/Penghasilan Bruto Pajak Penghasilan Final
                                </td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagB1" name="txtBagB1" class="form-control form-control-sm uang text-end" onblur="spt1770ss.cekBruto()">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">9
                                </td>
                                <td style="width: 65%">Pajak Penghasilan Final Terutang
                                </td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagB2" name="txtBagB2" class="form-control form-control-sm uang text-end">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 5%; text-align: center">10
                                </td>
                                <td style="width: 65%">Penghasilan yang Dikecualikan dari Objek Pajak
                                </td>
                                <td style="width: 30%">
                                    <input type="text" id="txtBagB3" name="txtBagB3" class="form-control form-control-sm uang text-end" onblur="spt1770ss.cekBruto();">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">C. Daftar Harta dan Kewajiban</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered mobile-djp">
                            <tbody>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">11 </td>
                                    <td style="width: 65%">Jumlah Keseluruhan Harta yang Dimiliki pada Akhir Tahun Pajak </td>
                                    <td style="width: 30%">
                                        <input type="text" id="txtBagC1" name="txtBagC1" class="form-control form-control-sm uang" style="text-align: right">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">12 </td>
                                    <td style="width: 65%">Jumlah Keseluruhan Kewajiban/Utang pada Akhir Tahun Pajak </td>
                                    <td style="width: 30%">
                                        <input type="text" id="txtBagC2" name="txtBagC2" class="form-control form-control-sm uang" style="text-align: right">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">D. Pernyataan</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <p> Dengan menyadari sepenuhnya akan segala akibatnya termasuk sanksi-sanksi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku saya menyatakan bahwa apa yang telah saya beritahukan di atas adalah benar, lengkap, jelas.</p>
                        <div class="col-md-12 d-flex justify-content-center">
                            <label class="form-check form-check-custom">
                                <!--begin::Input-->
                                <input class="form-check-input h-20px w-20px" type="checkbox" id="setuju" name="setuju" />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label text-gray-800">Setuju</span>
                                <!--end::Label-->
                            </label>
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 2-->
                <!--begin::Step 3-->
                <div data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-8 pb-lg-10">
                            <!--begin::Title-->
                            <h2 class="fw-bold text-dark">Selamat SPT Berhasil Dibuat!!</h2>
                            <!--end::Title-->
                            <!--begin::Notice-->
                            <div class="text-muted fw-semibold fs-6">
                                Silakan Kirim SPT Anda untuk Melaporkannya.
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Jenis Formulir</label>
                            <div class="col-lg-8">
                                <input type="text" id="txtJnsSpt" name="txtJnsSpt" readonly="" value="1770SS" class="form-control form-control-solid" aria-invalid="false">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Tahun Pajak</label>
                            <div class="col-lg-8">
                                <input type="text" id="vThPajak" name="vThPajak" readonly="" class="form-control form-control-solid">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Pembetulan Ke</label>
                            <div class="col-lg-8">
                                <input type="text" id="vRevno" name="vRevno" readonly="" class="form-control form-control-solid">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Status SPT</label>
                            <div class="col-lg-8">
                                <input type="text" id="vStatusLbKbn" name="vStatusLbKbn" readonly="" class="form-control form-control-solid">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Jumlah</label>
                            <div class="col-lg-8">
                                <input type="text" id="vJmlLbkbn" name="vJmlLbkbn" readonly="" class="form-control form-control-solid uang" style="text-align: right">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Catatan</label>
                            <div class="col-lg-8">
                                <textarea class="form-control form-control-solid" name="vStatusPengiriman" id="vStatusPengiriman" readonly="readonly" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Kode Keamanan</label>
                            <div class="col-lg-8 captcha" id="reload">
                                <span>{!! captcha_img() !!}</span>
                                <p style="margin: 0 4px; font-size: 12px;">klik untuk ubah kode</p>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Masukkan Kode Keamanan</label>
                            <div class="col-lg-3">
                                <input type="text" id="txtToken" name="token" class="form-control" maxlength="4" size="4">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label"></label>
                            <div class="col-lg-8">
                                <button type="button" class="btn btn-primary" id="btnSubmitSpt">
                                    <i class="fa fa-paper-plane"></i> Kirim SPT
                                </button>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 3-->
                <!--begin::Actions-->
                <div class="d-flex flex-stack pt-15">
                    <!--begin::Wrapper-->
                    <div class="mr-2">
                        <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                        <i class="ki-outline ki-arrow-left fs-4 me-1"></i>Sebelumnya</button>
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Wrapper-->
                    <div>
                        <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit" disabled>
                            <span class="indicator-label">Simpan
                            <i class="ki-outline ki-arrow-right fs-3 ms-2 me-0"></i></span>
                            <span class="indicator-progress">Mohon Tunggu...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Selanjutnya
                        <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i></button>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Stepper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection
@section('modal')

<!-- begin:: Modal Radio Kurang Bayar -->
<div class="modal fade show" id="divInfoKB" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2>INFO</h2>
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <p>Status SPT Anda adalah <strong>Kurang Bayar</strong></p>
                <p>Untuk dapat melakukan pembayaran pajak Anda, pastikan <strong>Kode Billing</strong> yang Anda buat dengan menggunakan :</p>
                <ul>
                    <li><strong>Kode Map : 411125 - PPh Pasal 25/29 OP</strong></li>
                    <li><strong>Kode Jenis Setoran : 200 - Tahunan</strong></li>
                    <li><strong id="thPjkBilling">Tahun Pajak : </strong></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- end:: Modal Radio Kurang Bayar -->
<!-- begin:: Modal Token -->
<div class="modal fade" id="divToken" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Pilih media pengiriman Kode Verifikasi</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <div class="modal-body">
                <div class="mb-5 fv-row fv-plugins-icon-container">
                    <label class="d-flex flex-stack mb-5 cursor-pointer">
                        <!--begin:Label-->
                        <span class="d-flex align-items-center me-2">
                            <!--begin::Icon-->
                            <span class="symbol symbol-50px me-6">
                                <span class="symbol-label">
                                    <i class="ki-outline ki-sms fs-1 text-gray-600"></i>
                                </span>
                            </span>
                            <!--end::Icon-->
                            <!--begin::Description-->
                            <span class="d-flex flex-column">
                                <span class="fw-bold text-gray-800 text-hover-primary fs-5">{{ auth()->user()->email }}</span>
                                <span class="fs-6 fw-semibold text-muted">Kirim Kode Verifikasi ke Email</span>
                            </span>
                            <!--end:Description-->
                        </span>
                        <!--end:Label-->
                        <!--begin:Input-->
                        <span class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="tokenvia" id="r1" value="0" checked>
                        </span>
                        <!--end:Input-->
                    </label>
                </div>
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnAmbilToken" class="btn btn-primary">Ok</button>
            </div>
            <!--end::Modal footer-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!-- end:: Modal Token -->
@endsection
@section('js')

<script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/form/sptproses.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/form/lsbilling.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/form/submision.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/form/spt1770ss.js') }}"></script>
<script>
    var spt1770 = "<?= $spt ?>";
    var jns = "1770SS";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection