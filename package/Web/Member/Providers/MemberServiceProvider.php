<?php

namespace Web\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Web\Member\Contracts\MemberInterface;
use Web\Member\Repositories\MemberRepositories;

class MemberServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MemberInterface::class,MemberRepositories::class);
    }

    public function boot()
    {

    }

}
