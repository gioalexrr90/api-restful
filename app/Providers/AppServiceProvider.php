<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;
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
        //JsonResource::withoutWrapping();

        User::created(function($user) {
            Mail::to($user)->send(new UserCreated($user));
        });

        User::updated(function($user) {
            if($user->isDirty('email')) {
                Mail::to($user)->send(new UserMailChanged($user));
            }
        });

        Product::updated(function (Product $product) {
            if ($product->quantity == 0 && $product->product_is_available()) {
                $product->status = false;

                $product->save();
            }
        });
    }
}
