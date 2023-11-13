<?php

namespace App\Http\Resources\Buyer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerCategoryResource extends JsonResource
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
            /* "created_at" => $this->resource->created_at,
            "updated_at" => $this->resource->updated_at,
            "deleted_at" => $this->resource->deleted_at, */
            "pivot_table" => [
                "product_id" => $this->resource->pivot->product_id,
                "category_id" => $this->resource->pivot->category_id
            ]
        ];
    }
}
