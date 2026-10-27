<!-- Modal -->
<div class="modal fade" id="modalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="modalForm" name="modalForm">
                <input type="hidden" name="id" id="modal_id">
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
                    <label class="col-md-3 col-form-label">Rupiah</label>
                    <div class="col-md-8">
                        <input type="number" name="rupiah" id="rupiah" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Persen (%)</label>
                    <div class="col-md-8">
                        <input type="number" name="persen" id="persen" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-sm btn-secondary" id="modalBtn" value="create">Simpan</button>
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
                    <label class="col-md-3 col-form-label">Nama</label>
                    <div class="col-md-8">
                        <input type="text" name="nama" id="unama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NPWP</label>
                    <div class="col-md-8">
                        <input type="text" name="npwp" id="unpwp" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jumlah Pinjaman</label>
                    <div class="col-md-8">
                        <input type="number" name="jumlah" id="ujumlah" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tahun Perolehan</label>
                    <div class="col-md-8">
                        <input type="number" name="tahun" id="utahun" class="form-control" minlength="4" maxlength="4" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Bunga (%)</label>
                    <div class="col-md-8">
                        <input type="number" name="bunga" id="ubunga" class="form-control" required>
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

<div class="modal fade" id="piutangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="piutangHeading"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="piutangForm" name="piutangForm">
                <input type="hidden" name="id" id="piutang_id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama</label>
                    <div class="col-md-8">
                        <input type="text" name="nama" id="pnama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">NPWP</label>
                    <div class="col-md-8">
                        <input type="text" name="npwp" id="pnpwp" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jumlah Pinjaman</label>
                    <div class="col-md-8">
                        <input type="number" name="jumlah" id="pjumlah" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tahun Perolehan</label>
                    <div class="col-md-8">
                        <input type="number" name="tahun" id="ptahun" class="form-control" minlength="4" maxlength="4" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Bunga (%)</label>
                    <div class="col-md-8">
                        <input type="number" name="bunga" id="pbunga" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-secondary" id="piutangBtn" value="create">Simpan</button>
        </div>
        </div>
    </div>
</div>