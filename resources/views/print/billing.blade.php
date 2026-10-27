<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetakan Kode Billing</title>
    <style>
        body
        {
            font-family:Helvetica;
            font-size:14px;
            margin-top: -0.5cm;
            margin-bottom: -0.5cm;
            margin-left: 1cm;
            margin-right: 0.5cm;
            line-height: 0.7cm;
        }
        p{
            margin: 0;
        }

        header {
            position: fixed;
            top: -20px;
            left: 40px;
            right: 40px;
        }

        footer {
            position: fixed; 
            bottom: -30px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            text-align: center;
        }
    </style>
</head>
<body>
<header>
<table width="100%">
    <tr>
        <td>
            <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="50px">
        </td>
        <td>
            SIMULATOR PAJAK<br>
        </span>
        </td>
        <td align="center" style="line-height: normal;">CETAKAN KODE <br>BILLING</td>
    </tr>
</table>
</header>


<table width="100%" style="margin-top:100px;">
    <tr>
        <td width="180px">NPWP</td>
        <td width="10px">:</td>
        <td>{!! ($data->wp_type==1) ? $data->user->username : $data->user->npwp !!}</td>
    </tr>
    <tr>
        <td>NAMA</td>
        <td>:</td>
        <td>{!! ($data->wp_type==1) ? strtoupper($data->user->name) : strtoupper($data->user->profile->corporate_name) !!}</td>
    </tr>
    <tr>
        <td valign="top">ALAMAT</td>
        <td valign="top">:</td>
        <td>{{ ucwords($data->user->profile->address ?? "-") }}</td>
    </tr>
    <tr>
        <td>NOP</td>
        <td>:</td>
        <td>-</td>
    </tr>
    <tr>
        <td>JENIS PAJAK</td>
        <td>:</td>
        <td>{{ $data->deposit->type->code }}</td>
    </tr>
    <tr>
        <td>JENIS SETORAN</td>
        <td>:</td>
        <td>{{ $data->deposit->code }}</td>
    </tr>
    <tr>
        <td>MASA PAJAK</td>
        <td>:</td>
        <td>{{ $data->start_period."-".$data->end_period }}</td>
    </tr>
    <tr>
        <td>TAHUN PAJAK</td>
        <td>:</td>
        <td>{{ $data->year }}</td>
    </tr>
    <tr>
        <td>NOMOR KETETAPAN</td>
        <td>:</td>
        <td>{!! ($data->assignment_number != "000000000000000") ? $data->assignment_number : "-" !!}</td>
    </tr>
    <tr>
        <td>JUMLAH SETOR</td>
        <td>:</td>
        <td>Rp.{{ number_format($data->amount, "0", ",", ".") }}</td>
    </tr>
    <tr>
        <td>TERBILANG</td>
        <td>:</td>
        <td>{{ ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($data->amount, ' Rupiah')) }}</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td valign="top">URAIAN</td>
        <td valign="top">:</td>
        <td>{!! ($data->description != "") ? $data->description : "-" !!}</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>NPWP PENYETOR</td>
        <td>:</td>
        <td>{!! ($data->wp_type==1) ? $data->user->username : $data->user->npwp !!}</td>
    </tr>
    <tr>
        <td>NAMA PENYETOR</td>
        <td>:</td>
        <td>{!! ($data->wp_type==1) ? strtoupper($data->user->name) : strtoupper($data->user->profile->corporate_name) !!}</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">GUNAKAN KODE BILLING DI BAWAH INI UNTUK MELAKUKAN PEMBAYARAN.</td>
    </tr>
    <tr>
        <td>ID BILLING</td>
        <td>:</td>
        <?php $billcode = $data->billing_id;?>
        <td>{{ substr($billcode, 0, 4)." ".substr($billcode, 4, 4)." ".substr($billcode, 8, 4)." ".substr($billcode, 12,3) }}</td>
    </tr>
    <tr>
        <td>MASA AKTIF</td>
        <td>:</td>
        <td>
            <?php 
                $now = $data->created_at;
                $time = strtotime($now);
                $final = date("d/m/Y H:i:s", strtotime("+1 month", $time));
            ?>
            {{ $final }}
        </td>
    </tr>
</table>
<table style="line-height: normal; font-size:13px; margin-top:100px;">
    <tr>
        <td valign="top" width="60px">Catatan :</td>
        <td>
            Apabila ada kesalahan dalam isian Kode Billing atau masa berlakunya berakhir, Kode Billing dapat dibuat kembali. Tanggung jawab isian Kode Billing ada pada Wajib Pajak yang namanya tercantum di dalamnya.</td>
    </tr>
</table>
</body>
</html>