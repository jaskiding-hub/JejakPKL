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
        Schema::create('detail_industri', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_industri')->constrained('industri', 'id_industri')->onDelete('cascade');
            $table->text('deskripsi')->nullable();
            $table->string('posisi_magang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_industri');
    }
};
