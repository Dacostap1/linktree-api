<?php

namespace App\Services;

use Intervention\Image\Facades\Image;


class FileService
{
  public function updateImage($model, $request)
  {
    $image = Image::make($request->file('image'));

    if (!empty($model->image)) {
      $currentImage = public_path() . $model->image;

      if (file_exists($currentImage) && $currentImage != public_path() . '/default-avatar.jpeg' && $currentImage != public_path() . '/link-placeholder.png') {

        unlink($currentImage);
      }
    }

    $file = $request->file('image');
    $extension = $file->getClientOriginalExtension();

    $image->crop(
      $request->width,
      $request->height,
      $request->left,
      $request->top
    );

    $name = time() . '.' . $extension;
    $path = storage_path() . '/app/public/files/';
    $image->save($path . $name);

    $model->image = '/storage/files/' . $name;

    return $model;
  }
}
