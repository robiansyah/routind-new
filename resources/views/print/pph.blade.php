<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak </title>
    <style>
        body
        {
            font-family:Helvetica;
            font-size:11px;
            margin-top: -0.5cm;
            margin-bottom: -0.5cm;
            margin-left: -0.5cm;
            margin-right: -0.5cm;
            /*line-height: 0.7cm;*/
        }
        p{
            margin: 0;
        }

        header {
            position: fixed;
            top: -20px;
            left: -20px;
            right: -20px;
        }

        footer {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
        }

        .new3 {
            border-bottom: 1px dotted black;
        }

        tr.border td {
            border: 1px solid black;
        }

        td.border {
            border: 1px solid black;
        }

        th{
            background-color:#9d9c9c;
            border: 1px solid black;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<header>
    <table width="100%" border="1" style="border-collapse: collapse; border: 1px solid black;">
        <tr>
            <td align="center" rowspan="2" width="150px">
                <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="50px">
            </td>
            <td align="center">
                <br>
                <b style="font-size: 9px">BUKTI PEMOTONGAN/PEMUNGUTAN</b><br>
                <b style="font-size: 10px">PPh PASAL 4 AYAT (2), PASAL 15, PASAL 22, DAN PASAL 23</b>
            </td>
            <td align="center"><br><b style="font-size: 9px">FORMULIR BPBS</b></td>
        </tr>
        <tr>
            <td>
                <table border="0" width="100%">
                    <tr>
                        <td width="20px"><b style="font-size: 8px">H.1</b></td>
                        <td colspan="2"><b style="font-size: 9px">NOMOR </b></td>
                        <td width="20px" align="center"><b style="font-size: 9px"> : </b></td>
                        <td colspan="3">
                            {{ $data->noBupot }}
                        </td>
                    </tr>
                    <tr>
                        <td width="20px"><b style="font-size: 8px">H2</b></td>
                        <td class="border" width="10px" align="center"><span style="font-size: 10px"> X </span></td>
                        <td colspan="3"><b style="font-size: 9px">Pembetulan Ke-</b></td>
                        <td width="30px" align="center"><span style="text-decoration: underline;">&nbsp; 0 &nbsp;</span></td>
                        <td width="20px"><b style="font-size: 8px">H3</b></td>
                        <td class="border" width="10px"></td>
                        <td><b style="font-size: 9px">Pembatalan</b></td>
                    </tr>
                </table>
            </td>
            <td>
                <table border="0">
                    <tr>
                        <td width="15px"><b style="font-size: 8px">H4</b></td>
                        <td class="border" width="10px"><span>&nbsp;&nbsp;</span></td>
                        <td><b style="font-size: 9px">PPh Final</b></td>
                    </tr>
                    <tr>
                        <td width="15px"><b style="font-size: 8px">H5</b></td>
                        <td class="border" width="10px" align="center"><span style="font-size: 10px"> X </span></td>
                        <td><b style="font-size: 9px">PPh Tidak Final</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</header>
<table width="100%" style="margin-top:140px;">
    <tr>
        <td><b style="font-size: 9px">A. IDENTITAS WAJIB PAJAK YANG DIPOTONG/DIPUNGUT</b></td>
    </tr>
</table>
<table style="border-collapse: collapse; border: 1px solid black;" width="100%" cellpadding="2">
    <tr>
        <td style="padding-top: 10px" width="50px"><b style="font-size: 9px">A.1 NPWP</b></td>
        <td style="padding-top: 10px" width="50px" align="center"><b style="font-size: 9px">:</b></td>
        <td style="padding-top: 10px">
            @if($data->fgIdDipotong==0)
                {{ $data->idDipotong }}
            @endif
        </td>
        <td width="80px"></td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">A.2 NIK</b></td>
        <td align="center"><b style="font-size: 9px">:</b></td>
        <td>
            @if($data->fgIdDipotong!=0)
                {{ $data->idDipotong }}
            @endif
        </td>
        <td></td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">A.3 Nama</b></td>
        <td align="center"><b style="font-size: 9px">:</b></td>
        <td>{{ $data->namaDipotong }}</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
</table>
<br>
<b style="font-size: 9px">B. PAJAK PENGHASILAN YANG DIPOTONG/DIPUNGUT</b>
<table width="100%" border="1" style="border-collapse: collapse; border: 1px solid black; margin-top:5px;" cellpadding="2">
    <tr>
        <th><b style="font-size: 9px">Masa Pajak <br>(mm-yyyy)</b></th>
        <th><b style="font-size: 9px">Kode Objek Pajak</b></th>
        <th><b style="font-size: 9px">Dasar Pengenaan Pajak (Rp)</b></th>
        <th><b style="font-size: 8px">Dikenakan Tarif Lebih<br>Tinggi (Tidak<br>memiliki NPWP)</b></th>
        <th><b style="font-size: 9px">Tarif (%)</b></th>
        <th><b style="font-size: 9px">PPh yang Dipotong/<br>Dipungut/DTP (Rp)</b></th>
    </tr>
    <tr>
        <th><b style="font-size: 9px">B.1</b></th>
        <th><b style="font-size: 9px">B.2</b></th>
        <th><b style="font-size: 9px">B.3</b></th>
        <th><b style="font-size: 9px">B.4</b></th>
        <th><b style="font-size: 9px">B.5</b></th>
        <th><b style="font-size: 9px">B.6</b></th>
    </tr>
    <tr>
        <td align="center">{{ $data->msPajak."-".$data->thnPajak }}</td>
        <td align="center">{{ $data->kdObjPjk }}</td>
        <td align="center">@money($data->jmlBruto)</td>
        <td align="center">
            <table class="center">
                <tr class="border">
                    <td width="50px">&nbsp;</td>
                </tr>
            </table>
        </td>
        <td align="center">{{ $data->tarif }}</td>
        <td align="center">@money($data->pphDipotong)</td>
    </tr>
</table>
<br>
<table width="100%">
    <tr>
        <td colspan="4"><b style="font-size: 9px">Keterangan Kode Objek Pajak : </b></td>
        <td colspan="3" style="border-bottom: 1px solid black;">{{ $data->object->nmObjkPjk }}</td>
    </tr>
    <tr>
        <td width="20px"><b style="font-size: 9px">B.7</b></td>
        <td colspan="2"><b style="font-size: 9px">Dokumen Referensi :</b></td>
        <td><b style="font-size: 9px">Nomor Dokumen</b></td>
        <td colspan="3" class="border">{{ $data->doc->nomorDok }}</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"></td>
        <td><b style="font-size: 9px">Nama Dokumen</b></td>
        <td width="200px" class="border">{{ $data->doc->namaDok }}</td>
        <td><b style="font-size: 9px">Tanggal</b></td>
        <td>
            {{ $data->doc->tglDok }}
        </td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">B.8</b></td>
        <td colspan="6"><b style="font-size: 9px">Dokumen Referensi untuk Faktur Pajak, apabila ada :</b></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><b style="font-size: 9px">Nomor Faktur Pajak :</b></td>
        <td colspan="2" class="border"></td>
        <td><b style="font-size: 9px">Tanggal</b></td>
        <td>

        </td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">B.9</b></td>
        <td class="border" width="20px" align="center"></td>
        <td colspan="5"><b style="font-size: 9px">PPh dibebankan berdasarkan Surat Keterangan Bebas (SKB).</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td width="70px"><b style="font-size: 9px">Nomor :</b></td>
        <td colspan="2" style="border-bottom: 1px solid black;"></td>
        <td><b style="font-size: 9px">Tanggal</b></td>
        <td>

        </td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">B.10</b></td>
        <td class="border" width="20px" align="center"></td>
        <td colspan="5"><b style="font-size: 9px">PPh yang ditanggung oleh Pemerintah (DTP) berdasarkan :</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="5" style="border-bottom: 1px solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">B.11</b></td>
        <td class="border" width="20px" align="center"></td>
        <td colspan="5"><b style="font-size: 9px">PPh dalam hal transaksi menggunakan Surat Keterangan berdasarkan PP Nomor 23 Tahun 2018 dengan Nomor :</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="5" style="border-bottom: 1px solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">B.12</b></td>
        <td class="border" width="20px" align="center"></td>
        <td colspan="5"><b style="font-size: 9px">PPh yang dipotong/dipungut yang diberikan fasilitas PPh berdasarkan:</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="5" style="border-bottom: 1px solid black;">&nbsp;</td>
    </tr>
</table>
<br>
<b style="font-size: 9px">C. IDENTITAS PEMOTONG/PEMUNGUT</b>
<table style="border-collapse: collapse; border: 1px solid black; margin-top:5px;" width="100%" cellpadding="2">
    <tr>
        <td style="padding-top: 10px" width="20px"><b style="font-size: 9px">C.1</b></td>
        <td style="padding-top: 10px" width="120px"><b style="font-size: 9px">NPWP</b></td>
        <td style="padding-top: 10px" width="50px" align="center"><b style="font-size: 9px">:</b></td>
        <td colspan="2" style="padding-top: 10px">
            {{ $data->npwpPemotong }}
        </td>
        <td width="40px"></td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">C.2</b></td>
        <td><b style="font-size: 9px">Nama Wajib Pajak</b></td>
        <td align="center"><b style="font-size: 9px">:</b></td>
        <td colspan="2" style="border-bottom: 1px solid black; text-transform: uppercase;">{{ $data->user->profile->corporate_name }}</td>
        <td></td>
    </tr>
    <tr>
        <td width="20px"><b style="font-size: 9px">C.3</b></td>
        <td width="100px"><b style="font-size: 9px">Tanggal</b></td>
        <td width="50px" align="center"><b style="font-size: 9px">:</b></td>
        <td colspan="2">
            {{ $data->tglPemotongan }}
        </td>
        <td></td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">C.4</b></td>
        <td><b style="font-size: 9px">Nama Penandatangan</b></td>
        <td align="center"><b style="font-size: 9px">:</b></td>
        <td colspan="2" style="border-bottom: 1px solid black; text-transform: uppercase">{{ $data->namaTtd }}</td>
        <td></td>
    </tr>
    <tr>
        <td><b style="font-size: 9px">C.5</b></td>
        <td><b style="font-size: 9px">Pernyataan Wajib Pajak</b></td>
        <td align="center"><b style="font-size: 9px">:</b></td>
        <td colspan="2"><span style="font-size: 8px">
                Dengan ini saya menyatakan bahwa bukti Pemotongan/Pemungutan Unifikasi telah saya isi dengan benar dan telah saya tandatangani secara elektronik
            </span>
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3" rowspan="4" align="center"></td>
        <td colspan="2">
            <span style="font-size: 8px">
            Dengan ini saya menyatakan bahwa bukti Pemotongan/Pemungutan Unifikasi telah saya isi dengan benar dan telah saya tandatangani secara elektronik
        </span>
        </td>
        <td></td>
    </tr>
    <tr>
        <td class="border" width="15px" align="center">V</td>
        <td>
            <span style="font-size: 8px">
                Pengembalian atas kelebihan pembayaran pajak yang tidak seharusnya terutang oleh Pemotong dan/atau Pemungut PPh
            </span>
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td class="border" width="15px" align="center"></td>
        <td>
            <span style="font-size: 8px">
                Pemindahbukuan oleh Pemotong dan/atau Pemungut PPh
            </span>
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="2">
            <span  style="font-size: 8px">
                Sesuai dengan ketentuan yang berlaku di, Direktorat Jenderal pajak mengatur bahwa Bukti Pemotongan/Pemungutan PPh Unifikasi ini dinyatakan sah dan tidak diperlukan tanda tangan basah pada Bukti Pemotongan ini.
            </span>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>