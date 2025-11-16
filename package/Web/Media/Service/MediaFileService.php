<?php

namespace Web\Media\Service;

use Web\Media\Contracts\FileServiceContract;
use Web\Media\Models\Media;

class MediaFileService
{
    private static $file;
    private static $dir;

    private static $isPrivate;
    public static function privateUpload($file)
    {
        self::$file = $file;
        self::$dir = 'private/';
        self::$isPrivate = true;
        return self::upload();
    }

    public static function publicUpload($file)
    {
        self::$file = $file;
        self::$dir = 'public/';
        self::$isPrivate = false;
       return self::upload();
    }

    private static function upload()
    {
       $extension = self::normalizeExtension(self::$file);
       foreach (config('mediaFile.MediaTypeServices') as $key => $service){
           if (in_array($extension,$service['extensions'])){
               return self::uploadByHandler(new $service['handler'], $key);
           }
       }

    }

    public static function delete(Media $media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $service){
            if ($media->type == $type){
               $handler = $service['handler'];
               return $handler::delete($media);
            }
        }

    }

    public static function thumb(Media $media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $services){
            if ($media->type == $type){
               return $services["handler"]::thumb($media);
            }
        }

    }



    private static function normalizeExtension($file): string
    {
        return strtolower($file->getClientOriginalExtension());
    }

    private static function filenameGenerator()
    {
        return uniqid();
    }


    public static function uploadByHandler(FileServiceContract $service, int|string $key): Media
    {
        $media = new Media();
        $media->files = $service::upload(self::$file, self::filenameGenerator(), self::$dir);
        $media->type = $key;
        $media->user_id = auth()->id();
        $media->filename = self::$file->getClientOriginalName();
        $media->is_private = self::$isPrivate;
        $media->save();
        return $media;
    }

}
