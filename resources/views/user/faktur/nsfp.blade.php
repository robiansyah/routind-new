@extends('layouts.metronic')

@section('title', 'Nomor Seri Faktur Pajak')
@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
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
                    <span class="card-label fw-bold text-gray-800">Daftar NSFP</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Nomor Seri Faktur Pajak</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <a href="#tambah" data-bs-toggle="modal" class="btn btn-sm btn-primary">Tambah NSFP</a>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-2">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed gy-3" id="tbl_nsfp">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-25px">#</th>
                            <th>No Seri</th>
                            <th class="w-50px">Jumlah No</th>
                            <th class="w-50px">Tahun Pajak</th>
                            <th>Tanggal Pengajuan</th>
                            <th class="w-50px">Aksi</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
                        <?php $no=1;?>
                        @foreach ($nsfp as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->start_nsfp.' - '.$item->end_nsfp }}</td>
                                <td>{{ $item->range }}</td>
                                <td>{{ $item->year }}</td>
                                <td>{{ $item->created_at->isoFormat('D MMMM Y') }}</td>
                                <td>
                                    <span class="detail" data-bs-toggle="modal" data-start="{{ $item->start_nsfp }}" data-end="{{ $item->end_nsfp }}" data-range="{{ $item->range }}" data-bs-target="#detail" >
                                        <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail NSFP">
                                            <i class="fa fa-file-alt"></i>
                                        </button>
                                    </span>
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
<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form class="form" method="POST" action="{{ route('faktur.nsfp.store') }}">
            @csrf

            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Tambah NSFP</h2>
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
                <div class="mb-5 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Tahun Pajak</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="year" aria-label="Pilih Tahun Pajak" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-select form-select-md" data-dropdown-parent="#tambah" required>
                        <option value="">Pilih Tahun Pajak</option>
                        @for($i = date('Y'); $i > date('Y')-3; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <!--end::Input-->
                </div>
                <div class="mb-5 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Jumlah No</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="number" class="form-control" name="range" placeholder="Jumlah No" min="5" max="100">
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <!--end::Modal footer-->
            </form>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - BPE-->
<!--begin::Modal - Detail-->
<div class="modal fade" id="detail" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Detail NSFP</h2>
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
                        <p>Nomor Seri Faktur Pajak Sebanyak <span id="mrange"></span> dimulai dari :</p>
                        <h1 class="fw-bold text-dark" id="mstart"></h1>
                        <p>Sampai dengan</p>
                        <h1 class="fw-bold text-dark" id="mend"></h1>
                    </div>
                    
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
@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $("#tbl_nsfp").DataTable();

        $('.detail').on('click', function(){
            var start = $(this).attr('data-start');
            var end = $(this).attr('data-end');
            var range = $(this).attr('data-range');
            $('#mstart').text(start);
            $('#mend').text(end);
            $('#mrange').text(range);
        });

        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showMessage("", "{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}", 'Ok, got it!');
            </script>
        @endif
    @endforeach
@endsection