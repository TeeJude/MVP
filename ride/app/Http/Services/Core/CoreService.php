<?php

namespace App\Http\Services\Core;

class CoreService
{
    public static function upload($path, string $fieldName, $request)
    {

        $file = $request->file($fieldName);
        $fileName = $file->getClientOriginalName();

        $file_name = time() . '-' . $fileName;

        $databasePath = $path . '/' . $file_name;

        $file->move(public_path($path), $file_name);
        return  $databasePath;
    }
}