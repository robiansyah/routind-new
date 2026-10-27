@extends('layouts.metronic')

@section('title', 'Ubah Password')
@section('content')
<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Ubah Password</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div class="collapse show">
        <!--begin::Form-->
        <form class="form" method="POST" action="{{ route('pelajar.password.update') }}">
            @csrf
            
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Password saat ini</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input type="password" name="password_old" class="form-control" placeholder="Password saat ini" required/>
                        @error('password_old')
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Password baru</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input type="password" name="password" class="form-control" placeholder="Password baru" required/>
                        @error('password')
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Konfirmasi Password baru</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password baru" required/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('pelajar.index') }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Ubah Password</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->
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