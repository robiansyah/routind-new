@extends('layouts.user')

@section('title', 'Lapor')
@section('content')
<div class="row position-relative">
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
            <a class="btn btn-light font-weight-bold d-flex flex-djp w-10 border-menu-djp shadow" href="/lapor">
                <span class=""> 
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                    <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" id="check-path" fill="#000000"/>
                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" id="Combined-Shape" fill="#000000"/>
                    </g>
                    </svg>
                </span>
                <span class="">&nbsp; Pelaporan</span>
            </a>
            <a class="btn btn-light font-weight-bold d-flex flex-djp w-10 border-menu-djp shadow" href="/pralapor">
               <span class="">
                    <svg xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1"
                    class="kt-svg-icon kt-svg-icon--djp-yellow kt-svg-icon--lg">
                    <g stroke="none" stroke-width="1" fill="none"
                    fill-rule="evenodd">
                    <rect id="bound" x="0" y="0" width="24" height="24" />
                    <path
                            d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                            id="Combined-Shape" fill="#000000" opacity="0.3" />
                    <path
                            d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                            id="Combined-Shape" fill="#000000" />
                    <rect id="Rectangle-152" fill="#000000" opacity="0.3"
                        x="7" y="10" width="5" height="2" rx="1" />
                    <rect id="Rectangle-152-Copy" fill="#000000"
                        opacity="0.3" x="7" y="14" width="9" height="2" rx="1" />
                    </g>
                    </svg>
                </span>
                <span class="">&nbsp; Pra Pelaporan</span>
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
                    <p>
                        Menu Lapor dibedakan sub menu pelaporan dan pra pelaporan.
                    </p>
                    <p>
                        1. Sub menu pelaporan menampilkan aplikasi e-filing & e-form yang digunakan untuk menyampaikan SPT Tahunan secara elektronik serta e-spop yang digunakan untuk menyampaikan SPOP Tahunan secara elektronik. Pada sub menu ini juga terdapat riwayat pelaporan yang dibatasi untuk 3 tahun terakhir.
                    </p>
                    <p>
                        2. Sub menu pra pelaporan menampilkan aplikasi yang digunakan dalam pembuatan bukti pemotongan dan/atau pemungutan PPh sebelum melaporkan SPT. Pada sub menu ini juga terdapat riwayat pemotongan/pemungutan PPh yang dibatasi untuk 1 tahun terakhir.
                        Beberapa aplikasi mungkin belum diaktivasi sehingga tidak tampil pada halaman ini. Untuk mengaktivasinya silahkan klik link ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 halaman-utama">
        <div class="kt-portlet">
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
                    <h3 class="kt-portlet__head-title" style="color: white">
                        Pengisian SPT Secara Elektronik (e-Filing)
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <h6>Untuk pengisian SPT secara elektronik Anda dapat memilih cara berikut:</h6>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="ml-3 text-dark font-weight-bold">&bull; Mengunduh Formulir</h5>
                        <div style="overflow-x: auto; overflow-y: hidden; white-space: nowrap;">
                            <div style="width: max-content">
                                <div class="card mr-3 mb-3 d-inline-flex" style="width: 250px">
                                    <div class="card-body">
                                        <a href="#">
                                            <img class="card-img card-img-djp" alt="e-Form PDF" src="/assets/media/logos/logo_eformpdf.png"/>
                                        </a>
                                        <h6 class="card-title mt-2 mb-0 text-center app-nama">e-Form PDF</h6>
                                        <input type="hidden" class="app-faq" value="https://www.pajak.go.id/laman-e-form-pdf"/>
                                        <input type="hidden" class="app-deskripsi" value="Formulir SPT Elektronik versi terbaru dalam format dokumen portabel (PDF). Mudah pengisiannya tanpa terhubung ke internet. Biasakan dengan yang baru, mulai dari sekarang."/>
                                        <a href="#" class="kt-badge kt-badge--warning position-absolute app-info" style="right: 5px; bottom: 5px;"
                                        data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="informasi">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="ml-3 text-dark font-weight-bold">&bull; Mengisi Langsung di Situs Web</h5>
                        <div style="overflow-x: auto; overflow-y: hidden; white-space: nowrap;">
                            <div style="width: max-content">
                                <div class="card mr-3 mb-3 d-inline-flex" style="width: 250px">
                                    <div class="card-body">
                                        <a href="/spt/arsip">
                                            <img class="card-img card-img-djp" alt="e-Filing" src="/assets/media/logos/logo_efiling.png"/>
                                        </a>
                                        <h6 class="card-title mt-2 mb-0 text-center app-nama">e-Filing</h6>
                                        <input type="hidden" class="app-faq" value="https://www.pajak.go.id/id/penanganan-kode-error-e-filing"/>
                                        <input type="hidden" class="app-deskripsi" value="Sampaikan SPT Tahunanmu secara online dengan mudah, cepat, dan aman. Pastikan juga jaringan internet tidak terputus."/>
                                        <a href="#" class="kt-badge kt-badge--warning position-absolute app-info" style="right: 5px; bottom: 5px;"
                                        data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="informasi">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card mr-3 mb-3 d-inline-flex" style="width: 250px">
                                    <div class="card-body">
                                        <a href="#">
                                            <img class="card-img card-img-djp" alt="SPT Masa Pemungut Bea Meterai" src="/assets/media/logos/logo_sptbea.png"/>
                                        </a>
                                        <h6 class="card-title mt-2 mb-0 text-center app-nama">SPT Masa Pemungut Bea Meterai</h6>
                                        <input type="hidden" class="app-faq" value="https://pajak.go.id/id/faq-laporan-tahunan"/>
                                        <input type="hidden" class="app-deskripsi" value="Aplikasi Pelaporan SPT Masa Pemungut Bea Meterai."/>
                                        <a href="#" class="kt-badge kt-badge--warning position-absolute app-info" style="right: 5px; bottom: 5px;"
                                        data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="informasi">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet">
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
                    <h3 class="kt-portlet__head-title" style="color: white">Daftar Aplikasi Lapor Lainnya
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <div class="row">
                    <h4 class="text-center">Tidak terdapat aplikasi lapor lainnya yang dapat anda gunakan. Tekan tombol dibawah untuk mengaktifkan fitur aplikasi yang tersedia</h4>
                    <div class="col-md-12 kt-space-20"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <a class="btn btn-djp btn-elevated btn-pill" href="/profil/hakakses" style="width: inherit;">Aktivasi Fitur Layanan</a>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>

        <div class="alert alert-elevate alert-light alert-bold" role="alert"
        style="border: 2px solid #F04DBA ;box-shadow: 0 0 0 rgba(204,169,44, 0.4); animation: pulse 1s infinite;">
            <div class="alert-text text-center kt-font-bolder">"Apabila terdapat data yang tidak sesuai, silakan menghubungi
            KPP Administrasi atau Kring Pajak 1500200"
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__head" style="background: #9658DD;">
                <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon" style="color: white;">
                                <i class="flaticon2-checking"></i>
                            </span>
                    <h3 class="kt-portlet__head-title" style="color: white;">Riwayat Pelaporan</h3>
                </div>
                <div class="kt-portlet__head-label"></div>
            </div>
        <div class="kt-portlet__body">

            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-djp" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_tabs_spt" role="tab">
                        <i class="flaticon2-file" aria-hidden="true"></i>SPT
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tabs_espop" role="tab">
                        <i class="flaticon2-file" aria-hidden="true"></i>ESPOP
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="kt_tabs_spt" role="tabpanel">
                    <div class="table-responsive position-relative">
                        <table class="table table-djp table-striped table-hover" id="tbl_spt_ws">
                            <thead>
                            <tr>
                                <th class="text-center" >Jenis SPT</th>
                                <th class="text-center" width="20%">Tahun/Masa Pajak</th>
                                <th class="text-center" width="20%">Pembetulan ke</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="5%">Aksi</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="kt_tabs_espop" role="tabpanel">
                    <div class="table-responsive position-relative">
                        <table class="table table-djp table-striped table-hover" id="tbl_espop_ws">
                            <thead>
                            <tr>
                                <th class="text-center">Nomor BPS</th>
                                <th class="text-center" width="20%">Tahun Pajak</th>
                                <th class="text-center" width="20%">Tanggal Diterima</th>
                                <th class="text-center" width="5%">Aksi</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_lapor" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pelaporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
    </div>
    <form id="form_lapor" name="form_lapor" action="#" method="post">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="masaPajak" class="col-form-label">Masa Pajak:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="masaPajak" id="masaPajak" class="form-control"
                                   disabled="disabled" value=""/>
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-calendar-week"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tahunPajak" class="col-form-label">Tahun Pajak:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="tahunPajak" id="tahunPajak" class="form-control"
                                   disabled="disabled" value=""/>
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-calendar-alt"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pembetulan" class="col-form-label">Pembetulan:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="pembetulan" id="pembetulan" class="form-control"
                                   disabled="disabled" value="">
                            <span class="kt-input-icon__icon"><span><i class="fa fa-pencil-alt"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="noBPE" class="col-form-label">Nomor BPE:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="noBPE" id="noBPE" class="form-control"
                                   disabled="disabled" value="">
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-file-invoice"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggalBPE" class="col-form-label">Tanggal BPE:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="tanggalBPE" id="tanggalBPE" class="form-control"
                                   disabled="disabled" value="">
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-calendar-day"></i></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenisSPT" class="col-form-label">Jenis SPT:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="jenisSPT" id="jenisSPT" class="form-control"
                                   disabled="disabled" value="">
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-clipboard-list"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="statusSPT" class="col-form-label">Status SPT:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="statusSPT" id="statusSPT" class="form-control"
                                   disabled="disabled" value="">
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-file-contract"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nilaiSPT" class="col-form-label">Nilai SPT:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="nilaiSPT" id="nilaiSPT" class="form-control"
                                   disabled="disabled" value="">
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-money-bill-wave"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tglLapor" class="col-form-label">Tanggal SPT:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" name="tglLapor" id="tglLapor" class="form-control"
                                   disabled="disabled" value="">
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-calendar-day"></i></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>

