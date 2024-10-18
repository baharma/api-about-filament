<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalendarResource;
use App\Http\Resources\RatePlanResource;
use App\Repositories\Calendar\CalendarRepository;
use App\Repositories\RatePlan\RatePlanRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    protected $repositoryCalendar;
    protected $repositoryRatePlan;
    use ApiResponse;

    public function __construct(
        CalendarRepository $repositoryCalendar,
        RatePlanRepository $ratePlanRepository
        ){
        $this->repositoryCalendar = $repositoryCalendar;
        $this->repositoryRatePlan = $ratePlanRepository;
    }

    public function index(): JsonResponse{
        $data = $this->repositoryCalendar->all();
        return $this->apiSuccess(RatePlanResource::collection($data),'data berhasil didapatkan');
    }

    public function create(Request $request): JsonResponse{
        $price = $this->repositoryRatePlan->find($request->rateplan_id);
        $data = $this->repositoryCalendar->create([
            'room_id'=>$request->room_id,
            'rateplan_id'=>$request->rateplan_id,
            'date'=>$request->date,
            'availability'=>$request->availability,
            'price'=>$price->price
        ]);
        return $this->apiSuccess(new CalendarResource($data),'Data Berhasil di tambahkan');
    }

    public function update(Request $request, $id): JsonResponse {
        $calendar = $this->repositoryCalendar->find($id);
        $price = $this->repositoryRatePlan->find($request->rateplan_id);

        $data = [
            'room_id' => $request->room_id ?? $calendar->room_id,
            'rateplan_id' => $request->rateplan_id ?? $calendar->rateplan_id,
            'date' => $request->date ?? $calendar->date,
            'availability' => $request->availability ?? $calendar->availability,
            'price' => $price->price ?? $calendar->price
        ];

        $this->repositoryCalendar->update($id, $data);

        return $this->apiSuccess(new CalendarResource($this->repositoryCalendar->find($id)),'data Berhasil di update');
    }
    public function delete($id): JsonResponse{
        $data = $this->repositoryCalendar->delete($id);
        return $this->apiSuccess($data,'data calendar berhasil di delete');
    }

    public function findId($id) : JsonResponse{
        $data = $this->repositoryCalendar->find($id);
        return $this->apiSuccess($data,'data calendar berhasil di find');
    }

}
