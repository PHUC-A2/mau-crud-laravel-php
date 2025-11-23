<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Helpers\ApiResponse;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (Throwable $exception, $request) {

            // Validation lỗi
            if ($exception instanceof ValidationException) {
                return ApiResponse::error(
                    "Dữ liệu không hợp lệ",
                    422,
                    $exception->errors()
                );
            }

            // Không tìm thấy model
            if ($exception instanceof ModelNotFoundException) {
                return ApiResponse::error(
                    "Không tìm thấy dữ liệu",
                    404
                );
            }

            // Lỗi server
            $statusCode = ($exception instanceof HttpException)
                ? $exception->getStatusCode()
                : 500;

            if (config('app.debug')) {
                return ApiResponse::error($exception->getMessage(), $statusCode);
            }

            return ApiResponse::error("Có lỗi xảy ra trên server", $statusCode);
        });
    }
}
