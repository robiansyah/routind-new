<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Final</title>
    <style>
        body
        {
            font-family:Helvetica;
            font-size:10px;
            margin-top: -0.5cm;
            margin-bottom: -0.5cm;
            margin-left: 1cm;
            margin-right: 0.5cm;
            line-height: 0.4cm;
        }
        p{
            margin: 0;
        }
        .page_break { page-break-before: always; }
    </style>
</head>
<body>

<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td rowspan="2">
            <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="50px">
        </td>
        <td align="center" style="font-size:12px;">
            BUKTI PEMOTONGAN PAJAK<br>
            PENGHASILAN PASAL 21<br>
            (FINAL)
        </td>
        <td align="center" style="line-height: normal;">
            FORMULIR 1721 - VII
        </td>
    </tr>
    <tr>
        <td colspan="2">NOMOR : {{ $bupot->no }}</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>A. IDENTITAS PENERIMA PENGHASILAN YANG DIPOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td width="100px">1. NPWP</td>
        <td width="5px">:</td>
        <td width="150px">{{ $bupot->npwp }}</td>
        <td width="120px">2. NIK/NO. PASPOR</td>
        <td width="5px">:</td>
        <td width="150px">{{ $bupot->nik }}</td>
    </tr>
    <tr>
        <td>3. NAMA</td>
        <td>:</td>
        <td colspan="4">{{ $bupot->name }}</td>
    </tr>
    <tr>
        <td>4. ALAMAT</td>
        <td>:</td>
        <td colspan="4">{{ $bupot->address }}</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>B. PPh PASAL 21 YANG DIPOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <th>KODE OBJEK PAJAK</th>
        <th width="200px">JUMLAH PENGHASILAN BRUTO (Rp)</th>
        <th width="50px">TARIF (%)</th>
        <th>PPh DIPOTONG (Rp)</th>
    </tr>
    <tr>
        <td align="center">(1)</td>
        <td align="center">(2)</td>
        <td align="center">(3)</td>
        <td align="center">(4)</td>
    </tr>
    <tr>
        <td align="center">{{ $bupot->object_code }}</td>
        <td align="right">@money($bupot->bruto)</td>
       <td align="center">{{ $bupot->tarif }}</td>
        <td align="right">@money($bupot->pph)</td>
    </tr>

</table>
<p style="padding-top: 8px;"><b>C. IDENTITAS PEMOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td>1. NPWP</td>
        <td>:</td>
        <td>{{ $bupot->user->npwp }}</td>
        <td>3. TANGGAL & TANDA TANGAN</td>
        <td rowspan="2" width="50px"></td>
    </tr>
    <tr>
        <td>2. NAMA</td>
        <td>:</td>
        <td>{{ $bupot->user->profile->corporate_name }}</td>
        <td>{{ $bupot->date }}</td>
    </tr>
</table>
</body>
</html>