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
            "id" => $this->getRouteKey(),
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "verified" => $this->verified,
            "verification_token" => $this->verification_token,
            "remember_token" => $this->remember_token,
            "admin" => $this->admin,
            "created_ad" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "links" => [
                "self" => url('/api/users/'.$this->resource->getRouteKey()),
            ]
        ];
    }
}
