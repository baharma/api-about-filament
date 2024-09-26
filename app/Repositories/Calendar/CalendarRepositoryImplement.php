<?php

namespace App\Repositories\Calendar;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Calendar;

class CalendarRepositoryImplement extends Eloquent implements CalendarRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Calendar $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
