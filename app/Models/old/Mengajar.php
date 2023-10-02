<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mengajar extends Model
{
    use HasFactory;

    protected $table = 'jadwalmengajar';
    protected $fillable = [
        'kelas_id',
        'guru_id',
        'keterangan',
        'hari',
        'jamawal',
        'jamaakhir'   
    ];
    public function guru()
    {
        return $this->belongsTo(Guru::class,'guru_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
    // public function mapel()
    // {
    //     return $this->belongsTo(Mapel::class,'mapel_id');
    // }
}
