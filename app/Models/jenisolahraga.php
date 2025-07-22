<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisolahraga extends Model
{
    use HasFactory;

    protected $table = 'jenis_olahraga';
    protected $fillable = [
        'nm_jenisolahraga'
    ];

    public function lapangan () 
    {
     return $this->hasMany(lapangan::class);
    }


}
