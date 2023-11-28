<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_angkatan extends Model
{
    use HasFactory;
    protected $table = 'data_angkatans';

    protected $fillable = [
        'nama_angkatan',
        'tahun_masuk'
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_angkatan', 'id');
    }
}
