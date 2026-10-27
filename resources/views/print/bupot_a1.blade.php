<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Potong A1</title>
    <style>
        body
        {
            font-family:Helvetica;
            font-size:9px;
            margin-top: -0.5cm;
            margin-bottom: -0.5cm;
            margin-left: 1cm;
            margin-right: 0.5cm;
            line-height: 0.5cm;
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
        <td align="center" style="font-size:12px;">
            BUKTI PEMOTONGAN PAJAK PENGHASILAN<br>
            PASAL 21 BAGI PEGAWAI TETAP ATAU<br>
            PENERIMA PENSIUN ATAU TUNJANGAN HARI <br>
            TUA/JAMINAN HARI TUA BERKALA
        </td>
        <td align="center" style="line-height: normal;">
            FORMULIR 1721<br>
            <b style="font-size: 25px;">A1</b></td>
    </tr>
</table>
<table border="1" style="border-collapse: collapse;" cellpadding="2" width="100%">
    <tr>
        <td width="150px">NPWP PEMOTONG</td>
        <td width="5px">:</td>
        <td>{{ $data->user->npwp }}</td>
    </tr>
    <tr>
        <td>NAMA PEMOTONG</td>
        <td>:</td>
        <td>{{ $data->user->profile->corporate_name }}</td>
    </tr>
</table>
<b>A. IDENTITAS PENERIMA PENGHASILAN YANG DIPOTONG</b>
<table border="1" style="border-collapse: collapse;" cellpadding="2" width="100%">
    <tr>
        <td width="150px">1. NPWP</td>
        <td width="5px">:</td>
        <td>{{ $data->nik }}</td>
        <td width="150px">6. PTKP</td>
        <td width="5px">:</td>
        <td>{!! ((substr($data->ptkp_code, 0, 1)=='0') ? 'TK/' : ((substr($data->ptkp_code, 0, 1)=='1') ? 'K/' : 'T/I/')).substr($data->ptkp_code, -1) !!}</td>
    </tr>
    <tr>
        <td>2. NIK/NO PASPOR</td>
        <td>:</td>
        <td>-</td>
        <td>7. NAMA JABATAN</td>
        <td>:</td>
        <td>{{ $data->position }}</td>
    </tr>
    <tr>
        <td>3. NAMA</td>
        <td>:</td>
        <td>{{ $data->name }}</td>
        <td>8. KARYAWAN ASING</td>
        <td>:</td>
        <td>TIDAK</td>
    </tr>
    <tr>
        <td>4. ALAMAT</td>
        <td>:</td>
        <td>{{ $data->address }}</td>
        <td>9. KODE NEGARA DOMISILI</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>5. JENIS KELAMIN</td>
        <td>:</td>
        <td colspan="4"></td>
    </tr>
</table>
<b>B. RINCIAN PENGHASILAN DAN PENGHITUNGAN PPh PASAL 21</b>
<table border="1" style="border-collapse: collapse;" cellpadding="2" width="100%">
    <tr>
        <th colspan="2" align="center">URAIAN</th>
        <th align="center">JUMLAH (Rp</th>
    </tr>
    <tr>
        <td colspan="2">KODE OBJEK PAJAK</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2">PENGHASILAN BRUTO</td>
        <td></td>
    </tr>
    <tr>
        <td width="20px" align="center">1</td>
        <td width="80%">GAJI/PENSIUN ATAU THT/JHT</td>
        <td align="right">@money($salary)</td>
    </tr>
    <tr>
        <td width="20px" align="center">2</td>
        <td>TUNJANGAN PPh</td>
        <td align="right">@money($pph)</td>
    </tr>
    <tr>
        <td width="20px" align="center">3</td>
        <td>TUNJANGAN LAINNYA, UANG LEMBUR DAN SEBAGAINYA</td>
        <td align="right">@money($other)</td>
    </tr>
    <tr>
        <td width="20px" align="center">4</td>
        <td>HONORARIUM DAN IMBALAN LAIN SEJENISNYA</td>
        <td align="right">@money($honorarium)</td>
    </tr>
    <tr>
        <td width="20px" align="center">5</td>
        <td>PREMI ASURANSI YANG DIBAYAR PEMBERI KERJA</td>
        <td align="right">@money($premi)</td>
    </tr>
    <tr>
        <td width="20px" align="center">6</td>
        <td>PENERIMAAN DALAM BENTUK NATURA DAN KENIKMATAN LAINNYA YANG DIKENAKAN PEMOTONGAN PPh PASAL 21</td>
        <td align="right">@money($natura)</td>
    </tr>
    <tr>
        <td width="20px" align="center">7</td>
        <td>TANTIEM, BONUS, GRATIFIKASI, JASA PRODUKSI DAN THR</td>
        <td align="right">@money($thr)</td>
    </tr>
    <tr>
        <td width="20px" align="center">8</td>
        <td>JUMLAH PENGHASILAN BRUTO (1 S.D 7)</td>
        <td align="right">@money($bruto)</td>
    </tr>
    <tr>
        <td colspan="2">PENGURANGAN</td>
        <td></td>
    </tr>
    <tr>
        <td width="20px" align="center">9</td>
        <td>BIAYA JABATAN/BIAYA PENSIUN</td>
        <td align="right">
            @php($position = ($bruto*0.05>=6000000) ? 6000000 : $bruto*0.05)
            @money($position)
        </td>
    </tr>
    <tr>
        <td width="20px" align="center">10</td>
        <td>IURAN PENSIUNAN ATAU IURAN THT/JHT</td>
        <td align="right">@money($pension)</td>
    </tr>
    <tr>
        <td width="20px" align="center">11</td>
        <td>JUMLAH PENGURANGAN (9 S.D 10)</td>
        <td align="right">@money($position+$pension)</td>
    </tr>
    <tr>
        <td colspan="2">PENGHITUNGAN PPh PASAL 21</td>
        <td></td>
    </tr>
    <tr>
        <td width="20px" align="center">12</td>
        <td>JUMLAH PENGHASILAN NETO (8 - 10)</td>
        <td align="right">@money($bruto-($position+$pension))</td>
    </tr>
    <tr>
        <td width="20px" align="center">13</td>
        <td>PENGHASILAN NETO MASA SEBELUMNYA</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td width="20px" align="center">14</td>
        <td>JUMLAH PENGHASILAN NETO UNTUK PENGHITUNGAN PPh PASAL 21 (SETAHUN/DISETAHUNKAN)</td>
        <td align="right">@money($bruto-($position+$pension))</td>
    </tr>
    <tr>
        <td width="20px" align="center">15</td>
        <td>PENGHASILAN TIDAK KENA PAJAK (PTKP)</td>
        <td align="right">@money($ptkp)</td>
    </tr>
    <tr>
        <td width="20px" align="center">16</td>
        <td>PENGHASILAN KENA PAJAK SETAHUN/DISETAHUNKAN (14-15)</td>
        <td align="right">{{ ($bruto-($position+$pension)-$ptkp > 0) ? number_format($bruto-($position+$pension)-$ptkp, 0, ',', '.') : 0 }}</td>
    </tr>
    <tr>
        <td width="20px" align="center">17</td>
        <td>PPh PASAL 21 ATAS PENGHASILAN KENA PAJAK SETAHUN/DISETAHUNKAN</td>
        <td align="right">@money($terutang)</td>
    </tr>
    <tr>
        <td width="20px" align="center">18</td>
        <td>PPh PASAL 21 YANG TELAH DIPOTONG MASA SEBELUMNYA</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td width="20px" align="center">19</td>
        <td>PPh PASAL 21 TERUTANG</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td width="20px" align="center">20</td>
        <td>PPh PASAL 21 DAN PPh PASAL 26 YANG TELAH DIPOTONG DAN DILUNASI</td>
        <td align="right">@money($terutang)</td>
    </tr>
</table>
<b>C. IDENTITAS PEMOTONG</b>
<table border="1" style="border-collapse: collapse;" cellpadding="2" width="100%">
    <tr>
        <td width="150px">1. NPWP</td>
        <td width="5px">:</td>
        <td>{{ $data->user->username }}</td>
        <td>3. TANGGAL & TANDA TANGAN</td>
        <td rowspan="2" width="100px"></td>
    </tr>
    <tr>
        <td>2. NAMA</td>
        <td>:</td>
        <td>{{ $data->user->name }}</td>
        <td>{{ date('d m Y') }}</td>
    </tr>
</table>
</body>
</html>