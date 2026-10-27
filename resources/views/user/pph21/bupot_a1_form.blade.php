@extends('layouts.metronic')

@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Tambah Bukti Potong A1')
@section('content')
    <!--begin::Form-->
    <form class="form" id="myForm" method="POST" action="{{ route('pph21.a1.store') }}">
        @csrf

        <!--begin::Data Pembeli-->
        <div class="card mb-2 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Informasi Umum</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Masa Awal Periode Penghasilan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <select name="period" id="period" aria-label="Pilih Masa Pajak" data-control="select2" data-placeholder="Pilih Masa Pajak" class="form-select form-select-md" required>
                                <option value="">Pilih Masa Pajak</option>
                                @for($i = 1; $i<= 12; $i++)
                                    <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-4 fv-row">
                            <select name="year" id="year" aria-label="Pilih Tahun Pajak" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-select form-select-md" required>
                                <option value="">Pilih Tahun Pajak</option>
                                @for($i = date('Y'); $i > date('Y')-3; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Masa Akhir Periode Penghasilan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <select name="end_period" id="end_period" aria-label="Pilih Masa Pajak" data-control="select2" data-placeholder="Pilih Masa Pajak" class="form-select form-select-md" required>
                                <option value="">Pilih Masa Pajak</option>
                                @for($i = 1; $i<= 12; $i++)
                                    <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-4 fv-row">
                            <select name="end_year" id="end_year" aria-label="Pilih Tahun Pajak" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-select form-select-md" required>
                                <option value="">Pilih Tahun Pajak</option>
                                @for($i = date('Y'); $i > date('Y')-3; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">NPWP/NIK</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="nik" id="nik" class="form-control" value="" required/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="name" id="name" class="form-control" value="" required/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Alamat</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <textarea name="address" id="address" rows="3" class="form-control"></textarea>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">PTKP</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select name="ptkp_code" id="ptkp_code" data-kt-select2="true" data-placeholder="Pilih PTKP" class="form-select form-select-md">
                                <option value="">Pilih PTKP</option>
                                <option value="00">TK/0</option>
                                <option value="01">TK/1</option>
                                <option value="02">TK/2</option>
                                <option value="03">TK/3</option>
                                <option value="10">K/0</option>
                                <option value="11">K/1</option>
                                <option value="12">K/2</option>
                                <option value="13">K/3</option>
                                <option value="20">K/I/0</option>
                                <option value="21">K/I/1</option>
                                <option value="22">K/I/2</option>
                                <option value="23">K/I/3</option>
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Posisi</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" class="form-control" name="position" id="position" placeholder="Posisi" required>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Kode Objek Pajak</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select name="object_code" id="object_code" data-kt-select2="true" data-placeholder="Pilih Kode Objek Pajak" class="form-select form-select-md">
                                <option value="">Pilih Kode Objek Pajak</option>
                                @foreach ($objects as $item)
                                    <option value="{{ $item->kdObjPjk }}">{{ $item->kdObjPjk.' - '.$item->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Data Umum-->

        <!--begin::Data Gaji-->
        <div class="card mb-2 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Gross Income</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <span id="penghasilan">
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Gaji/Pensiun atau THT/JHT</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="salary" id="salary" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Tunjangan PPh</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="pph" id="pph" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Tunjangan Lainnya, Uang Lembur, dan sebagainya</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="other" id="other" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Honorarium dan Imbalan Lainnya Sejenisnya</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="honorarium" id="honorarium" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Premi Asuransi yang dibayar Pemberi Kerja</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="premi" id="premi" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Natura dan Kenikmatan Lainnya</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="natura" id="natura" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Tantiem, Bonus, Gratifikasi, Jasa Produksi dan THR</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="thr" id="thr" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    </span>
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Jumlah Penghasilan Bruto</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="bruto" id="bruto" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Data Gaji-->

        <!--begin::Data Pengurangan-->
        <div class="card mb-2 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Pengurangan</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Biaya Jabatan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="position_fee" id="position_fee" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <span id="pengurang">
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Iuran Pensiun atau Iuran THT/JHT</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="pension" id="pension" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Zakat/Iuran Wajib Keagamaan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="zakat" id="zakat" class="form-control form-control-sm uang text-end" value="0"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    </span>
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Jumlah Pengurangan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="pengurangan" id="pengurangan" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Data Pengurangan-->

        <!--begin::Data Pengurangan-->
        <div class="card mb-2 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Perhitungan Pajak</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Jumlah Penghasilan Netto</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="nett" id="nett" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Jumlah Penghasilan Netto untuk PPh 21 (Setahun/Disetahunkan)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="netto" id="netto" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Penghasilan Tidak Kena Pajak</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="ptkp" id="ptkp" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">Penghasilan Kena Pajak Setahun/Disetahunkan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="pkp" id="pkp" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">PPh 21 atas PKP Setahun/Disetahunkan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="pph21" id="pph21" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">PPh 21 Terutang</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="terutang" id="terutang" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <span id="sebelum">
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">PPh 21 Dipotong dari Bupot Sebelumnya</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="previous" id="previous" class="form-control form-control-sm uang text-end" value="0" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    </span>
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">PPh 21 Terutang pada Bupot Ini</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="lebih" id="lebih" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">PPh 21 yang Dipotong/Ditanggung Pemerintah</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="ditanggung" id="ditanggung" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-8 col-form-label required fw-semibold fs-6">PPh 21 Kurang (Lebih) Dipotong pada Masa Pajak Terkahir</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="akhir" id="akhir" class="form-control form-control-solid form-control-sm uang text-end" value="0" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="no" id="no">
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('pph21.bupot', ['type'=>'a1']) }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Data Pengurangan-->
    </form>
    <!--end::Form-->
@endsection
@section('js')

    <script>
        var item_id = {{ $id }}
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/pph21/a1.js?v=29') }}"></script>

    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection
