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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nomor_registrasi')->unique();
            $table->string('jalur'); // SNBP, SNBT, HINTERLAND
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->string('email');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->text('alamat_lengkap');
            $table->string('nama_kampus');
            $table->string('program_studi');
            $table->string('nim');
            $table->unsignedTinyInteger('semester')->default(1);
            $table->decimal('ipk_nilai', 4, 2)->nullable();
            
            // File uploads
            $table->string('file_ktp')->nullable();
            $table->string('file_raport')->nullable();
            $table->string('file_utbk')->nullable();
            
            // Status & AI OCR Metadata for future steps
            $table->string('status')->default('menunggu_verifikasi'); // menunggu_verifikasi, terverifikasi, ditolak
            $table->text('catatan')->nullable();
            $table->json('ocr_data')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
