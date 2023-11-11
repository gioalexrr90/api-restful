<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Buyer\BuyerCollection;
use App\Http\Resources\Buyer\BuyerResource;
use App\Models\Buyer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();
        return BuyerCollection::make($buyers);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        try {
            $seller = Buyer::has('transactions')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Buyer with id '.$id.' not exit']);
        }
        return BuyerResource::make($seller);
    }
}
