@extends('layouts.academy')
@section('title', 'Syarat dan Ketentuan')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
        <!--begin::Toolbar container-->
        <div class="d-flex flex-stack flex-row-fluid">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-column flex-row-fluid">
                <!--begin::Toolbar wrapper-->
                <!--begin::Page title-->
                <div class="page-title d-flex align-items-center me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-lg-2x gap-2">
                        <span>Syarat dan Ketentuan</span>
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                        <a href="{{ route('academy') }}" class="text-white text-hover-primary">
                            <i class="ki-outline ki-home text-gray-700 fs-6"></i>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">Academy</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">Syarat dan Ketentuan</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Contact-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <!--begin::Row-->
                <div class="card card-flush pt-3 mb-0">
                    <div class="card-header">
                        <div class="card-title">
                            <h1>Syarat dan Ketentuan (Terms and Conditions)</h1>
                        </div>
                    </div>

                    <div class="card-body pt-0 fs-6">

                        <h2>1. Ketentuan Umum</h2>
                        <p>Dengan mengakses dan menggunakan website routind.com , pengguna dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku.</p>
                        <p>Platform ini menyediakan layanan penjualan pembelajaran kelas online</p>

                        <h2 class="mt-10">2. Definisi</h2>
                        <ul>
                            <li>Kami: Routind Academy sebagai penyedia layanan</li>
                            <li>Pengguna: Individu yang mengakses dan membeli produk di website</li>
                            <li>Produk: Pelatihan Online yang dijual melalui website</li>
                        </ul>

                        <h2 class="mt-10">3. Pendaftaran dan Akun</h2>
                        <p>Pengguna wajib memberikan data yang benar dan akurat saat melakukan pendaftaran atau pembelian.</p>
                        <p>Pengguna bertanggung jawab atas keamanan akun masing-masing.</p>

                        <h2 class="mt-10">4. Transaksi dan Pembayaran</h2>
                        <ul>
                            <li>Semua transaksi dilakukan dalam mata uang Rupiah (IDR).</li>
                            <li>Pembayaran dilakukan melalui sistem payment gateway yang mendukung berbagai metode; virtual account, qris, dll</li>
                            <li>Setelah pembayaran berhasil, pengguna akan menerima akses ke produk sesuai ketentuan yang berlaku.</li>
                            <li>Kegagalan pembayaran akibat kesalahan pengguna bukan menjadi tanggung jawab kami.</li>
                        </ul>

                        <h2 class="mt-10">5. Akses Produk</h2>
                        <ul>
                            <li>Produk yang dibeli berupa pelatihan online.</li>
                            <li>Akses diberikan setelah pembayaran terverifikasi.</li>
                            <li>Pengguna dilarang membagikan, mendistribusikan, atau menjual ulang materi atau link materi tanpa izin tertulis dari routind.com</li>
                        </ul>

                        <h2 class="mt-10">6. Hak Kekayaan Intelektual</h2>
                        <p>Seluruh konten dalam platform Routind Academy dilindungi oleh hak cipta dan tidak boleh digunakan tanpa izin.</p>

                        <h2 class="mt-10">7. Perubahan Layanan</h2>
                        <p>Kami berhak mengubah, menambah, atau menghentikan layanan kapan saja dengan atau tanpa pemberitahuan sebelumnya.</p>

                        <h2 class="mt-10">8. Batasan Tanggung Jawab</h2>
                        <p>Kami tidak bertanggung jawab atas:</p>
                        <ul>
                            <li>Gangguan teknis di luar kendali (server, internet, dll)</li>
                            <li>Kesalahan pengguna dalam mengoperasikan layanan</li>
                            <li>Kerugian tidak langsung akibat penggunaan layanan</li>
                        </ul>

                        <h2 class="mt-10">9. Hukum yang Berlaku</h2>
                        <p>Syarat dan ketentuan ini tunduk pada hukum yang berlaku di Republik Indonesia.</p>

                        <hr class="my-10">

                        <h1>Ketentuan Pengembalian Dana (Refund Policy)</h1>

                        <h2 class="mt-5">1. Ketentuan Umum</h2>
                        <p>Karena produk yang dijual berupa produk digital (pelatihan online), pada prinsipnya pembelian bersifat final dan tidak dapat dikembalikan, kecuali dalam kondisi tertentu yang dijelaskan di bawah ini.</p>

                        <h2 class="mt-10">2. Kondisi yang Memungkinkan Refund</h2>
                        <p>Refund hanya dapat dilakukan apabila:</p>
                        <ul>
                            <li>Terjadi kesalahan sistem yang menyebabkan pengguna tidak mendapatkan akses setelah pembayaran berhasil</li>
                            <li>Terjadi double payment (pembayaran ganda) untuk transaksi yang sama</li>
                            <li>Pelatihan dibatalkan oleh pihak Routind Academy</li>
                        </ul>

                        <h2 class="mt-10">3. Kondisi yang Tidak Dapat Refund</h2>
                        <p>Refund tidak berlaku apabila:</p>
                        <ul>
                            <li>Pengguna berubah pikiran setelah membeli</li>
                            <li>Pengguna tidak memahami deskripsi produk sebelum membeli</li>
                            <li>Pengguna tidak memiliki waktu untuk mengikuti pelatihan</li>
                            <li>Kesalahan input data oleh pengguna</li>
                        </ul>

                        <h2 class="mt-10">4. Proses Pengajuan Refund</h2>
                        <ul>
                            <li>Pengguna wajib mengajukan refund maksimal 3 hari kalender setelah transaksi</li>
                            <li>Permohonan diajukan melalui email/whatsapp resmi Routind Academy dengan melampirkan:</li>
                            <li>Bukti pembayaran</li>
                            <li>Kronologi singkat</li>
                            <li>Tim kami akan melakukan verifikasi dalam waktu maksimal 5 hari kerja</li>
                        </ul>

                        <h2 class="mt-10">5. Metode Pengembalian Dana</h2>
                        <ul>
                            <li>Refund akan diproses melalui transfer bank ke rekening pengguna</li>
                            <li>Waktu proses pengembalian dana maksimal 7–14 hari kerja setelah disetujui</li>
                        </ul>

                        <h2 class="mt-10">6. Biaya Administrasi</h2>
                        <p>Biaya administrasi (jika ada) dari pihak bank atau payment gateway dapat dipotong dari jumlah refund</p>

                        <h2 class="mt-10">7. Kontak Resmi</h2>
                        <p>
                            Untuk pertanyaan atau pengajuan refund, silakan hubungi:<br>
                            Email: <a href="mailto:info@routind.com">info@routind.com</a><br>
                            WhatsApp: <a href="https://wa.me/6285947517463" target="_blank">0859-4751-7463</a>
                        </p>
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Card-->
                <div class="card mb-4 bg-light text-center">
                    <!--begin::Body-->
                    <div class="card-body py-12">
                        <!--begin::Icon-->
                        <a href="#" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="" loading="lazy">
                        </a>
                        <!--end::Icon-->
                        <!--begin::Icon-->
                        <a href="https://www.instagram.com/routind.academy_?igsh=MWNkbGhqcmptdXA4ZQ==" target="_blank" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="" loading="lazy">
                        </a>
                        <!--end::Icon-->
                        <!--begin::Icon-->
                        <a href="#" class="mx-4">
                            <img src="disc/assets/media/svg/brand-logos/twitter.svg" class="h-30px my-2" alt="" loading="lazy">
                        </a>
                        <!--end::Icon-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Contact-->
    </div>
@endsection