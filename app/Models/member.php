<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $fillable = [
        'tgl_mulai',
        'tgl_selesai',
        'user_id',
        'jenismember_id'
    ];

    public function user () 
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function jenismember () 
    {
        return $this->belongsTo(jenismember::class, 'jenismember_id');
    }

    public function lapangan () 
    {
        return $this->belongsTo(lapangan::class);
    }
}
