<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit_kegiatan">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Kegiatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form enctype="multipart/form-data">
          <div class="modal-body">

            <input type="hidden" id="kegiatan_id">
            <div class="form-group">
                <label>Nama Kegiatan</label>
                <input type="text" class="form-control" name="kegiatan" id="edit_kegiatan">
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-supplier"></div>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" id="edit_keterangan" rows="3"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
            </div>

        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="button" class="btn btn-primary" id="update">Rubah</button>
        </div>
        </form>
      </div>
    </div>
  </div>


