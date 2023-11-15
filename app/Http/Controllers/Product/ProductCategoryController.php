<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Product\UpdateProductCategoryRequest;
use App\Models\Category;
use App\Models\Product;

class ProductCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $categories = $product->categories()->get();
        return $this->successResponse($categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, Product $product, Category $category)
    {
        // Se agrega una categoria especificando el id de la categiria al producto
        $product->categories()->syncWithoutDetaching($category->id);
        $categories = $product->categories()->get();

        return $this->successResponse($categories);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Category $category)
    {
        if (!$product->categories()->find($category->id)) {
            return $this->failureResponse('Category id in products not found');
        }
        $product->categories()->detach($category->id);
        $categories = $product->categories()->get();

        return $this->successResponse($categories);
    }
}
