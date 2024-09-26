<?php

namespace App\Repositories\Booking;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Booking;

class BookingRepositoryImplement extends Eloquent implements BookingRepository{
    protected $model;
    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

}
