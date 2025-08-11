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
                if (!Schema::hasColumn('pengguna', 'is_approved')) {
                    $table->boolean('is_approved')->default(false)->after('is_super_admin');
                }
            });

            // Set super admin email and make it approved
            $superEmail = 'rezkyfadliahwahdahh@gmail.com';
            try {
                DB::table('pengguna')
                    ->whereRaw('LOWER(email) = ?', [strtolower($superEmail)])
                    ->update([
                        'is_admin' => true, 
                        'is_super_admin' => true,
                        'is_approved' => true
                    ]);
            } catch (\Throwable $e) {
                // ignore if table structure/data not ready
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengguna')) {
            Schema::table('pengguna', function (Blueprint $table) {
                if (Schema::hasColumn('pengguna', 'is_approved')) {
                    $table->dropColumn('is_approved');
                }
            });
        }
    }
};


