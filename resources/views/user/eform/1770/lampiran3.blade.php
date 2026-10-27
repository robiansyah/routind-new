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
    <title>Lampiran III</title>
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row mt-4 mb-4">
                <div class="col-md-10">
                    <a href="{{ route('pelajar.eform.1770', ['id'=>$spt->id, 'type'=>'lampiran4']) }}" class="btn btn-sm btn-secondary">Sebelumnya</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('pelajar.eform.1770', ['id'=>$spt->id, 'type'=>'lampiran2']) }}" class="btn btn-sm btn-secondary">Selanjutnya</a>
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                    <th class="text-center align-middle" rowspan="2">
                        <span style="font-size: 1rem">FORMULIR</span>
                        <h1>1770 - III</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - III</h5>
                        <b>SPT TAHUNAN PPh WAJIB PAJAK ORANG PRIBADI</b>
                    </th>
                    <th class="text-center align-middle" rowspan="2">
                        <span style="font-size: 1rem">TAHUN PAJAK</span>
                        <h2>{{ $spt->year }}</h2>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_lapor" value="Pembukuan" {!! ($induk->jenis_lapor=='Pembukuan') ? 'checked' : '' !!} disabled>
                            <label class="form-check-label">Pembukuan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_lapor" value="Pencatatan" {!! ($induk->jenis_lapor=='Pencatatan') ? 'checked' : '' !!} disabled>
                            <label class="form-check-label">Pencatatan</label>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td class="border-left border-right">
                        <ul>
                            <li>PENGHASILAN YANG DIKENAKAN PAJAK FINAL DAN/ATAU BERSIFAT FINAL</li>
                            <li>PENGHASILAN YANG TIDAK TERMASUK OBJEK PAJAK</li>
                            <li>DPENGHASILAN ISTERI/SUAMI YANG DIKENAKAN PAJAK SECARA TERPISAH</li>
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
            <b>BAGIAN A : Penghasilan yang Dikenakan Pajak Final dan/atau Bersifat Final</b>
            <table class="table table-bordered">
                <tr>
                    <th class="text-center align-middle">NO</th>
                    <th class="text-center align-middle">JENIS PENGHASILAN</th>
                    <th class="text-center align-middle">DASAR PENGENAAN PAJAK / PENGHASILAN BRUTO</th>
                    <th class="text-center align-middle">PPH TERUTANG (RUPIAH)</th>
                </tr>
                <tr>
                    <td class="text-center">(1)</td>
                    <td class="text-center">(2)</td>
                    <td class="text-center">(3)</td>
                    <td class="text-center">(4)</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">1.</td>
                    <td class="align-middle">BUNGA DEPOSITO / TABUNGAN DAN DISKONTO SBI / SBN</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_deposito"> {{ $lampiran3a->pjk_deposito }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_deposito"> {{ $lampiran3a->pph_deposito }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">2.</td>
                    <td class="align-middle">BUNGA / DISKONTO OBLIGASI</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_obligasi"> {{ $lampiran3a->pjk_obligasi }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_obligasi"> {{ $lampiran3a->pph_obligasi }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">3.</td>
                    <td class="align-middle">PENGHASILAN PENJUALAN SAHAM YANG DIPERDAGANGKAN DI BURSA EFEK</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_saham"> {{ $lampiran3a->pjk_saham }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_saham"> {{ $lampiran3a->pph_saham }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">4.</td>
                    <td class="align-middle">HADIAH UNDIAN</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_hadiah"> {{ $lampiran3a->pjk_hadiah }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_hadiah"> {{ $lampiran3a->pph_hadiah }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">5.</td>
                    <td class="align-middle">PESANGON, TUNJANGAN HARI TUA DAN TEBUSAN PENSIUN YANG DIBAYARKAN SEKALIGUS</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_pesangon"> {{ $lampiran3a->pjk_pesangon }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_pesangon"> {{ $lampiran3a->pph_pesangon }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">6.</td>
                    <td class="align-middle">HONORARIUM ATAS BEBAN APBN / APBD</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_honorarium"> {{ $lampiran3a->pjk_honorarium }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_honorarium"> {{ $lampiran3a->pph_honorarium }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">7.</td>
                    <td class="align-middle">PENGALIHAN HAK ATAS TANAH / BANGUNAN</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_pengalihan"> {{ $lampiran3a->pjk_pengalihan }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_pengalihan"> {{ $lampiran3a->pph_pengalihan }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">8.</td>
                    <td class="align-middle">BANGUNAN YANG DITERIMA DALAM RANGKA BANGUNAN GUNA SERAH</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_bangunan"> {{ $lampiran3a->pjk_bangunan }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_bangunan"> {{ $lampiran3a->pph_bangunan }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">9.</td>
                    <td class="align-middle">SEWA ATAS TANAH DAN/ATAU BANGUNAN</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_sewa"> {{ $lampiran3a->pjk_sewa }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_sewa"> {{ $lampiran3a->pph_sewa }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">10.</td>
                    <td class="align-middle">USAHA JASA KONSTRUKSI</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_usaha"> {{ $lampiran3a->pjk_usaha }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_usaha"> {{ $lampiran3a->pph_usaha }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">11.</td>
                    <td class="align-middle">PENYALUR/DEALER/AGEN PRODUK BBM</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_bbm"> {{ $lampiran3a->pjk_bbm }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_bbm"> {{ $lampiran3a->pph_bbm }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">12.</td>
                    <td class="align-middle">BUNGA SIMPANAN YANG DIBAYARKAN OLEH KOPERASI KEPADA ANGGOTA KOPERASI</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_koperasi"> {{ $lampiran3a->pjk_koperasi }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_koperasi"> {{ $lampiran3a->pph_koperasi }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle p-2">13.</td>
                    <td class="align-middle">PENGHASILAN DARI TRANSAKSI DERIVATIF</td>
                    <td colspan="2" class="bg-secondary">&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">14.</td>
                    <td class="align-middle">DIVIDEN</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_dividen"> {{ $lampiran3a->pjk_dividen }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_dividen"> {{ $lampiran3a->pph_dividen }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">15.</td>
                    <td class="align-middle">PENGAHSILAN ISTERI DARI SATU PEMBERI KERJA</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_istri"> {{ $lampiran3a->pjk_istri }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_istri"> {{ $lampiran3a->pph_istri }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">16.</td>
                    <td class="align-middle">PENGHASILAN LAIN YANG DIKENAKAN PAJAK FINAL DAN ATAU BERSIFAT FINAL</td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pjk_lain"> {{ $lampiran3a->pjk_lain }} </a>
                    </td>
                    <td class="align-middle text-center p-2">
                        <a href="#" class="xedit" data-pk="{{ $lampiran3a->id }}" data-name="pph_lain"> {{ $lampiran3a->pph_lain }} </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="align-middle text-center"><b>JUMLAH</b></td>
                    <td><input type="text" name="terutang" id="terutang" value="@money($lampiran3a->pph_total)" class="form-control text-center" disabled></td>
                </tr>
            </table>

            <br><b>BAGIAN B : PENGHASILAN YANG TIDAK TERMASUK OBJEK PAJAK</b>
            <table class="table table-bordered mt-2">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center" width="50%">JENIS PENGHASILAN</th>
                    <th class="text-center" width="45%">DASAR PENGENAAN PAJAK / PENGHASILAN BRUTO</th>
                </tr>
                <tr>
                    <td class="text-center">(1)</td>
                    <td class="text-center">(2)</td>
                    <td class="text-center">(3)</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">1.</td>
                    <td class="align-middle">BANTUAN / SUMBANGAN / HIBAH</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran3b->id }}" data-name="bantuan"> {{ $lampiran3b->bantuan }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">2.</td>
                    <td class="align-middle">WARISAN</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran3b->id }}" data-name="warisan"> {{ $lampiran3b->warisan }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">3.</td>
                    <td>BAGIAN LABA ANGGOTA PERSEROAN KOMANDITER TIDAK ATAS SAHAM, PERSEKUTUAN, PERKUMPULAN, FIRMA, KONGSI</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran3b->id }}" data-name="laba"> {{ $lampiran3b->laba }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">4.</td>
                    <td>KLAIM ASURANSI KESEHATAN, KECELAKAAN, JIWA, DWIGUNA, BEASISWA </td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran3b->id }}" data-name="asuransi"> {{ $lampiran3b->asuransi }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">5.</td>
                    <td>BEASISWA</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran3b->id }}" data-name="beasiswa"> {{ $lampiran3b->beasiswa }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle" rowspan="4">6.</td>
                    <td>PENGHASILAN LAIN YANG TIDAK TERMASUK OBJEK PAJAK</td>
                    <td class="align-middle text-center p-1">
                        <input type="text" class="form-control text-center" name="tidak" id="tidak" value="@money($lampiran3b->luar_negeri+$lampiran3b->imbalan+$lampiran3b->lainnya)" disabled>
                    </td>
                </tr>
                <tr>
                    <td>A. PENGHASILAN DARI LUAR NEGERI YANG DIPEROLEH WNA DENGAN KEAHLIAN TERTENTU</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran3b->id }}" data-name="luar_negeri"> {{ $lampiran3b->luar_negeri }} </a>
                    </td>
                </tr>
                <tr>
                    <td>B. PENGGANTIAN ATAU IMBALAN SEHUBUNGAN DENGAN PEKERJAAN ATAU JASA YANG DIBERIKAN DALAM BENTUK NATURAN DAN/ATAU KENIKMATAN YANG DIKECUALIKAN DARI OBJEK PPH</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran3b->id }}" data-name="imbalan"> {{ $lampiran3b->imbalan }} </a>
                    </td>
                </tr>
                <tr>
                    <td>C. PENGHASILAN LAINNYA YANG DIKECUALIKAN DARI OBJEK PAJAK PENGHASILAN</td>
                    <td class="align-middle text-center p-1">
                        <a href="#" class="xupdate" data-pk="{{ $lampiran3b->id }}" data-name="lainnya"> {{ $lampiran3b->lainnya }} </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2"><b>JUMLAH BAGIAN B	(JBB)</b></td>
                    <td><input type="text" name="jbb" id="jbb" value="@money($lampiran3b->jumlah)" class="form-control text-center" disabled></td>
                </tr>
            </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script>$.fn.poshytip={defaults:null}</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/eform/1770/lampiran3.js') }}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
