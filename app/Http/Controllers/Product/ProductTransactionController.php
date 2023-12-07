<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;

class ProductTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $transactions = $product->transactions()->get();
        if ($transactions->value('id') == null) {
            return $this->errorResponse("Product not found");
        }
        return $this->showAll($transactions);
    }
}
