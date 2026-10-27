<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Perbaiki kolom ipk_nilai dari DECIMAL(4,2) ke DECIMAL(5,2)
     * agar bisa menampung nilai maksimal 100.00 (bukan hanya 99.99).
     */
    public function up(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->decimal('ipk_nilai', 5, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->decimal('ipk_nilai', 4, 2)->nullable()->change();
        });
    }
};
