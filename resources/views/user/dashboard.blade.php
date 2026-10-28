@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('content')
    @php
        $name = strtoupper(auth()->user()->name);
    @endphp
    <div class="tns" style="direction: ltr">
        <div data-tns="true" data-tns-nav-position="bottom" data-tns-mouse-drag="true" data-tns-controls="false">
            @foreach(\App\Models\Header::orderBy('created_at', 'desc')->limit(5)->get() as $item)
                <!--begin::Item-->
                <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                    <a href="{{ $item->link }}">
                        <img src="{{ url('img/'.$item->image) }}" class="card-rounded shadow mw-100" alt="{{ $item->name }}" />
                    </a>
                </div>
                <!--end::Item-->
            @endforeach
        </div>
    </div>
    <div class="row g-5 g-xl-8 px-10">
        <div class="col-xl-4">
            <div class="card h-175px bgi-no-repeat bgi-size-contain card-xl-stretch mb-5 mb-xl-8" style="background-color: #78829d; background-position: right; background-image:url('/disc/assets/media/svg/misc/yellow-inn.png')">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-between">
                    <!--begin::Title-->
                    <h2 class="text-white fw-bold fs-1">Classic<br>Simulator</h2>
                    <!--end::Title-->
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="{{ route('pelajar.index') }}" target="_blank" class="btn btn-danger fw-semibold px-6 py-3">Launch</a>
                    </div>
                    <!--begin::Action-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        @if(Session::get('coretax') && auth()->user()->paket!=null && auth()->user()->end_date >= date('Y-m-d'))
        <div class="col-xl-4">
            <div class="card h-175px bgi-no-repeat bgi-size-contain card-xl-stretch mb-5 mb-xl-8" style="background-color: #0393a8; background-position: right; background-image:url('/disc/assets/media/svg/misc/putih-inn.png')">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-between">
                    <!--begin::Title-->
                    <h2 class="text-white fw-bold fs-1">Pro<br>Simulator</h2>
                    <!--end::Title-->
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="{{ Session::get('coretax_url')}}" target="_blank" class="btn btn-danger fw-semibold px-6 py-3">Launch</a>
                    </div>
                    <!--begin::Action-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        @endif
        @if(Session::get('exam'))
        <div class="col-xl-4">
            <div class="card h-175px bgi-no-repeat bgi-size-contain card-xl-stretch mb-5 mb-xl-8" style="background-color: #1B283F; background-position: right; background-image:url('/disc/assets/media/svg/misc/hijau-inn.png')">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-between">
                    <!--begin::Title-->
                    <h2 class="text-white fw-bold fs-1">Exam<br>Assessment</h2>
                    <!--end::Title-->
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="{{ Session::get('exam_url')}}" target="_blank" class="btn btn-danger fw-semibold px-6 py-3">Launch</a>
                    </div>
                    <!--begin::Action-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        @endif
        @if(Session::get('elearning'))
        <div class="col-xl-4">
            <div class="card h-175px bgi-no-repeat bgi-size-contain card-xl-stretch mb-5 mb-xl-8" style="background-color: #31316A; background-position: right; background-image:url('/disc/assets/media/svg/misc/hijau-inn.png')">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-between">
                    <!--begin::Title-->
                    <h2 class="text-white fw-bold fs-1">LMS<br>Modul &amp; Materi</h2>
                    <!--end::Title-->
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="{{ Session::get('elearning_url')}}" target="_blank" class="btn btn-danger fw-semibold px-6 py-3">Launch</a>
                    </div>
                    <!--begin::Action-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        @endif
    </div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showMessage("", "{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}", 'Ok, got it!');
            </script>
        @endif
    @endforeach
@endsection