<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Product\StoreProductBuyerTransactionRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Transformers\TransactionTransformer;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:' . TransactionTransformer::class)->only(['store']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductBuyerTransactionRequest $request, Product $product, User $buyer)
    {
        if ($buyer->id == $product->seller->id) {
            return $this->errorResponse("Buyer and Seller must be differents.", 409);
        }

        if (!$buyer->isVerified()) {
            return $this->errorResponse("Buyer must be an verified user.", 409);
        }

        if (!$product->seller->isVerified()) {
            return $this->errorResponse("Seller must be an verified user.", 409);
        }

        if (!$product->product_is_available()) {
            return $this->errorResponse("Product is not available.", 409);
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorResponse("Product has not the quantity that you requires.", 409);
        }

        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transactions = Transaction::create([
                'quantity' => (int) $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            //dd($transactions);
            return $this->showAll($transactions, 201);
        });
    }
}
