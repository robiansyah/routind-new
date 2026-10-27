<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPT PPh UNIFIKASI</title>
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
        <td rowspan="2">
            <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="50px">
        </td>
        <td style="font-size:12px;">
            SURAT PEMBERITAHUAN (SPT) MASA<br>
            PAJAK PENGHASILAN
        </td>
        <td rowspan="3" style="line-height: normal;">
            FORMULIR SPT Masa PPh<br>
            UNIFIKASI
        </td>
    </tr>
    <tr align="center">
        <td>
            Formulir ini digunakan untuk melaorkan Pajak Penghasilan<br>
            Pasal 4 ayat (2), Pasal 15, Pasal 22,<br>
            Pasal 23 dan Pasal 26
        </td>
    </tr>
    <tr align="center">
        <td>Masa Pajak : {{ $data->start_period.' - '.$data->year }}</td>
        <td>{!! ($data->correction_to==0) ? 'SPT NORMAL' : 'SPT PEMBETULAN KE '.$data->correction_to !!} </td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>A. IDENTITAS PEMOTONG</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td width="100px">A.1 NPWP</td>
        <td width="5px">:</td>
        <td>{{ $data->user->npwp }}</td>
    </tr>
    <tr>
        <td>A.2 NAMA</td>
        <td>:</td>
        <td>{{ $data->user->profile->corporate_name }}</td>
    </tr>
    <tr>
        <td>A.3 ALAMAT</td>
        <td>:</td>
        <td>{{ $data->user->profile->address }}</td>
    </tr>
    <tr>
        <td>A.4 NO TELPON</td>
        <td>:</td>
        <td>{{ $data->user->mobile_phone }}</td>
    </tr>
</table>
<?php
$ps42pph_ss = 0; $ps42setor_ss = 0; $ps15pph_ss = 0; $ps15setor_ss = 0;
$ps42pph = 0; $ps42setor = 0; $ps15pph = 0; $ps15setor = 0;
$ps22pph = 0; $ps22setor = 0; $ps26pph = 0; $ps26setor = 0; $ps23pph = 0; $ps23setor = 0;
//pph
foreach($data->docs as $item){
    if($item->object->kdBupot==2){
        if($item->object->kdJnsPjk == "PPH4-2") {
            $ps42pph_ss += $item->jmlPph;
        }else {
            $ps15pph_ss += $item->jmlPph;
        }
    }else{
        if($item->object->kdJnsPjk == "PPH4-2"){
            $ps42pph += $item->jmlPph;
        }elseif($item->object->kdJnsPjk == "PPH22"){
            $ps22pph += $item->jmlPph;
        }elseif($item->object->kdJnsPjk == "PPH26"){
            $ps26pph += $item->jmlPph;
        }elseif($item->object->kdJnsPjk == "PPH23"){
            $ps23pph += $item->jmlPph;
        }else{
            $ps15pph += $item->jmlPph;
        }
    }
}

