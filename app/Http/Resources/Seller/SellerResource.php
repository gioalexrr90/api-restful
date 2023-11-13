<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
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
            "links" => [
                "self" => url('/api/sellers/'.$this->getRouteKey()),
            ]
        ];
    }
}