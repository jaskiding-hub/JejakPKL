<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $table = 'industri';
    protected $primaryKey = 'id_industri';

    protected $fillable = [
        'nama_industri',
        'kategori',
        'lokasi',
        'gambar',
        'kontak',
        'instagram',
        'email_perusahaan',
        'alamat',
        'jumlah_siswa_pkl'
    ];

    public function detail()
    {
        return $this->hasOne(DetailIndustri::class, 'id_industri', 'id_industri');
    }
}