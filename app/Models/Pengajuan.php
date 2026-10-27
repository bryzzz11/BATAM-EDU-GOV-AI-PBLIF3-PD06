<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';

    protected $fillable = [
        'user_id',
        'nomor_registrasi',
        'jalur',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_hp',
        'email',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'nama_kampus',
        'program_studi',
        'nim',
        'semester',
        'ipk_nilai',
        'file_ktp',
        'file_raport',
        'file_utbk',
        'status',
        'catatan',
        'ocr_data',
        'xai_data',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'ocr_data' => 'array',
        'xai_data' => 'array',
        'ipk_nilai' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
