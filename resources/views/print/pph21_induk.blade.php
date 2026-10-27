<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPT Masa Pasal 21/26</title>
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
    <tr align="center">
        <td>
            <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="50px">
        </td>
        <td style="font-size:12px;">
            SURAT PEMBERITAHUAN (SPT) MASA<br>
            PAJAK PENGHASILAN<br>
        </td>
        <td style="line-height: normal;">
            FORMULIR 1721<br>
            <b style="font-size: 22px;">INDUK</b>
        </td>
    </tr>
    <tr align="center">
        <td>Masa Pajak : {{ $spt->start_period.' - '.$spt->year }}</td>
        <td>{!! ($spt->correction_to==0) ? 'SPT NORMAL' : 'SPT PEMBETULAN KE '.$spt->correction_to !!} </td>
        <td>JUMLAH LEMBAR</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>A. IDENTITAS PEMOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td width="100px">1. NPWP</td>
        <td width="5px">:</td>
        <td colspan="4">{{ $spt->user->npwp }}</td>
    </tr>
    <tr>
        <td>2. NAMA</td>
        <td>:</td>
        <td colspan="4">{{ $spt->user->profile->corporate_name }}</td>
    </tr>
    <tr>
        <td>3. ALAMAT</td>
        <td>:</td>
        <td colspan="4">{{ $spt->user->profile->address }}</td>
    </tr>
    <tr>
        <td>4. NO TELPON</td>
        <td>:</td>
        <td width="200px">{{ $spt->user->mobile_phone }}</td>
        <td>5. EMAIL</td>
        <td width="5px">:</td>
        <td>{{ $spt->user->email }}</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>B. OBJEK PAJAK</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <th>No</th>
        <th>Penerima Penghasilan</th>
        <th>Kode Objek Pajak</th>
        <th width="50px">Jumlah Penerima Penghasilan</th>
        <th width="75px">Jumlah Penghasilan Bruto</th>
        <th width="75px">Jumlah Pajak Dipotong</th>
    </tr>
    <tr>
        <td align="center">(1)</td>
        <td align="center">(2)</td>
        <td align="center">(3)</td>
        <td align="center">(4)</td>
        <td align="center">(5)</td>
        <td align="center">(6)</td>
    </tr>
    <?php $no = 1; $penerima=0; $bruto=0; $pph=0; $char = 'a'?>
    @foreach ($tidak as $item)
        @if($no==4)
            <tr>
                <td align="center">{{ $no++ }}</td>
                <td>Bukan Pegawai</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td>{{ $no-1 .$char++.'. '.$item->object->nmObjkPjk }}</td>
                <td align="center">{{ $item->kdObjPjk }}</td>
                <td align="center">{{ $item->jmlPenerima }}</td>
                <td align="right">@money($item->jmlBruto)</td>
                <td align="right">@money($item->jmlPph)</td>
            </tr>
        @elseif($no==5 && $char< 'g')
            <tr>
                <td align="center"></td>
                <td>{{ $no-1 .$char++.'. '.$item->object->nmObjkPjk }}</td>
                <td align="center">{{ $item->kdObjPjk }}</td>
                <td align="center">{{ $item->jmlPenerima }}</td>
                <td align="right">@money($item->jmlBruto)</td>
                <td align="right">@money($item->jmlPph)</td>
            </tr>
        @else
            <tr>
                <td align="center">{{ $no++ }}</td>
                <td>{{ $item->object->nmObjkPjk }}</td>
                <td align="center">{{ $item->kdObjPjk }}</td>
                <td align="center">{{ $item->jmlPenerima }}</td>
                <td align="right">@money($item->jmlBruto)</td>
                <td align="right">@money($item->jmlPph)</td>
            </tr>
        @endif
        <?php $penerima += $item->jmlPenerima; $bruto += $item->jmlBruto; $pph += $item->jmlPph?>
    @endforeach
    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
        <td align="center">11</td>
        <td>Jumlah (Penjumlahan Angka 1 Sd 10)</td>
        <td></td>
        <td align="center">{{ $penerima }}</td>
        <td align="right">@money($bruto)</td>
        <td align="right">@money($pph)</td>
    </tr>
    <tr>
        <td align="center">12</td>
        <td colspan="4">STP PPh Pasal 21 dan/atau Pasal 26 (Hanya Pokok Pajak)</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td align="center">13</td>
        <td colspan="4">Kelebihan Penyetoran PPh Pasal 21 dan/atau Pasal 26</td>
        <td align="right">0</td>
    </tr>
    <tr>
        <td align="center">14</td>
        <td colspan="4">Jumlah (12 + 13)</td>
        <td align="right"></td>
    </tr>
    <tr>
        <td align="center">15</td>
        <td colspan="4">PPh Pasal 21 dan/atau Pasal 26 yang Kurang (Lebih) Disetor (11 - 14)</td>
        <td align="right">@money($pph)</td>
    </tr>
    <tr>
        <td align="center">16</td>
        <td colspan="4">PPh Pasal 21 dan/atau Pasal 26 yang Kurang (Lebih) Disetor pada SPT yang Dibetulkan</td>
        <td align="right"></td>
    </tr>
    <tr>
        <td align="center">17</td>
        <td colspan="4">PPh Pasal 21 dan/atau Pasal 26 yang Kurang (Lebih) Disetor karena Pembetulan (15 - 16)</td>
        <td align="right"></td>
    </tr>
    <tr>
        <td align="center">18</td>
        <td colspan="4">Kelebihan Setor pada Angka 15 atau Angka 17 akan Dikompensasikan ke Masa Pajak</td>
        <td align="right"></td>
    </tr>
