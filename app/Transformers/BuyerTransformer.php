<?php

namespace App\Transformers;

use App\Models\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            "identificador" => (int) $buyer->id,
            "nombre" => (string) $buyer->name,
            "correo" => (string) $buyer->email,
            "estaVerificado" => (bool) $buyer->verified,
            "fechaCreacion" => (string) $buyer->created_at,
            "fechaActualizacion" => (string) $buyer->updated_at,
            "fechaEliminacion" => isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null,
            "links" => [
                [
                    'rel' => 'self',
                    'href' => route('buyers.show', $buyer->id),
                ],
                [
                    'rel' => 'buyers.categories',
                    'href' => route('buyers.categories.index', $buyer->id),
                ],
                [
                    'rel' => 'buyers.products',
                    'href' => route('buyers.products.index', $buyer->id),
                ],
                [
                    'rel' => 'buyers.sellers',
                    'href' => route('buyers.sellers.index', $buyer->id),
                ],
                [
                    'rel' => 'buyers.transactions',
                    'href' => route('buyers.transactions.index', $buyer->id),
                ],
                [
                    'rel' => 'user',
                    'href' => route('users.show', $buyer->id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            "identificador" => 'id',
            "nombre" => 'name',
            "correo" => 'email',
            "estaVerificado" => 'verified',
            "fechaCreacion" => 'created_at',
            "fechaActualizacion" => 'updated_at',
            "fechaEliminacion" => 'deleted_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
