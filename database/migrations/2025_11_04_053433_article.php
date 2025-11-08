<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug')->unique()->index();
            $table->string('image_path')->nullable(); // simpan path relatif, ex: images/articles/xxx.jpg
            $table->longText('bagian_utama')->nullable();
            $table->longText('safety')->nullable();
            $table->longText('operasional')->nullable();
            $table->longText('troubleshooting')->nullable();
            $table->longText('penyimpanan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('articles');
    }
};