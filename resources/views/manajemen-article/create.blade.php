<div class="modal fade" tabindex="-1" role="dialog" id="modal_tambah_artikel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Artikel Manual Peralatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="form_tambah_artikel" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            {{-- KIRI: Gambar dari URL --}}
            <div class="col-md-5">
              <div class="form-group">
                <label>URL Gambar</label>
                <div class="input-group">
                  <input type="url" class="form-control" name="image_url" id="image_url"
                        placeholder="https://contoh.com/gambar.jpg">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" onclick="previewCoverFromUrl()">
                      Preview
                    </button>
                  </div>
                </div>
                <small class="text-muted">Ambil URL gambar dari internet (misal: dari website Basarnas, dll).</small>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image_url"></div>

                <img src="" class="img-preview img-fluid mb-3 mt-2 d-none"
                    id="preview_cover_url"
                    style="max-height: 275px; overflow:hidden; border: 1px solid black;">
              </div>
            </div>



            {{-- KANAN: Field teks --}}
            <div class="col-md-7">
              <div class="form-group">
                <label>Judul Artikel</label>
                <input type="text" class="form-control" name="name" id="name">
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
              </div>

              <div class="form-group">
                <label>Slug (opsional, otomatis jika dikosongkan)</label>
                <input type="text" class="form-control" name="slug" id="slug">
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-slug"></div>
              </div>

              <div class="form-group">
                <label>Bagian Utama Peralatan</label>
                <textarea class="form-control" name="bagian_utama" id="bagian_utama" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-bagian_utama"></div>
              </div>

              <div class="form-group">
                <label>Safety / Prosedur Keamanan</label>
                <textarea class="form-control" name="safety" id="safety" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-safety"></div>
              </div>

              <div class="form-group">
                <label>Operasional</label>
                <textarea class="form-control" name="operasional" id="operasional" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-operasional"></div>
              </div>

              <div class="form-group">
                <label>Troubleshooting Ringan</label>
                <textarea class="form-control" name="troubleshooting" id="troubleshooting" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-troubleshooting"></div>
              </div>

              <div class="form-group">
                <label>Penyimpanan</label>
                <textarea class="form-control" name="penyimpanan" id="penyimpanan" rows="2"></textarea>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-penyimpanan"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="button" class="btn btn-primary" id="store_artikel">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
