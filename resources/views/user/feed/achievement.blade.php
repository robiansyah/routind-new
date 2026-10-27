@extends('layouts.metronic')

@section('title', 'Feed')
@section('content')
    <div class="d-flex flex-row">
        <!--begin::Start sidebar-->
        <div class="d-lg-flex flex-column flex-lg-row-auto w-lg-325px" data-kt-drawer="true" data-kt-drawer-name="start-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '250px': '300px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_social_start_sidebar_toggle">
            <!--begin::User menu-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body pt-15 px-0">
                    <!--begin::Member-->
                    <div class="d-flex flex-column text-center mb-9 px-9">
                        <!--begin::Photo-->
                        <div class="symbol symbol-80px symbol-lg-150px mb-4">
                            <img src="{{ url('disc/assets/media/stock/600x600/img-'.random_int(1, 86).'.jpg') }}" class="" alt="" />
                        </div>
                        <!--end::Photo-->
                        <!--begin::Info-->
                        <div class="text-center">
                            <!--begin::Name-->
                            <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-4">{{ $kelas->user->name }}</a>
                            <!--end::Name-->
                            <!--begin::Position-->
                            <span class="text-muted d-block fw-semibold">{{ $kelas->name }}</span>
                            <!--end::Position-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Member-->
                    <!--begin::Row-->
                    <div class="row px-9 mb-4 justify-content-center">
                        <!--begin::Col-->
                        <div class="col-4 text-center">
                            <div class="text-gray-800 fw-bold fs-3">
                                <span class="m-0" data-kt-countup="true" data-kt-countup-value="{{ $kelas->students_count }}">0</span>
                            </div>
                            <span class="text-gray-500 fs-8 d-block fw-bold">Pelajar</span>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-4 text-center">
                            <div class="text-gray-800 fw-bold fs-3">
                                <span class="m-0" data-kt-countup="true" data-kt-countup-value="{{ count($questions) }}">0</span></div>
                            <span class="text-gray-500 fs-8 d-block fw-bold">Feed</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Navbar-->
                    <div class="m-0">
                        <!--begin::Navs-->
                        <ul class="nav nav-pills nav-pills-custom flex-column border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-5">
                                <a class="nav-link text-muted text-active-primary ms-0 py-0 me-10 ps-9 border-0" href="{{ route('ruang.kelas', ['code'=>$kelas->code]) }}">
                                    <i class="ki-outline ki-row-horizontal fs-3 text-muted me-3"></i>Feeds
                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute start-0 top-0 w-3px h-100 bg-primary rounded-end"></span>
                                    <!--end::Bullet--></a>
                            </li>
                            <!--end::Nav item-->
                            <li class="nav-item mt-5">
                                <a class="nav-link text-muted text-active-primary ms-0 py-0 me-10 ps-9 border-0" href="{{ route('ruang.kelas.leaderboard', ['code'=>$kelas->code]) }}">
                                    <i class="ki-outline ki-chart-simple-2 fs-3 text-muted me-3"></i>Leaderboard
                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute start-0 top-0 w-3px h-100 bg-primary rounded-end"></span>
                                    <!--end::Bullet--></a>
                            </li>
                            <li class="nav-item mt-5">
                                <a class="nav-link text-muted text-active-primary ms-0 py-0 me-10 ps-9 border-0" href="{{ route('ruang.kelas.winner', ['code'=>$kelas->code]) }}">
                                    <i class="ki-outline ki-medal-star fs-3 text-muted me-3"></i>Champion
                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute start-0 top-0 w-3px h-100 bg-primary rounded-end"></span>
                                    <!--end::Bullet--></a>
                            </li>
                            <li class="nav-item mt-5">
                                <a class="nav-link text-muted text-active-primary ms-0 py-0 me-10 ps-9 border-0 active" href="{{ route('ruang.kelas.achievement', ['code'=>$kelas->code]) }}">
                                    <i class="ki-outline ki-profile-circle fs-3 text-muted me-3"></i>Achievement
                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute start-0 top-0 w-3px h-100 bg-primary rounded-end"></span>
                                    <!--end::Bullet--></a>
                            </li>
                            <li class="nav-item mt-5">
                                <a class="nav-link text-muted text-active-primary ms-0 py-0 me-10 ps-9 border-0" href="{{ route('ruang.kelas.material', ['code'=>$kelas->code]) }}">
                                    <i class="ki-outline ki-book-open fs-3 text-muted me-3"></i>Material
                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute start-0 top-0 w-3px h-100 bg-primary rounded-end"></span>
                                    <!--end::Bullet--></a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--begin::Navs-->
                    </div>
                    <!--end::Navbar-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::User menu-->
        </div>
        <!--end::Start sidebar-->
        <!--begin::Content-->
        <div class="w-100 flex-lg-row-fluid mx-lg-13">
            <!--begin::Mobile toolbar-->
            <div class="d-flex d-lg-none align-items-center justify-content-end mb-10">
                <div class="d-flex align-items-center gap-2">
                    <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_social_start_sidebar_toggle">
                        <i class="ki-outline ki-profile-circle fs-1"></i>
                    </div>
                </div>
            </div>
            <!--end::Mobile toolbar-->
            <!--begin::Posts-->
            <div class="mb-10" id="kt_social_feeds_posts">
                <!--begin::Card-->
                <div class="card card-flush mb-10">
                    <!--begin::Card header-->
                    <div class="card-header pt-9">
                        <!--begin::Author-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img src="{{ url('disc/assets/media/stock/600x600/img-'.random_int(1, 86).'.jpg') }}" class="" alt="" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Name-->
                                <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fs-4 fw-bold">Daftar Sertifikat</a>
                                <!--end::Name-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Author-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Post content-->
                        <div class="fs-6 fw-normal text-gray-700">
                            @if(count($sertifikat))
                                <table class="table table-row-dashed">
                                    <tr>
                                        <td>No</td>
                                        <td>Kode</td>
                                        <td>Jenis</td>
                                        <td>Aksi</td>
                                    </tr>
                                    @foreach($sertifikat as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if($item->participant_no=='')
                                                    <a href="{{ route('print.certificate', ['code'=>$item->code]) }}" target="_blank" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
                                                        <i class="fa fa-print text-primary"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('brevet.certificate', ['code'=>$item->code]) }}" target="_blank" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
                                                        <i class="fa fa-print text-primary"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <span>Tidak Ada</span>
                            @endif
                        </div>
                        <!--end::Post content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Posts-->
        </div>
        <!--end::More posts-->
    </div>
    <!--end::Content-->
    </div>
    <!--end::Social - Feeds-->
@endsection