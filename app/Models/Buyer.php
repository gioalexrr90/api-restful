<?php

namespace App\Models;

use App\Transformers\BuyerTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buyer extends User
{
    use HasFactory;
    public $transformer = BuyerTransformer::class;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
