<?php

namespace Web\Category\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Web\Category\Database\Seeder\CategorySeeder;
use Web\Category\Contracts\CategoryInterface;
use Web\Category\Models\Category;
use Web\Category\Policies\CategoryPolicy;
use Web\Category\Repositories\CategoryRepository;
use Web\RolePermissions\Models\Permission;

class CategoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Category');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/category-routes.php');
        Factory::guessFactoryNamesUsing(function ($modelName) {
            if (str_starts_with($modelName, 'Web\\Category\\')) {

                return 'Web\\Category\\Database\\Factories' . class_basename($modelName) . 'Factory';
            }
            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });
        DatabaseSeeder::$seeders[] = CategorySeeder::class;
        $this->app->bind(CategoryInterface::class,CategoryRepository::class);
        Gate::policy(Category::class,CategoryPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.categories',[
            "icon"=> "i-categories",
            "title" => "دسته بندی",
            "url" => route('categories.index'),
            "permission"=>Permission::PERMISSION_SUPER_ADMIN
        ]);
    }
}
