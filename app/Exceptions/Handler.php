<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        // Menangani error 404
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Halaman tidak ditemukan.',
                'data'=>[]
            ], 404);
        }

        // Menangani error 500
        if ($exception instanceof HttpException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada server.',
                'data'=>[]
            ], $exception->getStatusCode());
        }

        // Menangani error lainnya
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $exception->getMessage(),
            'data'=>[]
        ], 500);
    }

}
