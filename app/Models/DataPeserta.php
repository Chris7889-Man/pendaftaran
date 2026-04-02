<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeserta extends Model
{
    use HasFactory;
    protected $table = 'data_peserta';
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'angkatan',
        'jurusan',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'konsentrasi',
        'hobi',
        'alasan_masuk',
        'status_peserta',
        'status_pembayaran',
        'total_pembayaran',
    ];
}
