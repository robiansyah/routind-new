<!-- Modal -->
<div class="modal fade" id="setorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setorHeading"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="setorForm" name="setorForm">
                    <input type="hidden" name="id" id="setor_id">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Kode MAP</label>
                        <div class="col-md-8">
                            <input type="text" name="kode_map" id="kode_map" value="411125" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Kode Jenis STR</label>
                        <div class="col-md-8">
                            <input type="text" name="kode_jenis" id="kode_jenis" value="200" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tanggal (SSP/PBK)</label>
                        <div class="col-md-8">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Jumlah Bayar</label>
                        <div class="col-md-8">
                            <input type="number" name="bayar" id="bayar" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">NTPN / PBK</label>
                        <div class="col-md-8">
                            <input type="text" name="ntpn" id="ntpn" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-secondary" id="setorBtn" value="create">Simpan</button>
            </div>
        </div>
    </div>
</div>