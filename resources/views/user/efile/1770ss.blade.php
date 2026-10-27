@extends('layouts.user')

@section('title', 'Lapor')
@section('css')
    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ url('/assets/css/djp/pages/custom/general/wizard/wizard-4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles -->
    <meta name="_token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid"
         style="padding: 20px; background: #EBECF1; margin-bottom: 40px; border-radius: 0 8px 8px 8px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .2), 0 3px 10px 0 rgba(0, 0, 0, .19);">
        <!--Begin::Isi Konten-->
        <input type="text" value="ae1962be-8c60-4eb7-ab57-f95e1cd0d424" name="ac" id="ac" class="form-control"
               style="display: none"/>

        <!--Begin::Section-->
        <div class="row" style="position: relative">
            <button type="button" id="btn_show_help" class="btn btn-warning btn-lg"
                    style="color: white; font-weight: 600">
                Petunjuk Pengisian &nbsp;&nbsp;&nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                        <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                              id="Path-94" fill="#000000" fill-rule="nonzero"
                              transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999) "/>
                    </g>
                </svg>
            </button>
            <div class="col-md-12 petunjuk help-hide">
                <div class="kt-portlet kt-portlet--head-sm ">
                    <div class="kt-portlet__head" style="background: #F04DBA;">
                        <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         class="kt-svg-icon kt-svg-icon--light">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z"
                                                  id="Combined-Shape" fill="#000000"/>
                                            <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z"
                                                  id="Path-41-Copy" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                            <h3 class="kt-portlet__head-title" style="color: white; font-size: 1rem;">Petunjuk
                                Pengisian</h3>
                        </div>
                        <div class="kt-portlet__head-label">
                            <div class="kt-align-right">
                                <button id="btn_collapse_help" class="btn btn-warning  btn-sm btn-icon btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         class="kt-svg-icon kt-svg-icon--light">
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
                        <div class="kt-scroll" data-scroll="true" data-height="330" data-scrollbar-shown="true">
                            <div class="petunjuk-wizard show">
                                <p><strong>Persiapkan seluruh dokumen terkait pengisian SPT (Daftar Penghasilan, Bukti
                                        Potong, Daftar Harta, Daftar Kewajiban dan Daftar Keluarga)</strong></p>
                                <p><strong>Langkah I</strong></p>
                                <p><strong>Tahun Pajak</strong> adalah tahun diterima/diperolehnya penghasilan, pilih
                                    sesuai tahun penghasilan</p>
                                <p><strong>Status SPT Normal</strong> adalah Jika Anda menyampaikan SPT untuk <strong>
                                        kali pertama </strong> untuk tahun pajak tertentu. Jika Anda memilih normal,
                                    nilai pembetulan ke akan terisi otomatis dengan angka nol(0) dan tdk dapat diubah
                                </p>
                                <p><strong>Status SPT Pembetulan</strong> adalah Jika Anda menyampaikan SPT untuk
                                    membetulkan SPT yang dilaporkan sebelumnya. Jika Anda memilih pembetulan,
                                    <strong>Isikan nilai pembetulan ke- berapa</strong> SPT Anda pada kotak isian
                                    pembetulan dan pastikan bahwa SPT sebelumnya telah Anda Kirimkan ke Direktorat
                                    Jenderal Pajak </p>
                            </div>
                            <div class="petunjuk-wizard">
                                <p><strong>Persiapkan seluruh dokumen terkait pengisian SPT (Daftar Penghasilan, Bukti
                                        Potong, Daftar Harta, Daftar Kewajiban dan Daftar Keluarga)</strong></p>
                                <p><strong>Langkah II</strong></p>
                                <p><strong>Bagian A</strong></p>
                                <ul style="padding-inline-start: 20px; font-weight: 600">
                                    <li><strong>Nomor 1</strong> diisi dari bukti pemotongan PPh 1721-A1 angka 9 atau
                                        1721-A2 angka 10 dan/atau bukti pemotongan 1721 VI kolom 2 dan/atau Bukti
                                        Pemotongan Tidak Final lainnya
                                    </li>
                                    <li><strong>Nomor 2</strong> diisi dari bukti pemotongan PPh 1721-A1 angka 22,
                                        1721-A2 angka 19
                                    </li>
                                    <li><strong>Nomor 3</strong> diisi dengan jumlah PTKP yang tercantum pada bukti
                                        pemotongan PPh 1721-A1 angka 17 atau 1721-A2 angka 16
                                    </li>
                                    <li><strong>Nomor 4</strong> adalah hasil perhitungan nomor 1-2-3. Untuk keperluan
                                        penghitungan tarif pajak, jumlah penghasilan kena pajak dibulatkan ke bawah
                                        dalam ribuan rupiah penuh
                                    </li>
                                    <li><strong>Nomor 6</strong> diisi dengan jumlah Pajak Penghasilan yang sudah
                                        dipotong yang tercantum pada bukti pemotongan PPh 1721-A1 angka 22, 1721-A2
                                        angka 19 dan/atau bukti pemotongan PPh Pasal 21 (yang tidak bersifat final),
                                        dan/atau bukti pemotongan 1721 VI kolom 2 dan/atau Bukti Pemotongan Tidak Final
                                        lainnya
                                    </li>
                                </ul>
                                <p><strong>Bagian Pembayaran</strong></p>
                                <ul style="padding-inline-start: 20px; font-weight: 600">
                                    <li>Apabila berdasar hitungan sistem, status SPT Anda Kurang Bayar, sistem akan
                                        menampilkan panel pembayaran
                                    </li>
                                    <li>Apabila Anda sudah melakukan pembayaran atas kekurangan pembayaran pajak, pilih
                                        <strong>Sudah</strong>, dan masukkan daftar NTPN dari Bukti Penerimaan Negara
                                        yang Anda miliki dan/atau Nomor Pemindahbukuan dari KPP terdaftar. NTPN dan
                                        Nomor Pemindahbukuan yang dapat diinputkan adalah nomor dengan Kode Map PPh
                                        Pasal 25/29 OP (411125) dan Kode Jenis Setoran Tahunan (200)
                                    </li>
                                    <li>Apabila Anda belum melakukan pembayaran, sistem ini memberikan layanan pembuatan
                                        <strong>Kode Billing</strong>, yang dapat Anda gunakan untuk melakukan
                                        pembayaran di Bank baik secara online (internet banking) atau datang langsung ke
                                        Bank
                                    </li>
                                    <li>Apabila Anda belum aktif sebagai pengguna eBilling di DJP Online, aktifkan
                                        terlebih dahulu
                                    </li>
                                </ul>
                                <p><strong>Bagian Unggah Lampiran</strong></p>
                                <ul style="padding-inline-start: 20px; font-weight: 600">
                                    <li>Apabila berdasar hitungan sistem, status SPT Anda Lebih Bayar, sistem akan
                                        menampilkan panel unggah lampiran
                                    </li>
                                    <li>Unggah lampiran Anda dengan dokumen berekstensi .pdf dengan cara klik tombol
                                        "Browse File...pdf", kemudian pilih dokumen yang akan dijadikan lampiran SPT
                                        Anda
                                    </li>
                                </ul>
                                <p><strong>Bagian B</strong></p>
                                <ul style="padding-inline-start: 20px; font-weight: 600">
                                    <li><strong>Nomor 8</strong>, Jenis-jenis penghasilan yang dikenakan PPh final
                                        meliputi bunga deposito dan tabungan, hadiah undian, penghasilan dari honorarium
                                        atas beban APBN/APBD, uang pesangon, uang manfaat pensiun, tunjangan hari tua,
                                        dan jaminan hari tua yang dibayarkan sekaligus, penghasilan dari pengalihan hak
                                        atas tanah dan/atau bangunan, penghasilan dari persewaan atas tanah dan/atau
                                        bangunan, bunga simpanan yang dibayarkan oleh koperasi kepada anggota koperasi,
                                        dividen, penghasilan isteri dari satu pemberi kerja, penghasilan penjualan saham
                                        yang diperdagangkan di bursa efek
                                    </li>
                                    <li><strong>Nomor 10</strong>, Jenis-jenis penghasilan yang dikecualikan dari objek
                                        pajak meliputi bantuan/sumbangan/hibah, warisan, bagian laba yang diterima atau
                                        diperoleh anggota dari perseroan komanditer yang modalnya tidak terbagi atas
                                        saham-saham, persekutuan, perkumpulan, firma, dan kongsi, termasuk pemegang unit
                                        penyertaan kontrak investasi kolektif, penggantian atau santunan asuransi
                                        kesehatan, kecelakaan, jiwa, dwiguna, beasiswa, penggantian atau imbalan dalam
                                        bentuk natura atau kenikmatan, beasiswa
                                    </li>
                                </ul>
                                <p><strong>Bagian C</strong></p>
                                <ul style="padding-inline-start: 20px; font-weight: 600">
                                    <li><strong>Nomor 11</strong>, diisi dengan jumlah nilai perolehan dari seluruh
                                        harta yang dimiliki/dikuasai Wajib Pajak dan anggota keluarganya sesuai dengan
                                        ketentuan perundang-undangan perpajakan yang berlaku. Contoh : rumah, kendaraan
                                        bermotor, kebun, sawah, deposito, tabungan dan lain-lain
                                    </li>
                                    <li><strong>Nomor 12</strong>, diisi dengan jumlah seluruh utang yang
                                        diperoleh/dimiliki Wajib Pajak dan anggota keluarganya, termasuk utang bunga.
                                        Contoh: pinjaman bank atau koperasi
                                    </li>
                                </ul>
                            </div>
                            <div class="petunjuk-wizard">
                                <p><strong>Persiapkan seluruh dokumen terkait pengisian SPT (Daftar Penghasilan, Bukti
                                        Potong, Daftar Harta, Daftar Kewajiban dan Daftar Keluarga)</strong></p>
                                <p><strong>Langkah III</strong></p>
                                <ol style="padding-inline-start: 20px; font-weight: 600">
                                    <li>Pastikan isian SPT Anda benar dengan memeriksa informasi ringkas SPT Anda pada
                                        tahap ini
                                    </li>
                                    <li>Untuk melakukan pengiriman SPT (Submit), Anda diminta untuk mengisikan Kode
                                        Verifikasi
                                    </li>
                                    <li>Kode verifikasi dapat Anda minta dengan klik link ambil kode verifikasi di bawah
                                        kotak isian kode verifikasi
                                    </li>
                                    <li>Jika Anda telah menerima pesan kode verifikasi, gunakan kode tersebut untuk
                                        submit
                                    </li>
                                    <li>Pada akhir proses, Anda akan diminta untuk memilih pilihan survei kepuasan yang
                                        disediakan
                                    </li>
                                </ol>
                                <p>Apabila Anda tidak menghendaki seketika mengirim SPT ini, Anda dapat melakukannya
                                    terpisah melalui menu Kirim SPT</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 halaman-utama">
                <div class="kt-wizard-v4" id="frmInduk1770ss" data-ktwizard-state="step-first">
                    <!--end: Form Wizard Nav -->
                    <form class="kt-form" id="frm1770ss">
                        <div class="kt-portlet kt-portlet--head-sm">
                            <div class="kt-portlet__head" style="background: #9658DD;">
                                <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon" style="color: white">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1"
                                                 class="kt-svg-icon kt-svg-icon--light">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                                          id="Combined-Shape" fill="#000000" fill-rule="nonzero"
                                                          opacity="0.3"/>
                                                    <rect id="Rectangle" fill="#000000" x="6" y="11" width="9"
                                                          height="2" rx="1"/>
                                                    <rect id="Rectangle-Copy" fill="#000000" x="6" y="15" width="5"
                                                          height="2" rx="1"/>
                                                </g>
                                            </svg>
                                        </span>
                                    <h3 class="kt-portlet__head-title" style="color: white"> SPT 1770 SS </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-wizard-v4__nav">
                                    <div class="kt-wizard-v4__nav-items">
                                        <a class="kt-wizard-v4__nav-item kt-align-left" href="javascript:;"
                                           data-ktwizard-type="step" data-ktwizard-state="current">
                                            <div class="kt-heading kt-heading--lg kt-heading--space-sm">Isi Data
                                                Formulir
                                            </div>
                                        </a>
                                        <a class="kt-wizard-v4__nav-item kt-align-left" href="javascript:;"
                                           data-ktwizard-type="step">
                                            <div class="kt-heading kt-heading--lg kt-heading--space-sm">Isi SPT</div>
                                        </a>
                                        <a class="kt-wizard-v4__nav-item kt-align-left" href="javascript:;"
                                           data-ktwizard-type="step">
                                            <div class="kt-heading kt-heading--lg kt-heading--space-sm">Kirim SPT</div>
                                        </a>
                                    </div>
                                </div>
                                <div class="kt-space-10"></div>
                                <div class="progress progress-lg progress-djp">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated lg bg-warning"
                                         role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                                <div class="kt-space-10"></div>

                                <h6 class="pagging-djp">Langkah ke 0 dari 0</h6>
                                <div class="kt-separator kt-separator--space-sm kt-separator--border-dashed"></div>

                                <!--begin: Form Wizard Form-->

                                <!--begin: Form Wizard Step 1-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                     data-ktwizard-state="current" id="tab1">
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="accordion accordion-solid  accordion-toggle-arrow"
                                             id="accordionExample2a">
                                            <!--begin::Accordion-->
                                            <div class="kt-section">
                                                <div class="kt-section__title">
                                                    <h5>Data Formulir</h5>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label for="ThnPajak" class="col-md-3 col-form-label">Tahun
                                                        Pajak</label>
                                                    <div class="col-md-5">
                                                        <select id="thnPajak" name="thnPajak"
                                                                class="form-control select2me" required=""
                                                                aria-required="true" aria-invalid="false"
                                                                aria-describedby="thnPajak-error">
                                                            <option value="">Pilih Tahun Pajak</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2013">2013</option>
                                                        </select>
                                                        <span id="thnPajak-error"
                                                              class="help-block help-block-error valid"
                                                              style="display: none;"></span>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <div class="form-group row my-2" id="divStatusSpt">
                                                    <div class="col-md-2"></div>
                                                    <label class="col-form-label col-md-3">Status SPT</label>
                                                    <div class="col-md-5">
                                                        <div class="kt-radio-list">
                                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                <input type="radio" name="rbrev" id="rbr1" value="1">Normal</input>
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                <input type="radio" name="rbrev" id="rbr2" value="2">Pembetulan</input>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3"></div>
                                                </div>
                                                <div id="pnlPembetulan" class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label class="col-form-label col-md-3">Pembetulan Ke</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="txtPembetulanKe" name="txtPembetulanKe"
                                                               class="form-control form-control-sm"
                                                               style="text-align: right" readonly
                                                               aria-describedby="txtPembetulanKe">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Accordion-->
                                    </div>
                                </div>
                                <!--end: Form Wizard Step 1-->

                                <!--begin: Form Wizard Step 2-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" id="tab2">
                                    <div class="kt-form__section kt-form__section--first">
                                        <div style="border-style:solid; border-width:1px; border-color: #F04DBA; padding: 7px; text-align: center; color: #9658DD; font-weight: 600; box-shadow: 0 0 0 rgba(204,169,44, 0.4); animation: pulse 1s infinite; outline-offset: 10px;">
                                            <p style="padding-top:11px;"><strong>Sesuai Dengan Prinsip <i>Self
                                                        Assessment</i>, Isi SPT Tahunan Merupakan Tanggung Jawab Wajib
                                                    Pajak</strong></p>
                                        </div>
                                        <div class="kt-space-20"></div>
                                        <!--begin::Accordion-->
                                        <div class="accordion accordion-solid  accordion-toggle-arrow" id="acc1">
                                            <div class="card">
                                                <div class="card-header" id="headingOne2a">
                                                    <a href="#acc11" class="card-title" data-toggle="collapse"
                                                       aria-expanded="true" aria-controls="acc11">A. Pajak
                                                        Penghasilan </a>
                                                </div>
                                                <div id="acc11" class="collapse show" aria-labelledby="headingOne2a"
                                                     data-parent="#acc1" style="">
                                                    <div class="card-body">
                                                        <div class="kt-section">
                                                            <div class="kt-section__content">
                                                                <table class="table table-striped table-hover table-bordered mobile-djp">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">1
                                                                        </td>
                                                                        <td colspan="2" style="width: 35%">Penghasilan
                                                                            Bruto Dalam Negeri Sehubungan Dengan
                                                                            Pekerjaan dan Penghasilan Neto Dalam Negeri
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagA1"
                                                                                   name="txtBagA1"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right"
                                                                                   onblur="spt1770ss.cekBruto(); spt1770ss.hitungPph();">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">2
                                                                        </td>
                                                                        <td colspan="2" style="width: 35%">Pengurangan
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagA2"
                                                                                   name="txtBagA2"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right"
                                                                                   onblur="spt1770ss.hitungPph();">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">3
                                                                        </td>
                                                                        <td style="width: 25%">Penghasilan Tidak Kena
                                                                            Pajak
                                                                        </td>
                                                                        <td class="special-td" style="width: 45%">
                                                                            <select class="form-control form-control-sm select2me"
                                                                                    id="ddlPtkp" name="ddlPtkp">
                                                                                <option value="">Pilih...</option>
                                                                                <option value="00">TK/0 Tidak Kawin
                                                                                    Tidak Ada Tanggungan
                                                                                </option>
                                                                                <option value="01">TK/1 Tidak Kawin
                                                                                    Tanggungan 1 Orang
                                                                                </option>
                                                                                <option value="02">TK/2 Tidak Kawin
                                                                                    Tanggungan 2 Orang
                                                                                </option>
                                                                                <option value="03">TK/3 Tidak Kawin
                                                                                    Tanggungan 3 Orang
                                                                                </option>
                                                                                <option value="10">K/0 Kawin Tidak Ada
                                                                                    Tanggungan
                                                                                </option>
                                                                                <option value="11">K/1 Kawin Tanggungan
                                                                                    1 Orang
                                                                                </option>
                                                                                <option value="12">K/2 Kawin Tanggungan
                                                                                    2 Orang
                                                                                </option>
                                                                                <option value="13">K/3 Kawin Tanggungan
                                                                                    3 Orang
                                                                                </option>
                                                                                <option value="20">K/I/0 Kawin
                                                                                    Penghasilan Istri Digabung Tidak Ada
                                                                                    Tanggungan
                                                                                </option>
                                                                                <option value="21">K/I/1 Kawin
                                                                                    Penghasilan Istri Digabung
                                                                                    Tanggungan 1 Orang
                                                                                </option>
                                                                                <option value="22">K/I/2 Kawin
                                                                                    Penghasilan Istri Digabung
                                                                                    Tanggungan 2 Orang
                                                                                </option>
                                                                                <option value="23">K/I/3 Kawin
                                                                                    Penghasilan Istri Digabung
                                                                                    Tanggungan 3 Orang
                                                                                </option>
                                                                            </select>
                                                                            <span id="ddlPtkp-error"
                                                                                  class="help-block help-block-error valid"
                                                                                  style="display: none;"></span>
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagA3" readonly
                                                                                   name="txtBagA3"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">4
                                                                        </td>
                                                                        <td colspan="2" style="width: 35%">Penghasilan
                                                                            Kena Pajak
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagA4" readonly
                                                                                   name="txtBagA4"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">5
                                                                        </td>
                                                                        <td colspan="2" style="width: 35%;">Pajak
                                                                            Penghasilan Terutang
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagA5" readonly
                                                                                   name="txtBagA5"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">6
                                                                        </td>
                                                                        <td colspan="2" style="width: 35%;">Pajak
                                                                            Penghasilan yang telah dipotong oleh pihak
                                                                            lain
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagA6"
                                                                                   name="txtBagA6"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right"
                                                                                   onblur="spt1770ss.hitungPph();">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">7
                                                                        </td>
                                                                        <td colspan="2" style="width: 35%;"
                                                                            id="lblLbkbn">Kurang Bayar
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagA7" readonly
                                                                                   name="txtBagA7"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="kt-section__content">
                                                                    <!--begin::Portlet Kurang Bayar-->
                                                                    <div class="kt-portlet kt-portlet--bordered"
                                                                         id="panelPembayaran"
                                                                         style="border-color:#F04DBA;">
                                                                        <div class="kt-portlet__head"
                                                                             style="background: #F04DBA;">
                                                                            <div class="kt-portlet__head-label">
                                                                                <h5 class="kt-portlet__head-title"
                                                                                    style="color:white">
                                                                                    Status SPT Anda adalah Kurang Bayar,
                                                                                    sudahkah Anda melakukan pembayaran?
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-portlet__body">
                                                                            <div class="col-md-12">
                                                                                <div class="radio-list">
                                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                        <input type="radio"
                                                                                               name="rdBayar" id="rb1"
                                                                                               value="1">
                                                                                        <strong>Belum</strong>, <i>Saya
                                                                                            akan membuat kode billing
                                                                                            untuk melakukan
                                                                                            pembayaran</i>
                                                                                        <span></span>
                                                                                    </label>
                                                                                    <br/>
                                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                        <input type="radio"
                                                                                               name="rdBayar" id="rb2"
                                                                                               value="2">
                                                                                        <strong>Sudah</strong>, <i>Saya
                                                                                            sudah melakukan
                                                                                            pembayaran</i>
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>

                                                                            <table class="table table-striped table-hover table-bordered"
                                                                                   id="tblPembayaran" width="100%">
                                                                                <tbody>
                                                                                <tr id="barisCreateBilling"
                                                                                    class="special-tr">
                                                                                    <td style="width: 5%; text-align: center"></td>
                                                                                    <td colspan="2" style="width: 65%;">
                                                                                        Buat kode billing pembayaran
                                                                                        pajak
                                                                                    </td>
                                                                                    <td class="special-td"
                                                                                        style="width: 30%;">
                                                                                        <button type="button"
                                                                                                id="btnBilling"
                                                                                                class="btn btn-djp btn-elevate btn-pill">
                                                                                            <i class="fa fa-money-bill-alt"></i>
                                                                                            Buat Kode Billing
                                                                                        </button>
                                                                                        <span class="help-block"></span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr id="barisKodeBilling"
                                                                                    style="display: none"
                                                                                    class="special-tr">
                                                                                    <td style="width: 5%; text-align: center"></td>
                                                                                    <td colspan="2" style="width: 65%;">
                                                                                        <strong>Kode Billing ini bukan
                                                                                            kode pembayaran</strong>.
                                                                                        silakan gunakan Kode Billing ini
                                                                                        saat melakukan pembayaran pajak
                                                                                        melalui Bank/Pos Persepsi
                                                                                    </td>
                                                                                    <td class="special-td"
                                                                                        style="width: 30%;">
                                                                                        <input type="text"
                                                                                               class="form-control form-control-sm"
                                                                                               readonly
                                                                                               id="txtKodeBilling"/>
                                                                                        <span class="help-block"></span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr id="barisKodeBillingExpDate"
                                                                                    style="display: none"
                                                                                    class="special-tr">
                                                                                    <td style="width: 5%; text-align: center"></td>
                                                                                    <td colspan="2" style="width: 65%;">
                                                                                        <strong>Silakan membayar pajak
                                                                                            melalui Bank/Pos Persepsi
                                                                                            sebelum</strong></td>
                                                                                    <td class="special-td"
                                                                                        style="width: 30%;">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               readonly
                                                                                               id="txtKodeBillingExpDate"/>
                                                                                        <span class="help-block"></span>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>

                                                                            <div class="form-group" id="formTblByr">
                                                                                <div class="col-md-12">
                                                                                    <div class="kt-align-right">
                                                                                        <div class="btn-group">
                                                                                            <button id="buktiBayar_new"
                                                                                                    class="btn btn-djp btn-elevate btn-pill">
                                                                                                Tambah <i
                                                                                                        class="flaticon2-add-1"></i>
                                                                                                <span class="help-block"></span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-djp table-md table-striped table-hover"
                                                                                               id="tblJnsPembayaran"
                                                                                               width="100%"
                                                                                               style="display: table; width: 100%;"
                                                                                               role="grid"
                                                                                               aria-describedby="tblJnsPembayaran_info">
                                                                                            <thead>
                                                                                            <tr>
                                                                                                <th style="text-align: center; vertical-align: top;"
                                                                                                    width="20%">Jenis
                                                                                                    Pembayaran
                                                                                                </th>
                                                                                                <th style="text-align: center; vertical-align: top;"
                                                                                                    width="30%">
                                                                                                    NTPN/Nomor
                                                                                                    Pemindahbukuan
                                                                                                </th>
                                                                                                <th style="text-align: center; vertical-align: top;"
                                                                                                    width="15%">Tanggal
                                                                                                    Pembayaran
                                                                                                </th>
                                                                                                <th style="text-align: center; vertical-align: top;"
                                                                                                    width="20%">Jumlah
                                                                                                </th>
                                                                                                <th style="text-align: center; vertical-align: top;"
                                                                                                    width="15%">Aksi
                                                                                                </th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                            </tbody>
                                                                                            <tfoot>
                                                                                            <tr>
                                                                                                <td colspan="3"
                                                                                                    style="font-weight: bold; text-align: right;">
                                                                                                    Jumlah
                                                                                                </td>
                                                                                                <td style="text-align: center; vertical-align: top;"
                                                                                                    width="20%">
                                                                                                    <input class="form-control form-control-sm uang"
                                                                                                           type="text"
                                                                                                           readonly
                                                                                                           id="txtJmlNtpnPbk"/>
                                                                                                </td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            </tfoot>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--Modal tombol tambah (awal)-->
                                                                            <div class="modal fade show"
                                                                                 id="divJnsPembayaran"
                                                                                 data-keyboard="false"
                                                                                 data-backdrop="static" tabindex="-1"
                                                                                 role="dialog"
                                                                                 aria-labelledby="exampleModalLabel"
                                                                                 style="padding-right: 12px; display: none;"
                                                                                 aria-modal="true">
                                                                                <div class="modal-dialog modal-md"
                                                                                     role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                Bukti Pembayaran Baru</h5>
                                                                                            <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form>
                                                                                                <div class="form-group row my-2">
                                                                                                    <div class="col-md-1"></div>
                                                                                                    <label class="col-form-label col-md-4">Jenis Pembayaran
                                                                                                        <span class="required" aria-required="true"> *</span></label>
                                                                                                    <div class="col-md-6">
                                                                                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                                            <input type="radio"
                                                                                                                   name="rbPbyrn"
                                                                                                                   id="rbByr1"
                                                                                                                   value="1">
                                                                                                            NTPN
                                                                                                            <span></span>
                                                                                                        </label>
                                                                                                        <br>
                                                                                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                                            <input type="radio"
                                                                                                                   name="rbPbyrn"
                                                                                                                   id="rbByr2"
                                                                                                                   value="2">
                                                                                                            Pemindahbukuan
                                                                                                            <span></span>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <div class="col-md-1"></div>
                                                                                                    <label class="col-form-label col-md-4">NTPN/Nomor
                                                                                                        Pbk<span
                                                                                                                class="required"
                                                                                                                aria-required="true"> *</span></label>
                                                                                                    <div class="col-md-6">
                                                                                                        <input type="text"
                                                                                                               id="pbyrnNomor"
                                                                                                               class="form-control form-control-sm"
                                                                                                               maxlength="100"
                                                                                                               style="text-align: left"
                                                                                                               placeholder="">
                                                                                                        <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <div class="col-md-1"></div>
                                                                                                    <label class="col-form-label col-md-4">Tanggal
                                                                                                        Pembayaran</label>
                                                                                                    <div class="col-md-6">
                                                                                                        <input type="text"
                                                                                                               id="pbyrnTglBuktiByr"
                                                                                                               class="form-control form-control-sm"
                                                                                                               readonly="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <div class="col-md-1"></div>
                                                                                                    <label class="col-form-label col-md-4">Jumlah</label>
                                                                                                    <div class="col-md-6">
                                                                                                        <input type="text"
                                                                                                               id="pbyrnJml"
                                                                                                               class="form-control form-control-sm uang"
                                                                                                               readonly="">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                    id="btnAddBuktiBayar"
                                                                                                    class="btn btn-djp btn-elevate btn-pill">
                                                                                                <i class="fa fa-save"></i>Simpan
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                    class="btn btn-secondary btn-elevate btn-pill"
                                                                                                    data-dismiss="modal">
                                                                                                Batal
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--Modal tombol tambah (tutup)-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Portlet Kurang Bayar-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="kt-align-right">
                                                            <button class="btn btn-djp btn-elevate btn-pill"
                                                                    style="margin: auto 0 auto auto"
                                                                    data-toggle="collapse" data-parent="#acc1"
                                                                    data-target="#acc12">
                                                                Berikutnya <i class="fa fa-chevron-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo2a">
                                                    <a href="#acc12" class="card-title collapsed" data-toggle="collapse"
                                                       aria-expanded="false" aria-controls="acc12">B. Penghasilan yang
                                                        dikenakan PPh Final dan yang dikecualikan dari Objek Pajak</a>
                                                </div>
                                                <div id="acc12" class="collapse" aria-labelledby="headingTwo2a"
                                                     data-parent="#acc1">
                                                    <div class="card-body">
                                                        <div class="kt-section">
                                                            <div class="kt-section__content">
                                                                <table class="table table-striped table-hover table-bordered mobile-djp">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">8
                                                                        </td>
                                                                        <td style="width: 65%">Dasar Pengenaan
                                                                            Pajak/Penghasilan Bruto Pajak Penghasilan
                                                                            Final
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagB1"
                                                                                   name="txtBagB1"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right"
                                                                                   onblur="spt1770ss.cekBruto()">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">9
                                                                        </td>
                                                                        <td style="width: 65%">Pajak Penghasilan Final
                                                                            Terutang
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagB2"
                                                                                   name="txtBagB2"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">10
                                                                        </td>
                                                                        <td style="width: 65%">Penghasilan yang
                                                                            Dikecualikan dari Objek Pajak
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagB3"
                                                                                   name="txtBagB3"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right"
                                                                                   onblur="spt1770ss.cekBruto();">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="kt-align-right">
                                                            <button class="btn btn-secondary btn-elevate btn-pill"
                                                                    data-toggle="collapse" data-parent="#acc1"
                                                                    data-target="#acc11">
                                                                <i class="fa fa-chevron-left"></i> Sebelumnya
                                                            </button>
                                                            <button class="btn btn-djp btn-elevate btn-pill"
                                                                    style="margin: auto 0 auto auto"
                                                                    data-toggle="collapse" data-parent="#acc1"
                                                                    data-target="#acc13">
                                                                Berikutnya <i class="fa fa-chevron-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingThree2a">
                                                    <a href="#acc13" class="card-title collapsed" data-toggle="collapse"
                                                       aria-expanded="false" aria-controls="acc13">C. Daftar Harta dan
                                                        Kewajiban
                                                    </a>
                                                </div>
                                                <div id="acc13" class="collapse" aria-labelledby="headingThree2a"
                                                     data-parent="#acc1">
                                                    <div class="card-body">
                                                        <div class="kt-section">
                                                            <div class="kt-section__content">
                                                                <table class="table table-striped table-hover table-bordered mobile-djp">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">11
                                                                        </td>
                                                                        <td style="width: 65%">Jumlah Keseluruhan Harta
                                                                            yang Dimiliki pada Akhir Tahun Pajak
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagC1"
                                                                                   name="txtBagC1"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row"
                                                                            style="width: 5%; text-align: center">12
                                                                        </td>
                                                                        <td style="width: 65%">Jumlah Keseluruhan
                                                                            Kewajiban/Utang pada Akhir Tahun Pajak
                                                                        </td>
                                                                        <td style="width: 30%">
                                                                            <input type="text" id="txtBagC2"
                                                                                   name="txtBagC2"
                                                                                   class="form-control form-control-sm uang"
                                                                                   style="text-align: right">
                                                                            <span class="help-block"></span>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="kt-align-right">
                                                            <button class="btn btn-secondary btn-elevate btn-pill"
                                                                    data-toggle="collapse" data-parent="#acc1"
                                                                    data-target="#acc12">
                                                                <i class="fa fa-chevron-left"></i> Sebelumnya
                                                            </button>
                                                            <button class="btn btn-djp btn-elevate btn-pill"
                                                                    style="margin: auto 0 auto auto"
                                                                    data-toggle="collapse" data-parent="#acc1"
                                                                    data-target="#acc14">
                                                                Berikutnya <i class="fa fa-chevron-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingFour2a">
                                                    <a href="#acc14" class="card-title collapsed" data-toggle="collapse"
                                                       aria-expanded="false" aria-controls="acc14">D. Pernyataan</a>
                                                </div>
                                                <div id="acc14" class="collapse" aria-labelledby="headingFour2a"
                                                     data-parent="#acc1">
                                                    <div class="card-body">
                                                        <p> Dengan menyadari sepenuhnya akan segala akibatnya termasuk
                                                            sanksi-sanksi sesuai dengan ketentuan peraturan
                                                            perundang-undangan yang berlaku saya menyatakan bahwa apa
                                                            yang telah saya beritahukan di atas adalah benar, lengkap,
                                                            jelas.</p>
                                                        <div class="col-md-12 d-flex justify-content-center">
                                                            <!--<div class="checkbox-list">-->
                                                            <div class="kt-checkbox-list my-1">
                                                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                                                    <!--<label>-->
                                                                    <input type="checkbox" id="cbSetuju"
                                                                           name="cbSetuju"> Setuju
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Accordion-->
                                    </div>
                                </div>
                                <!--end: Form Wizard Step 2-->

                                <!--begin: Form Wizard Step 3-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" id="divSubmit">
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-section">
                                            <div class="kt-section__title mb-3">
                                                <h5>SPT Anda</h5>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label for="txtJnsSpt" class="col-md-3 col-form-label">Jenis
                                                    Formulir</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="txtJnsSpt" name="txtJnsSpt" readonly
                                                           value="1770SS" class="form-control form-control-sm">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label for="vThPajak" class="col-md-3 col-form-label">Tahun
                                                    Pajak</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="vThPajak" name="vThPajak" readonly
                                                           class="form-control form-control-sm">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label for="vRevno" class="col-md-3 col-form-label">Pembetulan
                                                    Ke</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="vRevno" name="vRevno" readonly
                                                           class="form-control form-control-sm">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label for="vStatusLbKbn" class="col-md-3 col-form-label">Status
                                                    SPT</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="vStatusLbKbn" name="vStatusLbKbn" readonly
                                                           class="form-control form-control-sm">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label for="vJmlLbkbn" class="col-md-3 col-form-label">Jumlah</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="vJmlLbkbn" name="vJmlLbkbn" readonly
                                                           class="form-control form-control-sm uang"
                                                           style="text-align: right">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label for="message-text"
                                                       class="col-md-3 col-form-label">Catatan</label>
                                                <div class="col-md-5">
                                                    <textarea class="form-control form-control-sm"
                                                              name="vStatusPengiriman" id="vStatusPengiriman"
                                                              readonly="readonly"></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--space-sm kt-separator--border-dashed"></div>
                                        <div class="kt-section">
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label class="col-md-3 col-form-label">Ambil kode verifikasi</label>
                                                <div class="col-md-5">
                                                    <button id="btnAmbilToken2" type="button"
                                                            class="btn btn-warning btn-sm" style="font-size: 14px">[di
                                                        sini]
                                                    </button>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label class="col-md-3 col-form-label"></label>
                                                <div class="col-md-5">
                                                    <p>Pastikan server code yang anda terima sesuai</p>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label for="divEmail" class="col-md-3 col-form-label">Masukkan kode
                                                    verifikasi</label>
                                                <div class="col-md-2">
                                                    <input type="text" id="txtToken" name="token"
                                                           class="form-control form-control-sm" maxlength="6" size="6">
                                                    <div class="help-block" id="codeServer"
                                                         style="display: none;"></div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <div class="col-md-2"></div>
                                                <label class="col-md-3 col-form-label"></label>
                                                <div class="col-md-5">
                                                    <button type="button"
                                                            class="btn btn-primary btn-djp btn-elevate btn-pill"
                                                            id="btnSubmitSpt">
                                                        <i class="fa fa-paper-plane"></i> Kirim SPT
                                                    </button>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Form Wizard Step 3-->
                            </div>
                            <!--end: Form Portlet_body-->

                            <div class="kt-portlet__foot">
                                <!--begin: Form Actions -->
                                <div class="kt-form__actions" style="display: flex">
                                    <button class="btn btn-warning btn-elevate btn-pill"
                                            data-ktwizard-type="action-prev" style="color: white;">
                                        <i class="fa fa-chevron-left"></i> Sebelumnya
                                    </button>
                                    <button id="lanjut" class="btn btn-djp btn-elevate btn-pill"
                                            data-ktwizard-type="action-next" style="margin: auto 0 auto auto">
                                        Selanjutnya <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                                <!--end: Form Actions -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- begin:: Modal Info Wajib Pajak DPO -->
        <div id="divinfowp" class="modal fade show" tabindex="-1" data-backdrop="static" data-keyboard="false"
             style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        <h6><strong>Konfirmasi Status NPWP Anda</strong></h6><br>
                        Anda perlu melakukan konfirmasi dengan status NPWP Anda. Silakan <strong>hubungi Account
                            Representative KPP terdaftar</strong> untuk konfirmasi status NPWP Anda.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Info Wajib Pajak DPO -->


        <!-- begin:: Modal Prepopulated -->
        <div id="divPrepopulated" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1"
             role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12">
                                    <ul>
                                        <li>Sistem menemukan data pembayaran pajak Anda tahun Pajak <strong><label
                                                        style="font-weight: bold" id="lblTahunPrep"></label></strong>
                                            melalui pemotongan pajak oleh pemberi kerja dan/atau pihak lainnya.
                                        </li>
                                        <li>Data yang tersedia merupakan data yang tersimpan dalam sistem Direktorat
                                            Jenderal Pajak, silakan teliti kembali atas kebenaran data tersebut.
                                        </li>
                                        <li>Data yang disediakan meliputi data :<br>
                                            - <strong>Penghasilan Bruto Dalam Negeri Sehubungan dengan Pekerjaan dan
                                                Penghasilan Neto Dalam Negeri Lainnya;</strong><br>
                                            - <strong>Pengurangan;</strong><br>
                                            - <strong>PTKP;</strong><br>
                                            - <strong>Jumlah PPh yang Telah Dipotong;</strong><br>
                                            - <strong>Jumlah Penghasilan yang telah dikenakan PPh Pasal 21
                                                Final;</strong><br>
                                            dan/atau <br>
                                            - <strong>Jumlah Penghasilan yang telah dikenakan PPh Pasal 4(2).</strong>
                                        </li>
                                        <li>Apabila Anda memiliki bukti pemotongan yang lain/ jumlah pajak yang dipotong
                                            tidak sesuai dengan data yang disajikan, harap Anda ubah data yang tersedia
                                            sesuai dengan keadaan yang sebenarnya.
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-md-12">
                                        Apakah Anda akan menggunakan data tersebut untuk pengisian SPT?
                                    </label>
                                    <div class="radio-list col-md-12">
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="prepo" id="p1" value="1"> <b><i>Ya</i></b>, Saya
                                            akan gunakan data tersebut
                                            <span></span>
                                        </label> <br>
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="prepo" id="p2" value="0"><b><i>Tidak</i></b>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnPrepopulated" type="button" data-dismiss="modal"
                                class="btn btn-djp btn-elevate btn-pill">OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Prepopulated -->


        <!-- begin:: Modal Radio Kurang Bayar -->
        <div class="modal fade show" id="divInfoKB" data-backdrop="static" data-keyboard="false" tabindex="-1"
             role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Status SPT Anda adalah <strong>Kurang Bayar</strong></p>
                        <p>Untuk dapat melakukan pembayaran pajak Anda, pastikan <strong>Kode Billing</strong> yang Anda
                            buat dengan menggunakan :</p>
                        <ul>
                            <li><strong>Kode Map : 411125 - PPh Pasal 25/29 OP</strong></li>
                            <li><strong>Kode Jenis Setoran : 200 - Tahunan</strong></li>
                            <li><strong id="thPjkBilling">Tahun Pajak : </strong></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Radio Kurang Bayar -->


        <!-- begin:: Modal Kurang Bayar dan Tidak Lengkap-->
        <div id="divInfoTLKB" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1"
             role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
                    </div>
                    <div class="modal-body">
                        Status SPT Tahunan Anda adalah <b>Kurang Bayar</b> dan <b>Tidak Lengkap</b>.
                        <br><br>
                        Untuk dapat mengirim SPT, Anda harus melengkapi data pembayaran terlebih dahulu. Silakan klik
                        tombol <b>Selanjutnya</b> untuk menyimpan SPT sebagai <b>DRAFT</b>.
                        <br><br>
                        Anda harus melakukan pembayaran sejumlah <b id="nilaiKB">Nilai Kurang Bayar</b> pada Bank/Pos
                        Persepsi.
                        Pastikan <strong>Kode Billing</strong> yang Anda buat dengan menggunakan :</p>
                        <ul>
                            <li><strong>Kode Map : 411125 - PPh Pasal 25/29 OP</strong></li>
                            <li><strong>Kode Jenis Setoran : 200 - Tahunan</strong></li>
                            <li><strong id="thnPjkBilling">Tahun Pajak : </strong></li>
                        </ul>
                        Setelah melakukan pembayaran, masukkan data <b>NTPN atau Nomor Pemindahbukuan</b> pada formulir.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Kurang Bayar dan Tidak Lengkap-->


        <!-- begin:: Modal Lebih Bayar -->
        <div id="divInfoLB" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1"
             role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        Status SPT Anda adalah <strong>Lebih Bayar</strong>
                        <ul>
                            <li>Pastikan Anda telah mengisi SPT (seluruh penghasilan, pengurang, PTKP dan PPh yang
                                dipotong pihak lain) dengan benar dan lengkap
                            </li>
                            <li>Kelebihan pembayaran pajak Anda dikembalikan setelah dilakukan <b>pemeriksaan atau
                                    penelitian</b></li>
                        </ul>

                        Silakan klik tombol Langkah Berikutnya untuk menyimpan SPT.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Lebih Bayar -->


        <!-- begin:: Modal Lebih Bayar dan Tidak Lengkap-->
        <div id="divInfoTLLB" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1"
             role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        Status SPT Anda adalah <b>Lebih Bayar</b>
                        <ul>
                            <li>Pastikan Anda telah mengisi SPT (seluruh penghasilan, pengurang, PTKP dan PPh yang
                                dipotong pihak lain) dengan benar dan lengkap
                            </li>
                            <li>Kelebihan pembayaran pajak Anda dikembalikan setelah dilakukan <b>pemeriksaan atau
                                    penelitian</b></li>
                        </ul>

                        SPT Tahunan Anda Tidak Lengkap, hal tersebut dapat disebabkan karena:
                        <ul>
                            <li>Anda belum mengunggah keterangan dan/atau dokumen yang disyaratkan dalam SPT Elektronik
                                dan/atau Anda belum memilih jenis Permohonan Pengembalian Kelebihan Pembayaran Pajak
                            </li>
                        </ul>

                        Silakan klik tombol Langkah Berikutnya untuk menyimpan SPT ini sebagai DRAFT. Untuk dapat
                        mengirim SPT, Anda harus melengkapi terlebih dahulu
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Lebih Bayar dan Tidak Lengkap-->


        <!-- begin:: Modal Info Lebih Bayar -->
        <div id="divInfoPbyrnLebih" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1"
             role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
                    </div>
                    <div class="modal-body">
                        Status SPT Tahunan Anda adalah <b>Kurang Bayar</b>.
                        <br>
                        <br>
                        Sebagai informasi, Anda melakukan pembayaran lebih besar dari nilai Kurang Bayar pada SPT.
                        <br>
                        <br>
                        Silakan klik tombol Selanjutnya untuk menyimpan SPT.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Info Lebih Bayar -->


        <!-- begin:: Modal NonEfektif-->
        <div id="divne" class="modal fade show" tabindex="-1" data-backdrop="static" data-keyboard="false"
             style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        <h3><strong>Penghasilan Anda di bawah PTKP</strong></h3> <br>
                        Berdasarkan ketentuan perpajakan, Anda TIDAK WAJIB menyampaikan SPT Tahunan dengan mengajukan
                        permohonan Wajib Pajak Non Efektif (WP NE). Permohonan WP NE dapat <a
                                href="https://www.pajak.go.id/id/formulir-permohonan-penetapan-wajib-pajak-non-efektif "
                                target="_blank">diunduh di sini</a>
                    </div>
                    <div class="modal-footer">
                        <button id="btnDivNe" type="button" class="btn btn-djp btn-elevate btn-pill"
                                data-dismiss="modal">Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--<script th:inline="javascript">
            var link = /*https://www.pajak.go.id/id/formulir-permohonan-penetapan-wajib-pajak-non-efektif */ 'default';
        </script>-->
        <!-- end:: Modal NonEfektif -->


        <!-- begin:: Modal Feedback -->
        <div id="divfeedback" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        <p>SPT Anda berhasil dikirim, Bukti Penerimaan Elektronik telah dikirimkan ke email Anda</p>
                        <p>Apa respon Anda terhadap layanan ini?</p>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <a href="javascript:;" id="btnpuas">
                                    <div class="dashboard-stat green-soft">
                                        <div class="visual">
                                            <i class="fa fa-smile"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">Puas</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <a href="javascript:;" id="btntakpuas">
                                    <div class="dashboard-stat red-soft">
                                        <div class="visual">
                                            <i class="fa fa-frown"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">Tidak Puas</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <p>Pilih salah satu yang sesuai</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Feedback -->


        <!-- begin:: Modal Redirect SPT 1770SS -->
        <div id="divRedirect1770ss1" class="modal fade show" data-backdrop="static" data-keyboard="false" tabindex="-1"
             role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SPT 1770 SS Lebih Bayar</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12 " id="step1ssLb">
                            <p>Apabila Status SPT Tahunan PPh OP 1770SS Lebih Bayar, Anda akan dialihkan ke formulir
                                :</p>
                            <div class="form-row-seperated">
                                <div class="form-group">
                                    <div class="radio-list">
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input id="rbss1" name="ssLb" type="radio" value="1"/>SPT Tahunan PPh Orang
                                            Pribadi 1770S
                                            <span></span>
                                        </label> <br/>
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input id="rbss2" name="ssLb" type="radio" value="2"/>SPT Tahunan PPh Orang
                                            Pribadi 1770
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal" aria-hidden="true">Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Redirect SPT 1770 SS -->


        <!-- begin:: Modal Redirect SPT 1770SS -->
        <div id="divRedirect1770ss2" class="modal fade show" data-backdrop="static" data-keyboard="false" tabindex="-1"
             role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SPT 1770 SS Lebih Bayar</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12 " id="step2ssLbA">
                            <p>Apabila Status SPT Tahunan PPh OP 1770SS Lebih Bayar, Anda akan dialihkan ke formulir SPT
                                Tahunan PPh Orang Pribadi 1770S :</p>
                            <div class="form-row-seperated">
                                <div class="form-group">
                                    <div class="radio-list">
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="ssLbA" id="rbss11" value="1"> Dengan bentuk
                                            formulir
                                            <span></span>
                                        </label> <br/>
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="ssLbA" id="rbss12" value="2"> Dengan panduan
                                            <span></span>
                                        </label> <br/>
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="ssLbA" id="rbss13" value="3"> Dengan upload SPT
                                            <span></span>
                                        </label> <br/>
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="ssLbA" id="rbss14" value="4"> Dengan pengisian
                                            offline
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnRedirect1770ss2" class="btn btn-djp btn-elevate btn-pill">Lanjut
                        </button>
                        <button class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal" aria-hidden="true">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Redirect SPT 1770 SS -->


        <!-- begin:: Modal Redirect SPT 1770SS -->
        <div id="divRedirect1770ss3" class="modal fade show" data-backdrop="static" data-keyboard="false" tabindex="-1"
             role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SPT 1770 SS Lebih Bayar</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12 " id="step2ssLbB">
                            <p>Apabila Status SPT Tahunan PPh OP 1770SS Lebih Bayar, Anda akan dialihkan ke formulir SPT
                                Tahunan PPh Orang Pribadi 1770 :</p>
                            <div class="form-row-seperated">
                                <div class="form-group">
                                    <div class="radio-list">
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="ssLbB" id="rbss21" value="1"> Dengan pengisian
                                            offline
                                            <span></span>
                                        </label> <br/>
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="ssLbB" id="rbss22" value="2"> Dengan upload SPT
                                            <span></span>
                                        </label> <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnRedirect1770ss3" class="btn btn-djp btn-elevate btn-pill">Lanjut
                        </button>
                        <button class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal" aria-hidden="true">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Redirect SPT 1770 SS -->


        <!-- begin:: Modal Token -->
        <div id="divToken" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1"
             role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih media pengiriman Kode Verifikasi</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group row col-md-12">
                                <div class="radio-list">
                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                        <input type="radio" name="tokenvia" id="r1" value="0"> Email ke <b
                                                id="emailWp">{{ auth()->user()->email }}</b>
                                        <span></span>
                                    </label> <br>
                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                        <input type="radio" name="tokenvia" id="r2" value="1" disabled> SMS *) ke nomor
                                        <b id="notelpWp">{{ auth()->user()->mobile_phone }}</b>
                                        <span></span>
                                    </label><br>
                                    * Anda akan dikenakan biaya untuk pengiriman SMS Kode Verifikasi<br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnAmbilToken" type="button" class="btn btn-djp btn-elevate btn-pill">OK</button>
                        <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Token -->


        <!--End::Isi Konten-->
    </div>
    <!--end:: Content-->
