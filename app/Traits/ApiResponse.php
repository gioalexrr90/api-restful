<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data = [], int $status = 200)
    {
        return response([
            'success' => true,
            'data' => $data,
        ], $status);
    }

    protected function failureResponse($message, int $status = 422)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
