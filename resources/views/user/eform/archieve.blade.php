@extends('layouts.metronic')

@section('title', 'Arsip')
@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('content')
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        <!--begin::Table Widget 4-->
        <div class="card card-flush h-xl-100">
            <!--begin::Card header-->
            <div class="card-header pt-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Daftar SPT</span>
                    {{-- <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span> --}}
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-2">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed gy-3" id="tbl_arsipspt">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>No</th>
                            <th>Jenis SPT</th>
                            <th>Tahun / Masa Pajak</th>
                            <th>Pembetulan</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th class="w-100px">Aksi</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->form_code }}
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Tanggal Penyampaian : {{ $item->date }}">
                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                </span>
                            </td>
                            <td>{{ $item->year."/01-12" }}</td>
                            <td>{{ $item->correction_to }}</td>
                            <td>{!! ($item->status==0) ? 'Nihil' : (($item->status==1) ? 'Kurang Bayar' : (($item->status==2) ? 'Lebih Bayar' : 'Lainnya')) !!}</td>
                            <td>@money($item->tax_value)</td>
                            <td>{{ (($item->question->type) ?: $item->jenis_nilai) }}</td>
                            <td>
                                <button data-id="{{ $item->id }}" class="btn btn-icon btn-active-light-primary w-25px h-25px bpe" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat BPE">
                                    <i class="fa fa-file-archive text-warning"></i>
                                </button>
                                <a href="{{ route('pelajar.eform.1771', ['id'=> $item->id]) }}" class="btn btn-icon btn-active-light-primary w-25px h-25px kirimBpe" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat SPT">
                                    <i class="fa fa-folder text-primary"></i>
                                </a>
                                @if($class_student && $item->question_id=='')
                                    <button data-id="{{ $item->id }}" data-code="{{ $class_student->kelas->code }}" class="btn btn-icon btn-active-light-primary w-25px h-25px submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Penugasan">
                                        <i class="fa fa-bookmark text-danger"></i>
                                    </button>
                                @endif
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

<!--begin::Modal - BPE-->
<div class="modal fade" id="divBpe" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header py-5 d-flex justify-content-between">
                <!--begin::Modal title-->
                <h2>Detail BPE</h2>
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
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Description-->
                    <div class="fw-semibold fs-5">
                        Berikut ini adalah Bukti Penerimaan Elektronik Anda.<br>
                            ---------------------------------------------------
                    </div>
                    <div id="mname"></div>
                    <div id="mnpwp"></div>
                    <div id="myear"></div>
                    <div id="mperiod"></div>
                    <div id="mtype"></div>
                    <div id="mcorrection"></div>
                    <div id="mstatus"></div>
                    <div>
                        <label>Nominal :</label>
                        <label id="mnominal" class="uang"></label>
                    </div>
                    <div id="mdate"></div>
                    <div id="mntte"></div>
                    Terima kasih telah menyampaikan Laporan SPT Anda.
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - BPE-->
@if($class_student)
    <div class="modal fade" id="submit" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form method="POST" action="{{ route('ruang.kelas.question', ['code'=>$class_student->kelas->code]) }}">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Submit Penugasan</h2>
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
                        @csrf

                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Pilih Penugasan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <select name="question_id" id="question_id" data-kt-select2="true" data-placeholder="Pilih Penugasan" class="form-select form-select-md" data-dropdown-parent="#submit" required>
                                    <option value="">Pilih Penugasan</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <input type="hidden" name="spt" id="spt">
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
@endif
@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/bpe.js') }}" type="text/javascript"></script>

    <script>
        $("#tbl_arsipspt").DataTable();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection