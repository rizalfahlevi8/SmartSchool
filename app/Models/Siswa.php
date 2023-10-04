<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'nisn',
        'nik',
        'nama',
        'no_telp',
        'nama_ayah',
        'nama_ibu',
        'nama_wali',
        'foto',
        'status',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'agama',
        'id_kelas',
        'id_angkatan',
        'id_user',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function data_angkatan()
    {
        return $this->belongsTo(Data_angkatan::class, 'id_angkatan', 'id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id', 'id_user');
    }
    public function detail_siswa()
    {
        return $this->hasOne(Detail_siswa::class, 'id_siswa', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $status = $filters['status'] ?? null;
        $kelas = $filters['kelas'] ?? null;

        if ($status) {
            $query->where('status', $status);
        }

        if ($kelas) {
            $query->where('id_kelas', $kelas);
        }
    }
}
