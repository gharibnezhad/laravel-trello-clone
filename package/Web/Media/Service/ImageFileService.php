<?php

namespace Web\Media\Service;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Web\Media\Contracts\FileServiceContract;
use Web\Media\Models\Media;

class ImageFileService extends DefaultFileService implements FileServiceContract
{
    protected static $sizes = ['300','600'];

    public static function upload($file,$filename,$dir): array
    {
        Storage::putFileAs($dir,$file,$filename .'.'. $file->getClientOriginalExtension());
        $path = $dir . $filename . '.' . $file->getClientOriginalExtension();
      return self::resize(Storage::path($path),$dir, $filename, $file->getClientOriginalExtension());

    }

    private static function resize($img,$dir, $filename, $extension)
    {
        $img = Image::read($img);
        $images['original'] = $filename . '.' . $extension;;
        foreach (self::$sizes as $size){
            $images[$size] =  $filename . '_' . $size . '.' . $extension;
            $img->scale($size,null,function ($aspect){
                $aspect->aspectRatio();
            })->save(Storage::path($dir) . $filename .'_' . $size . '.' .$extension);
        }
        return $images;
    }

    public static function thumb(Media $media)
    {
        return '/storage/'.$media->files[300];
    }


}
