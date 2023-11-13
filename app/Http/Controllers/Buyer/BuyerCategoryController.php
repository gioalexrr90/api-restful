<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Buyer\BuyerCategoryResource;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()->with("product.categories")
            ->get()
            ->pluck("product.categories")
            ->collapse()
            ->unique('id');

        if (!empty($categories->value("id"))) {
            return $this->successResponse(BuyerCategoryResource::collection($categories));
        } else {
            return $this->failureResponse('ID not found', 404);
        }
    }
}
