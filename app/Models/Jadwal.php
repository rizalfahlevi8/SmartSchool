<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Akademik;
use App\Models\Detail_jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
