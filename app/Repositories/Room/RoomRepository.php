<?php

namespace App\Repositories\Room;

use LaravelEasyRepository\Repository;

interface RoomRepository extends Repository{

   public function all();
   public function find($id);
   public function create($data);
   public function delete($id);
   public function updates($id,array $data);
}
