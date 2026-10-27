<?php

namespace Database\Seeders;

use App\Models\DataAkademik;
use App\Models\DataDukcapil;
use Illuminate\Database\Seeder;

class DataEksternalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Data Dukcapil Batam dari CSV
        $dukcapilFile = database_path('data_eksternal/dukcapil_batam.csv');
        if (file_exists($dukcapilFile)) {
            $handle = fopen($dukcapilFile, 'r');
            $header = fgetcsv($handle); // skip header row

            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) >= 10) {
                    DataDukcapil::updateOrCreate(
                        ['nik' => trim($row[0])],
                        [
                            'nama_lengkap'        => trim($row[1]),
                            'tempat_lahir'        => trim($row[2]),
                            'tanggal_lahir'       => trim($row[3]),
                            'jenis_kelamin'       => trim($row[4]),
                            'kecamatan'           => trim($row[5]),
                            'kelurahan'           => trim($row[6]),
                            'alamat_lengkap'      => trim($row[7]),
                            'status_kependudukan' => trim($row[8]),
                            'kategori_wilayah'    => trim($row[9]),
                        ]
                    );
                }
            }
            fclose($handle);
        }

        // 2. Seed Data Akademik Kemdikbud dari CSV
        $akademikFile = database_path('data_eksternal/akademik_kemdikbud.csv');
        if (file_exists($akademikFile)) {
            $handle = fopen($akademikFile, 'r');
            $header = fgetcsv($handle); // skip header row

            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) >= 12) {
                    DataAkademik::updateOrCreate(
                        ['nik' => trim($row[0])],
                        [
                            'nisn'                   => trim($row[1]),
                            'nama_lengkap'           => trim($row[2]),
                            'asal_sekolah'           => trim($row[3]),
                            'jurusan_sekolah'        => trim($row[4]),
                            'tahun_lulus'            => is_numeric(trim($row[5])) ? (int) trim($row[5]) : null,
                            'jalur_seleksi'          => trim($row[6]),
                            'nama_kampus_diterima'   => trim($row[7]),
                            'program_studi_diterima' => trim($row[8]),
                            'nilai_rata_rapor'       => is_numeric(trim($row[9])) ? (float) trim($row[9]) : null,
                            'skor_utbk'              => is_numeric(trim($row[10])) ? (float) trim($row[10]) : null,
                            'status_kelulusan'       => trim($row[11]),
                        ]
                    );
                }
            }
            fclose($handle);
        }
    }
}
