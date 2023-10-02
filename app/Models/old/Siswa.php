<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'siswa';

    protected $fillable = [
        'no_pendaftar',
        'nis',
        'nisn',
        'nik',
        'nama_ayah',
        'nama_ibu',
        'fullname',
        'bakat',
        'sekolah',
        'status',
        'alamat',
        'kelas_id',
        'password',
        'foto',
        'jk',
        'agama',
        'notelp'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
