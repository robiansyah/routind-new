@extends('layouts.metronic')

@section('css')

    <link href="{{ url('disc/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Faktur Keluaran')
@section('content')
<!--begin::Form-->
<form class="form" id="myForm" method="POST" action="{{ route('faktur.pajak.update', ['type'=>'keluaran', 'id'=>$data->id]) }}">
    @method('PUT')
    @csrf

    <!--begin::Data faktur-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Dokumen Transaksi</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="collapse show">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nomor Faktur</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="mtransaction_code">{!! ($data->transaction_code!='') ? $data->transaction_code : '00.00' !!}</span>
                            <input type="hidden" name="transaction_code" id="transaction_code" value="{{ $data->transaction_code }}">
                            <input type="hidden" name="status" id="status" value="{{ $data->status }}">
                            <input type="hidden" name="old_payment" id="old_payment" value="{{ $data->payment }}">
                            <input type="text" name="invoice_no" id="invoice_no" class="form-control" placeholder="Nomor Faktur" value="{{ $data->invoice_no }}" readonly>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Kode Transaksi</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <select name="transaction_id" id="transaction_id" aria-label="Pilih Detail Transaksi" data-control="select2" data-placeholder="Pilih Detail Transaksi" class="form-select form-select-md" required>
                            <option value="">Pilih Kode Transaksi</option>
                            @foreach ($transactions as $item)
                            <option value="{{ $item->code }}" {!! ($data->transaction_id==$item->id) ? 'selected' : '' !!}>{{ $item->id.'. '.$item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tanggal Faktur</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control" value="{{ $data->invoice_date }}" required/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Masa / Tahun Pajak</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-4 fv-row">
                        <select name="invoice_period" id="invoice_period" aria-label="Pilih Masa Pajak" data-control="select2" data-placeholder="Pilih Masa Pajak" class="form-select form-select-md" required>
                            <option value="">Pilih Masa Pajak</option>
                            @for($i = 1; $i<= 12; $i++)
                            <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {!! ($data->invoice_period==str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected' : '' !!}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-lg-5 fv-row">
                        <select name="invoice_year" id="invoice_year" aria-label="Pilih Tahun Pajak" data-control="select2" data-placeholder="Pilih Tahun Pajak" class="form-select form-select-md" required>
                            <option value="">Pilih Tahun Pajak</option>
                            @for($i = date('Y'); $i > date('Y')-3; $i--)
                            <option value="{{ $i }}" {!! ($data->invoice_year==$i) ? 'selected' : '' !!}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Referensi Faktur</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <textarea name="invoice_reference" rows="3" class="form-control">{{ $data->invoice_reference }}</textarea>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Data faktur-->
    <!--begin::Data Pembeli-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Data Pembeli</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="collapse show">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">NPWP/NIK</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input type="text" name="customer_id" class="form-control" value="{{ $data->customer_id }}" required/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <input type="text" name="customer_name" class="form-control" value="{{ $data->customer_name }}" required/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Alamat</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-9 fv-row">
                        <textarea name="customer_address" rows="3" class="form-control">{{ $data->customer_address }}</textarea>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Data faktur-->
    <!--begin::Data produk-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Data Barang / Jasa</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <button type="button"  name="tambahItem" id="tambahItem" class="btn btn-primary">Tambah</button>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="collapse show">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <table class="table align-middle table-row-dashed gy-3" id="item">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-25px">#</th>
                            <th>Nama</th>
                            <th>Harga (Rp)</th>
                            <th class="w-25px">Kuan</th>
                            <th>Total Harga (Rp)</th>
                            <th>Diskon (Rp)</th>
                            <th>DPP (Rp)</th>
                            <th>PPN (Rp)</th>
                            <th>PPnBM (Rp)</th>
                            <th class="w-75px">Aksi</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
                    </tbody>
                </table>
                <div class="row mt-10">
                    <div class="col-lg-6"></div>
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">DPP</label>
                    <input type="hidden" name="dpp" id="dpp" class="form-control form-control-solid uang text-end" value="{{ $data->dpp }}"/>
                    <label class="col-lg-4 col-form-label fw-semibold fs-6 text-end dpp">@money($data->dpp)</label>
                </div>
                <div class="row">
                    <div class="col-lg-6"></div>
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">PPN</label>
                    <input type="hidden" name="ppn" id="ppn" class="form-control form-control-solid uang text-end" value="{{ $data->ppn }}"/>
                    <label class="col-lg-4 col-form-label fw-semibold fs-6 text-end ppn">@money($data->ppn)</label>
                </div>
                <div class="row">
                    <div class="col-lg-6"></div>
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">PPnBM</label>
                    <input type="hidden" name="ppnbm" id="ppnbm" class="form-control form-control-solid uang text-end" value="{{ $data->ppnbm }}"/>
                    <label class="col-lg-4 col-form-label fw-semibold fs-6 text-end ppnbm">@money($data->ppnbm)</label>
                </div>
                <div class="row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="form-check form-check-sm mt-5">
                            <input class="form-check-input" type="checkbox" id="termin"/>
                            <label class="form-check-label text-dark">
                                Ada Termin Pembayaran
                            </label>
                        </div>
                    </div>
                </div>
                <div id="detailTermin">
                    <!--begin::Input group-->
                    <div class="row mt-10">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                            <div class="mb-10 d-flex">
                                <div class="form-check form-check-custom me-10">
                                    <input class="form-check-input w-20px h-20px" type="radio" name="payment" value="uang muka">
                                    <label class="form-check-label">
                                        Uang Muka
                                    </label>
                                </div>
                                <div class="form-check form-check-custom me-10">
                                    <input class="form-check-input w-20px h-20px" type="radio" name="payment" value="pelunasan">
                                    <label class="form-check-label">
                                        Pelunasan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <div class="col-lg-6"></div>
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">DPP</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="dpp_split" id="dpp_split" class="form-control form-control-solid uang text-end" value="{{ $data->dpp_split }}" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <div class="col-lg-6"></div>
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">PPN</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="ppn_split" id="ppn_split" class="form-control form-control-solid uang text-end" value="{{ $data->ppn_split }}" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <div class="col-lg-6"></div>
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">PPnBM</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4 fv-row">
                            <input type="text" name="ppnbm_split" id="ppnbm_split" class="form-control form-control-solid uang text-end" value="{{ $data->ppnbm_split }}" readonly/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('faktur.pajak', ['type'=>'keluaran', 'period'=>$data->invoice_period, 'year'=>$data->invoice_year]) }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Data produk-->
</form>
<!--end::Form-->
@endsection
@section('modal')

<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="modal-title" id="itemHeading"></h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body">
                <form id="itemForm" name="itemForm">
                    <input type="hidden" name="id" id="item_id">
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tipe</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <div class="mt-3 d-flex">
                                <div class="form-check form-check-custom me-10">
                                    <input class="form-check-input w-20px h-20px" type="radio" name="type" id="barang" value="barang" checked>
                                    <label class="form-check-label">
                                        Barang
                                    </label>
                                </div>
                                <div class="form-check form-check-custom me-10">
                                    <input class="form-check-input w-20px h-20px" type="radio" name="type" id="jasa" value="jasa">
                                    <label class="form-check-label">
                                        Jasa
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Nama Barang</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="name" id="mname" class="form-control" required>
                        </div>
                        <!--end::Col-->
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6 text-end">Satuan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <select name="unit" id="munit" aria-label="Pilih Satuan" data-control="select2" data-placeholder="Pilih Satuan" class="form-select form-select-md" data-dropdown-parent="#itemModal" required>
                                <option value="">Pilih Satuan</option>
                                @foreach ($units as $item)
                                    <option value="{{ $item->description }}">{{ $item->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Harga (Rp)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="price" id="mprice" class="form-control uang hitung">
                        </div>
                        <!--end::Col-->
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6 text-end">Kuantitas</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="amount" id="mamount" class="form-control uang hitung" value="1">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Total Harga (Rp)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="total" id="mtotal" class="form-control form-control-solid uang" readonly>
                        </div>
                        <!--end::Col-->
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6 text-end">Diskon (Rp)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="discount" id="mdiscount" class="form-control uang hitung">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">DPP (Rp)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="dpp" id="mdpp" class="form-control uang hitung">
                        </div>
                        <!--end::Col-->
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6 text-end">PPN (Rp)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="ppn" id="mppn" class="form-control form-control-solid uang" readonly>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">Tarif PPnBM (%)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="tarif_ppnbm" id="mtarif_ppnbm" class="form-control uang hitung">
                        </div>
                        <!--end::Col-->
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6 text-end">PPnBM (Rp)</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="ppnbm" id="mppnbm" class="form-control form-control-solid uang" readonly>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </form>
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="itemBtn" value="create">Simpan</button>
            </div>
            <!--end::Modal footer-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endsection
@section('js')

    <script>
        var invoice_id = {{ $data->id }};
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
    <script src="{{ url('disc/assets/js/custom/faktur/pajak_keluaran_forms.js?v=4') }}"></script>

    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <script>
                common.showNotif("{!! Session::get('alert-' . $msg) !!}", "{{ $msg }}");
            </script>
        @endif
    @endforeach
@endsection
