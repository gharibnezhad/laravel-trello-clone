<?php

namespace Web\Core\Console\Generator;

use Illuminate\Support\Facades\File;

class FileWriter
{

    public function write(string $directory,string $name,string $content)
    {
        File::ensureDirectoryExists($directory);

        $file =  $directory . DIRECTORY_SEPARATOR . $name . '.php';

        if (File::exists($file)){
            throw new \RuntimeException("Class [$name] already exists.");
        }

        File::put($file,$content);
    }
}
