<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use InterventionImage;


class ImageService {
  public static function upload($imageFile, $folderName)
  {

    $filename1 = uniqid(rand().'_');
    $extension = $imageFile->extension(); 
    $filename = $filename1 . '.' . $extension;
    $resizedImage = InterventionImage::make($imageFile)->resize(1280, 866)->encode();
    
    Storage::disk('s3')->put('posts/' . $folderName . '/' . $filename, $resizedImage , 'public');

    return $filename;
  }
}
