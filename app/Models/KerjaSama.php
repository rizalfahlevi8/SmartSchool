<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class KerjaSama extends Model
{
  use HasFactory;
  
  protected $table='mou_tabel';

  protected $fillable = [
      'id',
      'nama_mitra',
      'asal_mitra',
      'Deskripsi_singkat_mitra',
      'tanggal_mulai_kerjasama',
      'tanggal_berakhir_kerjasama',
      'PT_Mitra',
      'tujuan_mitra',
      'created_at',
      'updated_at',
      'original_name_file',
      'file'
  ];

  public static function rules()
    {
        return [
            'file' => 'nullable|mimes:doc,docx,pdf',
        ];
    }

}