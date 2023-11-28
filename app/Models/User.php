<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $table = 'users';

    protected $fillable = [
        'username',
        'deleted',
        'email',
        'password',
        'role',
        'current_role',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'string',
    ];

    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_user', 'id');
    }
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_user', 'id');
    }
    public function hasRole(...$roles)
    {
        return in_array($this->current_role, $roles);
    }

    // public function
}
