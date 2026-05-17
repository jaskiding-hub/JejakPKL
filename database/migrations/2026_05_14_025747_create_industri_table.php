<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('industri', function (Blueprint $table) {
            $table->id('id_industri');
            $table->string('nama_industri');
            $table->string('kategori');
            $table->string('lokasi');
            $table->string('gambar')->nullable();
            $table->string('kontak')->nullable();
            $table->integer('jumlah_siswa_pkl')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('industri');
    }
};