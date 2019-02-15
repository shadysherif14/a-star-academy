<?php

namespace Melihovv\Base64ImageDecoder\Exceptions;

class NotBase64Encoding extends CodingFailedException
{
    public static function create($message = '', $code = 0, $previous = null)
    {
        return new self($message ?: 'Image is not in base64 encoding.', $code, $previous);
    }
}
