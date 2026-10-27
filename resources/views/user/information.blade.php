@extends('layouts.metronic')

@section('title', 'Dashboard')
@section('content')

<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-6 mb-5 mb-xl-10">
        <!--begin::Chart widget 11-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">Dashboard</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Informasi Pengguna</span>
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            @php
                $name = (auth()->user()->wp_type==1) ? strtoupper(auth()->user()->name) : strtoupper(auth()->user()->profile->corporate_name);
                $ava = Avatar::create($name)->toBase64();
            @endphp
            <div class="card-body pb-0 pt-4">
                <div class="d-flex align-items-center mb-1">
                    <!--begin::Avatar-->
                    <div class="me-5 position-relative">
                        <!--begin::Image-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <img class="symbol-label fs-2x fw-semibold text-primary bg-light-primary" src="{{ $ava }}" />
                        </div>
                        <!--end::Image-->
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="fw-semibold">
                        <span class="fs-2 fw-bold d-block text-gray-800 me-5 mb-5 lh-1">{{ $name }}</span>
                    </div>
                    <!--end::Details-->
                </div>
                <!--begin::Description-->
                {{-- <span class="fs-6 fw-semibold text-gray-400">Anda merupakan Wajib Pajak yang telah terdaftar pada sistem Direktorat Jenderal Pajak.</span> --}}
                <!--end::Description-->
                <div class="py-5 fs-6">
                    <!--begin::Badge-->
                    <div class="badge badge-light-primary d-inline text-capitalize">{!! (auth()->user()->paket!=null && auth()->user()->end_date >= date('Y-m-d')) ? auth()->user()->paket.' User'.' [Masa Aktif : '.(Carbon\Carbon::now()->diffInDays(auth()->user()->end_date, false)+1).' Hari]' : 'Free User' !!}</div>
                    <!--begin::Badge-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">NPWP</div>
                    <div class="text-gray-600">{!! (auth()->user()->wp_type==1) ? auth()->user()->username : auth()->user()->npwp !!}</div>
                    <!--begin::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Email</div>
                    <div class="text-gray-600">
                        <a href="#" class="text-gray-600 text-hover-primary">{{ auth()->user()->email }}</a>
                    </div>
                    <!--begin::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">No HP</div>
                    <div class="text-gray-600">{{ auth()->user()->mobile_phone }}</div>
                    <!--begin::Details item-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Chart widget 11-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6 mb-5 mb-xl-10">
        <!--begin::Engage widget 8-->
        <div class="card border-0 h-md-100 bg-primary" data-bs-theme="light">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Row-->
                <div class="row align-items-center h-100">
                    <!--begin::Col-->
                    <div class="col-7 ps-xl-8">
                        <!--begin::Title-->
                        <div class="text-white mb-6 pt-6">
                            <span class="fs-4 fw-semibold me-2 d-block lh-1 pb-2 opacity-75">Dapatkan Pengalaman Seperti di Industri</span>
                            <span class="fs-2x fw-bold">Routind Academy</span>
                        </div>
                        <!--end::Title-->

                        <!--begin::Action-->
                        <div class="d-flex flex-column flex-sm-row d-grid gap-2">
                            <a href="{{ route('pelajar.setting') }}" class="btn bg-white btn-color-gray-800 flex-shrink-0 me-lg-2">Pengaturan</a>
                            <a href="{{ route('pelajar.profil') }}" class="btn btn-primary flex-shrink-0" style="background: rgba(255, 255, 255, 0.2)">Edit Profil</a>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-5 pt-8">
                        <!--begin::Illustration-->
                        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-150px" style="background-image:url('disc/assets/media/logos/Routind-right.png"></div>
                        <!--end::Illustration-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Engage widget 8-->
    </div>
    <!--end::Col-->
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