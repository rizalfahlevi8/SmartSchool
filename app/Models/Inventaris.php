<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = [
        'nama_barang',
        'tahun_pengadaan',
        'jenis',
        'jumlah_barang',
        'jumlah_baik',
        'jumlah_rusak',
        'ruang_id',  
        'barang_id'  
    ];

    public function ruang()
    {
        return $this->belongsTo(ruangs::class, 'ruang_id', 'id');  
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
