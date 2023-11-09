<?php

use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Buyers
Route::apiResource('buyers', BuyerController::class)->only('index', 'show');

// Category
Route::apiResource('categories', CategoryController::class)->except('create', 'edit');

// Product
Route::apiResource('products', ProductController::class)->only('index', 'show');

// Transaction
Route::apiResource('transactions', TransactionController::class)->only('index', 'show');

// Seller
Route::apiResource('sellers', SellerController::class)->except('create', 'edit');

// User
Route::apiResource('users', UserController::class)->except('create', 'edit');
