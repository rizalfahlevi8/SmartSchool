<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapels';
    protected $fillable = [
        'nama_mapel'
    ];

    // public function daftar_pengajar()
    // {
    //     return $this->hasMany(Daftar_pengajar::class, 'id_mapel', 'id');
    // }
    public function detail_nilai()
    {
        return $this->hasMany(Detail_nilai::class, 'id', 'id_mapel');
    }
}
