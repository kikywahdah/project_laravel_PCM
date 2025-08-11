<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create super admin user
        Pengguna::updateOrCreate(
            ['email' => 'rezkyfadliahwahdahh@gmail.com'],
            [
                'nama_lengkap' => 'Super Admin PCM Benowo',
                'kata_sandi' => Hash::make('admin123'),
                'is_admin' => true,
                'is_super_admin' => true,
                'is_approved' => true,
                'tanggal_dibuat' => now(),
            ]
        );

        $this->command->info('Super admin user created successfully!');
        $this->command->info('Email: rezkyfadliahwahdahh@gmail.com');
        $this->command->info('Password: admin123');
    }
}
