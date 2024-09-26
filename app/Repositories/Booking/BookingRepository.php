<?php

namespace App\Repositories\Booking;

use LaravelEasyRepository\Repository;

interface BookingRepository extends Repository{

    public function all();
    public function find($id);
    public function create($data);
    public function delete($id);
    public function update($id, array $data);
}
