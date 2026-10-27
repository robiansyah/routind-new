@extends('layouts.qrcode')
@section('title', 'Informasi Dokumen')
@section('content')
    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <!--begin::Heading-->
            <div class="text-center mb-10">
                <!--begin::Title-->
                <h2 class="text-dark fw-bolder fs-1 mb-3">Informasi Dokumen</h2>
                <!--end::Title-->
            </div>
            <!--begin::Heading-->
            <table class="table">
                <tr>
                    <td>Dokumen</td>
                    <td>:</td>
                    <td>
                        Invoice
                    </td>
                </tr>
                <tr>
                    <td>Customer</td>
                    <td>:</td>
                    <td>
                        {!! $qrcode->name !!}
                    </td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>
                        {{ $qrcode->no }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>
                        {{ Carbon\Carbon::parse($qrcode->date)->isoFormat('D MMM YYYY') }}
                    </td>
                </tr>
                <tr>
                    <td>Sub Total</td>
                    <td>:</td>
                    <td>
                        Rp. @money($qrcode->price*$qrcode->qty),-
                    </td>
                </tr>
                @if($qrcode->type!='' && $qrcode->payment != '')
                    <tr>
                        <td>{{ $qrcode->type }}</td>
                        <td>:</td>
                        <td><b>Rp. @money($qrcode->payment),-</b></td>
                    </tr>
                @else
                    <tr>
                        <td><b>Total</b></td>
                        <td>:</td>
                        <td><b>Rp. @money(($qrcode->price*$qrcode->qty)-$qrcode->discount),-</b></td>
                    </tr>
                @endif
            </table>
        </div>
        <!--end::Wrapper-->
    </div>
@endsection
@section('js')

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ url('disc/assets/js/custom/authentication/sign-up/general.js') }}"></script>
    <!--end::Custom Javascript-->
@endsection

