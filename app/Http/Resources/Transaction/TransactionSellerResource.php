<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionSellerResource extends JsonResource
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
            /* "password" => $this->resource->password,
            "verified" => $this->resource->verified,
            "verification_token" => $this->resource->verification_token,
            "remember_token" => $this->resource->remember_token,
            "admin" => $this->resource->admin,
            "created_ad" => $this->resource->created_at,
            "updated_at" => $this->resource->updated_at,
            "deleted_at" => $this->resource->deleted_at,
            "links" => [
                "self" => url('/api/users/' . $this->resource->getRouteKey()),
            ] */
        ];
    }
}
