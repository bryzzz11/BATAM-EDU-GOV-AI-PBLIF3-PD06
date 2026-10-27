<?php

namespace Tests\Feature;

use App\Models\DataAkademik;
use App\Models\DataDukcapil;
use App\Models\Pengajuan;
use App\Models\User;
use App\Services\XAIService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class XAIServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_xai_service_generates_high_score_for_matching_data(): void
    {
        // 1. Setup Data Eksternal
        DataDukcapil::create([
            'nik'                 => '217115864469',
            'nama_lengkap'        => 'Maya Lestari',
            'tempat_lahir'        => 'Batam',
            'tanggal_lahir'       => '2004-10-18',
            'jenis_kelamin'       => 'Laki-laki',
            'kecamatan'           => 'Belakang Padang',
            'kelurahan'           => 'Belakang Padang',
            'alamat_lengkap'      => 'KEL. BELAKANG PADANG, RT 002/001',
            'status_kependudukan' => 'AKTIF',
            'kategori_wilayah'    => 'HINTERLAND',
        ]);

        DataAkademik::create([
            'nik'                    => '217115864469',
            'nisn'                   => '0061234568',
            'nama_lengkap'           => 'Maya Lestari',
            'asal_sekolah'           => 'SMA Negeri 2 Batam',
            'tahun_lulus'            => 2025,
            'jalur_seleksi'          => 'HINTERLAND',
            'nama_kampus_diterima'   => 'Politeknik Negeri Batam',
            'program_studi_diterima' => 'Teknik Informatika',
            'nilai_rata_rapor'       => 87.50,
            'status_kelulusan'       => 'DITERIMA',
        ]);

        $user = User::factory()->create();

        $pengajuan = Pengajuan::create([
            'user_id'          => $user->id,
            'nomor_registrasi' => 'BTM-HTL-2026-0001',
            'jalur'            => 'HINTERLAND',
            'nama_lengkap'     => 'Maya Lestari',
            'nik'              => '217115864469',
            'tempat_lahir'     => 'Batam',
            'tanggal_lahir'    => '2004-10-18',
            'jenis_kelamin'    => 'Laki-laki',
            'no_hp'            => '081234567890',
            'email'            => 'maya@example.com',
            'kecamatan'        => 'Belakang Padang',
            'kelurahan'        => 'Belakang Padang',
            'alamat_lengkap'   => 'Kel. Belakang Padang',
            'nama_kampus'      => 'Politeknik Negeri Batam',
            'program_studi'    => 'Teknik Informatika',
            'nim'              => '3312311001',
            'semester'         => 1,
            'ipk_nilai'        => 87.50,
            'status'           => 'menunggu_verifikasi',
        ]);

        $analysis = XAIService::analyze($pengajuan);

        $this->assertGreaterThanOrEqual(85, $analysis['skor_total']);
        $this->assertEquals('DIREKOMENDASIKAN_LOLOS', $analysis['rekomendasi']);
        $this->assertNotEmpty($analysis['checks']);
    }

    public function test_verifikator_can_forward_pengajuan_to_pimpinan(): void
    {
        $verifikator = User::factory()->create([
            'role'        => 'verifikator',
            'employee_id' => 'VERIF001',
        ]);

        $pemohon = User::factory()->create();
        $pengajuan = Pengajuan::create([
            'user_id'          => $pemohon->id,
            'nomor_registrasi' => 'BTM-SNBP-2026-0002',
            'jalur'            => 'SNBP',
            'nama_lengkap'     => 'Test Candidate',
            'nik'              => '2171010101010001',
            'tempat_lahir'     => 'Batam',
            'tanggal_lahir'    => '2004-01-01',
            'jenis_kelamin'    => 'Laki-laki',
            'no_hp'            => '08123456789',
            'email'            => 'candidate@example.com',
            'kecamatan'        => 'Batam Kota',
            'kelurahan'        => 'Belian',
            'alamat_lengkap'   => 'Batam Centre',
            'nama_kampus'      => 'Politeknik Negeri Batam',
            'program_studi'    => 'Informatika',
            'nim'              => '123456',
            'semester'         => 1,
            'status'           => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($verifikator)
            ->post(route('pegawai.pengajuan.teruskan', $pengajuan->id), [
                'catatan' => 'Berkas valid dan rekomendasi xAI 95%',
            ]);

        $response->assertRedirect(route('pegawai.dashboard'));
        $this->assertEquals('menunggu_keputusan', $pengajuan->fresh()->status);
    }

    public function test_verifikator_can_return_pengajuan_for_repair(): void
    {
        $verifikator = User::factory()->create([
            'role'        => 'verifikator',
            'employee_id' => 'VERIF001',
        ]);

        $pemohon = User::factory()->create();
        $pengajuan = Pengajuan::create([
            'user_id'          => $pemohon->id,
            'nomor_registrasi' => 'BTM-SNBP-2026-0003',
            'jalur'            => 'SNBP',
            'nama_lengkap'     => 'Revisi Candidate',
            'nik'              => '2171010101010002',
            'tempat_lahir'     => 'Batam',
            'tanggal_lahir'    => '2004-01-01',
            'jenis_kelamin'    => 'Laki-laki',
            'no_hp'            => '08123456789',
            'email'            => 'revisi@example.com',
            'kecamatan'        => 'Batam Kota',
            'kelurahan'        => 'Belian',
            'alamat_lengkap'   => 'Batam Centre',
            'nama_kampus'      => 'Politeknik Negeri Batam',
            'program_studi'    => 'Informatika',
            'nim'              => '123457',
            'semester'         => 1,
            'status'           => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($verifikator)
            ->post(route('pegawai.pengajuan.kembalikan', $pengajuan->id), [
                'catatan_perbaikan' => 'Foto e-KTP buram, silakan upload ulang yang jelas.',
            ]);

        $response->assertRedirect(route('pegawai.dashboard'));
        $this->assertEquals('perlu_perbaikan', $pengajuan->fresh()->status);
        $this->assertEquals('Foto e-KTP buram, silakan upload ulang yang jelas.', $pengajuan->fresh()->catatan);
    }

    public function test_xai_service_returns_python_feature_contributions_and_model_metadata(): void
    {
        DataDukcapil::create([
            'nik'                 => '2171010101010003',
            'nama_lengkap'        => 'Bryan Sitorus',
            'tempat_lahir'        => 'Batam',
            'tanggal_lahir'       => '2004-05-12',
            'jenis_kelamin'       => 'Laki-laki',
            'kecamatan'           => 'Batam Kota',
            'kelurahan'           => 'Belian',
            'alamat_lengkap'      => 'Komp. Batam Centre No. 1',
            'status_kependudukan' => 'AKTIF',
            'kategori_wilayah'    => 'MAINLAND',
        ]);

        DataAkademik::create([
            'nik'                    => '2171010101010003',
            'nisn'                   => '0061234567',
            'nama_lengkap'           => 'Bryan Sitorus',
            'asal_sekolah'           => 'SMA Negeri 1 Batam',
            'tahun_lulus'            => 2025,
            'jalur_seleksi'          => 'SNBP',
            'nama_kampus_diterima'   => 'Universitas Indonesia',
            'program_studi_diterima' => 'Ilmu Komputer',
            'nilai_rata_rapor'       => 89.20,
            'status_kelulusan'       => 'DITERIMA',
        ]);

        $user = User::factory()->create();
        $pengajuan = Pengajuan::create([
            'user_id'          => $user->id,
            'nomor_registrasi' => 'BTM-SNBP-2026-0004',
            'jalur'            => 'SNBP',
            'nama_lengkap'     => 'Bryan Sitorus',
            'nik'              => '2171010101010003',
            'tempat_lahir'     => 'Batam',
            'tanggal_lahir'    => '2004-05-12',
            'jenis_kelamin'    => 'Laki-laki',
            'no_hp'            => '08123456789',
            'email'            => 'bryan@example.com',
            'kecamatan'        => 'Batam Kota',
            'kelurahan'        => 'Belian',
            'alamat_lengkap'   => 'Komp. Batam Centre No. 1',
            'nama_kampus'      => 'Universitas Indonesia',
            'program_studi'    => 'Ilmu Komputer',
            'nim'              => '2406012301',
            'semester'         => 1,
            'ipk_nilai'        => 89.20,
            'status'           => 'menunggu_verifikasi',
        ]);

        $analysis = XAIService::analyze($pengajuan);

        $this->assertArrayHasKey('feature_contributions', $analysis);
        $this->assertNotEmpty($analysis['feature_contributions']);
        $this->assertArrayHasKey('model_metadata', $analysis);
        $this->assertEquals('RandomForestClassifier', $analysis['model_metadata']['algorithm']);
    }

    public function test_pimpinan_can_approve_and_make_final_decision(): void
    {
        $pimpinan = User::factory()->create([
            'role'        => 'pimpinan',
            'employee_id' => 'PIMP001',
        ]);

        $pemohon = User::factory()->create();
        $pengajuan = Pengajuan::create([
            'user_id'          => $pemohon->id,
            'nomor_registrasi' => 'BTM-SNBP-2026-0005',
            'jalur'            => 'SNBP',
            'nama_lengkap'     => 'Calon Juara',
            'nik'              => '2171010101010004',
            'tempat_lahir'     => 'Batam',
            'tanggal_lahir'    => '2004-01-01',
            'jenis_kelamin'    => 'Laki-laki',
            'no_hp'            => '08123456789',
            'email'            => 'juara@example.com',
            'kecamatan'        => 'Batam Kota',
            'kelurahan'        => 'Belian',
            'alamat_lengkap'   => 'Batam Centre',
            'nama_kampus'      => 'Politeknik Negeri Batam',
            'program_studi'    => 'Informatika',
            'nim'              => '123459',
            'semester'         => 1,
            'status'           => 'menunggu_keputusan',
        ]);

        $response = $this->actingAs($pimpinan)
            ->post(route('pegawai.pengajuan.putuskan', $pengajuan->id), [
                'keputusan' => 'disetujui',
                'catatan'   => 'SK Walikota No. 123/2026 tentang Penerima Beasiswa Batam.',
            ]);

        $response->assertRedirect(route('pegawai.dashboard'));
        $this->assertEquals('disetujui', $pengajuan->fresh()->status);
        $this->assertStringContainsString('SK Walikota', $pengajuan->fresh()->catatan);
    }
}
