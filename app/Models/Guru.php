<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    use HasFactory;

    protected $table = "gurus";

    protected $fillable = [
        'nip',
        'nama',
        'no_telp',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'foto',
        'alamat',
        'signature',
        'deleted',
        'jabatan',
        'status',
        'id_user',
    ];

    // public function daftar_mengajar()
    // {
    //     return $this->hasMany(Daftar_pengajar::class, 'id_guru', 'id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_guru', 'id');
    }
}
