<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponse;


class ApiController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
