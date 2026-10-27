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

                        <p><strong>Deskripsi Form:</strong> Form ini digunakan untuk melakukan perekaman bukti penyetoran/pembayaran Pajak Penghasilan (PPh)</p>

                        <p>Pada form ini, Anda dapat melihat daftar tagihan yang disajikan per jenis pajak dan jenis setoran sesuai dengan masa pajak yang dipilih</p>

                        <p>Daftar tagihan tersebut dibentuk berdasarkan data bukti pemotongan yang telah Anda Rekam</p>

                        <p>Anda dapat menggunakan daftar tagihan ini untuk membuat kode billing sebagai dasar penyetoran pajak</p>

                        <p>Jika Anda telah menyetorkan pajak penghasilan yang dipotong, Anda selanjutnya dapat melakukan perekaman bukti penyetoran tersebut pada form ini</p>

                        <p>Berikut adalah langkah-langkah perekaman bukti penyetoran/pembayaran</p>
                        <ul style="padding-inline-start: 20px; font-weight: 600">
                            <li>klik tombol Input Bukti Setor, sehingga Sistem menampilkan pop up perekaman bukti pembayaran</li>
                            <li>Bukti Penyetoran yang dapat digunakan adalah Bukti Penerimaan Negara (BPN) dan Bukti Pemindahbukuan (Pbk)</li>
                            <li>Jika Anda telah memiliki Bukti Penerimaan Negara yang diperoleh dari Bank saat melakukan penyetoran, Silahkan Anda pilih Surat Setoran Pajak pada pilihan Jenis Bukti Penyetoran</li>
                            <li>Isikan Nomor Transaksi Penerimaan Negara (NTPN) yang tertera pada BPN pada kotak Nomor Bukti Penerimaan, kemudian Pilihlah tahun penyetoran yang sesuai</li>
                            <li>Jika Anda telah menerima bukti pemindahbukan (pbk) dari Kantor Pelayanan Pajak (KPP), Silahkan Anda masukkan Nomor Pbk pada kotak isian yang tersedia, lalu klik tombol Cek Pemindahbukan</li>
                            <li>Jika data pemindahbukuan Anda Valid, Sistem akan memberikan notifikasi bahwa data pembayaran Anda telah sesuai, kemudian klik tombol Simpan</li>
                            <li>Jika setelah Anda Klik tombol cek pemindahbukan namun sistem merespon data pembayaran tidak ditemukan, Anda dapat menanyakan kepada Account Representative Anda di KPP Anda terdaftar</li>
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
                            <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z"
                                  id="Combined-Shape-Copy" fill="#000000" opacity="0.3"
                                  transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                            <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z"
                                  id="Combined-Shape" fill="#000000"/>
                        </g>
                    </svg>

                </span>
                        <h3 class="kt-portlet__head-title" style="color: white">Perekaman Bukti Penyetoran</h3>
                        <input type="hidden" id="npwp-user" value="{{ auth()->user()->username }}"/>
                        <input type="hidden" id="startYear" value="2022"/>
                        <input type="hidden" id="startMonth" value="01"/>
                        <input type="hidden" id="thnPajak-val" />
                        <input type="hidden" id="msPajak-val" />
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-section">
                        <div class="kt-section__content">

                            <div class="form-group form-group-md row">
                                <label class="col-form-label col-md-2 pl-4" for="thnPjk">Tahun
                                    Pajak</label>
                                <div class="col-md-3">
                                    <div class="form-group select2-container-djp mb-0">
                                        <select data-placeholder="Pilih Tahun Pajak"
                                                class="form-control m-select2 djp-select2"
                                                id="thnPjk"
                                                name="thnPjk">
                                            <option></option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                        </select>
                                        <!--<input class="input-select" type="hidden" id="val-thnPjk" th:field="*{thnPajak}"/>-->
                                    </div>
                                </div>
                                <label class="col-form-label col-md-2 pl-4" for="msPjk">Masa
                                    Pajak</label>
                                <div class="col-md-3">
                                    <div class="form-group select2-container-djp mb-0">
                                        <select data-placeholder="Pilih Masa Pajak"
                                                class="form-control m-select2 djp-select2"
                                                id="msPjk"
                                                name="msPjk">
                                            <option></option>
                                        </select>
                                        <!--<input class="input-select" type="hidden" id="val-msPjk" th:field="*{msPajak}"/>-->
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button id='btnCek' type="button" class="btn btn-djp btn-elevate btn-pill">
                                        <i class="fa fa-paper-plane"></i> Cek
                                    </button>
                                </div>
                            </div>

                            <!--begin::Accordion-->
                            <div class="accordion accordion-solid  accordion-toggle-arrow" id="acc1">
                                <div class="card">
                                    <div class="card-header" id="headingOne2a">
                                        <a href="#acc11" class="card-title" data-toggle="collapse" aria-expanded="true"
                                           aria-controls="acc11">Jumlah Tagihan Per Masa Pajak </a>
                                    </div>
                                    <div id="acc11" class="collapse show" aria-labelledby="headingOne2a" data-parent="#acc1">
                                        <div class="card-body">
                                            <div class="kt-section">
                                                <div class="kt-section__content">
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
                                                                <h3 class="kt-portlet__head-title" style="color: white">
                                                                    Daftar Tagihan Pemotongan atas Bukti Pemotongan Pemungutan PPh Unifikasi
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="kt-portlet__body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-djp table-md table-striped table-hover"
                                                                               id="tbl_tagihan">
                                                                            <thead>
                                                                            <tr>
                                                                                <th class="text-center">Jenis Pajak</th>
                                                                                <th class="text-center">Jenis Setoran</th>
                                                                                <th class="text-center">PPh yang Dipotong</th>
                                                                                <th class="text-center">ID Billing</th>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo2a">
                                        <a href="#acc12" class="card-title collapsed" data-toggle="collapse"
                                           aria-expanded="false" aria-controls="acc12">Rekam Bukti Penyetoran </a>
                                    </div>
                                    <div id="acc12" class="collapse" aria-labelledby="headingTwo2a" data-parent="#acc1">
                                        <div class="card-body">
                                            <div class="kt-section">
                                                <div class="kt-section__content">
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
                                                                <h3 class="kt-portlet__head-title" style="color: white">
                                                                    Daftar Bukti Setor
                                                                </h3>
                                                            </div>
                                                            <div class="kt-portlet__head-toolbar">
                                                                <button style="color: #9658DD; font-weight: 700"
                                                                        id="btn-add-pembayaran" type="button"
                                                                        class="btn btn-sm btn-warning btn-elevate btn-pill m-2">
                                                                    <i class="fa fa-plus-circle"></i>&nbsp;Tambah
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="kt-portlet__body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-djp table-md table-striped table-hover"
                                                                               id="tbl_pembayaran">
                                                                            <thead>
                                                                            <tr>
                                                                                <th class="text-center">No</th>
                                                                                <th class="text-center">Nomor Bukti</th>
                                                                                <th class="text-center">Jenis Pajak</th>
                                                                                <th class="text-center">Jenis Setoran</th>
                                                                                <th class="text-center">Masa Tahun Pajak</th>
                                                                                <th class="text-center">Tanggal Setor</th>
                                                                                <th class="text-center">Jumlah Setor</th>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree2a">
                                        <a href="#acc13" class="card-title collapsed" data-toggle="collapse"
                                           aria-expanded="false" aria-controls="acc13">Ringkasan Pembayaran
                                        </a>
                                    </div>
                                    <div id="acc13" class="collapse" aria-labelledby="headingThree2a" data-parent="#acc1">
                                        <div class="card-body">
                                            <div class="kt-section">
                                                <div class="kt-section__content">
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
                                                                <h3 class="kt-portlet__head-title" style="color: white">
                                                                    Daftar Ringkasan Pembayaran
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="kt-portlet__body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-djp table-md table-striped table-hover"
                                                                               id="tbl_ringkasan">
                                                                            <thead>
                                                                            <tr>
                                                                                <th class="text-center">Jenis Pajak</th>
                                                                                <th class="text-center">Jenis Setoran</th>
                                                                                <th class="text-center">PPh yang Dipotong</th>
                                                                                <th class="text-center">PPh yang Disetor</th>
                                                                                <th class="text-center">Selisih</th>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <!--begin::Modal-->
    <div class="modal fade" id="modal_pembayaran" data-backdrop="static" data-keyboard="false" tabindex="-1"
         role="dialog" aria-labelledby="modalPembayaran"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalDokumenLabel">Perekaman Data Bukti Setor</h4>
                </div>
                <form id="form_pembayaran">
                    <div class="modal-body">
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <div class="kt-section">
                                    <div class="kt-section__content kt-section__content--solid" style="border-left: 0px">
                                        <div class="form-group form-group-md row">
                                            <div class="col-md-2"></div>
                                            <label class="col-form-label col-md-2">Jenis Bukti Penyetoran</label>
                                            <div class="col-md-6">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                        <input id="fgPbkBpe0" type="radio" name="fgPbkBpe" value="0"
                                                               checked="checked">
                                                        Surat Setoran Pajak
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                        <input id="fgPbkBpe1" type="radio" name="fgPbkBpe" value="1">
                                                        Pemindahbukuan
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div id="fgPbkPbe0Div">
                                            <div class="form-group form-group-md row">
                                                <div class="col-md-2"></div>
                                                <label class="col-md-2" for="npwpSsp">NPWP</label>
                                                <div class="col-md-6">
                                                    <input id="npwpSsp" type="text" class="form-control" autocomplete="off"
                                                           name="npwpSsp"/>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group form-group-md row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-6">
                                                    <div class="kt-checkbox-inline">
                                                        <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                                            <input type="checkbox" name="optSsp" value="1"/>
                                                            Centang jika NPWP SSP berbeda dengan NPWP Pemotong
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-md row">
                                                <div class="col-md-2"></div>
                                                <label class="col-md-2" for="noBpe">NTPN</label>
                                                <div class="col-md-6">
                                                    <input id="noBpe" type="text" class="form-control" autocomplete="off"
                                                           name="noBpe"/>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group form-group-md row">
                                                <div class="col-md-2"></div>
                                                <label class="col-form-label col-md-2" for="thnPajakBpe">Tahun Pajak</label>
                                                <div class="col-md-4">
                                                    <select data-placeholder="Pilih Tahun Pajak"
                                                            class="form-control m-select2 djp-select2" id="thnPajakBpe"
                                                            name="thnPajakBpe">
                                                        <option></option>
                                                        <option value="2023">2023</option>
                                                        <option value="2022">2022</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="kt-align-center mt-1">
                                                <button id='btnSearchBpe' type="button"
                                                        class="btn btn-djp btn-elevate btn-pill">
                                                    <i class="fa fa-search"></i> Cek Surat Setoran Pajak
                                                </button>
                                            </div>
                                        </div>
                                        <div id="fgPbkPbe1Div">
                                            <div class="form-group form-group-md row">
                                                <div class="col-md-2"></div>
                                                <label class="col-md-2" for="npwpPbk">NPWP</label>
                                                <div class="col-md-6">
                                                    <input id="npwpPbk" type="text" class="form-control" autocomplete="off"
                                                           name="npwpPbk"/>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group form-group-md row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-6">
                                                    <div class="kt-checkbox-inline">
                                                        <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                                            <input type="checkbox" name="optPbk" value="1"/>
                                                            Centang jika NPWP PBK Terima berbeda dengan NPWP Pemotong
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-md row">
                                                <div class="col-md-2"></div>
                                                <label class="col-md-2" for="noPbk">Nomor Pemindahbukuan</label>
                                                <div class="col-md-6">
                                                    <input id="noPbk" type="text" class="form-control" autocomplete="off"
                                                           name="noPbk"/>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="kt-align-center mt-1">
                                                <button id='btnSearchPbk' type="button"
                                                        class="btn btn-djp btn-elevate btn-pill">
                                                    <i class="fa fa-search"></i> Cek Pemindahbukuan
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="kt-section">
                                    <div class="kt-section__content">
                                        <div class="form-group form-group-md row">
                                            <div class="col-md-2"></div>
                                            <label class="col-form-label col-md-2" for="thnPajak">Tahun Pajak</label>
                                            <div class="col-md-4">
                                                <input readonly id="thnPajak" type="text" class="form-control"
                                                       autocomplete="off" name="thnPajak"/>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div class="form-group form-group-md row">
                                            <div class="col-md-2"></div>
                                            <label class="col-form-label col-md-2" for="masaPajak">Masa Pajak</label>
                                            <div class="col-md-4">
                                                <input readonly id="masaPajak" type="text" class="form-control"
                                                       autocomplete="off"
                                                       name="masaPajak"/>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div class="form-group form-group-md row">
                                            <div class="col-md-2"></div>
                                            <label class="col-md-2" for="jnsPajak">Jenis Pajak (MAP)</label>
                                            <div class="col-md-4">
                                                <input readonly id="jnsPajak" type="text" class="form-control"
                                                       autocomplete="off"
                                                       name="jnsPajak" maxlength="6"/>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div class="form-group form-group-md row">
                                            <div class="col-md-2"></div>
                                            <label class="col-form-label col-md-2" for="jnsSetoran">Jenis Setoran</label>
                                            <div class="col-md-4">
                                                <input readonly id="jnsSetoran" type="text" class="form-control"
                                                       autocomplete="off"
                                                       name="jnsSetoran"/>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div class="form-group form-group-md row">
                                            <div class="col-md-2"></div>
                                            <label class="col-md-2" for="jmlSetor">Jumlah Setor (Rp)</label>
                                            <div class="col-md-4">
                                                <input readonly id="jmlSetor" type="text" class="form-control currency"
                                                       autocomplete="off"
                                                       name="jmlSetor"/>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div class="form-group form-group-md row">
                                            <div class="col-md-2"></div>
                                            <label class="col-form-label col-md-2" for="tglSetor">Tanggal Setor</label>
                                            <div class="col-md-4">
                                                <input readonly id="tglSetor" type="text" class="form-control"
                                                       autocomplete="off"
                                                       name="tglSetor"/>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button id='btnSubmit' type="submit" class="btn btn-djp btn-elevate btn-pill">
                            <i class="la la-save"></i> Simpan
                        </button>
                        <button id='btnReset' type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-elevate btn-pill">
                            <i class="fa fa-undo-alt"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--end::Modal-->
@stop
@section('js')

    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundlemin1.js') }}" type="text/javascript"></script>
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/jquery-validation/dist/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/jquery-validation/dist/localization/messages_id.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ url('assets/js/djpcommon.js') }}" type="text/javascript"></script>
    <script src="{{ url('disc/assets/js/custom/pages/payment.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/custom.js') }}" type="text/javascript"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection