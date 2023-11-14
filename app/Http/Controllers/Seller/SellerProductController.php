<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Seller\StoreSellerProductRequest;
use App\Http\Requests\Seller\UpdateSellerProductRequest;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->successResponse($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSellerProductRequest $request, User $seller)
    {
        $data = $request->all();

        $data["status"] = false;
        $data["image"] = '1.jpg';
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->successResponse($product, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSellerProductRequest $request, Seller $seller, Product $product)
    {
        // Se validan los ID de vendedor y producto
        $this->sellerValidatio($seller, $product);

        $product->fill($request->only([
            'name',
            'description',
            'quantiy',
        ]));

        // Se valida el status del producto
        if ($request->status) {
            $product->status = $request->status;

            if ($product->product_is_available() && $product->categories()->count() == 0) {
                return $this->failureResponse('Available product must have at least one category', 409);
            }
        }

        // Se valida que se haya hecho algun cambio
        if ($product->isClean()) {
            return $this->failureResponse('Any chaneges register, you must update at least one changes', 422);
        }

        $product->save();

        return $this->successResponse($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller, Product $product)
    {
        $this->sellerValidatio($seller, $product);

        $product->delete();
        return $this->successResponse($product);
    }

    protected function sellerValidatio(Seller $seller, Product $product)
    {
        // Se validan los ID de vendedor y producto
        if ($seller->id != $product->seller_id) {
            throw new HttpException(422, 'Seller with id ' . $seller->id . ' not found');
        }
    }
}
