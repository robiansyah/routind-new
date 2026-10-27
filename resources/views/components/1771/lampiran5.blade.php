<!-- Modal -->
<div class="modal fade" id="pemegangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pemegangHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="pemegangForm" name="pemegangForm">
                <input type="hidden" name="id" id="pemegang_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama</label>
                    <div class="col-md-8">
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Alamat</label>
                    <div class="col-md-8">
                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NPWP</label>
                    <div class="col-md-8">
                        <input type="text" name="npwp" id="npwp" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Modal (Rupiah)</label>
                    <div class="col-md-8">
                        <input type="number" name="modal" id="modal" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Modal (%)</label>
                    <div class="col-md-8">
                        <input type="number" name="persen" id="persen" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Dividen</label>
                    <div class="col-md-8">
                        <input type="number" name="dividen" id="dividen" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="pemegangBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pengurusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pengurusHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="pengurusForm" name="pengurusForm">
                <input type="hidden" name="id" id="pengurus_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama</label>
                    <div class="col-md-8">
                        <input type="text" name="nama" id="pnama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Alamat</label>
                    <div class="col-md-8">
                        <textarea name="alamat" id="palamat" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NPWP</label>
                    <div class="col-md-8">
                        <input type="text" name="npwp" id="pnpwp" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jabatan</label>
                    <div class="col-md-8">
                        <input type="text" name="jabatan" id="pjabatan" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="pengurusBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>