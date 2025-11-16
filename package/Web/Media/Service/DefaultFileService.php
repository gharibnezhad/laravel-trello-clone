<?php

namespace Web\Media\Service;

use Illuminate\Support\Facades\Storage;


class DefaultFileService
{

    public static function delete($media)
    {
        foreach ($media->files as $file){
                $path = ($media->is_private ? 'private\\' : 'public\\') . $file;
                Storage::delete($path);

        }

    }

}
