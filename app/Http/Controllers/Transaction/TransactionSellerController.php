<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Transaction\TransactionSellerResource;
use App\Models\Transaction;

class TransactionSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Transaction $transaction)
    {
        // Se obtiene el venderdor del productor de esta transacción
        $seller = $transaction->product->seller;
        return $this->showOne($seller);
    }
}
