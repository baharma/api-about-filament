<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatePlanRequest;
use App\Http\Resources\RatePlanResource;
use App\Repositories\RatePlan\RatePlanRepository;
use Illuminate\Http\Request;

class RatePlanController extends Controller
{
    protected $repositoryRatePlan;
    public function __construct(RatePlanRepository $repositoryRatePlan){
        $this->repositoryRatePlan = $repositoryRatePlan;
    }

    public function index(){
        $rate = $this->repositoryRatePlan->all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data rate berhasil diambil.',
            'data' => RatePlanResource::collection($rate)
        ]);
    }

    public function creates(RatePlanRequest $request){
        $rate = $this->repositoryRatePlan->create([
            'name' => $request->name,
            'room_id' => $request->room_id,
            'price' => $request->price,
            'detail' => $request->detail,
        ]);
        return response()->json([
           'status' => 'success',
           'message' => 'Data rate berhasil ditambahkan.',
            'data' => new RatePlanResource($rate)
        ]);
    }

    public function update(Request $request, $id){
        $affectedRows = $this->repositoryRatePlan->updates($id, [
            'name' => $request->name,
            'room_id' => $request->room_id,
            'price' => $request->price,
            'detail' => $request->detail,
        ]);

        // Check if any rows were affected
        if ($affectedRows > 0) {
            // Optionally, retrieve the updated rate plan if needed
            $rate = $this->repositoryRatePlan->find($id); // Assuming you have a find method

            return response()->json([
                'status' => 'success',
                'message' => 'Data rate berhasil diupdate.',
                'data' => new RatePlanResource($rate)
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No data was updated. Please check the ID or the data provided.',
            ], 404);
        }
    }
    public function delete($id){
        $data = $this->repositoryRatePlan->delete($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data rate berhasil Di Delete.',
            'data' => $data
        ]);
    }
}
