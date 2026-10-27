<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Pajak</title>
    <style>
        body
        {
            font-family:Helvetica;
            font-size:12px;
            margin-top: -0.5cm;
            margin-bottom: -0.5cm;
            margin-left: 1cm;
            margin-right: 0.5cm;
        }
        p{
            margin: 0;
        }

    </style>
</head>
<body>
<h2>FAKTUR PAJAK {!! ($data->status!='Normal' && $data->status!='Normal - Pengganti') ? strtoupper($data->status) : '' !!}</h2>
<table border="1" style="border-collapse: collapse;" cellpadding="4" width="100%">
    <tr>
        <td colspan="4">Kode dan Nomor Seri Faktur Pajak : {{ $data->transaction_code.".".$data->invoice_no }}</td>
    </tr>
    <tr>
        <td colspan="4">Pengusaha Kena Pajak</td>
    </tr>
    <tr>
        <td colspan="4">
            Nama : {{ $data->user->profile->corporate_name }}<br>
            Alamat : {{ $data->user->profile->address }}<br>
            NPWP : {{ $data->user->npwp }}
        </td>
    </tr>
    <tr>
        <td colspan="4">Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak</td>
    </tr>
    <tr>
        <td colspan="4">
            Nama : {{ $data->customer_name }}<br>
            Alamat : {{ $data->customer_address }}<br>
            {!! ($data->customer_type==0) ? 'NPWP' : 'NIK' !!} : {{ $data->customer_id }}
        </td>
    </tr>
    <tr>
        <td width="30px" align="center">No</td>
        <td width="50px" align="center">Kode Barang/ Jasa</td>
        <td align="center">Nama Barang Kena Pajak / Jasa Kena Pajak</td>
        <td align="center">Harga Jual/Penggantian/Uang Muka/Termin</td>
    </tr>
    <?php $no=1; $total=0; $discount=0;?>
    @foreach ($data->items as $item)
        <tr>
            <td align="center">{{ $no++ }}</td>
            <td align="center">000000</td>
            <td>
                {{ $item->name }}<br>
                Rp @money($item->price) x {{ $item->amount }}
                <br>Potongan Harga = Rp @money($item->discount)
                <br>PPnBM ({{ $item->tarif_ppnbm }}%) = Rp @money($item->ppnbm)
                
            </td>
            <td align="right">@money($item->price * $item->amount)</td>
        </tr>
        <?php 
            $total += ($item->price * $item->amount);
            $discount += $item->discount;
        ?>
    @endforeach
    <tr>
        <td colspan="3">{!! ($data->payment=='uang muka') ? 'Uang Muka / Termin' : 'Harga Jual / Penggantian'!!}</td>
        <td align="right">{!! ($data->payment=='uang muka') ? number_format($data->dpp_split, 0, ',', '.') : number_format($total, 0, ',', '.') !!}</td>
    </tr>
    <tr>
        <td colspan="3">Dikurangi Potongan Harga</td>
        <td align="right">{!! ($data->payment=='lunas') ? number_format($discount, 0, ',', '.') : number_format(0, 0, ',', '.') !!}</td>
    </tr>
    <tr>
        <td colspan="3">Dikurangi Uang Muka</td>
        <td align="right">
            {!! ($data->payment=='pelunasan') ? number_format($total-$data->dpp_split, 0, ',', '.') : ''!!}
        </td>
    </tr>
    <tr>
        <td colspan="3">Dasar Pengenaan Pajak</td>
        <td align="right">{!! ($data->payment=='lunas') ? number_format($data->dpp, 0, ',', '.') : number_format($data->dpp_split, 0, ',', '.') !!}</td>
    </tr>
    <tr>
        <td colspan="3">PPN = {{ (substr($data->invoice_date,0,4) < 2025 ? 11 : 12) }}% x Dasar Pengenaan Pajak</td>
        <td align="right">{!! ($data->payment=='lunas') ? number_format($data->ppn, 0, ',', '.') : number_format($data->ppn_split, 0, ',', '.') !!}</td>
    </tr>
    <tr>
        <td colspan="3">Total PPnBM (Pajak Penjualan Barang Mewah)</td>
        <td align="right">{!! ($data->payment=='lunas') ? number_format($data->ppnbm, 0, ',', '.') : number_format($data->ppnbm_split, 0, ',', '.') !!}</td>
    </tr>
</table>
<br>
Sesuai dengan ketentuan yang berlaku, Direktorat Jenderal Pajak mengatur bahwa Faktur Pajak ini telah ditandatangani secara elektronik sehingga tidak diperlukan tanda tangan basah pada Faktur Pajak ini.
<br><br>
<table width="100%">
    <tr>
        <td width="60%"></td>
        <td>
            {{ Carbon\Carbon::parse($data->invoice_date)->isoFormat('DD MMMM Y') }}
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td>DIREKTUR</td>
    </tr>
</table>
</body>
</html>