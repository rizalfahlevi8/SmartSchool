<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman_barang extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_barangs';

    protected $fillable = [
        'barang_id',
        'jumlah',
        'nama_peminjam',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'surat',
        'status',
        'status_pengajuan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
