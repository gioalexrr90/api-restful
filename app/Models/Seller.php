<?php

namespace App\Models;

use App\Transformers\SellerTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    use HasFactory;
    public $transformer = SellerTransformer::class;
    

    public function products()
    {
        return $this->hasMany(Product::class);
        
    }
}
