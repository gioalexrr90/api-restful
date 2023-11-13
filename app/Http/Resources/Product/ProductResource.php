<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "description" => $this->description,
            "quantity" => $this->quantity,
            "status" => $this->status,
            "image" => $this->image,
            "seller_id" => $this->seller_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "link" => [
                "self" => url('/api/products/' . $this->getRouteKey()),
            ]
        ];
    }
}
