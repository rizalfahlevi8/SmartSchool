<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    use HasFactory;
    protected $table = 'akademiks';
    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'selected',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_akademik', 'id');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_akademik', 'id');
    }
}
