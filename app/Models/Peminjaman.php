<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'ruang_id',
        'nama_peminjam',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'surat',
        'status',
        'status_pengajuan'
    ];

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
}
