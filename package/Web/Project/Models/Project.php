<?php

namespace Web\Project\Models;

use Web\Board\Models\Board;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\Category\Models\Category;
use Web\Comment\Models\Comment;
use Web\Media\Models\Media;
use Web\User\Models\User;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'is_archived',
        'file_id',
        'visibility'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(ProjectUser::class)
            ->withPivot('role_id')
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function boards()
    {
        return $this->hasMany(Board::class);
    }

    public static function newFactory()
    {
        return \Web\Project\Database\Factories\ProjectFactory::new();
    }

    public function media()
    {
        return $this->belongsTo(Media::class,'file_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable')->whereNull('parent_id');
    }
}
