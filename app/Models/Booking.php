<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = "calendars";
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
}
