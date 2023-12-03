<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponse
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, int $code = 422)
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'error' => $message
        ], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse($collection, $code);
        }
        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);
        //$collection = $this->sortData($collection);
        return $this->successResponse($collection, $code);
    }

    protected function showOne($instance, $code = 200)
    {
        return $this->successResponse(['data' => $instance], $code);
    }

    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function sortData(Collection $collection)
    {
        if (request()->has('sort_by')) {
            $attribute = request()->sort_by;
            $collection = $collection->sortBy($attribute);
        }
        return $collection;
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }
}
