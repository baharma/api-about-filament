<?php

namespace App\Repositories\Room;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function updates($id, array $data)
{
  
    $sql = "UPDATE booking.rooms
            SET
                name = COALESCE(:name, name),
                slug = COALESCE(:slug, slug),
                description = COALESCE(:description, description),
                feature = COALESCE(:feature, feature),
                published = COALESCE(:published, published),
                availability = COALESCE(:availability, availability),
                images = COALESCE(:images, images),
                updated_at = NOW()
            WHERE id = :id";

  
    $params = [
        'name' => array_key_exists('name', $data) ? $data['name'] : null,
        'slug' => array_key_exists('slug', $data) ? $data['slug'] : null,
        'description' => array_key_exists('description', $data) ? $data['description'] : null,
        'feature' => array_key_exists('feature', $data) ? $data['feature'] : null,
        'published' => array_key_exists('published', $data) ? $data['published'] : null,
        'availability' => array_key_exists('availability', $data) ? $data['availability'] : null,
        'images' => array_key_exists('images', $data) ? $data['images'] : null,
        'id' => $id,
    ];

    try {
     
        $affected = DB::update($sql, $params);

        if ($affected) {
         
            $updatedModel = $this->model->find($id);
            return $updatedModel;
        } else {
          
            return null;
        }
    } catch (\Exception $e) {
     
        Log::error("Failed to update room with ID {$id}: " . $e->getMessage());
        return null;
    }
}


}
