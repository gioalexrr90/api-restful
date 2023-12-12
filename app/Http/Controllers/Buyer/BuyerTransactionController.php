<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

use function PHPUnit\Framework\isEmpty;

class BuyerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
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
