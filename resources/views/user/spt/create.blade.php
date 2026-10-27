@extends('layouts.metronic')

@section('title', 'Lapor')
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
                    <span class="card-label fw-bold text-gray-800">Formulir SPT</span>
                    {{-- <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span> --}}
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-2">
                <div class="form-group col-md-12 mb-8" id="step1"> 
                    <h5 class="form-section bold">Apakah Anda Menjalankan Usaha atau Pekerjaan bebas? </h5>
                    <div class="mb-3 mt-3">
                        <div class="form-check form-check-custom form-check-sm">
                            <input class="form-check-input" type="radio" name="rbStep1" id="rbs11" value="1" >
                            <label class="form-check-label">
                                Ya
                            </label>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="form-check form-check-custom form-check-sm">
                            <input class="form-check-input" type="radio" name="rbStep1" id="rbs12" value="2">
                            <label class="form-check-label">
                                Tidak
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12 mb-8" id="step2" style="display:none">  
                    <h5 class="form-section bold">Apakah Anda seorang Suami atau Istri yang menjalankan kewajiban perpajakan terpisah (MT) atau Pisah Harta (PH)? </h5>
                    <div class="mb-3 mt-3">
                        <div class="form-check form-check-custom form-check-sm">
                            <input class="form-check-input" type="radio" name="rbStep2" id="rbs21" value="1" >
                            <label class="form-check-label">
                                Ya
                            </label>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="form-check form-check-custom form-check-sm">
                            <input class="form-check-input" type="radio" name="rbStep2" id="rbs22" value="2">
                            <label class="form-check-label">
                                Tidak
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 mb-8" id="step3"  style="display:none">  
                    <h5 class="form-section bold">Apakah Penghasilan Bruto Yang Anda Peroleh selama setahun Kurang dari 60 Juta Rupiah?</h5>
                    <div class="mb-3 mt-3">
                        <div class="form-check form-check-custom form-check-sm">
                            <input class="form-check-input" type="radio" name="rbStep3" id="rbs31" value="1" >
                            <label class="form-check-label">
                                Ya
                            </label>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="form-check form-check-custom form-check-sm">
                            <input class="form-check-input" type="radio" name="rbStep3" id="rbs32" value="2">
                            <label class="form-check-label">
                                Tidak
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12 mb-8" id="step4"  style="display:none">  
                    <h5 class="form-section bold">Anda Dapat Mengunakan formulir 1770 S, pilihlah form yang akan digunakan  </h5>
                    <div class="mb-3 mt-3">
                        <div class="form-check form-check-custom form-check-sm">
                            <input class="form-check-input" type="radio" name="rbStep4" id="rbs41" value="1" >
                            <label class="form-check-label">
                                Dengan bentuk formulir
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12" id="divUpload"  style="display:none">
                    <div class="form-row-seperated">
                        <div class="form-group"> 
                            <a href="/efile/new1770" id="btn4" class="btn btn-primary">
                                SPT 1770
                            </a>
                        </div>
                    </div>                                     
                </div>
                <div class="form-group col-md-12" id="divSS"  style="display:none">  
                    <div class="form-row-seperated">
                        <div class="form-group">
                            <a href="/efile/new1770ss" id="btn1" class="btn btn-primary">
                                SPT 1770 SS
                            </a>
                        </div>
                    </div>                                     
                </div>
                <div class="form-group col-md-12" id="divS" style="display:none">  
                    <div class="form-row-seperated">
                        <div class="form-group">  
                            <a href="/efile/new1770s" id="btn2" class="btn btn-primary">
                                SPT 1770 S dengan formulir
                            </a>
                        </div>
                        <div class="form-group">  
                            <a href="#" id="btn3" class="btn btn-primary" >
                                SPT 1770 S dengan panduan
                            </a>
                        </div>
                        <div class="form-group">  
                            <a href="#" id="btn5" class="btn btn-primary">
                                Upload SPT
                            </a>
                        </div>
                    </div>                                     
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Table Widget 4-->
    </div>
    <!--end::Col-->
</div>

@endsection
@section('js')

<script src="{{ url('disc/assets/js/custom/pages/sptbuat.js') }}" type="text/javascript" ></script>
@endsection