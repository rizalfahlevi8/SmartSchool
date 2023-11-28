<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_absen',
        'kelas',
        'id_siswa',
        'created_at'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_siswa');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
