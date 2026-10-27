@extends('layouts.user')

@section('title', 'Lapor')
@section('css')
<!--begin::Page Custom Styles(used by this page) -->
<link href="{{ url('/assets/css/djp/pages/custom/general/wizard/wizard-4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('/assets/css/djp/pages/custom/general/uniform/uniform.default.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('/assets/css/djp/style.bundle/uppy.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('/assets/vendors/general/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Custom Styles -->
<meta name="_token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" style="padding: 20px; background: #EBECF1; margin-bottom: 40px; border-radius: 0 8px 8px 8px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .2), 0 3px 10px 0 rgba(0, 0, 0, .19);">
                                    <!--Begin::Isi Konten-->
                                    <input type="text" value="ae1962be-8c60-4eb7-ab57-f95e1cd0d424" name="ac" id="ac" class="form-control" style="display: none"/>
                                    
            <!--Begin::Section-->
            <div class="row" style="position: relative">
                <button type="button" id="btn_show_help" class="btn btn-warning btn-lg" style="color: white; font-weight: 600">
                    Petunjuk Pengisian &nbsp;&nbsp;&nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999) " />
                        </g>
                    </svg>
                </button>
                <div class="col-md-12 petunjuk help-hide">
                    <div class="kt-portlet kt-portlet--head-sm ">
                        <div class="kt-portlet__head" style="background: #F04DBA;">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" id="Combined-Shape" fill="#000000"/>
                                            <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" id="Path-41-Copy" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                                <h3 class="kt-portlet__head-title" style="color: white; font-size: 1rem;">Petunjuk Pengisian</h3>
                            </div>
                            <div class="kt-portlet__head-label">
                                <div class="kt-align-right">
                                    <button id="btn_collapse_help" class="btn btn-warning  btn-sm btn-icon btn-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                                <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                                <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-scroll" data-scroll="true" data-height="330" data-scrollbar-shown="true">
                                <div class="petunjuk-wizard show">
                                    <p><strong>Persiapkan seluruh dokumen terkait pengisian SPT (Daftar Penghasilan, Bukti Potong, Daftar Harta, Daftar Kewajiban dan Daftar Keluarga)</strong></p>
                                    <p><strong>Tahun Pajak</strong> adalah tahun diterima/diperolehnya penghasilan, pilih sesuai tahun penghasilan</p>
                                    <p><strong>Status SPT Normal</strong> adalah Jika Anda menyampaikan SPT untuk <strong> kali pertama </strong> untuk tahun pajak tertentu. Jika Anda memilih normal, nilai pembetulan ke akan terisi otomatis dengan angka nol(0) dan tdk dapat diubah</p>
                                    <p><strong>Status SPT Pembetulan</strong> adalah Jika Anda menyampaikan SPT untuk membetulkan SPT yang dilaporkan sebelumnya. Jika Anda memilih pembetulan,
                                        <strong>Isikan nilai pembetulan ke- berapa</strong> SPT Anda pada kotak isian pembetulan dan pastikan bahwa SPT sebelumnya telah Anda Kirimkan ke Direktorat Jenderal Pajak </p>
                                </div>
                                <div class="petunjuk-wizard">
                                    <!--<p><strong>Persiapkan seluruh dokumen terkait pengisian SPT (Daftar Penghasilan, Bukti Potong, Daftar Harta, Daftar Kewajiban dan Daftar Keluarga)</strong></p>-->
                                    <p><strong>Bagian A</strong></p>
                                    <p>Isila kolom sesuai dengan data pemotongan PPh yang bersifat final yang Anda miliki</p>
                                    <p><strong>Bagian B</strong></p>
                                    <p>Ketentuan pengisian Daftar Harta sbb:</p>
                                    <p style="padding-inline-start: 10px;"><strong>1. Kolom Nama Harta:</strong></p>
                                    <ul type="circle" style="padding-inline-start: 45px; font-weight: 600">
                                        <li>Tanah (cantumkan lokasi dan luas tanah);</li>
                                        <li>Bangunan (cantumkan lokasi dan luas bangunan);</li>
                                        <li>Kendaraan bermotor, mobil, sepeda motor (cantumkan merek dan tahun pembuatannya)</li>
                                        <li>Kapal pesiar, pesawat terbang, helikopter, jetski, peralatan olah raga khusus, dan sejenisnya</li>
                                        <li>Uang Tunai Rupiah, Valuta Asing sepadan US Dollar, Simpanan termasuk tabungan dan deposito di Bank Dalam dan Luar Negeri, Piutang, dan sebagainya dicantumkan secara global</li>
                                        <li>Efek-efek (saham, obligasi, commercial paper, dan sebagainya) dicantumkan secara global</li>
                                        <li>Keanggotaan perkumpulan eksklusif (keanggotaan golf, time sharing dan sejenisnya)</li>
                                        <li>Penyertaan modal lainnya dalam perusahaan lain yang tidak atas saham (CV, Firma) dicantumkan secara global</li>
                                        <li>Harta berharga lainnya, misalnya batu permata, logam mulia, dan lukisan dicantumkan secara global</li>
                                    </ul>
                                    <p style="padding-inline-start: 10px;"><strong>2. Kolom Keterangan :</strong>Kolom ini diisi dengan keterangan-keterangan lain yang dianggap perlu. Misalnya untuk rumah dan tanah diberi keterangan Nomor Objek Pajak (NOP) sesuai yang tertera dalam SPPT PBB.</p>
                                    <p><strong>Bagian C</strong></p>
                                    <p>Daftar ini digunakan untuk melaporkan jumlah kewajiban/utang <strong>pada akhir Tahun Pajak</strong></p>
                                    <p><strong>Contoh:</strong></p>
                                    <p><strong>ilustrasi:</strong>Bila Anda meminjam sejumlah uang kepada Bank A Jl. Gatot Subroto No. 40 Jakarta sebesar Rp. 100.000.000 pada Tahun 2013. Sampai dengan akhir Tahun 2015 sisa pinjaman yang masih harus dilunasi kepada Bank A adalah sebesar Rp. 20.000.000.</p>
                                    <p>Maka cara pengisiannya adalah sbb:</p>
                                    <ul type="circle" style="padding-inline-start: 45px; font-weight: 600">
                                        <li>Nama Pemberi Pinjaman : Bank A</li>
                                        <li>Alamat Pemberi Pinjaman : Jl. Gatot Subroto No. 40 Jakarta</li>
                                        <li>Tahun Peminjaman : 2013</li>
                                        <li>Jumlah : Rp. 20.000.000</li>
                                    </ul>
                                    <p><strong>Bagian D</strong></p>
                                    <p>Bagian ini diisi dengan daftar susunan anggota keluarga yang menjadi tanggungan sepenuhnya Wajib Pajak, <strong>sesuai kondisi awal tahun pajak</strong>.</p>
                                </div>
                                <div class="petunjuk-wizard">
                                    <!--<p><strong>Persiapkan seluruh dokumen terkait pengisian SPT (Daftar Penghasilan, Bukti Potong, Daftar Harta, Daftar Kewajiban dan Daftar Keluarga)</strong></p>-->
                                    <p><strong>Bagian A</strong></p>
                                    <p>Penghasilan pada angka 1 sampai dengan 6 di samping adalah penghasilan selain yang dikenakan pemotongan PPh Final. Contoh:</p>
                                    <ol style="padding-inline-start: 20px; font-weight: 600">
                                        <li><strong>Bunga</strong> selain bunga tabungan atau deposito</li>
                                        <li><strong>Sewa</strong> selain sewa tanah dan/atau bangunan</li>
                                        <li><strong>Hadiah</strong> selain hadiah undian</li>
                                        <li><strong>Penghasilan</strong> lain misalnya pembebasan utang, selisih kurs</li>
                                    </ol>
                                    <p><strong>Bagian B</strong></p>
                                    <p>Penghasilan pada angka 1 sampai dengan 6 di samping adalah penghasilan yang tidak termasuk Objek Pajak sebagaimana dimaksud dalam Pasal 4 ayat (3) UU PPh</p>
                                    <p><strong>Bagian C</strong></p>
                                    <p>Anda dapat menambahkan data Bukti Pemotongan yang belum dimasukkan di dalam Bagian ini atau mengubah/menghapus Data Bukti Pemotongan yang sudah ada.</p>
                                    <p>Berikut cara menambah Bukti Pemotongan:</p>
                                    <p style="padding-inline-start: 10px;">1. Klik "Tambah"</p>
                                    <p style="padding-inline-start: 10px;">2. Isi Data :</p>
                                    <ul type="circle" style="padding-inline-start: 45px; font-weight: 600">
                                        <li>Jenis Pajak : Pasal 21 / Pasal 22 / Pasal 23 / Pasal 24 / Pasal 26 disesuaikan dengan bukti pemotongan yang dimiliki</li>
                                        <li>NPWP Pemotong/Pemungut Pajak</li>
                                        <li>Nama Pemotong/Pemungut Pajak</li>
                                        <li>Nomor Bukti Pemotongan/Pemungutan</li>
                                        <li>Tanggal Bukti Pemotongan/Pemungutan dengan format penulisan dd-mm-yyyy</li>
                                        <li>Jumlah PPh yang dipotong/dipungut</li>
                                    </ul>
                                    <p style="padding-inline-start: 20px;">Sesuai dengan Data pada Bukti Pemotongan yang Anda miliki yaitu :</p>
                                    <ul type="circle" style="padding-inline-start: 45px; font-weight: 600">
                                        <li>Formulir 1721 A1/A2</li>
                                        <li>Formulir 1721-VI</li>
                                        <li>Bukti Pemotongan PPh Pasal 23/26</li>
                                        <li>Bukti Pemungutan PPh Pasal 22</li>
                                        <li>Bukti Pemotongan PPh dari Luar Negeri</li>
                                    </ul>
                                    <p><strong>Catatan:</strong></p>
                                    <p>Untuk jenis pajak Pasal 24, jumlah PPh yang dipotong/dipungut adalah mana yang lebih kecil antara jumlah yang sebenarnya atau jumlah tertentu yang dihitung berdasarkan formula sebagai berikut:</p>
                                    <p><i>(Jumlah Penghasilan dari LN / Penghasilan Kena Pajak) X Total PPh terutang</i></p>
                                    <p>Dalam hal penghasilan yang diterima/diperoleh di luar negeri berasal dari beberapa negara, maka penghitungan kredit pajak berdasarkan formula tersebut tidak termasuk Pajak yang bersifat final sebagaimana dimaksud Pasal 4 ayat (2), Pasal 8 ayat (1) dan ayat (4) Undang-Undang PPh.</p>
                                </div>
                                <div class="petunjuk-wizard">
                                    <p><strong>Bagian Identitas</strong></p>
                                    <p>Pada pilihan Status Kewajiban Perpajakan Suami Istri, pilih :</p>
                                    <ul type="circle" style="padding-inline-start: 20px; font-weight: 600">
                                        <li>HB apabila, suami-isteri telah hidup berpisah berdasarkan putusan hakim;</li>
                                        <li>PH apabila, dikehendaki secara tertulis oleh suami-isteri berdasarkan perjanjian pemisahan harta dan penghasilan; atau</li>
                                        <li>MT apabila, dikehendaki oleh isteri yang memilih untuk menjalankan hak dan kewajiban perpajakannya sendiri</li>
                                    </ul>
                                    <p><strong>Bagian A.1</strong></p>
                                    <p>Jumlah Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan diambil dari :</p>
                                    <ol style="padding-inline-start: 20px; font-weight: 600">
                                        <li>Kolom B No.12 (Untuk Formulir 1721-A1)</li>
                                        <li>Kolom B No.15 (Untuk Formulir 1721-A2)</li>
                                        <li>Kolom 2 (Untuk Formulir 1721-VI)</li>
                                    </ol>
                                    <p><strong>Bagian A.3</strong></p>
                                    <p>Cukup jelas</p>
                                    <p><strong>Bagian A.5</strong></p>
                                    <p>Bagian ini diisi jumlah zakat/sumbangan keagamaan yang bersifat wajib atas penghasilan yang menjadi objek pajak yang nyata-nyata dibayarkan oleh Wajib Pajak Orang Pribadi kepada badan amil zakat atau lembaga amil zakat atau lembaga pengelola sumbangan keagamaan lainnya
                                        <strong>yang dibentuk dan disahkan oleh Pemerintah</strong>, sesuai dengan bukti setoran yang sah.</p>
                                    <p><strong>Bagian B.7</strong></p>
                                    <p><strong>Bagian C.10</strong></p>
                                    <p>Untuk jenis pajak Pasal 24, jumlah PPh yang dipotong/dipungut adalah mana yang lebih kecil antara jumlah yang sebenarnya atau jumlah tertentu yang dihitung berdasarkan formula sebagai berikut:</p>
                                    <p><i><strong>(Jumlah Penghasilan dari LN / Penghasilan Kena Pajak) X Total PPh terutang</strong></i></p>
                                    <p>Dalam hal penghasilan yang diterima/diperoleh di luar negeri berasal dari beberapa negara, maka penghitungan kredit pajak berdasarkan formula tersebut tidak termasuk Pajak yang bersifat final sebagaimana dimaksud Pasal 4 ayat (2), Pasal 8 ayat (1) dan ayat (4) Undang-Undang PPh.</p>
                                    <p><strong>Bagian D.14 a</strong> Diisi dengan jumlah PPh yang telah dibayar sendiri selama tahun pajak bersangkutan berupa PPh Pasal 25 Tahun Pajak yang bersangkutan termasuk jumlah pelunasan PPh yang terutang berdasarkan penghitungan sementara dalam hal Wajib Pajak Menyampaikan pemberitahuan permohonan perpanjangan jangka waktu penyampaian SPT tahunan</p>
                                    <p><strong>Bagian D.14 b</strong> Diisi dengan jumlah poan pembayaran pajak, pilih <strong>Sudah</strong>, dan masukkan daftar NTPN dari Bukti Penerimaan Negara yang Anda miliki dan/atau Nomor Pemindahbukuan dari KPP terdaftar. NTPN dan Nomor Pemindahbukuan yang dapat diinputkan adalah nomor dengan Kode Map PPh Pasal 25/29 OP (411125) dan Kode Jenis Setoran Tahunan (200)</li>
                                        <li>Apabila Anda belum melakukan pembayaran, sistem ini memberikan layanan pembuatan <strong>Kode Billing</strong>, yang dapat Anda gunakan untuk melakukan pembayaran di Bank baik secara online (internet banking) atau datang langsung ke Bank</li>
                                        <li>Apabila Anda belum aktif sebagai pengguna eBilling di DJP Online, aktifkan terlebih dahulu</li>
                                    </ul>
                                    <p><strong>Bagian Unggah Lampiran</strong></p>kok PPh yang ada di dalam Surat Tagihan Pajak, tidak termasuk sanksi administrasi berupa bunga dan/atau denda</p>
                                    <p><strong>Bagian Pembayaran</strong></p>
                                    <ul type="circle" style="padding-inline-start: 20px; font-weight: 600">
                                        <li>Apabila berdasar hitungan sistem, status SPT Anda Kurang Bayar, sistem akan menampilkan panel pembayaran</li>
                                        <li>Apabila Anda sudah melakukan pembayaran atas kekurang
                                    <ul type="circle" style="padding-inline-start: 20px; font-weight: 600">
                                        <li>Apabila berdasar hitungan sistem, status SPT Anda Lebih Bayar, sistem akan menampilkan panel unggah lampiran</li>
                                        <li>Unggah lampiran Anda dengan dokumen berekstensi .pdf dengan cara klik tombol "Browse File...pdf", kemudian pilih dokumen yang akan dijadikan lampiran SPT Anda</li>
                                    </ul>
                                    <p><strong>Bagian E.17</strong>, Jika Status Lebih Bayar</p>
                                    <ul type="circle" style="padding-inline-start: 20px; font-weight: 600">
                                        <li>Permohonan Tidak berlaku apabila kelebihan berasal dari PPh yang Ditanggung Pemerintah (DTP)</li>
                                        <li>Pilihan DIKEMBALIKAN DENGAN SKPPKP PASAL 17C(WP dengan Kriteria Tertentu), merupakan pengembalian pendahuluan kelebihan pembayaran pajak yang diberikan kepada wajib pajak dengan kriteria tertentu (WP Patuh)yang ditetapkan oleh Kanwil DJP. Persayaratan WP dengan kriteria tertentu dapat dilihat pada Pasal 17C UU KUP dan Pasal 1 PMK Nomor 192/PMK.03/2007</li>
                                        <li>Pilihan DIKEMBALIKAN DENGAN SKKPP PASAL 17D (WP yang memenuhi persyaratan tertentu), merupakan pengembalian pendahuluan kelebihan pembayaran pajak yang dapat diberikan kepada WP selain kriteria di atas yang memenuhi persyaratan tertentu sesuai Pasal 17D UU KUP dan Pasal 1 dan 2 PMK Nomor 193/PMK.03/2007</li>
                                    </ul>
                                </div>
                                <div class="petunjuk-wizard">
                                    <!--<p><strong>Persiapkan seluruh dokumen terkait pengisian SPT (Daftar Penghasilan, Bukti Potong, Daftar Harta, Daftar Kewajiban dan Daftar Keluarga)</strong></p>-->
                                    <ol style="padding-inline-start: 20px; font-weight: 600">
                                        <li>Pastikan isian SPT Anda benar dengan memeriksa informasi ringkas SPT Anda pada tahap ini</li>
                                        <li>Untuk melakukan pengiriman SPT (Submit), Anda diminta untuk mengisikan Kode Verifikasi</li>
                                        <li>Kode verifikasi dapat Anda minta dengan klik link ambil kode verifikasi di bawah kotak isian kode verifikasi</li>
                                        <li>Jika Anda telah menerima pesan kode verifikasi, gunakan kode tersebut untuk submit</li>
                                        <li>Pada akhir proses, Anda akan diminta untuk memilih pilihan survei kepuasan yang disediakan</li>
                                    </ol>
                                    <p>Apabila Anda tidak menghendaki seketika mengirim SPT ini, Anda dapat melakukannya terpisah melalui menu Kirim SPT</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 halaman-utama">
                    <div class="kt-wizard-v4" id="frmInduk1770s" data-ktwizard-state="step-first">
                        <!--end: Form Wizard Nav -->
                        <form class="kt-form" id="frm1770s">
                            <div class="kt-portlet kt-portlet--head-sm">
                                <div class="kt-portlet__head" style="background: #9658DD;">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon" style="color: white">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <rect id="Rectangle" fill="#000000" x="6" y="11" width="9" height="2" rx="1"/>
                                                    <rect id="Rectangle-Copy" fill="#000000" x="6" y="15" width="5" height="2" rx="1"/>
                                                </g>
                                            </svg>
                                        </span>
                                        <h3 class="kt-portlet__head-title" style="color: white"> SPT 1770 S </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="kt-wizard-v4__nav">
                                        <div class="kt-wizard-v4__nav-items">
                                            <a class="kt-wizard-v4__nav-item kt-align-left" href="javascript:;" data-ktwizard-type="step" data-ktwizard-state="current">
                                                <div class="kt-heading kt-heading--lg kt-heading--space-sm">Data Formulir</div>
                                            </a>
                                            <a class="kt-wizard-v4__nav-item kt-align-left" href="javascript:;" data-ktwizard-type="step">
                                                <div class="kt-heading kt-heading--lg kt-heading--space-sm">Lampiran II</div>
                                            </a>
                                            <a class="kt-wizard-v4__nav-item kt-align-left" href="javascript:;" data-ktwizard-type="step">
                                                <div class="kt-heading kt-heading--lg kt-heading--space-sm">Lampiran I</div>
                                            </a>
                                            <a class="kt-wizard-v4__nav-item kt-align-left" href="javascript:;" data-ktwizard-type="step">
                                                <div class="kt-heading kt-heading--lg kt-heading--space-sm">Induk</div>
                                            </a>
                                            <a class="kt-wizard-v4__nav-item kt-align-left" href="javascript:;" data-ktwizard-type="step">
                                                <div class="kt-heading kt-heading--lg kt-heading--space-sm">Kirim</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="kt-space-10"></div>
                                    <div class="progress progress-lg progress-djp">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated lg bg-warning" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="kt-space-10"></div>
                                    <h6 class="pagging-djp">Langkah ke 0 dari 0</h6>
                                    <div class="kt-separator kt-separator--space-sm kt-separator--border-dashed"></div>
                                    <!--begin: Form Wizard Form-->

                                    <!--begin: Form Wizard Step 1-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" id="tab1">
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-section">
                                                <div class="kt-section__title">
                                                    <h5>Data Formulir</h5>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label for="ThnPajak" class="col-md-3 col-form-label">Tahun Pajak</label>
                                                    <div class="col-md-5">
                                                        <select id="thnPajak" name="thnPajak" class="form-control select2me" required="" aria-required="true" aria-invalid="false" aria-describedby="thnPajak-error">
                                                            <option value="">Pilih Tahun Pajak</option>
                                                            <!--<select th:field="*{percentage}">-->
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
                                                        <span id="thnPajak-error" class="help-block help-block-error valid" style="display: none;"></span>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <div class="form-group row my-2" id="divStatusSpt">
                                                    <div class="col-md-2"></div>
                                                    <label class="col-form-label col-md-3">Status SPT</label>
                                                    <div class="col-md-5">
                                                        <div class="kt-radio-list">
                                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                <input type="radio" name="rbrev" id="rbr1" value="1"> Normal
                                                                    <span></span>
                                                            </label>
                                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                <input type="radio" name="rbrev" id="rbr2" value="2"> Pembetulan
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
                                                        <input type="text" id="txtPembetulanKe" name="txtPembetulanKe" class="form-control  form-control-sm" aria-describedby="txtPembetulanKe" style="text-align: right" readonly>
                                                            <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 1-->

                                    <!--begin: Form Wizard Step 2-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" id="tab2">
                                        <div class="kt-form__section kt-form__section--first">
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-solid  accordion-toggle-arrow" id="acc3">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne2a">
                                                        <a  href="#acc31" class="card-title" data-toggle="collapse" aria-expanded="true" aria-controls="acc31">
                                                            Bagian A. Penghasilan yang dikenakan PPh Final dan/atau bersifat final
                                                        </a>
                                                    </div>
                                                    <div id="acc31" class="collapse show" aria-labelledby="headingOne2a" data-parent="#acc3" style="">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <div class="kt-align-right">
                                                                                <button id="final_new" class="btn btn-djp btn-elevate btn-pill" >
                                                                                    Tambah <i class="flaticon2-add-1"></i>
                                                                                    <span class="help-block"></span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="kt-space-20"></div>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-djp table-md table-striped table-hover" id="tblPphFinal" style="display: table; width: 100%;" role="grid" aria-describedby="tblPphFinal_info">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="text-align: center; vertical-align: top; " width="3%">No</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="37%">Sumber/Jenis Penghasilan</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="30%">DPP/ Penghasilan Bruto</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="30%">PPh&nbsp;Terutang</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="30%">Aksi</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <td colspan="3" style="font-weight: bold; text-align: right;">Jumlah</td>
                                                                                            <td style="text-align: center; vertical-align: top;" width="30%">
                                                                                                <input class="form-control form-control-sm uang" type="text" readonly id="txtJBA" />
                                                                                            </td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                            <div id="divFinal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="" style="padding-right: 12px" aria-hidden="true">
                                                                                <div class="modal-dialog modal-md" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title">Bagian A. Penghasilan yang dikenakan PPh Final dan/atau bersifat final</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-form-label col-md-4">Sumber/Jenis Penghasilan</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <select class="form-control form-control-sm m-select2" id="ddlKewajibanFinal" name="ddlKewajibanFinal" style="width: 100%;">
                                                                                                            <option value=""></option>
                                                                                                            <option value="1">1. Bunga Deposito, Tabungan, Diskonto SBI,Surat Berharga Negara</option>
                                                                                                            <option value="2">2. Bunga/Diskonto Obligasi</option>
                                                                                                            <option value="3">3. Penjualan Saham di Bursa Efek</option>
                                                                                                            <option value="4">4. Hadiah Undian</option>
                                                                                                            <option value="5">5. Pesangon, Tunjangan Hari Tua, dan tebusan Pensiun yang dibayarkan sekaligus</option>
                                                                                                            <option value="6">6. Honorarium Atas Beban APBD/APBN</option>
                                                                                                            <option value="7">7. Pengalihan Hak Atas Tanah dan Bangunan</option>
                                                                                                            <option value="8">8. Sewa Atas Tanah dan Bangunan</option>
                                                                                                            <option value="9">9. Bangunan yang diterima dalam rangka Bangun Guna Serah</option>
                                                                                                            <option value="10">10. Bunga Simpanan yang diserahkan oleh Koperasi kepada Anggota Koperasi</option>
                                                                                                            <option value="11">11. Transaksi Derivatif</option>
                                                                                                            <option value="12">12. Dividen</option>
                                                                                                            <option value="13">13. Penghasilan Istri Dari Satu Pemberi Kerja</option>
                                                                                                            <option value="14">14. Penghasilan Lain Yang Dikenakan Pajak Final Dan/Atau Bersifat Final</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">DPP/Penghasilan Bruto</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input type="text" id="txtDppFinal" class="form-control form-control-sm uang" style="text-align: right; " placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">PPh Terutang</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input type="text" id="txtPphFinal" class="form-control form-control-sm uang" style="text-align: right; " placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" id="btnAddFinal" class="btn btn-djp btn-elevate btn-pill"><i class="fa fa-save"></i>
                                                                                                <span>Simpan</span>
                                                                                            </button>
                                                                                            <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal">Batal</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!---form--->
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc3" data-target="#acc32" id="button-payment-address">
                                                                    Lanjut Ke Daftar Harta <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo2a">
                                                        <a  href="#acc32" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc32">
                                                            Bagian B : Harta Pada Akhir Tahun
                                                        </a>
                                                    </div>
                                                    <div id="acc32" class="collapse" aria-labelledby="headingTwo2a" data-parent="#acc3">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <div class="kt-form__section" style="display: flex">
                                                                                <div class="col-md-6">
                                                                                    <button id="harta_th_lalu" class="btn btn-djp btn-elevate btn-pill">Harta Pada SPT Tahun Lalu</button>
                                                                                </div>
                                                                                <div class="col-md-6" style="text-align:right">
                                                                                    <button id="harta_new" class="btn btn-djp btn-elevate btn-pill">
                                                                                        Tambah <i class="flaticon2-add-1"></i>
                                                                                        <span class="help-block"></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="kt-space-20"></div>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-djp table-md table-striped table-hover" id="tblHarta" role="grid" aria-describedby="tblHarta_info">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="font-size: small;text-align: center;width: 30%">Kode Harta</th>
                                                                                            <th style="font-size: small;text-align: center;width: 30%">Nama Harta</th>
                                                                                            <th style="font-size: small;text-align: center;width: 5%">Tahun Perolehan</th>
                                                                                            <th style="font-size: small;text-align: center;width: 25%">Harga Perolehan</th>
                                                                                            <th style="font-size: small;text-align: center;width: 30%">Keterangan</th>
                                                                                            <th style="font-size: small;text-align: center;width: 10%">Aksi</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <td colspan="3" style="font-weight: bold; text-align: right">Sub Total</td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtSubJBB" />
                                                                                            </td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="3" style="font-weight: bold; text-align: right">Jumlah Bagian B (JBB)</td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtJBB" />
                                                                                            </td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                            <div id="divHarta" class="modal fade" role="dialog" aria-labelledby="" style="padding-right: 12px" aria-hidden="true">
                                                                                <div class="modal-dialog modal-md" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title">Harta Baru</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-form-label col-md-4">Kode Harta</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <select class="form-control form-control-sm m-select2" id="DhKdHarta" name="DhKdHarta" style="width: 100%;">
                                                                                                            <option value=""></option>
                                                                                                            <optgroup label="Kas dan Setara Kas">
                                                                                                                <option value="011">011-Uang Tunai</option>
                                                                                                                <option value="012">012-Tabungan</option>
                                                                                                                <option value="013">013-Giro</option>
                                                                                                                <option value="014">014-Deposito</option>
                                                                                                                <option value="019">019-Setara Kas Lainnya</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="Piutang">
                                                                                                                <option value="021">021-Piutang</option>
                                                                                                                <option value="022">022-Piutang Afiliasi(Piutang kepada pihak yang mempunyai hubungan istimewa sebagaimana dimaksud dalam Pasal 18 ayat(4) UU PPh)</option>
                                                                                                                <option value="023">023-Persediaan Usaha</option>
                                                                                                                <option value="029">029-Piutang Lainnya</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="Investasi">
                                                                                                                <option value="031">031-Saham yang dibeli untuk dijual kembali</option>
                                                                                                                <option value="032">032-Saham</option>
                                                                                                                <option value="033">033-Obligasi Perusahaan</option>
                                                                                                                <option value="034">034-Obligasi Pemerintah Indonesia(ORI, Surat Berharga Syariah Negara, dll)</option>
                                                                                                                <option value="035">035-Surat Utang Lainnya</option>
                                                                                                                <option value="036">036-Reksadana</option>
                                                                                                                <option value="037">037-Instrumen Derivatif</option>
                                                                                                                <option value="038">038-Penyertaan Modal dalam perusahaan lain yang tidak atas saham meliputi penyertaan modal pada CV, Firma dan sejenisnya</option>
                                                                                                                <option value="039">039-Investasi Lainnya</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="Alat Transportasi">
                                                                                                                <option value="041">041-Sepeda</option>
                                                                                                                <option value="042">042-Sepeda Motor</option>
                                                                                                                <option value="043">043-Mobil</option>
                                                                                                                <option value="049">049-Alat Transportasi Lainnya</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="Harta Bergerak">
                                                                                                                <option value="051">051-Logam Mulia(emas batangan, emas perhiasan, platina batangan, platina perhiasan, logam mulia lainnya)</option>
                                                                                                                <option value="052">052-Batu Mulia(Intan, Berlian, Batu Mulia lainnya)</option>
                                                                                                                <option value="053">053-Barang-Barang seni dan antik</option>
                                                                                                                <option value="054">054-Kapal Pesiar, Pesawat Terbang, Helikopter, Jetski, Peralatan Olah Raga Khusus</option>
                                                                                                                <option value="055">055-Peralatan Elektronik, Furnitur</option>
                                                                                                                <option value="059">059-Harta Bergerak Lainnya</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="Harta Tidak Bergerak">
                                                                                                                <option value="061">061-Tanah dan/atau bangunan untuk tempat tinggal</option>
                                                                                                                <option value="062">062-Tanah dan/atau bangunan untuk usaha (Toko, pabrik, gudang dan sejenisnya)</option>
                                                                                                                <option value="063">063-Tanah atau lahan untuk usaha(lahan pertanian, perkebunan, perikanan darat, dan sejenisnya)</option>
                                                                                                                <option value="069">069-Harta tidak bergerak lainnya</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="Harta Tidak Berwujud">
                                                                                                                <option value="071">071-Paten</option>
                                                                                                                <option value="072">072-Royalti</option>
                                                                                                                <option value="073">073-Merek Dagang</option>
                                                                                                                <option value="079">079-Harta tidak berwujud lainnya</option>
                                                                                                            </optgroup>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Nama Harta</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <textarea rows="2" id="DhJnsHarta" class="form-control form-control-sm" maxlength="500" placeholder=""></textarea>
                                                                                                        <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Tahun Perolehan</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <select class="form-control form-control-sm m-select2" id="DhThPerolehan" name="DhThPerolehan" style="width: 100%;"></select>
                                                                                                        <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Harga Perolehan</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input type="text" id="DhHarga" class="form-control form-control-sm uang" style="text-align: right; " placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Keterangan</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <textarea rows="2" id="DhKeterangan" maxlength="500" class="form-control form-control-sm"></textarea>
                                                                                                        <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" id="btnAddHarta" class="btn btn-djp btn-elevate btn-pill"><i class="fa fa-save"></i>
                                                                                                <span>Simpan</span>
                                                                                            </button>
                                                                                            <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal">Batal</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!---form--->
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc3" data-target="#acc31">
                                                                    <i class="fa fa-chevron-left"></i> Kembali Ke Daftar PPh Final
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc3" data-target="#acc33">
                                                                    Lanjut Ke Daftar Utang <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree2a">
                                                        <a href="#acc33" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc33">Bagian C: Kewajiban/Utang Pada Akhir Tahun
                                                        </a>
                                                    </div>
                                                    <div id="acc33" class="collapse" aria-labelledby="headingThree2a" data-parent="#acc3">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <div class="kt-form__section" style="display: flex">
                                                                                <div class="col-md-6">
                                                                                    <button id="utang_th_lalu" class="btn btn-djp btn-elevate btn-pill">Utang Pada SPT Tahun Lalu</button>
                                                                                </div>
                                                                                <div class="col-md-6" style="text-align:right">
                                                                                    <button id="utang_new" class="btn btn-djp btn-elevate btn-pill">
                                                                                        Tambah <i class="flaticon2-add-1"></i>
                                                                                        <span class="help-block"></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="kt-space-20"></div>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-djp table-md table-striped table-hover" id="tblHutang" role="grid" aria-describedby="tblHutang_info">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="font-size: small;text-align: center;width: 5%">Kode Utang</th>
                                                                                            <th style="font-size: small;text-align: center;width: 25%">Nama Pemberi Pinjaman</th>
                                                                                            <th style="font-size: small;text-align: center;width: 30%">Alamat Pemberi Pinjaman</th>
                                                                                            <th style="font-size: small;text-align: center;width: 10%">Tahun Peminjaman</th>
                                                                                            <th style="font-size: small;text-align: center;width: 20%">Jumlah</th>
                                                                                            <th style="font-size: small;text-align: center;width: 10%">Aksi</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <td colspan="4" style="font-weight: bold; text-align: right">Sub Total</td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtSubJBC" />
                                                                                            </td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="4" style="font-weight: bold;  text-align: right">Jumlah Bagian C (JBC)</td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control form-control-sm uang" style="text-align: right" readonly id="txtJBC" />
                                                                                            </td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                            <div id="divHutang" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="" style="padding-right: 12px" aria-hidden="true">
                                                                                <div class="modal-dialog modal-md" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title">Hutang Baru</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>

                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form>
                                                                                                <div class="form-group row my-2" id='divKodeHtg'>
                                                                                                    <label class="col-form-label col-md-4">Kode Utang</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <select class="form-control form-control-sm m-select2" id="DhKdHtg" name="DhKdHtg" style="width: 100%;">
                                                                                                            <option value=""></option>
                                                                                                            <option value="101">
                                                                                                                <label>101-Utang Bank/Lembaga Keuangan bukan bank(KPR, Leasing Kendaraan Bermotor, dan sejenisnya)</label>
                                                                                                            </option>
                                                                                                            <option value="102">
                                                                                                                <label>102-Kartu Kredit</label>
                                                                                                            </option>
                                                                                                            <option value="103">
                                                                                                                <label>103-Utang Afiliasi(Pinjaman dari pihak yang memiliki hubungan istimewa sebagaimana dimaksud dalam pasal 18 ayat(4) UU PPh)</label>
                                                                                                            </option>
                                                                                                            <option value="109">
                                                                                                                <label>109-Utang Lainnya</label>
                                                                                                            </option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Nama Pemberi Pinjaman</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input type="text" id="DuPemberi" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Alamat Pemberi Pinjaman</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input type="text" id="DuAlmtPemberi" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Tahun Peminjaman</label>
                                                                                                    <div class="col-md-4">
                                                                                                        <!--<input type="text" id="DuThPinjam" class="form-control" maxlength="4" style="text-align: left" placeholder="" >-->
                                                                                                        <select class="form-control form-control-sm m-select2" id="DuThPinjam" name="DhThPerolehan" style="width: 100%;"></select>
                                                                                                        <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Jumlah</label>
                                                                                                    <div class="col-md-4">
                                                                                                        <input type="text" id="DuJmlPinjaman" class="form-control form-control-sm uang" maxlength="500" style="text-align: right; " placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" id="btnTambahUtang" class="btn btn-djp btn-elevate btn-pill"><i class="fa fa-save"></i>
                                                                                                <span>Simpan</span>
                                                                                            </button>
                                                                                            <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal">Batal</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!---form--->
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc3" data-target="#acc32">
                                                                    <i class="fa fa-chevron-left"></i> Kembali Ke Daftar Harta
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc3" data-target="#acc34">
                                                                    Lanjut Ke Daftar Tanggungan <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingFour2a">
                                                        <a href="#acc34" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc34">Bagian D: Daftar Susunan Anggota Keluarga
                                                        </a>
                                                    </div>
                                                    <div id="acc34" class="collapse" aria-labelledby="headingFour2a" data-parent="#acc3">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <div class="kt-form__section" style="display: flex">
                                                                                <div class="col-md-6">
                                                                                    <button id="keluarga_th_lalu" class="btn btn-djp btn-elevate btn-pill">Tanggungan Pada SPT Tahun Lalu</button>
                                                                                </div>
                                                                                <div class="col-md-6" style="text-align:right">
                                                                                    <button id="keluarga_new" class="btn btn-djp btn-elevate btn-pill">
                                                                                        Tambah <i class="flaticon2-add-1"></i>
                                                                                        <span class="help-block"></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="kt-space-20"></div>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-djp table-md table-striped table-hover" id="tblTanggungan" role="grid" aria-describedby="tblTanggungan_info">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th style="font-size: small;text-align: center;width: 20%">Nama</th>
                                                                                            <th style="font-size: small;text-align: center;width: 20%">Tanggal Lahir</th>
                                                                                            <th style="font-size: small;text-align: center;width: 20%">NIK</th>
                                                                                            <th style="font-size: small;text-align: center;width: 20%">Hubungan Keluarga</th>
                                                                                            <th style="font-size: small;text-align: center;width: 20%">Pekerjaan</th>
                                                                                            <th style="font-size: small;text-align: center;width: 20%">Aksi</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                            <div id="divKeluarga" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="" style="padding-right: 12px" aria-hidden="true">
                                                                                <div class="modal-dialog modal-md" role="document">
                                                                                    <div class="modal-content">
                                                                                        <form id="frmKeluarga">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Input Data Keluarga</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>

                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <!--<form id="frmKeluarga">-->
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4 ">Nama</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input type="text" id="DkNmKel" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2" id="divTglLahir">
                                                                                                    <label class="col-md-4 ">Tanggal Lahir</label>
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="input-group date">
                                                                                                            <input id="DkTglLhr" type="text" class="form-control form-control-sm date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years" data-date-end-date="0d"/>
                                                                                                            <div class="input-group-append">
                                                                                                                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2" id="divNIK">
                                                                                                    <label class="col-md-4">NIK</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input type="text" name="DkNik" id="DkNik" class="form-control form-control-sm" maxlength="16" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Hubungan Keluarga</label>
                                                                                                    <div class="col-md-4">
                                                                                                        <input type="text" id="DkHubKel" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-md-4">Pekerjaan</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input type="text" id="DkPekerjaan" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!--</form>-->
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" id="btnAddKeluarga" class="btn btn-djp btn-elevate btn-pill"><i class="fa fa-save"></i>
                                                                                                    <span>Simpan</span>
                                                                                                </button>
                                                                                                <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal">Batal</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!---form--->
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc3" data-target="#acc33">
                                                                    <i class="fa fa-chevron-left"></i> Kembali Ke Daftar Utang
                                                                </button>
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
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" id="tab3">
                                        <div class="kt-form__section kt-form__section--first">
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-solid  accordion-toggle-arrow" id="acc2">
                                                <div class="card">
                                                    <div class="card-header" id="heading2One2a">
                                                        <a href="#acc21" class="card-title" data-toggle="collapse" aria-expanded="true" aria-controls="acc21">
                                                            Bagian A. Penghasilan Neto Dalam Negeri Lainnya(Tidak Termasuk Penghasilan Dikenakan PPh Final dan/atau Bersifat Final
                                                        </a>
                                                    </div>
                                                    <div id="acc21" class="collapse show" aria-labelledby="heading2One2a" data-parent="#acc2" style="">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">1</td>
                                                                                <td style="width: 55%">Bunga</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagA01" class="form-control form-control-sm uang bgIa" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">2</td>
                                                                                <td style="width: 55%">Royalti</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagA02" class="form-control form-control-sm uang bgIa" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">3</td>
                                                                                <td style="width: 55%">Sewa</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagA03" class="form-control form-control-sm uang bgIa" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">4</td>
                                                                                <td style="width: 55%">Hadiah</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagA04" class="form-control form-control-sm uang bgIa" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">5</td>
                                                                                <td style="width: 55%">Keuntungan dari Penjualan/Pengalihan Harta</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagA05" class="form-control form-control-sm uang bgIa" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">6</td>
                                                                                <td style="width: 55%">Penghasilan Lain</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagA06" class="form-control form-control-sm uang bgIa" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="special-td" colspan="2" style="width: 5%; text-align: center"> Jumlah Bagian A</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="txtJumlahA" class="form-control form-control-sm uang" style="text-align: right; font-weight: bold" readonly="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc2" data-target="#acc22">
                                                                    Lanjut ke B <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading2Two2a">
                                                        <a href="#acc22" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc22">
                                                            Bagian B : Penghasilan yang Tidak Termasuk Objek Pajak
                                                        </a>
                                                    </div>
                                                    <div id="acc22" class="collapse" aria-labelledby="heading2Two2a" data-parent="#acc2">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">1</td>
                                                                                <td style="width: 55%">Bantuan/Sumbangan/Hibah</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB01" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">2</td>
                                                                                <td style="width: 55%">Warisan</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB02" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">3</td>
                                                                                <td style="width: 55%">Bagian Laba Anggota Perseroan Komanditer tidak atas saham, persekutuan, perkumpulan, firma, kongsi</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB03" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">4</td>
                                                                                <td style="width: 55%">Klaim Asuransi Kesehatan, Kecelakaan, Jiwa, Dwiguna, Beasiswa</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB04" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">5</td>
                                                                                <td style="width: 55%">Beasiswa</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB05" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">6</td>
                                                                                <td style="width: 55%">Penghasilan Lainnya yang tidak termasuk Objek Pajak</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB06" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <!-- Tambahan 6a-6a-->
<!--                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center"></td>
                                                                                <td style="width: 55%">a. Penghasilan dari luar negeri yang diperoleh WNA dengan Keahlian Tertentu</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB06a" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center"></td>
                                                                                <td style="width: 55%">b. Penggantian atau imbalan sehubungan dengan pekerjaan atau jasa yang diberikan dalam bentuk natura dan/atau kenikmatan yang dikecualikan dari objek PPh</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB06b" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center"></td>
                                                                                <td style="width: 55%">c. Penghasilan lainnya yang dikecualikan dari objek Pajak Penghasilan</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="BagB06c" class="form-control form-control-sm uang bgIb" style="text-align: right">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>-->
                                                                            <!-- Tutup Tambahan 6a-6a-->
                                                                            <tr>
                                                                                <td class="special-td" colspan="2" style="width: 5%; text-align: center"> Jumlah Bagian B</td>
                                                                                <td style="width: 40%">
                                                                                    <input type="text" id="txtJumlahB" class="form-control form-control-sm uang" style="text-align: right; font-weight: bold" readonly="">
                                                                                        <span class="help-block"></span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc2" data-target="#acc21">
                                                                    <i class="fa fa-chevron-left"></i> Kembali ke A
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc2" data-target="#acc23">
                                                                    Lanjut ke Bukti Potong <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading2Three2a">
                                                        <a href="#acc23" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc23">
                                                            Bagian C : Daftar Pemotongan/Pemungutan PPh Oleh Pihak Lain dan PPh Yang Ditanggung Pemerintah </a>
                                                    </div>
                                                    <div id="acc23" class="collapse" aria-labelledby="heading2Three2a" data-parent="#acc2">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <div class="kt-align-right">
                                                                                <button id="buktiPotong_new" class="btn btn-djp btn-elevate btn-pill">
                                                                                    Tambah <i class="flaticon2-add-1"></i>
                                                                                    <span class="help-block"></span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="kt-space-20"></div>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-djp table-md table-striped table-hover" id="tblBuktiPotong" width="100%" style="display: table; width: 100%;" role="grid" aria-describedby="tblBuktiPotong_info">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th style="text-align: center; vertical-align: top; " width="30px">Nama Pemotong/Pemungut Pajak</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="20px">NPWP Pemotong/Pemungut Pajak</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="5px">Nomor Bukti Pemotongan/Pemungutan</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="5px">Tanggal Bukti Pemotongan/Pemungutan</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="10px">Jenis Pajak</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="15px">Jumlah PPh Yang Dipotong/Dipungut</th>
                                                                                            <th style="text-align: center; vertical-align: top;" width="20px ">Aksi</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <td colspan="5" style="font-weight: bold; text-align: right;" rowspan="1">JAC</td>
                                                                                            <td rowspan="1" colspan="1">
                                                                                                <input type="text" class="form-control form-control-sm uangskppkp" style="text-align: right" readonly="" id="txtJAC">
                                                                                            </td>
                                                                                            <td rowspan="1" colspan="1"></td>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                            <div id="divBuktiPotong" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="padding-right: 12px">
                                                                                <div class="modal-dialog modal-md" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title">Bukti Potong Baru</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>

                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-form-label col-md-7">Jenis Pajak</label>
                                                                                                    <div class="col-md-5">
                                                                                                        <div class="kt-input-icon">	
                                                                                                            <select id="BpJnsPajak" name="BpJnsPajak" class="form-control form-control-sm select2me" aria-required="true" aria-invalid="false" aria-describedby="">
                                                                                                                <option value=1>Pasal 21</option>
                                                                                                                <option value=2>Pasal 22</option>
                                                                                                                <option value=3>Pasal 23</option>
                                                                                                                <option value=4>Pasal 24</option>
                                                                                                                <option value=5>Pasal 26</option>
                                                                                                                <option value=6>DTP</option>
                                                                                                                <option id="skppkpOpt" value=7>SKPPKP</option>
                                                                                                            </select>
                                                                                                            <span class="help-block help-block-error valid" style="display: none;"></span>
                                                                                                        </div>
                                                                                                        <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-form-label col-md-7">NPWP Pemotong/ Pemungut Pajak</label>
                                                                                                    <div class="col-md-5">
                                                                                                        <input type="text" id="BpNpwpPemotong" class="form-control form-control-sm" maxlength="15" style="text-align: left" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-form-label col-md-7">Nama Pemotong/ Pemungut Pajak</label>
                                                                                                    <div class="col-md-5">
                                                                                                        <textarea rows="3" id="BpNmPemotong" class="form-control form-control-sm" readonly></textarea>
                                                                                                        <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-form-label col-md-7">Nomor Bukti Pemotongan/ Pemungutan</label>
                                                                                                    <div class="col-md-5">
                                                                                                        <input type="text" id="BpNoBuktiPotong" class="form-control form-control-sm" style="text-align: left" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-form-label col-md-7">Tanggal Bukti Pemotongan/ Pemungutan</label>
                                                                                                    <div class="col-md-5">
                                                                                                        <div class="input-group date">
                                                                                                            <input id="BpTglBuktiPotong" type="text" class="form-control form-control-sm date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years" data-date-end-date="0d"/>
                                                                                                            <div class="input-group-append">
                                                                                                                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <label class="col-form-label col-md-7">Jumlah PPh Yang Dipotong/ Dipungut</label>
                                                                                                    <div class="col-md-5">
                                                                                                        <input type="text" id="BpJmlPotong" class="form-control form-control-sm uangskppkp" style="text-align: right; " placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" id="btnAddBuktiPotong" class="btn btn-djp btn-elevate btn-pill">
                                                                                                <i class="fa fa-save"></i>
                                                                                                <span>Simpan</span>
                                                                                            </button>
                                                                                            <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal">Batal</button>
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
                                            <!--end::Accordion-->
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 3-->

                                    <!--begin: Form Wizard Step 4-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" id="tab4">
                                        <div class="kt-form__section kt-form__section--first">
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-solid  accordion-toggle-arrow" id="acc4">
                                                <div class="card" id="pnlStatusKawin">
                                                    <div class="card-header" id="heading3One2a">
                                                        <a href="#acc40" class="card-title" data-toggle="collapse" aria-expanded="true" aria-controls="acc40">IDENTITAS</a>
                                                    </div>
                                                    <div id="acc40" class="collapse show" aria-labelledby="heading3One2a" data-parent="#acc4" style="">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="form-group row my-3" id="divStatusNikah">
                                                                    <div class="col-md-1"></div>
                                                                    <label class="col-form-label col-md-4" style="text-align: right">Status Perkawinan</label>
                                                                    <div class="col-md-3">
                                                                        <div class="kt-input-icon">
                                                                            <div class="form-group my-1">
                                                                                <div class="kt-radio-list">
                                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                        <input type="radio" name="rbnikah" id="rbnikah1" value="1"> Tidak Kawin
                                                                                            <span></span>
                                                                                    </label>
                                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                        <input type="radio" name="rbnikah" id="rbnikah2" value="2"> Kawin
                                                                                            <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3"></div>
                                                                </div>
                                                                <div id="divKwjbnPajak" class="form-group row my-3">
                                                                    <div class="col-md-1"></div>
                                                                    <label class="col-form-label col-md-4" style="text-align: right">Status Kewajiban Perpajakan Suami-Isteri</label>
                                                                    <div class="col-md-3">
                                                                        <div class="kt-input-icon">
                                                                            <select class="form-control form-control-sm select2me" required="" id="ddlStatusKwjbnPajak" aria-required="true" aria-invalid="false"  name="ddlStatusKwjbnPajak">
                                                                                <option value="0">Tidak Kawin</option>
                                                                                <option value="1">KK / Kepala Keluarga</option>
                                                                                <option value="2">HB / Hidup Berpisah</option>
                                                                                <option value="3">PH / Pisah Harta</option>
                                                                                <option value="4">MT / Memilih Terpisah</option>
                                                                            </select>
                                                                            <span></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3"></div>
                                                                </div>
                                                                <div id="divNpwpPasangan" class="form-group row my-3">
                                                                    <div class="col-md-1"></div>
                                                                    <label class="col-form-label col-md-4" style="text-align: right">NPWP Isteri/Suami</label>
                                                                    <div class="col-md-3">
                                                                        <div class="kt-input-icon">
                                                                            <input type="text" placeholder="NPWP" maxlength="15" id="txtNpwpPasangan" name="txtNpwpPasangan" disabled="disabled" class="form-control form-control-sm">
                                                                                <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3"></div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc4" data-target="#acc41">
                                                                    Lanjut ke A <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading3Two2a">
                                                        <a href="#acc41" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc41">A. PENGHASILAN NETTO</a>
                                                    </div>
                                                    <div id="acc41" class="collapse" aria-labelledby="heading3Two2a" data-parent="#acc4">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp" id="indukA">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">1</td>
                                                                                <td style="width: 65%">Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk1" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">2</td>
                                                                                <td style="width: 65%">Penghasilan Neto Dalam Negeri Lainnya</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk2" class="form-control form-control-sm uang induk" style="text-align: right; " readonly="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">3</td>
                                                                                <td style="width: 65%">Penghasilan Neto Luar Negeri</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk3" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">4</td>
                                                                                <td style="width: 65%">Jumlah Penghasilan Neto (1+2+3)</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk4" class="form-control form-control-sm uang" style="text-align: right; " readonly="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">5</td>
                                                                                <td style="width: 65%"> Zakat/Sumbangan Keagamaan yang Sifatnya Wajib</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk5" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">6</td>
                                                                                <td style="width: 65%">Jumlah Penghasilan Neto setelah Pengurangan Zakat/Sumbangan Keagamaan yang sifatnya Wajib (4-5)</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk6" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc4" data-target="#acc40">
                                                                    <i class="fa fa-chevron-left"></i> Kembali ke Status
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc4" data-target="#acc42">
                                                                    Lanjut ke B <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading3Three2a">
                                                        <a href="#acc42" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc42">B. PENGHASILAN KENA PAJAK
                                                        </a>
                                                    </div>
                                                    <div id="acc42" class="collapse" aria-labelledby="heading3Three2a" data-parent="#acc4">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp" id="indukB">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">7</td>
                                                                                <td style="width: 25%">Penghasilan Tidak Kena Pajak/Jumlah Tanggungan
                                                                                </td>
                                                                                <td class="special-td" style="width: 30%; text-align: center">
                                                                                    <select id="IdkPtkp" class="form-control form-control-sm select2me" aria-invalid="false">
                                                                                        <option value="0">Tidak Kawin/TK</option>
                                                                                        <option value="1">Kawin/K</option>
                                                                                        <option value="2">Kawin Penghasilan Istri Digabung (K/I)</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td class="special-td" style="width: 10%; text-align: center">
                                                                                    <select id="Idk7" class="form-control form-control-sm select2me" aria-invalid="false">
                                                                                        <option value="0">0</option>
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk71" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="kt-portlet kt-portlet--bordered" id="panelPisahHarta" style="border-color:#F04DBA; display: block;">
                                                                        <div class="kt-portlet__head" style="background: #F04DBA;">
                                                                            <div class="kt-portlet__head-label">
                                                                                <h5 class="kt-portlet__head-title" style="color:white">
                                                                                    Panel Perhitungan PPh untuk Status PH atau MT
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-portlet__body" id="IdkBlokPisahHarta">
                                                                            <div class="form-group row  my-0" id="divStatusNikah">
                                                                                <div class="col-md-1"></div>
                                                                                <label class="col-form-label col-md-3" style="text-align: right">Lapor Sebagai</label>
                                                                                <div class="radio-list col-md-6">
                                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand col-md-5 my-2">
                                                                                        <input type="radio" name="rbpisahharta" id="rbsuami" value="1"> Suami
                                                                                            <span></span>
                                                                                    </label>
                                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                        <input type="radio" name="rbpisahharta" id="rbistri" value="2"> Istri
                                                                                            <span></span>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-md-1"></div>
                                                                            </div>
                                                                            <div class="form-group row my-2">
                                                                                <div class="col-md-1"></div>
                                                                                <label class="col-form-label col-md-3" style="text-align: right">Penghasilan Netto Suami</label>
                                                                                <div class="col-md-6">
                                                                                    <input type="text" id="idkPenghasilanSuami" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </div>
                                                                                <div class="col-md-1"></div>
                                                                            </div>
                                                                            <div class="form-group row my-2">
                                                                                <div class="col-md-1"></div>
                                                                                <label class="col-form-label col-md-3" style="text-align: right">Penghasilan Netto Istri</label>
                                                                                <div class="col-md-6">
                                                                                    <input type="text" id="idkPenghasilanIstri" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </div>
                                                                                <div class="col-md-1"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Portlet Kurang Bayar-->
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">8</td>
                                                                                <td style="width: 65%">Penghasilan Kena Pajak (6-7)</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk8" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc4" data-target="#acc41"> 
                                                                    <i class="fa fa-chevron-left"></i> Kembali ke A
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc4" data-target="#acc43">
                                                                    Lanjut ke C <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading3Four2a">
                                                        <a href="#acc43" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc43">C. PPh TERUTANG</a>
                                                    </div>
                                                    <div id="acc43" class="collapse" aria-labelledby="heading3Four2a" data-parent="#acc4">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp" id="indukC">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">9</td>
                                                                                <td style="width: 65%">PPh Terutang (Tarif Pasal 17 UU PPh x Angka 8)</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk9" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">10</td>
                                                                                <td style="width: 65%">Pengembalian/Pengurangan PPh Pasal 24 yang telah dikreditkan</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk10" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">11</td>
                                                                                <td style="width: 65%">Jumlah PPh Terutang (9+10)</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk11" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc4" data-target="#acc42">
                                                                    <i class="fa fa-chevron-left"></i> Kembali ke B
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc4" data-target="#acc44">
                                                                    Lanjut ke D <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading3Five2a">
                                                        <a href="#acc44" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc44">D. KREDIT PAJAK</a>
                                                    </div>
                                                    <div id="acc44" class="collapse" aria-labelledby="heading3Five2a" data-parent="#acc4">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp" id="indukD">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">12</td>
                                                                                <td style="width: 65%">PPh yang dipotong/dipungut pihak lain/ditanggung pemerintah dan/atau Kredit Pajak Luar Negeri dan/atau terutang di luar negeri</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk12" class="form-control form-control-sm uangskppkp induk" style="text-align: right; " readonly="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">13</td>
                                                                                <td style="width: 65%">PPh yang Harus Dibayar Sendiri</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk13" class="form-control form-control-sm uang" style="text-align: right; " placeholder="" readonly="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">14</td>
                                                                                <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; PPh Pasal 25</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk14a" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center"></td>
                                                                                <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; STP PPh Pasal 25 (Hanya Pokok Pajak)</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk14b" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr id="divFiskalLn">
                                                                                <td style="width: 5%; text-align: center"></td>
                                                                                <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; Fiskal Luar Negeri</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk14c" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">15</td>
                                                                                <td style="width: 65%"> Jumlah Kredit Pajak (14a + 14b + 14c)</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk15" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc4" data-target="#acc43">
                                                                    <i class="fa fa-chevron-left"></i> Kembali ke C
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc4" data-target="#acc45">
                                                                    Lanjut ke E <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading3Six2a">
                                                        <a href="#acc45" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc45">E. PPh KURANG/LEBIH BAYAR</a>
                                                    </div>
                                                    <div id="acc45" class="collapse" aria-labelledby="heading3Six2a" data-parent="#acc4">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp" id="indukD">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">16</td>
                                                                                <td style="width: 65%; color: rgb(0, 128, 0); font-weight: bold;" id="lblPph">Nihil</td>
                                                                                <td style="width: 30%">
                                                                                    <input type="text" id="Idk16" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr id="barisLebihBayar">
                                                                                <td style="width: 5%; text-align: center">17</td>
                                                                                <td style="width: 50%"> Permohonan : PPh Lebih Bayar pada angka 16 mohon</td>
                                                                                <td style="width: 45%">
                                                                                    <select class="form-control form-control-sm select2me" id="CbLebihBayar" aria-invalid="false">
                                                                                        <option value="">Pilih</option>
                                                                                        <option value="0">Direstitusikan</option>
                                                                                        <option value="1" disabled="disabled">Diperhitungkan dengan Utang Pajak</option>
                                                                                        <option value="2">Dikembalikan dengan SKPPKP Pasal 17 C (WP Patuh)</option>
                                                                                        <option value="3">Dikembalikan dengan SKPPKP Pasal 17 D (WP Tertentu)</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <!--begin::Portlet Kurang Bayar-->
                                                                    <div class="kt-portlet kt-portlet--bordered" id="panelPembayaran" style="border-color:#F04DBA;">
                                                                        <div class="kt-portlet__head" style="background: #F04DBA;">
                                                                            <div class="kt-portlet__head-label">
                                                                                <h5 class="kt-portlet__head-title" style="color:white">
                                                                                    Status SPT Anda adalah Kurang Bayar, sudahkah Anda melakukan pembayaran?
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-portlet__body">
                                                                            <div class="col-md-12">
                                                                                <div class="radio-list">
                                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                        <input type="radio" name="rdBayar" id="rb1" value="1"> <strong>Belum</strong>, <i>Saya akan membuat kode billing untuk melakukan pembayaran</i>
                                                                                            <span></span>
                                                                                    </label>
                                                                                    <br>
                                                                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                            <input type="radio" name="rdBayar" id="rb2" value="2"> <strong>Sudah</strong>, <i>Saya sudah melakukan pembayaran</i>
                                                                                                <span></span>
                                                                                        </label>
                                                                                </div>
                                                                            </div>

                                                                            <table class="table table-striped table-hover table-bordered mobile-djp" id="tblPembayaran" width="100%">
                                                                                <tbody>
                                                                                    <tr id="barisTglNtpn" style="display: table-row;">
                                                                                        <td style="width: 5%; text-align: center">-</td>
                                                                                        <td colspan="2" style="width: 65%">Tanggal Pelunasan</td>
                                                                                        <td style="width: 30%;">
                                                                                            <div class="input-group input-medium date">
                                                                                                <input id="tglSsp" name="tglSsp" type="text" class="form-control form-control-sm date-picker" readonly="" data-date-format="dd-mm-yyyy" data-date-viewmode="years" data-date-end-date="0d">
                                                                                                    <div class="input-group-append">
                                                                                                        <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr id="barisCreateBilling">
                                                                                        <td style="width: 5%; text-align: center"></td>
                                                                                        <td colspan="2" style="width: 65%;">Buat kode billing pembayaran pajak</td>
                                                                                        <td style="width: 30%;">
                                                                                            <button type="button" id="btnBilling" class="btn btn-djp btn-elevate btn-pill"><i class="fa fa-money-bill-alt"></i> Buat Kode Billing</button>
                                                                                            <span class="help-block"></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr id="barisKodeBilling" style="display: none">
                                                                                        <td style="width: 5%; text-align: center"></td>
                                                                                        <td colspan="2" style="width: 65%;"><strong>Kode Billing ini bukan kode pembayaran</strong>. silakan gunakan Kode Billing ini saat melakukan pembayaran pajak melalui Bank/Pos Persepsi</td>
                                                                                        <td style="width: 30%;">
                                                                                            <input type="text" class="form-control form-control-sm" readonly id="txtKodeBilling" />
                                                                                            <span class="help-block"></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr id="barisKodeBillingExpDate" style="display: none">
                                                                                        <td style="width: 5%; text-align: center"></td>
                                                                                        <td colspan="2" style="width: 65%;"><strong>Silakan membayar pajak melalui Bank/Pos Persepsi sebelum</strong></td>
                                                                                        <td style="width: 30%;">
                                                                                            <input type="text" class="form-control" readonly id="txtKodeBillingExpDate" />
                                                                                            <span class="help-block"></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

                                                                            <div class="form-group" id="formTblByr">
                                                                                <div class="col-md-12">
                                                                                    <div class="kt-align-right">
                                                                                        <div class="btn-group">
                                                                                            <button id="buktiBayar_new" class="btn btn-djp btn-elevate btn-pill">
                                                                                                Tambah <i class="flaticon2-add-1"></i>
                                                                                                <span class="help-block"></span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="kt-space-20"></div>
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-djp table-md table-striped table-hover" id="tblJnsPembayaran" width="100%" style="display: table; width: 100%;" role="grid" aria-describedby="tblJnsPembayaran_info">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th style="text-align: center; vertical-align: top;" width="20%">Jenis Pembayaran</th>
                                                                                                    <th style="text-align: center; vertical-align: top;" width="30%">NTPN/Nomor
                                                                                                        <br>Pemindahbukuan</th>
                                                                                                    <th style="text-align: center; vertical-align: top;" width="15%">Tanggal Pembayaran</th>
                                                                                                    <th style="text-align: center; vertical-align: top;" width="20%">Jumlah</th>
                                                                                                    <th style="text-align: center; vertical-align: top;" width="15%">Aksi</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                            </tbody>
                                                                                            <tfoot>
                                                                                                <tr>
                                                                                                    <td colspan="3" style="font-weight: bold; text-align: right">Jumlah</td>
                                                                                                    <td style="text-align: center; vertical-align: top;" width="30%">
                                                                                                        <input class="form-control form-control-sm uang" type="text" readonly id="txtJmlNtpnPbk" />
                                                                                                    </td>
                                                                                                    <td></td>
                                                                                                </tr>
                                                                                            </tfoot>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--Modal tombol tambah (awal)-->
                                                                            <div class="modal fade" id="divJnsPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 12px;" aria-hidden="true">
                                                                                <div class="modal-dialog modal-md" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran Baru</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form>
                                                                                                <div class="form-group row my-2">
                                                                                                    <div class="col-md-1"></div>
                                                                                                    <label class="col-form-label col-md-4">Jenis Pembayaran<span class="required" aria-required="true"> *</span></label>
                                                                                                    <div class="col-md-6">
                                                                                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                                            <input type="radio" name="rbPbyrn" id="rbByr1" value="1"> NTPN
                                                                                                                <span></span>
                                                                                                        </label>
                                                                                                        <br>
                                                                                                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                                                <input type="radio" name="rbPbyrn" id="rbByr2" value="2"> Pemindahbukuan
                                                                                                                    <span></span>
                                                                                                            </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <div class="col-md-1"></div>
                                                                                                    <label class="col-form-label col-md-4">NTPN/Nomor Pbk<span class="required" aria-required="true"> *</span></label>
                                                                                                    <div class="col-md-6">
                                                                                                        <input type="text" id="pbyrnNomor" class="form-control form-control-sm" maxlength="100" style="text-align: left" placeholder="">
                                                                                                            <span class="help-block"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <div class="col-md-1"></div>
                                                                                                    <label class="col-form-label col-md-4">Tanggal Pembayaran</label>
                                                                                                    <div class="col-md-6">
                                                                                                        <input type="text" id="pbyrnTglBuktiByr" class="form-control form-control-sm" readonly="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row my-2">
                                                                                                    <div class="col-md-1"></div>
                                                                                                    <label class="col-form-label col-md-4">Jumlah</label>
                                                                                                    <div class="col-md-6">
                                                                                                        <input type="text" id="pbyrnJml" class="form-control form-control-sm uang" readonly="">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" id="btnAddBuktiBayar" class="btn btn-djp btn-elevate btn-pill"><i class="fa fa-save"></i>
                                                                                                <span>Simpan</span>
                                                                                            </button>
                                                                                            <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal">Batal</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--Modal tombol tambah (tutup)-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Portlet Kurang Bayar-->
                                                                    <!--Portlet Lebih Bayar-->
                                                                    <div class="kt-portlet kt-portlet--bordered" id="panelUploadLampiran" style="border-color:#F04DBA;">
                                                                        <div class="kt-portlet__head" style="background: #F04DBA;">
                                                                            <div class="kt-portlet__head-label">
                                                                                <h5 class="kt-portlet__head-title" style="color:white">
                                                                                    Status SPT Anda adalah Lebih Bayar, Anda harus melampirkan keterangan dan/atau dokumen yang disyaratkan dalam SPT Elektronik sesuai dengan ketentuan perpajakan.
                                                                                    Dokumen yang dilampirkan dapat dilihat <a href="https://www.pajak.go.id/sites/default/files/2019-03/Kelengkapan_SPT.pdf                                            " target="_blank" style="text-decoration: none; background-color: transparent; color: black"><b>di sini</b></a>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-portlet__body">
                                                                            <form id="frmLampiran" method="POST" enctype="multipart/form-data">
                                                                                <div class="form-group row my-3">
                                                                                    <div class="col-md-1"></div>
                                                                                    <label class="col-md-2 col-form-label">Lampiran  <font color="red">*</font></label>
                                                                                    <div class="col-md-8">
                                                                                        <div class="kt-uppy" id="filepicker-pdf"> 
                                                                                            <div class="row">
                                                                                                <div class="kt-uppy__wrapper" style="padding:0 10px;"></div>
                                                                                                <span class="form-text text-muted col-md-8">Pastikan ekstensi file .pdf </span>  
                                                                                            </div>   
                                                                                            <div class="row">
                                                                                                <div class="kt-uppy__list col-md-8"></div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="kt-uppy__status col-md-8"></div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="kt-uppy__informer kt-uppy__informer--min col-md-8"></div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="kt-uppy__progress col-md-8"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row my-3">
                                                                                    <div class="col-md-3"></div>
                                                                                    <div class="col-md-8" style="text-align:left">
                                                                                        <button id="btn-start-upload" class="btn btn-djp btn-elevate btn-pill">
                                                                                            Start Upload <i class="fa fa-chevron-right"></i>
                                                                                            <span class="help-block"></span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="col-md-1"></div>
                                                                                </div>
                                                                                <input type="text" name="vThPajak" readonly class="form-control form-control-sm" style="display:none;"/>
                                                                                <input type="text" name="vRevNo" readonly class="form-control form-control-sm" style="display:none;"/>
                                                                                <input type="text" name="vToken" readonly class="form-control form-control-sm" style="display:none;"/>    
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Portlet Lebih Bayar-->
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc4" data-target="#acc44">
                                                                    <i class="fa fa-chevron-left"></i> Kembali ke D
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc4" data-target="#acc46">
                                                                    Lanjut ke F <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading3Seven2a">
                                                        <a href="#acc46" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc46">F. ANGSURAN PPh PASAL 25 TAHUN PAJAK BERIKUTNYA</a>
                                                    </div>
                                                    <div id="acc46" class="collapse" aria-labelledby="heading3Seven2a" data-parent="#acc4">
                                                        <div class="card-body">
                                                            <div class="kt-section">
                                                                <div class="kt-section__content">
                                                                    <table class="table table-striped table-hover table-bordered mobile-djp" id="indukD">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 5%; text-align: center">18</td>
                                                                                <td style="width: 30%">Angsuran PPh Pasal 25 Tahun Pajak Berikutnya Sebesar (Dihitung Berdasarkan)</td>
                                                                                <td class="special-td" style="width: 35%">
                                                                                    <select class="form-control form-control-sm" id="cbDsrHitPs25" aria-invalid="false">
                                                                                        <option value="0">Pilih..</option>
                                                                                        <option value="1">1/12 x Jumlah Pada Angka 13</option>
                                                                                        <option value="2">Penghitungan dalam lampiran tersendiri</option>
                                                                                    </select>
                                                                                    <span class="help-block"></span>
                                                                                </td>
                                                                                <td style="width: 30%; text-align: center">
                                                                                    <input type="text" class="form-control form-control-sm uang" id="IdkAngs25" style="text-align: right; " placeholder="">
                                                                                        <span class="help-block"></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="kt-align-right">
                                                                <button class="btn btn-secondary btn-elevate btn-pill" data-toggle="collapse" data-parent="#acc4" data-target="#acc45">
                                                                    <i class="fa fa-chevron-left"></i> Kembali ke E
                                                                </button>
                                                                <button class="btn btn-djp btn-elevate btn-pill" style="margin: auto 0 auto auto" data-toggle="collapse" data-parent="#acc4" data-target="#acc47">
                                                                    Lanjut ke Pernyataan <i class="fa fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading3Eight2a">
                                                        <a href="#acc47" class="card-title collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="acc47">Pernyataan</a>
                                                    </div>
                                                    <div id="acc47" class="collapse" aria-labelledby="heading3Eight2a" data-parent="#acc4">
                                                        <div class="card-body">
                                                            <p> Dengan menyadari sepenuhnya akan segala akibatnya termasuk sanksi-sanksi sesuai dengan ketentuan peraturan perundang-udangan yang berlaku saya menyatakan bahwa apa yang telah saya beritahukan di atas adalah benar, lengkap, jelas.</p>                                                            
                                                            <div class="col-md-12 d-flex justify-content-center">
                                                                <div class="kt-checkbox-list my-1">
                                                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                                                        <input type="checkbox" id="cbSetuju" name="cbSetuju"> Setuju
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
                                    <!--end: Form Wizard Step 4-->

                                    <!--begin: Form Wizard Step 5-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" id="divSubmit">
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-section" id="divSubmit">
                                                <div class="kt-section__title mb-3">
                                                    <h5>SPT Anda</h5>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label for="txtJnsSpt" class="col-md-3 col-form-label">Jenis Formulir</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="txtJnsSpt" name="txtJnsSpt" readonly value="" class="form-control form-control-sm">
                                                            <span class="help-block"></span>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label for="vThPajak" class="col-md-3 col-form-label">Tahun Pajak</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="vThPajak" name="vThPajak" readonly class="form-control form-control-sm">
                                                            <span class="help-block"></span>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label for="vRevno" class="col-md-3 col-form-label">Pembetulan Ke</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="vRevno" name="vRevno" readonly class="form-control form-control-sm">
                                                            <span class="help-block"></span>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label for="vStatusLbKbn" class="col-md-3 col-form-label">Status SPT</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="vStatusLbKbn" name="vStatusLbKbn" readonly class="form-control form-control-sm">
                                                            <span class="help-block"></span>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label for="vJmlLbkbn" class="col-md-3 col-form-label">Jumlah</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="vJmlLbkbn" name="vJmlLbkbn" readonly class="form-control form-control-sm uang">
                                                            <span class="help-block"></span>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label for="message-text" class="col-md-3 col-form-label">Catatan</label>
                                                    <div class="col-md-5">
                                                        <textarea class="form-control form-control-sm" name="vStatusPengiriman" id="vStatusPengiriman" readonly="readonly"></textarea>
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
                                                        <button id="btnAmbilToken2" type="button" class="btn btn-warning btn-sm" style="font-size: 14px">[di sini]</button>
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
                                                    <label for="divEmail" class="col-md-3 col-form-label">Masukkan kode verifikasi</label>
                                                    <div class="col-md-2">
                                                        <input type="text" id="txtToken" name="token" class="form-control form-control-sm" maxlength="6" size="6">
                                                            <div class="help-block" id="codeServer" style="display: none;"></div>
                                                            <span class="help-block"></span>
                                                    </div>
                                                </div>  
                                                <div class="form-group row my-2">
                                                    <div class="col-md-2"></div>
                                                    <label class="col-md-3 col-form-label"></label>
                                                    <div class="col-md-5">
                                                        <button type="button" class="btn btn-primary btn-djp btn-elevate btn-pill"  id="btnSubmitSpt">
                                                            <i class="fa fa-paper-plane"></i> Kirim SPT
                                                        </button>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>                                                                                             
                                            </div>
                                        </div>
                                    </div>       
                                    <!--end: Form Wizard Step 5-->
                                </div>
                                <!--end: Form Portlet_body-->

                                <div class="kt-portlet__foot">
                                    <!--begin: Form Actions -->
                                    <div class="kt-form__actions" style="display: flex">
                                        <button class="btn btn-warning btn-elevate btn-pill" data-ktwizard-type="action-prev" style="color: white;">
                                            <i class="fa fa-chevron-left"></i> Sebelumnya
                                        </button>
                                        <button class="btn btn-djp btn-elevate btn-pill" data-ktwizard-type="action-next" style="margin: auto 0 auto auto">
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
        <div id="divinfowp" class="modal fade show" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        <h6><strong>Konfirmasi Status NPWP Anda</strong></h6><br>
                        Anda perlu melakukan konfirmasi dengan status NPWP Anda. Silakan <strong>hubungi Account Representative KPP terdaftar</strong> untuk konfirmasi status NPWP Anda.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup</button>                                                  
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Info Wajib Pajak DPO -->
    
            
        <!-- begin:: Modal Prepopulated -->
        <div id="divPrepopulated" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12">
                                    <ul>
                                        <li>Sistem menemukan data pembayaran pajak Anda tahun Pajak <strong><label style="font-weight: bold" id="lblTahunPrep"></label></strong> melalui pemotongan pajak oleh pemberi kerja dan/atau pihak lainnya.</li>
                                        <li>Data yang tersedia merupakan data yang tersimpan dalam sistem Direktorat Jenderal Pajak, silakan teliti kembali atas kebenaran data tersebut.</li>
                                        <li>Data yang disediakan meliputi data :<br>
                                            - <strong>Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan dan Penghasilan Neto Dalam Negeri Lainnya;</strong><br>
                                            - <strong>Pengurangan;</strong><br>
                                            - <strong>PTKP;</strong><br>
                                            - <strong>Jumlah PPh yang Telah Dipotong;</strong><br>
                                            - <strong>Jumlah Penghasilan yang telah dikenakan PPh Pasal 21 Final;</strong><br>
                                            - <strong>Jumlah Penghasilan yang telah dikenakan PPh Pasal 22;</strong><br>
                                            - <strong>Jumlah Penghasilan yang telah dikenakan PPh Pasal 23;</strong><br>
                                            dan/atau <br>
                                            - <strong>Jumlah Penghasilan yang telah dikenakan PPh Pasal 4(2).</strong></li>
                                        <li>Apabila Anda memiliki bukti pemotongan yang lain/ jumlah pajak yang dipotong tidak sesuai dengan data yang disajikan, harap Anda ubah data yang tersedia sesuai dengan keadaan yang sebenarnya.</li>
                                    </ul>
                                </div>                                                    
                                <div class="form-group col-md-12">   
                                    <label class="col-md-12">
                                        Apakah Anda akan menggunakan data tersebut untuk pengisian SPT?
                                    </label>
                                    <div class="radio-list col-md-12">
                                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                                            <input type="radio" name="prepo" id="p1" value="1"> <b><i>Ya</i></b>, Saya akan gunakan data tersebut
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
                        <button id="btnPrepopulated" type="button" data-dismiss="modal" class="btn btn-djp btn-elevate btn-pill">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Prepopulated -->
    
            
        <!-- begin:: Modal Nihil dan Tidak Lengkap -->
        <div id="divInfoTLNhl"  class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">INFO</h4>
                    </div>
                    <div  class="modal-body">
                        Status SPT Anda adalah <b>Nihil</b> dan SPT Tahunan Anda Tidak Lengkap, hal tersebut dapat disebabkan karena :
                        <ul>
                            <li>Anda tidak mengisi daftar harta (Lampiran II Bagian B)</li>
                            <li>Anda tidak mengisi data bukti pemotongan dari pemberi kerja (Lampiran I Bagian C)</li>
                            <li>Daftar Harta, Daftar Utang, Daftar Keluarga apabila ada datanya, semua kolom harus terisi dan tidak ada data yang bernilai 0</li>
                            <li>Kolom Kode Harta pada tabel Daftar Harta tidak sesuai</li>
                            <li>Kolom Kode Utang pada tabel Daftar Utang tidak sesuai</li>
                        </ul>
                        Silakan klik tombol Langkah Berikutnya untuk menyimpan SPT ini sebagai DRAFT. Untuk dapat mengirim SPT, Anda harus melengkapi terlebih dahulu
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn default">Tutup</button>                                       
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Nihil dan Tidak Lengkap -->
    
            
        <!-- begin:: Modal Radio Kurang Bayar -->
        <div class="modal fade show" id="divInfoKB" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Status SPT Anda adalah <strong>Kurang Bayar</strong></p>
                        <p>Untuk dapat melakukan pembayaran pajak Anda, pastikan <strong>Kode Billing</strong> yang Anda buat dengan menggunakan :</p>
                        <ul>
                            <li><strong>Kode Map : 411125 - PPh Pasal 25/29 OP</strong></li>
                            <li><strong>Kode Jenis Setoran : 200 - Tahunan</strong></li>
                            <li><strong id="thPjkBilling">Tahun Pajak : </strong></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Radio Kurang Bayar -->
    
            
        <!-- begin:: Modal Kurang Bayar dan Tidak Lengkap-->
        <div id="divInfoTLKB" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>--> 
                    </div>
                    <div class="modal-body">
                        Status SPT Tahunan Anda adalah <b>Kurang Bayar</b> dan <b>Tidak Lengkap</b>.
                        <br><br>
                        Untuk dapat mengirim SPT, Anda harus melengkapi data pembayaran terlebih dahulu. Silakan klik tombol <b>Selanjutnya</b> untuk menyimpan SPT sebagai <b>DRAFT</b>.
                        <br><br>
                        Anda harus melakukan pembayaran sejumlah <b id="nilaiKB">Nilai Kurang Bayar</b> pada Bank/Pos Persepsi.
                        Pastikan <strong>Kode Billing</strong> yang Anda buat dengan menggunakan :</p>
                        <ul>
                            <li><strong>Kode Map : 411125 - PPh Pasal 25/29 OP</strong></li>
                            <li><strong>Kode Jenis Setoran : 200 - Tahunan</strong></li>
                            <li><strong id="thnPjkBilling">Tahun Pajak : </strong></li>
                        </ul>
                        Setelah melakukan pembayaran, masukkan data <b>NTPN atau Nomor Pemindahbukuan</b> pada formulir.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup</button>                                             
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Kurang Bayar dan Tidak Lengkap-->
    
            
        <!-- begin:: Modal Lebih Bayar -->
        <div id="divInfoLB" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        Status SPT Anda adalah <strong>Lebih Bayar</strong>
                        <ul>
                            <li>Pastikan Anda telah mengisi SPT (seluruh penghasilan, pengurang, PTKP dan PPh yang dipotong pihak lain) dengan benar dan lengkap</li>
                            <li>Kelebihan pembayaran pajak Anda dikembalikan setelah dilakukan <b>pemeriksaan atau penelitian</b></li>
                        </ul>

                        Silakan klik tombol Langkah Berikutnya untuk menyimpan SPT.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup</button>                                       
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Lebih Bayar -->
    
            
        <!-- begin:: Modal Lebih Bayar dan Tidak Lengkap-->
        <div id="divInfoTLLB" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        Status SPT Anda adalah <b>Lebih Bayar</b>
                        <ul>
                            <li>Pastikan Anda telah mengisi SPT (seluruh penghasilan, pengurang, PTKP dan PPh yang dipotong pihak lain) dengan benar dan lengkap</li>
                            <li>Kelebihan pembayaran pajak Anda dikembalikan setelah dilakukan <b>pemeriksaan atau penelitian</b></li>
                        </ul>

                        SPT Tahunan Anda Tidak Lengkap, hal tersebut dapat disebabkan karena:
                        <ul>
                            <li>Anda belum mengunggah keterangan dan/atau dokumen yang disyaratkan dalam SPT Elektronik dan/atau Anda belum memilih jenis Permohonan Pengembalian Kelebihan Pembayaran Pajak</li>
                        </ul>

                        Silakan klik tombol Langkah Berikutnya untuk menyimpan SPT ini sebagai DRAFT. Untuk dapat mengirim SPT, Anda harus melengkapi terlebih dahulu
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup</button>                                    
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Lebih Bayar dan Tidak Lengkap-->
    
            
        <!-- begin:: Modal Info Lebih Bayar -->
        <div id="divInfoPbyrnLebih" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                        <button type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup</button>                                                  
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Modal Info Lebih Bayar -->
    
            
        <!-- begin:: Modal NonEfektif-->
        <div id="divne" class="modal fade show" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INFO</h5>
                    </div>
                    <div class="modal-body">
                        <h3><strong>Penghasilan Anda di bawah PTKP</strong></h3> <br>
                        Berdasarkan ketentuan perpajakan, Anda TIDAK WAJIB menyampaikan SPT Tahunan dengan mengajukan permohonan Wajib Pajak Non Efektif (WP NE). Permohonan WP NE dapat <a href="https://www.pajak.go.id/id/formulir-permohonan-penetapan-wajib-pajak-non-efektif " target="_blank">diunduh di sini</a>
                    </div>
                    <div class="modal-footer">
                        <button id="btnDivNe" type="button" class="btn btn-djp btn-elevate btn-pill" data-dismiss="modal">Tutup</button>                                     
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
    
            
        <!-- begin:: Modal Token -->
        <div id="divToken" data-backdrop="static" data-keyboard="false" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <input type="radio" name="tokenvia" id="r1" value="0"> Email ke <b id="emailWp">{{ auth()->user()->email }}</b>
                                        <span></span>
                                    </label> <br>
                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                        <input type="radio" name="tokenvia" id="r2" value="1" disabled> SMS *) ke nomor <b id="notelpWp">{{ auth()->user()->mobile_phone }}</b>
                                        <span></span>
                                    </label><br>
                                    * Anda akan dikenakan biaya untuk pengiriman SMS Kode Verifikasi<br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnAmbilToken" type="button" class="btn btn-djp btn-elevate btn-pill">OK</button>
                        <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-dismiss="modal">Batal</button>
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

