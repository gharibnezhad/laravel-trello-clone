<?php

namespace Web\Media\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Web\Media\Contracts\FileServiceContract;
use Web\Media\Models\Media;

class VideoFileService extends DefaultFileService implements FileServiceContract
{

    public static function upload(UploadedFile $file,$filename,$dir): array
    {
        Storage::putFileAs($dir,$file,$filename.'.'.$file->getClientOriginalExtension());
        return ["video" =>$filename . '.' . $file->getClientOriginalExtension()];
    }

}
