@extends('layouts.metronic')

@section('title')
    Bukti Potong A1 Tahun {{ $year }}
@endsection
@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 me-3">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Cari" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Filter-->
                    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Separator-->
                        <!--begin::Content-->
                        <div class="px-7 py-5">
                            <form method="GET" action="">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Tahun:</label>
                                    <select name="year" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Pilih Tahun" data-allow-clear="true" data-hide-search="true">
                                        <option value="all">Pilih Semua</option>
                                        @for($i = date('Y'); $i > date('Y')-3; $i--)
                                            <option value="{{ $i }}" {!! ($year==$i) ? 'selected' : '' !!}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true">Batal</button>
                                    <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </form>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Menu 1-->
                    <!--end::Filter-->
                    <!--begin::Add user-->
                    <a href="{{ route('pph21.a1.form') }}" class="btn btn-primary"><i class="ki-outline ki-plus fs-2"></i>Tambah</a>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed gy-5" id="tbl_gaji">
                <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-25px">#</th>
                    <th>Nama</th>
                    <th>No Bupot</th>
                    <th>Kode Objek Pajak</th>
                    <th>Penghasilan</th>
                    <th>PPh</th>
                    <th class="w-150px">Masa</th>
                    <th class="w-100px">Aksi</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                <?php $no=1;?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->no }}</td>
                        <td>{{ $item->status }}</td>
                        <td>@money($item->bruto)</td>
                        <td>@money($item->terutang-$item->previous)</td>
                        <td>{!! ($item->year==$item->end_year) ? $item->period.'-'.$item->end_period.'/'.$item->year : $item->period.'/'.$item->year.'-'.$item->end_period.'/'.$item->end_year !!}</td>
                        <td>
                            <a href="{{ route('pph21.bupot.cetak', ['id'=>$item->id, 'year'=> $item->end_year]) }}" target="blank" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Bupot">
                                <i class="fa fa-print text-primary"></i>
                            </a>
                            <a href="{{ route('pph21.a1.form', ['id'=>$item->id]) }}" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bupot">
                                <i class="fa fa-pencil text-success"></i>
                            </a>
                            <a href="{{ route('pph21.bupot.destroy', ['id'=>$item->id, 'type'=>'pegawai']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus Bupot Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Bupot">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection
@section('js')

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>

    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection
