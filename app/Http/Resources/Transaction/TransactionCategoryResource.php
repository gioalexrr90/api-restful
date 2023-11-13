<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionCategoryResource extends JsonResource
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
            "deleted_at" => $this->resource->deleted_at,
            "pivot" => [
                "product_id" => $this->resource->pivot->product_id,
                "category_id" => $this->resource->pivot->category_id,
            ],
            "links" => [
                "self" => url('/api/categories/' . $this->getRouteKey())
            ], */
        ];
    }
}
