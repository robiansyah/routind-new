<!-- Modal -->
<div class="modal fade" id="pekerjaanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pekerjaanHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="pekerjaanForm" name="pekerjaanForm">
                <input type="hidden" name="id" id="pekerjaan_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NPWP Pemberi Kerja</label>
                    <div class="col-md-8">
                        <input type="text" name="npwp" id="npwp" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Pemberi Kerja</label>
                    <div class="col-md-8">
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Penghasilan Bruto</label>
                    <div class="col-md-8">
                        <input type="number" name="penghasilan" id="penghasilan" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Pengurangan Penghasilan Bruto</label>
                    <div class="col-md-8">
                        <input type="number" name="pengurangan" id="pengurangan" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="pekerjaanBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>