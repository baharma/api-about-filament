<?php

namespace App\Repositories\RatePlan;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\RetePlan;

class RatePlanRepositoryImplement extends Eloquent implements RatePlanRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(RetePlan $model)
    {
        $this->model = $model;
    }

    public function updates($id, array $data){
        return $this->model->find($id)->update($data);
    }
}
