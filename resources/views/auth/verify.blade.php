@extends('layouts.metronic')

@section('title', 'Verifikasi Email')

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
                    <span class="card-label fw-bold text-dark">Verifikasi</span>
                    {{-- <span class="text-gray-400 mt-1 fw-semibold fs-6">Informasi Pengguna</span> --}}
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-5">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <span class="fs-4">
                {{ __('Before proceeding, please check your email for a verification link.') }}<br><br>
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="fs-4 btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
                </span>
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
                            <span class="fs-2qx fw-bold">Upgrade Paket Anda</span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <span class="fw-semibold text-white fs-6 mb-8 d-block opacity-75">Ekstra Diskon Untuk Pembelian Paket Premium dengan Kode Diskon
                            <span id="kt_clipboard_4" class="me-5">RT23001</span>
                            <button class="btn btn-icon btn-sm btn-light" data-clipboard-target="#kt_clipboard_4">
                                <i class="ki-duotone ki-copy fs-2 text-muted"></i>
                            </button>
                        </span>
                        <!--end::Text-->

                        <!--begin::Action-->
                        <div class="d-flex flex-column flex-sm-row d-grid gap-2">
                            <a href="{{ route('pelajar.paket') }}" class="btn bg-white btn-color-gray-800 flex-shrink-0 me-lg-2">Beli Paket</a>
                            <a href="{{ route('pelajar.profil') }}" class="btn btn-primary flex-shrink-0" style="background: rgba(255, 255, 255, 0.2)">Edit Profil</a>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-5 pt-8">
                        <!--begin::Illustration-->
                        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-150px" style="background-image:url('disc/assets/media/logos/Routind free.png"></div>
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

    <script src="{{ url('disc/assets/js/custom/clipboard.js') }}"></script>
@endsection
