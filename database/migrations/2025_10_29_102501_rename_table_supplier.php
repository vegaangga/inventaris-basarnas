<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Rename tabel suppliers -> kegiatans
        if (Schema::hasTable('suppliers')) {
            Schema::rename('suppliers', 'kegiatans');
        }

        // Rename kolom supplier -> kegiatan, alamat -> keterangan
        Schema::table('kegiatans', function (Blueprint $table) {
            if (Schema::hasColumn('kegiatans', 'supplier')) {
                $table->renameColumn('supplier', 'kegiatan');
            }
            if (Schema::hasColumn('kegiatans', 'alamat')) {
                $table->renameColumn('alamat', 'keterangan');
            }
        });
    }

    public function down(): void
    {
        // Kembalikan perubahan kalau di-rollback
        if (Schema::hasTable('kegiatans')) {
            Schema::table('kegiatans', function (Blueprint $table) {
                if (Schema::hasColumn('kegiatans', 'kegiatan')) {
                    $table->renameColumn('kegiatan', 'supplier');
                }
                if (Schema::hasColumn('kegiatans', 'keterangan')) {
                    $table->renameColumn('keterangan', 'alamat');
                }
            });

            Schema::rename('kegiatans', 'suppliers');
        }
    }
};