</table>
<div class="page_break"></div>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="80%" >
    <tr>
        <td>NPWP Pemotong</td>
        <td width="5px">:</td>
        <td>{{ $spt->user->npwp }}</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>C. OBJEK PAJAK FINAL</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <th>No</th>
        <th>Penerima Penghasilan</th>
        <th>Kode Objek Pajak</th>
        <th width="50px">Jumlah Penerima Penghasilan</th>
        <th width="75px">Jumlah Penghasilan Bruto</th>
        <th width="75px">Jumlah Pajak Dipotong</th>
    </tr>
    <tr>
        <td align="center">(1)</td>
        <td align="center">(2)</td>
        <td align="center">(3)</td>
        <td align="center">(4)</td>
        <td align="center">(5)</td>
        <td align="center">(6)</td>
    </tr>
    <?php $no = 1; $penerima=0; $bruto=0; $pph=0;?>
    @foreach ($final as $item)
        <tr>
            <td align="center">{{ $no++ }}</td>
            <td>{{ $item->object->nmObjkPjk }}</td>
            <td align="right">{{ $item->kdObjPjk }}</td>
            <td align="center">{{ $item->description }}</td>
            <td align="right">@money($item->jmlBruto)</td>
            <td align="right">@money($item->jmlPph)</td>
        </tr>
    <?php $penerima += $item->jmlPenerima; $bruto += $item->jmlBruto; $pph += $item->jmlPph?>
    @endforeach
    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
        <td align="center">11</td>
        <td>Jumlah Bagian C (Penjumlahan Angka 1 Sd 4)</td>
        <td></td>
        <td align="center">{{ $penerima }}</td>
        <td align="right">@money($bruto)</td>
        <td align="right">@money($pph)</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>D. LAMPIRAN</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td>1.</td>
        <td>Formulir 1721 - I<br>(untuk Satu Masa Pajak)</td>
        <td>Lembar</td>
        <td>5.</td>
        <td>Formulir 1721 - IV</td>
        <td>Lembar</td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Formulir 1721 - I<br>(untuk Satu Tahun Pajak)</td>
        <td>Lembar</td>
        <td>6.</td>
        <td>Formulir 1721 - V</td>
        <td>Lembar</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>Formulir 1721 - II</td>
        <td>Lembar</td>
        <td>7.</td>
        <td>Surat Setoran Pajak (SSP) dan/atau<br>Bukti Pemindah Bukuan (Pbk)</td>
        <td>Lembar</td>
    </tr>
    <tr>
        <td>4.</td>
        <td>Formulir 1721 - III</td>
        <td>Lembar</td>
        <td>5.</td>
        <td>Surat Kuasa Khusus</td>
        <td></td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>E. PERNYATAAN DAN TANDA TANGAN PEMOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td colspan="4">Dengan menyadari sepenuhnya atas segala akibatnya termasuk sanksi-sanksi sesuai dengan ketentuan yang berlaku, saya menyatakan bahwa apa yang telah saya beritahukan di atas beserta lampiran-lampirannya adalah benar, lengkap dan jelas</td>
    </tr>
    <tr>
        <td>1. Pemotong</td>
        <td></td>
        <td></td>
        <td rowspan="5" width="40%" style="vertical-align: text-top;">6. Tanda Tangan</td>
    </tr>
    <tr>
        <td>2. NPWP</td>
        <td width="5px">:</td>
        <td>{{ $spt->user->username }}</td>
    </tr>
    <tr>
        <td>3. Nama</td>
        <td>:</td>
        <td>{{ $spt->user->name }}</td>
    </tr>
    <tr>
        <td>4. Tanggal</td>
        <td>:</td>
        <td>{{ $spt->updated_at }}</td>
    </tr>
    <tr>
        <td>5. Tempat</td>
        <td>:</td>
        <td></td>
    </tr>
</table>
</body>
</html>