@extends('layouts.app')

@section('content')

<div class="section-header">
    <h1>Laporan Barang Masuk</h1>
    <div class="ml-auto">
        <a href="javascript:void(0)" class="btn btn-danger" id="print-barang-masuk"><i class="fa fa-sharp fa-light fa-print"></i> Print PDF</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <form id="filter_form" action="/laporan-barang-masuk/get-data" method="GET">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Pilih Tanggal Mulai :</label>
                                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                            </div>
                            <div class="col-md-5">
                                <label>Pilih Tanggal Selesai :</label>
                                <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" class="btn btn-danger" id="refresh_btn">Refresh</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal Masuk</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Masuk</th>
                                <th>Kegiatan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-laporan-barang-masuk">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#table_id').DataTable({ paging: true });

    // CACHE untuk kegiatan
    var kegiatanMap = {};
    var kegiatanPromise = null;

    // Ambil list kegiatan sekali saja
    function loadKegiatan() {
        if (kegiatanPromise) return kegiatanPromise; // kalau sudah pernah request, pakai yang sama

        kegiatanPromise = $.getJSON('{{ url('api/kegiatan') }}')
            .done(function(kegiatans) {
                kegiatanMap = {};
                kegiatans.forEach(function(k) {
                    // simpan di map: { id: nama_kegiatan }
                    kegiatanMap[k.id] = k.kegiatan;
                });
            })
            .fail(function(xhr, status, error) {
                console.error('Gagal load kegiatan:', error);
            });

        return kegiatanPromise;
    }

    function getKegiatanNameFromCache(kegiatanId) {
        return kegiatanMap[kegiatanId] || '';
    }

    // --- Load data barang masuk ---
    function loadData() {
        var tanggalMulai   = $('#tanggal_mulai').val();
        var tanggalSelesai = $('#tanggal_selesai').val();

        // Pastikan kegiatan sudah di-load, baru load laporan
        $.when(loadKegiatan()).done(function () {
            $.ajax({
                url: '/laporan-barang-masuk/get-data',
                type: 'GET',
                dataType: 'json',
                data: {
                    tanggal_mulai: tanggalMulai,
                    tanggal_selesai: tanggalSelesai
                },
                success: function(response) {
                    table.clear(); // bersihkan isi tabel

                    if (response.length > 0) {
                        $.each(response, function(index, item) {
                            var kegiatanName = getKegiatanNameFromCache(item.kegiatan_id);

                            var row = [
                                (index + 1),
                                item.kode_transaksi,
                                item.tanggal_masuk,
                                item.nama_barang,
                                item.jumlah_masuk,
                                kegiatanName,
                                item.keterangan
                            ];
                            table.row.add(row);
                        });
                        table.draw(false);
                    } else {
                        var emptyRow = ['','Tidak ada data yang tersedia.', '', '', '', '', ''];
                        table.row.add(emptyRow).draw(false);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    }

    // --- Event handler ---
    // pertama kali halaman dibuka
    loadData();

    $('#filter_form').submit(function(event) {
        event.preventDefault();
        loadData();
    });

    $('#refresh_btn').on('click', function() {
        $('#filter_form')[0].reset();
        loadData();
    });

    // Print barang masuk
    $('#print-barang-masuk').on('click', function() {
        var tanggalMulai   = $('#tanggal_mulai').val();
        var tanggalSelesai = $('#tanggal_selesai').val();

        var url = '/laporan-barang-masuk/print-barang-masuk';

        if (tanggalMulai && tanggalSelesai) {
            url += '?tanggal_mulai=' + tanggalMulai + '&tanggal_selesai=' + tanggalSelesai;
        }

        window.location.href = url;
    });
});
</script>
@endsection
