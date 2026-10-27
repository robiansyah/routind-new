<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPT PPN</title>
    <style>
        body
        {
            font-family:Helvetica;
            font-size:8.5px;
            margin-top: -0.5cm;
            margin-bottom: -0.5cm;
            margin-left: 1cm;
            margin-right: 0.5cm;
            line-height: 0.25cm;
        }
        p{
            margin: 0;
        }
    </style>
</head>
<body>

<table width="100%">
    <tr>
        <td>
            <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="50px">
        </td>
        <td align="center" style="font-size:12px; line-height: normal;">
            SURAT PEMBERITAHUAN MASA<br>
            PAJAK PERTAMBAHAN NILAI (SPT MASA PPN)<br>
            BAGI PENGUSAHA KENA PAJAK
        </td>
        <td align="center" style="line-height: normal; background-color: #ffb822;">
            INDUK<br>
            Halaman 1
    </tr>
</table>
<br>
<table style="background-color: darkgrey" width="100%">
    <tr>
        <td align="center">Masa Pajak</td>
        <td align="center">Tahun Buku</td>
        <td align="center">Normal/Pembetulan</td>
    </tr>
    <tr>
        <td align="center">{{ $induk->spt->start_period." ".$induk->spt->year }}</td>
        <td align="center">1 sd 12</td>
        <td align="center">{!! ($induk->spt->correction_to == 0) ? 'Normal' : 'Pembetulan' !!}</td>
    </tr>
</table>
<table style="background-color: darkgrey" width="100%">
    <tr>
        <td width="150px">NAMA PKP</td>
        <td width="5px">:</td>
        <td>{{ $induk->spt->user->profile->corporate_name }}</td>
        <td>NPWP</td>
        <td>:</td>
        <td>{{ $induk->spt->user->npwp }}</td>
    </tr>
    <tr>
        <td>ALAMAT</td>
        <td>:</td>
        <td>{{ $induk->spt->user->profile->address }}</td>
        <td>KLU</td>
        <td>:</td>
        <td>-</td>
    </tr>
    <tr>
        <td>TELEPON</td>
        <td>:</td>
        <td>{{ $induk->spt->user->mobile_phone }}</td>
        <td>HP</td>
        <td>:</td>
        <td>{{ $induk->spt->user->mobile_phone }}</td>
    </tr>
