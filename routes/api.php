<?php

use App\Http\Controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Category\CategoryBuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Category\CategorySellerController;
use App\Http\Controllers\Category\CategoryTransactionController;
use App\Http\Controllers\Product\ProductBuyerController;
use App\Http\Controllers\Product\ProductBuyerTransactionController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductTransactionController;
use App\Http\Controllers\Seller\SellerBuyerController;
use App\Http\Controllers\Seller\SellerCategoryController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Passport;

// Buyers
Route::apiResource('buyers', BuyerController::class)->only('index', 'show');
Route::apiResource('buyers.transactions', BuyerTransactionController::class)->only('index');
Route::apiResource('buyers.products', BuyerProductController::class)->only('index');
Route::apiResource('buyers.sellers', BuyerSellerController::class)->only('index');
Route::apiResource('buyers.categories', BuyerCategoryController::class)->only('index');

// Category
Route::apiResource('categories', CategoryController::class)->except('create', 'edit');
Route::apiResource('categories.products', CategoryProductController::class)->only('index');
Route::apiResource('categories.sellers', CategorySellerController::class)->only('index');
Route::apiResource('categories.transactions', CategoryTransactionController::class)->only('index');
Route::apiResource('categories.buyers', CategoryBuyerController::class)->only('index');

// Product
Route::apiResource('products', ProductController::class)->only('index', 'show');
Route::apiResource('products.transactions', ProductTransactionController::class)->only('index');
Route::apiResource('products.buyers', ProductBuyerController::class)->only('index');
Route::apiResource('products.buyers.transactions', ProductBuyerTransactionController::class)->only('store');
Route::apiResource('products.categories', ProductCategoryController::class)->only('index', 'update', 'destroy');

// Transaction
Route::apiResource('transactions', TransactionController::class)->only('index', 'show');
Route::apiResource('transactions.categories', TransactionCategoryController::class)->only('index');
Route::apiResource('transactions.sellers', TransactionSellerController::class)->only('index');

// Seller
Route::apiResource('sellers', SellerController::class)->except('create', 'edit');
Route::apiResource('sellers.products', SellerProductController::class)->except('show');
Route::apiResource('sellers.transactions', SellerTransactionController::class)->only('index');
Route::apiResource('sellers.categories', SellerCategoryController::class)->only('index');
Route::apiResource('sellers.buyers', SellerBuyerController::class)->only('index');


// User
Route::apiResource('users', UserController::class)->except('create', 'edit');
Route::get('users/verify/{token}', [UserController::class, 'verify'])->name('verify');
Route::get('users/{user}/resend', [UserController::class, 'resend'])->name('resend');

Route::group([
    null,
    'prefix' => 'oauth/api',
    'namespace' => '\Laravel\Passport\Http\Controllers',
], function () {
    // Passport routes...
    Route::post('oauth/token', [AccessTokenController::class, 'issueToken']);
});
Route::post('oauth/token', [AccessTokenController::class, 'issueToken']);
