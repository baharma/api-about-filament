<?php

namespace App\Repositories\Calendar;

use LaravelEasyRepository\Repository;

interface CalendarRepository extends Repository{

    public function all();
    public function find($id);
    public function create($data);
    public function delete($id);
    public function update($id, array $data);
}
