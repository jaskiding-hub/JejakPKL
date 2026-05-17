<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailIndustri extends Model
{
    protected $table = 'detail_industri';
    protected $primaryKey = 'id_detail';

    protected $fillable = ['id_industri', 'deskripsi', 'posisi_magang'];

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'id_industri', 'id_industri');
    }
}