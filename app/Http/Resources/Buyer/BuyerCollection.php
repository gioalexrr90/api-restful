<?php

namespace App\Http\Resources\Buyer;

use App\Http\Resources\Buyer\BuyerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BuyerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // Se llama a "collection" ya que "data" necesita recibir una colección de datos
            'collection' => $this->resource,
            'links' => [
                'self' => url('/api/buyers/'),
            ]
        ];
    }
}
