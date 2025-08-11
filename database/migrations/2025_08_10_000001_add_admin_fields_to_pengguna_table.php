<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('pengguna')) {
            Schema::table('pengguna', function (Blueprint $table) {
                if (!Schema::hasColumn('pengguna', 'is_admin')) {
                    $table->boolean('is_admin')->default(false)->after('tanggal_dibuat');
                }
                if (!Schema::hasColumn('pengguna', 'is_super_admin')) {
                    $table->boolean('is_super_admin')->default(false)->after('is_admin');
                }
            });

            // Jadikan pengguna dengan email super admin sebagai super admin
            $superEmail = config('app.super_admin_email', 'Admin@go.id');
            try {
                DB::table('pengguna')
                    ->whereRaw('LOWER(email) = ?', [strtolower($superEmail)])
                    ->update(['is_admin' => true, 'is_super_admin' => true]);
            } catch (\Throwable $e) {
                // ignore if table structure/data not ready
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengguna')) {
            Schema::table('pengguna', function (Blueprint $table) {
                if (Schema::hasColumn('pengguna', 'is_super_admin')) {
                    $table->dropColumn('is_super_admin');
                }
                if (Schema::hasColumn('pengguna', 'is_admin')) {
                    $table->dropColumn('is_admin');
                }
            });
        }
    }
};