//setor
foreach ($deposit as $item){
    if($item->fgSsKb == 1){
        if($item->pay->object->kdJnsPjk == "PPH4-2") {
            $ps42setor_ss += $item->jmlSetor;
        }else {
            $ps15setor_ss += $item->jmlSetor;
        }
    }else{
        if($item->pay->object->kdJnsPjk == "PPH4-2"){
            $ps42setor += $item->jmlSetor;
        }elseif($item->pay->object->kdJnsPjk == "PPH22"){
            $ps22setor += $item->jmlSetor;
        }elseif($item->pay->object->kdJnsPjk == "PPH26"){
            $ps26setor += $item->jmlSetor;
        }elseif($item->pay->object->kdJnsPjk == "PPH23"){
            $ps23setor += $item->jmlSetor;
        }else{
            $ps15setor += $item->jmlSetor;
        }
    }
}
?>
<p style="padding-top: 8px;"><b>B. RESUME PAJAK PENGHASILAN</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <th>No</th>
        <th>Uraian</th>
        <th>PPh Terutang</th>
        <th width="100px">Jumlah PPh yang Ditanggung Pemerintah</th>
        <th width="100px">Jumlah PPh yang Disetor</th>
    </tr>
    <tr>
        <td align="center">B.1</td>
        <td align="center">B.2</td>
        <td align="center">B.3</td>
        <td align="center">B.4</td>
        <td align="center">B.5</td>
    </tr>
    <tr>
        <td colspan="5"><b>I. PPh YANG DISETOR SENDIRI</b></td>
    </tr>

    <tr>
        <td align="center">1</td>
        <td>PASAL 4 AYAT (2)</td>
        <td align="right">{{ number_format($ps42pph_ss, 0, ',', '.') }}</td>
        <td align="right">0</td>
        <td align="right">{{ number_format($ps42setor_ss, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td align="center">2</td>
        <td>PASAL 15
        </td>
        <td align="right">{{ number_format($ps15pph_ss, 0, ',', '.') }}</td>
        <td align="right">0</td>
        <td align="right">{{ number_format($ps15setor_ss, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td align="center">3</td>
        <td>JUMLAH YANG DISETORKAN SENDIRI</td>
        <td align="right">{{ number_format($ps42pph_ss+$ps15pph_ss, 0, ',', '.') }}</td>
        <td align="right">0</td>
        <td align="right">{{ number_format($ps42setor_ss+$ps15setor_ss, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td colspan="5"><b>II. PPh YANG TELAH DILAKUKAN PEMOTONGAN/PEMUNGUTAN</b></td>
    </tr>
    <tr>
        <td align="center">4</td>
        <td>PASAL 22</td>
        <td align="right">{{ number_format($ps22pph, 0, ',', '.') }}</td>
        <td align="right">0</td>
        <td align="right">{{ number_format($ps22setor, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td align="center">5</td>
        <td>PASAL 26</td>
        <td align="right">{{ number_format($ps26pph, 0, ',', '.') }}</td>
        <td align="right">0</td>
        <td align="right">{{ number_format($ps26setor, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td align="center">6</td>
        <td>PASAL 23</td>
        <td align="right">{{ number_format($ps23pph, 0, ',', '.') }}</td>
        <td align="right">0</td>
        <td align="right">{{ number_format($ps23setor, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td align="center">7</td>
        <td>PASAL 4
            AYAT (2)
        </td>
        <td align="right">{{ number_format($ps42pph, 0, ',', '.') }}</td>
        <td align="right">0</td>
        <td align="right">{{ number_format($ps42setor, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td align="center">8</td>
        <td>PASAL 15
        </td>
        <td align="right">{{ number_format($ps15pph, 0, ',', '.') }}</td>
        <td align="right">0</td>
        <td align="right">{{ number_format($ps15setor, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td align="center">9</td>
        <td>JUMLAH YANG DIPOTONG/DIPUNGUT
        </td>
        <td align="right">
            {{ number_format($ps42pph+$ps15pph+$ps23pph+$ps22pph+$ps26pph, 0, ',', '.') }}
        </td>
        <td align="right">0</td>
        <td align="right">
            {{ number_format($ps42setor+$ps15setor+$ps23setor+$ps22setor+$ps26setor, 0, ',', '.') }}
        </td>
    </tr>
    <tr>
        <td colspan="5"><b>III. REKAPITULASI PPh</b></td>
    </tr>

    <tr>
        <td align="center">10</td>
        <td>JUMLAH TOTAL PPh DAN PPh YANG DISETOR
        </td>
        <td align="right">
            {{ number_format($ps42pph+$ps15pph+$ps23pph+$ps22pph+$ps26pph+$ps42pph_ss+$ps15pph_ss, 0, ',', '.') }}
        </td>
        <td align="right">0</td>
        <td align="right">
            {{ number_format($ps42setor+$ps15setor+$ps23setor+$ps22setor+$ps26setor+$ps42setor_ss+$ps15setor_ss, 0, ',', '.') }}
        </td>
    </tr>
    <tr>
        <td align="center">11</td>
        <td colspan="2">JUMLAH TOTAL PPh YANG DISETOR PADA SPT YANG DIBETULKAN</td>
        <td align="right" colspan="2">0</td>
    </tr>
    <tr>
        <td align="center">12</td>
        <td colspan="2">JUMLAH PPh YANG KURANG (LEBIH) DISETOR KARENA PEMBETULAN
        </td>
        <td align="right" colspan="2">0</td>
    </tr>
</table>
<p style="padding-top: 8px;"><b>C. PERNYATAAN DAN TANDA TANGAN</b></p>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td colspan="3">C.1 Wajib Pajak/Wakil Wajib Pajak (Pengurus dll)</td>
        <td rowspan="4" width="20%" style="vertical-align: text-top;">C.6 Tanda Tangan</td>
    </tr>
    <tr>
        <td>C.2 NPWP</td>
        <td width="5px">:</td>
        <td>{{ $data->user->username }}</td>
    </tr>
    <tr>
        <td>C.3 Nama</td>
        <td>:</td>
        <td>{{ $data->user->name }}</td>
    </tr>
    <tr>
        <td>C.4 Tanggal</td>
        <td>:</td>
        <td>{{ $data->updated_at }}</td>
    </tr>
    <tr>
        <td>C.5 Pernyataan Wajib Pajak</td>
        <td>:</td>
        <td colspan="2">Dengan menyadari sepenuhnya atas segala akibatnya termasuk sanksi-sanksi sesuai dengan ketentuan yang berlaku, saya menyatakan bahwa apa yang telah saya beritahukan di atas beserta lampiran-lampirannya adalah benar, lengkap dan jelas</td>
    </tr>
</table>
</body>
</html>