<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Pegawai: Administrator Pemko
        User::updateOrCreate(
            ['email' => 'admin@batam.go.id'],
            [
                'name' => 'Administrator Pemko',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'employee_id' => 'ADMIN001',
            ]
        );

        // 2. Akun Pegawai: Tim Verifikator
        User::updateOrCreate(
            ['email' => 'verifikator@batam.go.id'],
            [
                'name' => 'Petugas Verifikator',
                'password' => bcrypt('password'),
                'role' => 'verifikator',
                'employee_id' => 'VERIF001',
            ]
        );

        // 3. Akun Pegawai: Pengambil Keputusan (Pimpinan)
        User::updateOrCreate(
            ['email' => 'pimpinan@batam.go.id'],
            [
                'name' => 'Pengambil Keputusan',
                'password' => bcrypt('password'),
                'role' => 'pimpinan',
                'employee_id' => 'PIMP001',
            ]
        );

        // 4. Akun Pemohon / Mahasiswa Demo
        User::updateOrCreate(
            ['email' => 'brystr18@gmail.com'],
            [
                'name' => 'Bryan Sitorus',
                'password' => bcrypt('password'),
                'role' => 'pemohon',
            ]
        );

        // 5. Pangkalan Data Eksternal (Disdukcapil & Kemdikbud)
        $this->call(DataEksternalSeeder::class);
    }
}
