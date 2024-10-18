<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatePlanRequest;
use App\Http\Resources\RatePlanResource;
use App\Repositories\RatePlan\RatePlanRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RatePlanController extends Controller
{
    use ApiResponse;
    protected $repositoryRatePlan;
    public function __construct(RatePlanRepository $repositoryRatePlan){
        $this->repositoryRatePlan = $repositoryRatePlan;
    }

    public function index(): JsonResponse{
        $rate = $this->repositoryRatePlan->all();
        return $this->apiSuccess(RatePlanResource::collection($rate),'api berhasil didapatkan');
    }

    public function creates(RatePlanRequest $request): JsonResponse{
        $rate = $this->repositoryRatePlan->create($request);
        return $this->apiSuccess(new RatePlanResource($rate),'data rate plan berhasil ditambah');
    }

    public function update(Request $request, $id) : JsonResponse{
        $affectedRows = $this->repositoryRatePlan->updates($id, [
            'name' => $request->name,
            'room_id' => $request->room_id,
            'price' => $request->price,
            'detail' => $request->detail,
        ]);
        if ($affectedRows > 0) {

            $rate = $this->repositoryRatePlan->find($id); // Assuming you have a find method

            return $this->apiSuccess(new RatePlanResource($rate),'data rete plant berhasil di update');
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No data was updated. Please check the ID or the data provided.',
            ], 404);
        }
    }
    public function delete($id): JsonResponse{
        $data = $this->repositoryRatePlan->delete($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data rate berhasil Di Delete.',
            'data' => $data
        ]);
    }

    public function findId(int $id): JsonResponse{
        $data = $this->repositoryRatePlan->find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data rate berhasil Di ambil .',
            'data' => $data
        ]);
    }
}
