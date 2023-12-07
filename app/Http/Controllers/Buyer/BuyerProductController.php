<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Buyer $buyer)
    {
        $product = $buyer->transactions()->with('product')->get()->pluck('product');
        //dd($product);
        return $this->showAll($product);

    }
}
