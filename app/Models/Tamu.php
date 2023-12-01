<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Tamu extends Model
{
  use HasFactory;
  protected $table='tamu_tabel';

  protected $fillable = [
      'id',
      'nama',
      'alamat',
      'Opsi_Tujuan',
      'Keterangan',
      'Opsi_lanjutan',
      'created_at',
      'updated_at'
  ];
 
  // protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'Opsi_lanjutan', 'username');
    }

    // public function nama_tujuan()
    // {
    //     $user = User::where('username', $this->Opsi_lanjutan)->first();

    //     if ($user) {
    //         return $user->nama; // Ubah 'nama' sesuai dengan nama kolom pada model User
    //     }

    //     return $this->Opsi_lanjutan; // Jika tidak ditemukan, kembalikan nilai asli
    // }

    public function getNamaTujuanAttribute()
    {
        $user = User::where('username', $this->Opsi_lanjutan)->first();

        if ($user) {
            if ($user->role === 'guru' && $user->guru) {
                return $user->guru->nama;
            } elseif ($user->role === 'siswa' && $user->siswa) {
                return $user->siswa->nama;
            }
        }

        return null; // Atau berikan nilai default jika diperlukan
    }
}
