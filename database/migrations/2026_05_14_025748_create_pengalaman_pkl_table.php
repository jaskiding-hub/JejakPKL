<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengalaman_pkl', function (Blueprint $table) {
            $table->id('id_pengalaman');
            $table->string('nama_siswa');
            $table->year('angkatan');
            $table->string('jurusan');
            $table->string('nama_industri');
            $table->text('cerita');
            $table->string('file_laporan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalaman_pkl');
    }
};
