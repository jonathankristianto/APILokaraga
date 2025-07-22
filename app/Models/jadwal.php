<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lapangan_id'
    ];

    public function lapangan() 
    {
        return $this->belongsTo(lapangan::class, 'lapangan_id');
    }

    public function pesanan() 
    {
        return $this->belongsTo(pesanan::class);
    }
}