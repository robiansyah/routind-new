<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
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
                    <a href="{!! (Request::segment(1) == 'pengajar') ? route('pengajar.pelajar.eform', ['id'=>$spt->id, 'type'=>'lampiran4'])  : route('pelajar.eform.1770.detail', ['id'=>$spt->id, 'type'=>'lampiran4']) !!}" class="btn btn-sm btn-secondary">Sebelumnya</a>
                </div>
                <div class="col-md-2">
                    <a href="{!! (Request::segment(1) == 'pengajar') ? route('pengajar.pelajar.eform', ['id'=>$spt->id, 'type'=>'lampiran2'])  : route('pelajar.eform.1770.detail', ['id'=>$spt->id, 'type'=>'lampiran2']) !!}" class="btn btn-sm btn-secondary">Selanjutnya</a>
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">FORMULIR</span></th>
                    <th class="text-center align-bottom">
                        <h1>1770 - III</h1>
                    </th>
                    <th class="text-center border-left border-right border-bottom">
                        <h5>LAMPIRAN - III</h5>
                        <b>SPT TAHUNAN PPh WAJIB PAJAK ORANG PRIBADI</b>
                    </th>
                    <th class="vertical-text" rowspan="2"><span style="font-size: 1rem">TAHUN PAJAK</span></th>
                    <th class="text-center align-middle" rowspan="2">
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
                    <td>KEMENTRIAN KEUANGAN RI</td>
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
                        @money($lampiran3a->pjk_deposito)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_deposito)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">2.</td>
                    <td class="align-middle">BUNGA / DISKONTO OBLIGASI</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_obligasi)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_obligasi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">3.</td>
                    <td class="align-middle">PENGHASILAN PENJUALAN SAHAM YANG DIPERDAGANGKAN DI BURSA EFEK</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_saham)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_saham)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">4.</td>
                    <td class="align-middle">HADIAH UNDIAN</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_hadiah)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_hadiah)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">5.</td>
                    <td class="align-middle">PESANGON, TUNJANGAN HARI TUA DAN TEBUSAN PENSIUN YANG DIBAYARKAN SEKALIGUS</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_pesangon)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_pesangon)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">6.</td>
                    <td class="align-middle">HONORARIUM ATAS BEBAN APBN / APBD</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_honorarium)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_honorarium)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">7.</td>
                    <td class="align-middle">PENGALIHAN HAK ATAS TANAH / BANGUNAN</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_pengalihan)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_pengalihan)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">8.</td>
                    <td class="align-middle">BANGUNAN YANG DITERIMA DALAM RANGKA BANGUNAN GUNA SERAH</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_bangunan)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_bangunan)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">9.</td>
                    <td class="align-middle">SEWA ATAS TANAH DAN/ATAU BANGUNAN</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_sewa)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_sewa)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">10.</td>
                    <td class="align-middle">USAHA JASA KONSTRUKSI</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_usaha)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_usaha)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">11.</td>
                    <td class="align-middle">PENYALUR/DEALER/AGEN PRODUK BBM</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_bbm)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_bbm)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">12.</td>
                    <td class="align-middle">BUNGA SIMPANAN YANG DIBAYARKAN OLEH KOPERASI KEPADA ANGGOTA KOPERASI</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_koperasi)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_koperasi)
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
                        @money($lampiran3a->pjk_dividen)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_dividen)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">15.</td>
                    <td class="align-middle">PENGAHSILAN ISTERI DARI SATU PEMBERI KERJA</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_istri)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_istri)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">16.</td>
                    <td class="align-middle">PENGHASILAN LAIN YANG DIKENAKAN PAJAK FINAL DAN ATAU BERSIFAT FINAL</td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pjk_lain)
                    </td>
                    <td class="align-middle text-center p-2">
                        @money($lampiran3a->pph_lain)
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
                        @money($lampiran3b->bantuan)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">2.</td>
                    <td class="align-middle">WARISAN</td>
                    <td class="align-middle text-center p-1">
                        @money($lampiran3b->warisan)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">3.</td>
                    <td>BAGIAN LABA ANGGOTA PERSEROAN KOMANDITER TIDAK ATAS SAHAM, PERSEKUTUAN, PERKUMPULAN, FIRMA, KONGSI</td>
                    <td class="align-middle text-center p-1">
                        @money($lampiran3b->laba)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">4.</td>
                    <td>KLAIM ASURANSI KESEHATAN, KECELAKAAN, JIWA, DWIGUNA, BEASISWA </td>
                    <td class="align-middle text-center p-1">
                        @money($lampiran3b->asuransi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">5.</td>
                    <td>BEASISWA</td>
                    <td class="align-middle text-center p-1">
                        @money($lampiran3b->beasiswa)
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
                        @money($lampiran3b->luar_negeri)
                    </td>
                </tr>
                <tr>
                    <td>B. PENGGANTIAN ATAU IMBALAN SEHUBUNGAN DENGAN PEKERJAAN ATAU JASA YANG DIBERIKAN DALAM BENTUK NATURAN DAN/ATAU KENIKMATAN YANG DIKECUALIKAN DARI OBJEK PPH</td>
                    <td class="align-middle text-center p-1">
                        @money($lampiran3b->imbalan)
                    </td>
                </tr>
                <tr>
                    <td>C. PENGHASILAN LAINNYA YANG DIKECUALIKAN DARI OBJEK PAJAK PENGHASILAN</td>
                    <td class="align-middle text-center p-1">
                        @money($lampiran3b->lainnya)
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ url('disc/assets/js/custom/number.js') }}"></script>
    <script src="{{ url('disc/assets/js/custom/common.js') }}"></script>
</body>

</html>
