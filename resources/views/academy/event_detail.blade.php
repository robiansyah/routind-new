@extends('layouts.academy')
@section('title', $event->title)
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
        <!--begin::Toolbar container-->
        <div class="d-flex flex-stack flex-row-fluid">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-column flex-row-fluid">
                <!--begin::Toolbar wrapper-->
                <!--begin::Page title-->
                <div class="page-title d-flex align-items-center me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-lg-2x gap-2">
                        <span>Course Detail</span>
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                        <a href="{{ route('academy') }}" class="text-white text-hover-primary">
                            <i class="ki-outline ki-home text-gray-700 fs-6"></i>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">Academy</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">Courses</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">{{ $event->title }}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid pt-0">
        <!--begin::About card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <!--begin::About-->
                <div class="mb-18">
                    <!--begin::Wrapper-->
                    <div class="mb-10">
                        <!--begin::Top-->
                        <div class="text-center mb-15">
                            <!--begin::Title-->
                            <h3 class="fs-2hx text-dark mb-5">{{ $event->title }}</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Top-->
                        <!--begin::Overlay-->
                        <div class="overlay">
                            <!--begin::Image-->
                            <img class="w-100 card-rounded" src="{{ url('img/'.$event->image) }}" alt="" />
                            <!--end::Image-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Description-->
                    <div class="fs-5 fw-semibold text-gray-600">
                        <!--<h3 class="fs-1 text-dark mb-5">Deskripsi</h3>-->
                        <!--begin::Text-->
                        <span class="mb-8">
                            {!! $event->description !!}
                        </span>
                        <br>
                        <h3 class="fs-1 text-dark mb-5">Waktu & Lokasi</h3>
                        <p class="mb-8">
                            {{ Carbon\Carbon::parse($event->start_date)->isoFormat('DD MMMM YYYY').' - '.Carbon\Carbon::parse($event->end_date)->isoFormat('DD MMMM YYYY') }} <br>
                            {{ $event->location }}
                        </p>
                        <!--end::Text-->
                        @php($min = date("Y-m-d", strtotime($event->start_date." -".$event->registration." days")))
                        @if(date("Y-m-d") <= $min)
                        <a href="{{ route('event.checkout', ['slug'=>$event->slug]) }}" class="btn btn-primary">Checkout</a>
                        @endif
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::About-->
                <div class="separator separator-dashed mb-5"></div>
                <!--begin::Section-->
                <div class="mb-16">
                    <!--begin::Top-->
                    <div class="text-center mb-12">
                        <!--begin::Title-->
                        <h3 class="fs-2qx text-dark mb-5">Upcoming Courses</h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Top-->
                    <!--begin::Row-->
                    <div class="row g-10">
                        @foreach($last as $item)
                        <!--begin::Col-->
                        <div class="col-md-4">
                            <!--begin::Publications post-->
                            <div class="card-xl-stretch me-md-6">
                                <!--begin::Overlay-->
                                <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales" href="{{ url('/img/'.$item->image) }}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url({{ url('/img/'.$item->image) }})"></div>
                                    <!--end::Image-->
                                    <!--begin::Action-->
                                    <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                        <i class="ki-outline ki-eye fs-2x text-white"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                                <!--end::Overlay-->
                                <!--begin::Body-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <a href="{{ route('event.show', ['slug' => $item->slug]) }}" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base text-center">{{ $item->title }}</a>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3 mb-5">{!! \Illuminate\Support\Str::words(strip_tags($item->description), 20, '...') !!}</div>
                                    <!--end::Text-->
                                    <!--begin::Content-->
                                    <div class="fs-6 fw-bold">
                                        <!--begin::Author-->
                                        <a href="javascript:void(0)" class="text-gray-700 text-hover-primary">{{ $item->location }}</a>
                                        <!--end::Author-->
                                        <!--begin::Date-->
                                        <span class="text-muted">on {{ Carbon\Carbon::parse($item->start_date)->format('j M Y, g:i') }}</span>
                                        <!--end::Date-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Publications post-->
                        </div>
                        <!--end::Col-->
                        @endforeach
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Section-->
                <!--begin::Card-->
                <div class="card mb-4 bg-light text-center">
                    <!--begin::Body-->
                    <div class="card-body py-12">
                        <!--begin::Icon-->
                        <a href="#" class="mx-4">
                            <img src="/disc/assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="" />
                        </a>
                        <!--end::Icon-->
                        <!--begin::Icon-->
                        <a href="https://www.instagram.com/routind.academy_?igsh=MWNkbGhqcmptdXA4ZQ==" target="_blank" class="mx-4">
                            <img src="/disc/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="" />
                        </a>
                        <!--end::Icon-->
                        <!--begin::Icon-->
                        <a href="#" class="mx-4">
                            <img src="/disc/assets/media/svg/brand-logos/twitter.svg" class="h-30px my-2" alt="" />
                        </a>
                        <!--end::Icon-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::About card-->
    </div>
@endsection
@section('js')

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ url('/disc/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ url('demo37/assets/js/widgets.bundle.js') }}"></script>
    <!--end::Custom Javascript-->
@endsection