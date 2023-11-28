<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis';

    protected $fillable = [
        'status_absen',
        'keterangan',
        'kelas',
        'id_siswa',
        'id_akademik',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }

    public function akademik()
    {
        return $this->belongsTo(Akademik::class, 'id_akademik', 'id');
    }
}
