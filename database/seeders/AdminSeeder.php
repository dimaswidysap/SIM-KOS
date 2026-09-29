<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Roles::where('role_name', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('Role "admin" belum ada. Jalankan RoleSeeder terlebih dahulu.');
            return;
        }

        $admins = [
            [
                'name'     => 'Admin Satu',
                'email'    => 'admin1@kost.com',
                'password' => 'admin123', // ganti setelah login pertama
            ],
            [
                'name'     => 'Admin Dua',
                'email'    => 'admin2@kost.com',
                'password' => 'admin123', // ganti setelah login pertama
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']], // kunci pengecekan duplikat
                [
                    'role'  => $adminRole->id,
                    'name'     => $admin['name'],
                    'password' => Hash::make($admin['password']),
                ]
            );
        }

        $this->command->info('2 akun admin berhasil dibuat/diupdate.');
    }
}
