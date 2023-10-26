<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Ruang;
use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_jadwal extends Model
{
    use HasFactory;

    protected $table = 'detail_jadwals';
    protected $fillable = [
        'jam_mulai',
        'jam_selesai',
        'keterangan',
        'id_ruang',
        'id_guru',
        'id_mapel',
        'id_jadwal'
    ];
    public function kelas()
    {
        return $this->belongsTo(Ruang::class, 'id_kelas', 'id');
    }
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id');
    }

    public static function todaySchedule($guruId)
    {
        $hari_list = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hari_ini = strtolower($hari_list[Carbon::now()->dayOfWeek]);
        // $hari_ini = 'senin';

        // return self::whereHas('jadwal', function ($query) use ($hari_ini, $guruId) {
        //     $query->where('hari', $hari_ini)
        //         ->where('id_guru', $guruId)->where('jam_mulai', '>', Carbon::now())->orWhere('jam_selesai', '>', Carbon::now())
        //         ->get();
        // });

        // return self::whereHas('jadwal', function ($query) use ($hari_ini) {
        //     $query->where('hari', $hari_ini);
        // })->where('jam_mulai', '>', Carbon::now())->orWhere('jam_selesai', '>', Carbon::now())->where('id_guru', $guruId)->get();
        return self::whereHas('jadwal')->where('id_guru', $guruId)->get();
    }
}
