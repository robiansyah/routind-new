@extends('layouts.metronic')

@section('title', 'Pembelian')
@section('content')
    <div class="card" id="kt_pricing">
        <!--begin::Card body-->
        <div class="card-body p-lg-17">
            <!--begin::Plans-->
            <div class="d-flex flex-column">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <h1 class="fs-2hx fw-bold mb-5">Pilih Paket Anda</h1>

                    <div class="text-gray-600 fw-semibold fs-5">
                        Anda sekarang berada di paket Gratis.
                        <br>Silakan pilih paket dibawah ini untuk menikmati fitur-fitur spesial lainnya.
                    </div>
                </div>
                <!--end::Heading-->

                <!--begin::Row-->
                <div class="row g-10">
                    <!--begin::Col-->
                    <div class="col-xl-5 offset-md-1">
                        <div class="d-flex h-100 align-items-center">
                            <!--begin::Option-->
                            <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                <!--begin::Heading-->
                                <div class="mb-7 text-center">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-5 fw-bolder">Standar</h1>
                                    <!--end::Title-->

                                    <!--begin::Description-->
                                    <div class="text-gray-600 fw-semibold mb-5">
                                        Cocok untuk pembelajaran<br>Wajib Pajak Orang Pribadi
                                    </div>
                                    <!--end::Description-->

                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="text-gray fs-6"><del>Rp150.000</del></span><br>
                                        <span class="fs-2x fw-bold text-primary"> Rp25.0000 </span>
                                    </div>
                                    <!--end::Price-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Features-->
                                <div class="w-100 mb-10">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                        e-Filling Area
                                    </span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                        e-Billing Area
                                    </span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">
                                        e-Faktur Area
                                    </span>
                                        <i class="ki-duotone ki-cross-circle fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">
                                        e-SPT PPh 21
                                    </span>
                                        <i class="ki-duotone ki-cross-circle fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">
                                        e-Bupot Area
                                    </span>
                                        <i class="ki-duotone ki-cross-circle fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">
                                        e-Form Area
                                    </span>
                                        <i class="ki-duotone ki-cross-circle fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Features-->

                                <!--begin::Select-->
                                <a href="{{ route('pelajar.paket.checkout', ['type'=>'standar']) }}" class="btn btn-sm btn-primary">Beli Sekarang</a>
                                <!--end::Select-->
                            </div>
                            <!--end::Option-->
                        </div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-5">
                        <div class="d-flex h-100 align-items-center">
                            <!--begin::Option-->
                            <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-20 px-10">
                                <!--begin::Heading-->
                                <div class="mb-7 text-center">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-5 fw-bolder">Premium</h1>
                                    <!--end::Title-->

                                    <!--begin::Description-->
                                    <div class="text-gray-600 fw-semibold mb-5">
                                        Cocok untuk pembelajaran<br>Wajib Pajak Orang Pribadi dan Badan
                                    </div>
                                    <!--end::Description-->

                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="text-gray fs-6"><del>Rp250.000</del></span><br>
                                        <span class="fs-2x fw-bold text-primary"> Rp75.0000 </span>
                                    </div>
                                    <!--end::Price-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Features-->
                                <div class="w-100 mb-10">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                        e-Filling Area
                                    </span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                        e-Billing Area
                                    </span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                        e-Faktur Area
                                    </span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                        e-SPT PPh 21
                                    </span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                        e-Bupot Area
                                    </span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                        e-Form Area
                                    </span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Features-->

                                <!--begin::Select-->
                                <a href="{{ route('pelajar.paket.checkout', ['type'=>'premium']) }}" class="btn btn-sm btn-primary">Beli Sekarang</a>
                                <!--end::Select-->
                            </div>
                            <!--end::Option-->
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Plans-->
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