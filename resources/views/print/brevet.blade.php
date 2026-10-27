<?php
$year = substr($data->date,0, 4);
$month = substr($data->date, 5, 2);
$qrcode = DNS2D::getBarcodePNG(url('certificates/'.$data->code), 'QRCODE');
$image = ($data->type=='') ? '' : '-'.$data->type;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sertifikat Brevet</title>
    <style>
        @page { margin: 0; }
        body{
            font-size : 35px;
        }
        p {
            width: 700px;
        }

        .bottom {
            position: absolute;
            bottom: 100px;
            left: 120px;
        }

        .bottom2 {
            position: absolute;
            bottom: 100px;
            right: 120px;
        }
        .page-break{
            page-break-before: always;
        }
        #first{
            background-image: url({{ url('images/brevet-hal-1'.$image.'.jpg') }});
            font-family: Helvetica;
            background-position: top left;
            background-repeat: no-repeat;
            background-size: 88%;
            padding: 80px 120px 0 120px;
            width:100%;
            height:1160px;
        }
        #second{
            background-image: url({{ url('images/brevet-hal-2'.$image.'.jpg') }});
            font-family: Helvetica;
            background-position: top left;
            background-repeat: no-repeat;
            background-size: 85.5%;
            padding: 150px;
            width:100%;
            height:100%;
        }
    </style>
</head>
<body>
{{--Halaman Pertama--}}
<div id="first">
    <div style="width: 1450px">
        <h4 style="text-align:center; font-size: 30px; font-weight: normal; margin: 275px 0 0 55px; padding: 0;">Nomor : {{ str_pad($data->no,5,"0",STR_PAD_LEFT)."/RTND/".$month."/".$year }}</h4>
        <h4 style="text-align:center; font-weight: normal; margin: 10px 0 0 55px; padding: 0;">Diberikan Kepada :</h4>
        <h4 style="text-align:center; margin: 10px 0 0 55px; padding: 0;">Nama Lengkap : {{ $data->user->name }}</h4>
        <h4 style="text-align:center; margin: 5px 0 0 55px; padding: 0;">No Peserta : {{ $data->participant_no }}</h4>
        <h4 style="text-align:center; font-size: 32px; font-weight: normal; margin: 230px 0 0 55px; padding: 0;">
            Angkatan {{ $data->batch }} dari tanggal {{ Carbon\Carbon::parse($data->start)->isoFormat('DD MMMM Y') }} s.d {{ Carbon\Carbon::parse($data->end)->isoFormat('DD MMMM Y') }}<br>Dengan kehadiran selama 2280 menit dari total 2280 menit yang harus diikuti.
        </h4>
        <h4 style="text-align:center; font-size: 30px; font-weight: normal; margin: 30px 0 0 55px; padding: 0;">Malang, {{ Carbon\Carbon::parse($data->date)->isoFormat('DD MMMM Y') }}</h4>
        @if($data->type=='')
        <h4 style="text-align:center; margin: 0 0 0 55px; padding: 0;"><img src="{{ url($sign->image) }}" width="290px"></h4>
        @endif
        <div class="bottom">
            <img src="data:image/png;base64, {!! $qrcode !!} " alt="barcode" width="130px" style="padding: 10px"/>
        </div>
    </div>
</div>
{{--Halaman Kedua--}}
<div class="page-break" id="second">
    <div style="width: 1450px">
        <h4 style="text-align:center; margin: 200px 0 0 0; padding: 0;">Nama Lengkap : {{ $data->user->name }}</h4>
        <h4 style="text-align:center; margin: 5px 0 0 0; padding: 0;">No Peserta : {{ $data->participant_no }}</h4>

        <h4 style="text-align:center; margin: 85px 0 0 880px; padding: 0;">{{ $data->kup }}</h4>
        <h4 style="text-align:center; margin: 8px 0 0 880px; padding: 0;">{{ $data->ppn }}</h4>
        <h4 style="text-align:center; margin: 8px 0 0 880px; padding: 0;">{{ $data->pbb }}</h4>
        <h4 style="text-align:center; margin: 8px 0 0 880px; padding: 0;">{{ $data->op }}</h4>
        <h4 style="text-align:center; margin: 8px 0 0 880px; padding: 0;">{{ $data->ap }}</h4>
        <h4 style="text-align:center; margin: 8px 0 0 880px; padding: 0;">{{ $data->badan }}</h4>
        <h4 style="text-align:center; margin: 8px 0 0 880px; padding: 0;">{{ $data->potput }}</h4>
        <div class="bottom2">
            <img src="data:image/png;base64, {!! $qrcode !!} " alt="barcode" width="130px" style="padding: 10px"/>
        </div>
    </div>
</div>
</body>
</html>