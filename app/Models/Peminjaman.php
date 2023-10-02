<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruang_id',
        'nama_peminjam',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
    ];

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
}
