<?php

namespace App\Http\Resources\Dashboard\Admin;

use App\Http\Resources\Dashboard\Role\SimpleRoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminIndexResource extends JsonResource
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
            'role' => new SimpleRoleResource($this->role),
            'phone' => $this->phone,
            'email' => $this->email,
            'created_at' => $this->created_at>format('Y-m-d H:i:s'),
        ];
    }
}
