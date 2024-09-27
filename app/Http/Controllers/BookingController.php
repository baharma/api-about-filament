<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Repositories\Booking\BookingRepository;
use App\Repositories\Calendar\CalendarRepository;
use App\Repositories\RatePlan\RatePlanRepository;
use App\Traits\RamdomHendler;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    use RamdomHendler;

    protected $repositoryBooking;
    protected $calendarRepository;
    protected $planRateRepository;

    public function __construct(
        BookingRepository $bookingRepository,
        RatePlanRepository $ratePlanRepository,
        CalendarRepository $calendarRepository
    ){
        $this->repositoryBooking = $bookingRepository;
        $this->planRateRepository = $ratePlanRepository;
        $this->calendarRepository = $calendarRepository;
    }

    public function index(){
        $bookings = $this->repositoryBooking->all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Calendar berhasil diambil.',
            'data' => BookingResource::collection($bookings)
        ]);
    }

    public function store(Request $request) {
        $calendarFind = $this->calendarRepository->find($request->calendar_id);
        $hasil = $calendarFind->availability - 1;
        $date = now()->format('Y-m-d');
        $randomNumber = rand(100000, 999999);
        $this->calendarRepository->update($request->calendar_id, [
            'availability' => $hasil ?? $calendarFind->availability
        ]);
        $booking = $this->repositoryBooking->create([
            'room_id' => $request->room_id,
            'rateplan_id' => $request->rateplan_id,
            'calendar_id' => $request->calendar_id,
            'reservation_number' =>"{$date}-{$randomNumber}-{$request->calendar_id}",
            'reservation_date' => $request->reservation_date,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Calendar berhasil Dibuat.',
            'data' => new BookingResource($booking)
        ]);
    }

    public function update($id, Request $request) {
        // Find the existing booking
        $bookingBefore = $this->repositoryBooking->find($id);

        // Check if the booking exists
        if (!$bookingBefore) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking not found.'
            ], 404);
        }

        // Find the previous calendar
        $calendarBefore = $this->calendarRepository->find($bookingBefore->calendar_id);

        // Update the previous calendar's availability
        $this->calendarRepository->update($bookingBefore->calendar_id, [
            'availability' => $calendarBefore->availability + 1
        ]);

        // Find the new calendar
        $calendarNow = $this->calendarRepository->find($request->calendar_id);

        // Check if the new calendar exists
        if (!$calendarNow) {
            return response()->json([
                'status' => 'error',
                'message' => 'New calendar not found.'
            ], 404);
        }

        // Update the new calendar's availability
        $this->calendarRepository->update($calendarNow->id, [
            'availability' => $calendarNow->availability - 1
        ]);

        // Generate reservation_number
        $date = now()->format('Y-m-d');
        $randomNumber = rand(100000, 999999);

        // Update the booking details
        $this->repositoryBooking->update($id, [
            'room_id' => $request->room_id,
            'rateplan_id' => $request->rateplan_id,
            'calendar_id' => $request->calendar_id,
            'reservation_number' => "{$date}-{$randomNumber}-{$id}", // Use booking ID for uniqueness
            'reservation_date' => $request->reservation_date,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);

        // Retrieve the updated booking
        $dataBooking = $this->repositoryBooking->find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Booking berhasil Update',
            'data' => new BookingResource($dataBooking)
        ]);
    }
    public function delete($id){
        $dataBooking = $this->repositoryBooking->find($id);
        $dataCalendar = $this->calendarRepository->find($dataBooking->calendar_id);
        $this->calendarRepository->update($dataBooking->calendar_id,[
            'availability' => $dataCalendar->availability + 1
        ]);
        $data = $this->repositoryBooking->delete($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data Booking berhasil Delete',
            'data' => $data
        ]);
    }

}
