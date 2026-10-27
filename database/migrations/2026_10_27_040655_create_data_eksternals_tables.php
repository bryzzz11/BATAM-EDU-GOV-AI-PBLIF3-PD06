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
        // 1. Tabel Data Kependudukan Disdukcapil Kota Batam
        Schema::create('data_dukcapils', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->unique()->index();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->text('alamat_lengkap');
            $table->string('status_kependudukan')->default('AKTIF'); // AKTIF, TIDAK_AKTIF_PINDAH, dll
            $table->string('kategori_wilayah')->default('MAINLAND'); // HINTERLAND, MAINLAND
            $table->timestamps();
        });

        // 2. Tabel Data Pangkalan Akademik & Kelulusan Kemdikbud
        Schema::create('data_akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->index();
            $table->string('nisn', 20)->nullable()->index();
            $table->string('nama_lengkap');
            $table->string('asal_sekolah');
            $table->string('jurusan_sekolah')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->string('jalur_seleksi'); // SNBP, SNBT, HINTERLAND
            $table->string('nama_kampus_diterima');
            $table->string('program_studi_diterima');
            $table->decimal('nilai_rata_rapor', 5, 2)->nullable();
            $table->decimal('skor_utbk', 6, 2)->nullable();
            $table->string('status_kelulusan')->default('DITERIMA'); // DITERIMA, TIDAK_LOLOS
            $table->timestamps();
        });

        // 3. Tambahan kolom xai_data pada tabel pengajuans
        Schema::table('pengajuans', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuans', 'xai_data')) {
                $table->json('xai_data')->nullable()->after('ocr_data');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuans', 'xai_data')) {
                $table->dropColumn('xai_data');
            }
        });

        Schema::dropIfExists('data_akademiks');
        Schema::dropIfExists('data_dukcapils');
    }
};
