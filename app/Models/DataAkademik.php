<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAkademik extends Model
{
    use HasFactory;

    protected $table = 'data_akademiks';

    protected $fillable = [
        'nik',
        'nisn',
        'nama_lengkap',
        'asal_sekolah',
        'jurusan_sekolah',
        'tahun_lulus',
        'jalur_seleksi',
        'nama_kampus_diterima',
        'program_studi_diterima',
        'nilai_rata_rapor',
        'skor_utbk',
        'status_kelulusan',
    ];

    protected $casts = [
        'nilai_rata_rapor' => 'float',
        'skor_utbk' => 'float',
    ];
}
