<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'room'=>$this->room->name,
            'rateplan'=>$this->rateplan->name,
            'calendar'=>$this->calendar->date,
            'reservation_number'=>$this->reservation_number,
            'reservation_date'=>$this->reservation_date,
            'check_in'=>$this->check_in,
            'check_out'=>$this->check_out,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone_number'=>$this->phone_number
        ];
    }
}
