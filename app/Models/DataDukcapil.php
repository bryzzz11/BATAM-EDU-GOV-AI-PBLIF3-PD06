<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDukcapil extends Model
{
    use HasFactory;

    protected $table = 'data_dukcapils';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'status_kependudukan',
        'kategori_wilayah',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
