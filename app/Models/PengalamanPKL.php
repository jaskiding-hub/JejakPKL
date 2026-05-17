<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengalamanPKL extends Model
{
    protected $table = 'pengalaman_pkl';
    protected $primaryKey = 'id_pengalaman';

    protected $fillable = [
        'nama_siswa', 'angkatan', 'jurusan',
        'nama_industri', 'cerita', 'file_laporan'
    ];
}