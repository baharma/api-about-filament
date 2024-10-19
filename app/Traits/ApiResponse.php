<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse{

    /**
     * API Response Success
     * @param array|null $data
     * @param string|null $message
     * @return JsonResponse
     */
    public function apiSuccess(mixed $data = [], string $message = null): JsonResponse
    {
        return $this->buildResponse($data, $message);
    }

    /**
     * Build Response API
     * @param array|null $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    private function buildResponse(mixed $data = [], string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            "status" => $code,
            "data" => $data ?? [],
            "message" => $message ?? "OK"
        ], $code);

    }

    /**
     * API Response Error
     * @param array|null $data
     * @param string|null $message
     * @return JsonResponse
     */
    public function apiError(array|null $data = [], string $message = null): JsonResponse
    {
        return $this->buildResponse($data, $message, 400);
    }

    /**
     * API Response Unauthorized
     * @param array|null $data
     * @param string|null $message
     * @return JsonResponse
     */

    public function apiUnauthorized(array|null $data = [], string $message = null): JsonResponse
    {
        return $this->buildResponse($data, $message, 401);
    }

    /**
     * API Response Pagination
     * @param LengthAwarePaginator $data
     * @return JsonResponse
     */
    public function apiPagination(LengthAwarePaginator $data): JsonResponse
    {
        $build = [
            "current_page" => $data->currentPage(),
            "data" => $data->items(),
            "total" => $data->total(),
            "per_page" => $data->perPage(),
            "last_page" => $data->lastPage(),
        ];
        return response()->json($build);
    }
}
