<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\Seller\SellerCollection;
use App\Http\Resources\Seller\SellerResource;
use App\Models\Seller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = Seller::has('products')->get();
        return SellerCollection::make($sellers);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        try {
            $seller = Seller::has('products')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Seller with id '.$id.' not exit']);
        }
        return SellerResource::make($seller);
    }
}
