<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;
    protected $table = 'raport';

    protected $fillable = [
        'sakit',
        'ijin',
        'tanpa_ket',
        'nilai_pth',
        'nilai_ktr',
        'nilai_huruf_pth',
        'nilai_huruf_ktr',
        'siswa_id',
        'mapel_id',
        'guru_id',
        'semester',
        'status'
        
    ];
    public function mapel()
    {
        return $this->belongsTo(Mapel::class,'mapel_id');
    }
}
