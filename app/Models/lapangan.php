<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';
    protected $fillable = [
        'nm_lapangan',
        'alamat',
        'harga',
        'fasilitas',
        'jam_buka_operasional',
        'jam_tutup_operasional',
        'foto',
        'user_id',
        'jenis_olahraga_id'
    ];

    public function jenisolahraga() 
    {
        return $this->belongsTo(jenisolahraga::class, 'jenis_olahraga_id');
    }

    public function jadwal() 
    {
        return $this->hasMany(jadwal::class);
    }

    public function pesanan ()
    {
        return $this->hasMany(pesanan::class);
    }

    public function user ()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

}
