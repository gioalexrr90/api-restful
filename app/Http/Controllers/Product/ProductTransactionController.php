<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $transactions = $product->transactions()->get();
        if ($transactions->value('id') == null) {
            return $this->failureResponse("Product not found");
        }
        return $this->successResponse($transactions);
    }
}