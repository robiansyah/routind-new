@extends('layouts.metronic')
@section('title', 'SPT Detail Masa Pajak ['.$spt->start_period.' - '.$spt->year.']')
@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            SPT Masa Pajak Penghasilan Pasal 21 dan/atau Pasal 26
        </div>
        <!--begin::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <div class="table-responsive mb-2 py-2">
            <h4 class="mb-4">Objek Pajak</h4>
            <!--begin::Table-->
            <table class="table table-bordered border-gray-600">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Penerima Penghasilan</th>
                        <th class="text-center align-middle">Kode Objek Pajak</th>
                        <th class="text-center align-middle w-100px">Jumlah Penerima Penghasilan</th>
                        <th class="text-center align-middle w-100px">Jumlah Penghasilan Bruto</th>
                        <th class="text-center align-middle w-100px">Jumlah Pajak Dipotong</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    <?php $no = 1; $penerima=0; $bruto=0; $pph=0;?>
                    @foreach ($tidak as $item)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $item->object->nmObjkPjk }}</td>
                            <td>{{ $item->kdObjPjk }}</td>
                            <td class="text-center">{{ $item->jmlPenerima }}</td>
                            <td class="text-end">@money($item->jmlBruto)</td>
                            <td class="text-end">@money($item->jmlPph)</td>
                        </tr>
                        <?php $penerima += $item->jmlPenerima; $bruto += $item->jmlBruto; $pph += $item->jmlPph?>
                    @endforeach
                </tbody>
                <!--end::Table body-->
                <!--begin::Table foot-->
                <tfoot>
                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                        <td colspan="3" class="text-center">Jumlah A1</td>
                        <td class="text-center">{{ $penerima }}</td>
                        <td class="text-end">@money($bruto)</td>
                        <td class="text-end">@money($pph)</td>
                    </tr>
                </tfoot>
                <!--end::Table foot-->
            </table>
        </div>

        <div class="table-responsive mb-2 py-2">
            <h4 class="mb-4">Objek Pajak Final</h4>
            <!--begin::Table-->
            <table class="table table-bordered border-gray-600">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Penerima Penghasilan</th>
                        <th class="text-center align-middle">Kode Objek Pajak</th>
                        <th class="text-center align-middle w-100px">Jumlah Penerima Penghasilan</th>
                        <th class="text-center align-middle w-100px">Jumlah Penghasilan Bruto</th>
                        <th class="text-center align-middle w-100px">Jumlah Pajak Dipotong</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    <?php $no = 1; $penerima=0; $bruto=0; $pph=0;?>
                    @foreach ($final as $item)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $item->object->nmObjkPjk }}</td>
                            <td>{{ $item->kdObjPjk }}</td>
                            <td class="text-center">{{ $item->jmlPenerima }}</td>
                            <td class="text-end">@money($item->jmlBruto)</td>
                            <td class="text-end">@money($item->jmlPph)</td>
                        </tr>
                        <?php $penerima += $item->jmlPenerima; $bruto += $item->jmlBruto; $pph += $item->jmlPph?>
                    @endforeach
                </tbody>
                <!--end::Table body-->
                <!--begin::Table foot-->
                <tfoot>
                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                        <td colspan="3" class="text-center">Jumlah A1</td>
                        <td class="text-center">{{ $penerima }}</td>
                        <td class="text-end">@money($bruto)</td>
                        <td class="text-end">@money($pph)</td>
                    </tr>
                </tfoot>
                <!--end::Table foot-->
            </table>
        </div>
    </div>
    <!--end::Card body-->
    <div class="card-footer d-flex justify-content-end py-1 pt-5 px-9 mb-5">
        <a href="{{ route('spt.index', ['status'=>'konsep']) }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
        <a href="{{ route('spt.update', ['id'=>$spt->id]) }}" onclick="confirmation2(event, 'Apakah Anda Yakin Akan Mensubmit SPT Ini?', 'captchaModal2')" class="btn btn-primary">
            Submit
        </a>
    </div>
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
    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection