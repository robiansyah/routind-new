@extends('layouts.academy')
@section('title', $event->title)
@section('image', url('img/'.$event->image))
@section('css')
    <style>
        html {
            scroll-behavior: smooth;
        }

        #about, #earn, #career, #benefit, #curriculum {
            scroll-margin-top: 200px;
        }
    </style>
@endsection
@section('content')
<div class="row g-5 g-xl-10 mt-1 mb-xl-0">
    <!--begin::Col-->
    <div class="col-md-5 mb-xl-10">
        <!--begin::Image-->
        <img class="w-100 w-xl-475px card-rounded object-fit-cover" src="{{ url('img/'.$event->image) }}" alt="" />
        <!--end::Image-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-md-7 mb-xl-10">
        <h1 class="fw-bolder fs-2hx mb-5 text-dark text-uppercase">{{ $event->title }}</h1>
        @if(count($last))
        <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
            @foreach($last as $item)
            @if(date("Y-m-d") <= $item->registration)
            <div class="col-12 col-md-4 mb-xl-5">
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column">
                            <span class="fw-bold fs-3 text-primary">{{ $item->name }}</span>
                            <span class="fw-bold fs-4 text-dark">
                                @if($item->price > 0)
                                Rp @money($item->price)
                                @else
                                Gratis
                                @endif
                            </span>
                            <span class="fw-bold fs-8 text-gray-500">{{ Carbon\Carbon::parse($item->start_date)->isoFormat('DD MMM YYYY')." - ".Carbon\Carbon::parse($item->end_date)->isoFormat('DD MMM YYYY') }}</span>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target" class="btn btn-warning mb-xl-0 mb-5">Daftar Sekarang</a>
        @endif
    </div>
    <!--end::Col-->
</div>
<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-lg-350px w-xl-400px mb-10 me-lg-10 order-lg-1 d-none d-lg-block">
        <!--begin::Card-->
        <div class="card card-flush pt-3 mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '400px'}" data-kt-sticky-width="{lg: '350px', xl: '400px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95" style="">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Detail</h2>
                </div>
                <!--end::Card title-->
                <div class="menu menu-column menu-rounded menu-sub-indention menu-active-bg fw-semibold my-auto" id="#kt_aside_menu" data-kt-menu="true">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a href="#about" class="menu-link text-gray-700 py-1">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-right fs-2"></i>
                            </span>
                            <span class="menu-title fs-5">Tentang</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a href="#career" class="menu-link text-gray-700 py-1">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-right fs-2"></i>
                            </span>
                            <span class="menu-title fs-5">Prospek Karir</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a href="#earn" class="menu-link text-gray-700 py-1">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-right fs-2"></i>
                            </span>
                            <span class="menu-title fs-5">Yang Bisa Kamu Dapatkan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a href="#benefit" class="menu-link text-gray-700 py-1">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-right fs-2"></i>
                            </span>
                            <span class="menu-title fs-5">Benefit</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a href="#curriculum" class="menu-link text-gray-700 py-1">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-right fs-2"></i>
                            </span>
                            <span class="menu-title fs-5">Kurikulum & Silabus</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 fs-6">
                @if(count($last))
                <!--begin::Seperator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Seperator-->
                <!--begin::Actions-->
                <div class="mb-0">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target" class="btn btn-warning">Daftar Sekarang</a>
                </div>
                <!--end::Actions-->
                @endif
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div class="flex-lg-row-fluid w-100 w-lg-350px w-xl-400px order-2 order-lg-2 mb-10 mb-lg-0">
        <div class="card">
            <!--begin::Body-->
            <div class="card-body px-lg-12 py-lg-7">
                <!--begin::About-->
                <div class="mb-10">
                    <!--begin::Description-->
                    <div class="fs-5 fw-semibold text-gray-600">
                        <span class="mb-8">
                            @if($event->about != null)
                                <h3 class="fs-2x text-dark mb-5">Tentang Program</h3>
                                <span id="about">{!! $event->about !!}</span>
                            @else
                            {!! $event->description !!}
                            @endif
                            @if($event->career != null)
                                <h3 class="fs-2x text-dark mb-5">Prospek Karir</h3>
                                <span id="career">{!! $event->career !!}</span>
                            @endif

                            @if($event->earn != null)
                                <h3 class="fs-2x text-dark mb-5">Yang Bisa Kamu Dapatkan</h3>
                                <span id="earn">{!! $event->earn !!}</span>
                            @endif

                            @if($event->benefit != null)
                                <h3 class="fs-2x text-dark mb-5">Benefit</h3>
                                <span id="benefit">{!! $event->benefit !!}</span>
                            @endif

                            @if($event->curriculum != null)
                                <h3 class="fs-2x text-dark mb-5">Kurikulum dan Silabus</h3>
                                <span id="curriculum">{!! $event->curriculum !!}</span>
                            @endif
                        </span>
                        <br>
                        @if(count($last))
                            <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target" class="btn btn-warning">Daftar Sekarang</a>
                        @endif
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::About-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::About card-->
    </div>
    <!--end::Content-->
{{--    <div class="d-lg-none d-lg-block card-body bg-white fixed-bottom p-5">--}}
{{--        <div class="mt-0 mb-0 row">--}}
{{--            <div class="ml-0 pl-0">--}}
{{--                <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target" class="btn btn-warning" style="display: block">Daftar Sekarang</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
@section('modal')
    <!--begin::Modal - New Target-->
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" action="{{ route('event.payment') }}" method="POST">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Pendaftaran {{ $event->title }}</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Pilih Batch</span>
                            </label>
                            <!--end::Label-->
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih Bacth" name="batch" required>
                                <option value="">Pilih Batch</option>
                                @foreach($last as $item)
                                    @if(date("Y-m-d") <= $item->registration)
                                        <option value="{{ $item->id }}">{!! $item->name.", Rp ".number_format($item->price, 0, ',', '.')." (".Carbon\Carbon::parse($item->start_date)->isoFormat('DD MMM YYYY')." - ".Carbon\Carbon::parse($item->end_date)->isoFormat('DD MMM YYYY').")"  !!}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Lanjut Pendaftaran</span>
                                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target-->
@endsection

@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/academyevent.js') }}"></script>
@endsection