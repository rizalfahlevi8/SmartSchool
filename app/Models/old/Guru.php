<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'guru';
    protected $fillable = [
        'NIP',
        'nama',
        'password',
        'jk',
        'agama',
        'notelp',
        'tempatlahir',
        'tgllahir',
        'foto',
        'alamat'
    ];
    public function kelas()
    {
        return $this->hasMany(Kelas::class,'guru_id','id');
    }
  
}
