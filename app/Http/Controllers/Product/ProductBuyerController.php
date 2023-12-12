<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;

class ProductBuyerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $buyers = $product->transactions()
            ->with("buyer")
            ->get()
            ->pluck("buyer")
            ->unique();

        //dd($buyers);
        if ($buyers->value('id') == null) {
            return $this->errorResponse('Buyer not found');
        }
        return $this->showAll($buyers);
    }
}
