<!-- Modal -->
<div class="modal fade" id="penyusutanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="penyusutanHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="penyusutanForm" name="penyusutanForm">
                <input type="hidden" name="id" id="penyusutan_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis Harta</label>
                    <div class="col-md-8">
                        <select class="form-control" name="jenis_harta" id="jenis_harta">
                            <option value="Harta Berwujud">Harta Berwujud</option>
                            <option value="Kelompok Bangunan">Kelompok Bangunan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kelompok Harta</label>
                    <div class="col-md-8">
                        <select class="form-control" name="kelompok_harta" id="kelompok_harta">
                            <option value="Kelompok 1">Kelompok 1</option>
                            <option value="Kelompok 2">Kelompok 2</option>
                            <option value="Kelompok 3">Kelompok 3</option>
                            <option value="Kelompok 4">Kelompok 4</option>
                            <option value="Permanen">Permanen</option>
                            <option value="Tidak Permanen">Tidak Permanen</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Harta</label>
                    <div class="col-md-8">
                        <input type="text" name="nama_harta" id="nama_harta" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Bulan Perolehan</label>
                    <div class="col-md-8">
                        <select class="form-control" name="bulan" id="bulan_perolehan">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tahun Perolehan</label>
                    <div class="col-md-8">
                        <input type="number" name="tahun" id="tahun" class="form-control" minlength="4" maxlength="4" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Harga Perolehan</label>
                    <div class="col-md-8">
                        <input type="number" name="harga" id="harga" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nilai Sisa Buku Fiskal Awal Tahun</label>
                    <div class="col-md-8">
                        <input type="number" name="nilai_sisa" id="nilai_sisa" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Metode Penyusutan Komersial</label>
                    <div class="col-md-8">
                        <select class="form-control" name="metode_komersial" id="metode_komersial">
                            <option value="Garis Lurus">Garis Lurus</option>
                            <option value="Jumlah Angka Tahun">Jumlah Angka Tahun</option>
                            <option value="Saldo Menurun">Saldo Menurun</option>
                            <option value="Saldo Menurun Ganda">Saldo Menurun Ganda</option>
                            <option value="Jumlah Jam Jasa">Jumlah Jam Jasa</option>
                            <option value="Jumlah Satuan Produksi">Jumlah Satuan Produksi</option>
                            <option value="Metode Lainnya">Metode Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Metode Penyusutan Fiskal</label>
                    <div class="col-md-8">
                        <select class="form-control" name="metode_fiskal" id="metode_fiskal">
                            <option value="Garis Lurus">Garis Lurus</option>
                            <option value="Saldo Menurun">Saldo Menurun</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Penyusutan Fiskal Tahun Ini</label>
                    <div class="col-md-8">
                        <input type="number" name="fiskal" id="fiskal" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Catatan</label>
                    <div class="col-md-8">
                        <textarea name="catatan" id="catatan" class="form-control" required></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-sm btn-secondary" id="penyusutanBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="amortisasiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="amortisasiHeading">TAMBAH AMORTISASI FISKAL</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="amortisasiForm" name="amortisasiForm">
                <input type="hidden" name="id" id="amortisasi_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis Harta</label>
                    <div class="col-md-8">
                        <select class="form-control" name="jenis_harta" id="mjenis_harta">
                            <option value="Harta Tak Berwujud">Harta Tak Berwujud</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kelompok Harta</label>
                    <div class="col-md-8">
                        <select class="form-control" name="kelompok_harta" id="mkelompok_harta">
                            <option value="Kelompok 1">Kelompok 1</option>
                            <option value="Kelompok 2">Kelompok 2</option>
                            <option value="Kelompok 3">Kelompok 3</option>
                            <option value="Kelompok 4">Kelompok 4</option>
                            <option value="Kelompok Lain-Lain">Kelompok Lain-Lain</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Harta</label>
                    <div class="col-md-8">
                        <input type="text" name="nama_harta" id="mnama_harta" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Bulan Perolehan</label>
                    <div class="col-md-8">
                        <select class="form-control" name="bulan" id="mbulan">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tahun Perolehan</label>
                    <div class="col-md-8">
                        <input type="number" name="tahun" id="mtahun" class="form-control" minlength="4" maxlength="4" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Harga Perolehan</label>
                    <div class="col-md-8">
                        <input type="number" name="harga" id="mharga" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nilai Sisa Buku Fiskal Awal Tahun</label>
                    <div class="col-md-8">
                        <input type="number" name="nilai_sisa" id="mnilai_sisa" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Metode Amortisasi Komersial</label>
                    <div class="col-md-8">
                        <select class="form-control" name="metode_komersial" id="mmetode_komersial">
                            <option value="Garis Lurus">Garis Lurus</option>
                            <option value="Jumlah Angka Tahun">Jumlah Angka Tahun</option>
                            <option value="Saldo Menurun">Saldo Menurun</option>
                            <option value="Saldo Menurun Ganda">Saldo Menurun Ganda</option>
                            <option value="Jumlah Jam Jasa">Jumlah Jam Jasa</option>
                            <option value="Jumlah Satuan Produksi">Jumlah Satuan Produksi</option>
                            <option value="Metode Lainnya">Metode Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Metode Penyusutan Fiskal</label>
                    <div class="col-md-8">
                        <select class="form-control" name="metode_fiskal" id="mmetode_fiskal">
                            <option value="Garis Lurus">Garis Lurus</option>
                            <option value="Saldo Menurun">Saldo Menurun</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Penyusutan Fiskal Tahun Ini</label>
                    <div class="col-md-8">
                        <input type="number" name="fiskal" id="mfiskal" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Catatan</label>
                    <div class="col-md-8">
                        <textarea name="catatan" id="mcatatan" class="form-control" required></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="amortisasiBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>