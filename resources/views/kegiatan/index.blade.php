@extends('layouts.app')

@include('kegiatan.create')
@include('kegiatan.edit')

@section('content')
    <div class="section-header">
        <h1>Data Kegiatan</h1>
        <div class="ml-auto">
            <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_kegiatan"><i class="fa fa-plus"></i>
                Kegiatabn</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Keterangan</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Datatables Jquery -->
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();

            $.ajax({
                url: "/kegiatan/get-data",
                type: "GET",
                dataType: 'JSON',
                success: function(response) {
                    let counter = 1;
                    if ($.fn.DataTable.isDataTable('#table_id')) {
                        $('#table_id').DataTable().destroy();
                    }

                    $('#table_id').DataTable().clear();
                    $.each(response.data, function(key, value) {
                        let kegiatan = `
                <tr class="barang-row" id="index_${value.id}">
                    <td>${counter++}</td>   
                    <td>${value.kegiatan}</td>
                    <td>${value.keterangan}</td>
                    <td>
                        <a href="javascript:void(0)" id="button_edit_kegiatan" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="far fa-edit"></i> </a>
                        <a href="javascript:void(0)" id="button_hapus_kegiatan" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="fas fa-trash"></i> </a>
                    </td>
                </tr>
            `;
                        $('#table_id').DataTable().row.add($(kegiatan)).draw(false);
                    });
                }
            });
        });
    </script>

    <!-- Show Modal Tambah Jenis Barang -->
    <script>
        $('body').on('click', '#button_tambah_kegiatan', function() {
            $('#modal_tambah_kegiatan').modal('show');
        });

        $('#store').click(function(e) {
            e.preventDefault();

            let kegiatan = $('#kegiatan').val();
            let keterangan = $('#keterangan').val();
            let token = $("meta[name='csrf-token']").attr("content");

            let formData = new FormData();
            formData.append('kegiatan', kegiatan);
            formData.append('keterangan', keterangan);
            formData.append('_token', token);

            $.ajax({
                url: '/kegiatan',
                type: "POST",
                cache: false,
                data: formData,
                contentType: false,
                processData: false,

                success: function(response) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: true,
                        timer: 3000
                    });

                    $.ajax({
                        url: '/kegiatan/get-data',
                        type: "GET",
                        cache: false,
                        success: function(response) {
                            $('#table-barangs').html('');

                            let counter = 1;
                            $('#table_id').DataTable().clear();
                            $.each(response.data, function(key, value) {
                                let kegiatan = `
                                <tr class="barang-row" id="index_${value.id}">
                                    <td>${counter++}</td>   
                                    <td>${value.kegiatan}</td>
                                    <td>${value.keterangan}</td>
                                    <td>
                                        <a href="javascript:void(0)" id="button_edit_kegiatan" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="far fa-edit"></i> </a>
                                        <a href="javascript:void(0)" id="button_hapus_kegiatan" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="fas fa-trash"></i> </a>
                                    </td>
                                </tr>
                             `;
                                $('#table_id').DataTable().row.add($(kegiatan))
                                    .draw(false);
                            });

                            $('#kegiatan').val('');
                            $('#keterangan').val('');
                            $('#modal_tambah_kegiatan').modal('hide');

                            let table = $('#table_id').DataTable();
                            table.draw(); // memperbarui Datatables
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    })
                },

                error: function(error) {
                    if (error.responseJSON && error.responseJSON.kegiatan && error.responseJSON
                        .kegiatan[0]) {
                        $('#alert-kegiatan').removeClass('d-none');
                        $('#alert-kegiatan').addClass('d-block');

                        $('#alert-kegiatan').html(error.responseJSON.kegiatan[0]);
                    }

                    if (error.responseJSON && error.responseJSON.keterangan && error.responseJSON.keterangan[
                        0]) {
                        $('#alert-keterangan').removeClass('d-none');
                        $('#alert-keterangan').addClass('d-block');

                        $('#alert-keterangan').html(error.responseJSON.keterangan[0]);
                    }
                }
            });
        });
    </script>

    <!-- Edit Data Jenis Barang -->
    <script>
        //Show modal edit
        $('body').on('click', '#button_edit_kegiatan', function() {
            let kegiatan_id = $(this).data('id');

            $.ajax({
                url: `/kegiatan/${kegiatan_id}/edit`,
                type: "GET",
                cache: false,
                success: function(response) {
                    $('#kegiatan_id').val(response.data.id);
                    $('#edit_kegiatan').val(response.data.kegiatan);
                    $('#edit_keterangan').val(response.data.keterangan);

                    $('#modal_edit_kegiatan').modal('show');
                }
            });
        });

        // Proses Update Data
        $('#update').click(function(e) {
            e.preventDefault();

            let kegiatan_id = $('#kegiatan_id').val();
            let kegiatan = $('#edit_kegiatan').val();
            let keterangan = $('#edit_keterangan').val();
            let token = $("meta[name='csrf-token']").attr('content');

            let formData = new FormData();
            formData.append('kegiatan', kegiatan);
            formData.append('keterangan', keterangan);
            formData.append('_token', token);
            formData.append('_method', 'PUT');

            $.ajax({
                url: `/kegiatan/${kegiatan_id}`,
                type: "POST",
                cache: false,
                data: formData,
                contentType: false,
                processData: false,

                success: function(response) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: true,
                        timer: 3000
                    });

                    let row = $(`#index_${response.data.id}`);
                    let rowData = row.find('td');
                    rowData.eq(1).text(response.data.kegiatan);
                    rowData.eq(2).text(response.data.keterangan);

                    $('#modal_edit_kegiatan').modal('hide');
                },

                error: function(error) {
                    if (error.responseJSON && error.responseJSON.kegiatan && error.responseJSON
                        .kegiatan[0]) {
                        $('#alert-kegiatan').removeClass('d-none');
                        $('#alert-kegiatan').addClass('d-block');

                        $('#alert-kegiatan').html(error.responseJSON.kegiatan[0]);
                    }

                    if (error.responseJSON && error.responseJSON.keterangan && error.responseJSON.keterangan[
                        0]) {
                        $('#alert-keterangan').removeClass('d-none');
                        $('#alert-keterangan').addClass('d-block');

                        $('#alert-keterangan').html(error.responseJSON.keterangan[0]);
                    }
                }
            });
        });
    </script>

    <!-- Hapus Data Barang -->
    <script>
        $('body').on('click', '#button_hapus_kegiatan', function() {
            let kegiatan_id = $(this).data('id');
            let token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "ingin menghapus data ini !",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'TIDAK',
                confirmButtonText: 'YA, HAPUS!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/kegiatan/${kegiatan_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: true,
                                timer: 3000
                            });
                            $(`#index_${kegiatan_id}`).remove();

                            $.ajax({
                                url: "/kegiatan/get-data",
                                type: "GET",
                                dataType: 'JSON',
                                success: function(response) {
                                    let counter = 1;
                                    if ($.fn.DataTable.isDataTable('#table_id')) {
                                        $('#table_id').DataTable().destroy();
                                    }

                                    $('#table_id').DataTable().clear();
                                    $.each(response.data, function(key, value) {
                                        let kegiatan = `
                                        <tr class="barang-row" id="index_${value.id}">
                                            <td>${counter++}</td>   
                                            <td>${value.kegiatan}</td>
                                            <td>${value.keterangan}</td>
                                            <td>
                                                <a href="javascript:void(0)" id="button_edit_kegiatan" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="far fa-edit"></i> </a>
                                                <a href="javascript:void(0)" id="button_hapus_kegiatan" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="fas fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    `;
                                        $('#table_id').DataTable().row.add(
                                            $(kegiatan)).draw(false);
                                    });
                                }
                            });
                        }
                    })
                }
            });
        });
    </script>
@endsection
