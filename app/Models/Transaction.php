<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id',
    ];

    // Se relaciona la tabla Transaction uno a uno con Buyer (un Buyer/Comprador) solo puede tener una Transaccion
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    // Se relaciona la tabla Transaction uno a uno con Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
