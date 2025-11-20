<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit_artikel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Artikel Manual Peralatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="form_edit_artikel" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" id="edit_artikel_id">

          <div class="row">
            {{-- KIRI: Gambar dari URL --}}
          <div class="col-md-5">
            <div class="form-group">
              <label>URL Gambar</label>
              <div class="input-group">
                <input type="url" class="form-control" name="image_url" id="edit_image_url"
                      placeholder="https://contoh.com/gambar.jpg">
                <div class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary" onclick="previewCoverEditFromUrl()">
                    Preview
                  </button>
                </div>
              </div>
              <small class="text-muted">Jika diubah, akan mengganti gambar sebelumnya.</small>
              <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-image_url"></div>

              <img src="" class="img-preview img-fluid my-1 d-none"
                  id="edit_cover_preview"
                  style="max-height: 275px; overflow:hidden; border: 1px solid black;">
            </div>
          </div>



            {{-- KANAN: Field teks --}}
            <div class="col-md-7">
              <div class="form-group">
                <label>Judul Artikel</label>
                <input type="text" class="form-control" name="name" id="edit_name">
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-name"></div>
              </div>

              <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" name="slug" id="edit_slug">
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-slug"></div>
              </div>

              <div class="form-group">
                <label>Bagian Utama Peralatan</label>
                <textarea class="form-control" name="bagian_utama" id="edit_bagian_utama" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-bagian_utama"></div>
              </div>

              <div class="form-group">
                <label>Safety / Prosedur Keamanan</label>
                <textarea class="form-control" name="safety" id="edit_safety" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-safety"></div>
              </div>

              <div class="form-group">
                <label>Operasional</label>
                <textarea class="form-control" name="operasional" id="edit_operasional" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-operasional"></div>
              </div>

              <div class="form-group">
                <label>Troubleshooting Ringan</label>
                <textarea class="form-control" name="troubleshooting" id="edit_troubleshooting" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-troubleshooting"></div>
              </div>

              <div class="form-group">
                <label>Penyimpanan</label>
                <textarea class="form-control" name="penyimpanan" id="edit_penyimpanan" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-penyimpanan"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="button" class="btn btn-primary" id="update_artikel">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
