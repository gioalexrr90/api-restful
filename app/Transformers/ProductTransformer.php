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
            "links" => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $product->id),
                ],
                [
                    'rel' => 'products.buyers',
                    'href' => route('products.buyers.index', $product->id),
                ],
                [
                    'rel' => 'products.categories',
                    'href' => route('products.categories.index', $product->id),
                ],
                [
                    'rel' => 'products.transactions',
                    'href' => route('products.transactions.index', $product->id),
                ],
                [
                    'rel' => 'sellers',
                    'href' => route('sellers.show', $product->seller_id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            "identificador" => 'id',
            "nombre" => 'name',
            "detalles" => 'description',
            "disponibles" => 'quantity',
            "activo" => 'status',
            "imagen" => 'image',
            "vendedor" => 'seller_id',
            "fechaCreacion" => 'created_at',
            "fechaActualizacion" => 'updated_at',
            "fechaEliminacion" => 'deleted_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
