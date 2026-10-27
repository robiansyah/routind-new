@extends('layouts.metronic')

@section('title', 'Pembelian')
@section('content')
<div class="card" id="kt_pricing">     
    <!--begin::Card body-->
    <div class="card-body p-lg-17">
        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-10" role="tablist">
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#mandiri" aria-selected="true" role="tab">
                    Paket Mandiri</a>
            </li>
            <!--end:::Tab item-->
        </ul>
        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade active show" id="mandiri" role="tabpanel">
            <!--begin::Plans-->
                <div class="d-flex flex-column">
                    <!--begin::Row-->
                    <div class="row g-10 justify-content-md-center">
                        <div class="col-xl-12">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-20 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-dark mb-5 fw-bolder">Premium</h1>
                                        <div class="text-gray-600 fw-semibold mb-5">
                                            <a href="https://wa.me/6285947517463?text=Halo%20Admin%2C%20saya%20tertarik%20untuk%20membeli%20Paket%20Simulator%20Premium%20untuk%206%20bulan.%20Mohon%20informasi%20mengenai%20prosedur%20pembayaran%20dan%20aktivasi%20akunnya.%20Terima%20kasih" target="_blank">Hubungi Admin Sekarang, Amankan Paket Anda</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin::Col-->
{{--                        <div class="col-xl-5">--}}
{{--                            <div class="d-flex h-100 align-items-center">--}}
{{--                                <!--begin::Option-->--}}
{{--                                <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-20 px-10">--}}
{{--                                    <!--begin::Heading-->--}}
{{--                                    <div class="mb-7 text-center">--}}
{{--                                        <!--begin::Title-->--}}
{{--                                        <h1 class="text-dark mb-5 fw-bolder">Premium</h1>--}}
{{--                                        <!--end::Title-->--}}

{{--                                        <!--begin::Description-->--}}
{{--                                        <div class="text-gray-600 fw-semibold mb-5">--}}
{{--                                            Cocok untuk pembelajaran<br>Wajib Pajak Orang Pribadi dan Badan dalam waktu singkat selama 1 bulan--}}
{{--                                        </div>--}}
{{--                                        <!--end::Description-->--}}

{{--                                        <!--begin::Price-->--}}
{{--                                        <div class="text-center">--}}
{{--                                            <span class="text-gray fs-6"><del>Rp250.000</del></span><br>--}}
{{--                                            <span class="fs-2x fw-bold text-primary"> Rp50.000 </span>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Price-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Heading-->--}}
{{--                                    <!--begin::Features-->--}}
{{--                                    <div class="w-100 mb-10">--}}
{{--                                        <!--begin::Item-->--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Filling Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Billing Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Faktur Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-SPT PPh 21--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Bupot Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Form Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                Masa Aktif 1 Bulan (30 hari)--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Item-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Features-->--}}

{{--                                    <!--begin::Select-->--}}
{{--                                    <a href="{{ route('pelajar.paket.checkout', ['type'=>'premium']) }}" class="btn btn-primary">Beli Sekarang</a>--}}
{{--                                    <!--end::Select-->--}}
{{--                                </div>--}}
{{--                                <!--end::Option-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Col-->--}}
{{--                        <!--begin::Col-->--}}
{{--                        <div class="col-xl-5">--}}
{{--                            <div class="d-flex h-100 align-items-center">--}}
{{--                                <!--begin::Option-->--}}
{{--                                <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-20 px-10">--}}
{{--                                    <!--begin::Heading-->--}}
{{--                                    <div class="mb-7 text-center">--}}
{{--                                        <!--begin::Title-->--}}
{{--                                        <h1 class="text-dark mb-5 fw-bolder">Platinum</h1>--}}
{{--                                        <!--end::Title-->--}}

{{--                                        <!--begin::Description-->--}}
{{--                                        <div class="text-gray-600 fw-semibold mb-5">--}}
{{--                                            Cocok untuk pembelajaran<br>Wajib Pajak Orang Pribadi dan Badan secara intensif selama 6 bulan--}}
{{--                                        </div>--}}
{{--                                        <!--end::Description-->--}}

{{--                                        <!--begin::Price-->--}}
{{--                                        <div class="text-center">--}}
{{--                                            <span class="text-gray fs-6"><del>Rp500.000</del></span><br>--}}
{{--                                            <span class="fs-2x fw-bold text-primary"> Rp75.000 </span>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Price-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Heading-->--}}
{{--                                    <!--begin::Features-->--}}
{{--                                    <div class="w-100 mb-10">--}}
{{--                                        <!--begin::Item-->--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Filling Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Billing Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Faktur Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-SPT PPh 21--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Bupot Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                e-Form Area--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex align-items-center mb-5">--}}
{{--                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">--}}
{{--                                                Masa Aktif 6 Bulan (180 hari)--}}
{{--                                            </span>--}}
{{--                                            <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Item-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Features-->--}}

{{--                                    <!--begin::Select-->--}}
{{--                                    <a href="{{ route('pelajar.paket.checkout', ['type'=>'platinum']) }}" class="btn btn-primary">Beli Sekarang</a>--}}
{{--                                    <!--end::Select-->--}}
{{--                                </div>--}}
{{--                                <!--end::Option-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Plans-->
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showMessage("", "{!! Session::get('alert-' . $msg) !!}", "{!! $msg !!}", 'Ok, got it!');
            </script>
        @endif
    @endforeach
@endsection