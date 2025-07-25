<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class pesananResource extends JsonResource
{
    public function toArray($request)
    {
        $this->loadMissing(["user","lapangan","jadwal"]);
        $User = $this->user;
        $Lapangan = $this->lapangan;
        $Jadwal = $this->jadwal;

        return [
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'total_harga' => $this->total_harga,
            'user_id' => $User->nama,
            'lapangan_id' => $Lapangan->nm_lapangan,
            'jadwal_id' => [
                'jam_mulai' => $Jadwal->jam_mulai,
                'jam_selesai' => $Jadwal->jam_selesai,
            ]
        ];
    }
}
