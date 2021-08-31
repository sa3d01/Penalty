<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FileService
{
    public static function upload($file, Model $model, String $collectionName, bool $removeOldFiles = true): String
    {
        if ($removeOldFiles) {
            $model->clearMediaCollection($collectionName);
        }
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $model->addMedia($file)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection($collectionName);
        return $model->getMedia($collectionName)->first()->getFullUrl('thumb');
    }

    public static function getFileUrl($file)
    {
        return url("public/" . $file->id . "/" . $file->file_name);
    }

}
