<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = "bookings";
    protected $fillable = [
        'room_id',
        'rateplan_id',
        'calendar_id',
        'reservation_number',
        'reservation_date',
        'check_in',
        'check_out',
        'name',
        'email',
        'phone_number'
    ];

    public function room(){
        return $this->belongsTo(Room::class, 'room_id','id');
    }
    public function rateplan(){
        return $this->belongsTo(RetePlan::class, 'rateplan_id','id');
    }
    public function calendar(){
        return $this->belongsTo(Calendar::class, 'calendar_id','id');
    }
}
