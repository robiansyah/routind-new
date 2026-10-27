<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $invoice->no }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: Helvetica;
            font-size: 14px;
            background-image: url(https://routind.com/img/{{ $invoice->status }}.jpg);
            background-position: top left;
            background-repeat: no-repeat;
            background-size: 100%;
            padding: 40px 50px 50px 50px;
        }

        td.no-border-right {
            border-right: solid 1px #FFF;
        }
        td.no-border-left-right {
            border-left: solid 1px #FFF;
            border-right: solid 1px #FFF;
        }
        td.no-border-top-bottom {
            border-top: solid 1px #FFF;
            border-bottom: solid 1px #FFF;
        }
        td.no-border-bottom {
            border-bottom: solid 1px #FFF;
        }
        td.no-border {
            border-top: solid 1px #FFF;
            border-bottom: solid 1px #FFF;
            border-left: solid 1px #FFF;
            border-right: solid 1px #FFF;
        }
        td.no-border-left{
            border-left: solid 1px #FFF;
        }
    </style>
</head>
<body>
<table width="100%">
    <tr>
        <td width="50%"><img src="https://digipartner.co.id/wp-content/uploads/2024/05/Logo-Digi-Partner-Baru-1536x644.png" width="200px"></td>
        <td>
            <span style="color: #09679E">
                <b style="font-size: 25px;">PT Digi Partner Studio</b><br>
                Vila Bukit Tidar Blok A1-128, Kota Malang,<br>
                JawaTimur, Kode Pos: 65144<br>
                NPWP: 39.011.491.6-652.000
            </span>
        </td>
    </tr>
</table>
<br><br>
<table width="100%">
    <tr>
        <td width="60%">Kepada : </td>
        <td>Tanggal : {{ Carbon\Carbon::parse($invoice->date)->isoFormat('D MMM YYYY') }}</td>
    </tr>
    <tr>
        <td>{!! $invoice->name !!}<br>{{ $invoice->address }}</td>
        <td valign="top">Nomor &nbsp;&nbsp;: {{ $invoice->no }}</td>
    </tr>
</table>
<br><br>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td align="center" width="100px"><b>Kode</b></td>
        <td align="center"><b>Nama Barang/Jasa</b></td>
        <td align="center" width="130px"><b>Harga</b></td>
        <td align="center"><b>Qty</b></td>
        <td align="center" width="130px"><b>Total Harga</b></td>
    </tr>
    <tr>
        <td>{{ $invoice->code }}</td>
        <td>{{ $invoice->item }}</td>
        <td align="right">Rp. @money($invoice->price),-</td>
        <td align="center">{{ $invoice->qty }}</td>
        <td align="right">Rp. @money($invoice->price*$invoice->qty),-</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<br><br>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td width="150px" class="no-border-top-bottom no-border-left">Terbilang </td>
        <td><i>{{ ucwords(Terbilang::make($invoice->price*$invoice->qty, ' Rupiah')) }}</i></td>
    </tr>
</table>
<br><br>
<table border="1" style="border-collapse: collapse;" cellpadding="1" width="100%">
    <tr>
        <td rowspan="{{ ($invoice->type!='' && $invoice->payment != '') ? '4' : '3' }}" style="padding-left: 5px">
            Keterangan:<br>
            Rekening BSI<br>
            7235653251 {!! ($invoice->type!='' && $invoice->payment != '') ? '<br>' : '/' !!} Bank Syariah Indonesia<br>
            a.n PT Digi Partner Studio<br>
        </td>
        <td width="100px" rowspan="{{ ($invoice->type!='' && $invoice->payment != '') ? '4' : '3' }}" class="no-border-top-bottom"></td>
        <td>Sub Total</td>
        <td align="right">Rp. @money($invoice->price*$invoice->qty),-</td>
    </tr>
    <tr>
        <td>Diskon</td>
        <td align="right">
            @if($invoice->discount==0)
                -
            @else
                @money($invoice->discount),-
            @endif
        </td>
    </tr>
    @if($invoice->type!='' && $invoice->payment != '')
    <tr>
        <td>{{ $invoice->type }}</td>
        <td align="right">Rp. @money($invoice->payment),-</td>
    </tr>
    <tr>

        <td><b>Total</b></td>
        <td align="right"><b>Rp. @money($invoice->payment),-</b></td>
    </tr>
    @else
    <tr>
        <td><b>Total</b></td>
        <td align="right"><b>Rp. @money(($invoice->price*$invoice->qty)-$invoice->discount),-</b></td>
    </tr>
    @endif
</table>
<br>
<img src="data:image/png;base64, {!! DNS2D::getBarcodePNG(url('qrcode/'.$invoice->qrcode), 'QRCODE') !!} " alt="barcode" width="100px"/>
</body>
</html>