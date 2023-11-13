<?php

use App\Http\Controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Buyers
Route::apiResource('buyers', BuyerController::class)->only('index', 'show');
Route::apiResource('buyers.transactions', BuyerTransactionController::class)->only('index');
Route::apiResource('buyers.products', BuyerProductController::class)->only('index');
Route::apiResource('buyers.sellers', BuyerSellerController::class)->only('index');
Route::apiResource('buyers.categories', BuyerCategoryController::class)->only('index');

// Category
Route::apiResource('categories', CategoryController::class)->except('create', 'edit');

// Product
Route::apiResource('products', ProductController::class)->only('index', 'show');

// Transaction
Route::apiResource('transactions', TransactionController::class)->only('index', 'show');
Route::apiResource('transactions.categories', TransactionCategoryController::class)->only('index');
Route::apiResource('transactions.sellers', TransactionSellerController::class)->only('index');

// Seller
Route::apiResource('sellers', SellerController::class)->except('create', 'edit');

// User
Route::apiResource('users', UserController::class)->except('create', 'edit');
