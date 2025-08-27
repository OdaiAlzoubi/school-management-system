<?php

namespace App\Providers;

use App\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\GuardianRepository;
use App\Repositories\Interface\StudentRepositoryInterface;
use App\Repositories\Interface\GuardianRepositoryInterface;
use App\Repositories\Interface\GradeRepositoryInterface;
use App\Repositories\GradeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(GuardianRepositoryInterface::class, GuardianRepository::class);
        $this->app->bind(GradeRepositoryInterface::class, GradeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
