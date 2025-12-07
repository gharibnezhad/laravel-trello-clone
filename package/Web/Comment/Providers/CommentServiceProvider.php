<?php
namespace  Web\Comment\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Web\Comment\Contracts\CommentInterface;
use Web\Comment\Models\Comment;
use Web\Comment\Policies\CommentPolicy;
use Web\Comment\Repositories\CommentRepository;
use Web\RolePermissions\Models\Permission;

class CommentServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/Comment-routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Comments');
        $this->app->bind(CommentInterface::class,CommentRepository::class);
        Gate::policy(Comment::class,CommentPolicy::class);
    }


    public function boot()
    {
        config()->set('sidebar.items.Comment',[
            'icon' => 'i-articles',
            'title' => 'کامنت ها',
            'url' => route('comments.index'),
            "permission" => [
                Permission::PERMISSION_SUPER_ADMIN,
            ]
        ]);
    }
}