</table>
<br>
<table width="100%" cellpadding="2">
    <tr style="background-color: gray">
        <th width="10px">I</th>
        <th colspan="3">PENYERAHANA BARANG DAN JASA</th>
        <th width="75px">HARGA JUAL</th>
        <th width="75px">DPP NILAI LAIN/DPP</th>
        <th width="75px">PPN</th>
        <th width="75px">PPnBM</th>
    </tr>
    <tr>
        <td></td>
        <td width="10px" valign="top">A.</td>
        <td colspan="2">Penyerahan BKP/JKP yang terutang PPN</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td style="background-color: darkgrey"></td>
        <td style="background-color: darkgrey"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td width="10px" valign="top">1.</td>
        <td>Ekspor BKP/BKP Tidak Berwujud/JKP</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td valign="top">2.</td>
        <td>Penyerahan yang PPN atau PPN dan PPnBM-nya harus dipungut sendiri dengan DPP Nilai Lain atau Besaran Tertentu (dengan Faktur Pajak Kode 04 dan 05)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td valign="top">3.</td>
        <td>Penyerahan yang PPN atau PPN dan PPnBM-nya harus dipungut sendiri kepada turis sesuai dengan Pasal 16E UU PPN (dengan Faktur Pajak Kode 06)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td valign="top">4.</td>
        <td>Penyerahan yang PPN atau PPN dan PPnBM-nya harus dipungut sendiri lainnya (dengan Faktur Pajak Kode 01, 09 dan 10)</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td valign="top">5.</td>
        <td>Penyerahan yang PPN atau PPN dan PPnBM-nya harus dipungut sendiri dengan Faktur Pajak yang dilaporkan secara digunggung</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td valign="top">6.</td>
        <td>Penyerahan yang PPN atau PPN dan PPnBM-nya harus dipungut oleh Pemungut PPN (dengan Faktur Pajak Kode 02 dan 03)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td valign="top">7.</td>
        <td>Penyerahan yang mendapat fasilitas PPN atau PPnBM Tidak Dipungut (dengan Faktur Pajak Kode 07)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td valign="top">8.</td>
        <td>Penyerahan yang mendapat fasilitas PPN atau PPnBM Dibebaskan (dengan Faktur Pajak Kode 08)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td valign="top">9.</td>
        <td>Penyerahan yang mendapat fasilitas PPN atau PPnBM dengan Faktur Pajak yang dilaporkan secara digunggung</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Jumlah (I.A.1 + I.A.2 + I.A.3 + I.A.4 + I.A.5 + I.A.6 + I.A.7 + I.A.8 + I.A.9)</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">B.</td>
        <td colspan="2">Penyerahan barang/jasa yang tidak terutang PPN</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td style="background-color: darkgrey"></td>
        <td style="background-color: darkgrey"></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">C.</td>
        <td colspan="2">Jumlah seluruh penyerahan barang dan jasa (I.A + I.B)</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td style="background-color: darkgrey"></td>
        <td style="background-color: darkgrey"></td>
    </tr>
    <tr style="background-color: gray">
        <th>II</th>
        <th colspan="3">PEROLEHAN BARANG DAN JASA</th>
        <th>HARGA JUAL</th>
        <th>DPP NILAI LAIN/DPP</th>
        <th>PPN</th>
        <th>PPnBM</th>
    </tr>
    <tr>
        <td></td>
        <td valign="top">A.</td>
        <td colspan="2">Impor BKP, Pemanfaatan BKP Tidak Berwujud dan/atau JKP dari luar Daerah Pabean di dalam Daerah Pabean yang Pajak Masukannya dapat dikreditkan</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">B.</td>
        <td colspan="2">Perolehan BKP/JKP dari dalam negeri dengan DPP Nilai Lain atau Besaran Tertentu yang Pajak Masukannya dapat dikreditkan (dengan Faktur Pajak Kode 04 dan 05)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">C.</td>
        <td colspan="2">Perolehan BKP/JKP dari dalam negeri selain dengan DPP Nilai Lain yang Pajak Masukannya dapat dikreditkan (dengan Faktur Pajak Kode 01, 09, dan 10)</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">D.</td>
        <td colspan="2">Perolehan BKP/JKP dari dalam negeri sebagai Pemungut PPN yang Pajak Masukannya dapat dikreditkan (dengan Faktur Pajak Kode 02 dan 03)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">E.</td>
        <td colspan="2">Kompensasi kelebihan Pajak Masukan</td>
        <td style="background-color: darkgrey"></td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">F.</td>
        <td colspan="2">Hasil penghitungan kembali Pajak Masukan yang telah dikreditkan</td>
        <td style="background-color: darkgrey"></td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">G.</td>
        <td colspan="2">Jumlah Pajak Masukan yang dapat diperhitungkan (II.A + II.B + II.C + II.D + II.E + II.F)</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">H.</td>
        <td colspan="2">Impor atau perolehan BKP/JKP yang Pajak Masukannya tidak dikreditkan dan/ atau impor atau perolehan BKP/JKP yang mendapat fasilitas</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">I.</td>
        <td colspan="2">Impor atau perolehan BKP/JKP dengan Faktur Pajak yang dilaporkan secara digunggung dan barang/jasa yang tidak terutang PPN</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">J.</td>
        <td colspan="2">Jumlah perolehan (II.A + II.B + II.C + II.D +II.H + II.I)</td>
        <td align="right">0</td>
        <td style="background-color: darkgrey"></td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr style="background-color: gray">
        <th>III</th>
        <th colspan="3">PENGHITUNGAN PPN KURANG BAYAR/LEBIH BAYAR</th>
        <td></td>
        <td></td>
        <th>PPN</th>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">A.</td>
        <td colspan="2">Pajak Keluaran yang harus dipungut sendiri (I.A.2 + I.A.3 + I.A.4 + I.A.5)</td>
        <td></td>
        <td></td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">B.</td>
        <td colspan="2">PPN disetor dimuka dalam Masa Pajak yang sama</td>
        <td></td>
        <td></td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">C.</td>
        <td colspan="2">Pajak Masukan yang dapat diperhitungkan (II.G)</td>
        <td></td>
        <td></td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">D.</td>
        <td colspan="2">Kelebihan pemungutan PPN oleh Pemungut PPN</td>
        <td></td>
        <td></td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">E.</td>
        <td colspan="2">PPN kurang atau (lebih) bayar (III.A - III.B - III.C - III.D)</td>
        <td></td>
        <td></td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">F.</td>
        <td colspan="2">PPN kurang atau (lebih) bayar pada SPT yang dibetulkan sebelumnya</td>
        <td></td>
        <td></td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">G.</td>
        <td colspan="2">PPN kurang atau (lebih) bayar karena pembetulan SPT (III.E - III.F)</td>
        <td colspan="2">
            <table style="border: none;">
                <tr>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;">

                    </td>
                    <td>Ganti SPT Sebelumnya</td>
                </tr>
            </table>
        </td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>H.</td>
        <td colspan="6">
            <table style="border: none;">
                <tr>
                    <td width="55px">diminta untuk:</td>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;">

                    </td>
                    <td>1. dikompensasikan</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="6">
            <table style="border: none;">
                <tr>
                    <td width="55px"></td>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;">

                    </td>
                    <td>2. dikembalikan melalui pengembalian pendahuluan</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="6">
            <table style="border: none;">
                <tr>
                    <td width="55px"></td>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;">

                    </td>
                    <td>3. dikembalikan melalui pemeriksaan</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<p style='page-break-before: always'>&nbsp;</p>
