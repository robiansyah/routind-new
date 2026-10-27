@extends('layouts.user')

@section('css_start')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('title', 'PPh')
@section('content')
    <!--Begin::Section-->
    <div class="row" style="position: relative">
        <button type="button" id="btn_show_help" class="btn btn-warning btn-lg" style="color: white; font-weight: 600;">
            Petunjuk Pengisian &nbsp;&nbsp;&nbsp;

            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                 height="24px"
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
                <div class="btn-group w-10 shadow">
                    <button type="button"
                            class="btn btn-light font-weight-bold dropdown-toggle d-flex flex-djp border-menu-djp"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <span class="">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px"
                             viewBox="0 0 24 24" version="1.1"
                             class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
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
                        <span class="">&nbsp; PPh yang Disetor Sendiri</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg">
                        <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3" role="tablist">
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="/ebupot/pph/dftr-disetor-sendiri">
                                    <span class="kt-nav__link-icon">

                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z"
                                                  id="Combined-Shape" fill="#000000"/>
                                            <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z"
                                                  id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>

                                    </span>
                                    <span class="kt-nav__link-text text-dark font-weight-bold">&nbsp; Daftar PPh yang Disetor Sendiri</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="/ebupot/pph/input-disetor-sendiri">
                                    <span class="kt-nav__link-icon">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
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
                                    <span class="kt-nav__link-text text-dark font-weight-bold">&nbsp; Rekam PPh yang Disetor Sendiri</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="btn-group w-10 shadow">
                    <button type="button"
                            class="btn btn-light font-weight-bold dropdown-toggle d-flex flex-djp border-menu-djp"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <span class="">

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px"
                                 viewBox="0 0 24 24" version="1.1"
                                 class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                          id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                          id="Combined-Shape" fill="#000000"/>
                                    <rect id="Rectangle-152" fill="#000000" opacity="0.3" x="10" y="9" width="7"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy-2" fill="#000000" opacity="0.3" x="7" y="9" width="2"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy-3" fill="#000000" opacity="0.3" x="7" y="13" width="2"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy" fill="#000000" opacity="0.3" x="10" y="13" width="7"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy-5" fill="#000000" opacity="0.3" x="7" y="17" width="2"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy-4" fill="#000000" opacity="0.3" x="10" y="17" width="7"
                                          height="2" rx="1"/>
                                </g>
                            </svg>

                        </span>
                        <span class="">&nbsp; PPh Pasal 4 ayat (2), 15, 22, 23</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg">
                        <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3" role="tablist">
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="/ebupot/pph/dftr-ps42152223">
                                    <span class="kt-nav__link-icon">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z"
                                                      id="Combined-Shape" fill="#000000"/>
                                                <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z"
                                                      id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>

                                    </span>
                                    <span class="kt-nav__link-text text-dark font-weight-bold">&nbsp; Daftar BP Ps 4(2), 15, 22, 23</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="/ebupot/pph/input-ps42152223">
                                    <span class="kt-nav__link-icon">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
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
                                    <span class="kt-nav__link-text text-dark font-weight-bold">&nbsp; Rekam BP Ps 4(2), 15, 22, 23</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="btn-group w-10 shadow">
                    <button type="button"
                            class="btn btn-light font-weight-bold dropdown-toggle d-flex flex-djp border-menu-djp"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <span class="">

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px"
                                 viewBox="0 0 24 24" version="1.1"
                                 class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                          id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                          id="Combined-Shape" fill="#000000"/>
                                    <rect id="Rectangle-152" fill="#000000" opacity="0.3" x="10" y="9" width="7"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy-2" fill="#000000" opacity="0.3" x="7" y="9" width="2"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy-3" fill="#000000" opacity="0.3" x="7" y="13" width="2"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy" fill="#000000" opacity="0.3" x="10" y="13" width="7"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy-5" fill="#000000" opacity="0.3" x="7" y="17" width="2"
                                          height="2" rx="1"/>
                                    <rect id="Rectangle-152-Copy-4" fill="#000000" opacity="0.3" x="10" y="17" width="7"
                                          height="2" rx="1"/>
                                </g>
                            </svg>

                        </span>
                        <span class="">&nbsp; PPh Non Residen</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg">
                        <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3" role="tablist">
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="/ebupot/pph/dftr-ps26">
                                    <span class="kt-nav__link-icon">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z"
                                                      id="Combined-Shape" fill="#000000"/>
                                                <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z"
                                                      id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>

                                    </span>
                                    <span class="kt-nav__link-text text-dark font-weight-bold">&nbsp; Daftar Bukti Potong PPh Non Residen</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="/ebupot/pph/input-ps26">
                                    <span class="kt-nav__link-icon">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
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
                                    <span class="kt-nav__link-text text-dark font-weight-bold">&nbsp; Rekam Bukti Potong PPh Non Residen</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a class="btn btn-light font-weight-bold d-flex flex-djp w-10 border-menu-djp shadow" href="/ebupot/pph/impor-data">
                    <span class="">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px"
                             viewBox="0 0 24 24" version="1.1"
                             class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                <path d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z"
                                      id="Combined-Shape" fill="#000000"/>
                                <path d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z"
                                      id="Path" fill="#000000" opacity="0.3"/>
                                <path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z"
                                      id="Shape" fill="#000000" fill-rule="nonzero"
                                      transform="translate(11.959697, 3.661508) rotate(-90.000000) translate(-11.959697, -3.661508) "/>
                            </g>
                        </svg>

                        </span>
                    <span class="">&nbsp; Impor Data PPh</span>
                </a>
                <a class="btn btn-light font-weight-bold d-flex flex-djp w-10 border-menu-djp shadow"
                   href="/ebupot/pph/posting">
                    <span class="">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px"
                             viewBox="0 0 24 24" version="1.1"
                             class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                <path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z"
                                      id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z"
                                      id="Combined-Shape" fill="#000000"/>
                            </g>
                        </svg>

                        </span>
                    <span class="">&nbsp; Posting</span>
                </a>
            </div>
        </div>

        <div class="col-md-12 petunjuk help-hide">
            <div class="kt-portlet kt-portlet--head-sm ">
                <div class="kt-portlet__head" style="background: #F04DBA;">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px"
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

                        <p><strong>Deskripsi Form:</strong> Form ini digunakan untuk memasukkan data bukti pemotongan kedalam Surat
                            Pemberitahuan (SPT) Masa Pajak penghasilan (PPh) Unifikasi</p>
                        <p>Untuk melakukan posting data Bukti Pemotongan kedalam SPT, pastikan Anda telah merekam semua data pada periode
                            pelaporan Surat Pemberitahuan (SPT) Masa. Berikut ini adalah langkah-langkah melakukan posting Data Bukti
                            Potong</p>
                        <p>Pilih Periode Pajak (tahun dan masa pajak) kemudian klik tombol Check</p>
                        <ul style="padding-inline-start: 20px; font-weight: 600">
                            <li>Sistem akan melakukan pengecekan data Bukti pemotongan dan/atau PPh disetor sendiri yang siap diposting
                                sesuai dengan Masa Pajak yang ditentukan
                            </li>
                            <li>Berdasarkan hasil pengecekan, sistem akan menampilkan notifikasi pembuatan/pembetulan SPT sesuai dengan Masa
                                Pajak yang ditentukan
                            </li>
                            <li>Jika Anda telah meyakini akan membuat/membetulkan SPT, klik tombol Ok pada tampilan notifikasi</li>
                            <li>Sistem secara otomatis akan membentuk data SPT Masa PPh Unifikasi dan mengisikan daftar bukti pemotongan
                                pada SPT Tersebut
                            </li>
                            <li>Setelah Anda melakukan proses Posting, lakukan perekaman bukti pembayaran pada menu Perekaman Bukti
                                Penyetoran
                            </li>
                        </ul>

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
            <path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z"
                  id="Combined-Shape" fill="#000000" opacity="0.3"/>
            <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z"
                  id="Combined-Shape" fill="#000000"/>
        </g>
    </svg>

                </span>
                        <h3 class="kt-portlet__head-title" style="color: white">Posting Data Pajak Penghasilan</h3>
                        <input type="hidden" id="startYear" value="2022"/>
                        <input type="hidden" id="startMonth" value="01"/>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-section">
                        <div class="kt-section__content">
                            <div class="form-group form-group-md row">
                                <div class="col-md-3"></div>
                                <label class="col-form-label col-md-2 pl-4" for="thnPjk">Tahun
                                    Pajak</label>
                                <div class="col-md-4">
                                    <div class="form-group select2-container-djp mb-0">
                                        <select data-placeholder="Pilih Tahun Pajak"
                                                class="form-control m-select2 djp-select2"
                                                id="thnPjk"
                                                name="thnPjk">
                                            <option></option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="form-group form-group-md row">
                                <div class="col-md-3"></div>
                                <label class="col-form-label col-md-2 pl-4" for="msPjk">Masa
                                    Pajak</label>
                                <div class="col-md-4">
                                    <div class="form-group select2-container-djp mb-0">
                                        <select data-placeholder="Pilih Masa Pajak"
                                                class="form-control m-select2 djp-select2"
                                                id="msPjk"
                                                name="msPjk">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-align-center">
                        <button id='btnSubmit' type="button" class="btn btn-djp btn-elevate btn-pill">
                            <i class="fa fa-paper-plane"></i> Cek
                        </button>
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
    <script src="{{ url('disc/assets/js/custom/pages/posting.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/custom.js') }}" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection