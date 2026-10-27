<!-- Modal -->
<div class="modal fade" id="penghasilanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="penghasilanHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="penghasilanForm" name="penghasilanForm">
                <input type="hidden" name="id" id="penghasilan_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis Penghasilan</label>
                    <div class="col-md-8">
                        <input type="text" name="jenis" id="jenis" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Dasar Pengenaan Pajak (RUpiah)</label>
                    <div class="col-md-8">
                        <input type="text" name="pajak" id="pajak" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tarif (%)</label>
                    <div class="col-md-8">
                        <input type="number" name="tarif" id="tarif" class="form-control" maxlength="3" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="penghasilanBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lainnyaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="lainnyaHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="lainnyaForm" name="lainnyaForm">
                <input type="hidden" name="id" id="lainnya_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jenis Penghasilan</label>
                    <div class="col-md-8">
                        <input type="text" name="jenis" id="ljenis" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Penghasilan Bruto (Rupiah)</label>
                    <div class="col-md-8">
                        <input type="number" name="penghasilan" id="lpenghasilan" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="lainnyaBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>