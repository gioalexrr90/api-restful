<?php

namespace App\Transformers;

use App\Models\Product;
use Illuminate\Contracts\Cache\Store;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
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
    public function transform(Product $product)
    {
        return [
            "identificador" => (int) $product->id,
            "nombre" => (string) $product->name,
            "detalles" => (string) $product->description,
            "disponibles" => (int) $product->quantity,
            "activo" => (bool) $product->status,
            "imagen" => isset($product->image) ? url("img/{$product->image}") : null,
            "vendedor" => (int) $product->seller_id,
            "fechaCreacion" => (string) $product->created_at,
            "fechaActualizacion" => (string) $product->updated_at,
            "fechaEliminacion" => isset($product->deleted_at) ? (string) $product->deleted_at : null,
        ];
    }
}
