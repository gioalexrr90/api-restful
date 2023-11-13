<?php

namespace App\Http\Resources\Buyer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerSellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->id,
            "name" => $this->resource->name,
            "email" => $this->resource->email,
            /* "email_verified_at" => $this->resource->email_verified_at,
            "verified" => $this->resource->verified,
            "admin" => $this->resource->admin,
            "created_at" => $this->resource->created_at,
            "updated_at" => $this->resource->updated_at,
            "deleted_at" => $this->resource->deleted_at */
        ];
    }
}
