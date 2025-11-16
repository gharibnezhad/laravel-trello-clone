<?php
namespace Web\Project\Providers;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Web\Project\Database\Seeder\ProjectSeeder;
use Web\Project\Contracts\ProjectInterface;
use Web\Project\Models\Project;
use Web\Project\Policies\ProjectPolicy;
use Web\Project\Repositories\ProjectRepository;
use Web\RolePermissions\Models\Permission;

class ProjectServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Project');
        $this->loadRoutesFrom(__DIR__.'/../Routes/project-routes.php');
        $this->app->bind(ProjectInterface::class,ProjectRepository::class);
        DatabaseSeeder::$seeders[] = ProjectSeeder::class;
        Gate::policy(Project::class,ProjectPolicy::class);
    }

    public function boot()
    {
        Factory::guessFactoryNamesUsing(function ($modelName) {
            if (str_starts_with($modelName, 'Web\\Project\\')) {
                return 'Web\\Project\\Database\\Factories\\' . class_basename($modelName) . 'Factory';
            }

            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });

        config()->set('sidebar.items.projects',[
            "icon"=>"i-courses",
            "title"=>"پروژه ها",
            "url"=>route('projects.index'),
            "permission"=>[
                Permission::PERMISSION_SUPER_ADMIN,
                Permission::PERMISSION_MANAGE_OWN_PROJECT,
            ]
        ]);
    }
}
