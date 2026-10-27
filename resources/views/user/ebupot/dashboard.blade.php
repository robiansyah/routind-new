@extends('layouts.metronic')

@section('title', 'Arsip')
@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <span class="fw-bold text-dark fs-2">Daftar SPT Masa PPh Unifikasi yang telah dikirim</span>
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <!--begin::Filter-->
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Content-->
                    <div class="px-7 py-5">
                        <form method="GET" action="">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Tahun:</label>
                            {{-- <select name="year" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Pilih Tahun" data-allow-clear="true" data-hide-search="true">
                                @for($i = date('Y'); $i > date('Y')-3; $i--)
                                <option value="{{ $i }}" {!! ($year==$i) ? 'selected' : '' !!}>{{ $i }}</option>
                                @endfor
                            </select> --}}
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true">Batal</button>
                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true">Apply</button>
                        </div>
                        <!--end::Actions-->
                        </form>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed gy-5" id="tbl_spt">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-25px">#</th>
                    <th class="text-center">No.BPE/NTTE</th>
                    <th class="text-center">Masa/Tahun Pajak</th>
                    <th class="text-center">Pbtl Ke</th>
                    <th class="text-center">Tanggal Kirim</th>
                    <th class="w-150px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php $no=1;?>
                {{-- @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->start_period.'-'.$item->year }}</td>
                        <td>{{ $item->correction_to }}</td>
                        <td>@money($item->tax_value)</td>
                        <td>@money($item->payment_value)</td>
                        <td><span class="badge badge-{!! ($item->send_flag=='2') ? 'primary' : 'warning' !!}">{!! ($item->send_flag=='2') ? 'Lapor' : 'Posting' !!}</span></td>
                        <td><span class="badge badge-{!! ($item->send_flag=='2') ? 'primary' : 'warning' !!}">{!! ($item->send_flag=='2') ? 'Sukses Lapor' : 'Sukses Posting' !!}</span></td>
                        <td>
                            @if($item->send_flag!='2')
                            <a href="{{ route('pph21.spt.detail', ['id'=>$item->id]) }}" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat SPT">
                                <i class="fa fa-folder text-success"></i>
                            </a>
                            <a href="{{ route('pph21.spt.setor', ['id'=>$item->id]) }}" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Bukti Setor">
                                <i class="fa fa-money-bill text-primary"></i>
                            </a>
                            @if($item->payment_value >= $item->tax_value)
                            <a href="{{ route('pph21.spt.status', ['id'=>$item->id, 'status'=>'approval']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Mengupload SPT Ini?', 'captchaModal')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Lapor SPT">
                                <i class="fa fa-check-circle text-warning"></i>
                            </a>
                            @endif
                            <a href="{{ route('pph21.spt.status', ['id'=>$item->id, 'status'=>'destroy']) }}" onclick="confirmation(event, 'Apakah Anda Yakin Akan Menghapus SPT Ini?', 'captchaModal')" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus SPT">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                            @else
                            <button id="bpe" data-id="{{ $item->id }}" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat BPE">
                                <i class="fa fa-file-archive text-warning"></i>
                            </button>
                            <a href="#" class="btn btn-icon btn-active-light-primary w-25px h-25px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak SPT">
                                <i class="fa fa-print text-primary"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection
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

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px"
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
                        <p><strong>Deskripsi Form: </strong>Form ini menampilkan data SPT Masa PPh Unifikasi yang telah
                            disubmit (dikirim) secara elektronik ke Sistem DJP. Form ini juga menyajikan data bukti
                            potong yang dilaporkan dengan SPT tersebut.</p>
                        <ul style="padding-inline-start: 20px; font-weight: 600">Aksi yang dapat Anda lakukan antara
                            lain
                            <li>Mencetak bukti pengiriman secara elektronik (Bukti Penerimaan Elektronik).</li>
                            <li>Melihat detil daftar bukti potong pada SPT Masa PPh Unifikasi.</li>
                            <li>Mencetak SPT Masa PPh Unifikasi.</li>
                            <li>Unduh seluruh bukti potong pada SPT Masa PPh Unifikasi.</li>
                        </ul>
                        <p>Pada Bukti Penerimaan Elektronik (BPE) terdapat QRCode yang dapat digunakan untuk melakukan
                            pengecekan status SPT secara online, gunakan perangkat mobile yang telah dilengkapi QRCode
                            Scanner untuk memprosesnya.</p>
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
                                            <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z"
                                                  id="Combined-Shape" fill="#000000"/>
                                            <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z"
                                                  id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                        <h3 class="kt-portlet__head-title" style="color: white"></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <button id="btn-refresh" type="button" class="btn btn-sm btn-warning btn-elevate btn-pill"
                                style="color: #fff;">
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
                                        <th class="text-center">No</th>
                                        <th class="text-center">No.BPE/NTTE</th>
                                        <th class="text-center">Masa/Tahun Pajak</th>
                                        <th class="text-center">Pbtl Ke</th>
                                        <th class="text-center">Tanggal Kirim</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <h3 class="kt-portlet__head-title" style="color: white">Daftar bukti potong pada SPT Masa PPh
                            Unifikasi</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <button id="btn-excel" type="button" class="btn btn-sm btn-success btn-elevate btn-pill m-2">
                            <i class="fa fa-file-excel"></i> Unduh Excel
                        </button>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-section">
                        <div class="kt-section__content">
                            <div class="table-responsive">
                                <table class="table table-djp table-md table-striped table-hover" id="tbl_dftrbp">
                                    <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">ID Dipotong</th>
                                        <th class="text-center">Kode Objek Pajak</th>
                                        <th class="text-center">No Bukti Potong</th>
                                        <th class="text-center">Tanggal Bukti Potong</th>
                                        <th class="text-center">Jml Penghasilan Bruto (Rp)</th>
                                        <th class="text-center">PPh (Rp)</th>
                                        <th class="text-center">Keterangan</th>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.6/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundlemin1.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/djpcommon.js') }}" type="text/javascript"></script>
    <script src="{{ url('disc/assets/js/custom/pages/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/custom.js') }}" type="text/javascript"></script>
@endsection