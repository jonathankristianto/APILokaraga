<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class lapanganResource extends JsonResource
{
    public function toArray($request)
    {

        $this->loadMissing(["user","jenisolahraga"]);
        $User = $this->user;
        $Jenisolahraga = $this->jenisolahraga;

        return [
            'id' => $this->id,
            'nm_lapangan' => $this->nm_lapangan,
            'alamat' => $this->alamat,
            'harga' => $this->harga,
            'fasilitas' => $this->fasilitas,
            'jam_buka_operasional' => $this->jam_buka_operasional,
            'jam_tutup_operasional' => $this->jam_tutup_operasional,
            'foto' => $this->foto,
            'user_id' => $User->id,
            'user_nama' => $User->nama,
            'jenis_olahraga_id' => $Jenisolahraga->nm_jenisolahraga
        ];
    }
}