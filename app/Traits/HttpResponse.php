<?php

namespace App\Traits;

trait HttpResponse
{
    protected function success($data, $message, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function error($message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }
}
