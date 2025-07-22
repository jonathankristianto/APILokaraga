<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $fillable = [
        'id',
        'nama',
        'email',
        'kata_sandi',
        'no_telp',
        'role_id'
    ];

    public function role () 
    {
        return $this->belongsTo(role::class,'role_id');
    }

    public function pesanan () 
    {
        return $this->hasMany(pesanan::class);
    }

    public function member () 
    {
        return $this->hasMany(member::class);
    }

    public function lapangan () 
    {
        return $this->hasOne(lapangan::class);
    }

    public function jenisMember ()
    {
        return $this->hasOne(jenismember::class);
    }

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
