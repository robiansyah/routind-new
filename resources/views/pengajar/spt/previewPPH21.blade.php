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
                    <a class="nav-link" id="custom-content-below-induk-tab" data-toggle="pill"
                       href="#custom-content-below-induk" role="tab" aria-controls="custom-content-below-induk"
                       aria-selected="false">OBJEK PAJAK</a>
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
                                Identitas Pemotong
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-xs">
                                        <label for="npwp" class="form-control-label">NPWP</label>
                                        <h6>{{ $spt->user->npwp }}</h6>
                                    </div>
                                    <div class="form-group form-group-xs">
                                        <label for="nama" class="form-control-label">Nama WP</label>
                                        <h6>{{ $spt->user->profile->corporate_name }}</h6>
                                    </div>
                                    <div class="form-group form-group-xs">
                                        <label for="notelp" class="form-control-label">Nomor Telepon</label>
                                        <h6>0{{ $spt->user->mobile_phone }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-xs">
                                        <label for="tahunPajak" class="form-control-label">Masa Pajak</label>
                                        <h6>{{ $spt->start_period }}</h6>
                                    </div>
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
                <div class="tab-pane fade" id="custom-content-below-induk" role="tabpanel"
                     aria-labelledby="custom-content-below-induk-tab">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Object Pajak
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-gray-600">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center align-middle">No</th>
                                        <th class="text-center align-middle">Penerima Penghasilan</th>
                                        <th class="text-center align-middle">Kode Objek Pajak</th>
                                        <th class="text-center align-middle w-100px">Jumlah Penerima Penghasilan</th>
                                        <th class="text-center align-middle w-100px">Jumlah Penghasilan Bruto</th>
                                        <th class="text-center align-middle w-100px">Jumlah Pajak Dipotong</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                    <?php $no = 1; $penerima=0; $bruto=0; $pph=0;?>
                                    @foreach ($tidak as $item)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $item->object->nmObjkPjk }}</td>
                                            <td>{{ $item->kdObjPjk }}</td>
                                            <td class="text-center">{{ $item->jmlPenerima }}</td>
                                            <td class="text-end">@money($item->jmlBruto)</td>
                                            <td class="text-end">@money($item->jmlPph)</td>
                                        </tr>
                                            <?php $penerima += $item->jmlPenerima; $bruto += $item->jmlBruto; $pph += $item->jmlPph?>
                                    @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                    <!--begin::Table foot-->
                                    <tfoot>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <td colspan="3" class="text-center">Jumlah A1</td>
                                        <td class="text-center">{{ $penerima }}</td>
                                        <td class="text-end">@money($bruto)</td>
                                        <td class="text-end">@money($pph)</td>
                                    </tr>
                                    </tfoot>
                                    <!--end::Table foot-->
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Object Pajak Final
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-gray-600">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center align-middle">No</th>
                                        <th class="text-center align-middle">Penerima Penghasilan</th>
                                        <th class="text-center align-middle">Kode Objek Pajak</th>
                                        <th class="text-center align-middle w-100px">Jumlah Penerima Penghasilan</th>
                                        <th class="text-center align-middle w-100px">Jumlah Penghasilan Bruto</th>
                                        <th class="text-center align-middle w-100px">Jumlah Pajak Dipotong</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                    <?php $no = 1; $penerima=0; $bruto=0; $pph=0;?>
                                    @foreach ($final as $item)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $item->object->nmObjkPjk }}</td>
                                            <td>{{ $item->kdObjPjk }}</td>
                                            <td class="text-center">{{ $item->jmlPenerima }}</td>
                                            <td class="text-end">@money($item->jmlBruto)</td>
                                            <td class="text-end">@money($item->jmlPph)</td>
                                        </tr>
                                            <?php $penerima += $item->jmlPenerima; $bruto += $item->jmlBruto; $pph += $item->jmlPph?>
                                    @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                    <!--begin::Table foot-->
                                    <tfoot>
                                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                        <td colspan="3" class="text-center">Jumlah A1</td>
                                        <td class="text-center">{{ $penerima }}</td>
                                        <td class="text-end">@money($bruto)</td>
                                        <td class="text-end">@money($pph)</td>
                                    </tr>
                                    </tfoot>
                                    <!--end::Table foot-->
                                </table>
                            </div>
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
                                        <input type="number" class="form-control" name="nilai" value="{{ $spt->nilai }}" placeholder="Nilai" required>
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