@extends('layouts.metronic')

@section('title', 'Metode Pembayaran')
@section('content')
    <div class="card" id="kt_pricing">
        <!--begin::Card body-->
        <div class="card-body p-lg-17">
            <!--begin::Plans-->
            <div class="d-flex flex-column">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <h1 class="fs-2hx fw-bold mb-5">Pilih Metode Pembayaran</h1>

                    <div class="text-gray-600 fw-semibold fs-5">
                        Kamu bisa memilih metode pembayaran sesuai dengan yang kamu mau.
                    </div>
                </div>
                <div class="mb-5">
                    <button type="button" id="next" class="btn btn-primary me-2">Selanjutnya</button>
                </div>
                <!--end::Heading-->

                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Option-->
                        <input type="radio" class="btn-check" name="metode" value="apps" id="kt_radio_buttons_2_option_1">
                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_1">
                            <img src="https://tripay.co.id/images/payment-channel/n22Qsh8jMa1583433577.png" class="w-100px me-5"><br>
                            <span class="d-block fw-semibold text-start">
                                <span class="text-dark fw-bold d-block fs-3">BNI Virtual Account</span>
                                <span class="text-muted fw-semibold fs-6">Biaya Admin</span>
                                <span class="text-dark fw-bold d-block fs-5">Rp5.0000</span>
                            </span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Option-->
                        <input type="radio" class="btn-check" name="metode" value="sms" id="kt_radio_buttons_2_option_2">
                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="kt_radio_buttons_2_option_2">
                            <img src="https://tripay.co.id/images/payment-channel/ZT91lrOEad1582929126.png" class="w-100px me-5">
                            <span class="d-block fw-semibold text-start">
                                <span class="text-dark fw-bold d-block fs-3">Maybank Virtual Account</span>
                                <span class="text-muted fw-semibold fs-6">Biaya Admin</span>
                                <span class="text-dark fw-bold d-block fs-5">Rp5.0000</span>
                            </span>
                        </label>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Plans-->
        </div>
        <!--end::Card body-->
    </div>
@endsection
@section('js')
    <script>
        $( document ).ready(function() {
            $("#next").attr('disabled', '');
            $('.btn-check').click(function () {
                $("#next").removeAttr('disabled');
            });
            $('#next').click(function (e) {
                e.preventDefault();
                var method = $('input[type=radio][name=metode]').val();
                location.href = '/paket/{{ $type }}/'+method+'/checkout';
            });
        });
    </script>
@endsection