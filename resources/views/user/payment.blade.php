@extends('layouts.metronic')

@section('title', 'Pembayaran')
@section('css')

    <link href="https://static.pajak.go.id/assets/vendors/general/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://static.pajak.go.id/assets/vendors/general/animate.css/animate.min.css" rel="stylesheet" type="text/css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="card">
    <!--begin::Card header-->
    <div class="card-header pt-7 pb-2">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">Virtual Payment</span>
            {{-- <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span> --}}
        </h3>
        <!--end::Title-->
    </div>
    <!--end::Card header-->
    <div class="card-body">
        @if($type=='payment')
            <form class="kt-form" method="POST" action="{{ route('pelajar.billing.inquiry') }}">
                @csrf
                <div class="form-group row">
                    <label class="col-md-2">ID Billing</label>
                    <div class="col-md-10">
                        <input type="text" name="billing_id" class="form-control" placeholder="ID Billing" required>
                        <br>
                        <button type="submit" class="btn btn-primary" style="text-align: right; "><i class="fa fa-save"></i>
                            <span>Cek Billing</span>
                        </button>
                    </div>
                </div>
            </form>
        @elseif($type=='inquiry')
            @if($data)
                <table class="table">
                    <tr>
                        <td class="w-150px">Jenis Pajak</td>
                        <td class="w-10px">:</td>
                        <td>{{ $data->deposit->type->code.' - '.$data->deposit->type->name }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Setoran</td>
                        <td>:</td>
                        <td>{{ $data->deposit->code.' - '.$data->deposit->name }}</td>
                    </tr>
                    <tr>
                        <td>Masa Pajak</td>
                        <td>:</td>
                        <td>{{ $data->start_period.' - '.$data->end_period }}</td>
                    </tr>
                    <tr>
                        <td>Tahun Pajak</td>
                        <td>:</td>
                        <td>{{ $data->year }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Setoran</td>
                        <td>:</td>
                        <td>@money($data->amount)</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            @if($data->status=='not yet')
                                <form method="POST" action="{{ route('pelajar.billing.verify', ['id'=>$data->id]) }}">
                                    @csrf
                                    Belum Dibayar &nbsp;
                                    <button type="submit" class="btn btn-sm btn-primary" style="text-align: right; "><i class="fa fa-save"></i>
                                        <span>Lakukan Pembayaran</span>
                                    </button>
                                </form>
                            @else
                                Sudah Dibayar
                            @endif
                        </td>
                    </tr>
                    @if($data->status=='yes')
                    <tr>
                        <td>NTPN</td>
                        <td>:</td>
                        <td>
                            <span id="kt_clipboard_4" class="me-5">{{ $data->ntpn }}</span>
                            <button class="btn btn-icon btn-sm btn-light" data-clipboard-target="#kt_clipboard_4">
                                <i class="ki-duotone ki-copy fs-2 text-muted"></i>
                            </button>
                        </td>
                    </tr>
                    @endif

                </table>
            @else
                <div class="mb-5">ID Billing tidak ditemukan</div>
            @endif
            <a href="{{ route('pelajar.billing.payment') }}" class="btn btn-sm btn-primary" >
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        @endif
    </div>
</div>
@endsection
@section('js')
    @if($type=='inquiry')
    @if($data)
        @if($data->status=='yes')
    <script src="{{ url('disc/assets/js/custom/clipboard.js') }}"></script>
        @endif
    @endif
    @endif
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showMessage(
                    "Sukses",
                    "{!! Session::get('alert-' . $msg) !!}",
                    "success",
                    "Ok"
                );
            </script>
        @endif
    @endforeach
@endsection