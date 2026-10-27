<!-- Modal -->
<div class="modal fade" id="bupotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="bupotHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="bupotForm" name="bupotForm">
                <input type="hidden" name="id" id="bupot_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Pemotong</label>
                    <div class="col-md-8">
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NPWP Pemotong</label>
                    <div class="col-md-8">
                        <input type="text" name="npwp" id="npwp" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nomor Bukti Potong</label>
                    <div class="col-md-8">
                        <input type="text" name="nomor" id="nomor" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tanggal Bukti Potong</label>
                    <div class="col-md-8">
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis Pajak</label>
                    <div class="col-md-8">
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="Pasal 21">Pasal 21</option>
                            <option value="Pasal 22">Pasal 22</option>
                            <option value="Pasal 23">Pasal 23</option>
                            <option value="Pasal 24">Pasal 24</option>
                            <option value="Pasal 26">Pasal 26</option>
                            <option value="Pasal DTP">Pasal DTP</option>
                            <option value="SKPPKP">SKPPKP</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jumlah Dipotong</label>
                    <div class="col-md-8">
                        <input type="number" name="pph" id="pph" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-sm btn-secondary" id="bupotBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>