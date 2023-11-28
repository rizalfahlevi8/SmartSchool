<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $table = 'ruangs';
    protected $fillable = [
        'nama_ruang',
        'luas',
        'lokasi'
    ];

    public function detail_jadwal()
    {
        return $this->hasMany(Detail_jadwal::class, 'id_ruang', 'id');
    }
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_ruang', 'id');
    }
}
