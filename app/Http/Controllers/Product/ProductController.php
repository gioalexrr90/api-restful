<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;

class ProductController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showAll(Product::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->showOne($product);
    }
}
