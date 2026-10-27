<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('disc/assets/css/eform.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var spt_id = {{ $spt->id }};
    </script>
    <title>Lampkhus 1a</title>
</head>
<body>
    <form style="width: 150%;">
        <div class="row">
            <div class="col-md-6 offset-md-4">
                <div class="form-group row mt-4 text-center">
                    <div class="col-md-4 col-4">
                    <select name="type" class="form-control">
                        <option value="induk">Induk</option>
                        <option value="lanjutan">Induk Lanjutan</option>
                        <option value="lampiran1">Lampiran I</option>
                        <option value="lampiran2">Lampiran II</option>
                        <option value="lampiran3">Lampiran III</option>
                        <option value="lampiran4">Lampiran IV</option>
                        <option value="lampiran5">Lampiran V</option>
                        <option value="lampiran6">Lampiran VI</option>
                        <option value="lampkhus1a">Lampkhus 1A</option>
                        <option value="lampkhus2a" selected>Lampkhus 2A</option>
                    </select>
                    </div>
                    <div class="col-md-3 col-3">
                        <button class="btn btn-sm btn-secondary">Buka</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <h5>LAMPIRAN KHUSUS</h5>
                <h5>SPT TAHUNAN PAJAK PENGHASILAN WAJIB PAJAK BADAN</h5>
                <h6>TAHUN PAJAK {{ $spt->year }}</h6>
                <h6>PENGHITUNGAN KOMPENSASI KERUGIAN FISKAL </h6>
                <h6>UNTUK TAHUN PAJAK {{ $spt->year }} DAN TAHUN PAJAK BERJALAN</h6>
            </div>
            <div class="col-md-10 offset-md-1 border">
                <div class="form-group row pt-3 pb-3">
                    <label class="col-md-1 col-form-label">NPWP</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="{{ auth()->user()->npwp }}" disabled>
                    </div>
                    <label class="col-md-2 col-form-label">NAMA WAJIB PAJAK</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" value="{{ auth()->user()->profile->corporate_name }}" disabled>
                    </div>
                </div>
            </div>
            <?php
                $year = $spt->year;
                $min = $year-5;
            ?>
            <div class="col-md-10 offset-md-1 mt-4">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle" width="30px">No</th>
                            <th colspan="2" class="text-center align-middle" width="20%">Kerugian dan Penghasilan Neto Fiskal</th>
                            <th colspan="5" class="text-center align-middle">Kompensasi Kerugian Fiskal</th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle p-2">Tahun</th>
                            <th class="text-center align-middle">Rupiah</th>
                            {{-- <th class="text-center align-middle">{{ $year-4 }}</th> --}}
                            <th class="text-center align-middle">{{ $year-3 }}</th>
                            <th class="text-center align-middle">{{ $year-2 }}</th>
                            <th class="text-center align-middle">{{ $year-1 }}</th>
                            <th class="text-center align-middle">{{ $year }}</th>
                            <th class="text-center align-middle">{{ $year+1 }}</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @for ($x = 1; $x <= 6; $x++)
                        <tr>
                            @if ($x<6)
                            <td class="text-center align-middle p-2">{{ $x }}</td>
                            <td class="text-center align-middle" width="5%">{{ $min+$x }}</td>
                            <td class="align-middle text-center">
                                {{ $lampkhus2a->{'nilai'.$x} }}
                            </td>
                            @else
                            <td colspan="3" class="text-center align-middle p-2"><b>JUMLAH</b></td>
                            @endif
                            
                            @for($y = 2; $y <= 6; $y++)
                                <td class="align-middle text-center">
                                    @if($y>$x)
                                    {{ $lampkhus2a->{'nilai'.$x.$y} }}
                                    @else
                                    <input type="text" class="form-control text-center" name="{{ 'nilai'.$x.$y }}" id="{{ 'nilai'.$x.$y }}" value="@money($lampkhus2a->{'nilai'.$x.$y})" disabled>
                                    @endif
                                    
                                    </span>
                                </td>    
                            @endfor
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</body>
</html>