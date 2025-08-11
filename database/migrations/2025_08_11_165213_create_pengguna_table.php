<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama_lengkap', 100);
            $table->string('email', 100)->unique();
            $table->string('kata_sandi');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_super_admin')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->timestamp('tanggal_diupdate')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
