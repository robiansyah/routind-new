@extends('layouts.metronic')

@section('title', 'Buat Kode Billing')
@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Form Buat Kode Billing</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div class="collapse show">
        <!--begin::Form-->
        <form class="form" id="form_sse">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">NPWP</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input type="text" name="npwp15" id="npwp15" class="form-control form-control-solid" value="{!! (auth()->user()->wp_type==1) ? auth()->user()->username : auth()->user()->npwp !!}" readonly/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input type="text" name="nama" id="nama" class="form-control form-control-solid" value="{!! (auth()->user()->wp_type==1) ? auth()->user()->name : auth()->user()->profile->corporate_name !!}" readonly/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Alamat</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <textarea name="alamat" id="alamat" rows="3" class="form-control form-control-solid" readonly>{{ ucwords(auth()->user()->profile->address ?? "-") }}</textarea>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6" for="kdMap">Jenis Pajak </label>
                    <div class="col-lg-9 fv-row">
                        <select data-control="select2" class="form-select form-select-md" name="kdMap" id="kdMap">
                        </select>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6" for="kjs">Jenis Setoran </label>
                    <div class="col-lg-9 fv-row">
                        <select data-control="select2" class="form-select form-select-md" name="kjs" id="kjs">
                        </select>
                    </div>
                </div>
                <div class="row mb-6" id="blockMsPjk">
                    
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Masa Pajak </label>
                    <div class="col-lg-9 fv-row">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select name="msPjkAwl" class="form-control one-body" id="msPjkAwl">
                                        <option value="01">01-Januari</option>
                                        <option value="02">02-Februari</option>
                                        <option value="03">03-Maret</option>
                                        <option value="04">04-April</option>
                                        <option value="05">05-Mei</option>
                                        <option value="06">06-Juni</option>
                                        <option value="07">07-Juli</option>
                                        <option value="08">08-Agustus</option>
                                        <option value="09">09-September</option>
                                        <option value="10">10-Oktober</option>
                                        <option value="11">11-November</option>
                                        <option value="12">12-Desember</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text">s/d</span>
                                    </div>
                                    <select name="msPjkAkr" class="form-control one-body" id="msPjkAkr">
                                        <option value="01">01-Januari</option>
                                        <option value="02">02-Februari</option>
                                        <option value="03">03-Maret</option>
                                        <option value="04">04-April</option>
                                        <option value="05">05-Mei</option>
                                        <option value="06">06-Juni</option>
                                        <option value="07">07-Juli</option>
                                        <option value="08">08-Agustus</option>
                                        <option value="09">09-September</option>
                                        <option value="10">10-Oktober</option>
                                        <option value="11">11-November</option>
                                        <option value="12">12-Desember</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6" id="blockThnPjk">
                    
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6" for="thnPajak">Tahun Pajak </label>
                    <div class="col-lg-9 fv-row">
                        <select data-control="select2" class="form-control" name="thnPajak" id="thnPajak">
                            <option value=''>Pilih.....</option>
                            <?php $years = array();?>
                            @for ($i = date('Y'); $i >= 2000; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor    
                        </select>
                    </div>
                </div>
                <div class="row mb-6" id="blockNop" style="display: none">
                                
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6" for="nop">NOP </label>
                    <div class="col-lg-9 fv-row">
                        <input class="form-control nop" placeholder="" type="text" id="nop" name="nop"/>
                    </div>
                    
                </div>
                <div class="row mb-6" id="blockNoSk" style="display: none">
                    
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6" for="noSk">Nomor Ketetapan </label>
                    <div class="col-lg-9 fv-row">
                        <input class="form-control noSk" type="text" id="noSk" name="noSk"/>
                        <span class="help-block"></span>
                        <span class="help-block">Format: No Urut/Jenis SKP/Tahun Pajak/Kode KPP/Tahun Terbit</span>
                    </div>
                    
                </div>
                <div class="row mb-6" id="blockCurrency">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6" for="currency">Jumlah Setor </label>
                    <div class="col-lg-9 fv-row">
                        <div class="row">
                            <div class="col-4">
                                <select class="form-control" name="currency" id="currency">
                                    <option value="01">IDR (Rp)</option>
                                    <option value="02">USD ($)</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <input type="text" placeholder="" class="form-control text-end uang" id="jmlStr" name="jmlStr"/>
                            </div>
                            <span class="help-block" for="jmlStr"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Uraian</label>
                    <div class="col-lg-9 fv-row">
                    <textarea placeholder="uraian (300 karakter)" class="form-control" id="uraian" name="uraian" rows="2" maxlength="75"></textarea>
                    </div>
                    
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6 kt-font-boldest">Catatan :</label>
                    <label class="col-form-label col-lg-9 fv-row kt-font-boldest">Apabila ada kesalahan dalam isian Kode Billing atau masa berlakunya berakhir, Kode Billing dapat dibuat kembali. Tanggung jawab isian Kode Billing ada pada Wajib Pajak yang namanya tercantum di dalamnya.</label>
                </div>
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button id="btnBatal" name="btnBatal" type="button" class="btn btn-light btn-active-light-primary me-2">
                    <i class="fa fa-undo-alt"></i> Kosongkan
                </button>
                <button id="btnGenerate" name="btnGenerate" type="button" class="btn btn-primary">
                    <i class="la la-save"></i> Buat Kode Billing
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->
@endsection
@section('modal')

<div class="modal fade" id="captchaModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="modal-title">Buat Kode Billing</h2>
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
                    <label class="col-lg-5 col-form-label required fw-semibold fs-6">Kode Keamanan</label>
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
                    <label class="col-lg-5 col-form-label required fw-semibold fs-6">Isikan Kode Keamanan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <input class="form-control" type="text" id="captcha" maxlength="4" placeholder=""/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btnOk">Submit</button>
            </div>
            <!--end::Modal footer-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/billcommon.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/formsse.js') }}" type="text/javascript"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@endsection