<table width="100%">
    <tr>
        <td>
            <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="50px">
        </td>
        <td align="center" style="font-size:12px; line-height: normal;">
            SURAT PEMBERITAHUAN MASA<br>
            PAJAK PERTAMBAHAN NILAI (SPT MASA PPN)<br>
            BAGI PENGUSAHA KENA PAJAK
        </td>
        <td align="center" style="line-height: normal; background-color: #ffb822;">
            INDUK<br>
            Halaman 2
    </tr>
</table>
<br>
<table width="100%" cellpadding="2">
    <tr style="background-color: gray">
        <th>IV</th>
        <th colspan="2">PPN TERUTANG ATAS KEGIATAN MEMBANGUN SENDIRI</th>
        <td>DPP</td>
        <td></td>
        <th>PPN</th>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">PPN Terutang</td>
        <td align="right">0</td>
        <td></td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr style="background-color: gray">
        <th>V</th>
        <th colspan="2">PEMBAYARAN KEMBALI PAJAK MASUKAN YANG TIDAK DAPAT DIKREDITKAN</th>
        <td></td>
        <td></td>
        <th>PPN</th>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">PPN Yang Wajib Dibayar Kembali</td>
        <td></td>
        <td></td>
        <td align="right">0</td>
        <td></td>
    </tr>
    <tr style="background-color: gray">
        <th>VI</th>
        <th colspan="2">PAJAK PENJUALAN ATAS BARANG MEWAH</th>
        <td></td>
        <td></td>
        <th>PPN</th>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">A. PPnBM yang harus dipungut sendiri (I.A.2 + I.A.3 + I.A.4 + I.A.5)</td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">B. Kelebihan pemungutan PPnBM oleh Pemungut PPN</td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">C. PPnBM kurang atau (lebih) bayar (VI.A - VI.B)</td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">D. PPnBM kurang atau (lebih) bayar pada SPT yang dibetulkan sebelumnya</td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">E. PPnBM kurang atau (lebih) bayar karena pembetulan SPT (VI.C - VI.D)</td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td width="5px">F.</td>
        <td>
            <table style="border: none;">
                <tr>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;">

                    </td>
                    <td>diminta pengembalian pajak yang tidak seharusnya terutang</td>
                </tr>
            </table>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">0</td>
    </tr>

    <tr style="background-color: gray">
        <th>VII</th>
        <th colspan="2">PEMUNGUTAN PPN ATAU PPN DAN PPNBM OLEH PEMUNGUT PPN</th>
        <th>HARGA JUAL</th>
        <th>DPP NILAI LAIN/DPP</th>
        <th>PPN</th>
        <td>PPnBM</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">A. Jumlah PPN dan PPnBM yang dipungut</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">B.</td>
        <td>PPN dan PPnBM kurang atau (lebih) bayar pada SPT yang dibetulkan sebelumnya</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">C.</td>
        <td>PPN dan PPnBM kurang atau (lebih) bayar karena pembetulan SPT (VII.A - VII.B)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="5">Setiap kelebihan pemungutan PPN oleh Pemungut PPN pada bagian ini akan dipindah ke bagian III.D untuk PPN dan VI.B untuk PPnBM.</td>
    </tr>

    <tr style="background-color: gray">
        <th>VII</th>
        <th colspan="2">PEMUNGUTAN PPN ATAU PPN DAN PPNBM OLEH PEMUNGUT PPN</th>
        <th>HARGA JUAL</th>
        <th>DPP NILAI LAIN/DPP</th>
        <th>PPN</th>
        <td>PPnBM</td>
    </tr>
    <tr>
        <td></td>
        <td>A.</td>
        <td>Jumlah PPN dan PPnBM yang dipungut</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">B.</td>
        <td>PPN dan PPnBM kurang atau (lebih) bayar pada SPT yang dibetulkan sebelumnya</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top">C.</td>
        <td>PPN dan PPnBM kurang atau (lebih) bayar karena pembetulan SPT (VIII.A - VIII.B)</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td></td>
        <td>D.</td>
        <td colspan="5">
            <table style="border: none;">
                <tr>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;">

                    </td>
                    <td>diminta pengembalian pajak yang tidak seharusnya terutang</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="background-color: gray">
        <th>IX</th>
        <th colspan="6" align="left">KELENGKAPAN SPT</th>
    </tr>
    <tr>
        <td></td>
        <td>1.</td>
        <td colspan="5">
            <table style="border: none;">
                <tr>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;">

                    </td>
                    <td>Dokumen Daftar Rincian Penyerahan Kendaraan Bermotor.</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>2.</td>
        <td colspan="5">
            <table style="border: none;">
                <tr>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;">

                    </td>
                    <td>Hasil Penghitungan Kembali Pajak Masukan yang Telah Dikreditkan.</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="background-color: gray">
        <th colspan="7" align="left"> PERNYATAAN</th>
    </tr>
    <tr>
        <td colspan="7">Dengan menyadari sepenuhnya akan segala akibatnya termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku, Saya menyatakan bahwa apa yang telah Saya beritahukan di atas adalah benar, lengkap, dan jelas.</td>
    </tr>
</table>
<br>
<table cellpadding="2" width="100%">
    <tr>
        <td colspan="3"></td>
        <td width="50%" align="center">{{ $induk->ttd_place.', '.Carbon\Carbon::parse($induk->ttd_date)->isoFormat('DD MMMM Y') }}</td>
    </tr>
    <tr>
        <td>
            <table style="border: none;">
                <tr>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;" align="center">
                        X
                    </td>
                    <td>PKP</td>
                </tr>
            </table>
        </td>
        <td></td>
        <td>
            <table style="border: none;">
                <tr>
                    <td style="width: 10px; height: 10px; border:1.5px solid black;"></td>
                    <td>Kuasa</td>
                </tr>
            </table>
        </td>
        <td width="50%"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td width="10px">:</td>
        <td>{{ $induk->ttd_name }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $induk->ttd_position }}</td>
        <td></td>
    </tr>
</table>
</body>
</html>