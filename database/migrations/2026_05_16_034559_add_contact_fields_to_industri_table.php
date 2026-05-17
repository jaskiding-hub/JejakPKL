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
        Schema::table('industri', function (Blueprint $table) {
            $table->string('instagram')->nullable()->after('kontak');
            $table->string('email_perusahaan')->nullable()->after('instagram');
            $table->string('alamat')->nullable()->after('email_perusahaan');
        });
    }

    public function down(): void
    {
        Schema::table('industri', function (Blueprint $table) {
            $table->dropColumn(['instagram', 'email_perusahaan', 'alamat']);
        });
    }
};
