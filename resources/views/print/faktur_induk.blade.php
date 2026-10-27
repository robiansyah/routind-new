<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pemberitahuan!!</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
        }
        .page1 {
            width: 596px;
            height: max-content;
            background-color: white;
            margin: 0 auto;
            padding: 12px;
        }

        .page2 {
            width: 907px;
            height: 595px;
            background-color: white;
            margin: 0 auto;
            padding: 12px;
        }
        
        img {
            align-items: center;
            padding-left: 30px;
        }
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div class="page1">
        <table width="100%" style="text-align: center; border: none; background-color: gray;">
            <tr>
                <td style="border: none;">
                    <b style="font-size: 6px;">
                        &nbsp;
                    </b>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td>
                    <img src="{{ public_path('disc/assets/media/logos/logo-cetak.png') }}" alt="Logo" width="30px" style="text-align: center;">
                </td>
                <td style="text-align: center;">
                    <div><b style="font-size: 13.5px;">
                        Surat Pemberitahuan Masa Pajak Pertambahan Nilai
                    </b>
                    <br><b>(SPT MASA PPN)</b></div>
                        <a  style="font-size: 7px; vertical-align: bottom;">Bacalah terlebih dahulu Buku Petunjuk Pengisian SPT Masa PPN. dan beri tanda X dalam &#11036; yang sesuai</a>
                </td>
                <td>
                    <table style="border: 1px solid white;">
                        <tr style="border: 1px solid white;">
                            <td style="border: 1px solid white; padding-left: 10px; padding-bottom: 5.1px;">
                                <b style="font-size: 9px;">FORMULIR</b>
                            </td>
                            <td style="border: 1px solid white;  text-align: center;">
                                <b style="font-size: 20px;">1111</b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%" style="border:none; height: 18px;">
            <tr style="border-top: none; font-size: 8px;">
                <td style="border-top: none;border-right: none; width: 45px; border-bottom: 1px solid black;">
                    <a >Nama PKP</a>
                </td>
                <td style="border:none; width: 270px; border-bottom: 1px solid black;">
                    : {{ $induk->spt->user->profile->corporate_name }}
                </td>
                <td style="border:none; width: 1px; border-bottom: 0px solid black;"></td>
                <td style=" width: 150px;border-top: none; border-left: none; border-right: none; border-bottom: 1px solid black;">
                    <a>NPWP : {{ $induk->spt->user->npwp }}</a>
                </td>
            </tr>
        </table>
        <table width="100%" style="border:none; height: 18px;">
            <tr style="border-top: none; font-size: 8px;">
                <td style="border-top: none;border-right: none; width: 45px; border-bottom: 1px solid black;">
                    <a >Alamat</a>
                </td>
                <td style="border:none; width: 270px; border-bottom: 1px solid black;">
                    : {{ $induk->spt->user->profile->address }}
                </td>
                <td style="border:none; width: 1px; border-bottom: 0px solid black;">
                </td>
                <td style=" width: 40px;border-top: none; border-left: none; border-right: none; border-bottom: 1px solid black;">
                    <a>MASA : {{ $induk->spt->start_period }}</a>
                </td>
                <td style="border:none; width: 5px; border-bottom: 0px solid black; text-align: center; font-size: 7px;">s.d
                </td>
                <td style="border-top: none; border-left: none; border-bottom: 1px solid black; border-right: none; width: 20px;">
                    {{ $induk->spt->start_period }}
                </td>
                <td style="border:none; width: 5px; border-bottom: 0px solid black; text-align: center;">&#8211;
                </td>
                <td style="border-top: none; border-left: none; border-bottom: 1px solid black; border-right: none; width: 30px;">
                    {{ $induk->spt->year }}
                </td>
                <td style="border:none; width: 50px; border-bottom: 0px solid black; text-align: center; font-size: 7px; vertical-align: bottom;">(mm-mm-yyyy)
                </td>
                <td style=" width: 57px;border-top: none; border-left: none; border-right: none; border-bottom: 1px solid black; font-size: 7px;">
                    <a>Thn Buku : {{ $induk->spt->year }}</a>
                </td>
                <td style="border:none; width: 5px; border-bottom: 0px solid black; text-align: center; font-size: 7px;">s.d
                </td>
                <td style="border:none; border-bottom: 1px solid black; border-right: 2px solid black;">
                    {{ $induk->spt->year }}
                </td>
            </tr>
        </table>
        <table width="100%" style="border-top: none; border-bottom: none;">
            <tr style="border: none; font-size: 8px;">
                <td style="border:none; width: 45px; height: 18px;">
                    <a >Telepon</a>
                </td>
                <td style="border:none; width: 82px;">
                    :
                </td>
                <td style="border:none; width: 2px; text-align: center;">
                </td>
                <td style="border:none; width: 110px; border-bottom: 1px solid black;">
                    <a >Hp : {{ $induk->spt->user->mobile_phone }}</a>
                </td>
                <td style="border:none; width: 2px; border-bottom: 0px solid black; text-align: center;">
                </td>
                <td style="border:none; width: 65px; border-bottom: 1px solid black;">
                    KLU :
                </td>
                <td style="border:none; width: 2px; border-bottom: 0px solid black; text-align: center;">
                </td>
                <td style="border:none; width: 80px; border-bottom: 1px solid black;">
                    <a>Pembetulan ke :</a>
                </td>
                <td style="border:none; width: 2px; border-bottom: 0px solid black; text-align: center;">
                    ({{ $induk->spt->correction_to }})
                </td>
                <td style="border:none;padding-top: 7px;">
                    <table style="border: none;">
                        <tr>
                            <td style="width: 10px; height: 10px; border:1.5px solid black;">
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border-top: none; border-left: none; border-bottom: 1px solid black;border-bottom: none; padding-top: 5px;">
                    <b style="font-size: 10px;">Wajib PPnBM</b>
                </td>

            </tr>
            <tr>
                <td style="border: none;">

                </td>
            </tr>
        </table>
        <table width="100%" style="border-top: none; height: max-content;">
            <tr style="border-top: none; font-size: 8px;">
                <td style="border-left: none; width: 95%; padding: 0; line-height: 1.5em;">
                    <table style="border: 0px solid white; padding-bottom: 0.1em; ">
                        <tr style="padding-bottom: 0.1em;">
                            <td style="border:0px solid white; padding-bottom: 0.1em;">
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white;width: 7px; padding-left: 4px;">
                                            <span><b>I.</b></span>
                                        </td>
                                        <td style="border: 0px solid black;">
                                            <span><b>PENYERAHAN BARANG DAN JASA</b></span>
                                        </td>

                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white; padding-left: 14px;">
                                            A.
                                        </td>
                                        <td style="border: none; width: 231px;">
                                            Terutang PPN
                                        </td>
                                        <td style="border: 0px solid black; width: 140px; text-align: center; vertical-align: top;">
                                            <b>DPP</b>
                                        </td>
                                        <td style="border: 0px solid black; width: 140px; text-align: center; vertical-align: top;">
                                            <b>PPN</b>
                                        </td>
                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white;padding-left: 25px;">
                                            1.
                                        </td>
                                        <td style="border: none; width: 205px;">
                                            Ekspor
                                        </td>
                                        <td style="border: none; width: 13px;">
                                            A.1
                                        </td>
                                        <td style="border: none;">
                                            Rp._____________________________<span style="position: absolute; top: 190px; right: 255px;">@money($induk->dpp_a1)</span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white; padding-left: 25px;">
                                            2.
                                        </td>
                                        <td style="border: none; width: 205px;">
                                            Penyerahan yang PPN-nya harus dipungut sendiri
                                        </td>
                                        <td style="border: none; width: 13px; text-align: center;">
                                            1.
                                        </td>
                                        <td style="border: none;">
                                            Rp._____________________________<span style="position: absolute; top: 205px; right: 255px;">@money($induk->dpp_a21+$induk->dpp_a2_covered)</span>
                                        </td>
                                        <td style="border: none; padding-left: 5px;">
                                            Rp._____________________________<span style="position: absolute; top: 205px; right: 105px;">@money($induk->ppn_a21+$induk->ppn_a2_covered)</span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white; padding-left: 25px;">
                                            3.
                                        </td>
                                        <td style="border: none; width: 205px;">
                                            Penyerahan yang PPN-nya dipunut oleh Pemungut PPN
                                        </td>
                                        <td style="border: none; width: 13px; text-align: center;">
                                            2.
                                        </td>
                                        <td style="border: none;">
                                            Rp._____________________________<span style="position: absolute; top: 220px; right: 255px;">@money($induk->dpp_a22)</span>
                                        </td>
                                        <td style="border: none; padding-left: 5px;">
                                            Rp._____________________________<span style="position: absolute; top: 220px; right: 105px;">@money($induk->ppn_a22)</span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white; padding-left: 25px;">
                                            4.
                                        </td>
                                        <td style="border: none; width: 205px;">
                                            Penyerahan yang PPN-nya tidak dipungut
                                        </td>
                                        <td style="border: none; width: 13px; text-align: center;">
                                            3.
                                        </td>
                                        <td style="border: none;">
                                            Rp._____________________________<span style="position: absolute; top: 235px; right: 255px;">@money($induk->dpp_a23)</span>
                                        </td>
                                        <td style="border: none; padding-left: 5px;">
                                            Rp._____________________________<span style="position: absolute; top: 235px; right: 105px;">@money($induk->ppn_a23)</span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white; padding-left: 25px;">
                                            5.
                                        </td>
                                        <td style="border: none; width: 205px;">
                                            Penyerahan yang dibebaskan dari pengenaan PPN
                                        </td>
                                        <td style="border: none; width: 13px; text-align: center;">
                                            4.
                                        </td>
                                        <td style="border: none;">
                                            Rp._____________________________<span style="position: absolute; top: 248px; right: 255px;">@money($induk->dpp_a24)</span>
                                        </td>
                                        <td style="border: none; padding-left: 5px;">
                                            Rp._____________________________<span style="position: absolute; top: 248px; right: 105px;">@money($induk->ppn_a24)</span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white; padding-left: 25px; width: 228.5px;">
                                            Jumlah (I.A.1 + I.A.2 + I.A.3 + I.A.4 + I.A.5)
                                        </td>
                                        <td style="border: none;">
                                            Rp._____________________________<span style="position: absolute; top: 263px; right: 255px;">@money($induk->dpp_a21+$induk->dpp_a22+$induk->dpp_a23+$induk->dpp_a24+$induk->dpp_a2_covered)</span>
                                        </td>
                                        <td style="border: none; padding-left: 5px;">
                                            Rp._____________________________<span style="position: absolute; top: 263px; right: 105px;">@money($induk->ppn_a21+$induk->ppn_a22+$induk->ppn_a23+$induk->ppn_a24+$induk->ppn_a2_covered)</span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: 0px solid white; padding-left: 14px;">
                                            B.
                                        </td>
                                        <td style="border: none; width: 230px;">
                                            Tidak Terutang PPN
                                        </td>
                                        <td style="border: none;">
                                            Rp._____________________________<span style="position: absolute; top: 277px; right: 255px;">@money($induk->dpp_not)</span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="border: 0px solid white;">
                                    <tr>
                                        <td style="border: none; padding-left: 14px; padding-bottom: none;">
                                            C.
                                        </td>
                                        <td style="border: none; width: 229.5px;">
                                            Jumlah Seluruh Penyerahan (I.A + I.B)
                                        </td>
                                        <td style="border: none;">
                                            Rp._____________________________<span style="position: absolute; top: 290px; right: 255px;">@money($induk->dpp_a21+$induk->dpp_a22+$induk->dpp_a23+$induk->dpp_a24+$induk->dpp_a2_covered+$induk->dpp_not)</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" style="border-left: none; border-right: none; border-bottom: none;">
                        <tr>
                            <td style="border-left: none; border-right: none; border-bottom: none;"></td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white;width: 7px; padding-left: 4px;">
                                <span><b>II.</b></span>
                            </td>
                            <td style="border: 0px solid white;">
                                <span><b>PERHITUNGAN PPN KURANG BAYAR/LEBIH BAYAR</b></span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 13px; width: 10px;">
                                A.
                            </td>
                            <td style="border: none; width: 365px;">
                                Pajak Keluaran yang harus dipungut sendiri (Jumlah PPN pada I.A.2)
                            </td>
                            <td style="border: 1px solid black; width: 8px; text-align: center;">
                                1.
                            </td>
                            <td style="border: none; padding-left: 1.8px;">
                                Rp._____________________________<span style="position: absolute; top: 325px; right: 105px;">@money($induk->ppn_a21+$induk->ppn_a2_covered)</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 13px; width: 10px;">
                                B.
                            </td>
                            <td style="border: none; width: 378px;">
                                PPN disetor dimuka dalam Masa Pajak yang sama
                            </td>
                            <td style="border: none;">
                                Rp._____________________________<span style="position: absolute; top: 340px; right: 105px;">0</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: none;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 13px; width: 10px;">
                                C.
                            </td>
                            <td style="border: none; width: 365px;">
                                Pajak Masukan yang dapat diperhitungkan
                            </td>
                            <td style="border: 1px solid black; width: 8px; text-align: center;">
                                2.
                            </td>
                            <td style="border: none; padding-left: 1.8px;">
                                Rp._____________________________<span style="position: absolute; top: 355px; right: 105px;">@money($induk->ppn_b1+$induk->ppn_b2)</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 13px; width: 10px;">
                                D.
                            </td>
                            <td style="border: none; width: 378px;">
                                PPN kurang atau (lebih) bayar (II.A-II.B-II.C)
                            </td>
                            <td style="border: none;">
                                Rp._____________________________<span style="position: absolute; top: 370px; right: 105px;">@money(($induk->ppn_a21+$induk->ppn_a2_covered)-($induk->ppn_b1+$induk->ppn_b2))</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 13px; width: 10px;">
                                E.
                            </td>
                            <td style="border: none; width: 378px;">
                                PPN kurang atau (lebih) bayar pada SPT yang dibetulkan
                            </td>
                            <td style="border: none;">
                                Rp._____________________________<span style="position: absolute; top: 385px; right: 105px;">0</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 13px; width: 10px;">
                                F.
                            </td>
                            <td style="border: none; width: 379px;">
                                PPN kurang atau (lebih) bayar karena pembetulan (II.D-II.E)
                            </td>
                            <td style="border: none;">
                                Rp._____________________________<span style="position: absolute; top: 400px; right: 105px;">0</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 13px; width: 10px;">
                                G.
                            </td>
                            <td style="border: none;width: 229px;">
                                PPN kurang bayar dilunasi tanggal __
                            </td>
                            <td style="border: none;width: 90px;">
                                {!! ($induk->date_ppn!='') ? '('.$induk->date_ppn.')' : '(yyyy-mm-dd)' !!}
                            </td>
                            <td style="border: none;">
                                NTPN : ______________________________________<span style="position: absolute; top: 415px; right: 185px;">{{ $induk->ntpn_ppn }}</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 13px; width: 10px;">
                                H.
                            </td>
                            <td style="border: none;">
                                PPN Lebih bayar pada :
                            </td>
                        </tr>
                    </table>
                    <?php $lebih_bayar = ($induk->lebih_bayar!='') ? json_decode($induk->lebih_bayar) : array();?>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 25px; width: 12px;">
                                1.1
                            </td>

                            <td style="border:none;padding-top: 7px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('2d_bukan', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; width: 193px; padding-left: 2px;">
                                Butir II.D (Diisi dalam hal SPT bukan pembetulan)
                            </td>
                            <td style="border: none; width: 12px;">
                                1.2
                            </td>
                            <td style="border:none;padding-top: 7px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('2d_pembetulan', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-left: 3px; width: 41px;">
                                Butir II.D
                            </td>
                            <td style="border: none; width: 45px;">
                                atau
                            </td>
                            <td style="border:none;padding-top: 7px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('2f_pembetulan', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-left: 3px;">
                                Butir II.F  (Diisi dalam SPT Pembetulan)
                            </td>
                        </tr>
                    </table>
                    <table style="border: none;">
                        <tr>
                            <td style="border: none; padding-left: 38px; width: 57px; padding-top: 8px;">
                                Oleh
                            </td>
                            <td style="border: none; padding-top: 8px;">
                                :
                            </td>
                            <td style="padding-top: 8px;border: none; width: 13px;">
                                2.1
                            </td>
                            <td style="border:none;padding-top: 7px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('pkp', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 8px;width: 192px;">
                                PKP Pasal 9 ayat (4b) PPN
                            </td>
                            <td style="border: none; padding-top: 8px; width: 26.5px;">
                                atau
                            </td>
                            <td style="border: none; padding-top: 8px; width: 16.2px;">
                                2.2
                            </td>
                            <td style="border:none;padding-top: 7px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('selain_pkp', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top:10px;">
                                Selain PKP Pasal 9 ayat (4b) PPN
                            </td>
                        </tr>
                    </table>
                    <table style="border: none;">
                        <tr>
                            <td style="border: none; padding-left: 38px; width: 57px; padding-top: 2px;">
                                diminta untuk
                            </td>
                            <td style="border: none; padding-top: 2px;">
                                :
                            </td>
                            <td style="border: none; padding-top: 2px; width: 13px;">
                                3.1
                            </td>
                            <td style="border:none; padding-top: 0px; padding-left: 1px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('berikutnya', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 2px; width: 192px;">
                                Dikompensasikan ke Masa Pajak berikutnya
                            </td>
                            <td style="border: none; padding-top: 2px; width: 41px;">
                                atau
                            </td>
                            <td style="border: none; padding-top: 1px; padding-left: 5px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('masa', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 2px;">
                                Dikompensasikan ke Masa Pajak
                            </td>
                            <td style="border: none;">
                                {{ $induk->kompensasi }}
                            </td>
                        </tr>
                    </table>
                    <table style="border: none;">
                        <tr>
                            <td style="border: none; padding-left: 101px; padding-top: 2px; width: 12.1px;">
                                3.2
                            </td>
                            <td style="border: none; padding-top: 1px; padding-left: 2px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('dikembalikan', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 2px;">
                                Dikembalikan (Restitusi)
                            </td>
                        </tr>
                    </table>
                    <table style="border: none;">
                        <tr>
                            <td style="border: none; padding-left: 115px; padding-top: 2px;">
                                Khusus Restitusi untuk PKP :
                            </td>
                        </tr>
                    </table>
                    <table style="border: none;">
                        <tr>
                            <td style="border: none; padding-top: 1px; padding-left: 134px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('17c', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 3px;">
                                Pasal 17C KUP
                            </td>
                            <td style="border: none; padding-top: 3px;">
                                dilakukan dengan :
                            </td>
                            <td style="border: none; padding-top: 1px; padding-left: 11px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('17c_biasa', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 3px;">
                                Prosedur Biasa
                            </td>
                            <td style="border: none; padding-top: 3px;padding-left: 13px;">
                                atau
                            </td>
                            <td style="border: none; padding-top: 1px; padding-left: 13px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('17c_pendahuluan', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 2px;">
                                Pengembalian Pendahuluan
                            </td>
                        </tr>
                    </table>
                    <table style="border: none;">
                        <tr>
                            <td style="border: none; padding-left: 115px; padding-top: 2px; width: 17px;">
                                atau
                            </td>
                            <td style="border: none; padding-top: 1px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('17d', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 2px;">
                                Pasal 17D KUP
                            </td>
                            <td style="border: none; padding-top: 2px;">
                                dilakukan dengan :
                            </td>
                            <td style="border: none; padding-top: 1px;padding-left: 11px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('17d_biasa', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 2px;">
                                Prosedur Biasa
                            </td>
                            <td style="border: none; padding-top: 2px;padding-left: 13px;">
                                atau
                            </td>
                            <td style="border: none; padding-top: 1px;padding-left: 13px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('17d_pendahuluan', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 2px;">
                                Pengembalian Pendahuluan
                            </td>
                        </tr>
                    </table>
                    <table style="border: none;">
                        <tr>
                            <td style="border: none; padding-left: 115px; padding-top: 5px; width: 17px;">
                                atau
                            </td>
                            <td style="border: none; padding-top: 4px;">
                                <table style="border: none;">
                                    <tr>
                                        <td style="width: 10px; height: 10px; border:1.5px solid black;">
                                            {!! (in_array('9_pendahuluan', $lebih_bayar) ? '&nbsp;X' : '') !!}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: none; padding-top: 5px;">
                                Pasal 9 ayat (4c) PPN dilakukan dengan Pengembalian Pendahuluan
                            </td>
                        </tr>
                    </table>
                    <table width="100%" style="border-left: none; border-right: none; border-bottom: none;">
                        <tr>
                            <td style="border-left: none; border-right: none; border-bottom: none;"></td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white;width: 7px; padding-left: 4px;">
                                <span><b>III.</b></span>
                            </td>
                            <td style="border: 0px solid white;">
                                <span><b>PPN TERUTANG ATAS KEGIATAN MEMBANGUN SENDIRI</b></span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                A.
                            </td>
                            <td style="border: none; ">
                                Jumlah Dasar Pengenaan Pajak
                            </td>
                            <td style="padding-left: 5px; border: none;">
                                :
                            </td>
                            <td style="padding-left: 6px; border: none;">
                                Rp.______________________________<span style="position: absolute; top: 610px; right: 350px;">@money($induk->dpp_own)</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                B.
                            </td>
                            <td style="border: none; ">
                                PPN Terutang
                            </td>
                            <td style="padding-left: 68px; border: none;">
                                :
                            </td>
                            <td style="padding-left: 6px; border: none;">
                                Rp.______________________________<span style="position: absolute; top: 625px; right: 350px;">@money($induk->ppn_own)</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                C.
                            </td>
                            <td style="border: none; ">
                                Dilunasi Tanggal
                            </td>
                            <td style="padding-left: 61px; border: none;">
                                :
                            </td>
                            <td style="padding-left: 105px; border: none;">
                                {!! ($induk->date_own!='') ? '('.$induk->date_own.')' : '(yyyy-mm-dd)' !!}
                            </td>
                            <td style="border: none; padding-left: 15px;">
                                NTPN
                            </td>
                            <td style="padding-left: 5px; border: none;">
                                :
                            </td>
                            <td style="border: none;">
                                ______________________________________________<span style="position: absolute; top: 638px; right: 210px;">{{ $induk->ntpn_own }}</span>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" style="border-left: none; border-right: none; border-bottom: none;">
                        <tr>
                            <td style="border-left: none; border-right: none; border-bottom: none;"></td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white;width: 7px; padding-left: 4px;">
                                <span><b>IV</b></span>
                            </td>
                            <td style="border: 0px solid white;">
                                <span><b>PEMBAYARAN KEMBALI PAJAK MASUKAN BAGI PKP GAGAL BERPRODUKSI</b></span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                A.
                            </td>
                            <td style="border: none; ">
                                PPN yang wajib dibayar kembali
                            </td>
                            <td style="padding-left: 5px; border: none;">
                                :
                            </td>
                            <td style="padding-left: 6px; border: none;">
                                Rp.______________________________<span style="position: absolute; top: 670px; right: 350px;">@money($induk->ppn_fail)</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                B.
                            </td>
                            <td style="border: none; ">
                                Dilunasi Tanggal
                            </td>
                            <td style="padding-left: 61px; border: none;">
                                :
                            </td>
                            <td style="padding-left: 105px; border: none;">
                                {!! ($induk->date_fail!='') ? '('.$induk->date_fail.')' : '(yyyy-mm-dd)' !!}
                            </td>
                            <td style="border: none; padding-left: 15px;">
                                NTPN
                            </td>
                            <td style="padding-left: 5px; border: none;">
                                :
                            </td>
                            <td style="border: none;">
                                ______________________________________________<span style="position: absolute; top: 685px; right: 210px;">{{ $induk->ntpn_fail }}</span>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" style="border-left: none; border-right: none; border-bottom: none;">
                        <tr>
                            <td style="border-left: none; border-right: none; border-bottom: none;"></td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white;width: 7px; padding-left: 4px;">
                                <span><b>V.</b></span>
                            </td>
                            <td style="border: 0px solid white;">
                                <span><b>PAJAK PENJUALAN ATAS BARANG MEWAH</b></span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                A.
                            </td>
                            <td style="border: none; ">
                                PPnBM harus dipungut sendiri
                            </td>
                            <td style="border: none; padding-left: 190px;">
                                1.
                            </td>
                            <td style="border: none; padding-left: 6px;">
                                Rp. ____________________________________________<span style="position: absolute; top: 718px; right: 105px;">@money($induk->ppnbm_a21+$induk->ppnbm_a2_covered)</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                B.
                            </td>
                            <td style="border: none; width: 311px;">
                                PPnBM disetor dimuka dalam Masa Pajak yang sama
                            </td>
                            <td style="border: none;">
                                Rp. ____________________________________________<span style="position: absolute; top: 732px; right: 105px;">@money($induk->ppnbm_deposit)</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                C.
                            </td>
                            <td style="border: none;  width: 311px;">
                                PPnBM kurang atau (lebih) bayar (V.A-V.B)
                            </td>
                            <td style="border: none;">
                                Rp. ____________________________________________<span style="position: absolute; top: 746px; right: 105px;">@money($induk->ppnbm_a21+$induk->ppnbm_a2_covered-$induk->ppnbm_deposit)</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                D.
                            </td>
                            <td style="border: none; width: 311px;">
                                PPnBM kurang atau (lebih) bayar pada SPT yang dibetulkan
                            </td>
                            <td style="border: none;">
                                Rp. ____________________________________________<span style="position: absolute; top: 760px; right: 105px;">0</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                E.
                            </td>
                            <td style="border: none; width: 311px;">
                                PPnBM kurang atau (lebih) bayar karena pmbetulan (V.C-V.D)
                            </td>
                            <td style="border: none;">
                                Rp. ____________________________________________<span style="position: absolute; top: 774px; right: 105px;">0</span>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                F.
                            </td>
                            <td style="border: none; width: 220px;">
                                PPnBM kurang bayar dilunasi tanggal
                            </td>
                            <td style="border: none; width: 80px;">
                                {!! ($induk->date_ppnbm!='') ? '('.$induk->date_ppnbm.')' : '(yyyy-mm-dd)' !!}
                            </td>
                            <td style="border: none;">
                                NTPN : ____________________________________________<span style="position: absolute; top: 788px; right: 210px;">{{ $induk->ntpn_ppnbm }}</span>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" style="border-left: none; border-right: none; border-bottom: none;">
                        <tr>
                            <td style="border-left: none; border-right: none; border-bottom: none;"></td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white;">
                        <tr>
                            <td style="border: 0px solid white;width: 7px; padding-left: 4px;">
                                <span><b>VI.</b></span>
                            </td>
                            <td style="border: 0px solid white;">
                                <span><b>KELENGKAPAN SPT</b></span>
                            </td>
                        </tr>
                    </table>
                    <?php $lampiran = ($induk->lampiran!='') ? json_decode($induk->lampiran) : array();?>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                <table style="border:none;">
                                    <tr>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black; text-align:center;">
                                            {!! (in_array('ab', $lampiran) ? 'X' : '') !!}
                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 73px;">
                                            Formulir 1111 AB
                                        </td>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black; text-align:center;">
                                            {!! (in_array('a2', $lampiran) ? 'X' : '') !!}
                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 73px;">
                                            Formulir 1111 A2
                                        </td>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black; text-align:center;">
                                            {!! (in_array('b2', $lampiran) ? 'X' : '') !!}
                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 73px;">
                                            Formulir 1111 B2
                                        </td>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black;">
                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 95px;">
                                            SSP PPN_____lembar
                                        </td>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black;">

                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 95px;">
                                            Surat Kuasa khusus
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 0px solid white; ">
                        <tr>
                            <td style="border: 0px solid white; padding-left: 14px;">
                                <table style="border:none;">
                                    <tr>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black; text-align:center;">
                                            {!! (in_array('a1', $lampiran) ? 'X' : '') !!}
                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 73px;">
                                            Formulir 1111 A1
                                        </td>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black; text-align:center;">
                                            {!! (in_array('b1', $lampiran) ? 'X' : '') !!}
                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 73px;">
                                            Formulir 1111 B1
                                        </td>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black; text-align:center;">
                                            {!! (in_array('b3', $lampiran) ? 'X' : '') !!}
                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 73px;">
                                            Formulir 1111 B3
                                        </td>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black;">

                                        </td>
                                        <td style="border:none; padding-left: 4px; width: 95px;">
                                            SSP PPnBM_____lembar
                                        </td>
                                        <td style="width: 11px; height: 11px; border:1.5px solid black;">

                                        </td>
                                        <td style="border:none; padding-left: 4px;">
                                            ________________ , _____lembar
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%" style="border-top: none;">
            <tr>
                <td style="border-top: none; padding-left: 10px; padding-top: 16px;padding-bottom: 16px; width: 41%; border-right: none;">
                    <table style="border-right: 0px solid black;">
                        <tr>
                            <td style="padding-left: 5px;padding-right: 5px; width: 220px;">
                                <div style="font-size: 7px;">
                                    <p style="text-align: justify;">
                                        <b style="font-size: 8px;">PERNYATAAN :</b>
                                        <br>DENGAN MENYADARI SEPENUHNYA AKAN SEGALA AKIBATNYA
                                        SAYA MENYATAKAN BAHWA APA YANG TELAH SAYA
                                        BERITAHUKAN DI ATAS BESERTA LAMPIRAN-LAMPIRANNYA
                                        ADALAH BENAR, LENGKAP. JELAS DAN TIDAK BERSYARAT.</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border-top: 0px solid white;border-left: 0px; width: 20px; border-right: 0px; padding-left: 5px;">
                    <hr color="white" style="width: 0px; height: 0px; padding: 0px; margin: 4px;">
                    <table style="padding: 4px; border: 1.5px solid black;">
                        <tr>
                            <td style="width: 13px; height: 13px;  border: 1.5px solid black; text-align: center;">
                                X
                            </td>
                        </tr>
                    </table>
                    <hr color="white" style="width: 0px; height: 0px; padding: 0px; margin: 2px;">
                    <table style="padding: 4px; border: 1.5px solid black;">
                        <tr>
                            <td style="width: 13px; height: 13px;  border: 1.5px solid black;">
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border-top: 0px solid white;border-left: 0px; width: 30px; border-right: 0px; ">
                    <hr color="white" style="width: 0px; height: 0px; padding: 0px; margin: 4px;">
                    <table style=" border: 0px solid black; width: 40px;">
                        <tr>
                            <td style="width: 20px; height: 13px;  border: 0px solid white; font-size: 10px;">
                                PKP
                            </td>
                        </tr>
                    </table>
                    <hr color="white" style="width: 0px ;height: 0px; padding: 0px; margin: 2px; background-color: white;">
                    <table style="padding: 4px; border: 0px solid black;">
                        <tr>
                            <td style="width: 34px; height: 13px;  border: 0px solid white; font-size: 10px;">
                                Kuasa
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border-top: 0px solid white; border-left: 0px;">
                    <div>
                        <table style="font-size: 7.5px; border: 1px;">
                            <div style="padding-left: 31px;">{{ $induk->ttd_place.', '.Carbon\Carbon::parse($induk->ttd_date)->isoFormat('DD MMMM Y') }}</div>
                            <tr>
                                <td style="border: 0px;height: 6px;">

                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px; height: 18px;">
                                    Tanda tangan :
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px;">
                                    Nama Jelas : {{ $induk->ttd_name }}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px;">
                                    Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $induk->ttd_position }}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px;">
                                    Cap Perusahaan
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>