<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;

class TransactionSellerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
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
