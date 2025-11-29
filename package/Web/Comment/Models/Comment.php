<?php
namespace Web\Comment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\User\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $guarded =
        ['body',
         'comment_type',
         'comment_id',
         'user_id',
         'parent_id'];


    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }

    public function child()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }


}
