@extends('layouts.metronic')

@section('title', 'Draf')
@section('css')

    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.min.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')
<!--begin::Page loading(append to body)-->
<div class="page-loader flex-column">
    <span class="spinner-border text-primary" role="status"></span>
    <span class="text-muted fs-6 fw-semibold mt-5">Loading...</span>
</div>
<!--end::Page loading-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        <!--begin::Table Widget 4-->
        <div class="card card-flush h-xl-100">
            <!--begin::Card header-->
            <div class="card-header pt-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Daftar Konsep SPT</span>
                    {{-- <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span> --}}
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-2">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed gy-3" id="tbl_drafspt">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>No</th>
                            <th>Jenis SPT</th>
                            <th>Tahun / Masa Pajak</th>
                            <th>Pembetulan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th class="w-150px">Aksi</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->form_code }}</td>
                            <td>{{ $item->year."/01-12" }}</td>
                            <td>{{ $item->correction_to }}</td>
                            <td>@money($item->tax_value)</td>
                            <td>{!! ($item->status==0) ? 'Draft' : 'Siap Kirim' !!}</td>
                            <td>
                                <a href="{{ route('pelajar.eform.1771', ['id'=> $item->id]) }}" class="btn btn-icon btn-active-light-primary w-25px h-25px kirimBpe" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit SPT">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>
                                <a href="{{ route('pelajar.spt.destroy', ['id'=>$item->id]) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus SPT Ini?', 'captchaModal')" class="btn btn-icon btn-active-light-primary w-25px h-25px hapus" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus SPT">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Table Widget 4-->
    </div>
    <!--end::Col-->
</div>
@endsection
@section('modal')

    <div class="modal fade" id="captchaModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form method="POST" id="myForm">
                    @csrf
                    @method('DELETE')

                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Hapus SPT</h2>
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
                                <input class="form-control captchaModal" type="text" name="captcha" maxlength="4" placeholder="" required/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
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

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script>
        $("#tbl_drafspt").DataTable();
    </script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection