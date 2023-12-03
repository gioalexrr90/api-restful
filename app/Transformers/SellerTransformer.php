<?php

namespace App\Transformers;

use App\Models\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller)
    {
        return [
            "identificador" => (int) $seller->id,
            "nombre" => (string) $seller->name,
            "correo" => (string) $seller->email,
            "estaVerificado" => (bool) $seller->verified,
            "fechaCreacion" => (string) $seller->created_at,
            "fechaActualizacion" => (string) $seller->updated_at,
            "fechaEliminacion" => isset($seller->deleted_at) ? (string) $seller->deleted_at : null,
        ];
    }
}
