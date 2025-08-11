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
        Schema::table('pengguna', function (Blueprint $table) {
            if (!Schema::hasColumn('pengguna', 'is_admin')) {
                $table->boolean('is_admin')->default(false)->after('kata_sandi');
            }
            if (!Schema::hasColumn('pengguna', 'is_super_admin')) {
                $table->boolean('is_super_admin')->default(false)->after('is_admin');
            }
            if (!Schema::hasColumn('pengguna', 'is_approved')) {
                $table->boolean('is_approved')->default(false)->after('is_super_admin');
            }
            if (!Schema::hasColumn('pengguna', 'google_id')) {
                $table->string('google_id')->nullable()->after('is_approved');
            }
            if (!Schema::hasColumn('pengguna', 'avatar')) {
                $table->string('avatar')->nullable()->after('google_id');
            }
            if (!Schema::hasColumn('pengguna', 'tanggal_dibuat')) {
                $table->timestamp('tanggal_dibuat')->useCurrent()->after('avatar');
            }
            if (!Schema::hasColumn('pengguna', 'tanggal_diupdate')) {
                $table->timestamp('tanggal_diupdate')->nullable()->after('tanggal_dibuat');
            }
            if (!Schema::hasColumn('pengguna', 'remember_token')) {
                $table->rememberToken();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn([
                'is_admin',
                'is_super_admin', 
                'is_approved',
                'google_id',
                'avatar',
                'tanggal_dibuat',
                'tanggal_diupdate',
                'remember_token'
            ]);
        });
    }
};
