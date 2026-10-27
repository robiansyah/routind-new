@extends('layouts.academy')
@section('title', 'Home')
@section('image', url('img/1735398328.jpg'))
@section('content')
    <div class="tns" style="direction: ltr">
        <div data-tns="true" data-tns-nav-position="bottom" data-tns-mouse-drag="true" data-tns-controls="false">
            @foreach(\App\Models\Header::orderBy('created_at', 'desc')->limit(5)->get() as $item)
                <!--begin::Item-->
                <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                    <a href="{{ $item->link }}">
                        <img src="{{ url('img/'.$item->image) }}" class="card-rounded shadow mw-100" alt="{{ $item->name }}" loading="lazy"/>
                    </a>
                </div>
                <!--end::Item-->
            @endforeach
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid pt-0">
        <!--begin::About card-->
        <!--begin::Body-->
        <div class="card-body p-lg-17">
            <!--begin::Section-->
            <div class="mb-16">
                <!--begin::Top-->
                <div class="text-center mb-12">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-dark mb-5">Upcoming Events</h3>
                    <!--end::Title-->
                </div>
                <!--end::Top-->
                <!--begin::Row-->
                <div class="row g-10">
                    @foreach($last as $item)
                    <!--begin::Col-->
                    <div class="col-md-3">
                        <!--begin::Publications post-->
                        <div class="card-xl-stretch me-md-6">
                            <!--begin::Overlay-->
                            <a class="d-block overlay mb-4" href="{{ route('event.show', ['slug' => $item->slug]) }}">
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
                                <a href="{{ route('event.show', ['slug' => $item->slug]) }}" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base text-center">{{ \Illuminate\Support\Str::of($item->title)->limit(40) }}</a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3 mb-5">{!! \Illuminate\Support\Str::of(strip_tags($item->description))->limit(80) !!}</div>
                                <!--end::Text-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <a href="javascript:void(0)" class="text-gray-700 text-hover-primary">{{ $item->location }}</a>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">on
                                        @if($item->batch)
                                            {{ Carbon\Carbon::parse($item->batch->start_date)->isoFormat('D MMM YYYY') }}
                                        @elseif($item->batch2)
                                            {{ Carbon\Carbon::parse($item->batch2->start_date)->isoFormat('D MMM YYYY') }}
                                        @else
                                            {{ Carbon\Carbon::parse($item->start_date)->isoFormat('D MMM YYYY') }}
                                        @endif
                                    </span>
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
        </div>
        <!--end::About card-->
        <div class="mb-15 position-relative z-index-2">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card mb-4" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
                    <!--begin::Card body-->
                    <div class="card-body p-lg-20">
                        <!--begin::Heading-->
                        <div class="text-center mb-5 mb-lg-10">
                            <!--begin::Title-->
                            <h3 class="fs-2hx text-dark mb-5" id="portfolio" data-kt-scroll-offset="{default: 100, lg: 250}">Gallery</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Tabs wrapper-->
                        <div class="d-flex flex-center mb-5 mb-lg-15">
                            <!--begin::Tabs-->
                            <ul class="nav border-transparent flex-center fs-5 fw-bold">
                                <li class="nav-item">
                                    <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6 active" href="#" data-bs-toggle="tab" data-bs-target="#kt_landing_projects_latest">University</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#" data-bs-toggle="tab" data-bs-target="#kt_landing_projects_web_design">Brevet A&B</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#" data-bs-toggle="tab" data-bs-target="#kt_landing_projects_mobile_apps">Short Course</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#" data-bs-toggle="tab" data-bs-target="#kt_landing_projects_development">Bootcamp</a>
                                </li>
                            </ul>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Tabs wrapper-->
                        <!--begin::Tabs content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_landing_projects_latest">
                                @php
                                $university = \App\Models\Gallery::where('type', 'university')->orderBy('created_at', 'asc')->limit(4)->get();
                                $brevet = \App\Models\Gallery::where('type', 'brevet')->orderBy('created_at', 'asc')->limit(4)->get();
                                $short = \App\Models\Gallery::where('type', 'short course')->orderBy('created_at', 'asc')->limit(4)->get();
                                $bootcamp = \App\Models\Gallery::where('type', 'bootcamp')->orderBy('created_at', 'asc')->limit(4)->get();
                                @endphp
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="galleries/{{ $university[0]->image }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('galleries/{{ $university[0]->image }}')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-outline ki-eye fs-3x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Row-->
                                        <div class="row g-10 mb-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $university[1]->image }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $university[1]->image }}')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-outline ki-eye fs-3x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $university[2]->image }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $university[2]->image }}')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-outline ki-eye fs-3x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $university[3]->image }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $university[3]->image }}')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-outline ki-eye fs-3x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_landing_projects_web_design">
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="galleries/{{ $brevet[0]->image }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('galleries/{{ $brevet[0]->image }}')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-outline ki-eye fs-3x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Row-->
                                        <div class="row g-10 mb-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $brevet[1]->image }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $brevet[1]->image }}')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-outline ki-eye fs-3x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $brevet[2]->image }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $brevet[2]->image }}')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-outline ki-eye fs-3x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $brevet[3]->image }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $brevet[3]->image }}')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-outline ki-eye fs-3x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_landing_projects_mobile_apps">
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Row-->
                                        <div class="row g-10 mb-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $short[3]->image }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $short[3]->image }}')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-outline ki-eye fs-3x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $short[2]->image }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $short[2]->image }}')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-outline ki-eye fs-3x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $short[1]->image }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $short[1]->image }}')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-outline ki-eye fs-3x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="galleries/{{ $short[0]->image }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('galleries/{{ $short[0]->image }}')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-outline ki-eye fs-3x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_landing_projects_development">
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="galleries/{{ $bootcamp[0]->image }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('galleries/{{ $bootcamp[0]->image }}')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-outline ki-eye fs-3x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Row-->
                                        <div class="row g-10 mb-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $bootcamp[1]->image }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $bootcamp[1]->image }}')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-outline ki-eye fs-3x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $bootcamp[2]->image }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $bootcamp[2]->image }}')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-outline ki-eye fs-3x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="galleries/{{ $bootcamp[3]->image }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('galleries/{{ $bootcamp[3]->image }}')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-outline ki-eye fs-3x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tabs content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card-body p-lg-17">
                    <!--begin::Section-->
                    <div class="mb-16">
                        <!--begin::Top-->
                        <div class="text-center mb-12">
                            <!--begin::Title-->
                            <h3 class="fs-2hx text-dark mb-5">Frequesntly Asked Questions</h3>
                            <!--end::Title-->
                        </div>

                        @foreach($faq as $item)
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_{{ $item->id }}">
                                    <!--begin::Icon-->
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <i class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">{{ $item->title }}</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="kt_job_{{ $item->id }}" class="collapse fs-6 ms-1">
                                    <!--begin::Text-->
                                    <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">{!! $item->description !!}</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Section-->
                        @endforeach
                    </div>
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card mb-4 bg-light text-center">
                    <!--begin::Body-->
                    <div class="card-body py-12">
                        <!--begin::Icon-->
                        <a href="https://www.youtube.com/@Routind" target="_blank" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/youtube-play.svg" class="h-30px my-2" loading="lazy">
                        </a>
                        <!--end::Icon-->
                        <!--begin::Icon-->
                        <a href="https://www.instagram.com/routind.academy" target="_blank" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" loading="lazy">
                        </a>
                        <!--end::Icon-->
                        <!--begin::Icon-->
                        <a href="https://x.com/@routind_academy" target="_blank" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/twitter.svg" class="h-30px my-2" loading="lazy">
                        </a>
                        <!--end::Icon-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Projects Section-->
    </div>
@endsection
@section('js')

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ url('disc/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ url('demo37/assets/js/widgets.bundle.js') }}"></script>
    <!--end::Custom Javascript-->
@endsection