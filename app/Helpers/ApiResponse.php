<?php

namespace App\Helpers;

class ApiResponse
{
    /**
     * Trả về thành công với data kiểu object chứa result
     */
    public static function success($data = null, $message = "Success", $statusCode = 200)
    {
        return response()->json([
            'statusCode' => $statusCode,
            'message' => $message,
            'error' => null,
            'data' => [
                'result' => $data
            ]
        ], $statusCode);
    }

    public static function error($message, $statusCode = 400, $error = null)
    {
        return response()->json([
            'statusCode' => $statusCode,
            'message' => $message,
            'error' => $error,
            'data' => null
        ], $statusCode);
    }
}
