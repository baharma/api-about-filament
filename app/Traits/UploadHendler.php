<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait UploadHendler{

    function uploadImageHelper(UploadedFile $file, $path)
    {
        $filename = uniqid() . '_' . $file->getClientOriginalName();
        $file->storeAs($path, $filename, 'images_local');
        $FilePath = '/assets/images/' . $path . '/' . $filename;
        return $FilePath;
    }
}
