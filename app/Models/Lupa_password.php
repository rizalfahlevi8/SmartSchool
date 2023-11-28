<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lupa_password extends Model
{
    use HasFactory;
    protected $table = 'lupa_passwords';
    protected $fillable = [
        'id_user',
        'token',
        'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
