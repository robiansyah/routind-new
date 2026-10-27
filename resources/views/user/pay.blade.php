@extends('layouts.metronic')

@section('title', 'Arsip Billing')
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
                    <span class="card-label fw-bold text-gray-800">Daftar Pembayaran</span>
                    {{-- <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span> --}}
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-2">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed gy-3" id="tbl_pembayaran">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-50px">No</th>
                            <th>Tahun / Masa Pajak</th>
                            <th>Jenis Pembayaran</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                    @if(count($pay))
                        <?php $no=1; ?>
                        @foreach ($pay as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->year.'/'.$item->end_period }}</td>
                            <td>{{ $item->type->name }}</td>
                            <td>@money($item->tax_value)</td>
                            <td>
                                <a href="{{ route('pelajar.billing.bayar', ['id'=>$item->id]) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Membayar Billing Ini?')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Bayar Billing">
                                    <i class="fa fa-money-bill text-primary"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
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
@section('js')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pph21/spt.js') }}"></script>

    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
    @if($errors->any())
        <script>
            common.showNotif("{!! implode('', $errors->all('<div>:message</div>')) !!}", "error");
        </script>
    @endif
@endsection