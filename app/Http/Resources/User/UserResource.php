<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->getRouteKey(),
            "name" => $this->resource->name,
            "email" => $this->resource->email,
            "verified" => $this->resource->verified,
            "admin" => $this->resource->admin,
            "links" => [
                "self" => url('/api/users/'.$this->resource->getRouteKey()),
            ]
        ];
    }
}
