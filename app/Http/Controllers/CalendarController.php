<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalendarResource;
use App\Http\Resources\RatePlanResource;
use App\Repositories\Calendar\CalendarRepository;
use App\Repositories\RatePlan\RatePlanRepository;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    protected $repositoryCalendar;
    protected $repositoryRatePlan;

    public function __construct(
        CalendarRepository $repositoryCalendar,
        RatePlanRepository $ratePlanRepository
        ){
        $this->repositoryCalendar = $repositoryCalendar;
        $this->repositoryRatePlan = $ratePlanRepository;
    }

    public function index(){
        $data = $this->repositoryCalendar->all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Calendar berhasil diambil.',
            'data' => RatePlanResource::collection($data)
        ]);
    }

    public function create(Request $request){
        $price = $this->repositoryRatePlan->find($request->rateplan_id);
        $data = $this->repositoryCalendar->create([
            'room_id'=>$request->room_id,
            'rateplan_id'=>$request->rateplan_id,
            'date'=>$request->date,
            'availability'=>$request->availability,
            'price'=>$price->price
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Data Calendar berhasil ditambahkan.',
            'data' => new CalendarResource($data)
         ]);
    }

    public function update(Request $request, $id) {
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

        return response()->json([
            'status' => 'success',
            'message' => 'Data Calendar berhasil Update.',
            'data' => new CalendarResource($this->repositoryCalendar->find($id))
        ]);
    }

    public function delete($id){
        $data = $this->repositoryCalendar->delete($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data Calender berhasil Di Delete.',
            'data' => $data
        ]);
    }

}
