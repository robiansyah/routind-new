<!-- Modal -->
<div class="modal fade" id="pemotonganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pemotonganHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="pemotonganForm" name="pemotonganForm">
                <input type="hidden" name="id" id="pemotongan_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Pemotong</label>
                    <div class="col-md-8">
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NPWP</label>
                    <div class="col-md-8">
                        <input type="number" name="npwp" id="npwp" class="form-control" minlength="15" maxlength="16" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis Penghasilan</label>
                    <div class="col-md-8">
                        <select class="form-control" name="jenis" id="jenis">
                            <option value="Pasal 22 Badan Usaha Industri Semen">Pasal 22 Badan Usaha Industri Semen</option>
                            <option value="Pasal 22 Badan Usaha Industri Farmasi">Pasal 22 Badan Usaha Industri Farmasi</option>
                            <option value="Pasal 22 Badan Usaha Industri Kertas">Pasal 22 Badan Usaha Industri Kertas</option>
                            <option value="Pasal 22 Badan Usaha Industri Semen">Pasal 22 Badan Usaha Industri Semen</option>
                            <option value="Pasal 22 Badan Usaha Industri Baja">Pasal 22 Badan Usaha Industri Baja</option>
                            <option value="Pasal 22 Badan Usaha Industri Otomotif">Pasal 22 Badan Usaha Industri Otomotif</option>
                            <option value="Pasal 22 Nilai Impor Bank">Pasal 22 Nilai Impor Bank</option>
                            <option value="Pasal 22 Hasil Lelang">Pasal 22 Hasil Lelang</option>
                            <option value="Pasal 22 Penjulanan BBM, BBG dan Peluman">Pasal 22 Penjulanan BBM, BBG dan Peluman</option>
                            <option value="Pasal 22 Barang Keperluan Indsutri dalam Sektor Perhutanan">Pasal 22 Barang Keperluan Indsutri dalam Sektor Perhutanan</option>
                            <option value="Pasal 22 Barang Keperluan Indsutri dalam Sektor Perkebunan">Pasal 22 Barang Keperluan Indsutri dalam Sektor Perkebunan</option>
                            <option value="Pasal 22 Barang Keperluan Indsutri dalam Sektor Pertanian">Pasal 22 Barang Keperluan Indsutri dalam Sektor Pertanian</option>
                            <option value="Pasal 22 Barang Keperluan Indsutri dalam Sektor Perikanan">Pasal 22 Barang Keperluan Indsutri dalam Sektor Perikanan</option>
                            <option value="Pasal 22 Penjualan Emas Batangan oleh Badan Usaha">Pasal 22 Penjualan Emas Batangan oleh Badan Usaha</option>
                            <option value="Pasal 22 Ekspor Komoditas Tambang, Minerba dan Mineral Bukan Logam">Pasal 22 Ekspor Komoditas Tambang, Minerba dan Mineral Bukan Logam</option>
                            <option value="Pasal 22 Pembelian Barang oleh Badan Tertentu">Pasal 22 Pembelian Barang oleh Badan Tertentu</option>
                            <option value="Pasal 22 Penjualan Kendaraan Bermotor DN">Pasal 22 Penjualan Kendaraan Bermotor DN</option>
                            <option value="Pasal 22 Pembelian Minerba dan Mineral Bukan Logam dari Pemegang IUP">Pasal 22 Pembelian Minerba dan Mineral Bukan Logam dari Pemegang IUP</option>
                            <option value="Pasal 23 Dividen">Pasal 23 Dividen</option>
                            <option value="Pasal 23 Bunga">Pasal 23 Bunga</option>
                            <option value="Pasal 23 Royalti">Pasal 23 Royalti</option>
                            <option value="Pasal 23 Hadiah dan Penghargaan">Pasal 23 Hadiah dan Penghargaan</option>
                            <option value="Pasal 23 Bunga Simpanan yang DIbayarkan oleh Koperasi">Pasal 23 Bunga Simpanan yang DIbayarkan oleh Koperasi</option>
                            <option value="Pasal 23 Imbalan / Jasa Lainnya">Pasal 23 Imbalan / Jasa Lainnya</option>
                            <option value="Pasal 23 Sewa dan Penghasilan Lain Sehubungan dengan Penggunaan Harta">Pasal 23 Sewa dan Penghasilan Lain Sehubungan dengan Penggunaan Harta</option>
                            <option value="SKPPKP">SKPPKP</option>

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Objek POTPUT (Rupiah)</label>
                    <div class="col-md-8">
                        <input type="number" name="potongan" id="potongan" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">PPh POTPUT</label>
                    <div class="col-md-8">
                        <input type="number" name="pph" id="pph" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">No Bukti</label>
                    <div class="col-md-8">
                        <input type="text" name="no_bukti" id="no_bukti" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tanggal Bukti</label>
                    <div class="col-md-8">
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Alamat Pemotong</label>
                    <div class="col-md-8">
                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NTPN</label>
                    <div class="col-md-8">
                        <input type="text" name="ntpn" id="ntpn" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-sm btn-secondary" id="pemotonganBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>