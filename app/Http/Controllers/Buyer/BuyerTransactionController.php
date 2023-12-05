<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Buyer\BuyerTransactionResource;
use App\Models\Buyer;

use function PHPUnit\Framework\isEmpty;

class BuyerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transactions;
        if (!empty($transactions)) {
            return $this->showAll($transactions);
        } else {
            return $this->errorResponse('ID not Found', 404);
        }
    }
}
