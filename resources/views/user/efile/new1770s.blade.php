@extends('layouts.metronic')

@section('title', 'Buat SPT 1770S')
@section('css')

<link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Stepper-->
        <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
            <!--begin::Nav-->
            <div class="stepper-nav mb-5">
                <!--begin::Step 1-->
                <div class="stepper-item current" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Isi Data Formulir</h3>
                </div>
                <!--end::Step 1-->
                <!--begin::Step 2-->
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Lampiran II</h3>
                </div>
                <!--end::Step 2-->
                <!--begin::Step 3-->
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Lampiran I</h3>
                </div>
                <!--end::Step 3-->
                <!--begin::Step 4-->
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Induk</h3>
                </div>
                <!--end::Step 4-->
                <!--begin::Step 5-->
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Kirim SPT</h3>
                </div>
                <!--end::Step 5-->
            </div>
            <!--end::Nav-->
            <!--begin::Form-->
            <form class="mx-auto mw-800px w-100 pt-10 pb-10" novalidate="novalidate" id="kt_create_account_form">
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-10 pb-lg-15">
                            <!--begin::Title-->
                            <h2 class="fw-bold d-flex align-items-center text-dark">Data Formulir</h2>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tahun Pajak</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <select name="year" id="year" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-control form-select form-select-md">
                                    <option value="">Pilih Tahun Pajak</option>
                                    @for($i = date('Y'); $i > date('Y')-6; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Status SPT</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <div class="mt-3 d-flex">
                                    <div class="form-check form-check-custom me-10">
                                        <input class="form-check-input w-20px h-20px" type="radio" name="status" id="status1" value="normal" checked>
                                        <label class="form-check-label">
                                            Normal
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom me-10">
                                        <input class="form-check-input w-20px h-20px" type="radio" name="status" id="status2" value="pembetulan">
                                        <label class="form-check-label">
                                            Pembetulan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row fv-row">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Pembetulan Ke</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="txtPembetulanKe" id="txtPembetulanKe" class="form-control form-control-solid text-end" value="0" readonly>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 1-->
                <!--begin::Step 2-->
                <div data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-2 pb-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">
                                Bagian A. Penghasilan yang dikenakan PPh Final dan/atau bersifat final
                                <a href="javascript:void(0)" id="final_new" class="btn btn-icon btn-primary w-30px h-30px me-2" >
                                    <i class="ki-outline ki-plus fs-2"></i>
                                </a>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed gy-3" id="tblPphFinal">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>No</th>
                                        <th>Sumber/Jenis Penghasilan</th>
                                        <th>DPP/ Penghasilan Bruto</th>
                                        <th>PPh&nbsp;Terutang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">Jumlah</td>
                                        <td class="text-center">
                                            <input class="form-control form-control-sm form-control-solid text-end uang" type="text" readonly id="txtJBA" />
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div id="divFinal" class="modal fade" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bagian A. Penghasilan yang dikenakan PPh Final dan/atau bersifat final</h5>
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <i class="ki-outline ki-cross fs-1"></i>
                                        </div>
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
                                                        
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-md-4">PPh Terutang</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="txtPphFinal" class="form-control form-control-sm uang" style="text-align: right; " placeholder="">
                                                        
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" id="btnAddFinal" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Input-->
                                <input type="hidden" class="form-control form-control-lg form-control-solid" name="mharta" id="mharta"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">
                                Bagian B : Harta Pada Akhir Tahun
                                <a href="javascript:void(0)" id="harta_new" class="btn btn-icon btn-primary w-30px h-30px me-2" >
                                    <i class="ki-outline ki-plus fs-2"></i>
                                </a>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed gy-3" id="tblHarta">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Kode Harta</th>
                                        <th>Nama Harta</th>
                                        <th>Tahun Perolehan</th>
                                        <th>Harga Perolehan</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">Sub Total</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm form-control-solid text-end uang" readonly id="txtSubJBB" />
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">Jumlah Bagian B (JBB)</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm form-control-solid text-end uang" readonly id="txtJBB" />
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div id="divHarta" class="modal fade" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Harta Baru</h5>
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <i class="ki-outline ki-cross fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group row my-2" id='divKodeHarta'>
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
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-md-4">Tahun Perolehan</label>
                                                <div class="col-md-8">
                                                    <select class="form-control form-control-sm m-select2" id="DhThPerolehan" name="DhThPerolehan" style="width: 100%;"></select>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-md-4">Harga Perolehan</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="DhHarga" class="form-control form-control-sm uang" style="text-align: right; " placeholder="">
                                                        
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-md-4">Keterangan</label>
                                                <div class="col-md-8">
                                                    <textarea rows="2" id="DhKeterangan" maxlength="500" class="form-control form-control-sm"></textarea>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" id="btnAddHarta" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">
                                Bagian C: Kewajiban/Utang Pada Akhir Tahun
                                <a href="javascript:void(0)" id="utang_new" class="btn btn-icon btn-primary w-30px h-30px me-2" >
                                    <i class="ki-outline ki-plus fs-2"></i>
                                </a>
                            </h3>
                            <!--end::Title-->
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed gy-3" id="tblHutang">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>Kode Utang</th>
                                            <th>Nama Pemberi Pinjaman</th>
                                            <th>Alamat Pemberi Pinjaman</th>
                                            <th>Tahun Peminjaman</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end">Sub Total</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm form-control-solid uang" readonly id="txtSubJBC" />
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end">Jumlah Bagian C (JBC)</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm form-control-solid uang" readonly id="txtJBC" />
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div id="divHutang" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hutang Baru</h5>
                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                <i class="ki-outline ki-cross fs-1"></i>
                                            </div>
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
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-md-4">Alamat Pemberi Pinjaman</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="DuAlmtPemberi" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-md-4">Tahun Peminjaman</label>
                                                    <div class="col-md-8">
                                                        <!--<input type="text" id="DuThPinjam" class="form-control" maxlength="4" style="text-align: left" placeholder="" >-->
                                                        <select class="form-control form-control-sm m-select2" id="DuThPinjam" name="DhThPerolehan" style="width: 100%;"></select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-md-4">Jumlah</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="DuJmlPinjaman" class="form-control form-control-sm uang" maxlength="500" style="text-align: right; " placeholder="">
                                                            
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" id="btnTambahUtang" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Heading-->

                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">
                                Bagian D: Daftar Susunan Anggota Keluarga
                                <a href="javascript:void(0)" id="keluarga_new" class="btn btn-icon btn-primary w-30px h-30px me-2" >
                                    <i class="ki-outline ki-plus fs-2"></i>
                                </a>
                            </h3>
                            <!--end::Title-->
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed gy-3" id="tblTanggungan">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>NIK</th>
                                            <th>Hubungan Keluarga</th>
                                            <th>Pekerjaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div id="divKeluarga" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <form id="frmKeluarga">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Input Data Keluarga</h5>
                                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                    <i class="ki-outline ki-cross fs-1"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <!--<form id="frmKeluarga">-->
                                                <div class="form-group row my-2">
                                                    <label class="col-md-4 ">Nama</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="DkNmKel" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2" id="divTglLahir">
                                                    <label class="col-md-4 ">Tanggal Lahir</label>
                                                    <div class="col-md-4">
                                                        <div class="input-group date">
                                                            <input id="DkTglLhr" type="text" class="form-control form-control-sm date-picker"/>
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
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-md-4">Hubungan Keluarga</label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="DkHubKel" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-md-4">Pekerjaan</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="DkPekerjaan" class="form-control form-control-sm" maxlength="500" placeholder="">
                                                            
                                                    </div>
                                                </div>
                                                <!--</form>-->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" id="btnAddKeluarga" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Heading-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 2-->
                <!--begin::Step 3-->
                <div data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-2 pb-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">Bagian A. Penghasilan Neto Dalam Negeri Lainnya(Tidak Termasuk Penghasilan Dikenakan PPh Final dan/atau Bersifat Final</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center">1</td>
                                    <td style="width: 55%">Bunga</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagA01" class="form-control form-control-sm uang bgIa text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">2</td>
                                    <td style="width: 55%">Royalti</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagA02" class="form-control form-control-sm uang bgIa text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">3</td>
                                    <td style="width: 55%">Sewa</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagA03" class="form-control form-control-sm uang bgIa text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">4</td>
                                    <td style="width: 55%">Hadiah</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagA04" class="form-control form-control-sm uang bgIa text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">5</td>
                                    <td style="width: 55%">Keuntungan dari Penjualan/Pengalihan Harta</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagA05" class="form-control form-control-sm uang bgIa text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">6</td>
                                    <td style="width: 55%">Penghasilan Lain</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagA06" class="form-control form-control-sm uang bgIa text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="special-td" colspan="2" style="width: 5%; text-align: center"> Jumlah Bagian A</td>
                                    <td style="width: 40%">
                                        <input type="text" id="txtJumlahA" class="form-control form-control-sm uang" style="text-align: right; font-weight: bold" readonly="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">Bagian B : Penghasilan yang Tidak Termasuk Objek Pajak</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center">1</td>
                                    <td style="width: 55%">Bantuan/Sumbangan/Hibah</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagB01" class="form-control form-control-sm uang bgIb text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">2</td>
                                    <td style="width: 55%">Warisan</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagB02" class="form-control form-control-sm uang bgIb text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">3</td>
                                    <td style="width: 55%">Bagian Laba Anggota Perseroan Komanditer tidak atas saham, persekutuan, perkumpulan, firma, kongsi</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagB03" class="form-control form-control-sm uang bgIb text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">4</td>
                                    <td style="width: 55%">Klaim Asuransi Kesehatan, Kecelakaan, Jiwa, Dwiguna, Beasiswa</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagB04" class="form-control form-control-sm uang bgIb text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">5</td>
                                    <td style="width: 55%">Beasiswa</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagB05" class="form-control form-control-sm uang bgIb text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">6</td>
                                    <td style="width: 55%">Penghasilan Lainnya yang tidak termasuk Objek Pajak</td>
                                    <td style="width: 40%">
                                        <input type="text" id="BagB06" class="form-control form-control-sm uang bgIb text-end">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="special-td" colspan="2" style="width: 5%; text-align: center"> Jumlah Bagian B</td>
                                    <td style="width: 40%">
                                        <input type="text" id="txtJumlahB" class="form-control form-control-sm uang" style="text-align: right; font-weight: bold" readonly="">
                                </tr>
                            </tbody>
                        </table>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <div class="mb-10 fv-row">
                                <!--begin::Input-->
                                <input type="hidden" class="form-control form-control-lg form-control-solid" name="mbupot" id="mbupot"/>
                                <!--end::Input-->
                            </div>
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">
                                Bagian C : Daftar Pemotongan/Pemungutan PPh Oleh Pihak Lain dan PPh Yang Ditanggung Pemerintah
                                <a href="javascript:void(0)" id="buktiPotong_new" class="btn btn-icon btn-primary w-30px h-30px me-2" >
                                    <i class="ki-outline ki-plus fs-2"></i>
                                </a>
                            </h3>
                            <!--end::Title-->
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed gy-3" id="tblBuktiPotong">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
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
                                            <td colspan="5" class="text-end">JAC</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm form-control-solid uangskppkp text-end" readonly="" id="txtJAC">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            <div id="divBuktiPotong" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Bukti Potong Baru</h5>
                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                <i class="ki-outline ki-cross fs-1"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group row my-2">
                                                    <label class="col-form-label col-md-7">Jenis Pajak</label>
                                                    <div class="col-md-5">
                                                        <div class="kt-input-icon">	
                                                            <select id="BpJnsPajak" name="BpJnsPajak" class="form-control form-control-sm" aria-required="true" aria-invalid="false" aria-describedby="">
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
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-form-label col-md-7">NPWP Pemotong/ Pemungut Pajak</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="BpNpwpPemotong" class="form-control form-control-sm" maxlength="15" style="text-align: left" placeholder="">
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-form-label col-md-7">Nama Pemotong/ Pemungut Pajak</label>
                                                    <div class="col-md-5">
                                                        <textarea rows="3" id="BpNmPemotong" class="form-control form-control-sm"></textarea>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-form-label col-md-7">Nomor Bukti Pemotongan/ Pemungutan</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="BpNoBuktiPotong" class="form-control form-control-sm" style="text-align: left" placeholder="">
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-form-label col-md-7">Tanggal Bukti Pemotongan/ Pemungutan</label>
                                                    <div class="col-md-5">
                                                        <input id="BpTglBuktiPotong" type="text" class="form-control form-control-sm dates" />
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label class="col-form-label col-md-7">Jumlah PPh Yang Dipotong/ Dipungut</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="BpJmlPotong" class="form-control form-control-sm uangskppkp" style="text-align: right; " placeholder="">
                                                            
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" id="btnAddBuktiPotong" class="btn btn-primary">
                                                <i class="fa fa-save"></i>Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Heading-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 3-->
                <!--begin::Step 4-->
                <div data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-2 pb-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">IDENTITAS</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <div class="form-group row my-3" id="divStatusNikah" style="">
                            <div class="col-md-1"></div>
                            <label class="col-form-label col-md-4 text-end">Status Perkawinan</label>
                            <div class="col-md-3">
                                <div class="mt-3 d-flex">
                                    <div class="form-check form-check-custom form-check-sm me-10">
                                        <input class="form-check-input" type="radio" name="rbnikah" id="rbnikah1" value="1">
                                        <label class="form-check-label">
                                            Tidak Kawin
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-sm">
                                        <input class="form-check-input" type="radio" name="rbnikah" id="rbnikah2" value="2">
                                        <label class="form-check-label">
                                            Kawin
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div id="divKwjbnPajak" class="form-group row my-3">
                            <div class="col-md-1"></div>
                            <label class="col-form-label col-md-4 text-end">Status Kewajiban Perpajakan Suami-Isteri</label>
                            <div class="col-md-3">
                                <div class="kt-input-icon">
                                    <select class="form-control form-control-sm" required="" id="ddlStatusKwjbnPajak" aria-required="true" aria-invalid="false"  name="ddlStatusKwjbnPajak">
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
                            <label class="col-form-label col-md-4 text-end">NPWP Isteri/Suami</label>
                            <div class="col-md-3">
                                <div class="kt-input-icon">
                                    <input type="text" placeholder="NPWP" maxlength="15" id="txtNpwpPasangan" name="txtNpwpPasangan" disabled="disabled" class="form-control form-control-sm">
                                        
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">A. PENGHASILAN NETTO</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered" id="indukA">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center">1</td>
                                    <td style="width: 65%">Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk1" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">2</td>
                                    <td style="width: 65%">Penghasilan Neto Dalam Negeri Lainnya</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk2" class="form-control form-control-sm uang induk" style="text-align: right; " readonly="">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">3</td>
                                    <td style="width: 65%">Penghasilan Neto Luar Negeri</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk3" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">4</td>
                                    <td style="width: 65%">Jumlah Penghasilan Neto (1+2+3)</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk4" class="form-control form-control-sm uang" style="text-align: right; " readonly="">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">5</td>
                                    <td style="width: 65%"> Zakat/Sumbangan Keagamaan yang Sifatnya Wajib</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk5" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">6</td>
                                    <td style="width: 65%">Jumlah Penghasilan Neto setelah Pengurangan Zakat/Sumbangan Keagamaan yang sifatnya Wajib (4-5)</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk6" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">B. PENGHASILAN KENA PAJAK</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered" id="indukB">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center">7</td>
                                    <td style="width: 25%">Penghasilan Tidak Kena Pajak/Jumlah Tanggungan
                                    </td>
                                    <td class="special-td" style="width: 30%; text-align: center">
                                        <select id="IdkPtkp" class="form-control form-control-sm" aria-invalid="false"><option value="0">Tidak Kawin/TK</option><option value="1">Kawin/K</option><option value="2">Kawin Penghasilan Istri Digabung (K/I)</option></select>
                                    </td>
                                    <td class="special-td" style="width: 10%; text-align: center">
                                        <select id="Idk7" class="form-control form-control-sm" aria-invalid="false">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk71" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="p-5 my-5" id="panelPisahHarta">
                            <h3 class="fw-bold text-dark">
                                Panel Perhitungan PPh untuk Status PH atau MT
                            </h3>
                            <div class="mt-5 mb-5" id="IdkBlokPisahHarta">
                                <div class="form-group row  my-0" id="divStatusNikah">
                                    <div class="col-md-1"></div>
                                    <label class="col-form-label col-md-3 text-end">Lapor Sebagai</label>
                                    <div class="col-md-6">
                                        <div class="mt-3 d-flex">
                                            <div class="form-check form-check-custom me-10">
                                                <input class="form-check-input w-20px h-20px" type="radio" name="rbpisahharta" id="rbsuami" value="1">
                                                <label class="form-check-label">
                                                    Suami
                                                </label>
                                            </div>
                                            <div class="form-check form-check-custom me-10">
                                                <input class="form-check-input w-20px h-20px" type="radio" name="rbpisahharta" id="rbistri" value="2">
                                                <label class="form-check-label">
                                                    Istri
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="form-group row my-2">
                                    <div class="col-md-1"></div>
                                    <label class="col-form-label col-md-3 text-end">Penghasilan Netto Suami</label>
                                    <div class="col-md-6">
                                        <input type="text" id="idkPenghasilanSuami" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="form-group row my-2">
                                    <div class="col-md-1"></div>
                                    <label class="col-form-label col-md-3 text-end">Penghasilan Netto Istri</label>
                                    <div class="col-md-6">
                                        <input type="text" id="idkPenghasilanIstri" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                        </div>
                        <!--end::Portlet Kurang Bayar-->
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center">8</td>
                                    <td style="width: 65%">Penghasilan Kena Pajak (6-7)</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk8" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">C. PPh TERUTANG</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered" id="indukC">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center">9</td>
                                    <td style="width: 65%">PPh Terutang (Tarif Pasal 17 UU PPh x Angka 8)</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk9" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">10</td>
                                    <td style="width: 65%">Pengembalian/Pengurangan PPh Pasal 24 yang telah dikreditkan</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk10" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">11</td>
                                    <td style="width: 65%">Jumlah PPh Terutang (9+10)</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk11" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">D. KREDIT PAJAK</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered" id="indukD">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center">12</td>
                                    <td style="width: 65%">PPh yang dipotong/dipungut pihak lain/ditanggung pemerintah dan/atau Kredit Pajak Luar Negeri dan/atau terutang di luar negeri</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk12" class="form-control form-control-sm uangskppkp induk" style="text-align: right; " readonly="">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">13</td>
                                    <td style="width: 65%">PPh yang Harus Dibayar Sendiri</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk13" class="form-control form-control-sm uang" style="text-align: right; " placeholder="" readonly="">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">14</td>
                                    <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; PPh Pasal 25</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk14a" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center"></td>
                                    <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; STP PPh Pasal 25 (Hanya Pokok Pajak)</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk14b" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </td>
                                </tr>
                                <tr id="divFiskalLn" style="display: none;">
                                    <td style="width: 5%; text-align: center"></td>
                                    <td style="width: 65%">PPh Yang dibayar Sendiri --&gt; Fiskal Luar Negeri</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk14c" class="form-control form-control-sm uang induk" style="text-align: right; ">
                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%; text-align: center">15</td>
                                    <td style="width: 65%"> Jumlah Kredit Pajak (14a + 14b + 14c)</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk15" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">E. PPh KURANG/LEBIH BAYAR</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered" id="indukD">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center">16</td>
                                    <td style="width: 65%; color: green; font-weight: bold;" id="lblPph">Nihil</td>
                                    <td style="width: 30%">
                                        <input type="text" id="Idk16" class="form-control form-control-sm uang" style="text-align: right; " readonly="" placeholder="">
                                            
                                    </td>
                                </tr>
                                <tr id="barisLebihBayar" style="display: none;">
                                    <td style="width: 5%; text-align: center">17</td>
                                    <td style="width: 50%"> Permohonan : PPh Lebih Bayar pada angka 16 mohon</td>
                                    <td style="width: 45%">
                                        <select class="form-control form-control-sm" id="CbLebihBayar" aria-invalid="false">
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
                        <div class="p-5 my-5" id="panelPembayaran">
                            <h3 class="fw-bold text-danger">Status SPT Anda adalah Kurang Bayar, sudahkah Anda melakukan pembayaran?</h3>
                            <div class="col-md-12 mt-5">
                                <div class="mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rdBayar" id="rb1" value="1">
                                        <label class="form-check-label text-gray-800">
                                            <strong>Belum</strong>, <i>Saya akan membuat kode billing untuk melakukan pembayaran</i>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rdBayar" id="rb2" value="2">
                                        <label class="form-check-label text-gray-800">
                                            <strong>Sudah</strong>, <i>Saya sudah melakukan pembayaran</i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover table-bordered" id="tblPembayaran" width="100%">
                                <tbody>
                                    <tr id="barisTglNtpn" style="display: table-row;">
                                        <td style="width: 5%; text-align: center">-</td>
                                        <td colspan="2" style="width: 65%">Tanggal Pelunasan</td>
                                        <td style="width: 30%;">
                                            <input id="tglSsp" name="tglSsp" type="text" class="form-control form-control-sm dates" readonly="">
                                        </td>
                                    </tr>
                                    <tr id="barisCreateBilling">
                                        <td style="width: 5%; text-align: center"></td>
                                        <td colspan="2" style="width: 65%;">Buat kode billing pembayaran pajak</td>
                                        <td style="width: 30%;">
                                            <button type="button" id="btnBilling" class="btn btn-djp btn-elevate btn-pill"><i class="fa fa-money-bill-alt"></i> Buat Kode Billing</button>
                                        </td>
                                    </tr>
                                    <tr id="barisKodeBilling" style="display: none">
                                        <td style="width: 5%; text-align: center"></td>
                                        <td colspan="2" style="width: 65%;"><strong>Kode Billing ini bukan kode pembayaran</strong>. silakan gunakan Kode Billing ini saat melakukan pembayaran pajak melalui menu Billing, submenu Virtual Payment</td>
                                        <td style="width: 30%;">
                                            <input type="text" class="form-control form-control-sm" readonly id="txtKodeBilling" />
                                        </td>
                                    </tr>
                                    <tr id="barisKodeBillingExpDate" style="display: none">
                                        <td style="width: 5%; text-align: center"></td>
                                        <td colspan="2" style="width: 65%;"><strong>Silakan membayar pajak melalui menu Billing, submenu Virtual Payment sebelum</strong></td>
                                        <td style="width: 30%;">
                                            <input type="text" class="form-control form-control-sm" readonly id="txtKodeBillingExpDate" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="form-group" id="formTblByr">
                                <div class="col-md-12">
                                    <div class="kt-align-right">
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" id="buktiBayar_new" class="btn btn-primary">
                                                Tambah <i class="ki-outline ki-plus fs-2"></i>
                                            </a>
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
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2>Bukti Pembayaran Baru</h2>
                                            <!--begin::Close-->
                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                <i class="ki-outline ki-cross fs-1"></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-1"></div>
                                                    <label class="col-form-label required col-md-4">Jenis Pembayaran</label>
                                                    <div class="col-md-6">
                                                        <div class="mb-10 d-flex">
                                                            <div class="form-check form-check-custom me-10">
                                                                <input class="form-check-input" type="radio" name="rbPbyrn" id="rbByr1" value="1" checked>
                                                                <label class="form-check-label">
                                                                    NTPN
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-custom me-10">
                                                                <input class="form-check-input" type="radio" name="rbPbyrn" id="rbByr2" value="2">
                                                                <label class="form-check-label">
                                                                    Pemindahbukuan
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <div class="col-md-1"></div>
                                                    <label class="col-form-label required col-md-4">NTPN/Nomor Pbk</label>
                                                    <div class="col-md-6">
                                                        <input type="text" id="pbyrnNomor" class="form-control form-control-sm" maxlength="100" style="text-align: left" placeholder="">
                                                            
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
                                            <button type="button" class="btn btn-secondary btn-elevate btn-pill" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" id="btnAddBuktiBayar" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Modal tombol tambah (tutup)-->
                        </div>
                        <!--end::Portlet Kurang Bayar-->
                        <!--Portlet Lebih Bayar-->
                        <div class="p-5 my-5" id="panelUploadLampiran">
                            <h3 class="fw-bold">
                                Status SPT Anda adalah Lebih Bayar, Anda harus melampirkan keterangan dan/atau dokumen yang disyaratkan dalam SPT Elektronik sesuai dengan ketentuan perpajakan.
                                Dokumen yang dilampirkan dapat dilihat <a href="#"><b>di sini</b></a>
                            </h3>
                            <div class="mt-5 mb-5">
                                <form id="frmLampiran" method="POST" enctype="multipart/form-data">
                                    <div class="form-group row my-3">
                                        <div class="col-md-1"></div>
                                        <label class="col-md-2 required col-form-label">Lampiran </label>
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
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">F. ANGSURAN PPh PASAL 25 TAHUN PAJAK BERIKUTNYA</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <table class="table table-striped table-hover table-bordered" id="indukD">
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
                                        
                                    </td>
                                    <td style="width: 30%; text-align: center">
                                        <input type="text" class="form-control form-control-sm uang" id="IdkAngs25" style="text-align: right; " placeholder="">
                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--begin::Heading-->
                        <div class="py-2 py-lg-5">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-dark">Pernyataan</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <p> Dengan menyadari sepenuhnya akan segala akibatnya termasuk sanksi-sanksi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku saya menyatakan bahwa apa yang telah saya beritahukan di atas adalah benar, lengkap, jelas.</p>
                        <div class="col-md-12 d-flex justify-content-center">
                            <label class="form-check form-check-custom">
                                <!--begin::Input-->
                                <input class="form-check-input h-20px w-20px" type="checkbox" id="setuju" name="setuju" />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label text-gray-800">Setuju</span>
                                <!--end::Label-->
                            </label>
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 4-->
                <!--begin::Step 5-->
                <div data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-8 pb-lg-10">
                            <!--begin::Title-->
                            <h2 class="fw-bold text-dark">Selamat SPT Berhasil Dibuat!!</h2>
                            <!--end::Title-->
                            <!--begin::Notice-->
                            <div class="text-muted fw-semibold fs-6">
                                Silakan Kirim SPT Anda untuk Melaporkannya.
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Jenis Formulir</label>
                            <div class="col-lg-8">
                                <input type="text" id="txtJnsSpt" name="txtJnsSpt" readonly value="" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Tahun Pajak</label>
                            <div class="col-lg-8">
                                <input type="text" id="vThPajak" name="vThPajak" readonly class="form-control">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Pembetulan Ke</label>
                            <div class="col-lg-8">
                                <input type="text" id="vRevno" name="vRevno" readonly class="form-control">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Status SPT</label>
                            <div class="col-lg-8">
                                <input type="text" id="vStatusLbKbn" name="vStatusLbKbn" readonly class="form-control">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Jumlah</label>
                            <div class="col-lg-8">
                                <input type="text" id="vJmlLbkbn" name="vJmlLbkbn" readonly class="form-control uang">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Catatan</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" name="vStatusPengiriman" id="vStatusPengiriman" readonly="readonly"></textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Kode Keamanan</label>
                            <div class="col-lg-8 captcha" id="reload">
                                <span>{!! captcha_img() !!}</span>
                                <p style="margin: 0 4px; font-size: 12px;">klik untuk ubah kode</p>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label">Masukkan Kode Keamanan</label>
                            <div class="col-lg-3">
                                <input type="text" id="txtToken" name="token" class="form-control" maxlength="4" size="4">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 col-form-label"></label>
                            <div class="col-lg-8">
                                <button type="button" class="btn btn-primary" id="btnSubmitSpt">
                                    <i class="fa fa-paper-plane"></i> Kirim SPT
                                </button>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 5-->
                <!--begin::Actions-->
                <div class="d-flex flex-stack pt-15">
                    <!--begin::Wrapper-->
                    <div class="mr-2">
                        <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                        <i class="ki-outline ki-arrow-left fs-4 me-1"></i>Sebelumnya</button>
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Wrapper-->
                    <div>
                        <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit" disabled>
                            <span class="indicator-label">Simpan
                            <i class="ki-outline ki-arrow-right fs-3 ms-2 me-0"></i></span>
                            <span class="indicator-progress">Mohon Tunggu...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Selanjutnya
                        <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i></button>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Stepper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection
@section('modal')

<!-- begin:: Modal Radio Kurang Bayar -->
<div class="modal fade show" id="divInfoKB" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2>INFO</h2>
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- end:: Modal Radio Kurang Bayar -->
<!-- begin:: Modal Token -->
<div class="modal fade" id="divToken" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Pilih media pengiriman Kode Verifikasi</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <div class="modal-body">
                <div class="mb-5 fv-row fv-plugins-icon-container">
                    <label class="d-flex flex-stack mb-5 cursor-pointer">
                        <!--begin:Label-->
                        <span class="d-flex align-items-center me-2">
                            <!--begin::Icon-->
                            <span class="symbol symbol-50px me-6">
                                <span class="symbol-label">
                                    <i class="ki-outline ki-sms fs-1 text-gray-600"></i>
                                </span>
                            </span>
                            <!--end::Icon-->
                            <!--begin::Description-->
                            <span class="d-flex flex-column">
                                <span class="fw-bold text-gray-800 text-hover-primary fs-5">{{ auth()->user()->email }}</span>
                                <span class="fs-6 fw-semibold text-muted">Kirim Kode Verifikasi ke Email</span>
                            </span>
                            <!--end:Description-->
                        </span>
                        <!--end:Label-->
                        <!--begin:Input-->
                        <span class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="tokenvia" id="r1" value="0" checked>
                        </span>
                        <!--end:Input-->
                    </label>
                </div>
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnAmbilToken" class="btn btn-primary">Ok</button>
            </div>
            <!--end::Modal footer-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!-- end:: Modal Token -->
@endsection
@section('js')

<script src="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/session.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/sptproses.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/lsbilling.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/lsasset.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/lsliability.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/lstang.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/lswithhold.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/lsfinal.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/procdataspt.js') }}" type="text/javascript"></script>
<script src="{{ url('disc/assets/js/custom/form/submision.js') }}"></script>
<script src="{{ url('disc/assets/js/custom/form/spt1770s.js') }}"></script>
<script>
    var spt1770 = "<?= $spt ?>";
    var jns = "1770SS";
    var infowp = "0";
    var vNpwp = "{{ auth()->user()->username }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection