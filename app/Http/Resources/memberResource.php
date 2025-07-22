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
        $user = $this->whenLoaded('user');
        $jenismember = $this->whenLoaded('jenismember');

        return [
            'id' => $this->id,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
            'user_id' => $user->nama,
            'jenismember_id' => $jenismember->nm_membership
        ];
    }
}
