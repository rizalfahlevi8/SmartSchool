<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_nilai extends Model
{
    use HasFactory;

    protected $table = 'detail_nilais';
    protected $fillable = [
        'nilai_akademik',
        'id_nilai',
        'id_mapel',
        'id_guru'
    ];

    // public function daftar_pengajar()
    // {
    //     return $this->belongsTo(Daftar_pengajar::class, 'id_mapel', 'id');
    // }

    public function nilai()
    {
        return $this->belongsTo(Nilai::class, 'id_nilai', 'id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }
}
