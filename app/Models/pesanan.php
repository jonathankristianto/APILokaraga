<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'total_harga',
        'user_id',
        'lapangan_id',
        'jadwal_id'
    ];

    public function user () 
    {
        return $this->belongsTo(user::class,'user_id');
    }

    public function lapangan()
    {
        return $this->belongsTo(lapangan::class,'lapangan_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(jadwal::class,'jadwal_id');
    }
}
