@extends('layouts.metronic')

@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('title', 'Buat Eform 1770')
@section('content')
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        <!--begin::Table Widget 4-->
        <div class="card card-flush h-xl-100">
            <!--begin::Card header-->
            <div class="card-header pt-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Data Formulir 1770</span>
                    {{-- <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span> --}}
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-2">
                <!--begin::Form-->
                <form class="form" method="POST" action="{{ route('pelajar.eform.store', ['type'=>'1770']) }}">
                    @csrf
                    
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tahun Pajak</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <!--begin::Input-->
                                <select name="year" id="year" aria-label="Pilih Tahun Pajak" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-select form-select-md">
                                    <option value="">Pilih Tahun Pajak</option>
                                    @for ($i=date('Y'); $i>=date('Y')-5; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Status SPT</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <div class="mt-4 d-flex">
                                    <div class="form-check form-check-custom form-check-sm me-10">
                                        <input class="form-check-input" type="radio" name="correction_to" id="normal" value="1" checked>
                                        <label class="form-check-label">
                                            Normal
                                        </label>
                                    </div>
                    
                                    <div class="form-check form-check-custom form-check-sm">
                                        <input class="form-check-input" type="radio" name="correction_to" id="correction" value="2">
                                        <label class="form-check-label">
                                            Pembetulan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Pembetulan Ke</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="number" name="correction_no" id="correction_no" class="form-control" value="0"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('pelajar.spt.arsip') }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Buat eForm</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Table Widget 4-->
    </div>
    <!--end::Col-->
</div>
@endsection
@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    
    </script>
@endsection
