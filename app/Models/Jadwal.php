<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $fillable = [
        'status',
        'catatan',
        'hari',
        'id_akademik',
        'id_kelas'
    ];

    public function detail_jadwal()
    {
        return $this->hasMany(Detail_jadwal::class, 'id_jadwal', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
    public function akademik()
    {
        return $this->belongsTo(Akademik::class, 'id_akademik', 'id');
    }
}
