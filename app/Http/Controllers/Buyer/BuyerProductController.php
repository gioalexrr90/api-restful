<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Buyer\BuyerProductResource;
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
        if (!empty($product->value('id'))) {
            return $this->successResponse(BuyerProductResource::collection($product));
        } else {
            return $this->failureResponse('ID not Found', 404);
        }
    }
}