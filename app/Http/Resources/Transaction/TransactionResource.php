<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            "quantity" => $this->quantity,
            "buyer_id" => $this->buyer_id,
            "product_id" => $this->product_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "links" => [
                "self" => url('/api/transactions/' . $this->getRouteKey()),
            ]
        ];
    }
}
