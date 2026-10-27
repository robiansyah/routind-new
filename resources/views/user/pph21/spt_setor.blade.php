@extends('layouts.metronic')
@section('title', 'Penyiapan Bukti Setor SPT Masa Pajak ['.$spt->start_period.' - '.$spt->year.']')
@section('css')

<link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border">
        <!--begin::Card title-->
        <div class="card-title">
            <a href="{{ route('pph21.spt', ['year'=>$spt->year]) }}" class="btn btn-sm btn-primary me-2"><i class="ki-outline ki-arrow-left"></i>Kembali</a> SPT Masa Pajak Penghasilan Pasal 21 dan/atau Pasal 26
        </div>
        <!--begin::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <div class="table-responsive mb-2 py-2">
            <h4 class="mb-4">Daftar Tagihan Pemotongan atas Bukti Pemotongan Pemungutan PPh 21</h4>
            <input type="hidden" id="period" value="{{ $spt->start_period }}"/>
            <input type="hidden" id="year" value="{{ $spt->year }}"/>
            <input type="hidden" id="spt_id" value="{{ $spt->id }}"/>
            <!--begin::Table-->
            <table class="table table-bordered" id="tbl_tagihan">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                        <th class="text-center">Jenis Pajak</th>
                        <th class="text-center">Jenis Setoran</th>
                        <th class="text-center">Pph yang Dipotong</th>
                        <th class="text-center">ID Billing</th>
                        <th class="text-center w-100px">Aksi</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>

                </tbody>
                <!--end::Table body-->
            </table>
        </div>
        <div class="table-responsive mb-2 py-2">
            <h4 class="mb-4">
                Daftar Bukti Setor
                <a href="javascript:void(0)" id="pembayaran_new" class="btn btn-icon btn-primary w-30px h-30px me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Bukti Setor">
                    <i class="ki-outline ki-plus fs-2"></i>
                </a>
            </h4>
            <!--begin::Table-->
            <table class="table table-bordered" id="tbl_pembayaran">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                        <th class="text-center">No</th>
                        <th class="text-center">Nomor Bukti</th>
                        <th class="text-center">Jenis Pajak</th>
                        <th class="text-center">Jenis Setoran</th>
                        <th class="text-center">Masa Tahun Pajak</th>
                        <th class="text-center">Tanggal Setor</th>
                        <th class="text-center">Jumlah Setor</th>
                        <th class="text-center w-100px">Aksi</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    {{-- <?php $no=1; ?>
                    @foreach ($deposit as $item)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $item->noBuktiSetor }}</td>
                            <td class="text-center">{{ $item->kdMap }}</td>
                            <td class="text-center">{{ $item->kjs }}</td>
                            <td>{{ $item->msPajak.' - '.$item->thnPajak }}</td>
                            <td>{{ $item->tglSetor }}</td>
                            <td class="text-end">@money($item->jmlSetor)</td>
                            <td>Aksi</td>
                        </tr>
                    @endforeach --}}
                </tbody>
                <!--end::Table body-->
            </table>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection
@section('modal')
<div class="modal fade" id="modal_cetak" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="modal-title">Cetak Kode Billing</h2>
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
                <div id="isi_cetak"></div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--begin::Modal-->
<div class="modal fade" id="modal_pembayaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h3 class="modal-title">Perekaman Data Bukti Setor</h3>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
            <form id="form_pembayaran">
                <div class="modal-body">
                    <div class="row justify-content-center mb-5">
                        <div class="col-10">
                            <!--begin::Input group-->
                            <div class="row mb-1">
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
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">NTPN</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input id="noBpe" type="text" class="form-control" autocomplete="off" name="noBpe"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-2">
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
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="mb-2 text-center">
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
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tahun Pajak</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input readonly id="thnPajak" type="text" class="form-control form-control-solid"  autocomplete="off" name="thnPajak"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Masa Pajak</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input readonly id="masaPajak" type="text" class="form-control form-control-solid" autocomplete="off" name="masaPajak"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenis Pajak (MAP)</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input readonly id="jnsPajak" type="text" class="form-control form-control-solid" autocomplete="off" name="jnsPajak" maxlength="6"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenis Setoran</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input readonly id="jnsSetoran" type="text" class="form-control form-control-solid" autocomplete="off" name="jnsSetoran"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jumlah Setor (Rp)</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input readonly id="jmlSetor" type="text" class="form-control form-control-solid currency" autocomplete="off" name="jmlSetor"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal Setor</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input readonly id="tglSetor" type="text" class="form-control form-control-solid" autocomplete="off" name="tglSetor"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-3 justify-content-center">
                    <button id='btnReset' type="button" data-bs-dismiss="modal" class="btn btn-secondary">
                        <i class="fa fa-undo-alt"></i> Batal
                    </button>
                    <button id='btnSubmit' type="button" data-bs-dismiss="modal" class="btn btn-primary">
                        <i class="la la-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--end::Modal-->
@endsection
@section('js')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pph21/payment.js') }}"></script>
    
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection