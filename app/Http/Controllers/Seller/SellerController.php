<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Seller\SellerCollection;
use App\Http\Resources\Seller\SellerResource;
use App\Models\Seller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = Seller::has('products')->get();
        return $this->successResponse(SellerCollection::make($sellers));
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $seller = Seller::has('products')->findOrFail($id);
        return $this->successResponse(SellerResource::make($seller));
    }
}