<script src="{{ url('/assets/js/djp/common/autoNumeric-min.js') }}" type="text/javascript"></script>
        
<script src="{{ url('/assets/vendors/general/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/vendors/general/jquery-validation/dist/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/vendors/general/jquery-validation/dist/localization/messages_id.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/vendors/custom/js/vendors/jquery-validation.init.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/vendors/custom/datatables/datatables.bundlemin1.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/vendors/general/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>

<script src="{{ url('/assets/js/djp/common/djpCommon.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/common/session.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/sptproses.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/lsbilling.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/lsasset.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/lsliability.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/lstang.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/lswithhold.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/lsfinal.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/procdataspt.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/uploadpdflb.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/components/uploadpdflbservice.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/upload/sha256.js') }}" type="text/javascript" ></script>
<script src="{{ url('/assets/js/djp/pages/upload/enc-base64-min.js') }}" type="text/javascript" ></script>
<script src="{{ url('/assets/js/djp/pages/components/submision.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/djp/pages/form/spt1770s.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/uppy/js/uppy.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/uppy/js/uppypdf.js') }}" type="text/javascript"></script>

<script>
    var spt1770 = "<?=$spt?>";
    var jns = "1770S";
    var infowp = "0";
    var vNpwp = "{{ auth()->user()->username }}";

    $(function() {
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