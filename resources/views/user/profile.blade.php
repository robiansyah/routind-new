@extends('layouts.metronic')

@section('title', 'Profil')
@section('content')
<div class="row">
    <!--begin::Col-->
    <div class="col-xxl-12">
        <!--begin::Timeline widget 2-->
        <div class="card h-xl-100" id="kt_timeline_widget_2_card">
            <!--begin::Header-->
            <div class="card-header position-relative py-0 border-bottom-2">
                <!--begin::Nav-->
                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3" role="tablist">
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0 active" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_1" aria-selected="true" role="tab">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Data Utama</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_4" aria-selected="false" role="tab" tabindex="-1">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Ubah Password</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Nav-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Tab Content-->
                <div class="tab-content">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade active show" id="kt_timeline_widget_2_tab_1" role="tabpanel">
                        <form action="{{ route('pelajar.profil.update') }}" method="POST">
                            @method('PUT')
                            @csrf

                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">NPWP Orang Pribadi</label>
                                    <input type="text" name="npwp" class="form-control form-control-solid" placeholder="NPWP" value="{!! auth()->user()->username !!}" readonly>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nama Lengkap</label>
                                    <!--begin::Input-->
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{!! auth()->user()->name !!}" required>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">NPWP Badan</label>
                                    <input type="text" name="npwp" class="form-control form-control-solid" placeholder="NPWP" value="{!! auth()->user()->npwp !!}" readonly>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nama Badan</label>
                                    <!--begin::Input-->
                                    <input type="text" class="form-control" placeholder="Badan" name="corporate_name" value="{!! auth()->user()->profile->corporate_name !!}" required>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Alamat</label>
                                    <textarea name="address" class="form-control" placeholder="Alamat" rows="3">{{ auth()->user()->profile->address }}</textarea>
                                </div>
                                <!--end::Col-->
                                @if(auth()->user()->wp_type==1)
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Kebangsaan</label>
                                    <!--begin::Input-->
                                    <select name="nationality" aria-label="Pilih Kebangsaan" data-control="select2" data-placeholder="Pilih Kebangsaan" class="form-select form-select-md form-select-solid" disabled>
                                        <option value="">Pilih Kebangsaan</option>
                                        <option value="WNI" {!! (auth()->user()->profile->nationality=='WNI') ? 'selected' : '' !!}>WNI</option>
                                        <option value="WNA" {!! (auth()->user()->profile->nationality=='WNA') ? 'selected' : '' !!}>WNA</option>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                @endif
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">No HP</label>
                                    <input type="number" name="mobile_phone" class="form-control" placeholder="No HP" value="{{ auth()->user()->mobile_phone }}" required>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Email</label>
                                    <!--begin::Input-->
                                    <input type="email" class="form-control form-control-solid" placeholder="Email" name="email" value="{{ auth()->user()->email }}" readonly>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="card-footer d-flex justify-content-end py-1 pt-5 px-9">
                                <a href="{{ route('pelajar.index') }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Ubah Data Utama</button>
                            </div>
                        </form>
                    </div>
                    <!--end::Tap pane-->
                    @if(auth()->user()->wp_type==1)
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_2" role="tabpanel">
                        <div class="card">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Cari" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--begin::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Add user-->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                    <i class="ki-outline ki-plus fs-2"></i>Tambah</button>
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body py-4">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed gy-5" id="tbl_keluarga">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No KK</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Hubungan</th>
                                                <th>Pekerjaan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody>
                                            
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                    <!--end::Tap pane-->
                    @elseif(auth()->user()->wp_type==2)
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_3" role="tabpanel">
                        <form action="">
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nama</label>
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Nama" name="name" value="{{ auth()->user()->name }}" readonly>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control form-control-solid" placeholder="Jabatan" value="PEMILIK" readonly>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">NPWP</label>
                                    <input type="text" name="npwp" class="form-control form-control-solid" placeholder="NPWP" value="{{ auth()->user()->username }}" readonly>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Kebangsaan</label>
                                    <!--begin::Input-->
                                    <select name="nationality" aria-label="Pilih Kebangsaan" data-control="select2" data-placeholder="Pilih Kebangsaan" class="form-select form-select-md form-select-solid" disabled>
                                        <option value="">Pilih Kebangsaan</option>
                                        <option value="WNI" {!! (auth()->user()->profile->nationality=='WNI') ? 'selected' : '' !!}>WNI</option>
                                        <option value="WNA" {!! (auth()->user()->profile->nationality=='WNA') ? 'selected' : '' !!}>WNA</option>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Alamat</label>
                                    <textarea name="address" class="form-control form-control-solid" placeholder="Alamat" rows="3" readonly>{{ auth()->user()->profile->address }}</textarea>
                                </div>
                                <!--end::Col-->
                            </div>
                        </form>
                    </div>
                    <!--end::Tap pane-->
                    @endif
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_4" role="tabpanel">
                        <!--begin::Form-->
                        <form class="form" method="POST" action="{{ route('pelajar.password.update') }}">
                            @csrf

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Password saat ini</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9 fv-row">
                                    <input type="password" name="password_old" class="form-control" placeholder="Password saat ini" required/>
                                    @error('password_old')
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Password baru (Min 8 Karakter)</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9 fv-row">
                                    <input type="password" name="password" class="form-control" placeholder="Password baru" required/>
                                    @error('password')
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Konfirmasi Password baru</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9 fv-row">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password baru" required/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="card-footer d-flex justify-content-end py-1 pt-5 px-9">
                                <a href="{{ route('pelajar.index') }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Ubah Password</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Tap pane-->
                </div>
                <!--end::Tab Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Tables Widget 2-->
    </div>
    <!--end::Col-->
</div>
@endsection

@section('js')

    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $("#tbl_keluarga").DataTable();
    </script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showMessage("", "{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}", 'Ok, got it!');
            </script>
        @endif
    @endforeach
@endsection