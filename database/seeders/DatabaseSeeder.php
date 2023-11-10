<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('transactions')->truncate();

        DB::table('category_product')->truncate();

        $candidadUsuarios = 50;
        $cantidadCategorias = 30;
        $cantidadProductos = 30;
        $cantidadTransacciones = 30;

        User::factory($candidadUsuarios)->create();
        Category::factory($cantidadCategorias)->create();
        Product::factory($cantidadProductos)->create()->each(
            function ($producto) {
                $categoria = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $producto->categories()->attach($categoria);
            }
        );
        Transaction::factory($cantidadTransacciones)->create();
    }
}
