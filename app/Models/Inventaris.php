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
        'id_ruang',  // Sesuaikan dengan foreign key di migrasi
        'id_daftarbarang'  // Sesuaikan dengan foreign key di migrasi
    ];

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id');  // Sesuaikan dengan foreign key di migrasi
    }

    public function daftarBarang()
    {
        return $this->belongsTo(DaftarBarang::class, 'id_daftarbarang', 'id');  // Sesuaikan dengan foreign key di migrasi
    }
}
