<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class jadwalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lapangan = $this->whenLoaded('lapangan');

        return [
            'id' => $this->id,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'lapangan_id' => $lapangan->nm_lapangan
        ];
    }
}
