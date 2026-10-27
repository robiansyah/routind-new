@extends('layouts.metronic')
@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Pengaturan')
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
                        <a class="nav-link btn btn-color-muted px-0 active" data-bs-toggle="pill" href="#type" aria-selected="true" role="tab">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Jenis Wajib Pajak</span>
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
                        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#class" aria-selected="false" role="tab" tabindex="-1">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">Kelas</span>
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
                    <div class="tab-pane fade active show" id="type" role="tabpanel">
                        <form class="form" method="POST" action="{{ route('pelajar.setting.update', ['type'=>'wp_type']) }}">
                            @csrf

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label required fw-semibold fs-6">Jenis Wajib Pajak</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9 fv-row">
                                    <!--begin::Input-->
                                    <select name="wp_type" data-control="select2" data-placeholder="Pilih Jenis Wajib Pajak" class="form-select form-select-md">
                                        <option value="">Pilih Jenis Wajib Pajak</option>
                                        <option value="1" {!! (auth()->user()->wp_type=='1') ? 'selected' : '' !!}>Orang Pribadi</option>
                                        <option value="2" {!! (auth()->user()->wp_type=='2') ? 'selected' : '' !!}>Badan</option>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="card-footer d-flex justify-content-end py-1 pt-5 px-9">
                                <a href="{{ route('pelajar.index') }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Ubah WP</button>
                            </div>
                        </form>
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="class" role="tabpanel">
                        <!--begin::Form-->
                        <form class="form" method="POST" action="{{ route('pelajar.setting.update', ['type'=>'kelas']) }}">
                            @csrf

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">Kode Kelas</label>
                                <div class="col-lg-4 fv-row">
                                    <div class="input-group">
                                        <input type="text" name="code" id="code" placeholder="Kode Kelas" value="{!! ($kelas) ? $kelas->kelas->code : ''!!}" class="form-control" required>
                                        <button type="button" class="input-group-text" id="cek_kelas">
                                            <i class="ki-solid ki-shield-tick text-primary fs-2x"></i> Cek
                                        </button>
                                    </div>
                                </div>
                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">Nama Dosen</label>
                                <div class="col-lg-4 fv-row">
                                    <input type="text" name="dosen" id="dosen" placeholder="Nama Dosen" value="{!! ($kelas) ? $kelas->kelas->user->name : ''!!}" class="form-control form-control-solid" readonly>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">NIM</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-4 fv-row">
                                    <!--begin::Input-->
                                    <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa" value="{!! ($kelas) ? $kelas->nim : ''!!}" class="form-control" required>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="card-footer d-flex justify-content-end py-1 pt-5 px-9">
                                <a href="{{ route('pelajar.index') }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary" id="kelas_button">Ubah Data</button>
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

    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/setting.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showMessage("", "{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}", 'Ok, got it!');
            </script>
        @endif
    @endforeach
@endsection