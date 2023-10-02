<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'id_guru',
        'deleted',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id', 'id_kelas');
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id', 'id_kelas');
    }
    // public function daftar_mengajar()
    // {
    //     return $this->hasMany(Daftar_pengajar::class, 'id_kelas', 'id');
    // }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }
}
