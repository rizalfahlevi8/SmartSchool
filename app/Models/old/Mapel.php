<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $fillable = [
        'kodemapel',
        'namamapel',
       
    ];
    public static function getId(){
       return $getId = DB::table('mapel')->orderBy('id','DESC')->take(1)->get();
       // $data = Mapel::orderBy('id','DESC')->first();
        
    }
}
