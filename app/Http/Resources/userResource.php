<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $role = $this->whenLoaded('role');
        
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'kata_sandi' => $this->kata_sandi,
            'no_telp' => $this->no_telp,
            'role_id' => $role->nama_role
        ];
    }
}
