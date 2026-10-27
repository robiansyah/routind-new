@extends('layouts.metronic')
@section('title', 'Detail Transaksi')
@section('content')
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-6 mb-5 mb-xl-10">
        <div class="card card-flush pt-3 mb-0">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Detail Transaksi</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0 fs-6">
                <!--begin::Section-->
                <div class="mb-3">
                    <!--begin::Details-->
                    <div class="d-flex flex-row mb-2">
                        <span class="fw-semibold text-gray-600 w-50">Order ID</span>
                        <span class="fw-semibold text-gray-600 w-50">Status Pembayaran</span>
                    </div>
                    <div class="d-flex flex-row mb-2">
                        <span class="fw-semibold text-gray-800 w-50">{{ $transaction->merchant_ref }}</span>
                        <span class="fw-semibold text-gray-800 w-50">
                            @if($transaction->status=='UNPAID')
                                <div class="badge badge-light-primary fs-6 fw-bold my-2">Menunggu Pembayaran</div>
                            @elseif($transaction->status=='PAID')
                                <div class="badge badge-light-success fs-6 fw-bold my-2">Pembayaran Berhasil</div>
                            @else
                                <div class="badge badge-light-danger fs-6 fw-bold my-2">Pembayaran Batal</div>
                            @endif
                        </span>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Section-->
                <!--begin::Seperator-->
                <div class="separator separator-dashed mb-5"></div>
                <!--end::Seperator-->
                <!--begin::Section-->
                <div class="mb-3">
                    <!--begin::Details-->
                    <div class="d-flex flex-row mb-2">
                        <span class="fw-semibold text-gray-600 w-50">Metode Pembayaran</span>
                        <span class="fw-semibold text-gray-600 w-50">{!! ($transaction->payment_method=='QRISC') ? 'QR Code' : 'Nomor' !!} Pembayaran</span>
                    </div>
                    <div class="d-flex flex-row mb-2">
                        <span class="fw-semibold text-gray-800 w-50">{{ $transaction->payment_name }}</span>
                        <span class="fw-semibold text-gray-800 w-50">
                            @if($transaction->payment_method=='QRISC' && $transaction->status=='UNPAID')
                                <img src="{{ $transaction->qr_url }}" class="w-150px">
                            @elseif($transaction->status=='UNPAID')
                                <span id="kt_clipboard_4" class="me-5">{{ $transaction->pay_code }}</span>
                                <button class="btn btn-icon btn-sm btn-light" data-clipboard-target="#kt_clipboard_4">
                                    <i class="ki-duotone ki-copy fs-2 text-muted"></i>
                                </button>
                            @endif
                        </span>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Section-->
                <!--begin::Seperator-->
                <div class="separator separator-dashed mb-3"></div>
                <!--end::Seperator-->
                <!--begin::Section-->
                <div class="mb-3">
                    <!--begin::Details-->
                    <div class="d-flex flex-row mb-2">
                        <span class="fw-semibold text-gray-600 w-50">Batas Pembayaran</span>
                        <span class="fw-semibold text-gray-600 w-50">Kode Promo</span>
                    </div>
                    <div class="d-flex flex-row mb-2">
                        <span class="fw-semibold text-gray-800 w-50" data-countdown="{!! ($purchase->bank_name=='QRIS (Customizable)') ? date("Y-m-d H:i:s", strtotime($purchase->created_at . "+1 hours")) : date("Y-m-d H:i:s", strtotime($purchase->created_at . "+1 day")) !!}"></span>
                        <span class="fw-semibold text-gray-800 w-50">{{ $purchase->discount_code }}</span>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Section-->
                <!--begin::Seperator-->
                <div class="separator separator-dashed mb-3"></div>
                <!--end::Seperator-->
                <!--begin::Details-->
                <div class="d-flex flex-row mb-2">
                    <span class="fw-semibold text-gray-400 me-2 w-50 text-capitalize">Paket {{ $purchase->paket }}</span>
                    <span class="fw-semibold text-gray-700 text-end w-50">Rp<span>@money($transaction->amount_received+$purchase->discount_amount)</span></span>
                </div>
                <div class="d-flex flex-row mb-2">
                    <span class="fw-semibold text-gray-400 me-2 w-50">Diskon</span>
                    <span class="fw-semibold text-gray-700 text-end w-50">Rp<span>@money($purchase->discount_amount)</span></span>
                </div>
                <div class="d-flex flex-row mb-2">
                    <span class="fw-semibold text-gray-400 me-2 w-50">Biaya Admin</span>
                    <span class="fw-semibold text-gray-700 text-end w-50">Rp<span>@money($transaction->total_fee)</span></span>
                </div>
                <div class="d-flex flex-row mb-2">
                    <span class="fw-semibold fs-4 text-gray-900 me-2 w-50">Total</span>
                    <span class="fw-semibold fs-4 text-gray-900 text-end w-50">Rp<span>@money($transaction->amount)</span></span>
                </div>
                <!--end::Details-->
            </div>
            <!--end::Card body-->
        </div>
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6 mb-5 mb-xl-10">
        <div class="card card-flush pt-3 mb-0">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Langkah Pembayaran</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0 fs-6">
                <!--begin::Accordion-->
                <div class="accordion accordion-icon-toggle" id="kt_accordion_1">
                @foreach($transaction->instructions as $item)
                <!--begin::Item-->
                <div class="mb-5">
                    <!--begin::Header-->
                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_item_{{ $loop->iteration }}">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">{{ $item->title }}</h3>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div id="kt_accordion_1_item_{{ $loop->iteration }}" class="fs-6 collapse {!! ($loop->iteration==1) ? 'show' : '' !!} ps-10" data-bs-parent="#kt_accordion_1">
                        <ol>
                            @foreach($item->steps as $step)
                                <li>{!! $step !!}</li>
                            @endforeach
                        </ol>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Item-->
                @endforeach
                </div>
                <!--end::Accordion-->
            </div>
            <!--end::Card body-->
        </div>
    </div>
    <!--end::Col-->
</div>
@endsection
@section('js')

    @if($transaction->payment_method!='QRISC')
    <script src="{{ url('disc/assets/js/custom/clipboard.js') }}"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%H:%M:%S'));
            });
        });
    </script>
@endsection