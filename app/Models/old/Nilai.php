<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    
    protected $fillable = [
        'tugas1',
        'tugas2',
        'tugas3',
        'tugas4',
        'tugas5',
        'uts',
        'uas',
        'siswa_id',
        'kelas_id',
        'guru_id',
        'mapel_id',
        'semester',
        'rata_nilai',
        'nilai_huruf'
        
    ];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class,'mapel_id');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'siswa_id');
    }

}
