<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Buyer\BuyerCollection;
use App\Http\Resources\Buyer\BuyerResource;
use App\Models\Buyer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();
        return $this->successResponse(BuyerCollection::make($buyers));
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        try {
            $seller = Buyer::has('transactions')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->failureResponse('Buyer with id '.$id.' not exit', 404);
        }
        return $this->successResponse(BuyerResource::make($seller));
    }
}
