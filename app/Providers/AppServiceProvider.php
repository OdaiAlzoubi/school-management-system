<?php

namespace App\Providers;

use App\Repositories\GradeRepository;
use App\Repositories\SectionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\GuardianRepository;
use App\Repositories\Interface\GradeRepositoryInterface;
use App\Repositories\Interface\SectionRepositoryInterface;
use App\Repositories\Interface\StudentRepositoryInterface;
use App\Repositories\Interface\GuardianRepositoryInterface;

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
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
