<?php

namespace App\Repositories\RatePlan;

use LaravelEasyRepository\Repository;

interface RatePlanRepository extends Repository{

    public function all();
    public function find($id);
    public function create($data);
    public function delete($id);
    public function updates($id, array $data);
}
