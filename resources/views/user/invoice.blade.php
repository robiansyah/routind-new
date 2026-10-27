@extends('layouts.metronic')

@section('title', 'Transaksi')
@section('content')
<div class="card card-flush">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin:::Tabs-->
        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-10" role="tablist">
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#waiting" aria-selected="true" role="tab">
                <i class="ki-outline ki-shop fs-2 me-2"></i>Menunggu Pembayaran</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#failed" aria-selected="false" role="tab" tabindex="-1">
                <i class="ki-outline ki-shield-cross fs-2 me-2"></i>Pembayaran Batal</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#success" aria-selected="false" tabindex="-1" role="tab">
                <i class="ki-outline ki-shield-tick fs-2 me-2"></i>Pembayaran Berhasil</a>
            </li>
            <!--end:::Tab item-->
        </ul>
        <!--end:::Tabs-->
        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade active show" id="waiting" role="tabpanel">
                @foreach($purchase as $item)
                @if($item->status=='UNPAID')
                <div class="card rounded-3 border border-gray-400 mb-5">
                    <!--begin::Body-->
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{ url('disc/assets/media/paket/'.$item->paket.'.png') }}" class="w-175px rounded-3" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="badge badge-light-primary fs-6 fw-bold my-2">Menunggu Pembayaran</div>
                                <div class="fs-4 text-gray-800 text-hover-primary fw-bold text-capitalize">Paket {{ $item->paket }}</div>
                                <div class="text-gray-700 fw-semibold fs-5 my-1">Metode Pembayaran : <b>{{ $item->bank_name }}</b></div>
                                <div class="text-gray-700 fw-semibold fs-5">
                                    Batas Pembayaran : <b data-countdown="{!! ($item->bank_name=='QRIS (Customizable)') ? date("Y-m-d H:i:s", strtotime($item->created_at . "+1 hours")) : date("Y-m-d H:i:s", strtotime($item->created_at . "+1 day")) !!}"></b>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <span class="text-gray-700 fw-bolder fs-7">{{ $item->created_at->isoFormat('D MMM Y') }} | {{ $item->invoice_code }}</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                    <div class="card-footer py-3 px-3">
                        <div class="row">
                            <div class="col-lg-10">
                                <a href="{{ route('pelajar.invoice.detail', ['code'=>$item->invoice_code]) }}" class="btn btn-primary me-2 mb-2">Panduan Pembayaran</a>
                                <a href="{{ route('pelajar.invoice.cancel', ['code'=>$item->invoice_code]) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Membatalkan Paket Ini?')" type="button" class="btn btn-danger mb-2">Batalkan Pembelian</a>
                            </div>
                            <div class="col-lg-2">
                                <span class="text-gray-600 fw-bolder fs-6">Total Bayar</span>
                                <br><span class="text-gray-800 fw-bolder fs-6">Rp<span class="text-gray-800 fw-bolder fs-2">@money($item->amount)</span></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="failed" role="tabpanel">
                @foreach($purchase as $item)
                    @if($item->status=='FAILED')
                        <div class="card rounded-3 border border-gray-400 mb-5">
                            <!--begin::Body-->
                            <div class="card-body p-5">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ url('disc/assets/media/paket/'.$item->paket.'.png') }}" class="w-175px rounded-3" alt="">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="badge badge-light-danger fs-6 fw-bold my-2">Pembayaran Batal</div>
                                        <div class="fs-4 text-gray-800 text-hover-primary fw-bold text-capitalize">Paket {{ $item->paket }}</div>
                                        <div class="text-gray-700 fw-semibold fs-5 my-1">Metode Pembayaran : <b>{{ $item->bank_name }}</b></div>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="text-gray-700 fw-bolder fs-7">{{ $item->created_at->isoFormat('D MMM Y') }} | {{ $item->invoice_code }}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                            <div class="card-footer py-3 px-3">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <a href="{{ route('pelajar.paket.checkout', ['type'=>$item->paket]) }}" class="btn btn-primary me-2 mb-2">Beli Lagi</a>
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="text-gray-600 fw-bolder fs-6">Total Bayar</span>
                                        <br><span class="text-gray-800 fw-bolder fs-6">Rp<span class="text-gray-800 fw-bolder fs-2">@money($item->amount)</span></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="success" role="tabpanel">
                @foreach($purchase as $item)
                    @if($item->status=='PAID')
                        <div class="card rounded-3 border border-gray-400 mb-5">
                            <!--begin::Body-->
                            <div class="card-body p-5">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ url('disc/assets/media/paket/'.$item->paket.'.png') }}" class="w-175px rounded-3" alt="">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="badge badge-light-success fs-6 fw-bold my-2">Pembayaran Berhasil</div>
                                        <div class="fs-4 text-gray-800 text-hover-primary fw-bold text-capitalize">Paket {{ $item->paket }}</div>
                                        <div class="text-gray-700 fw-semibold fs-5 my-1">Metode Pembayaran : <b>{{ $item->bank_name }}</b></div>
                                        <div class="text-gray-700 fw-semibold fs-5 my-1">Tanggal Berakhir : <b>{{ date("d M Y", strtotime($item->updated_at." +6 months")) }}</b></div>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="text-gray-700 fw-bolder fs-7">{{ $item->created_at->isoFormat('D MMM Y') }} | {{ $item->invoice_code }}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                            <div class="card-footer py-3 px-3">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <a href="{{ route('pelajar.paket.checkout', ['type'=>$item->paket]) }}" class="btn btn-primary me-2 mb-2">Beli Lagi</a>
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="text-gray-600 fw-bolder fs-6">Total Bayar</span>
                                        <br><span class="text-gray-800 fw-bolder fs-6">Rp<span class="text-gray-800 fw-bolder fs-2">@money($item->amount)</span></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Card body-->
</div>
@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
<script>
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%H:%M:%S'));
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