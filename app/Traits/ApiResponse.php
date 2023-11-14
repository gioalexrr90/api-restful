<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data = [], int $status = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ], $status);
    }

    protected function failureResponse($message, int $status = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }
}
