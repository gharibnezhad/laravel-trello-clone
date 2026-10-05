<?php
namespace Web\User\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Web\Board\Models\Board;
use Web\Board\Models\BoardUser;
use Web\Comment\Models\Comment;
use Web\Media\Models\Media;
use Web\Project\Models\Project;
use Web\Project\Models\ProjectUser;
use Web\Task\Models\Task;
use Web\TaskActivity\Models\TaskActivity;
use Web\User\Traits\HasEmailChangeConfirmation;
use Web\User\Traits\HasRolesAndPermissions;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,HasRolesAndPermissions,HasEmailChangeConfirmation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'username',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    const  STATUS_ACTIVE = 'active';
    const  STATUS_INACTIVE = 'inactive';


    public static $status =[
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->using(ProjectUser::class)
            ->withPivot('role_id')
            ->withTimestamps();
    }

    public function taskActivities()
    {
        return $this->hasMany(TaskActivity::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }

    public function image()
    {
        return $this->belongsTo(Media::class,'image_id');
    }

    public function boards()
    {
        return $this->belongsToMany(Board::class)
            ->using(BoardUser::class)
            ->withPivot('role_id')
            ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected static function newFactory()
    {
        return \Web\User\Database\Factories\UserFactory::new();
    }



}
