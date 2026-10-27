<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PPh 21 Bulanan</title>
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
        <td rowspan="2" align="center">
            <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="50px">
        </td>
        <td align="center" style="font-size:12px;">
            BUKTI POTONG PAJAK<br>
            PENGHASILAN PASAL 21 BULANAN
        </td>
        <td align="center" style="line-height: normal;">
            FORMULIR 1721 - VIII
        </td>
    </tr>
    <tr>
        <td colspan="2">NOMOR : {{ $ter->no }}</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>A. IDENTITAS PENERIMA PENGHASILAN YANG DIPOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td width="100px">1. NPWP/NIK</td>
        <td width="5px">:</td>
        <td>{{ $ter->nik }}</td>
    </tr>
    <tr>
        <td>3. NAMA</td>
        <td>:</td>
        <td>{{ $ter->name }}</td>
    </tr>
    <tr>
        <td>4. ALAMAT</td>
        <td>:</td>
        <td>{{ $ter->address }}</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>B. PPh PASAL 21 DAN/ATAU PASAL 26 YANG DIPOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <th>KODE OBJEK PAJAK</th>
        <th>JUMLAH PENGHASILAN BRUTO (Rp)</th>
        <th>DASAR PENGENAAN PAJAK (Rp)</th>
        <th width="100px">TARAIF LEBIH TINGGI 20% (TIDAK BE-RNPWP)</th>
        <th width="50px">TARIF (%)</th>
        <th width="75px">PPh DIPOTONG (Rp)</th>
    </tr>
    <tr>
        <td align="center">(1)</td>
        <td align="center">(2)</td>
        <td align="center">(3)</td>
        <td align="center">(4)</td>
        <td align="center">(5)</td>
        <td align="center">(6)</td>
    </tr>
    <tr>
        <td align="center">{!! ($ter->status=='Pegawai Tetap') ? '21-100-01' : '21-100-02' !!}</td>
        <td align="right">@money($ter->bruto)</td>
        <td align="right">@money($ter->bruto)</td>
        <td align="center">{!! ($ter->personalia->npwp=='') ? 'YA' : '' !!}</td>
        <td align="center">{{ $ter->rates }}</td>
        <td align="right">@money($ter->terutang)</td>
    </tr>

</table>
<p style="padding-top: 8px;"><b>C. IDENTITAS PEMOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td>1. NPWP</td>
        <td>:</td>
        <td>{{ $ter->user->npwp }}</td>
        <td>3. TANGGAL & TANDA TANGAN</td>
        <td rowspan="2" width="50px"></td>
    </tr>
    <tr>
        <td>2. NAMA</td>
        <td>:</td>
        <td>{{ $ter->user->profile->corporate_name }}</td>
        <td>{{ $ter->created_at }}</td>
    </tr>
</table>
</body>
</html>