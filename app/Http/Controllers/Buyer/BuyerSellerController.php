<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerSellerController extends ApiController
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
        $sellers = $buyer->transactions()->with("product.seller")
            ->get() // obtine la lista de los vendedores en relacion al producto
            ->pluck("product.seller") // se obtine solo los vendedores
            ->unique('id'); // no se repiten y se compraran con el id

        if (!empty($sellers->value("id"))) {
            return $this->showAll($sellers);
        } else {
            return $this->errorResponse('ID not found', 404);
        }
    }
}
