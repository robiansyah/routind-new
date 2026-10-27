<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sertifikat</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: Helvetica;
            background-image: url({{ url($data->design->image) }});
            background-position: top left;
            background-repeat: no-repeat;
            background-size: 81.5%;
            padding: 200px 100px 10px 155px;
            width:100%;
            height:100%;
        }
        p {
            width: 700px;
        }
        .bottomright {
            position: absolute;
            bottom: 80px;
            right: 50px;
            font-size: 19px;
            text-align: right;
        }
    </style>
</head>
<body>

    <?php
    $year = substr($data->date,0, 4);
    $month = substr($data->date, 5, 2);
    ?>
    @if($year < 2025)
        <h2 style="font-size : 22px; padding: 4px 0 0 10px; color: white;">{{ $data->code }}</h2>
    @else
        <h2 style="font-size : 15px; padding: 14px 0 11px 15px; color: white;">No. {{ str_pad($data->no,5,"0",STR_PAD_LEFT)."/RTND/".$month."/".$year }}</h2>
    @endif
<span style="font-size : 20px; line-height: 1.5">Diberikan Kepada</span><br>
<span style="font-size : 35px; line-height: 1.5;">{!! ($data->user_id != '') ? $data->user->name : $data->username !!}</span><br>
<span style="font-size : 20px; line-height: 1.5;">{{ $data->description }}</span><br>
<span style="font-size : 30px; line-height: 1.5; padding-right: 200px;">{{ $data->name }}</span>
<p style="margin-top: 4em; padding-left: 5px; font-size : 20px;">{{ Carbon\Carbon::parse($data->date)->isoFormat('DD MMMM Y') }}</p>
<img src="{{ url($data->sign->image) }}" width="200px" style="margin-top: -20px;">
<p style="padding-left: 5px; font-size : 19px; line-height: 1.1; margin-top: -10px;">
    <b>{{ $data->sign->name }}</b><br>
    {!! $data->sign->position !!}
</p>
<div class="bottomright">
    <img src="data:image/png;base64, {!! DNS2D::getBarcodePNG(url('certificates/'.$data->code), 'QRCODE') !!} " alt="barcode" width="100px" style="padding: 10px"/><br>
    Verifikasi Sertifikat<br>
    routind.com/certificates/{{ $data->code }}
</div>
</body>
</html>