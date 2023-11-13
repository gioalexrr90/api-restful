<?php

namespace App\Http\Resources\User;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
            'collection' => UserResource::collection($this->collection),
            'links' => [
                'self' => url('/api/users/'),
            ]
        ];
    }
}
