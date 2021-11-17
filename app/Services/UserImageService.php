<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use InterventionImage;


class UserImageService {
  public static function upload($imageFile, $folderName)
  {

    $filename1 = uniqid(rand().'_');
    $extension = $imageFile->extension(); 
    $filename = $filename1 . '.' . $extension;
    $resizedImage = InterventionImage::make($imageFile)->crop(500, 500)->encode();
    
    Storage::put('public/' . $folderName . '/' . $filename, $resizedImage );

    return $filename;
  }
}