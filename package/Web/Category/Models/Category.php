<?php

namespace Web\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\Category\Database\Factories\CategoryFactory;
use Web\Project\Models\Project;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public static function newFactory()
    {
        return \Web\Category\Database\Factories\CategoryFactory::new();
    }
}
