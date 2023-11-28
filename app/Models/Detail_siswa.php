<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_siswa extends Model
{
    use HasFactory;
    protected $table = 'detail_siswas';
    protected $fillable = [
        'asal_sekolah',
        'tanggal_masuk',
        'tanggal_keluar',
        'kelas_awal',
        'kelas_akhir',
        'id_siswa',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
}
