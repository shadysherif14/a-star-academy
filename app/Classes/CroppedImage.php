<?php

namespace App\Classes;

use Intervention\Image\Facades\Image;

class CroppedImage
{
    public static function create($uploadedImage, $relativePath, $name)
    {
        $image = Image::make($uploadedImage->getRealPath());

        $min = min($image->width(), $image->height());

        if (abs($image->width() - $image->height()) > 100) {
            $image->crop($min, $min, $min == $image->width() ? 0 : round($min / 4), $min == $image->height() ? 0 : round($min / 4));
        } else {
            $image->crop($min, $min, 0, 0);
        }

        $path = public_path("storage/$relativePath");

        $image->save("$path/$name.jpg");

        return "$relativePath/$name.jpg";

    }
}
