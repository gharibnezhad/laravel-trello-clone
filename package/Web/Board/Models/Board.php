<?php
namespace Web\Board\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\Project\Models\Project;
use App\Models\TaskList;

class Board extends Model
{
    use HasFactory;

    protected $guarded = [];

    const VISIBILITY_PRIVATE = 'private';
    const VISIBILITY_PUBLIC = 'public';
    const VISIBILITY_MEMBERS = 'members';

    public static function getVisibilities()
    {
        return [
            self::VISIBILITY_PRIVATE => 'private',
            self::VISIBILITY_PUBLIC => 'public',
            self::VISIBILITY_MEMBERS => 'members'
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function taskLists()
    {
        return $this->hasMany(TaskList::class);
    }

    public static function newFactory()
    {
        return \Web\Board\Database\Factories\BoardFactory::new();
    }
}
