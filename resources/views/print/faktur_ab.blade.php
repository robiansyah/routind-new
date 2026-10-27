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
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<div class="page2" style="font-size: 11px;">
    <table width="100%" height="100%" style="border: none;">
        <tr>
            <td width="1.5%" style="background-color: gray; border: 0px solid gray; border-right: 2px solid black;">
                <b style="font-size: 6px; text-align: center; writing-mode: tb-rl; transform: rotate(-180deg); padding-right: 4px; padding-left: 2px;">
                    &nbsp;
                </b>
            </td>
            <td style="border: 0px; width: 98.5%; padding: 0px;">
                <table width="100%" style="border: none; height: 4.14%;">
                    <tr>
                        <td style="width: 70% ;border-left: none; border: 2px solid black; border-right: 2px solid black; text-align: center;border-left: none; font-size: 15px;">
                            <b>REKAPITULASI PENYERAHAN DAN PEROLEHAN</b>
                        </td>
                        <td style="border: 2px solid black;border-left: none; border-right: none; text-align: center; font-size: 7px;">
                            <b style="font-size: 10px;">FORMULIR 1111 AB</b>
                            <br>(Bila tidak ada transaksi tidak perlu dilampirkan)
                        </td>
                        <td style="border: 2px solid black;border-left: none;">
                            <table style="border:none;">
                                <tr>
                                    <td style="width: 10px; height: 10px; border: 1px solid black; background-color: black;">
                                    </td>
                                    <td style="width: 10px; height: 10px; border: 1px solid black;">
                                    </td>
                                    <td style="width: 10px; height: 10px; border: 1px solid black;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 6.7%;">
                    <tr>
                        <td style="border: 2px solid black; text-align: center; border-top: none; border-left: none; padding-left: 10px; font-size: 8px;">
                            <table style="width: 100%; border: none;">
                                <tr>
                                    <td style="width: 65px; border-bottom: 1px solid black; text-align: left;">
                                        Nama PKP
                                    </td>
                                    <td style="width: 210px; border-bottom: 1px solid black; text-align: left;">
                                        : {{ $induk->spt->user->profile->corporate_name }}
                                    </td>
                                    <td style="width: 145px; text-align: center;">
                                    </td>
                                    <td style="width: 72px; border-bottom: 1px solid black; text-align: left;">
                                        MASA
                                    </td>
                                    <td style="width: 30px; border-bottom: 1px solid black; text-align: left;">
                                        : {{ $induk->spt->start_period }}
                                    </td>
                                    <td style="width: 15px; text-align: center;">s.d
                                    </td>
                                    <td style="width: 30px; border-bottom: 1px solid black; text-align: left;">
                                        {{ $induk->spt->start_period }}
                                    </td>
                                    <td style="width: 5px; text-align: center; font-size: 12px;">-
                                    </td>
                                    <td style="width: 70px; border-bottom: 1px solid black; text-align: left;">
                                        {{ $induk->spt->year }}
                                    </td>
                                    <td style="width: 60px; text-align: center;">(mm-mm-yyyy)
                                    </td>
                                    <td >
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%; border: none; padding-top: 8px;">
                                <tr>
                                    <td style="width: 65px; border-bottom: 1px solid black; text-align: left;">
                                        NPWP
                                    </td>
                                    <td style="width: 210px; border-bottom: 1px solid black; text-align: left;">
                                        : {{ $induk->spt->user->npwp }}
                                    </td>
                                    <td style="width: 145px; text-align: center;">
                                    </td>
                                    <td style="width: 72px; border-bottom: 1px solid black; text-align: left; padding-top: 8px;">
                                        Pembetulan ke
                                    </td>
                                    <td style="width: 40px; border-bottom: 1px solid black; text-align: left; padding-top: 8px;">
                                        : ({{ $induk->spt->correction_to }})
                                    </td>
                                    <td style="width: 5px; text-align: center; padding-top: 8px; font-size: 10px;">

                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 460px; border: 2px solid black; border-top: none; text-align: center; border-left: none;">
                            <b>URAIAN</b>
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: center;">
                            <b>DPP (rupiah)</b>
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: center;">
                            <b>PPN (rupiah)</b>
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: center;">
                            <b>PPnBM (rupiah)</b>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="border: 2px solid black; text-align: center; border-top: none; text-align: left;border-left: none;">
                            <b style="font-size: 11.5px;">I. Rekapitulasi Penyerahan</b>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 10.5px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-top: none; border-bottom: none; border-left: none; text-align: center;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>A.</b>
                        </td>
                        <td style="width: 431.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <b>Ekspor BKP Berwujud/BKP Tidak Berwujud/JKP</b>
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            <a>@money($induk->dpp_a1)</a>
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: center; background-color: gray;">
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;  font-size: 10.5px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: none; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>B.</b>
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: left;">
                            <b>Penyerahan Dalam Negeri</b>
                        </td>

                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;  font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: none; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>1.</a>
                        </td>
                        <td style="width: 415.5px; border: 2px solid black; border-top: none; text-align: left;">
                            Penyerahan Dalam Negeri dengan Faktur Pajak yang Tidak Digunggung
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->dpp_a2)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppn_a2)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppnbm_a2)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: none; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>2.</a>
                        </td>
                        <td style="width: 415.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <a>Penyerahan Dalam Negeri dengan Faktur Pajak yang Digunggung</a>
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->dpp_a2_covered)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppn_a2_covered)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppnbm_a2_covered)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: none; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>C.</b>
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: left;">
                            <b>Rincian Penyerahan Dalam Negeri</b>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: none; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>1.</a>
                        </td>
                        <td style="width: 415.5px; border: 2px solid black; border-top: none; text-align: left; font-size: 7px;">
                            <a style="font-size: 8.5px;"> Penyerahan yang PPN atau PPnBM-nya harus dipungut sendiri</a>
                            <br>(Jumlah I.B.1 dengan Faktur Pajak Kode 01,04,06 dan 09 ditambah I.B2)
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->dpp_a21+$induk->dpp_a2_covered)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppn_a21+$induk->ppn_a2_covered)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppnbm_a21+$induk->ppnbm_a2_covered)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: none; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>2.</a>
                        </td>
                        <td style="width: 415.5px; border: 2px solid black; border-top: none; text-align: left; font-size: 7px;">
                            <a style="font-size: 8.5px;">Penyerahan yang PPN atau PPnBM-nya dipungut oleh Pemungut PPN</a>
                            <br>(Jumlah I.B.1 dengan Faktur Pajak Kode 02 dan 03)
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->dpp_a22)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppn_a22)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppnbm_a22)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: none; border-top: none; text-align: center; border-left: none; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>3.</a>
                        </td>
                        <td style="width: 415.5px; border: 2px solid black; border-top: none; text-align: left; font-size: 7px;">
                            <a style="font-size: 8.5px;">Penyerhan yang PPN atau PPnBM-nya tidak dipungut</a>
                            <br>(Jumlah I.B.1 dengan Faktur Pajak Kode 07)
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->dpp_a23)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppn_a23)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppnbm_a23)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>4.</a>
                        </td>
                        <td style="width: 415.5px; border: 2px solid black; border-top: none; text-align: left; font-size: 7px;">
                            <a style="font-size: 8.5px;">Penyerahan yang dibebaskan dari pengenaan PPN atau PPnBM</a>
                            <br>(Jumlah I.B.1 dengan Faktur Pajak Kode 08)
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->dpp_a24)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppn_a24)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right;">
                            @money($induk->ppnbm_a24)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="border: 2px solid black; text-align: center; border-top: none; text-align: left; border-left: none;">
                            <b>II. Rekapitulasi Penyerahan</b>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: none; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>A.</b>
                        </td>
                        <td style="width: 431.5px; border: 2px solid black; border-top: none; text-align: left; font-size: 8px;">
                            <a>Impor BKP, Pemanfaatan BKP Tidak Berwujud dari Luar Daerah Pabean, dan Pemanfaatan JKP</a>
                            <br>dari Luar Daerah Pabean Yang PM-nya Dapat Dikreditkan
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->dpp_b1)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppn_b1)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppnbm_b1)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: 0px; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>B.</b>
                        </td>
                        <td style="width: 431.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <a style="font-size: 9px;">Perolehan BKP/JKP dari Dalam Negeri Yang PM-nya Dapat Dikreditkan</a>
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->dpp_b2)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppn_b2)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppnbm_b2)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: 0px; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>C.</b>
                        </td>
                        <td style="width: 431.5px; border: 2px solid black; border-top: none; text-align: left; font-size: 8px;">
                            <a>Impor atau Peroleh Yang PM0nya Tidak Dikreditkan dan/atau Impor atau Perolehan Yang</a>
                            <br>Mendapat Fasilitas
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->dpp_b3)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppn_b3)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppnbm_b3)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>D.</b>
                        </td>
                        <td style="width: 431.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <b style="font-size: 10px;">Jumlah Perolehan (II.A + II.B + II.C)</b>
                        </td>
                        <td style="width: 150px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->dpp_b1+$induk->dpp_b2+$induk->dpp_b3)
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppn_b1+$induk->ppn_b2+$induk->ppn_b3)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppnbm_b1+$induk->ppnbm_b2+$induk->ppnbm_b3)
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="border: 2px solid black; border-top: none; text-align: left; border-left: none;">
                            <b>III. Rekapitulasi Penyerahan</b>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: 0px; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>A.</b>
                        </td>
                        <td style="width: 585.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <a>Pajak Masukan Atas Perolehan yang Dapat Dikreditkan (II.A + II.B)</a>
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppn_b1+$induk->ppn_b2)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: center; background-color: gray;">
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: 0px; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>B.</b>
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: left;">
                            <a>Pajak Masukan Lainnya</a>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: 0px; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>1.</a>
                        </td>
                        <td style="width: 569.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <a>Kompensasi kelebihan PPN Masa Pajak sebelumnya</a>
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            0
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: center; background-color: gray;">
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: 0px; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>2.</a>
                        </td>
                        <td style="width: 569.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <a>Kompensasi kelebihan PPN karena pembetulan SPT PPN Masa Pajak _____.___________ (mm-yyyy)</a>
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: center; background-color: gray;">
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: 0px; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <a>3.</a>
                        </td>
                        <td style="width: 569.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <a>Hasil Penghitungan Kembali Pajak Masukan yang telah dikreditkan sebagai penambah (pengurang) Pajak Masukan</a>
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppn_correction)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: center; background-color: gray;">
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%; font-size: 9px;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-bottom: 0px; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                        </td>
                        <td style="width: 12px; border: 2px solid black; border-top: none; text-align: center;">
                            <b>4.</b>
                        </td>
                        <td style="width: 569.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <b>Jumlah (III.B.1 + III.B.3)</b>
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppn_correction)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: center; background-color: gray;">
                        </td>
                    </tr>
                </table>
                <table width="100%" style="border: none; height: 3.715%;">
                    <tr>
                        <td style="width: 8px ;border: 2px solid black; border-top: none; text-align: center; border-left: none;">
                        </td>
                        <td style="width: 12px ;border: 2px solid black; border-top: none; text-align: center;">
                            <b>C.</b>
                        </td>
                        <td style="width: 585.5px; border: 2px solid black; border-top: none; text-align: left;">
                            <b style="font-size: 10px;">Jumlah Pajak Masukan yang Dapat Diperhitungkan (III.A + III.B.4)</b>
                        </td>
                        <td style="width: 130px; border: 2px solid black; border-top: none; text-align: right; font-size: 8.5px;">
                            @money($induk->ppn_b1+$induk->ppn_b2+$induk->ppn_correction)
                        </td>
                        <td style="border: 2px solid black; border-top: none; text-align: center; background-color: gray;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>