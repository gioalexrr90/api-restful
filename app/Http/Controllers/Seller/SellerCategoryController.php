<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Seller $seller)
    {
        $categories = $seller->products()
            ->with("categories")
            ->get()
            ->pluck('categories')
            ->collapse();

        //dd($categories);
        if (!$categories->unique()->value('id')) {
            return $this->errorResponse('ID not found', 404);
        }
        return $this->showAll($categories);
    }
}
