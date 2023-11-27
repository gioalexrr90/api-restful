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
        ];
    }
}
