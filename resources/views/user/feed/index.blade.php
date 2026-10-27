@extends('layouts.metronic')

@section('title', 'Feed')
@section('css')
    <style type="text/css">
        .read-more-show{
            cursor:pointer;
            color: #ed8323;
        }
        .read-more-hide{
            cursor:pointer;
            color: #ed8323;
        }

        .hide_content{
            display: none;
        }
    </style>
@endsection
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
                                <a class="nav-link text-muted text-active-primary ms-0 py-0 me-10 ps-9 border-0 active" href="{{ route('ruang.kelas', ['code'=>$kelas->code]) }}">
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
                                <a class="nav-link text-muted text-active-primary ms-0 py-0 me-10 ps-9 border-0" href="{{ route('ruang.kelas.achievement', ['code'=>$kelas->code]) }}">
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
                @if(count($questions))
                    @foreach($questions as $item)
                        @if(substr($item->start_date, 0, 10) <= date('Y-m-d') && $item->status=='Show')
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
                                        <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fs-4 fw-bold">{{ $item->type.' - '.$item->description }}</a>
                                        <!--end::Name-->
                                        <!--begin::Date-->
                                        <span class="text-gray-400 fw-semibold d-block">{{ Carbon\Carbon::parse($item->start_date)->isoFormat('D MMM YYYY HH:mm').' -- '.Carbon\Carbon::parse($item->end_date)->isoFormat('D MMM YYYY HH:mm') }}</span>
                                        <!--end::Date-->
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
                                    @php
                                        $pieces = explode(" ", $item->question);
                                        $first_part = implode(" ", array_splice($pieces, 0, 20));
                                    @endphp
                                    @if(strlen($item->question) > 100)
                                        {!! \Illuminate\Support\Str::words(strip_tags($item->question), 20, ' <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>') !!}
                                        <span class="read-more-content"> {!! substr($item->question,strlen($first_part),strlen($item->question)) !!}
                                        <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                                    @else
                                        {!! $item->question !!}
                                    @endif
                                </div>
                                <!--end::Post content-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer pt-0">
                                <!--begin::Info-->
                                <div class="mb-6">
                                    <!--begin::Separator-->
                                    <div class="separator separator-solid"></div>
                                    <!--end::Separator-->
                                    <!--begin::Nav-->
                                    <ul class="nav py-3">
                                        <!--begin::Item-->
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-sm btn-color-gray-600 btn-active-color-primary btn-active-light-primary fw-bold px-4 me-1 collapsible" data-bs-toggle="collapse" href="#kt_social_feeds_comments_{{ $item->id }}">
                                                <i class="ki-outline ki-message-text-2 fs-2 me-1"></i>{{ $item->assesments_count }} Indikator Penilaian</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="nav-item">
                                            <a href="{{ route('ruang.kelas.leaderboard.show', ['code'=>$kelas->code, 'id'=>$item->id]) }}" class="nav-link btn btn-sm btn-color-gray-600 btn-active-color-primary fw-bold px-4 me-1">
                                                <i class="ki-outline ki-pencil fs-2 me-1"></i>{{ $item->spt_count }} Mengerjakan</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="nav-item">
                                            @php($not = true)
                                            @if(count($item->spt))
                                                @foreach($item->spt as $spt)
                                                    @if($spt->user_id == auth()->user()->id)
                                                        @php($not = false)
                                                        @php($nilai = $spt->nilai)
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if($not)
                                                @if(date('Y-m-d H:i:s') >= $item->start_date && date('Y-m-d H:i:s') <= $item->end_date)
                                                <button data-id="{{ $item->id }}" class="nav-link btn btn-sm btn-color-gray-600 btn-active-color-primary fw-bold px-4 tambah">
                                                    <i class="ki-outline ki-bookmark fs-2 me-1"></i>Submit</button>
                                                @endif
                                            @else
                                                <a href="javascript:void(0)" class="nav-link btn btn-sm btn-color-gray-600 btn-active-color-primary fw-bold px-4">
                                                    <i class="ki-outline ki-bookmark fs-2 me-1"></i>Nilai {!! (date('Y-m-d H:i:s') >= $item->end_date) ? $nilai : '***' !!}</a>
                                            @endif
                                        </li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Nav-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-solid mb-1"></div>
                                    <!--end::Separator-->
                                    <!--begin::Comments-->
                                    <div class="collapse" id="kt_social_feeds_comments_{{ $item->id }}">
                                        <ol class="mt-2">
                                            @if(count($item->assesments))
                                                @foreach($item->assesments as $assesment)
                                                    <li class="text-gray-800 fw-bold fs-6 mb-2">{{ $assesment->category->name }}</li>
                                                @endforeach
                                            @endif
                                        </ol>
                                    </div>
                                    <!--end::Collapse-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                        @endif
                    @endforeach
                @endif
            </div>
            <!--end::Posts-->
        </div>
        <!--end::More posts-->
    </div>
    <!--end::Content-->
    </div>
    <!--end::Social - Feeds-->
@endsection
@section('modal')

    <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form method="POST" action="#">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="modal-title">Submit</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body">
                        @csrf

                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Jenis SPT</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <select name="form_code" id="form_code" data-kt-select2="true" data-placeholder="Pilih Jenis SPT" class="form-select form-select-md" data-dropdown-parent="#tambah" required>
                                    <option value="">Pilih Jenis SPT</option>
                                    <option value="1770">1770</option>
                                    <option value="1770S">1770S</option>
                                    <option value="1770SS">1770SS</option>
                                    <option value="1771">1771</option>
                                    <option value="PPH21">PPH21</option>
                                    <option value="PPHUNI">PPH UNIFIKASI</option>
                                    <option value="PPN1111">PPN</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">SPT</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <select name="spt" id="spt" data-kt-select2="true" data-placeholder="Pilih SPT" class="form-control form-select form-select-md" data-dropdown-parent="#tambah" required>
                                    <option value="">Pilih Jenis SPT Terlebih Dahulu</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <input type="hidden" name="question_id" id="question_id">
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Modal footer-->
                </form>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showMessage("", "{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}", "Ok, got it!");
            </script>
        @endif
    @endforeach
    @if($errors->any())
        <script>
            common.showMessage("", "{!! implode('', $errors->all('<div>:message</div>')) !!}", "error", "Ok, got it!");
        </script>
    @endif
    <script type="text/javascript">
        // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
        $('.read-more-content').addClass('hide_content')
        $('.read-more-show, .read-more-hide').removeClass('hide_content')

        // Set up the toggle effect:
        $('.read-more-show').on('click', function(e) {
            $(this).next('.read-more-content').removeClass('hide_content');
            $(this).addClass('hide_content');
            e.preventDefault();
        });

        // Changes contributed by @diego-rzg
        $('.read-more-hide').on('click', function(e) {
            var p = $(this).parent('.read-more-content');
            p.addClass('hide_content');
            p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
            e.preventDefault();
        });

        $('#form_code').on('change', function () {
            $.ajax({
                url: '{{ route('ruang.kelas.list', ['code'=>$kelas->code, 'type'=>'spt']) }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "form_code": $(this).val()
                },
                success: function (response) {
                    $('#spt').empty();
                    $('#spt').append('<option value="">Pilih SPT</option>');
                    $.each(response, function (id, name) {
                        $('#spt').append(new Option(name, id))
                    });
                }
            })
        });

        $('.tambah').on('click', function(e) {
            e.preventDefault();
            $("#tambah").modal('show');
            var id = $(this).attr('data-id');
            $('#question_id').val(id);
        });
    </script>
@endsection