@endsection
@section('js')

    <script src="/assets/js/djp/common/autoNumeric-min.js" type="text/javascript"></script>

    <script src="{{ url('/assets/vendors/general/jquery-validation/dist/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ url('/assets/vendors/general/jquery-validation/dist/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ url('/assets/vendors/general/jquery-validation/dist/localization/messages_id.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ url('/assets/vendors/custom/js/vendors/jquery-validation.init.js') }}"
            type="text/javascript"></script>
    <script src="{{ url('/assets/vendors/custom/datatables/datatables.bundlemin1.js') }}"
            type="text/javascript"></script>
    <script src="{{ url('/assets/js/djp/common/djpCommon.js') }}" type="text/javascript"></script>
    <script src="{{ url('/assets/js/djp/pages/components/sptproses.js') }}" type="text/javascript"></script>
    <script src="{{ url('/assets/js/djp/pages/components/lsbilling.js') }}" type="text/javascript"></script>
    <script src="{{ url('/assets/js/djp/pages/components/submision.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/djp/pages/form/spt1770ss.js') }}" type="text/javascript"></script>
    <script>
        var spt1770 = "<?= $spt ?>";
        var jns = "1770SS";
        var infowp = "0";

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
        });
    </script>

    <script src="{{ url('assets/js/djp/common/custom.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/app.js') }}" type="text/javascript"></script>
@endsection