<div class="modal fade" id="modal_espop" tabindex="-1" role="dialog"
aria-labelledby="espopModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="espopModalLabel">Detail eSPOP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
    </div>
    <form id="form_espop" action="#" method="post">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="noDokumenEspop" class="col-form-label">No BPS:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" id="noDokumenEspop" class="form-control"
                                   disabled="disabled" value=""/>
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-file-invoice"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tglDiterima" class="col-form-label">Tanggal Diterima:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" id="tglDiterima" class="form-control"
                                   disabled="disabled" value=""/>
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-calendar-day"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jnsTrx" class="col-form-label">Jenis Transaksi:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" id="jnsTrx" class="form-control"
                                   disabled="disabled" value=""/>
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-clipboard-list"></i></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sektor" class="col-form-label">Sektor:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" id="sektor" class="form-control"
                                   disabled="disabled" value=""/>
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-globe-asia"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subsektor" class="col-form-label">Sub Sektor:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" id="subsektor" class="form-control"
                                   disabled="disabled" value=""/>
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-globe"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tahunPajakEspop" class="col-form-label">Tahun Pajak:</label>
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" id="tahunPajakEspop" class="form-control"
                                   disabled="disabled" value=""/>
                            <span class="kt-input-icon__icon"><span><i
                                    class="fa fa-calendar-alt"></i></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('js')

<script src="{{ url('assets/js/page/riwayat-lapor.js') }}" type="text/javascript" ></script>

<script src="{{ url('assets/js/app.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/page/djpcommon.js') }}" type="text/javascript"></script>
@endsection