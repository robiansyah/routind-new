@extends('layouts.academy')
@section('title', 'Course')
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
                        <span>Courses</span>
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
                    @if(Request::segment(2)!='')
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700 text-uppercase">{{ Request::segment(2) }}</li>
                    <!--end::Item-->
                    @endif
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
            <!--begin::Courses-->
            @if(count($events))
            @foreach($events as $item)
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-3">
                <!--begin::Card-->
                <a href="{{ route('event.show', ['slug' => $item->slug]) }}" class="card border-hover-primary">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-9" style="min-height:220px; background-image: url('{{ url('img/'.$item->image) }}'); background-repeat: no-repeat; background-size: cover;">

                    </div>
                    <!--end:: Card header-->
                    <!--begin:: Card body-->
                    <div class="card-body p-7">
                        <!--begin::Name-->
                        <div class="fs-4 fw-bold text-dark mb-5">
                            {{ \Illuminate\Support\Str::of($item->title)->limit(40) }}
                        </div>
                        <!--end::Name-->
                        <!--begin::Description-->
                        {{-- <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7">Penjelasan Produk 1</p> --}}
                        <!--end::Description-->
                        <!--begin::Info-->
                        <div class="fs-6 text-gray-600"><i class="fas fa-calendar text-primary"></i>
                            @if($item->batch)
                                {{ Carbon\Carbon::parse($item->batch->start_date)->isoFormat('D MMM YYYY') }}
                            @elseif($item->batch2)
                                {{ Carbon\Carbon::parse($item->batch2->start_date)->isoFormat('D MMM YYYY') }}
                            @else
                                {{ Carbon\Carbon::parse($item->start_date)->isoFormat('D MMM YYYY') }}
                            @endif
                        </div>
                        <div class="fs-6 text-gray-600"><i class="fas fa-tag text-primary"></i>
                            @if($item->price > 0)
                                <span>Rp</span>@money($item->price)
                            @else
                                Gratis
                            @endif
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end:: Card body-->
                </a>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            @endforeach
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex flex-center flex-column py-9 px-5">
                            <a href="#" class="fs-4 text-gray-800 text-hover-primary text-center fw-bold mb-5">Course tidak ditemukan</a>
                        </div>
                    </div>
                </div>
            @endif
            <!--end::Courses-->
        </div>
    </div>
@endsection