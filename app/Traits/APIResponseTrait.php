<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait APIResponseTrait
{
    /* --- success method --- */
    protected function success(mixed $data, int $code = 200, string $msg = null): JsonResponse
    {

        return response()->json([
            'status' => 'success',
            'message' => $msg,
            'data' => $data
        ], $code);
    }

    /* --- failed method --- */
    protected function failed(mixed $data, int $code = 500, string $msg = null): JsonResponse
    {

        return response()->json([
            'status' => 'failed',
            'message' => $msg,
            'data' => $data
        ], $code);
    }
}
