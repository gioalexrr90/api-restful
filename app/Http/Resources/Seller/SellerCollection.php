<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SellerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'collection' => $this->resource,
            'links' => [
                'self' => url('/api/sellers/'),
            ]
        ];
    }
}
