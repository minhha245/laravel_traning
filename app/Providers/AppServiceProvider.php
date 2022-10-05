<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\TeamRepository;
use App\Repository\TeamRepositoryInterface;
use App\Repository\EmployeeRepositoryInterface;
use App\Repository\EmployeeRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
