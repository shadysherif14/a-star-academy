<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Melihovv\Base64ImageDecoder\Base64ImageDecoder;

class Poster
{
    public static function generate($base64, $relativePath, $name = null)
    {
        $decoder = new Base64ImageDecoder($base64, $allowedFormats = ['jpeg', 'png', 'jpg']);

        $name = $name ?? str_random();

        $data = $decoder->getDecodedContent();

        $type = $decoder->getFormat();

        $path = "{$relativePath}/{$name}.{$type}";

        $check = Storage::disk('public')->put($path, $data);

        return $check ? $path : null;

    }
}
