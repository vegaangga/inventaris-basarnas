<div class="modal fade" tabindex="-1" role="dialog" id="modal_detail_artikel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Artikel Manual Peralatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" id="detail_artikel_id">

          <div class="row">
            {{-- KIRI: Gambar --}}
            <div class="col-md-5">
              <div class="form-group">
                <label>Gambar / Cover Artikel</label>
                <img src="" class="img-preview img-fluid my-1" id="detail_cover_preview"
                     style="max-height: 275px; overflow:hidden; border: 1px solid black;">
              </div>
            </div>

            {{-- KANAN: Field teks (readonly) --}}
            <div class="col-md-7">
              <div class="form-group">
                <label>Judul Artikel</label>
                <input type="text" class="form-control" id="detail_name" disabled>
              </div>

              <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" id="detail_slug" disabled>
              </div>

              <div class="form-group">
                <label>Bagian Utama Peralatan</label>
                <textarea class="form-control" id="detail_bagian_utama" rows="2" disabled></textarea>
              </div>

              <div class="form-group">
                <label>Safety / Prosedur Keamanan</label>
                <textarea class="form-control" id="detail_safety" rows="2" disabled></textarea>
              </div>

              <div class="form-group">
                <label>Operasional</label>
                <textarea class="form-control" id="detail_operasional" rows="2" disabled></textarea>
              </div>

              <div class="form-group">
                <label>Troubleshooting Ringan</label>
                <textarea class="form-control" id="detail_troubleshooting" rows="2" disabled></textarea>
              </div>

              <div class="form-group">
                <label>Penyimpanan</label>
                <textarea class="form-control" id="detail_penyimpanan" rows="2" disabled></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
        </div>
      </form>

    </div>
  </div>
</div>
