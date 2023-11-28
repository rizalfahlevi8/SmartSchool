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
      'created_at',
      'updated_at'
  ];
 
  protected $guarded = [];
}
