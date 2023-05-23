<?php

namespace App\Http\Resources\API\Dashboard\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            // 'role' => new SimpleRoleResource($this->role),
            'created_at' => $this->created_at>format('Y-m-d H:i:s'),
        ];
    }
}
