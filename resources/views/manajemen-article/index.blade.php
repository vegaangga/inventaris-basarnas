@extends('layouts.app')

@include('manajemen-article.create')
@include('manajemen-article.edit')
@include('manajemen-article.show')

@section('content')
  <div class="section-header">
    <h1>Manajemen Artikel Manual Peralatan</h1>
    <div class="ml-auto">
      <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_artikel">
        <i class="fa fa-plus"></i> Tambah Artikel
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="table_artikel" class="display">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar</th>
                  <th>Judul</th>
                  <th>Slug</th>
                  <th>Terakhir Diupdate</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                {{-- diisi lewat AJAX --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- DataTables + load data --}}
  <script>
    $(document).ready(function () {
      let table = $('#table_artikel').DataTable({
        paging: true
      });

      function normalizeImagePath(path) {
        if (!path) return '/images/placeholder.jpg'; // sesuaikan kalau beda
        if (path.startsWith('http')) return path;
        // contoh: "storage/..." → jadikan "/storage/..."
        if (!path.startsWith('/')) return '/' + path;
        return path;
      }

      function loadArtikel() {
        $.ajax({
          url: "/manajemen-article/get-data",
          type: "GET",
          dataType: "JSON",
          success: function (response) {
            let counter = 1;
            table.clear();

            $.each(response.data, function (i, value) {
              let imgSrc = normalizeImagePath(value.image_path);
              let updatedAt = value.updated_at ?? '-';

              let row = `
                <tr id="index_artikel_${value.id}">
                  <td>${counter++}</td>
                  <td>
                    <img src="${imgSrc}" alt="cover artikel"
                         style="width: 120px; height: 80px; object-fit: cover; border: 1px solid #ccc;">
                  </td>
                  <td>${value.name ?? '-'}</td>
                  <td>${value.slug ?? '-'}</td>
                  <td>${updatedAt}</td>
                  <td>
                    <a href="javascript:void(0)" id="button_detail_artikel"
                       data-id="${value.id}" class="btn btn-icon btn-success btn-sm mb-1">
                      <i class="far fa-eye"></i>
                    </a>
                    <a href="javascript:void(0)" id="button_edit_artikel"
                       data-id="${value.id}" class="btn btn-icon btn-warning btn-sm mb-1">
                      <i class="far fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" id="button_hapus_artikel"
                       data-id="${value.id}" class="btn btn-icon btn-danger btn-sm mb-1">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              `;

              table.row.add($(row));
            });

            table.draw(false);
          },
          error: function (err) {
            console.log(err);
          }
        });
      }

      // simpan ke global biar CRUD lain bisa panggil
      window.refreshArtikelTable = loadArtikel;

      // pertama kali load
      loadArtikel();
    });
  </script>

  {{-- tombol tambah → buka modal --}}
  <script>
    $('body').on('click', '#button_tambah_artikel', function () {
      $('#form_tambah_artikel')[0].reset();
      $('#preview_cover').attr('src', '');
      $('.alert').addClass('d-none'); // hide error
      $('#modal_tambah_artikel').modal('show');
    });

    // CREATE
    $('#store_artikel').click(function (e) {
      e.preventDefault();

      let form = $('#form_tambah_artikel')[0];
      let formData = new FormData(form);
      formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

      $.ajax({
        url: "/manajemen-article",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          Swal.fire({
            icon: 'success',
            title: response.message,
            timer: 2000,
            showConfirmButton: false
          });

          if (typeof window.refreshArtikelTable === 'function') {
            window.refreshArtikelTable();
          }

          $('#modal_tambah_artikel').modal('hide');
        },
        error: function (xhr) {
          $('.alert').addClass('d-none');
          if (xhr.responseJSON && xhr.responseJSON.errors) {
            let errors = xhr.responseJSON.errors;
            Object.keys(errors).forEach(function (field) {
              let id = '#alert-' + field.replace('.', '_');
              $(id).removeClass('d-none').text(errors[field][0]);
            });
          }
        }
      });
    });
  </script>

  {{-- DETAIL --}}
  <script>
    $('body').on('click', '#button_detail_artikel', function () {
      let id = $(this).data('id');

      $.ajax({
        url: `/manajemen-article/${id}`,
        type: "GET",
        success: function (response) {
          let d = response.data;
          let imgSrc = d.image_path
            ? (d.image_path.startsWith('http') ? d.image_path : '/' + d.image_path.replace(/^\/?/, ''))
            : '/images/placeholder.jpg';

          $('#detail_artikel_id').val(d.id);
          $('#detail_name').val(d.name ?? '');
          $('#detail_slug').val(d.slug ?? '');
          $('#detail_bagian_utama').val(d.bagian_utama ?? '');
          $('#detail_safety').val(d.safety ?? '');
          $('#detail_operasional').val(d.operasional ?? '');
          $('#detail_troubleshooting').val(d.troubleshooting ?? '');
          $('#detail_penyimpanan').val(d.penyimpanan ?? '');
          $('#detail_cover_preview').attr('src', imgSrc);

          $('#modal_detail_artikel').modal('show');
        }
      });
    });
  </script>

  {{-- EDIT --}}
  <script>
    $('body').on('click', '#button_edit_artikel', function () {
      let id = $(this).data('id');

      $.ajax({
        url: `/manajemen-article/${id}/edit`,
        type: "GET",
        success: function (response) {
          let d = response.data;
          let imgSrc = d.image_path
            ? (d.image_path.startsWith('http') ? d.image_path : '/' + d.image_path.replace(/^\/?/, ''))
            : '/images/placeholder.jpg';

          $('#edit_artikel_id').val(d.id);
          $('#edit_name').val(d.name ?? '');
          $('#edit_slug').val(d.slug ?? '');
          $('#edit_bagian_utama').val(d.bagian_utama ?? '');
          $('#edit_safety').val(d.safety ?? '');
          $('#edit_operasional').val(d.operasional ?? '');
          $('#edit_troubleshooting').val(d.troubleshooting ?? '');
          $('#edit_penyimpanan').val(d.penyimpanan ?? '');
          $('#edit_cover_preview').attr('src', imgSrc);
          $('#edit_image_url').val(
            d.image_path && d.image_path.startsWith('http') ? d.image_path : ''
          );

          $('.alert').addClass('d-none');
          $('#modal_edit_artikel').modal('show');
        }
      });
    });

    $('#update_artikel').click(function (e) {
      e.preventDefault();

      let id = $('#edit_artikel_id').val();
      let form = $('#form_edit_artikel')[0];
      let formData = new FormData(form);
      formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
      formData.append('_method', 'PUT');

      $.ajax({
        url: `/manajemen-article/${id}`,
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          Swal.fire({
            icon: 'success',
            title: response.message,
            timer: 2000,
            showConfirmButton: false
          });

          if (typeof window.refreshArtikelTable === 'function') {
            window.refreshArtikelTable();
          }

          $('#modal_edit_artikel').modal('hide');
        },
        error: function (xhr) {
          $('.alert').addClass('d-none');
          if (xhr.responseJSON && xhr.responseJSON.errors) {
            let errors = xhr.responseJSON.errors;
            Object.keys(errors).forEach(function (field) {
              let id = '#alert-edit-' + field.replace('.', '_');
              $(id).removeClass('d-none').text(errors[field][0]);
            });
          }
        }
      });
    });
  </script>

  {{-- DELETE --}}
  <script>
    $('body').on('click', '#button_hapus_artikel', function () {
      let id = $(this).data('id');
      let token = $('meta[name="csrf-token"]').attr('content');

      Swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: "Ingin menghapus artikel ini!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'TIDAK',
        confirmButtonText: 'YA, HAPUS!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/manajemen-article/${id}`,
            type: "POST",
            data: {
              _token: token,
              _method: 'DELETE'
            },
            success: function (response) {
              Swal.fire({
                icon: 'success',
                title: response.message,
                timer: 2000,
                showConfirmButton: false
              });

              if (typeof window.refreshArtikelTable === 'function') {
                window.refreshArtikelTable();
              }
            }
          });
        }
      });
    });
  </script>

