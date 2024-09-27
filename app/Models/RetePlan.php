<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RetePlan extends Model
{
    use HasFactory;
    protected $table = "rete_plans";
    protected $fillable = [
        "room_id",
        "name",
        "slug",
        "detail",
        "price"
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($room) {
            $room->slug = Str::slug($room->name);
            $baseSlug = $room->slug;
            $count = 1;

            while (self::where('slug', $room->slug)->exists()) {
                $room->slug = "{$baseSlug}-{$count}";
                $count++;
            }
        });
    }
    public function room(){
        return $this->belongsTo(Room::class,'room_id','id');
    }
}
