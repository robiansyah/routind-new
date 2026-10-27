@extends('layouts.user')

@section('css_start')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.min.css') }}" rel="stylesheet" type="text/css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('title', 'SPT Masa')
@section('content')
    <!--Begin::Section-->

    <div class="row" style="position: relative">
        <button type="button" id="btn_show_help" class="btn btn-warning btn-lg" style="color: white; font-weight: 600;">
            Petunjuk Pengisian &nbsp;&nbsp;&nbsp;
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                 viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                    <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                          id="Path-94" fill="#000000" fill-rule="nonzero"
                          transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999) "/>
                </g>
            </svg>

        </button>

        <div class="col-md-12">
            <div class="btn-group btn-group-djp px-3 ">
                <a class="btn btn-light font-weight-bold d-flex flex-djp w-10 border-menu-djp shadow"
                   href="/ebupot/sptmasa/rekam-bukti-setor">
                    <span class="">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z"
                                      id="Combined-Shape-Copy" fill="#000000" opacity="0.3"
                                      transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z"
                                      id="Combined-Shape" fill="#000000"/>
                            </g>
                        </svg>

                        </span>
                    <span class="">&nbsp; Perekaman Bukti Penyetoran</span>
                </a>
                <a class="btn btn-light font-weight-bold d-flex flex-djp w-10 border-menu-djp shadow"
                   href="/ebupot/sptmasa/penyiapan-spt">
                    <span class="">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                      id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                      id="Combined-Shape" fill="#000000"/>
                                <rect id="Rectangle-152" fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                <rect id="Rectangle-152-Copy" fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                            </g>
                        </svg>

                        </span>
                    <span class="">&nbsp; Penyiapan SPT Masa PPh Unifikasi</span>
                </a>
            </div>
        </div>

        <div class="col-md-12 petunjuk help-hide">
            <div class="kt-portlet kt-portlet--head-sm ">
                <div class="kt-portlet__head" style="background: #F04DBA;">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                 viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                    <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z"
                                          id="Combined-Shape" fill="#000000"/>
                                    <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z"
                                          id="Path-41-Copy" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>

                        </span>
                        <h3 class="kt-portlet__head-title"
                            style="color: white; font-size: 1rem;">Petunjuk
                            Pengisian</h3>
                    </div>
                    <div class="kt-portlet__head-label">
                        <div class="kt-align-right">
                            <button id="btn_collapse_help" class="btn btn-warning  btn-sm btn-icon btn-circle">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                     viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                              id="Path-94" fill="#000000" fill-rule="nonzero"
                                              transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
                                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                              id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3"
                                              transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
                                    </g>
                                </svg>

                            </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-scroll" data-scroll="true" data-height="330"
                         data-scrollbar-shown="true">

                        <p><strong>Deskripsi Form :</strong> Form ini digunakan untuk melengkapi dan mengirimkan Surat Pemberitahuan(SPT)</p>

                        <p>Jika Anda sudah melakukan perekaman data penyetoran dengan sub menu perekaman bukti penyetoran, lengkapilah data SPT tersebut dengan klik tombol LENGKAPI pada kolom paling kanan</p>

                        <p>Sistem akan melakukan pembentukan data SPT dari semua data yang terkait, mungkin akan membutuhkan waktu sejenak. jika pada kolom paling kanan muncul tombol REFRESH, silakan klik untuk melakukan penyegaran data sehigga tombol LENGKAPI dan KIRIM muncul kembali</p>

                        <p>Klik tombol KIRIM jika semua data telah siap, dan pastikan Anda telah menyiapkan file Sertifikat Elektronik</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 halaman-utama">


            <!--Begin::Section-->
            <div class="kt-portlet kt-portlet--head-sm">
                <div class="kt-portlet__head" style="background: #9658DD;">
                    <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon" style="color: white">

    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
         viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect id="bound" x="0" y="0" width="24" height="24"/>
            <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z"
                  id="Combined-Shape" fill="#000000"/>
            <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z"
                  id="Combined-Shape" fill="#000000" opacity="0.3"/>
        </g>
    </svg>

                </span>
                        <h3 class="kt-portlet__head-title" style="color: white">Daftar SPT Masa PPh Unifikasi</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <button id="btn-refresh" type="button" class="btn btn-sm btn-warning btn-elevate btn-pill" style="color: #fff;">
                            <i class="fa fa-redo-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-section">
                        <div class="kt-section__content">
                            <div class="table-responsive">
                                <table class="table table-djp table-md table-striped table-hover" id="tbl_dftrspt">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Tahun Pajak</th>
                                        <th class="text-center">Masa Pajak</th>
                                        <th class="text-center">Pbtl Ke</th>
                                        <th class="text-center" width="150">Jumlah PPh Kurang Setor</th>
                                        <th class="text-center">Status SPT</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundlemin1.js') }}" type="text/javascript"></script>
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/jquery-validation/dist/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/jquery-validation/dist/localization/messages_id.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ url('assets/js/djpcommon.js') }}" type="text/javascript"></script>
    <script src="{{ url('disc/assets/js/custom/pages/sptmasa.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/custom.js') }}" type="text/javascript"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection