<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'tahun_pengadaan',
        'jenis',
        'jumlah_seluruh_barang',
        'id_ruang',
        'image'
    ];

    // Jika ada kolom tanggal 'created_at' dan 'updated_at', tambahkan kode berikut
    public $timestamps = true;

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id');
    }
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, 'barang_id', 'id');
    }
}
