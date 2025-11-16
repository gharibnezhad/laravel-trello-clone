<?php
return [
    "MediaTypeServices" => [
        "image" => [
          "extensions" => [
              "jpg",'png','jpeg'
          ],
            "handler" => \Web\Media\Service\ImageFileService::class,
        ],
        "video" => [
            "extensions" => [
                'avi','mp4','mkv'
            ],
            "handler" => \Web\Media\Service\VideoFileService::class
        ],
        "zip" => [
            "extensions" => [
                'zip','rar','tar'
            ],
            "handler" => \Web\Media\Service\ZipFileService::class
        ]
    ]
];
