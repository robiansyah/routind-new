@extends('layouts.user')

@section('css_start')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                   href="/ebupot/pengaturan/penandatangan">
                    <span class="">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                <path d="M11,3 L11,11 C11,11.0862364 11.0109158,11.1699233 11.0314412,11.2497543 C10.4163437,11.5908673 10,12.2468125 10,13 C10,14.1045695 10.8954305,15 12,15 C13.1045695,15 14,14.1045695 14,13 C14,12.2468125 13.5836563,11.5908673 12.9685588,11.2497543 C12.9890842,11.1699233 13,11.0862364 13,11 L13,3 L17.7925828,12.5851656 C17.9241309,12.8482619 17.9331722,13.1559315 17.8173006,13.4262985 L15.1298744,19.6969596 C15.051085,19.8808016 14.870316,20 14.6703019,20 L9.32969808,20 C9.12968402,20 8.94891496,19.8808016 8.87012556,19.6969596 L6.18269936,13.4262985 C6.06682778,13.1559315 6.07586907,12.8482619 6.2074172,12.5851656 L11,3 Z" id="Combined-Shape" fill="#000000"/>
                                <path d="M10,21 L14,21 C14.5522847,21 15,21.4477153 15,22 L15,23 L9,23 L9,22 C9,21.4477153 9.44771525,21 10,21 Z" id="Rectangle-2" fill="#000000" opacity="0.3"/>
                            </g>
                        </svg>

                    </span>
                    <span class="">&nbsp; Penandatangan</span>
                </a>
                <a class="btn btn-light font-weight-bold d-flex flex-djp w-10 border-menu-djp shadow"
                   href="#">
                    <span class="">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                <polygon id="Path-59" fill="#000000" opacity="0.3" transform="translate(8.885842, 16.114158) rotate(-315.000000) translate(-8.885842, -16.114158) " points="6.89784488 10.6187476 6.76452164 19.4882481 8.88584198 21.6095684 11.0071623 19.4882481 9.59294876 18.0740345 10.9659914 16.7009919 9.55177787 15.2867783 11.0071623 13.8313939 10.8837471 10.6187476"/>
                                <path d="M15.9852814,14.9852814 C12.6715729,14.9852814 9.98528137,12.2989899 9.98528137,8.98528137 C9.98528137,5.67157288 12.6715729,2.98528137 15.9852814,2.98528137 C19.2989899,2.98528137 21.9852814,5.67157288 21.9852814,8.98528137 C21.9852814,12.2989899 19.2989899,14.9852814 15.9852814,14.9852814 Z M16.1776695,9.07106781 C17.0060967,9.07106781 17.6776695,8.39949494 17.6776695,7.57106781 C17.6776695,6.74264069 17.0060967,6.07106781 16.1776695,6.07106781 C15.3492424,6.07106781 14.6776695,6.74264069 14.6776695,7.57106781 C14.6776695,8.39949494 15.3492424,9.07106781 16.1776695,9.07106781 Z" id="Combined-Shape" fill="#000000" transform="translate(15.985281, 8.985281) rotate(-315.000000) translate(-15.985281, -8.985281) "/>
                            </g>
                        </svg>

                    </span>
                    <span class="">&nbsp; Buat Auth Key</span>
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

                        <p><strong>Deskripsi Form: </strong>Form ini digunakan untuk mendaftarkan data pihak yang berhak
                            melakukan penandatangan Bukti Pemotongan dan SPT.</p>
                        <p>Terdapat 2 tipe penandatangan sebagai berikut:</p>
                        <ol style="padding-inline-start: 20px; font-weight: 600">
                            <li>Wakil Wajib Pajak(Pengurus)
                                <ul style="padding-inline-start: 20px; font-weight: 600">
                                    <li>Untuk WP Badan: Masukkan NPWP/NIK Pengurus</li>
                                    <li>Untuk WP OP: Masukkan NPWP sendiri</li>
                                </ul>
                            </li>
                            <li>Kuasa</li>
                        </ol>
                        <p>Jangan lupa untuk mencentang status aktif/tidak aktif dari Penandatangan.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 halaman-utama">
            <div class="kt-portlet kt-portlet--head-sm">
                <div class="kt-portlet__head" style="background: #9658DD;">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon" style="color: white">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                 viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                          id="Path-11" fill="#000000" fill-rule="nonzero"
                                          transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                          id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                </g>
                            </svg>
                        </span>
                        <h3 class="kt-portlet__head-title" style="color: white">Perekaman Penandatangan</h3>
                        <input type="hidden" id="npwpUser" value="{{ auth()->user()->username }}"/>
                        <input type="hidden" id="optNik" value="1"/>
                        <input type="hidden" id="kdjnswp" value="2"/>
                    </div>
                </div>
                <form class="kt-form" id="formRekamPenandatangan">
                    <div class="kt-portlet__body">
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <div class="form-group form-group-md row">
                                    <div class="col-md-2"></div>
                                    <label class="col-form-label col-md-2">Bertindak Sebagai</label>
                                    <div class="col-md-6">
                                        <div class="kt-radio-inline">
                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                <input id="optBertindak1" type="radio" name="optBertindak" value="0"
                                                       checked="checked">Wakil Wajib Pajak (Pengurus)</input>
                                                <span></span>
                                            </label>
                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                <input id="optBertindak2" type="radio" name="optBertindak" value="1">
                                                Kuasa
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group form-group-md row">
                                    <div class="col-md-2"></div>
                                    <label class="col-form-label col-md-2">Identitas</label>
                                    <div class="col-md-6">
                                        <div class="kt-radio-inline">
                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                <input id="optIdentitas1" type="radio" name="optIdentitas" value="0"
                                                       checked="checked">
                                                NPWP
                                                <span></span>
                                            </label>
                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                <input id="optIdentitas2" type="radio" name="optIdentitas" value="1">
                                                NIK
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group form-group-md row">
                                    <div class="col-md-2"></div>
                                    <label class="col-form-label col-md-2" for="npwp">NPWP</label>
                                    <div class="col-md-6">
                                        <div class="kt-input-icon kt-input-icon--left kt-input-icon--right">
                                            <input id="npwp" type="text" class="form-control" autocomplete="off"
                                                   name="npwp" placeholder="" maxlength="20"
                                                   value=""/>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i
                                                            class="fa fa-money-check-alt"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group form-group-md row">
                                    <div class="col-md-2"></div>
                                    <label class="col-form-label col-md-2" for="nik">NIK</label>
                                    <div class="col-md-6">
                                        <div class="kt-input-icon kt-input-icon--left kt-input-icon--right">
                                            <input id="nik" type="text" class="form-control" autocomplete="off"
                                                   name="nik" placeholder="" maxlength="16"/>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i
                                                            class="fa fa-id-card"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group form-group-md row">
                                    <div class="col-md-2"></div>
                                    <label class="col-form-label col-md-2" for="nama">Nama</label>
                                    <div class="col-md-6">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input readonly id="nama" type="text" class="form-control"
                                                   autocomplete="off" name="nama" placeholder="" style="text-transform:uppercase"
                                                   value=""/>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i
                                                            class="fa fa-user"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group form-group-md row">
                                    <div class="col-md-2"></div>
                                    <label class="col-form-label col-md-2">Status</label>
                                    <div class="col-md-6">
                                        <div class="kt-checkbox-inline">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                                <input type="checkbox" name="optStatus" value="0"/> Aktif
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group form-group-md row cek-nik">
                                    <div class="col-md-2"></div>
                                    <label class="col-form-label col-md-2"></label>
                                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                                        <button id="btnCekNik" type="button"
                                                class="btn btn-sm btn-djp btn-elevate btn-pill">
                                            <i class="fa fa-search"></i> Cek
                                        </button>
                                    </div>
                                    <div class="col-md-1 d-flex justify-content-center">
                                        <span class="kt-switch kt-switch--sm kt-switch--icon d-flex justify-content-center align-items-center" style="margin-top: 0">
                                            <label style="margin-bottom: 0">
                                                <input id="optNikCb" type="checkbox" name=""
                                                       disabled>
                                                    <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    <label class="col-form-label col-md-3" id="label-valid"> Tidak Valid</label>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-align-center">
                            <button id='btnSubmit' type="submit" class="btn btn-djp btn-elevate btn-pill">
                                <i class="la la-save"></i> Simpan
                            </button>
                            <button id='btnReset' type="button" class="btn btn-secondary btn-elevate btn-pill">
                                <i class="fa fa-undo-alt"></i> Batal
                            </button>
                        </div>
                    </div>
                </form>
            </div>

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
                        <h3 class="kt-portlet__head-title" style="color: white">Daftar Penandatangan Bukti Potong</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-section">
                        <div class="kt-section__content kt-section__content--solid" style="border-left: 0px">
                            <form id="form-cari">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>Pencarian Berdasarkan</label>
                                        <div></div>
                                        <select class="custom-select form-control" id="opt-cari" name="opt-cari">
                                            <option selected value="">Semua</option>
                                            <option value="0">Nomor Identitas</option>
                                            <option value="1">Nama</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Kata Kunci</label>
                                        <input class="form-control" id="input-cari" name="input-cari"/>
                                    </div>
                                    <div class="col-md-4" style="display: flex; align-items: flex-end">
                                        <button id="btn-cari" type="button" class="btn btn-success btn-elevate mt-4">
                                            <i class="fa fa-search"></i> Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="kt-section">
                        <div class="kt-section__content">
                            <div class="table-responsive">
                                <table class="table table-djp table-md table-striped table-hover" id="tbl_dftr_pt">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Nomor Identitas</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Bertindak Sebagai</th>
                                        <th class="text-center">Status</th>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/jquery-validation/dist/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/jquery-validation/dist/localization/messages_id.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundlemin1.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ url('assets/js/djpcommon.js') }}" type="text/javascript"></script>
    <script src="{{ url('disc/assets/js/custom/pages/pengaturan.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/custom.js') }}" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection