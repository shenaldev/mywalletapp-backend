<?php

namespace App\Http\Helpers;

/**
 * Create Errors Array To Display Errors Of Validation And Other Errors
 * example: ['email' => ['The email has already been taken.']]
 * @param $error array need key and value
 * @return array of errors
 */

class ErrorResponse
{
    public static function errorList($error)
    {
        $errorList = [];
        foreach ($error as $key => $value) {
            $errorList[$key] = [$value];
        }
        return ["errors" => $errorList];
    }
}
