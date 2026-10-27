@extends('layouts.metronic')

@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('title', 'Tambah PPh Setor Sendiri')
@section('content')
<!--begin::Data-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Perekaman data Bukti Setor atas PPh yang disetor sendiri</h3>
            <input type="hidden" id="jenis-input" value="{{ $jenis_input }}"/>
            <input type="hidden" id="npwp-user" value="{{ auth()->user()->npwp }}"/>
            <input type="hidden" id="status-bs" value="{{ $jenis_input }}"/>
            <input type="hidden" id="id" value="{!! ($data) ? $data->id : "" !!}"/>
            <input type="hidden" id="thnPjkEdit" value="{!! ($data) ? $data->thnPajak : "" !!}"/>
            <input type="hidden" id="msPjkEdit" value="{!! ($data) ? $data->msPajak : "" !!}"/>
            <input type="hidden" id="kdMapEdit" value="{!! ($data) ? $data->kdMap : "" !!}"/>
            <input type="hidden" id="kjsEdit" value="{!! ($data) ? $data->kdJnsSetor : "" !!}"/>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div class="collapse show">
        <form id="formRekamPphss">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <div class="row justify-content-center mb-5">
                <div class="col-10">
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenis Bukti Penyetoran</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <div class="mt-3 d-flex">
                                <div class="form-check form-check-custom me-10">
                                    <input class="form-check-input w-20px h-20px"  id="fgPbkBpe0" type="radio" name="fgPbkBpe" value="0" checked>
                                    <label class="form-check-label">
                                        Surat Setoran Pajak
                                    </label>
                                </div>
                                <div class="form-check form-check-custom me-10">
                                    <input class="form-check-input w-20px h-20px" id="fgPbkBpe1" type="radio" name="fgPbkBpe" value="1" readonly>
                                    <label class="form-check-label">
                                        Pemindahbukuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">NTPN</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input id="noBpe" type="text" class="form-control" autocomplete="off" name="noBuktiSetor" value="{!! ($data) ? $data->noBuktiSetor : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tahun Pajak</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select id="thnPajakBpe" name="thnPajakBpe" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-control form-select form-select-md">
                                <option value="">Pilih Tahun Pajak</option>
                                @for($i = date('Y'); $i >= date('Y')-1; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <input type="hidden" id="val-thnPajakBpe" name="thnPajak" value="{!! ($data) ? $data->thnPajak : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="mb-5 text-center">
                        <!--end::Input group-->
                        <button id='btnSearchBpe' type="button" class="btn btn-primary">
                            <i class="fa fa-search"></i> Cek Surat Setoran Pajak
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10">
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tahun Pajak</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input readonly id="thnPajak" type="text" class="form-control form-control-solid" autocomplete="off" name="thnPajak" value="{!! ($data) ? $data->thnPajak : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Masa Pajak</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input readonly id="masaPajak" type="text" class="form-control form-control-solid" autocomplete="off" name="msPajak" value="{!! ($data) ? $data->msPajak : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenis Pajak (MAP)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input readonly id="jnsPajak" type="text" class="form-control form-control-solid" autocomplete="off" name="kdMap" maxlength="6" value="{!! ($data) ? $data->kdMap : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenis Setoran</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input readonly id="jnsSetoran" type="text" class="form-control form-control-solid" autocomplete="off" name="kdJnsSetor" value="{!! ($data) ? $data->kdJnsSetor : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Kode Objek Pajak</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select id="kdObjPajak" name="kdObjPajak" data-control="select2" data-placeholder="Pilih Kode Objek Pajak" class="form-control form-select form-select-md">
                                <option value="">Pilih Kode Objek Pajak</option>
                            </select>
                            <input type="hidden" id="val-kdObjPajak" name="kdObjPajak" value="{!! ($data) ? $data->kdObjPajak : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jumlah Penghasilan Bruto</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input id="jmlPhBruto" type="text" class="form-control currency" autocomplete="off" name="jmlBruto" value="{!! ($data) ? $data->jmlBruto : "" !!}"/>
                            <div class="form-text text-danger" id="jmlPhBruto-errorCustom" style="display: none;">Jumlah Penghasilan Bruto harus lebih besar atau sama dengan Jumlah Setor.</div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jumlah Setor (Rp)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input readonly id="jmlSetor" type="text" class="form-control form-control-solid currency" autocomplete="off" name="jmlSetor" value="{!! ($data) ? $data->jmlSetor : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal Setor</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input readonly id="tglSetor" type="text" class="form-control form-control-solid" autocomplete="off" name="tglSetor" value="{!! ($data) ? $data->tglSetor : "" !!}"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
            </div>
        </div>
        <!--end::Card body-->
        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button id="btnReset" type="button" class="btn btn-light btn-active-light-primary me-2">Batal</button>
            <button id='btnSubmit' type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <!--end::Actions-->
        </form>
    </div>
    <!--end::Content-->
</div>
<!--end::Data-->
@endsection
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" type="text/javascript"></script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pages/input_pphss.js') }}" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection