@extends('layouts.main')

@section('title', 'SPT ' . $spt->form_code)
@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <div class="alert alert-{{ $msg }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('alert-' . $msg) }}
    </div>
    @endif
@endforeach  
<div class="card card-primary card-outline">
    <div class="card-body">
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-identitas-tab" data-toggle="pill"
                    href="#custom-content-below-identitas" role="tab" aria-controls="custom-content-below-identitas"
                    aria-selected="true">IDENTITAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-bagian-a-tab" data-toggle="pill"
                    href="#custom-content-below-bagian-a" role="tab" aria-controls="custom-content-below-bagian-a"
                    aria-selected="false">BAGIAN A</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-bagian-b-tab" data-toggle="pill"
                    href="#custom-content-below-bagian-b" role="tab" aria-controls="custom-content-below-bagian-b"
                    aria-selected="false">BAGIAN B</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-bagian-c-tab" data-toggle="pill"
                    href="#custom-content-below-bagian-c" role="tab" aria-controls="custom-content-below-bagian-c"
                    aria-selected="false">BAGIAN C</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-penilaian-tab" data-toggle="pill"
                    href="#custom-content-below-penilaian" role="tab" aria-controls="custom-content-below-penilaian"
                    aria-selected="false">PENILAIAN</a>
            </li>
        </ul>
        <br>
        <div class="tab-content" id="custom-content-below-tabContent">
            <div class="tab-pane fade active show" id="custom-content-below-identitas" role="tabpanel"
                aria-labelledby="custom-content-below-identitas-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Identitas SPT dan Wajib Pajak
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-xs">
                                    <label for="npwp" class="form-control-label">NPWP</label>
                                    <h6>{{ $spt->user->username }}</h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="nama" class="form-control-label">Nama WP</label>
                                    <h6>{{ $spt->user->name }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-xs">
                                    <label for="tahunPajak" class="form-control-label">Tahun Pajak</label>
                                    <h6>{{ $spt->year }}</h6>
                                </div>
                                <div class="form-group form-group-xs">
                                    <label for="pembetulan" class="form-control-label">Pembetulan</label>
                                    <h6>{{ $spt->correction_to }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('pengajar.pelajar.detail', ['id' => $spt->user_id]) }}"
                            class="btn btn-default"><i class="fas fa-arrow-left"></i> Kembali</a>&nbsp;
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-bagian-a" role="tabpanel"
                aria-labelledby="custom-content-below-bagian-a-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            A. Pajak Penghasilan
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">1</td>
                                    <td colspan="2" style="width: 35%">Penghasilan Bruto Dalam Negeri
                                        Sehubungan Dengan Pekerjaan dan penghasilan neto dalam negeri</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->spta->gross)" class="form-control"
                                            style="text-align: right">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">2</td>
                                    <td colspan="2" style="width: 35%">Pengurangan</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->spta->reduction)" class="form-control"
                                            style="text-align: right">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">3</td>
                                    <td style="width: 35%">Penghasilan Tidak Kena Pajak</td>
                                    <td style="width: 30%">
                                        <select class="form-control" disabled="disabled">
                                            <option value="0">Pilih...</option>
                                            <option value="00" {!! $spt->spta->ptkp_type == '00' ? 'selected' : '' !!}>TK/0 Tidak Kawin
                                                Tidak Ada Tanggungan</option>
                                            <option value="01" {!! $spt->spta->ptkp_type == '01' ? 'selected' : '' !!}>TK/1 Tidak Kawin
                                                Tanggungan 1 Orang</option>
                                            <option value="02" {!! $spt->spta->ptkp_type == '02' ? 'selected' : '' !!}>TK/2 Tidak Kawin
                                                Tanggungan 2 Orang</option>
                                            <option value="03" {!! $spt->spta->ptkp_type == '03' ? 'selected' : '' !!}>TK/3 Tidak Kawin
                                                Tanggungan 3 Orang</option>
                                            <option value="10" {!! $spt->spta->ptkp_type == '10' ? 'selected' : '' !!}>K/0 Kawin Tidak Ada
                                                Tanggungan</option>
                                            <option value="11" {!! $spt->spta->ptkp_type == '11' ? 'selected' : '' !!}>K/1 Kawin Tanggungan
                                                1 Orang</option>
                                            <option value="12" {!! $spt->spta->ptkp_type == '12' ? 'selected' : '' !!}>K/2 Kawin Tanggungan
                                                2 Orang</option>
                                            <option value="13" {!! $spt->spta->ptkp_type == '13' ? 'selected' : '' !!}>K/3 Kawin Tanggungan
                                                3 Orang</option>
                                            <option value="20" {!! $spt->spta->ptkp_type == '20' ? 'selected' : '' !!}>K/I/0 Kawin
                                                Penghasilan Istri Digabung Tidak Ada Tanggungan</option>
                                            <option value="21" {!! $spt->spta->ptkp_type == '21' ? 'selected' : '' !!}>K/I/1 Kawin
                                                Penghasilan Istri Digabung Tanggungan 1 Orang</option>
                                            <option value="22" {!! $spt->spta->ptkp_type == '22' ? 'selected' : '' !!}>K/I/2 Kawin
                                                Penghasilan Istri Digabung Tanggungan 2 Orang</option>
                                            <option value="23" {!! $spt->spta->ptkp_type == '23' ? 'selected' : '' !!}>K/I/3 Kawin
                                                Penghasilan Istri Digabung Tanggungan 3 Orang</option>
                                        </select>
                                    </td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->spta->ptkp)" class="form-control"
                                            style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">4</td>
                                    <td colspan="2" style="width: 35%">Penghasilan Kena Pajak</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->spta->pkp)" class="form-control"
                                            style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">5</td>
                                    <td colspan="2" style="width: 35%;">Pajak Penghasilan Terutang</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->spta->pph_debt)" class="form-control"
                                            style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">6</td>
                                    <td colspan="2" style="width: 35%;">Pajak Penghasilan yang telah
                                        dipotong oleh pihak lain</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->spta->pph_deducted)" class="form-control"
                                            style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">7</td>
                                    <td colspan="2" style="width: 35%;">Nihil</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly class="form-control"
                                            style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Data Pembayaran
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-md table-striped table-hover" width="100%"
                            style="display: table; width: 100%;" role="grid">
                            <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: top;" width="20%">Jenis
                                        Pembayaran</th>
                                    <th style="text-align: center; vertical-align: top;" width="30%">
                                        NTPN/Nomor<br>Pemindahbukuan</th>
                                    <th style="text-align: center; vertical-align: top;" width="15%">
                                        Tanggal Pembayaran</th>
                                    <th style="text-align: center; vertical-align: top;" width="20%">Jumlah
                                    </th>
                                    <th style="text-align: center; vertical-align: top;" width="15%">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" style="text-align: center;">Jumlah</td>
                                    <td style="text-align: center; vertical-align: top;" width="30%"><input
                                            class="form-control" type="text" readonly id="txtJmlNtpnPbk" /></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-bagian-b" role="tabpanel"
                aria-labelledby="custom-content-below-bagian-b-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            B. Penghasilan yang dikenakan PPh Final dan yang dikecualikan dari Objek Pajak
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">8</td>
                                    <td style="width: 65%">Dasar Pengenaan Pajak/Penghasilan Bruto Pajak Penghasilan
                                        Final</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->sptb->final_gross_tax)"
                                            class="form-control uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">9</td>
                                    <td style="width: 65%">Pajak Penghasilan Final Terutang</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->sptb->pph_final)"
                                            class="form-control uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">10</td>
                                    <td style="width: 65%">Penghasilan yang Dikecualikan dari Objek Pajak</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->sptb->excluded_income)"
                                            class="form-control uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-bagian-c" role="tabpanel"
                aria-labelledby="custom-content-below-bagian-c-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            C. Daftar Harta dan Kewajiban
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">11</td>
                                    <td style="width: 65%">Jumlah Keseluruhan Harta yang Dimiliki pada Akhir Tahun
                                        Pajak</td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->sptc->assets)"
                                            class="form-control uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 5%; text-align: center">12</td>
                                    <td style="width: 65%">Jumlah Keseluruhan Kewajiban/Utang pada Akhir Tahun Pajak
                                    </td>
                                    <td style="width: 30%">
                                        <input type="text" readonly value="@money($spt->sptc->debt)"
                                            class="form-control uang" style="text-align: right">
                                        <span class="help-block"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-penilaian" role="tabpanel"
                aria-labelledby="custom-content-below-penilaian-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Penilaian
                        </h4>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST"
                        action="{{ route('pengajar.pelajar.nilai', ['spt_id' => $spt->id]) }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Penilaian</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jenis" required>
                                        <option>Pilih Jenis Penilaian</option>
                                        <option value="Project" {!! ($spt->jenis_nilai=='Project') ? 'selected' : '' !!}>Project</option>
                                        <option value="Case Study" {!! ($spt->jenis_nilai=='Case Study') ? 'selected' : '' !!}>Case Study</option>
                                        <option value="Tugas" {!! $spt->jenis_nilai == 'Tugas' ? 'selected' : '' !!}>Tugas</option>
                                        <option value="Kuis" {!! $spt->jenis_nilai == 'Kuis' ? 'selected' : '' !!}>Kuis</option>
                                        <option value="UTS" {!! $spt->jenis_nilai == 'UTS' ? 'selected' : '' !!}>UTS</option>
                                        <option value="UAS" {!! $spt->jenis_nilai == 'UAS' ? 'selected' : '' !!}>UAS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Nilai</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nilai" value="{{ $spt->nilai }}" placeholder="Nilai"
                                        required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('pengajar.pelajar.detail', ['id' => $spt->user_id]) }}"
                                class="btn btn-default float-right mr-2"><i class="fas fa-arrow-left"></i> Kembali</a>&nbsp;
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection