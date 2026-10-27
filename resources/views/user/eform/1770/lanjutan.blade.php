<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var spt_id = {{ $spt->id }};
    </script>
    <title>Lampiran I</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row mt-4 mb-4">
                <div class="col-md-10">
                    <a href="{{ route('pelajar.eform.1770', ['id'=>$spt->id, 'type'=>'lampiran1']) }}" class="btn btn-sm btn-secondary">Sebelumnya</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('pelajar.eform.1770', ['id'=>$spt->id, 'type'=>'induk']) }}" class="btn btn-sm btn-secondary">Selanjutnya</a>
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                    <th class="text-center align-middle" rowspan="2">
                        <span style="font-size: 1rem">FORMULIR</span>
                        <h1>1770 - I</h1>
                        Halaman 2
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - I</h5>
                        <b>SPT TAHUNAN PPh WAJIB PAJAK ORANG PRIBADI</b>
                    </th>
                    <th class="text-center align-middle" rowspan="2">
                        <span style="font-size: 1rem">TAHUN PAJAK</span>
                        <h2>{{ $spt->year }}</h2>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_lapor" value="Pembukuan" {!! ($induk->jenis_lapor=='Pembukuan') ? 'checked' : '' !!}>
                            <label class="form-check-label">Pembukuan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_lapor" value="Pencatatan" {!! ($induk->jenis_lapor=='Pencatatan') ? 'checked' : '' !!}>
                            <label class="form-check-label">Pencatatan</label>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td class="border-left border-right text-center">
                        <ul>
                            <li>PENGHITUNGAN PENGHASILAN NETO DALAM NEGERI DARI USAHA DAN/<br>ATAU PEKERJAAN BEBAS BAGI WAJIB PAJAK YANG MENYELENGGARAKAN PENCATATAN</li>
                            <li>PENGHITUNGAN PENGHASILAN NETO DALAM NEGERI SEBUBUNGAN DENGAN PEKERJAAN</li>
                            <li>PENGHITUNGAN PENGHASILAN DALAM NEGERI LAINNYA</li>
                        </ul>
                    </td>
                </tr>
            </table>
            <div class="row border p-2 mb-3">
                <table class="table table-borderless">
                    <tr>
                        <td class="vertical-text border-right text-center" rowspan="6" width="10px">
                            <b style="font-size: 1rem">IDENTITAS</b>
                        </td>
                        <td class="align-middle" width="180px">NPWP</td>
                        <td><input type="text" class="form-control" name="npwp" value="{{ auth()->user()->username }}" disabled></td>
                    </tr>
                    <tr>
                        <td class="align-middle">NAMA WAJIB PAJAK</td>
                        <td><input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" disabled></td>
                    </tr>
                </table>
            </div>

            <b>BAGIAN B : Penghasilan Neto Dalam Negeri dari Usaha dan/atau Pekerjaan Bebas <br>(Bagi Wajib Pajak yang Menyelenggarakan Pembukuan)</b>
            <table class="table table-bordered">
                <tr>
                    <th class="text-center align-middle">NO</th>
                    <th class="text-center align-middle">JENIS USAHA</th>
                    <th class="text-center align-middle">PEREDARAN USAHA (Rupiah)</th>
                    <th class="text-center align-middle">NORMA (%)</th>
                    <th class="text-center align-middle">PENGHASILAN NETO (Rupiah)</th>
                </tr>
                <tr>
                    <td class="text-center">(1)</td>
                    <td class="text-center">(2)</td>
                    <td class="text-center">(3)</td>
                    <td class="text-center">(4)</td>
                    <td class="text-center">(5)</td>
                </tr>
                <tr>
                    <td class="text-center align-middle p-2">1.</td>
                    <td class="align-middle">DAGANG</td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="peredaran_dagang" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="peredaran_dagang" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="peredaran_dagang" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->peredaran_dagang }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="norma_dagang" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="norma_dagang" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="norma_dagang" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->norma_dagang }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="penghasilan_dagang" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="penghasilan_dagang" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="penghasilan_dagang" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->penghasilan_dagang }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle p-2">2.</td>
                    <td class="align-middle">INDUSTRI</td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="peredaran_industri" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="peredaran_industri" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="peredaran_industri" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->peredaran_industri }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="norma_industri" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="norma_industri" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="norma_industri" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->norma_industri }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="penghasilan_industri" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="penghasilan_industri" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="penghasilan_industri" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->penghasilan_industri }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle p-2">3.</td>
                    <td class="align-middle">JASA</td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="peredaran_jasa" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="peredaran_jasa" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="peredaran_jasa" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->peredaran_jasa }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="norma_jasa" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="norma_jasa" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="norma_jasa" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->norma_jasa }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="penghasilan_jasa" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="penghasilan_jasa" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="penghasilan_jasa" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->penghasilan_jasa }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle p-2">4.</td>
                    <td class="align-middle">PEKERJAAN BEBAS</td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="peredaran_bebas" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="peredaran_bebas" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="peredaran_bebas" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->peredaran_bebas }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="norma_bebas" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="norma_bebas" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="norma_bebas" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->norma_bebas }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="penghasilan_bebas" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="penghasilan_bebas" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="penghasilan_bebas" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->penghasilan_bebas }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle p-2">5.</td>
                    <td class="align-middle">USAHA</td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="peredaran_lainnya" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="peredaran_lainnya" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="peredaran_lainnya" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->peredaran_lainnya }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="norma_lainnya" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="norma_lainnya" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="norma_lainnya" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->norma_lainnya }} </a>
                    </td>
                    <td class="align-middle text-center">
                        <input type="text" class="form-control text-center pembukuan" name="penghasilan_lainnya" value="0" disabled style="{!! ($induk->jenis_lapor=='Pencatatan') ? 'display:none' : '' !!}">
                        <a href="#" id="penghasilan_lainnya" class="xedit pencatatan" data-pk="{{ $lampiran1b->id }}" data-name="penghasilan_lainnya" style="{!! ($induk->jenis_lapor=='Pembukuan') ? 'display:none' : '' !!}"> {{ $lampiran1b->penghasilan_lainnya }} </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="align-middle text-center"><b>JUMLAH BAGIAN B</b></td>
                    <td><input type="text" name="peredaran_jumlah" id="peredaran_jumlah" value="@money($lampiran1b->peredaran_jumlah)" class="form-control text-center" disabled></td>
                    <td class="text-center align-middle"><b>JBB</b></td>
                    <td><input type="text" name="penghasilan_jumlah" id="penghasilan_jumlah" value="@money($lampiran1b->penghasilan_jumlah)" class="form-control text-center" disabled></td>
                </tr>
            </table>
            <br><b>BAGIAN C. PENGHASILAN NETO DALAM NEGERI SEHUBUNGAN DENGAN PEKERJAAN <br> (TIDAK TERMASUK PENGHASILAN YANG DIKENAKAN PPh BERSIFAT FINAL)</b>
            <table class="table table-bordered mt-2 mb-3" id="pekerjaan">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="10px">No</th>
                        <th class="text-center align-middle" width="16%">NPWP Pemberi Kerja</th>
                        <th class="text-center align-middle" width="16%">Nama Pemberi Kerja</th>
                        <th class="text-center align-middle" width="16%">Penghasilan Bruto</th>
                        <th class="text-center align-middle" width="16%">Pengurangan Penghasilan Bruto</th>
                        <th class="text-center align-middle" width="16%">Penghasilan Neto</th>
                        <th class="text-center align-middle" width="20px">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Jumlah Bagian C</th>
                        <th class="text-right p-2"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <button type="button"  name="tambahPekerjaan" id="tambahPekerjaan" class="btn btn-sm btn-secondary mt-2 mb-5">Tambah</button>
                </div>
            </div>

            <br><b>BAGIAN D : PENGHASILAN DALAM NEGERI LAINNYA <br>(TIDAK TERMASUK PENGHASILAN YANG DIKENAKAN PPh BERSIFAT FINAL)</b>
            <table class="table table-bordered mt-2">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center" width="50%">JENIS USAHA</th>
                    <th class="text-center" width="45%">PENGHASILAN NETO (Rupiah)</th>
                </tr>
                <tr>
                    <td class="text-center">(1)</td>
                    <td class="text-center">(2)</td>
                    <td class="text-center">(3)</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">1.</td>
                    <td class="align-middle">BUNGA</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran1d->id }}" data-name="bunga"> {{ $lampiran1d->bunga }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">2.</td>
                    <td class="align-middle">ROYALTI</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran1d->id }}" data-name="royalti"> {{ $lampiran1d->royalti }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">3.</td>
                    <td>SEWA</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran1d->id }}" data-name="sewa"> {{ $lampiran1d->sewa }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">4.</td>
                    <td>PENGHARGAAN DAN HADIAH</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran1d->id }}" data-name="hadiah"> {{ $lampiran1d->hadiah }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">5.</td>
                    <td>KEUNTUNGAN DARI PENJUALAN / PENGALIHAN HARTA</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran1d->id }}" data-name="keuntungan"> {{ $lampiran1d->keuntungan }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">6.</td>
                    <td>PENGHASILAN LAINNYA</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran1d->id }}" data-name="lainnya"> {{ $lampiran1d->lainnya }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2"><b>JUMLAH BAGIAN D	(JBD)</b></td>
                    <td><input type="text" name="jbd" id="jbd" value="@money($lampiran1d->jumlah)" class="form-control text-right" disabled></td>
                </tr>
            </table>
            <br><br>
        </div>
    </div>

    @include('components.1770.lanjutan')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script>$.fn.poshytip={defaults:null}</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/eform/1770/lanjutan.js') }}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
