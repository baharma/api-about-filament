<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    protected $table = "calendars";
    protected $fillable = [
        'room_id',
        'rateplan_id',
        'date',
        'availability',
        'price'
    ];

    public function room(){
        return $this->belongsTo(Room::class, 'room_id','id');
    }
    public function rateplan(){
        return $this->belongsTo(RetePlan::class, 'rateplan_id','id');
    }
}
