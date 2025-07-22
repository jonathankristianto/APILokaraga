<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenismember extends Model
{
    use HasFactory;

    protected $table = 'jenis_member';
    protected $fillable = [
        'nm_membership',
        'masa_berlaku',
        'harga',
        'deskripsi',
        'user_id'
    ];

    public function member () 
    {
        return $this->belongsTo(member::class);
    }

    public function user() 
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
