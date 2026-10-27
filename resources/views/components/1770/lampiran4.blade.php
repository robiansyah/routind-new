<!-- Modal -->
<div class="modal fade" id="hartaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hartaHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="hartaForm" name="hartaForm">
                <input type="hidden" name="id" id="harta_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama</label>
                    <div class="col-md-8">
                        <select class="form-control" id="kodeHarta" name="kodeHarta" required>
                            <option value=""></option>
                            <optgroup label="Kas dan Setara Kas">
                                <option value="011">011-Uang Tunai</option>
                                <option value="012">012-Tabungan</option>
                                <option value="013">013-Giro</option>
                                <option value="014">014-Deposito</option>
                                <option value="019">019-Setara Kas Lainnya</option>
                            </optgroup>
                            <optgroup label="Piutang">
                                <option value="021">021-Piutang</option>
                                <option value="022">022-Piutang Afiliasi(Piutang kepada pihak yang mempunyai hubungan istimewa sebagaimana dimaksud dalam Pasal 18 ayat(4) UU PPh)</option>
                                <option value="023">023-Persediaan Usaha</option>
                                <option value="029">029-Piutang Lainnya</option>
                            </optgroup>
                            <optgroup label="Investasi">
                                <option value="031">031-Saham yang dibeli untuk dijual kembali</option>
                                <option value="032">032-Saham</option>
                                <option value="033">033-Obligasi Perusahaan</option>
                                <option value="034">034-Obligasi Pemerintah Indonesia(ORI, Surat Berharga Syariah Negara, dll)</option>
                                <option value="035">035-Surat Utang Lainnya</option>
                                <option value="036">036-Reksadana</option>
                                <option value="037">037-Instrumen Derivatif</option>
                                <option value="038">038-Penyertaan Modal dalam perusahaan lain yang tidak atas saham meliputi penyertaan modal pada CV, Firma dan sejenisnya</option>
                                <option value="039">039-Investasi Lainnya</option>
                            </optgroup>
                            <optgroup label="Alat Transportasi">
                                <option value="041">041-Sepeda</option>
                                <option value="042">042-Sepeda Motor</option>
                                <option value="043">043-Mobil</option>
                                <option value="049">049-Alat Transportasi Lainnya</option>
                            </optgroup>
                            <optgroup label="Harta Bergerak">
                                <option value="051">051-Logam Mulia(emas batangan, emas perhiasan, platina batangan, platina perhiasan, logam mulia lainnya)</option>
                                <option value="052">052-Batu Mulia(Intan, Berlian, Batu Mulia lainnya)</option>
                                <option value="053">053-Barang-Barang seni dan antik</option>
                                <option value="054">054-Kapal Pesiar, Pesawat Terbang, Helikopter, Jetski, Peralatan Olah Raga Khusus</option>
                                <option value="055">055-Peralatan Elektronik, Furnitur</option>
                                <option value="059">059-Harta Bergerak Lainnya</option>
                            </optgroup>
                            <optgroup label="Harta Tidak Bergerak">
                                <option value="061">061-Tanah dan/atau bangunan untuk tempat tinggal</option>
                                <option value="062">062-Tanah dan/atau bangunan untuk usaha (Toko, pabrik, gudang dan sejenisnya)</option>
                                <option value="063">063-Tanah atau lahan untuk usaha(lahan pertanian, perkebunan, perikanan darat, dan sejenisnya)</option>
                                <option value="069">069-Harta tidak bergerak lainnya</option>
                            </optgroup>
                            <optgroup label="Harta Tidak Berwujud">
                                <option value="071">071-Paten</option>
                                <option value="072">072-Royalti</option>
                                <option value="073">073-Merek Dagang</option>
                                <option value="079">079-Harta tidak berwujud lainnya</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Harta</label>
                    <div class="col-md-8">
                        <input type="text" name="jnsHarta" id="jnsHarta" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tahun Perolehan</label>
                    <div class="col-md-8">
                        <input type="number" name="thPerolehan" id="thPerolehan" class="form-control" minlength="4" maxlength="4" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Harga Perolehan</label>
                    <div class="col-md-8">
                        <input type="number" name="harga" id="harga" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Keterangan</label>
                    <div class="col-md-8">
                        <textarea name="ket" id="ket" class="form-control" required></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-sm btn-secondary" id="hartaBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="utangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="utangHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="utangForm" name="utangForm">
                <input type="hidden" name="id" id="utang_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kode Utang</label>
                    <div class="col-md-8">
                        <select class="form-control" id="kodeUtang" name="kodeUtang" required>
                            <option value=""></option>
                            <option value="101">
                                <label>101-Utang Bank/Lembaga Keuangan bukan bank(KPR, Leasing Kendaraan Bermotor, dan sejenisnya)</label>
                            </option>
                            <option value="102">
                                <label>102-Kartu Kredit</label>
                            </option>
                            <option value="103">
                                <label>103-Utang Afiliasi(Pinjaman dari pihak yang memiliki hubungan istimewa sebagaimana dimaksud dalam pasal 18 ayat(4) UU PPh)</label>
                            </option>
                            <option value="109">
                                <label>109-Utang Lainnya</label>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Pemberi Pinjaman</label>
                    <div class="col-md-8">
                        <input type="text" name="nmPbrPinjam" id="nmPbrPinjam" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Alamat Pemberi Pinjaman</label>
                    <div class="col-md-8">
                        <textarea name="almtPbrPinjam" id="almtPbrPinjam" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tahun Peminjaman</label>
                    <div class="col-md-8">
                        <input type="number" name="thPinjam" id="thPinjam" class="form-control" minlength="4" maxlength="4" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jumlah</label>
                    <div class="col-md-8">
                        <input type="number" name="jmlPinjam" id="jmlPinjam" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="utangBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="keluargaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="keluargaHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="keluargaForm" name="keluargaForm">
                <input type="hidden" name="id" id="keluarga_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama</label>
                    <div class="col-md-8">
                        <input type="text" name="nmAgKel" id="nmAgKel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NIK</label>
                    <div class="col-md-8">
                        <input type="number" name="nik" id="nik" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Hubungan Keluarga</label>
                    <div class="col-md-8">
                        <input type="text" name="hubKel" id="hubKel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Pekerjaan</label>
                    <div class="col-md-8">
                        <input type="text" name="kerja" id="kerja" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="keluargaBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>