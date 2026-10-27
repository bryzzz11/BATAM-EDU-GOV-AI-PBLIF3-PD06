<?php

namespace Tests\Feature;

use App\Models\DataAkademik;
use App\Models\DataDukcapil;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DataEksternalTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_data_eksternal_page(): void
    {
        $admin = User::factory()->create([
            'role'        => 'admin',
            'employee_id' => 'ADMIN001',
        ]);

        $response = $this->actingAs($admin)->get(route('pegawai.data-eksternal'));
        $response->assertStatus(200);
        $response->assertSee('Manajemen Data Eksternal');
    }

    public function test_admin_can_download_csv_template(): void
    {
        $admin = User::factory()->create([
            'role'        => 'admin',
            'employee_id' => 'ADMIN001',
        ]);

        $response = $this->actingAs($admin)->get(route('pegawai.data-eksternal.template', 'dukcapil'));
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }

    public function test_admin_can_import_dukcapil_csv(): void
    {
        $admin = User::factory()->create([
            'role'        => 'admin',
            'employee_id' => 'ADMIN001',
        ]);

        $csvContent = "nik,nama_lengkap,tempat_lahir,tanggal_lahir,jenis_kelamin,kecamatan,kelurahan,alamat_lengkap,status_kependudukan,kategori_wilayah\n";
        $csvContent .= "2171888888880001,Budi Santoso,Batam,2004-03-10,Laki-laki,Batam Kota,Belian,Komp. Mega Mall Blok A,AKTIF,MAINLAND\n";
        $csvContent .= "2171888888880002,Siti Aminah,Batam,2005-07-21,Perempuan,Belakang Padang,Tanjung Sari,Pulau Sambu,AKTIF,HINTERLAND\n";

        $file = UploadedFile::fake()->createWithContent('dukcapil_dummy.csv', $csvContent);

        $response = $this->actingAs($admin)->post(route('pegawai.data-eksternal.import'), [
            'tipe_data'  => 'dukcapil',
            'file_excel' => $file,
            'mode'       => 'upsert',
        ]);

        $response->assertRedirect(route('pegawai.data-eksternal', ['tab' => 'dukcapil']));
        $this->assertDatabaseHas('data_dukcapils', [
            'nik'          => '2171888888880001',
            'nama_lengkap' => 'Budi Santoso',
        ]);
        $this->assertDatabaseHas('data_dukcapils', [
            'nik'              => '2171888888880002',
            'kategori_wilayah' => 'HINTERLAND',
        ]);
    }

    public function test_admin_can_import_akademik_csv(): void
    {
        $admin = User::factory()->create([
            'role'        => 'admin',
            'employee_id' => 'ADMIN001',
        ]);

        $csvContent = "nik,nisn,nama_lengkap,asal_sekolah,jurusan_sekolah,tahun_lulus,jalur_seleksi,nama_kampus_diterima,program_studi_diterima,nilai_rata_rapor,skor_utbk,status_kelulusan\n";
        $csvContent .= "2171888888880001,0069999001,Budi Santoso,SMA N 3 Batam,MIPA,2025,SNBP,Politeknik Negeri Batam,Teknik Informatika,88.90,,DITERIMA\n";

        $file = UploadedFile::fake()->createWithContent('akademik_dummy.csv', $csvContent);

        $response = $this->actingAs($admin)->post(route('pegawai.data-eksternal.import'), [
            'tipe_data'  => 'akademik',
            'file_excel' => $file,
            'mode'       => 'upsert',
        ]);

        $response->assertRedirect(route('pegawai.data-eksternal', ['tab' => 'akademik']));
        $this->assertDatabaseHas('data_akademiks', [
            'nik'          => '2171888888880001',
            'nama_lengkap' => 'Budi Santoso',
            'nilai_rata_rapor' => 88.90,
        ]);
    }
}
