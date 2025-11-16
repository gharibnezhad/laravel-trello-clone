<?php

namespace Web\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\Media\Service\MediaFileService;
use Web\Project\Models\Project;

class Media extends Model
{
    use HasFactory;

    protected $casts =[
        'files' => 'json'
    ];

    protected static function booted()
    {
        static::deleting(function ($media){
            MediaFileService::delete($media);
        });
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getThumbAttribute()
    {
        return MediaFileService::thumb($this);
    }
}
