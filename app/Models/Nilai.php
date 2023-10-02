<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';

    protected $fillable = [
        'jenis_nilai',
        'kelas_ke',
        'sakit',
        'izin',
        'tanpa_keterangan',
        'id_siswa',
        'id_akademik'
    ];

    public function detail_nilai()
    {
        return $this->hasMany(Detail_nilai::class, 'id', 'id_nilai');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
    public function akademik()
    {
        return $this->belongsTo(Akademik::class, 'id_akademik', 'id');
    }
}
