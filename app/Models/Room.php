<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;
    protected $table = "rooms";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'feature',
        'published',
        'availability',
        'images'
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
}
