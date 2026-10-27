@extends('layouts.metronic')

@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('title', 'Tambah PPh Unifikasi')
@section('content')

<!--begin::Data-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Perekaman data Bukti Pemotongan/Pemungutan PPh Unifikasi</h3>
            <input type="hidden" id="jenis-input" value="{{ $jenis_input }}"/>
            <input type="hidden" id="status-bupot" value="{{ ($jenis_input=="Pembetulan") ? $jenis_input : "" }}"/>
            <input type="hidden" id="fgLapor" value="0"/>
            <input type="hidden" id="msgError" value=""/>
            <input type="hidden" id="npwpUser" value="{{ auth()->user()->npwp }}"/>
            <input type="hidden" id="optNik" value="1"/>
            <input type="hidden" id="startYear" value="{{ date('Y')-1 }}"/>
            <input type="hidden" id="startMonth" value="01"/>
            <input type="hidden" id="tglApp" value="{{ date('d/m/Y') }}"/>
            <input type="hidden" id="idBupot" name="idBupot" value="{!! ($data) ? $data->idBupot : "" !!}"/>
            <input type="hidden" id="noBupot" name="noBupot" value="{!! ($data) ? $data->noBupot : "" !!}"/>
            <input type="hidden" id="revNo" name="revNo" value="{!! ($data) ? $data->revNo : "" !!}"/>
            <input type="hidden" id="tglPemotongan" name="tglPemotongan" value="{!! ($data) ? $data->tglPemotongan : "" !!}"/>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div class="collapse show">
        <form id="formRekam">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <h3 class="pb-5">A. Identitas Wajib Pajak yang Dipotong/Dipungut</h3>
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tahun / Masa Pajak</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-5 fv-row">
                    <select name="thnPjk" id="thnPjk" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-control form-select form-select-md">
                        <option value="">Pilih Tahun Pajak</option>
                        @for($i = date('Y'); $i > date('Y')-2; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <input class="input-select" type="hidden" id="val-thnPjk" name="thnPajak" value="{!! ($data) ? $data->thnPajak : "" !!}"/>
                </div>
                <div class="col-lg-4 fv-row">
                    <select name="msPjk" id="msPjk" data-control="select2" data-placeholder="Pilih Masa Pajak" class="form-control form-select form-select-md">
                        <option value="">Pilih Masa Pajak</option>
                    </select>
                    <input class="input-select" type="hidden" id="val-msPjk" name="msPajak" value="{!! ($data) ? $data->msPajak : "" !!}"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Identitas</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-9 fv-row">
                    <div class="mt-4 d-flex">
                        <div class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-25px w-25px" id="optIdentitas1" type="radio" name="optIdentitas" value="0">
                            <label class="form-check-label">
                                NPWP
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-25px w-25px" id="optIdentitas2" type="radio" name="optIdentitas" value="1">
                            <label class="form-check-label">
                                NIK
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="fgIdentitas" name="fgIdDipotong" value="{!! ($data) ? $data->fgIdDipotong : "" !!}"/>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5" id="div-npwp">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">NPWP</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-9 fv-row">
                    <input id="npwp" type="text" class="form-control" autocomplete="off" name="npwp" placeholder="" maxlength="20">
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5" id="div-nik">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">NIK</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-9 fv-row">
                    <input id="nik" type="text" class="form-control" autocomplete="off" name="nik" placeholder="" maxlength="16"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <input type="hidden" id="idDipotong" name="idDipotong" value="{!! ($data) ? $data->idDipotong : "" !!}"/>
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-9 fv-row">
                    <input type="text" class="form-control" name="namaDipotong" id="namaDipotong" placeholder="Nama Lengkap" value="{!! ($data) ? $data->namaDipotong : "" !!}" required>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Alamat</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-9 fv-row">
                    <textarea name="almtDipotong" id="almtDipotong" class="form-control">{!! ($data) ? $data->almtDipotong : "" !!}</textarea>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <h3 class="py-5">B. Pajak Penghasilan yang Dipotong/Dipunguts</h3>
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Kode Objek Pajak</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-9 fv-row">
                    <select data-control="select2" data-placeholder="Pilih Kode Objek Pajak" class="form-control form-select form-select-md" id="objPjk" name="objPjk">
                        <option></option>
                    </select>
                    <input type="hidden" id="val-objPjk" name="kdObjPjk" value="{!! ($data) ? $data->kdObjPjk : "" !!}"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <input type="hidden" id="val-fgFasilitas" name="fgFasilitas" value="{!! ($data) ? $data->fgFasilitas : "" !!}"/>
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Fasilitas Pajak Penghasilan</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-9 fv-row">
                    <div class="form-check form-check-custom mt-4">
                        <input class="form-check-input w-20px h-20px" id="optFasilitas1" type="radio" name="optFasilitas" value="0" checked="checked">
                        <label class="form-check-label">
                            Tanpa Fasilitas
                        </label>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label fw-semibold fs-6"></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <div class="form-check form-check-custom mt-4">
                        <input class="form-check-input w-20px h-20px" id="optFasilitas2" type="radio" name="optFasilitas" value="1">
                        <label class="form-check-label">
                            Surat Keterangan Bebas (SKB)
                        </label>
                    </div>
                </div>
                <div class="col-lg-5 fv-row">
                    <input readonly id="noSkb" type="text" class="form-control inputFas" autocomplete="off" name="noSkb" placeholder="Nomor SKB" value="{!! ($data) ? $data->noSkb : "" !!}"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label fw-semibold fs-6"></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <div class="form-check form-check-custom mt-4">
                        <input class="form-check-input w-20px h-20px" id="optFasilitas3" type="radio" name="optFasilitas" value="3">
                        <label class="form-check-label">
                            PPh Ditanggung Pemerintah (DTP)
                        </label>
                    </div>
                </div>
                <div class="col-lg-5 fv-row">
                    <input readonly id="noAturanDtp" type="text" class="form-control inputFas" autocomplete="off" name="noAturanDtp" placeholder="Nomor Aturan DTP" value="{!! ($data) ? $data->noAturanDtp : "" !!}"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label fw-semibold fs-6"></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <div class="form-check form-check-custom mt-4">
                        <input class="form-check-input w-20px h-20px" id="optFasilitas4" type="radio" name="optFasilitas" value="4">
                        <label class="form-check-label">
                            Surat Keterangan berdasarkan PP No 23 2018
                        </label>
                    </div>
                </div>
                <div class="col-lg-5 fv-row">
                    <input readonly id="noSKPP23" type="text" class="form-control inputFas" autocomplete="off" name="noSKPP23" placeholder="Nomor Suket PP23" value="{!! ($data) ? $data->noSKPP23 : "" !!}"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label fw-semibold fs-6"></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <div class="form-check form-check-custom mt-4">
                        <input class="form-check-input w-20px h-20px" id="optFasilitas5" type="radio" name="optFasilitas" value="5">
                        <label class="form-check-label">
                            Fasilitas lainnya berdasarkan
                        </label>
                    </div>
                </div>
                <div class="col-lg-5 fv-row">
                    <input readonly id="noDokLainnya" type="text" class="form-control inputFas" autocomplete="off" name="noDokLainnya" placeholder="Nomor Dokumen Fasilitas Lainnya" value="{!! ($data) ? $data->noDokLainnya : "" !!}"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Jumlah Penghasilan Bruto</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <input id="jmlBruto" type="text" class="form-control currency" autocomplete="off" name="jmlBruto" value="{!! ($data) ? $data->jmlBruto : "" !!}"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tarif</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <input readonly id="tarif" type="text" class="form-control percent" autocomplete="off" name="tarif" value="{!! ($data) ? $data->tarif : "" !!}"/>
                </div>
                <div class="col-lg-4 fv-row">
                    <span id="info-tarif" class="text-danger font-italic" style="display: none;">Tarif 100% lebih tinggi</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-5">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">PPh yang Dipotong/ Dipungut</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <input readonly id="pphDipotong" type="text" class="form-control currency" autocomplete="off" name="pphDipotong" value="{!! ($data) ? $data->pphDipotong : "" !!}"/>
                    <span id="pphDipotong-errorCustom" class="text-danger" style="display: none; width: 100%; margin-top: .25rem; font-size: 80%;">Jumlah PPh Dipotong harus lebih besar atau sama dengan 0 dan lebih kecil atau sama dengan Jumlah Penghasilan Bruto.</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <h3 class="py-5">
                C. Dokumen Dasar Pemotongan
                <a href="javascript:void(0)" id="btn-add-dokdasar" class="btn btn-icon btn-primary w-30px h-30px me-2" >
                    <i class="ki-outline ki-plus fs-2"></i>
                </a>
            </h3>
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed gy-3" id="tbl_dokdasarpot">
                    <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="text-center">Nama Dokumen</th>
                        <th class="text-center">Nomor Dokumen</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($data)
                        @foreach($data->docs as $item)
                            <tr>
                                <td>{{ $item->jnsDok }}</td>
                                <td>{{ $item->nomorDok }}</td>
                                <td>{{ $item->tglDok }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="p-5">
                <h4>PERNYATAAN</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="fgSetuju"/>
                    <label class="form-check-label text-danger">
                        Dengan ini saya menyatakan bahwa Bukti Pemotongan/Pemunguran Unifikasi telah saya isi dengan benar dan telah saya tandatangani secara elektronik.
                    </label>
                </div>
            </div>
        </div>
        <!--end::Card body-->
        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button id="btnReset" type="button" class="btn btn-light btn-active-light-primary me-2">Batal</button>
            <button id='btnSubmit' type="button" class="btn btn-primary">Simpan</button>
        </div>
        <!--end::Actions-->
        </form>
    </div>
    <!--end::Content-->
</div>
<!--end::Data-->
@endsection
@section('modal')

<div class="modal fade" id="modal_dokumen" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="modal-title">Dasar Pemotongan</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <form id="form_c_ps42152223">
            <div class="modal-body">
                <!--begin::Input group-->
                <div class="row mb-5">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama Dokumen</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <select data-control="select2" data-placeholder="Pilih Nama Dokumen" class="form-control form-select form-select-md" id="nmDokDasar" name="nmDokDasar">
                            <option></option>
                            <option value="01">Faktur Pajak</option>
                            <option value="02">Invoice</option>
                            <option value="03">Pengumuman</option>
                            <option value="04">Surat Perjanjian</option>
                            <option value="05">Bukti Pembayaran</option>
                            <option value="06">Akta Perikatan</option>
                            <option value="07">Akta RUPS</option>
                            <option value="08">Surat Pernyataan</option>
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-5">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">No Dokumen</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input id="noDokDasar" type="text" class="form-control" autocomplete="off" name="noDokDasar"/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-5">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tanggal Dokumen</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input id="tglDokDasar" type="text" class="form-control datepicker" autocomplete="off" name="tglDokDasar"/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" id="btnSubmitC" class="btn btn-primary"><i class='fa fa-plus-circle'></i>
                    Tambahkan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--end::Modal-->
@endsection
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" type="text/javascript"></script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pages/input_ps42152223_edit.js?v=3') }}" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection