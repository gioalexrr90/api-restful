<?php

namespace App\Http\Resources\Buyer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerProductResource extends JsonResource
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
            "description" => $this->resource->description,
            "quantity" => $this->resource->quantity,
            "status" => $this->resource->status,
            "image" => $this->resource->image,
            "seller_id" => $this->resource->seller_id,
            /* "created_at" => $this->resource->created_at,
            "updated_at" => $this->resource->updated_at,
            "deleted_at" => $this->resource->deleted_at */
        ];
    }
}
