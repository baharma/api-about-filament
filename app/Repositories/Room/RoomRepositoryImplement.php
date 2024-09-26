<?php

namespace App\Repositories\Room;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Room;

class RoomRepositoryImplement extends Eloquent implements RoomRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function updates($id,array $data){

        $model = $this->model->find($id);
        // dd($model);
        if ($model) {
            return $model->update($data);
        }
    }
}
