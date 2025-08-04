<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class memberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->loadMissing(["user","jenismember","lapangan"]);
        $User = $this->user;
        $Jenismember = $this->jenismember;
        $Lapangan = $this->lapangan;

        return [
            'id' => $this->id,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
            'user_id' => $User->nama,
            'lapangan_id' => $Lapangan->nm_lapangan,
            'jenismember_id' => $Jenismember->nm_membership
        ];
    }
}
