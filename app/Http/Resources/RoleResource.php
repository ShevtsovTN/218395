<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'role' => $this->role,
            'permissions' => $this->permissions,
            'domain' => $this->domain,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'users' => RoleCollection::make($this->whenLoaded('users'))
        ];
    }
}
