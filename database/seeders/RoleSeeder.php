<?php
// database/seeders/RoleSeeder.php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'pelanggan'];

        foreach ($roles as $role) {
            Roles::firstOrCreate(['role_name' => $role]);
        }

        $this->command->info('Roles berhasil dibuat/diverifikasi.');
    }
}
