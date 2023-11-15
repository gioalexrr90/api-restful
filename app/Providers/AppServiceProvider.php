<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Product::updated(function (Product $product) {
            if ($product->quantity == 0 && $product->product_is_available()) {
                $product->status = false;

                $product->save();
            }
        });
    }
}
