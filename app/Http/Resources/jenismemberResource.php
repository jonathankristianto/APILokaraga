<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class jenismemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->whenLoaded('user');

        return [
            'id' => $this->id,
            'nm_membership' => $this->nm_membership,
            'masa_berlaku' => $this->masa_berlaku,
            'harga' => $this->harga,
            'deskripsi' => $this->deskripsi,
            'user_id' => $user->nama
        ];
    }
}
