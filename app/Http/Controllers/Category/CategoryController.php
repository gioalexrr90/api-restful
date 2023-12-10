<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Transformers\CategoryTransformer;

class CategoryController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:' . CategoryTransformer::class)->only(['store']);
    }

    //use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return CategoryCollection::make(Category::all())->response()->setStatusCode(200);
        return $this->showAll(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return $this->showOne($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Solo aceptara los valores de name y descrpition para actualizar
        $category->fill($request->only('name', 'description'));

        if($category->isClean())
        {
            return $this->showMessage('There are not any changes');
        }

        $category->save();

        return $this->showOne($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
