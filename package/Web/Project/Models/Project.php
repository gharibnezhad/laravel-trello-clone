<?php

namespace Web\Project\Models;

use Board;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\Category\Models\Category;
use Web\User\Models\User;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'is_archived'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
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
}