<script>
  function previewCoverFromUrl() {
    const url = $('#image_url').val().trim();
    $('#alert-image_url').addClass('d-none').text('');

    if (!url) {
      $('#preview_cover_url').addClass('d-none').attr('src', '');
      return;
    }

    $('#preview_cover_url')
      .removeClass('d-none')
      .attr('src', url)
      .off('error')  // buang handler lama
      .on('error', function () {
        $('#preview_cover_url').addClass('d-none');
        $('#alert-image_url')
          .removeClass('d-none')
          .text('URL gambar tidak dapat dimuat. Pastikan URL benar dan bisa diakses.');
      });
  }

  function previewCoverEditFromUrl() {
    const url = $('#edit_image_url').val().trim();
    $('#alert-edit-image_url').addClass('d-none').text('');

    if (!url) {
      $('#edit_cover_preview').addClass('d-none').attr('src', '');
      return;
    }

    $('#edit_cover_preview')
      .removeClass('d-none')
      .attr('src', url)
      .off('error')
      .on('error', function () {
        $('#edit_cover_preview').addClass('d-none');
        $('#alert-edit-image_url')
          .removeClass('d-none')
          .text('URL gambar tidak dapat dimuat. Pastikan URL benar dan bisa diakses.');
      });
  }

  // optional: auto-preview ketika input di-enter / blur
  $(document).on('blur', '#image_url', previewCoverFromUrl);
  $(document).on('blur', '#edit_image_url', previewCoverEditFromUrl);
</script>

@endsection
