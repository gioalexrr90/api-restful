<?php

namespace App\Http\Resources\User;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'collection' => UserResource::collection($this->collection),
            //$this->collection->collect()
        ];
    }
}
